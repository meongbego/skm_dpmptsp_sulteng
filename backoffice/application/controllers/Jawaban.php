<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jawaban extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        else{
            $this->load->model('Jawaban_model');
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $jawaban = $this->Jawaban_model->get_all();

        $data = array(
            'jawaban_data' => $jawaban
        );
        $data['site_title'] = 'Jawaban';
        $data['title'] = 'Jawaban';
        $data['assign_js'] ='jawaban/js/index.js';
        load_view('jawaban/tb_jawaban_list', $data);
    }

    public function read($id)
    {
        $row = $this->Jawaban_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jawaban' => $row->id_jawaban,
		'kode_jawaban' => $row->kode_jawaban,
		'nm_jawaban' => $row->nm_jawaban,
		'ket_jawaban' => $row->ket_jawaban,
	    );
            $data['site_title'] = 'Jawaban';
            $data['title'] = 'Jawaban';
            $data['assign_js'] = 'jawaban/js/index.js';
            load_view('jawaban/tb_jawaban_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jawaban'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('jawaban/create_action'),
	    'id_jawaban' => set_value('id_jawaban'),
	    'kode_jawaban' => set_value('kode_jawaban'),
	    'nm_jawaban' => set_value('nm_jawaban'),
	    'ket_jawaban' => set_value('ket_jawaban'),
	);      $data['site_title'] = 'Jawaban';
        $data['title'] = 'Tambahkan Data Jawaban';
        $data['assign_js'] = 'jawaban/js/index.js';
        load_view('jawaban/tb_jawaban_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_jawaban' => $this->input->post('kode_jawaban',TRUE),
		'nm_jawaban' => $this->input->post('nm_jawaban',TRUE),
		'ket_jawaban' => $this->input->post('ket_jawaban',TRUE),
	    );

            $this->Jawaban_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Tambah Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('jawaban'));
        }
    }

    public function update($id)
    {
        $row = $this->Jawaban_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jawaban/update_action'),
		'id_jawaban' => set_value('id_jawaban', $row->id_jawaban),
		'kode_jawaban' => set_value('kode_jawaban', $row->kode_jawaban),
		'nm_jawaban' => set_value('nm_jawaban', $row->nm_jawaban),
		'ket_jawaban' => set_value('ket_jawaban', $row->ket_jawaban),
	);$data['site_title'] = 'Jawaban';
            $data['title'] = 'Ubah Data Jawaban';
            $data['assign_js'] = 'jawaban/js/index.js';
            load_view('jawaban/tb_jawaban_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('jawaban'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jawaban', TRUE));
        } else {
            $data = array(
		'kode_jawaban' => $this->input->post('kode_jawaban',TRUE),
		'nm_jawaban' => $this->input->post('nm_jawaban',TRUE),
		'ket_jawaban' => $this->input->post('ket_jawaban',TRUE),
	    );

            $this->Jawaban_model->update($this->input->post('id_jawaban', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Update Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('jawaban'));
        }
    }

    public function delete($id)
    {
        $row = $this->Jawaban_model->get_by_id($id);

        if ($row) {
            $this->Jawaban_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Hapus Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('jawaban'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('jawaban'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_jawaban', 'kode jawaban', 'trim|required');
	$this->form_validation->set_rules('nm_jawaban', 'nm jawaban', 'trim|required');
	$this->form_validation->set_rules('ket_jawaban', 'ket jawaban', 'trim|required');

	$this->form_validation->set_rules('id_jawaban', 'id_jawaban', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_jawaban.xls";
        $judul = "tb_jawaban";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Jawaban");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Jawaban");
	xlsWriteLabel($tablehead, $kolomhead++, "Ket Jawaban");

	foreach ($this->Jawaban_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_jawaban);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_jawaban);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ket_jawaban);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */