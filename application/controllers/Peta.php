<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peta extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('peta_model');
		$this->load->model('berita_model');
		$this->load->model('user_model');
		$this->load->model('profil_model');
	}

	public function index() {
		$data['title'] = 'Peta Wilayah Desa';
		$data['deskripsi'] = $this->db->get('deskripsi')->row_array();
		$data['navbar'] = get_navbar(); //dari helper
		$data['kontak'] = $this->user_model->get_kontak();
		$data['berita_f'] = $this->berita_model->get_berita_terbaru(2);
		$data['profil'] = $this->profil_model->get_profil();

		$this->load->view('template/header', $data);
		$this->load->view('maps', $data);
		$this->load->view('template/footer', $data);
	}

	public function get_dukuh() {
		$id = $this->input->post('id');
		$data = $this->peta_model->get_dukuh($id);

	    echo json_encode($data);
	}

	public function get_rt() {
		$rt = $this->input->post('rt');
		$dukuh = $this->input->post('dukuh');
		$data = $this->peta_model->get_rt($rt,$dukuh);

	    echo json_encode($data);
	}

}