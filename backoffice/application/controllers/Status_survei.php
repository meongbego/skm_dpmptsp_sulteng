<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Status_survei extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        else{
            $this->load->model('Status_survei_model');
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $status_survei = $this->Status_survei_model->get_all();

        $data = array(
            'status_survei_data' => $status_survei
        );
        $data['site_title'] = 'Status_survei';
        $data['title'] = 'Status_survei';
        $data['assign_js'] ='status_survei/js/index.js';
        load_view('status_survei/tb_status_survei_list', $data);
    }

    public function read($id)
    {
        $row = $this->Status_survei_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_status_survei' => $row->id_status_survei,
		'kode_status_survei' => $row->kode_status_survei,
		'nm_status_survei' => $row->nm_status_survei,
	    );
            $data['site_title'] = 'Status_survei';
            $data['title'] = 'Status_survei';
            $data['assign_js'] = 'status_survei/js/index.js';
            load_view('status_survei/tb_status_survei_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('status_survei'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('status_survei/create_action'),
	    'id_status_survei' => set_value('id_status_survei'),
	    'kode_status_survei' => set_value('kode_status_survei'),
	    'nm_status_survei' => set_value('nm_status_survei'),
	);      $data['site_title'] = 'Status_survei';
        $data['title'] = 'Tambahkan Data Status_survei';
        $data['assign_js'] = 'status_survei/js/index.js';
        load_view('status_survei/tb_status_survei_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_status_survei' => $this->input->post('kode_status_survei',TRUE),
		'nm_status_survei' => $this->input->post('nm_status_survei',TRUE),
	    );

            $this->Status_survei_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Tambah Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('status_survei'));
        }
    }

    public function update($id)
    {
        $row = $this->Status_survei_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('status_survei/update_action'),
		'id_status_survei' => set_value('id_status_survei', $row->id_status_survei),
		'kode_status_survei' => set_value('kode_status_survei', $row->kode_status_survei),
		'nm_status_survei' => set_value('nm_status_survei', $row->nm_status_survei),
	);$data['site_title'] = 'Status_survei';
            $data['title'] = 'Ubah Data Status_survei';
            $data['assign_js'] = 'status_survei/js/index.js';
            load_view('status_survei/tb_status_survei_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('status_survei'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_status_survei', TRUE));
        } else {
            $data = array(
		'kode_status_survei' => $this->input->post('kode_status_survei',TRUE),
		'nm_status_survei' => $this->input->post('nm_status_survei',TRUE),
	    );

            $this->Status_survei_model->update($this->input->post('id_status_survei', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Update Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('status_survei'));
        }
    }

    public function delete($id)
    {
        $row = $this->Status_survei_model->get_by_id($id);

        if ($row) {
            $this->Status_survei_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Hapus Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('status_survei'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('status_survei'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_status_survei', 'kode status survei', 'trim|required');
	$this->form_validation->set_rules('nm_status_survei', 'nm status survei', 'trim|required');

	$this->form_validation->set_rules('id_status_survei', 'id_status_survei', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_status_survei.xls";
        $judul = "tb_status_survei";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Status Survei");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Status Survei");

	foreach ($this->Status_survei_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_status_survei);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_status_survei);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */