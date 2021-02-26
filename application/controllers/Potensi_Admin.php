<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Potensi_Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		is_logged_in();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('potensi_model');
	}

	public function index()
	{
		//Form validation
		$this->form_validation->set_rules(
			'kategori',
			'Nama kategori',
			'required',
			array(
				'required' => '%s wajib diisi'
			)
		);

		$data['title'] = "Potensi";
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$data['potensi'] = $this->potensi_model->get_all_potensi($this->potensi_model->count_potensi(), 0);
		$data['kategori'] = $this->potensi_model->get_all_kategori();

		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/potensi/list', $data);
		$this->load->view('dashboard/template/footer');
		if ($this->form_validation->run() == FALSE) {
		} else {

			$this->tambah_kategori();

			redirect('admin/potensi');
		}
	}

	private function upload_gambar($file, $id)
	{

		if ($file['name']) {

			$config['upload_path']          = './assets/img/potensi/';
			$config['allowed_types']        = 'png|jpg|gif|jpeg';
			$config['overwrite']			= TRUE;
			$config['file_name']			= 'potensi-' . $id . '-' . $file['name'] . '.jpg';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('gambar')) {

				return $this->upload->data('file_name');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');

				redirect('admin/potensi/tambah');
			}
		}
	}

	public function tambah()
	{
		//Form validation
		$this->form_validation->set_rules(
			'judul',
			'Judul',
			'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);

		$this->form_validation->set_rules(
			'konten',
			'Konten',
			'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);

		if ($this->form_validation->run() == FALSE) {

			$data['title'] = "Tambah Potensi";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['kategori'] = $this->potensi_model->get_all_kategori();

			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/potensi/tambah', $data);
			$this->load->view('dashboard/template/footer');
		} else {

			$last_id = ($this->potensi_model->cek_last_id()->id !== null) ? $this->potensi_model->cek_last_id()->id + 1 : 0;

			$judul = $this->input->post('judul');
			$slug = $last_id . '-' . url_title($judul, 'dash', TRUE);
			$gambar = $this->upload_gambar($_FILES['gambar'], $last_id);

			if ($_FILES['gambar']['error'] == 4) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Gambar tidak boleh kosong</div>');
				redirect('admin/potensi/tambah');
			}

			$data = array(
				'judul' => $judul,
				'gambar' => $gambar,
				'kategori_id' => $this->input->post('kategori_id'),
				'konten' => $this->input->post('konten'),
				'tanggal_dibuat' => date("Y/m/d H:i:s"),
				'slug' => $slug,
				'arsipkan' => 0,
				'dipost_oleh' => $this->session->userdata('id')
			);

			if ($this->potensi_model->tambah($data)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Potensi baru <strong>berhasil</strong> diterbitkan</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Potensi baru <strong>gagal</strong> diterbitkan</div>');
			}
			redirect('admin/potensi');
		}
	}

	public function hapus($id)
	{

		$gbr = $this->potensi_model->get_gambar($id);
		unlink(FCPATH . 'assets/img/potensi/' . $gbr[0]);

		if ($this->potensi_model->hapus($id)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Potensi <strong>berhasil</strong> dihapus</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Potensi <strong>gagal</strong> dihapus</div>');
		}

		redirect('admin/potensi');
	}

	public function edit($slug)
	{
		//Form validation
		$this->form_validation->set_rules(
			'judul',
			'Judul',
			'required|max_length[128]',
			array(
				'required' => '%s tidak boleh kosong',
				'max_length' => '%s terlalu panjang. Maksimal 128 karakter.'
			)
		);

		$this->form_validation->set_rules(
			'konten',
			'Konten',
			'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);

		if ($this->form_validation->run() == FALSE) {

			$data['title'] = "Edit Potensi";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['kategori'] = $this->db->get('kategori_potensi')->result_array();
			$data['potensi'] = $this->potensi_model->get_potensi($slug);

			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/potensi/edit', $data);
			$this->load->view('dashboard/template/footer');
		} else {
			$id = $this->input->post('id');

			$judul = $this->input->post('judul');
			$s = $id . '-' . url_title($judul, 'dash', TRUE);

			$data = array(
				'kategori_id' => $this->input->post('kategori_id'),
				'judul' => $judul,
				'konten' => $this->input->post('konten'),
				'slug' => $s
			);

			if ($_FILES["gambar"]["error"] == 4) {

				$data['gambar'] = $this->input->post('gambar_lama');
			} else {
				$gbr = $this->input->post('gambar_lama');
				unlink(FCPATH . 'assets/img/potensi/' . $gbr);

				$data['gambar'] = $this->upload_gambar($_FILES['gambar'], $id);
			}

			if ($this->potensi_model->edit($slug, $data)) {

				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Potensi <strong>berhasil</strong> diperbarui</div>');
			}

			redirect('admin/potensi');
		}
	}

	// ===================================================
	// KATEGORI
	// ===================================================

	private function tambah_kategori()
	{
		$kategori = $this->input->post('kategori');

		if ($this->potensi_model->tambah_kategori($kategori)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kategori baru <strong>berhasil</strong> ditambahkan</div>');
		}
	}

	public function hapus_kategori($id)
	{
		$this->potensi_model->hapus_kategori($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kategori <strong>berhasil</strong> dihapus</div>');

		redirect('admin/potensi');
	}

	public function edit_kategori()
	{
		$id = $this->input->post('id');
		$kategori = $this->input->post('kategori');

		for ($i = 0; $i < count($id); $i++) {

			$kat = $kategori[$i];

			$this->potensi_model->edit_kategori($id[$i], $kategori[$i]);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kategori <strong>berhasil</strong> diperbarui</div>');

		redirect('admin/potensi');
	}
}
