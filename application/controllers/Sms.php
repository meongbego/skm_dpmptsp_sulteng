<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {
	function __construct()
	{
			parent::__construct();
	}

  public function index()
  {
    $otherdb  = $this->load->database('otherdb', TRUE);

    $isi = "Assalamualaiku wr.wb.\n Kepada YTH. Pemohon yg telah melakukan/sementara proses perizinan di DPMPTSP SULTENG agar kiranya mengisi Survei Kegiatan Masyarakat(SKM), Agar proses pelayanan dapat lebih baik dari sebelumnya, SKM dapat di isi di http://siidat.sultengprov.go.id:8080 silahkan melengkapi data (Privasi mengenai data anda merupakan kerahasiaan bagi kami) kemudian tahun survei 2018 kemudian klik submit dilanjutkan dengan mengisi soal pertanyan surve, atas partisipasinya kami ucapkan terimakasih";
    $data = $otherdb->query("SELECT * FROM sms")->result();
    // $a = $this->send("081247930699",$isi);

    foreach ($data as $key) {
      $cek_sms = $this->send("082271097636",$isi);
      if ($cek_sms) {
        echo json_encode($cek_sms)."<br>";
      }
    }
  }

  public function send($no='',$isi='')
  {
    $ci = $this->load->library('curl');
    $nomorHP = $no;

    $url = 'https://alpha.zenziva.net/apps/smsapi.php';
    $ci->curl->create($url);
    $config_pesan = array(
        'userkey' => 'n7rohs', //
        'passkey' => 'perizinan',
        'nohp' => $nomorHP,
        'pesan' => $isi
    );
    $ci->curl->post($config_pesan);
    return $ci->curl->execute();
  }
}
