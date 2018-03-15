<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        else{
            $this->load->model('Admin_model');
            $this->load->library('form_validation');
        }
    }

    public function index()
    {
        $admin = $this->Admin_model->get_all();
        $data = array(
            'admin_data' => $admin
        );
        $data['site_title'] = 'Admin';
        $data['title'] = 'Admin';
        $data['assign_js'] ='admin/js/index.js';
        load_view('admin/tb_admin_list', $data);
    }

    public function read($id)
    {
        $row = $this->Admin_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_admin' => $row->id_admin,
		'username' => $row->username,
		'password' => $row->password,
	    );
            $data['site_title'] = 'Admin';
            $data['title'] = 'Admin';
            $data['assign_js'] = 'admin/js/index.js';
            load_view('admin/tb_admin_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin'));
        }
    }

    public function create()
    {

      $data = array(
          'button' => 'Create',
          'action' => site_url('admin/create_action'),
    	    'id_admin' => set_value('id_admin'),
    	    'username' => set_value('username'),
    	    'password' => set_value('password'),
    	);
      $data['site_title'] = 'Admin';
      $data['title'] = 'Tambahkan Data Admin';
      $data['assign_js'] = 'admin/js/index.js';
      load_view('admin/tb_admin_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
          		'username' => $this->input->post('username',TRUE),
          		'password' => base64_encode($this->input->post('password',TRUE)),
        	  );
            $this->Admin_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Tambah Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('admin'));
        }
    }

    public function update($id)
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $data = array(
              'button' => 'Update',
              'action' => site_url('admin/update_action'),
          		'id_admin' => set_value('id_admin', $row->id_admin),
          		'username' => set_value('username', $row->username),
          		'password' => set_value('password', base64_decode($row->password)),
          	);
            $data['site_title'] = 'Admin';
            $data['title'] = 'Ubah Data Admin';
            $data['assign_js'] = 'admin/js/index.js';
            load_view('admin/tb_admin_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('admin'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_admin', TRUE));
        } else {
            $data = array(
        		'username' => $this->input->post('username',TRUE),
        		'password' => base64_encode($this->input->post('password',TRUE)),
	           );

            $this->Admin_model->update($this->input->post('id_admin', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Update Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('admin'));
        }
    }

    public function delete($id)
    {
        $row = $this->Admin_model->get_by_id($id);

        if ($row) {
            $this->Admin_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert bg-success" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Berhasil Hapus Data <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('admin'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Data Tidak Ditemukan <a href="#" class="pull-right"> <em class="fa fa-lg fa-close"></em></a></div>');
            redirect(site_url('admin'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');

	$this->form_validation->set_rules('id_admin', 'id_admin', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_admin.xls";
        $judul = "tb_admin";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");

	foreach ($this->Admin_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* PTT */
