<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_pertanyaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        else{
            $this->load->model('Kategori_pertanyaan_model');
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $kategori_pertanyaan = $this->Kategori_pertanyaan_model->get_all();

        $data = array(
            'kategori_pertanyaan_data' => $kategori_pertanyaan
        );
        $data['site_title'] = 'Kategori_pertanyaan';
        $data['title'] = 'Kategori Pertanyaan';
        $data['assign_js'] ='kategori_pertanyaan/js/index.js';
        load_view('kategori_pertanyaan/tb_kategori_pertanyaan_list', $data);
    }

    public function read($id)
    {
        $row = $this->Kategori_pertanyaan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kategori_pertanyaan' => $row->id_kategori_pertanyaan,
		'kode_kategori_pertanyaan' => $row->kode_kategori_pertanyaan,
    'nm_kategori_pertanyaan' => $row->nm_kategori_pertanyaan,
	    );
            $data['site_title'] = 'Kategori_pertanyaan';
            $data['title'] = 'Kategori Pertanyaan';
            $data['assign_js'] = 'kategori_pertanyaan/js/index.js';
            load_view('kategori_pertanyaan/tb_kategori_pertanyaan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori_pertanyaan'));
        }
    }

    public function create()
    {

      $data = array(
            'button' => 'Create',
            'action' => site_url('kategori_pertanyaan/create_action'),
	    'id_kategori_pertanyaan' => set_value('id_kategori_pertanyaan'),
	    'kode_kategori_pertanyaan' => set_value('kode_kategori_pertanyaan'),
      'nm_kategori_pertanyaan' => set_value('nm_kategori_pertanyaan'),
	);      $data['site_title'] = 'Kategori_pertanyaan';
        $data['title'] = 'Tambahkan Data Kategori_pertanyaan';
        $data['assign_js'] = 'kategori_pertanyaan/js/index.js';
        load_view('kategori_pertanyaan/tb_kategori_pertanyaan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_kategori_pertanyaan' => $this->input->post('kode_kategori_pertanyaan',TRUE),
    'nm_kategori_pertanyaan' => $this->input->post('nm_kategori_pertanyaan',TRUE),
	    );

            $this->Kategori_pertanyaan_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Tambah Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('kategori_pertanyaan'));
        }
    }

    public function update($id)
    {
        $row = $this->Kategori_pertanyaan_model->get_by_id($id);

        if ($row) {
            $data = array(
            'button' => 'Update',
            'action' => site_url('kategori_pertanyaan/update_action'),
            'id_kategori_pertanyaan' => set_value('id_kategori_pertanyaan', $row->id_kategori_pertanyaan),
            'kode_kategori_pertanyaan' => set_value('kode_kategori_pertanyaan', $row->kode_kategori_pertanyaan),
            'nm_kategori_pertanyaan' => set_value('nm_kategori_pertanyaan', $row->nm_kategori_pertanyaan),
          );
          $data['site_title'] = 'Kategori_pertanyaan';
            $data['title'] = 'Ubah Data Kategori_pertanyaan';
            $data['assign_js'] = 'kategori_pertanyaan/js/index.js';
            load_view('kategori_pertanyaan/tb_kategori_pertanyaan_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('kategori_pertanyaan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kategori_pertanyaan', TRUE));
        } else {
            $data = array(
		'kode_kategori_pertanyaan' => $this->input->post('kode_kategori_pertanyaan',TRUE),
    'nm_kategori_pertanyaan' => $this->input->post('nm_kategori_pertanyaan',TRUE),
	    );

            $this->Kategori_pertanyaan_model->update($this->input->post('id_kategori_pertanyaan', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Update Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('kategori_pertanyaan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Kategori_pertanyaan_model->get_by_id($id);

        if ($row) {
            $this->Kategori_pertanyaan_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Hapus Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('kategori_pertanyaan'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('kategori_pertanyaan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_kategori_pertanyaan', 'kode kategori pertanyaan', 'trim|required');
  $this->form_validation->set_rules('nm_kategori_pertanyaan', 'nm kategori pertanyaan', 'trim|required');

	$this->form_validation->set_rules('id_kategori_pertanyaan', 'id_kategori_pertanyaan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_kategori_pertanyaan.xls";
        $judul = "tb_kategori_pertanyaan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Kategori Pertanyaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Kategori Pertanyaan");

	foreach ($this->Kategori_pertanyaan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_kategori_pertanyaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_kategori_pertanyaan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */
