<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Survei extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        else{
            $this->load->model('Survei_model');
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
      $data['site_title'] = 'Tahun survey';
      $data['title'] = 'Tahun survey';
      $data['assign_js'] ='survei/js/index.js';
      load_view('survei/tahun_survei', $data);
    }

    public function hitung_survei($tahun='')
    {
      $peserta_survey = $this->Survei_model->get_query("SELECT * FROM v_peserta_survei WHERE kode_tahun_survei='".$tahun."'")->result();

      $unsur_pelayanan = $this->Survei_model->get_query("SELECT * FROM tb_kategori_pertanyaan ")->result();

      $jumlah_peserta = count($peserta_survey);
      $jumlah_unsur = count($unsur_pelayanan);
      $data_peserta=array();
      $data_hitung=array();
      $nrr_unsur=0;
      $total_n_tertimbang =0;
      $nilai_ikm = 0;
      foreach ($unsur_pelayanan as $key) {
        $hasil_survey1 = $this->Survei_model->get_query("SELECT * FROM v_survei WHERE kode_tahun_survei='".$tahun."' AND kode_kategori_pertanyaan='".$key->kode_kategori_pertanyaan."'")->result();
        $data_survey1 = array();
        $total_bobot=0;
        foreach ($hasil_survey1 as $key1) {
          $total_bobot += $key1->bobot;
        }
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
      $data_hasil_hitung = $data_hitung;
      $nilai_ikm = $total_n_tertimbang * 25;

      $data['total_tertimbang'] = $total_n_tertimbang;
      $data['nilai_ikm'] = $nilai_ikm;

      foreach ($peserta_survey as $key) {
        $hasil_survey = $this->Survei_model->get_query("SELECT * FROM v_survei WHERE kode_tahun_survei='".$tahun."' AND kode_peserta_survei='".$key->kode_peserta_survei."'")->result();
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
          'data' => $data_survey
        );
      }
      $data['site_title'] = 'Hitung IKM';
      $data['title'] = 'Tabulasi Data '.$tahun;
      $data['data_survey'] = $data_peserta;
      $data['data_hasil_hitung'] = $data_hasil_hitung;
      $data['jumlah_unsur'] = $jumlah_unsur;
      $data['unsur_pelayanan'] = $unsur_pelayanan;

      $data['assign_js'] ='survei/js/index.js';
      load_view('survei/peserta_survei', $data);
    }
}

/* PTT */
