<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		is_logged_in();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('berita_model');
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

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Berita";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['berita'] = $this->berita_model->get_all_berita($this->berita_model->count_berita(), 0);
			$data['kategori'] = $this->berita_model->get_all_kategori();

			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/berita/list_berita', $data);
			$this->load->view('dashboard/template/footer');
		} else {

			$this->tambah_kategori();

			redirect('admin/berita');
		}
	}

	public function upload_gambar($file, $id)
	{

		if ($file['name']) {

			$config['upload_path']          = './assets/img/berita/';
			$config['allowed_types']        = 'png|jpg|gif|jpeg';
			$config['overwrite']			= TRUE;
			$config['file_name']			= 'berita-' . $id . '-' . $file['name'] . '.jpg';

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('gambar')) {

				return $this->upload->data('file_name');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');

				redirect('admin/berita/tambah');
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

			$data['title'] = "Tambah Berita";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['kategori'] = $this->berita_model->get_all_kategori();

			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/berita/tambah', $data);
			$this->load->view('dashboard/template/footer');
		} else {

			$last_id = $this->berita_model->cek_last_id()->id++;

			$judul = $this->input->post('judul');
			$slug = $last_id . '-' . url_title($judul, 'dash', TRUE);
			$gambar = $this->upload_gambar($_FILES['gambar'], $last_id);

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

			if ($this->berita_model->tambah_berita($data)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berita baru <strong>berhasil</strong> diterbitkan</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berita <strong>gagal</strong> diterbitkan</div>');
			}
			redirect('admin/berita');
		}
	}

	public function hapus($id)
	{

		$gbr = $this->berita_model->get_gambar($id);
		unlink(FCPATH . 'assets/img/berita/' . $gbr);

		if ($this->berita_model->hapus($id)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berita <strong>berhasil</strong> dihapus</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berita <strong>gagal</strong> dihapus</div>');
		}

		redirect('admin/berita');
	}

	public function edit($slug)
	{
		//Form validation
		$this->form_validation->set_rules(
			'judul',
			'Judul',
			'required|max_length[140]',
			array(
				'required' => '%s tidak boleh kosong',
				'max_length' => '%s terlalu panjang. Maksimal 140 karakter.'
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

			$data['title'] = "Edit Berita";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['kategori'] = $this->db->get('kategori_berita')->result_array();
			$data['berita'] = $this->berita_model->get_berita($slug);

			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/berita/edit', $data);
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

			if ($this->berita_model->edit($slug, $data)) {

				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berita <strong>berhasil</strong> diperbarui</div>');
			}


			redirect('admin/berita');
		}
	}

	public function arsipkan($id, $val)
	{

		$this->berita_model->arsipkan($id, $val);

		if ($val == 1) {
			//jika akan diarsipakan
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berita <strong>diarsipkan</strong></div>');
		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Berita <strong>batal</strong> diarsipkan</div>');
		}

		redirect('admin/berita/edit/' . $id);
	}

	// ===================================================
	// KATEGORI
	// ===================================================

	private function tambah_kategori()
	{
		$kategori = $this->input->post('kategori');

		if ($this->berita_model->tambah_kategori($kategori)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kategori baru <strong>berhasil</strong> ditambahkan</div>');
		}
	}

	public function hapus_kategori($id)
	{
		$this->berita_model->hapus_kategori($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kategori <strong>berhasil</strong> dihapus</div>');

		redirect('admin/berita');
	}

	public function edit_kategori()
	{
		$id = $this->input->post('id');
		$kategori = $this->input->post('kategori');

		for ($i = 0; $i < count($id); $i++) {

			$data = array(
				'id' => $id[$i],
				'kategori' => $kategori[$i]
			);

			$this->berita_model->edit_kategori($data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kategori <strong>berhasil</strong> diperbarui</div>');

		redirect('admin/berita');
	}
}
