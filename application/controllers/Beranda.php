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
		$data['breadcrumb']='Halaman Utama';
		$data['title']='SKM DPMPTSP';
		$data['assign_js'] = 'beranda/js/index.js';
		load_beranda('beranda/beranda',$data);
	}
}
