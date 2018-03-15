<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        else{
            $this->load->model('Pegawai_model');
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $pegawai = $this->Pegawai_model->get_all();

        $data = array(
            'pegawai_data' => $pegawai
        );
        $data['site_title'] = 'Pegawai';
        $data['title'] = 'Pegawai';
        $data['assign_js'] ='pegawai/js/index.js';
        load_view('pegawai/tb_pegawai_list', $data);
    }

    public function read($id)
    {
        $row = $this->Pegawai_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pegawai' => $row->id_pegawai,
		'kode_pegawai' => $row->kode_pegawai,
		'nm_pegawai' => $row->nm_pegawai,
		'jabatan' => $row->jabatan,
	    );
            $data['site_title'] = 'Pegawai';
            $data['title'] = 'Pegawai';
            $data['assign_js'] = 'pegawai/js/index.js';
            load_view('pegawai/tb_pegawai_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('pegawai/create_action'),
	    'id_pegawai' => set_value('id_pegawai'),
	    'kode_pegawai' => set_value('kode_pegawai'),
	    'nm_pegawai' => set_value('nm_pegawai'),
	    'jabatan' => set_value('jabatan'),
	);      $data['site_title'] = 'Pegawai';
        $data['title'] = 'Tambahkan Data Pegawai';
        $data['assign_js'] = 'pegawai/js/index.js';
        load_view('pegawai/tb_pegawai_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_pegawai' => $this->input->post('kode_pegawai',TRUE),
		'nm_pegawai' => $this->input->post('nm_pegawai',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
	    );

            $this->Pegawai_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Tambah Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pegawai'));
        }
    }

    public function update($id)
    {
        $row = $this->Pegawai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pegawai/update_action'),
		'id_pegawai' => set_value('id_pegawai', $row->id_pegawai),
		'kode_pegawai' => set_value('kode_pegawai', $row->kode_pegawai),
		'nm_pegawai' => set_value('nm_pegawai', $row->nm_pegawai),
		'jabatan' => set_value('jabatan', $row->jabatan),
	);$data['site_title'] = 'Pegawai';
            $data['title'] = 'Ubah Data Pegawai';
            $data['assign_js'] = 'pegawai/js/index.js';
            load_view('pegawai/tb_pegawai_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pegawai'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pegawai', TRUE));
        } else {
            $data = array(
		'kode_pegawai' => $this->input->post('kode_pegawai',TRUE),
		'nm_pegawai' => $this->input->post('nm_pegawai',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
	    );

            $this->Pegawai_model->update($this->input->post('id_pegawai', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Update Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pegawai'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pegawai_model->get_by_id($id);

        if ($row) {
            $this->Pegawai_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Hapus Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pegawai'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pegawai'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_pegawai', 'kode pegawai', 'trim|required');
	$this->form_validation->set_rules('nm_pegawai', 'nm pegawai', 'trim|required');
	$this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');

	$this->form_validation->set_rules('id_pegawai', 'id_pegawai', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_pegawai.xls";
        $judul = "tb_pegawai";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pegawai");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Pegawai");
	xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");

	foreach ($this->Pegawai_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pegawai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_pegawai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */