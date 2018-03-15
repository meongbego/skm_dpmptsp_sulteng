<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tahun_survei extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        else{
            $this->load->model('Tahun_survei_model');
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $tahun_survei = $this->Tahun_survei_model->get_all();

        $data = array(
            'tahun_survei_data' => $tahun_survei
        );
        $data['site_title'] = 'Tahun_survei';
        $data['title'] = 'Tahun_survei';
        $data['assign_js'] ='tahun_survei/js/index.js';
        load_view('tahun_survei/tb_tahun_survei_list', $data);
    }

    public function read($id)
    {
        $row = $this->Tahun_survei_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_tahun_survei' => $row->id_tahun_survei,
		'kode_tahun_survei' => $row->kode_tahun_survei,
		'nm_tahun' => $row->nm_tahun,
	    );
            $data['site_title'] = 'Tahun_survei';
            $data['title'] = 'Tahun_survei';
            $data['assign_js'] = 'tahun_survei/js/index.js';
            load_view('tahun_survei/tb_tahun_survei_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahun_survei'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('tahun_survei/create_action'),
	    'id_tahun_survei' => set_value('id_tahun_survei'),
	    'kode_tahun_survei' => set_value('kode_tahun_survei'),
	    'nm_tahun' => set_value('nm_tahun'),
	);      $data['site_title'] = 'Tahun_survei';
        $data['title'] = 'Tambahkan Data Tahun_survei';
        $data['assign_js'] = 'tahun_survei/js/index.js';
        load_view('tahun_survei/tb_tahun_survei_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_tahun_survei' => $this->input->post('kode_tahun_survei',TRUE),
		'nm_tahun' => $this->input->post('nm_tahun',TRUE),
	    );

            $this->Tahun_survei_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Tambah Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('tahun_survei'));
        }
    }

    public function update($id)
    {
        $row = $this->Tahun_survei_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tahun_survei/update_action'),
		'id_tahun_survei' => set_value('id_tahun_survei', $row->id_tahun_survei),
		'kode_tahun_survei' => set_value('kode_tahun_survei', $row->kode_tahun_survei),
		'nm_tahun' => set_value('nm_tahun', $row->nm_tahun),
	);$data['site_title'] = 'Tahun_survei';
            $data['title'] = 'Ubah Data Tahun_survei';
            $data['assign_js'] = 'tahun_survei/js/index.js';
            load_view('tahun_survei/tb_tahun_survei_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('tahun_survei'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_tahun_survei', TRUE));
        } else {
            $data = array(
		'kode_tahun_survei' => $this->input->post('kode_tahun_survei',TRUE),
		'nm_tahun' => $this->input->post('nm_tahun',TRUE),
	    );

            $this->Tahun_survei_model->update($this->input->post('id_tahun_survei', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Update Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('tahun_survei'));
        }
    }

    public function delete($id)
    {
        $row = $this->Tahun_survei_model->get_by_id($id);

        if ($row) {
            $this->Tahun_survei_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Hapus Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('tahun_survei'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('tahun_survei'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_tahun_survei', 'kode tahun survei', 'trim|required');
	$this->form_validation->set_rules('nm_tahun', 'nm tahun', 'trim|required');

	$this->form_validation->set_rules('id_tahun_survei', 'id_tahun_survei', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_tahun_survei.xls";
        $judul = "tb_tahun_survei";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Tahun Survei");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Tahun");

	foreach ($this->Tahun_survei_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_tahun_survei);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_tahun);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */