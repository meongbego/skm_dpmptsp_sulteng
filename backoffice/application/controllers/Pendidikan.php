<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pendidikan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        else{
            $this->load->model('Pendidikan_model');
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $pendidikan = $this->Pendidikan_model->get_all();

        $data = array(
            'pendidikan_data' => $pendidikan
        );
        $data['site_title'] = 'Pendidikan';
        $data['title'] = 'Pendidikan';
        $data['assign_js'] ='pendidikan/js/index.js';
        load_view('pendidikan/tb_pendidikan_list', $data);
    }

    public function read($id)
    {
        $row = $this->Pendidikan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pendidikan' => $row->id_pendidikan,
		'kode_pendidikan' => $row->kode_pendidikan,
		'nm_pendidikan' => $row->nm_pendidikan,
	    );
            $data['site_title'] = 'Pendidikan';
            $data['title'] = 'Pendidikan';
            $data['assign_js'] = 'pendidikan/js/index.js';
            load_view('pendidikan/tb_pendidikan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pendidikan'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('pendidikan/create_action'),
	    'id_pendidikan' => set_value('id_pendidikan'),
	    'kode_pendidikan' => set_value('kode_pendidikan'),
	    'nm_pendidikan' => set_value('nm_pendidikan'),
	);      $data['site_title'] = 'Pendidikan';
        $data['title'] = 'Tambahkan Data Pendidikan';
        $data['assign_js'] = 'pendidikan/js/index.js';
        load_view('pendidikan/tb_pendidikan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_pendidikan' => $this->input->post('kode_pendidikan',TRUE),
		'nm_pendidikan' => $this->input->post('nm_pendidikan',TRUE),
	    );

            $this->Pendidikan_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Tambah Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pendidikan'));
        }
    }

    public function update($id)
    {
        $row = $this->Pendidikan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pendidikan/update_action'),
		'id_pendidikan' => set_value('id_pendidikan', $row->id_pendidikan),
		'kode_pendidikan' => set_value('kode_pendidikan', $row->kode_pendidikan),
		'nm_pendidikan' => set_value('nm_pendidikan', $row->nm_pendidikan),
	);$data['site_title'] = 'Pendidikan';
            $data['title'] = 'Ubah Data Pendidikan';
            $data['assign_js'] = 'pendidikan/js/index.js';
            load_view('pendidikan/tb_pendidikan_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pendidikan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pendidikan', TRUE));
        } else {
            $data = array(
		'kode_pendidikan' => $this->input->post('kode_pendidikan',TRUE),
		'nm_pendidikan' => $this->input->post('nm_pendidikan',TRUE),
	    );

            $this->Pendidikan_model->update($this->input->post('id_pendidikan', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Update Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pendidikan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pendidikan_model->get_by_id($id);

        if ($row) {
            $this->Pendidikan_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Hapus Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pendidikan'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pendidikan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_pendidikan', 'kode pendidikan', 'trim|required');
	$this->form_validation->set_rules('nm_pendidikan', 'nm pendidikan', 'trim|required');

	$this->form_validation->set_rules('id_pendidikan', 'id_pendidikan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_pendidikan.xls";
        $judul = "tb_pendidikan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pendidikan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Pendidikan");

	foreach ($this->Pendidikan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pendidikan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_pendidikan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */