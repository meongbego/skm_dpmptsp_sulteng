<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pekerjaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        else{
            $this->load->model('Pekerjaan_model');
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $pekerjaan = $this->Pekerjaan_model->get_all();

        $data = array(
            'pekerjaan_data' => $pekerjaan
        );
        $data['site_title'] = 'Pekerjaan';
        $data['title'] = 'Pekerjaan';
        $data['assign_js'] ='pekerjaan/js/index.js';
        load_view('pekerjaan/tb_pekerjaan_list', $data);
    }

    public function read($id)
    {
        $row = $this->Pekerjaan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pekerjaan' => $row->id_pekerjaan,
		'kode_pekerjaan' => $row->kode_pekerjaan,
		'nm_pekerjaan' => $row->nm_pekerjaan,
	    );
            $data['site_title'] = 'Pekerjaan';
            $data['title'] = 'Pekerjaan';
            $data['assign_js'] = 'pekerjaan/js/index.js';
            load_view('pekerjaan/tb_pekerjaan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pekerjaan'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('pekerjaan/create_action'),
	    'id_pekerjaan' => set_value('id_pekerjaan'),
	    'kode_pekerjaan' => set_value('kode_pekerjaan'),
	    'nm_pekerjaan' => set_value('nm_pekerjaan'),
	);      $data['site_title'] = 'Pekerjaan';
        $data['title'] = 'Tambahkan Data Pekerjaan';
        $data['assign_js'] = 'pekerjaan/js/index.js';
        load_view('pekerjaan/tb_pekerjaan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_pekerjaan' => $this->input->post('kode_pekerjaan',TRUE),
		'nm_pekerjaan' => $this->input->post('nm_pekerjaan',TRUE),
	    );

            $this->Pekerjaan_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Tambah Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pekerjaan'));
        }
    }

    public function update($id)
    {
        $row = $this->Pekerjaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pekerjaan/update_action'),
		'id_pekerjaan' => set_value('id_pekerjaan', $row->id_pekerjaan),
		'kode_pekerjaan' => set_value('kode_pekerjaan', $row->kode_pekerjaan),
		'nm_pekerjaan' => set_value('nm_pekerjaan', $row->nm_pekerjaan),
	);$data['site_title'] = 'Pekerjaan';
            $data['title'] = 'Ubah Data Pekerjaan';
            $data['assign_js'] = 'pekerjaan/js/index.js';
            load_view('pekerjaan/tb_pekerjaan_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pekerjaan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pekerjaan', TRUE));
        } else {
            $data = array(
		'kode_pekerjaan' => $this->input->post('kode_pekerjaan',TRUE),
		'nm_pekerjaan' => $this->input->post('nm_pekerjaan',TRUE),
	    );

            $this->Pekerjaan_model->update($this->input->post('id_pekerjaan', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Update Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pekerjaan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pekerjaan_model->get_by_id($id);

        if ($row) {
            $this->Pekerjaan_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Hapus Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pekerjaan'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pekerjaan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_pekerjaan', 'kode pekerjaan', 'trim|required');
	$this->form_validation->set_rules('nm_pekerjaan', 'nm pekerjaan', 'trim|required');

	$this->form_validation->set_rules('id_pekerjaan', 'id_pekerjaan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_pekerjaan.xls";
        $judul = "tb_pekerjaan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pekerjaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Pekerjaan");

	foreach ($this->Pekerjaan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pekerjaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_pekerjaan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */