<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('dashboard/template/footer');
	}
}
