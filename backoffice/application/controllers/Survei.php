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
            $this->load->library('PHPExcel');
            $this->template = './template/survei.xlsx';
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
      // untuk filtering berdasarkan tanggal
      // echo "SELECT * FROM v_peserta_survei WHERE kode_tahun_survei='2017' AND (tgl_survei>='2017-01-01' and tgl_survei<='2017-12-30')";
      // end
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
          'tgl_survei' => $key->tgl_survei,
          'data' => $data_survey
        );
      }
      $data['site_title'] = 'Hitung IKM';
      $data['title'] = 'Tabulasi Data '.$tahun;
      $data['data_survey'] = $data_peserta;
      $data['data_hasil_hitung'] = $data_hasil_hitung;
      $data['jumlah_unsur'] = $jumlah_unsur;
      $data['tahun'] = $tahun;
      $data['unsur_pelayanan'] = $unsur_pelayanan;

      $data['assign_js'] ='survei/js/index.js';
      load_view('survei/peserta_survei', $data);
    }

    public function cetak_survei($tahun=''){
      $this->benchmark->mark('mulai');
      date_default_timezone_set('UTC');
      $objPHPExcel = PHPExcel_IOFactory::load($this->template);

      //SET SHEET KRS
      $objPHPExcel->setActiveSheetIndex(0);
      $objPHPExcel->getActiveSheet()->setCellValue('A2', $tahun);

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

      // echo json_encode($data_peserta);

      $baseRow = 7;
      $arr_az = range('D','Q');
      foreach($data_peserta as $r => $dataRow) {
        $row = $baseRow + $r;
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $r+1)
                  ->setCellValue('B'.$row, $dataRow['kode_peserta_survei'])
                  ->setCellValue('C'.$row, $dataRow['umur']);
        foreach ($arr_az as $chr => $cr) {
          foreach ($dataRow['data'] as $key => $value) {
            $objPHPExcel->getActiveSheet()->setCellValue($cr.$row, $dataRow['data'][$chr]['bobot']);
          }
        }
        $temp_row = 1+$row;
        $hitung_row = 2+$temp_row;
      }
      
      $baseRow1 = $hitung_row;
      $arr_az = range('D','Q');
      $a=0;

      $ket = array(
        'nrr_tertimbang' => "NRR Tertimbang / Unsur",
        'nrr_unsur' => "NRR / Unsur",
        'total_bobot' => "Semua Nilai Unsur",
        'unsur_pelayanan' => "Keterangan",
      );
      echo json_encode($data_hasil_hitung);
      foreach($ket as $k => $kk){
        $row1 = $baseRow1 + $k;
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($row1,1);
        $objPHPExcel->getActiveSheet()->setCellValue('A'.$row1, $kk)
                ->setCellValue('B'.$row1, $kk);

        foreach ($arr_az as $chr => $cr) {
            $objPHPExcel->getActiveSheet()->setCellValue($cr.$row1, $data_hasil_hitung[$chr][$k]);
        }
        $temp_row1 = 1+$row1;
        $ttd_row = 10+$temp_row1;
      }
      $tgl_row = $ttd_row-1;
      $hasil_row = $ttd_row-4;
      $objPHPExcel->getActiveSheet()->setCellValue('B'.$hasil_row, "Nilai IKM");
      $objPHPExcel->getActiveSheet()->setCellValue('C'.$hasil_row, number_format($nilai_ikm,3));
      $objPHPExcel->getActiveSheet()->setCellValue('N'.$tgl_row, date('d F Y'));
      $objPHPExcel->getActiveSheet()->setCellValue('N'. $ttd_row, "TESTING");
      $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);

      $filename = time().'-survei.xlsx';

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      // $objWriter->save('php://output');
      $temp_tulis = $objWriter->save('temps/'.$filename);
      $this->benchmark->mark('selesai');
      $time_eks = $this->benchmark->elapsed_time('mulai', 'selesai');
      if ($temp_tulis==NULL) {
          $this->session->set_flashdata('message', "<div class=\"bs-callout bs-callout-success\">
              File berhasil digenerate dalam waktu <strong>".$time_eks." detik</strong>. <br />Klik <a href=\"".base_url()."index.php/file/download/".$filename."\">disini</a> untuk download file
            </div>");
          redirect(site_url('survei/hitung_survei/'.$tahun));
      } else {
          $this->session->set_flashdata('message',"<div class=\"bs-callout bs-callout-danger\">
              <h4>Error</h4>File tidak bisa digenerate. Folder 'temps' tidak ada atau tidak bisa ditulisi.
            </div>" );
      }
    }
}

/* PTT */
