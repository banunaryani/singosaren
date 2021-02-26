<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peta_Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->model('peta_model');
	}

	public function index()
	{
		$data['title'] = "Kelola Data Peta";
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$data['dukuh'] = $this->peta_model->get_all_dukuh();
		$data['rt'] = $this->peta_model->get_all_rt();
		$data['persil'] = $this->peta_model->get_all_persil();


		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/peta', $data);
		$this->load->view('dashboard/template/footer');
	}

	public function get_dukuh()
	{
		$id = $this->input->post('id');
		$data = $this->peta_model->get_dukuh($id);

		echo json_encode($data);
	}

	public function edit_pedukuhan()
	{
		$id = $this->input->post('id');

		$data = array(
			'dukuh' => $this->input->post('pedukuhan'),
			'penduduk' => $this->input->post('penduduk'),
			'luas' => $this->input->post('luas')
		);

		if ($this->peta_model->replace_pedukuhan($id, $data)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Pedukuhan <strong>berhasil</strong> diperbarui</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Pedukuhan <strong>gagal</strong> diperbarui</div>');
		}

		redirect('admin/peta');
	}

	public function get_rt()
	{
		$rt = $this->input->post('rt');
		$dukuh = $this->input->post('dukuh');
		$data = $this->peta_model->get_rt($rt, $dukuh);

		echo json_encode($data);
	}

	public function edit_rt()
	{

		$rt = $this->input->post('rt');
		$dukuh = $this->input->post('pilihPedukuhan');
		$data = array(
			'penduduk' => $this->input->post('penduduk'),
			'luas' => $this->input->post('luas')
		);

		if ($this->peta_model->replace_rt($rt, $dukuh, $data)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>RT <strong>berhasil</strong> diperbarui</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>RT <strong>gagal</strong> diperbarui</div>');
		}

		redirect('admin/peta');
	}

	public function get_persil()
	{
		$no = $this->input->post('no');
		$rt = $this->input->post('rt');
		$data = $this->peta_model->get_persil($no, $rt);

		echo json_encode($data);
	}

	public function edit_persil()
	{

		$data = array(
			'no' => $this->input->post('persil'),
			'rt' => $this->input->post('rt'),
			'dukuh' => $this->input->post('pilihPedukuhan'),
			'rw' => $this->input->post('rw'),
			'penduduk' => $this->input->post('penduduk'),
			'luas' => $this->input->post('luas')
		);

		var_dump($data);

		var_dump($this->peta_model->replace_persil($data));

		if ($this->peta_model->replace_persil($data)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Persil <strong>berhasil</strong> diperbarui</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Persil <strong>gagal</strong> diperbarui</div>');
		}

		redirect('admin/peta');
	}
}
