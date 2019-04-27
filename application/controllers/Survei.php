<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survei extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('App_model');
	}

	public function index()
	{
		$data_pendidikan = $this->App_model->get_query("SELECT * FROM tb_pendidikan")->result();
		$data_pekerjaan = $this->App_model->get_query("SELECT * FROM tb_pekerjaan")->result();
		$data_tahun = $this->App_model->get_query("SELECT * FROM tb_tahun_survei")->result();
		$data_status = $this->App_model->get_query("SELECT * FROM tb_status_survei")->result();
		$data_pegawai = $this->App_model->get_query("SELECT * FROM tb_pegawai")->result();


		
		
		$data['breadcrumb']='Survei';
		$data['title']='SKM DPMPTSP';
		$data['dt_pendidikan']=$data_pendidikan;
		$data['dt_pekerjaan']=$data_pekerjaan;
		$data['dt_tahun']=$data_tahun;
		$data['dt_pegawai']=$data_pegawai;
		$data['dt_status']=$data_status;
		$data['assign_js'] = 'survei/js/index.js';	  
		load_beranda('survei/survei',$data);
	}
	public function save_biodata()
	{
		$umur = $this->input->post('umur');
		$pekerjaan =$this->input->post('pekerjaan');
		$pendidikan = $this->input->post('pendidikan');
		$jenkel = $this->input->post('jenkel');
		$status_survei = $this->input->post('status_survei');
		$tahun_survei = $this->input->post('tahun_survei');
		$pegawai = $this->input->post('pegawai');

		$t_data = $this->App_model->get_query("SELECT * FROM tb_peserta m1 ORDER BY m1.`id_peserta` DESC LIMIT 1")->row();
		$ko_data = $t_data->id_peserta+1;
		if ($t_data) {
			$ko_data = $t_data->id_peserta+1;
		}
		else {
			$ko_data = 1;
		}
		$no_peserta = "PP00".$ko_data;
		$data = array(
			'no_peserta' => $no_peserta,
			'umur' => $umur,
			'jenkel' => $jenkel,
			'kode_pendidikan' => $pendidikan,
			'kode_pekerjaan' => $pekerjaan
		);

		$t_data_2 = $this->App_model->get_query("SELECT * FROM tb_peserta_survei m1 ORDER BY m1.`id_peserta_survei` DESC LIMIT 1")->row();

		if ($t_data_2) {
			$ko_data2 = $t_data_2->id_peserta_survei+1;
		}
		else {
			$ko_data2 = 1;
		}
		$data2 = array(
			'kode_peserta_survei' => "PS00".$ko_data2,
			'status_isi' => 'T',
			'kode_pegawai' => $pegawai,
			'kode_tahun_survei' => $tahun_survei,
			'kode_status_survei' => $status_survei,
			'kode_peserta' => "PP00".$ko_data
		);

		$insert = $this->App_model->insertRecord('tb_peserta',$data);
		$insert2 = $this->App_model->insertRecord('tb_peserta_survei',$data2);
		if ($insert && $insert2) {
			//redirect ke page survei
			redirect(site_url('survei/step2/PS00'.$ko_data2.''));
		}
		else {
			//redirect ke page biodata
			echo "Data Tidak Simpan";
		}

	}


	public function step2($k)
	{
		$datasoal=array();
		// $soal = $this->App_model->get_query("SELECT * FROM v_pertanyaan")->result();
		$soal = $this->App_model->get_query("SELECT * FROM v_pertanyaan")->result();
		foreach ($soal as $key) {
			$soal_bobot = $this->App_model->get_query("SELECT m1.id_relasi_pertanyaan_bobot,m1.kode_relasi_pertanyaan_bobot,m1.kode_jawaban,m1.nm_jawaban,m1.bobot FROM v_pertanyaan_bobot m1 WHERE m1.kode_pertanyaan='".$key->kode_pertanyaan."'")->result();
			$datasoal[]=array(
				'nm_soal' => $key->ket_pertanyaan,
				'kode_pertanyaan' => $key->kode_pertanyaan,
				'jawaban' => $soal_bobot,
			);
		}
		// echo json_encode($datasoal);
		$data['breadcrumb']='Survei';
		$data['title']='SKM DPMPTSP';
		$data['data_soal']=$datasoal;
		$data['assign_js'] = 'survei/js/index.js';
		load_beranda('survei/soal',$data);
	}

	public function finish()
	{
		$soal = $this->App_model->get_query("SELECT * FROM v_pertanyaan")->result();

		$t_data_2 = $this->App_model->get_query("SELECT * FROM tb_survei m1 ORDER BY m1.`id_survei` DESC LIMIT 1")->row();

		if ($t_data_2) {
			$ko_data2 = $t_data_2->id_survei+1;
		}
		else {
			$ko_data2 = 1;
		}
		$kode_survei = "PV00".$ko_data2;
		$status = array();
		foreach ($soal as $key) {
			$data = array(
					'kode_survei' => $kode_survei++,
					'kode_peserta_survei' => $this->input->post('kode_peserta_survei'),
					'kode_relasi_pertanyaan_bobot' => $this->input->post($key->kode_pertanyaan)
			);

			$insert = $this->App_model->insertRecord('tb_survei',$data);
			if (!$insert) {
				$status [] = array(
					'kode_peserta_survei' => $this->input->post('kode_peserta_survei'),
					'status' => 'Gagal',
				);
			}
			else {
				$status [] = array(
					'kode_peserta_survei' => $this->input->post('kode_peserta_survei'),
					'status' => 'Berhasil',
				);
			}
		}
		$data1 = array(
			'status_isi' => 'Y'
		);

		$this->App_model->update("tb_peserta_survei","kode_peserta_survei",$this->input->post('kode_peserta_survei'),$data1);

		$this->session->set_flashdata('message', 'Terima Kasih Telah Berpartisipasi');
		redirect(site_url('beranda'));
	}
}
