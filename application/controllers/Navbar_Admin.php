<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Navbar_Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->model('navbar_model');
	}

	public function index()
	{

		//tampilkan halaman
		$data['title'] = "Menu Navigasi";
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$data['navbar'] = $this->navbar_model->get_all_menu_submenu();

		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/user/navbar', $data);
		$this->load->view('dashboard/template/footer');
	}

	public function aktifkan_navbar($id, $val)
	{
		if (isset($val)) {

			$this->navbar_model->aktifkan($id, $val);

			if ($val == 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible mt-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Menu diaktifkan</div>');

				redirect('admin/navbar');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert_dismissible mt-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Menu dinonaktifkan</div>');
				redirect('admin/navbar');
			}
		}
	}

	public function edit_navbar($id)
	{
		$this->form_validation->set_rules(
			'navbar_menu',
			'Judul menu',
			'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);
		$this->form_validation->set_rules(
			'link_menu',
			'Link',
			'required|trim',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);
		$this->form_validation->set_rules(
			'urutan',
			'Urutan',
			'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Navbar';
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

			$data['menu'] = $this->navbar_model->get_menu($id);

			$data['submenu'] = $this->navbar_model->get_submenu($id);

			$data['jml'] = $this->navbar_model->count_navbar();

			$this->load->view('dashboard/template/header.php', $data);
			$this->load->view('dashboard/template/sidebar.php', $data);
			$this->load->view('dashboard/template/topbar.php', $data);
			$this->load->view('dashboard/user/edit_navbar.php', $data);
			$this->load->view('dashboard/template/footer.php');
		} else {

			//get all field navbar menu
			$data = array(
				'menu_nav' => $this->input->post('navbar_menu'),
				'link' => $this->input->post('link_menu'),
				'is_active' => $this->input->post('aktif'),
				'urutan' => $this->input->post('urutan')
			);

			//insert to db
			$this->navbar_model->edit($id, $data);

			$params = array(
				'id' => $this->input->post('id_submenu'),
				'nama' => $this->input->post('nama_submenu'),
				'link' => $this->input->post('link_submenu')
			);

			//if field submenu exist
			if (!empty(array_filter($params['nama'], 'strlen')) || !empty(array_filter($params['link'], 'strlen'))) {
				//tambah submenu param insert id
				$this->edit_submenu_navbar($id, $params);
			}

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Menu berhasil diperbarui</div>');

			redirect('admin/navbar');
		}
	}

	private function edit_submenu_navbar($id_nav, $params)
	{

		$all_sub = $this->navbar_model->get_all_submenu();

		$id = $params['id'];
		$nama = $params['nama'];
		$link = $params['link'];

		for ($i = 0; $i < count($nama); $i++) {

			$data = array(
				'navbar_menu' => $id_nav,
				'submenu' => $nama[$i],
				'link_submenu' => $link[$i]
			);

			// jika nama submenu sudah ada di db maka update aja
			if (in_array($id[$i], array_column($all_sub, 'id_submenu'))) {
				$this->navbar_model->edit_submenu($id[$i], $data);
			} else {
				$this->navbar_model->tambah_submenu($data);
			}
		}
	}

	public function tambah()
	{

		//validasi nama navbar dan lifnk
		$this->form_validation->set_rules(
			'navbar_menu',
			'Judul menu',
			'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);
		$this->form_validation->set_rules(
			'link_menu',
			'Link',
			'required|trim',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);
		$this->form_validation->set_rules(
			'urutan',
			'Urutan',
			'required|is_unique[navbar.urutan]',
			array(
				'is_unique' => 'Nomor urutan sudah terpakai. Pilih urutan lain!'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			//tampilkan halaman
			$data['title'] = "Tambah Menu Navigasi";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['navbar'] = $this->navbar_model->get_all_menu_submenu();
			$data['jml'] = $this->navbar_model->count_navbar();

			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/user/tambah_navbar', $data);
			$this->load->view('dashboard/template/footer');
		} else {

			//get all field navbar menu
			$data = array(
				'menu_nav' => $this->input->post('navbar_menu'),
				'link' => $this->input->post('link_menu'),
				'is_active' => 1,
				'urutan' => $this->input->post('urutan')
			);

			//insert to db
			$this->navbar_model->tambah($data);

			//get id this menu $insertId = $this->db->insert_id()
			$id_menu = $this->navbar_model->get_insert_id();

			$nama_sub = $this->input->post('nama_submenu');
			$link_sub = $this->input->post('link_submenu');

			//if field submenu exist
			if (!empty(array_filter($nama_sub, 'strlen')) || !empty(array_filter($link_sub, 'strlen'))) {

				for ($i = 0; $i < count($nama_sub); $i++) {

					//assign values
					$data_sub = array(
						'navbar_menu' => $id_menu,
						'submenu' => $this->input->post('nama_submenu')[$i],
						'link_submenu' => $this->input->post('link_submenu')[$i]
					);

					//insert to navbar_submenu
					$this->navbar_model->tambah_submenu($data_sub);
				}
			}

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Menu berhasil ditambahkan</div>');

			redirect('admin/navbar');
		}
	}

	public function hapus_navbar($id)
	{

		if ($this->navbar_model->hapus($id) && $this->navbar_model->hapus_submenu_by_menu_id($id)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Menu <strong>berhasil</strong> dihapus</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Menu <strong>gagal</strong> dihapus</div>');
		}

		redirect('admin/navbar');
	}

	public function hapus_submenu($id_sub, $id_nav)
	{
		if ($this->navbar_model->hapus_submenu_by_id($id_sub)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Submenu <strong>berhasil</strong> dihapus</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Submenu <strong>gagal</strong> dihapus</div>');
		}

		redirect('admin/navbar/edit_navbar/' . $id_nav);
	}

	private function tambah_submenu_navbar($id)
	{

		//get all field navbar submenu
		$nama_sub = $this->input->post('nama_submenu');
		$link_sub = $this->input->post('link_submenu');

		for ($i = 0; $i < count($nama_sub); $i++) {

			//assign values
			$data = array(
				'navbar_menu' => $id,
				'submenu' => $this->input->post('nama_submenu')[$i],
				'link_submenu' => $this->input->post('link_submenu')[$i]
			);

			//insert to navbar_submenu
			$this->db->insert('navbar_submenu', $data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Submenu berhasil ditambahkan</div>');
	}
}
