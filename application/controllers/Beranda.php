<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('App_model');
	}

	public function index()
	{
		$data_tahun = $this->App_model->get_query("SELECT * FROM tb_tahun_survei WHERE status='Y'")->result();
		$data_hitung=[];
		foreach ($data_tahun as $key_tgl ) {
			$peserta_survey = $this->App_model->get_query("SELECT * FROM v_peserta_survei WHERE kode_tahun_survei='".$key_tgl->kode_tahun_survei."'")->result();
			$unsur_pelayanan = $this->App_model->get_query("SELECT * FROM tb_kategori_pertanyaan ")->result();

			$jumlah_peserta = count($peserta_survey);
			$jumlah_unsur = count($unsur_pelayanan);
			$data_peserta=array();
			$data_hitung=array();
			$nrr_unsur=0;
			$total_n_tertimbang =0;
			$nilai_ikm = 0;
			foreach ($unsur_pelayanan as $key) {
				$hasil_survey1 = $this->App_model->get_query("SELECT * FROM v_survei WHERE kode_tahun_survei='".$key_tgl->kode_tahun_survei."' AND kode_kategori_pertanyaan='".$key->kode_kategori_pertanyaan."'")->result();
				$data_survey1 = array();
				$total_bobot=0;
				foreach ($hasil_survey1 as $key1) {
					$total_bobot += $key1->bobot;
				}
				if ($jumlah_peserta != 0){
					$nrr_unsur = $total_bobot / $jumlah_peserta;
					$n_tertimbang = $nrr_unsur * 0.071;
					$total_n_tertimbang += $n_tertimbang;
					$data_hitung[] = array(
					'unsur_pelayanan' => $key->kode_kategori_pertanyaan,
					'total_bobot' => $total_bobot,
					'nrr_unsur' => $nrr_unsur,
					'nrr_tertimbang' =>$n_tertimbang,
					);
				}
			}


			$data_hasil_hitung = $data_hitung;
			$nilai_ikm = $total_n_tertimbang * 25;

			$data['total_tertimbang'] = $total_n_tertimbang;
			$data['nilai_ikm'] = $nilai_ikm;

			foreach ($peserta_survey as $key) {
				$hasil_survey = $this->App_model->get_query("SELECT * FROM v_survei WHERE kode_tahun_survei='".$key_tgl->kode_tahun_survei."' AND kode_peserta_survei='".$key->kode_peserta_survei."'")->result();
				$data_survey = array();
				foreach ($hasil_survey as $key1) {
					$data_survey[] = array(
					'kode_survei' => $key1->kode_survei,
					'unsur_pelayanan' => $key1->kode_kategori_pertanyaan,
					'kode_tahun_survei' => $key1->kode_tahun_survei,
					'kode_jawaban' => $key1->kode_jawaban,
					'bobot' => $key1->bobot,
					);
				}

				$data_peserta[] = array(
					'kode_peserta_survei' => $key->kode_peserta_survei,
					'umur' => $key->umur,
					'tgl_survei' => $key->tgl_survei,
					'data' => $data_survey
				);
			}
			
			// $data_hitung[] = array(
			// 	"data_survey" => $data_peserta,
			// 	"data_hasil_hitung" => $data_hasil_hitung,
			// 	"jumlah_unsur" => $jumlah_unsur,
			// 	"tahun" => $key_tgl->kode_tahun_survei,
			// 	"unsur_pelayanan" => $unsur_pelayanan,

			// );
		$data['data_survey'] = $data_peserta;
		$data['data_hasil_hitung'] = $data_hasil_hitung;
		$data['jumlah_unsur'] = $jumlah_unsur;
		$data['tahun'] = $key_tgl->kode_tahun_survei;
		$data['nm_tahun'] = $key_tgl->nm_tahun;
		$data['unsur_pelayanan'] = $unsur_pelayanan;
		}
		// $data['data_survey'] = $data_peserta;
		// $data['data_hasil_hitung'] = $data_hasil_hitung;
		// $data['jumlah_unsur'] = $jumlah_unsur;
		// $data['tahun'] = $key_tgl->kode_tahun_survei;
		// $data['unsur_pelayanan'] = $unsur_pelayanan;
		// echo json_encode($data);
		
		$data['breadcrumb']='Halaman Utama';
		$data['title']='SKM DPMPTSP';
		$data['assign_js'] = 'beranda/js/index.js';
		load_beranda('beranda/beranda',$data);
	}
}
