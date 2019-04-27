<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_survei extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        else{
            $this->load->model('Peserta_survei_model');
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $peserta_survei = $this->Peserta_survei_model->get_all();

        $data = array(
            'peserta_survei_data' => $peserta_survei
        );
        $data['site_title'] = 'Peserta_survei';
        $data['title'] = 'Peserta Surver';
        $data['assign_js'] ='peserta_survei/js/index.js';
        load_view('peserta_survei/tb_peserta_survei_list', $data);
    }

    public function read($id)
    {
        $row = $this->Peserta_survei_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_peserta_survei' => $row->id_peserta_survei,
		'kode_peserta_survei' => $row->kode_peserta_survei,
		'status_isi' => $row->status_isi,
		'kode_pegawai' => $row->kode_pegawai,
		'kode_peserta' => $row->kode_peserta,
		'kode_tahun_survei' => $row->kode_tahun_survei,
		'kode_status_survei' => $row->kode_status_survei,
	    );
            $data['site_title'] = 'Peserta_survei';
            $data['title'] = 'Peserta Surver';
            $data['assign_js'] = 'peserta_survei/js/index.js';
            load_view('peserta_survei/tb_peserta_survei_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peserta_survei'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('peserta_survei/create_action'),
	    'id_peserta_survei' => set_value('id_peserta_survei'),
	    'kode_peserta_survei' => set_value('kode_peserta_survei'),
	    'status_isi' => set_value('status_isi'),
	    'kode_pegawai' => set_value('kode_pegawai'),
	    'kode_peserta' => set_value('kode_peserta'),
	    'kode_tahun_survei' => set_value('kode_tahun_survei'),
	    'kode_status_survei' => set_value('kode_status_survei'),
	);
   $tb_pegawai=$this->Peserta_survei_model->get_query("SELECT * FROM tb_pegawai ")->result();
                
   $data['tb_pegawai']=$tb_pegawai;
   $tb_tahun_survei=$this->Peserta_survei_model->get_query("SELECT * FROM tb_tahun_survei ")->result();
                
   $data['tb_tahun_survei']=$tb_tahun_survei;
   $tb_status_survei=$this->Peserta_survei_model->get_query("SELECT * FROM tb_status_survei ")->result();
                
   $data['tb_status_survei']=$tb_status_survei;      $data['site_title'] = 'Peserta_survei';
        $data['title'] = 'Tambahkan Data Peserta_survei';
        $data['assign_js'] = 'peserta_survei/js/index.js';
        load_view('peserta_survei/tb_peserta_survei_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_peserta_survei' => $this->input->post('kode_peserta_survei',TRUE),
		'status_isi' => $this->input->post('status_isi',TRUE),
		'kode_pegawai' => $this->input->post('kode_pegawai',TRUE),
		'kode_peserta' => $this->input->post('kode_peserta',TRUE),
		'kode_tahun_survei' => $this->input->post('kode_tahun_survei',TRUE),
		'kode_status_survei' => $this->input->post('kode_status_survei',TRUE),
	    );

            $this->Peserta_survei_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Tambah Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('peserta_survei'));
        }
    }

    public function update($id)
    {
        $row = $this->Peserta_survei_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('peserta_survei/update_action'),
		'id_peserta_survei' => set_value('id_peserta_survei', $row->id_peserta_survei),
		'kode_peserta_survei' => set_value('kode_peserta_survei', $row->kode_peserta_survei),
		'status_isi' => set_value('status_isi', $row->status_isi),
		'kode_pegawai' => set_value('kode_pegawai', $row->kode_pegawai),
		'kode_peserta' => set_value('kode_peserta', $row->kode_peserta),
		'kode_tahun_survei' => set_value('kode_tahun_survei', $row->kode_tahun_survei),
		'kode_status_survei' => set_value('kode_status_survei', $row->kode_status_survei),
	);
   $tb_pegawai=$this->Peserta_survei_model->get_query("SELECT * FROM tb_pegawai ")->result();
                                
   $data['tb_pegawai']=$tb_pegawai;
   $tb_tahun_survei=$this->Peserta_survei_model->get_query("SELECT * FROM tb_tahun_survei ")->result();
                                
   $data['tb_tahun_survei']=$tb_tahun_survei;
   $tb_status_survei=$this->Peserta_survei_model->get_query("SELECT * FROM tb_status_survei ")->result();
                                
   $data['tb_status_survei']=$tb_status_survei;$data['site_title'] = 'Peserta_survei';
            $data['title'] = 'Ubah Data Peserta_survei';
            $data['assign_js'] = 'peserta_survei/js/index.js';
            load_view('peserta_survei/tb_peserta_survei_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('peserta_survei'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_peserta_survei', TRUE));
        } else {
            $data = array(
		'kode_peserta_survei' => $this->input->post('kode_peserta_survei',TRUE),
		'status_isi' => $this->input->post('status_isi',TRUE),
		'kode_pegawai' => $this->input->post('kode_pegawai',TRUE),
		'kode_peserta' => $this->input->post('kode_peserta',TRUE),
		'kode_tahun_survei' => $this->input->post('kode_tahun_survei',TRUE),
		'kode_status_survei' => $this->input->post('kode_status_survei',TRUE),
	    );

            $this->Peserta_survei_model->update($this->input->post('id_peserta_survei', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Update Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('peserta_survei'));
        }
    }

    public function delete($id)
    {
        $row = $this->Peserta_survei_model->get_by_id($id);

        if ($row) {
            $this->Peserta_survei_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Hapus Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('peserta_survei'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('peserta_survei'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_peserta_survei', 'kode peserta survei', 'trim|required');
	$this->form_validation->set_rules('status_isi', 'status isi', 'trim|required');
	$this->form_validation->set_rules('kode_pegawai', 'kode pegawai', 'trim|required');
	$this->form_validation->set_rules('kode_peserta', 'kode peserta', 'trim|required');
	$this->form_validation->set_rules('kode_tahun_survei', 'kode tahun survei', 'trim|required');
	$this->form_validation->set_rules('kode_status_survei', 'kode status survei', 'trim|required');

	$this->form_validation->set_rules('id_peserta_survei', 'id_peserta_survei', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_peserta_survei.xls";
        $judul = "tb_peserta_survei";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Peserta Survei");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Isi");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pegawai");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Peserta");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Tahun Survei");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Status Survei");

	foreach ($this->Peserta_survei_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_peserta_survei);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_isi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pegawai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_peserta);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_tahun_survei);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_status_survei);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */