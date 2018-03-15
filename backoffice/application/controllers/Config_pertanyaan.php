<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Config_pertanyaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
          redirect('auth');
        }
        else {
          $this->load->model('Config_pertanyaan_model');
          $this->load->model('App_model');
          $this->load->library('form_validation');
        }

    }

    public function konfigurasi($a="")
    {
        $config_pertanyaan = $this->Config_pertanyaan_model->get_query("SELECT * FROM v_pertanyaan_bobot WHERE kode_pertanyaan='".$a."'")->result();

        $data = array(
            'config_pertanyaan_data' => $config_pertanyaan
        );
        // echo json_encode($data['config_pertanyaan_data']);
        $data['kode_pertanyaan'] = $a;

        $data['site_title'] = 'Konfigurasi Pertanyaan';
        $data['title'] = 'Konfigurasi Pertanyaan';
        $data['assign_js'] = '';
        load_view('config_pertanyaan/tb_relasi_pertanyaan_bobot_list', $data);
    }

    public function read($id,$kode_pertanyaan)
    {
        $row = $this->Config_pertanyaan_model->get_by_id($id);
        if ($row) {
            $data = array(
         		'id_relasi_pertanyaan_bobot' => $row->id_relasi_pertanyaan_bobot,
         		'kode_relasi_pertanyaan_bobot' => $row->kode_relasi_pertanyaan_bobot,
         		'kode_pertanyaan' => $row->kode_pertanyaan,
         		'kode_jawaban' => $row->kode_jawaban,
         		'bobot' => $row->bobot,
      	    );
            $data['site_title'] = 'Config_pertanyaan';
            $data['title'] = 'Config_pertanyaan';
            $data['assign_js'] = '';
            load_view('config_pertanyaan/tb_relasi_pertanyaan_bobot_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('config_pertanyaan'));
        }
    }

    public function create($a="")
    {
      $kode_terakhir = $this->Config_pertanyaan_model->get_query("SELECT kode_relasi_pertanyaan_bobot FROM v_pertanyaan_bobot m1 ORDER BY m1.id_relasi_pertanyaan_bobot DESC LIMIT 1")->row();
      $data = array(
         'button' => 'Create',
         'action' => site_url('config_pertanyaan/create_action'),
         'id_relasi_pertanyaan_bobot' => set_value('id_relasi_pertanyaan_bobot'),
         'kode_relasi_pertanyaan_bobot' => $kode_terakhir->kode_relasi_pertanyaan_bobot+1,
         'kode_pertanyaan' => $a,
         'kode_jawaban' => set_value('kode_jawaban'),
         'bobot' => set_value('bobot'),
      );

      $tb_pertanyaan=$this->App_model->get_query("SELECT * FROM tb_pertanyaan ")->result();

      $data['tb_pertanyaan']=$tb_pertanyaan;
      $tb_jawaban=$this->App_model->get_query("SELECT * FROM tb_jawaban ")->result();

      $data['tb_jawaban']=$tb_jawaban;
      $data['site_title'] = 'Config_pertanyaan';
      $data['title'] = 'Config_pertanyaan';
      $data['assign_js'] = '';
      $data['assign_js'] = '';
      load_view('config_pertanyaan/tb_relasi_pertanyaan_bobot_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_relasi_pertanyaan_bobot' => $this->input->post('kode_relasi_pertanyaan_bobot',TRUE),
		'kode_pertanyaan' => $this->input->post('kode_pertanyaan',TRUE),
		'kode_jawaban' => $this->input->post('kode_jawaban',TRUE),
		'bobot' => $this->input->post('bobot',TRUE),
	    );

            $this->Config_pertanyaan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('config_pertanyaan/konfigurasi/'.$this->input->post('kode_pertanyaan',TRUE)));
        }
    }

    public function update($id)
    {
        $row = $this->Config_pertanyaan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('config_pertanyaan/update_action'),
        		'id_relasi_pertanyaan_bobot' => set_value('id_relasi_pertanyaan_bobot', $row->id_relasi_pertanyaan_bobot),
        		'kode_relasi_pertanyaan_bobot' => set_value('kode_relasi_pertanyaan_bobot', $row->kode_relasi_pertanyaan_bobot),
        		'kode_pertanyaan' => set_value('kode_pertanyaan', $row->kode_pertanyaan),
        		'kode_jawaban' => set_value('kode_jawaban', $row->kode_jawaban),
        		'bobot' => set_value('bobot', $row->bobot),
        	);
            $data['site_title'] = 'Config_pertanyaan';
            $data['title'] = 'Config_pertanyaan';
            $data['assign_js'] = '';
            load_view('config_pertanyaan/tb_relasi_pertanyaan_bobot_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('config_pertanyaan/konfigurasi/'.$this->input->post('kode_pertanyaan',TRUE)));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_relasi_pertanyaan_bobot', TRUE));
        } else {
            $data = array(
		'kode_relasi_pertanyaan_bobot' => $this->input->post('kode_relasi_pertanyaan_bobot',TRUE),
		'kode_pertanyaan' => $this->input->post('kode_pertanyaan',TRUE),
		'kode_jawaban' => $this->input->post('kode_jawaban',TRUE),
		'bobot' => $this->input->post('bobot',TRUE),
	    );

            $this->Config_pertanyaan_model->update($this->input->post('id_relasi_pertanyaan_bobot', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('config_pertanyaan/konfigurasi/'.$this->input->post('kode_pertanyaan',TRUE)));
        }
    }

    public function delete($id,$kode_pertanyaan)
    {
        $row = $this->Config_pertanyaan_model->get_by_id($id);
        if ($row) {
            $this->Config_pertanyaan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('config_pertanyaan/konfigurasi/'.$kode_pertanyaan));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('config_pertanyaan/konfigurasi/'.$kode_pertanyaan));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_relasi_pertanyaan_bobot', 'kode relasi pertanyaan bobot', 'trim|required');
	$this->form_validation->set_rules('kode_pertanyaan', 'kode pertanyaan', 'trim|required');
	$this->form_validation->set_rules('kode_jawaban', 'kode jawaban', 'trim|required');
	$this->form_validation->set_rules('bobot', 'bobot', 'trim|required');

	$this->form_validation->set_rules('id_relasi_pertanyaan_bobot', 'id_relasi_pertanyaan_bobot', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_relasi_pertanyaan_bobot.xls";
        $judul = "tb_relasi_pertanyaan_bobot";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Relasi Pertanyaan Bobot");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pertanyaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Jawaban");
	xlsWriteLabel($tablehead, $kolomhead++, "Bobot");

	foreach ($this->Config_pertanyaan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_relasi_pertanyaan_bobot);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pertanyaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_jawaban);
	    xlsWriteNumber($tablebody, $kolombody++, $data->bobot);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */
