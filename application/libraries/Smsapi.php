<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Smsapi {
  public function send($no='',$isi='')
  {
    $ci = &get_instance();
    $ci->load->library('curl');
    if ($isi=='') {
      $isi_sms = "TERIMA KASIH PENDAFTARAN ANDA KAMI TERIMA, Mohon Menunggu Sms Berikutnya Jika Izin Telah Terbit -|";
    }
    else {
      $isi_sms = $isi." -|";
    }
    $nomorHP = $no;

    $url = 'https://alpha.zenziva.net/apps/smsapi.php';
    $ci->curl->create($url);
    $config_pesan = array(
        'userkey' => 'n7rohs', //
        'passkey' => '',
        'nohp' => $nomorHP,
        'pesan' => $isi_sms
    );
    $ci->curl->post($config_pesan);
    return $ci->curl->execute();
  }
}
