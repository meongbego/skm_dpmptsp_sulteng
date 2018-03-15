<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pertanyaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        else{
            $this->load->model('Pertanyaan_model');
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $pertanyaan = $this->Pertanyaan_model->get_all();

        $data = array(
            'pertanyaan_data' => $pertanyaan
        );
        $data['site_title'] = 'Pertanyaan';
        $data['title'] = 'Pertanyaan';
        $data['assign_js'] ='pertanyaan/js/index.js';
        load_view('pertanyaan/tb_pertanyaan_list', $data);
    }

    public function read($id)
    {
        $row = $this->Pertanyaan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pertanyaan' => $row->id_pertanyaan,
		'kode_pertanyaan' => $row->kode_pertanyaan,
		'kode_kategori_pertanyaan' => $row->kode_kategori_pertanyaan,
		'ket_pertanyaan' => $row->ket_pertanyaan,
		'status_config' => $row->status_config,
	    );
            $data['site_title'] = 'Pertanyaan';
            $data['title'] = 'Pertanyaan';
            $data['assign_js'] = 'pertanyaan/js/index.js';
            load_view('pertanyaan/tb_pertanyaan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pertanyaan'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('pertanyaan/create_action'),
	    'id_pertanyaan' => set_value('id_pertanyaan'),
	    'kode_pertanyaan' => set_value('kode_pertanyaan'),
	    'kode_kategori_pertanyaan' => set_value('kode_kategori_pertanyaan'),
	    'ket_pertanyaan' => set_value('ket_pertanyaan'),
	    'status_config' => set_value('status_config'),
	);
   $tb_kategori_pertanyaan=$this->Pertanyaan_model->get_query("SELECT * FROM tb_kategori_pertanyaan ")->result();

   $data['tb_kategori_pertanyaan']=$tb_kategori_pertanyaan;      $data['site_title'] = 'Pertanyaan';
        $data['title'] = 'Tambahkan Data Pertanyaan';
        $data['assign_js'] = 'pertanyaan/js/index.js';
        load_view('pertanyaan/tb_pertanyaan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
          		'kode_pertanyaan' => $this->input->post('kode_pertanyaan',TRUE),
          		'kode_kategori_pertanyaan' => $this->input->post('kode_kategori_pertanyaan',TRUE),
          		'ket_pertanyaan' => $this->input->post('ket_pertanyaan',TRUE),
          		'status_config' => 'N',
	           );

            $this->Pertanyaan_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Tambah Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pertanyaan'));
        }
    }

    public function update($id)
    {
        $row = $this->Pertanyaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pertanyaan/update_action'),
		'id_pertanyaan' => set_value('id_pertanyaan', $row->id_pertanyaan),
		'kode_pertanyaan' => set_value('kode_pertanyaan', $row->kode_pertanyaan),
		'kode_kategori_pertanyaan' => set_value('kode_kategori_pertanyaan', $row->kode_kategori_pertanyaan),
		'ket_pertanyaan' => set_value('ket_pertanyaan', $row->ket_pertanyaan),
		'status_config' => set_value('status_config', $row->status_config),
	);
   $tb_kategori_pertanyaan=$this->Pertanyaan_model->get_query("SELECT * FROM tb_kategori_pertanyaan ")->result();

   $data['tb_kategori_pertanyaan']=$tb_kategori_pertanyaan;$data['site_title'] = 'Pertanyaan';
            $data['title'] = 'Ubah Data Pertanyaan';
            $data['assign_js'] = 'pertanyaan/js/index.js';
            load_view('pertanyaan/tb_pertanyaan_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pertanyaan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pertanyaan', TRUE));
        } else {
            $data = array(
		'kode_pertanyaan' => $this->input->post('kode_pertanyaan',TRUE),
		'kode_kategori_pertanyaan' => $this->input->post('kode_kategori_pertanyaan',TRUE),
		'ket_pertanyaan' => $this->input->post('ket_pertanyaan',TRUE),
		'status_config' => $this->input->post('status_config',TRUE),
	    );

            $this->Pertanyaan_model->update($this->input->post('id_pertanyaan', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Update Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pertanyaan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pertanyaan_model->get_by_id($id);

        if ($row) {
            $this->Pertanyaan_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Hapus Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pertanyaan'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('pertanyaan'));
        }
    }

    public function finish_konfig($kode_pertanyaan)
    {
      $pertanyaan = $this->Pertanyaan_model->get_query("SELECT * FROM tb_pertanyaan WHERE kode_pertanyaan='".$kode_pertanyaan."'")->row();
      $data = array(
         'status_config' => 'Y',
      );
      $this->Pertanyaan_model->update($pertanyaan->id_pertanyaan, $data);

      redirect('pertanyaan');
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_pertanyaan', 'kode pertanyaan', 'trim|required');
	$this->form_validation->set_rules('kode_kategori_pertanyaan', 'kode kategori pertanyaan', 'trim|required');
	$this->form_validation->set_rules('ket_pertanyaan', 'ket pertanyaan', 'trim|required');
	// $this->form_validation->set_rules('status_config', 'status config', 'trim|required');

	$this->form_validation->set_rules('id_pertanyaan', 'id_pertanyaan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_pertanyaan.xls";
        $judul = "tb_pertanyaan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pertanyaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Kategori Pertanyaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Ket Pertanyaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Config");

	foreach ($this->Pertanyaan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pertanyaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_kategori_pertanyaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ket_pertanyaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_config);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */
