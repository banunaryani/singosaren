<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil_Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('profil_model');
	}

	public function index()
	{

		$data['title'] = "Profil Desa";
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$data['profil'] = $this->db->get('profil')->row_array();

		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/user/profil_desa', $data);
		$this->load->view('dashboard/template/footer');
	}

	public function update($kolom)
	{
		$input = $this->input->post($kolom);

		if ($this->profil_model->update($kolom, $input)) {

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $kolom . ' berhasil diperbarui</div>');

			redirect('admin/profil');
		}
	}

	public function update_pedukuhan()
	{

		$input = $this->input->post('pedukuhan'); //this is array

		if ($this->profil_model->update_pedukuhan(implode('-', $input))) {

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Struktur Organiasai berhasil diperbarui</div>');

			redirect('admin/profil');
		}
	}

	public function update_struktur()
	{
		$gbr_lama = $this->input->post('gambar_lama');

		if ($_FILES['gambar']['error'] == 4) {
			$gbr = $gbr_lama;
		} else {
			// unlink(FCPATH.'assets/img/profil_desa/'.$gbr_lama);

			$gbr = $this->upload_gambar($_FILES['gambar']);
		}

		$input = array(
			'struktur' => $this->input->post('struktur'),
			'gambar_struktur' => $gbr
		);

		if ($this->profil_model->update_struktur($input)) {

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Struktur Organiasai berhasil diperbarui</div>');

			redirect('admin/profil');
		}
	}

	public function update_visi_misi()
	{

		$input = array(
			'visi' => $this->input->post('visi'),
			'misi' => $this->input->post('misi')
		);

		if ($this->profil_model->update_visi_misi($input)) {

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Visi & Misi berhasil diperbarui</div>');

			redirect('admin/profil');
		}
	}

	private function upload_gambar($file)
	{

		if ($file['name']) {

			$config['upload_path']          = './assets/img/profil_desa/';
			$config['allowed_types']        = 'png|jpg|gif|jpeg';
			$config['overwrite']			= TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('gambar')) {

				return $this->upload->data('file_name');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');

				redirect('admin/profil');
			}
		}
	}
}
