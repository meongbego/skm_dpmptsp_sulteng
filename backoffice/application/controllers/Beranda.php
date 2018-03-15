<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Beranda extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('login')) {
      redirect('auth');
    }
    else {
      $this->load->model('Admin_model');
      $this->load->model('App_model');
      $this->load->library('form_validation');
    }
  }

  public function index()
  {

    $data['site_title'] = 'Beranda';
    $data['title'] = 'Selamat Datang Di Back Office SKM DPMPTSP SULTENG';
    $data['assign_js'] = 'beranda/js/index.js';
    load_view('beranda/beranda', $data);
  }

  public function setting()
  {

    $data['site_title'] = 'Pengaturan';
    $data['title'] = 'Pengaturan Umum Aplikasi';
    $data['assign_js'] = 'beranda/js/index.js';
    load_view('beranda/pengaturan', $data);
  }
}
