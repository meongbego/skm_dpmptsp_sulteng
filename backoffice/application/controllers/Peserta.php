<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Peserta extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        else{
            $this->load->model('Tahun_survei_model');
            $this->load->model('Peserta_model');
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $tahun_survei = $this->Tahun_survei_model->get_all();
        $data = array(
            'tahun_survei_data' => $tahun_survei
        );
        $data['site_title'] = 'Tahun Survey';
        $data['title'] = 'Tahun Survey';
        $data['assign_js'] ='peserta/js/index.js';
        load_view('peserta/tahun_survei', $data);
    }

    public function PSurvei($tahun='')
    {
      $peserta = $this->Peserta_model->get_query("SELECT * FROM v_peserta_survei WHERE kode_tahun_survei='".$tahun."'")->result();
      //echo json_encode($peserta);

      $data = array(
          'peserta_data' => $peserta
      );
      $data['site_title'] = 'Peserta';
      $data['title'] = 'Peserta';
      $data['assign_js'] ='peserta/js/index.js';
      load_view('peserta/tb_peserta_list', $data);
    }

    public function read($id)
    {
        $row = $this->Peserta_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_peserta' => $row->id_peserta,
		'no_peserta' => $row->no_peserta,
		'umur' => $row->umur,
		'jenkel' => $row->jenkel,
		'kode_pendidikan' => $row->kode_pendidikan,
		'kode_pekerjaan' => $row->kode_pekerjaan,
	    );
            $data['site_title'] = 'Peserta';
            $data['title'] = 'Peserta';
            $data['assign_js'] = 'peserta/js/index.js';
            load_view('peserta/tb_peserta_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peserta'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('peserta/create_action'),
	    'id_peserta' => set_value('id_peserta'),
	    'no_peserta' => set_value('no_peserta'),
	    'umur' => set_value('umur'),
	    'jenkel' => set_value('jenkel'),
	    'kode_pendidikan' => set_value('kode_pendidikan'),
	    'kode_pekerjaan' => set_value('kode_pekerjaan'),
	);
   $tb_pendidikan=$this->Peserta_model->get_query("SELECT * FROM tb_pendidikan ")->result();

   $data['tb_pendidikan']=$tb_pendidikan;
   $tb_pekerjaan=$this->Peserta_model->get_query("SELECT * FROM tb_pekerjaan ")->result();

   $data['tb_pekerjaan']=$tb_pekerjaan;      $data['site_title'] = 'Peserta';
        $data['title'] = 'Tambahkan Data Peserta';
        $data['assign_js'] = 'peserta/js/index.js';
        load_view('peserta/tb_peserta_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'no_peserta' => $this->input->post('no_peserta',TRUE),
		'umur' => $this->input->post('umur',TRUE),
		'jenkel' => $this->input->post('jenkel',TRUE),
		'kode_pendidikan' => $this->input->post('kode_pendidikan',TRUE),
		'kode_pekerjaan' => $this->input->post('kode_pekerjaan',TRUE),
	    );

            $this->Peserta_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Tambah Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('peserta'));
        }
    }

    public function update($id)
    {
        $row = $this->Peserta_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('peserta/update_action'),
		'id_peserta' => set_value('id_peserta', $row->id_peserta),
		'no_peserta' => set_value('no_peserta', $row->no_peserta),
		'umur' => set_value('umur', $row->umur),
		'jenkel' => set_value('jenkel', $row->jenkel),
		'kode_pendidikan' => set_value('kode_pendidikan', $row->kode_pendidikan),
		'kode_pekerjaan' => set_value('kode_pekerjaan', $row->kode_pekerjaan),
	);
   $tb_pendidikan=$this->Peserta_model->get_query("SELECT * FROM tb_pendidikan ")->result();

   $data['tb_pendidikan']=$tb_pendidikan;
   $tb_pekerjaan=$this->Peserta_model->get_query("SELECT * FROM tb_pekerjaan ")->result();

   $data['tb_pekerjaan']=$tb_pekerjaan;$data['site_title'] = 'Peserta';
            $data['title'] = 'Ubah Data Peserta';
            $data['assign_js'] = 'peserta/js/index.js';
            load_view('peserta/tb_peserta_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('peserta'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_peserta', TRUE));
        } else {
            $data = array(
		'no_peserta' => $this->input->post('no_peserta',TRUE),
		'umur' => $this->input->post('umur',TRUE),
		'jenkel' => $this->input->post('jenkel',TRUE),
		'kode_pendidikan' => $this->input->post('kode_pendidikan',TRUE),
		'kode_pekerjaan' => $this->input->post('kode_pekerjaan',TRUE),
	    );

            $this->Peserta_model->update($this->input->post('id_peserta', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Update Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('peserta'));
        }
    }

    public function delete($id)
    {
        $row = $this->Peserta_model->get_by_id($id);

        if ($row) {
            $this->Peserta_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Hapus Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('peserta'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('peserta'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('no_peserta', 'no peserta', 'trim|required');
	$this->form_validation->set_rules('umur', 'umur', 'trim|required|numeric');
	$this->form_validation->set_rules('jenkel', 'jenkel', 'trim|required');
	$this->form_validation->set_rules('kode_pendidikan', 'kode pendidikan', 'trim|required');
	$this->form_validation->set_rules('kode_pekerjaan', 'kode pekerjaan', 'trim|required');

	$this->form_validation->set_rules('id_peserta', 'id_peserta', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_peserta.xls";
        $judul = "tb_peserta";
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
	xlsWriteLabel($tablehead, $kolomhead++, "No Peserta");
	xlsWriteLabel($tablehead, $kolomhead++, "Umur");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenkel");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pendidikan");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pekerjaan");

	foreach ($this->Peserta_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_peserta);
	    xlsWriteNumber($tablebody, $kolombody++, $data->umur);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenkel);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pendidikan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pekerjaan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

  public function jSurvei($kode_peserta='')
  {
    $data = $this->Peserta_model->get_query("SELECT * FROM v_survei m1 WHERE m1.kode_peserta_survei='".$kode_peserta."'")->result();

    //echo json_encode($data);

    $data['survei_data'] = $data;
    $data['site_title'] = 'Jawaban Survey';
    $data['title'] = 'Jawaban Survey';
    $data['assign_js'] ='peserta/js/index.js';
    load_view('peserta/tb_survei_list', $data);
  }

}

/* PTT */
