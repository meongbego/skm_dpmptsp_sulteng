<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	private $user;
	private $pass;
	private $level;
	private $nama;
	private $nidn;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('App_model','app_model');

	}

	public function index()
	{
		//$this->login();
		// echo base64_decode("MTIzNDU=");
		if ($this->session->userdata('login')) {
				redirect('beranda');
		}
		else {
			$data['site_title'] = 'Please Login';
			$this->load->view('layout/login_view',$data);
		}
	}

	public function login()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('username','Username Anda','trim|required');
			$this->form_validation->set_rules('password','Password Anda','required');

			if ($this->form_validation->run() == TRUE) {
				$data = array('username' => $this->input->post('username', TRUE),'password' => base64_encode($this->input->post('password', TRUE)));
				$hasil = $this->app_model->cek_user($data);
				// echo json_encode($hasil->result());
				if ($hasil->num_rows() == 1) {
					foreach ($hasil->result() as $sess){
						$this->user = $sess->username;
						$this->pass = $sess->password;

					}
					$session = array('login' => TRUE,
									 'username' => $this->user
						);

						$this->session->sess_expiration = '1800'; //session timeout 15 minute
						$this->session->set_userdata($session);
						redirect('beranda');
				}
				else {
					redirect('auth');
				}
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Auth');
	}
}
