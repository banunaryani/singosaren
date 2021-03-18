<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();

		$this->load->model('user_model');
	}

	public function index()
	{

		//Form validation
		$this->form_validation->set_rules(
			'inputDesa',
			'Nama desa',
			'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			//validasi gagal

			$data['title'] = "Pengaturan Umum";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['deskripsi'] = $this->db->get('deskripsi')->row_array();


			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/user/beranda', $data);
			$this->load->view('dashboard/template/footer');
		} else {
			//validasi berhasil
			$desa = $this->input->post('inputDesa');
			$kab = $this->input->post('inputKab');
			$prov = $this->input->post('inputProv');

			$favicon = $this->upload_favicon($_FILES['inputFavicon']);
			$logo = $this->upload_logo($_FILES['inputLogo']);


			$data = array(
				'desa' => $desa,
				'kabkota' => $kab,
				'provinsi' => $prov
			);

			if ($_FILES['inputFavicon']['error'] == 4) {
				$data['favicon'] = $this->user_model->get_old_favicon()['favicon'];
			} else {
				$data['favicon'] = $this->upload_favicon($_FILES['inputFavicon']);
			}

			if ($_FILES['inputLogo']['error'] == 4) {
				$data['logo'] = $this->user_model->get_old_logo()['logo'];
			} else {
				$data['logo'] = $this->upload_logo($_FILES['inputLogo']);
			}

			//data slideshow urutan 1
			$data2 = array(
				'judul' => $desa,
				'keterangan' => $kab . ", " . $prov
			);

			if ($this->db->update('deskripsi', $data)) {

				//update slideshow urutan 1
				$this->db->where('urutan', "1");
				$this->db->update('slideshow', $data2);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible mt-3"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Data <strong>berhasil</strong> diubah</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible mt-3"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Data <strong>gagal</strong> diubah</div>');
			}

			redirect('user');
		}
	}

	public function upload_favicon($file)
	{
		if ($file['name']) {

			$config['upload_path']          = './assets/img/';
			$config['overwrite']			= TRUE;
			$config['allowed_types']        = 'ico';
			$config['overwrite']			= TRUE;
			$config['max_size']             = 2048;
			$config['file_name']			= 'favicon-' . $file['name'];

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('inputFavicon')) {

				return $this->upload->data('file_name');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');

				redirect('user');
			}
		}
	}


	public function upload_logo($file)
	{
		if ($file['name']) {

			$config['upload_path']          = './assets/img/';
			$config['overwrite']			= TRUE;
			$config['allowed_types']        = 'png|jpg|jpeg';
			$config['overwrite']			= TRUE;
			$config['max_size']             = 2048;
			$config['file_name']			= 'logo-' . $file['name'];

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('inputLogo')) {

				return $this->upload->data('file_name');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');

				redirect('user');
			}
		}
	}


	public function edit_profile($id)
	{
		//Form validation
		$this->form_validation->set_rules(
			'name',
			'Nama',
			'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			//validasi gagal

			$data['title'] = "Edit Profil";
			$this->db->join('user_role', 'user_role.id = user.role_id');
			$data['user'] = $this->db->get_where('user', ['user.id' => $id])->row_array();

			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/edit_profile', $data);
			$this->load->view('dashboard/template/footer');
		} else {
			//validasi berhasil
			$name = $this->input->post('name');

			$this->db->set('name', $name);
			$this->db->where('id', $id);

			if ($this->db->update('user')) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Profil berhasil diubah</div>');

				redirect('user/edit_profile/' . $id);
			}
		}
	}

	public function ubah_password($id)
	{

		$this->form_validation->set_rules(
			'password1',
			'Password',
			'required|min_length[6]|matches[password2]',
			array(
				'required' => '%s tidak boleh kosong',
				'matches' => '%s yang Anda isikan tidak sama',
				'min_length' => '%s terlalu pendek'
			)
		);
		$this->form_validation->set_rules(
			'password2',
			'Password',
			'required|matches[password1]',
			array(
				'required' => 'Password tidak boleh kosong',
				'matches' => 'Password tidak sama'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Ubah Password";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/ubah_password', $data);
			$this->load->view('dashboard/template/footer');
		} else {
			//Get user data
			$userdata = array(
				'password' =>  password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
			);

			//Input to database
			$this->db->where('id', $id);

			if ($this->db->update('user', $userdata)) {

				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password <strong>berhasil</strong> diubah</div>');

				redirect('auth/edit_profile/' . $id);
			}
		}
	}

	// ========================================================
	// 						KONTAK
	// ========================================================

	public function kontak()
	{

		//Form validation

		$this->form_validation->set_rules(
			'email',
			'Email',
			'valid_email',
			array(
				'valid_email' => '%s tidak valid'
			)
		);

		$this->form_validation->set_rules(
			'fb',
			'Facebook',
			'valid_url',
			array(
				'valid_url' => 'URL %s tidak valid. Contoh URL valid: https://facebook.com/contoh'
			)
		);

		$this->form_validation->set_rules(
			'ig',
			'Instagram',
			'valid_url',
			array(
				'valid_url' => 'URL %s tidak valid. Contoh URL valid: https://instagram.com/contoh'
			)
		);

		$this->form_validation->set_rules(
			'twitter',
			'Twitter',
			'valid_url',
			array(
				'valid_url' => 'URL %s tidak valid. Contoh URL valid: https://twitter.com/contoh'
			)
		);

		if ($this->form_validation->run() == FALSE) {

			$data['title'] = "Kontak";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['kontak'] = $this->user_model->get_kontak();

			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/kontak', $data);
			$this->load->view('dashboard/template/footer');
		} else {

			$this->update_kontak();

			redirect('admin/kontak');
		}
	}

	public function update_kontak()
	{
		$data = array(
			'facebook' => trim($this->input->post('fb')),
			'instagram' => trim($this->input->post('ig')),
			'twitter' => trim($this->input->post('twitter')),
			'telp' => trim($this->input->post('telp')),
			'email' => trim($this->input->post('email')),
			'alamat' => $this->input->post('alamat')
		);

		if ($this->user_model->update_kontak($data)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kontak <strong>berhasil</strong> diperbarui</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kontak <strong>gagal</strong> diperbarui</div>');
		}
	}

	// ========================================================
	// 						SLIDESHOW
	// ========================================================

	private function upload_gambar($file)
	{

		if ($file['name']) {

			$config['upload_path']          = './assets/img/slideshow/';
			$config['overwrite']			= TRUE;
			$config['allowed_types']        = 'png|jpg|jpeg|gif';
			$config['max_size']             = 2048;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('gambar')) {

				$img = $file['name'];
				return $img;
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');

				redirect('user/slideshow');
			}
		}
	}

	public function slideshow()
	{
		$data['title'] = "Slideshow";
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$this->db->from('slideshow');
		$this->db->order_by('urutan ASC');
		$data['slideshow'] = $this->db->get()->result_array();
		$data['deskripsi'] = $this->db->get('deskripsi')->row_array();

		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/user/slideshow', $data);
		$this->load->view('dashboard/template/footer');
	}

	private function resize_slideshow($filename)
	{

		$config['image_library'] = 'gd2';
		$config['source_image'] = './assets/img/slideshow/' . $filename;
		// $config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		// $config['width']         = 75;
		$config['height']       = 800;

		$this->load->library('image_lib', $config);

		$this->image_lib->resize();
	}

	public function tambah_slideshow()
	{

		$data['title'] = "Tambah Slideshow";
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$data['jml_slideshow'] = $this->db->count_all('slideshow');
		$data['slideshow'] = $this->db->get('slideshow')->row_array();

		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/user/tambah_slideshow', $data);
		$this->load->view('dashboard/template/footer');

		if ($this->input->post('btnSimpanSlideshow') == "simpan") {

			//UPLOAD GAMBAR
			if ($this->upload_gambar($_FILES['gambar']) == FALSE) {
				$data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
			} else {

				$gambar = $this->upload_gambar($_FILES['gambar']);

				$judul = $this->input->post('judul');
				$ket = $this->input->post('keterangan');
				$tbl1_nama = $this->input->post('namaBtn1');
				$tbl1_link = $this->input->post('linkBtn1');
				$tbl2_nama = $this->input->post('namaBtn2');
				$tbl2_link = $this->input->post('linkBtn2');
				$arsip = 0;
				$urutan = $this->input->post('urutan');

				$arr = array(
					'gambar' => $gambar,
					'judul' => $judul,
					'keterangan' => $ket,
					'nama_btn1' => $tbl1_nama,
					'link_btn1' => $tbl1_link,
					'nama_btn2' => $tbl2_nama,
					'link_btn2' => $tbl2_link,
					'arsipkan' => $arsip,
					'urutan' => $urutan
				);

				$this->db->insert('slideshow', $arr);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Slideshow berhasil ditambahkan</div>');

				redirect('user/slideshow');
			}
		}
	}

	public function edit_slideshow($id)
	{
		$data['title'] = "Edit Slideshow";
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$data['jml_slideshow'] = $this->db->count_all('slideshow');
		$data['slideshow'] = $this->db->get_where('slideshow', ['id' => $id])->row_array();

		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/user/edit_slideshow', $data);
		$this->load->view('dashboard/template/footer');

		if ($this->input->post('btnSimpanSlideshow') == "simpan") {

			$arr = array(
				'judul' => $this->input->post('judul'),
				'keterangan' => $this->input->post('keterangan'),
				'nama_btn1' => $this->input->post('namaBtn1'),
				'link_btn1' => $this->input->post('linkBtn1'),
				'nama_btn2' => $this->input->post('namaBtn2'),
				'link_btn2' => $this->input->post('linkBtn2'),
				'arsipkan' => $this->input->post('arsipkan'),
				'urutan' => $this->input->post('urutan')
			);

			if (isset($_FILES['gambar'])) {

				if ($this->upload_gambar($_FILES['gambar']) == FALSE) {

					$data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
				} else {

					$arr['gambar'] = $this->upload_gambar($_FILES['gambar']);
				}
			}

			$this->db->where('id', $id);

			if ($this->db->update('slideshow', $arr)) {

				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Slideshow berhasil diperbarui</div>');

				redirect('user/slideshow');
			}
		}
	}

	public function hapus_slideshow($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('slideshow');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Slideshow <strong>berhasil</strong> dihapus</div>');

		redirect('user/slideshow');
	}

	public function toggle_arsipkan_slideshow($id, $val)
	{

		if (isset($val)) {
			$this->db->set('arsipkan', !$val);
			$this->db->where('id', $id);
			$this->db->update('slideshow');

			if ($val == 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible mt-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Slideshow dinonaktifkan</div>');

				redirect('user/slideshow');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible mt-2"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Slideshow diaktifkan</div>');
				redirect('user/slideshow');
			}
		}
	}
}
