<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Kelola User';
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$this->db->select('user.id as user_id, name, email, role_id, is_active, date_created, user_role.id as id_role, user_role.role');
		$this->db->from('user');
		$this->db->join('user_role', 'user_role.id = user.role_id');
		$data['userdata'] = $this->db->get()->result_array();

		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/superadmin/kelola_user', $data);
		$this->load->view('dashboard/template/footer');
	}

	public function kelola_user() {
		$data['title'] = 'Kelola User';
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$this->db->select('user.id as user_id, name, email, role_id, is_active, date_created, user_role.id as id_role, user_role.role');
		$this->db->from('user');
		$this->db->join('user_role', 'user_role.id = user.role_id');
		$data['userdata'] = $this->db->get()->result_array();

		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/superadmin/kelola_user', $data);
		$this->load->view('dashboard/template/footer');
	}

	public function toggle_active_user($id,$val) {

		if (isset($val)) {
			$this->db->set('is_active', !$val);
			$this->db->where('id', $id);
			$this->db->update('user');

			if ($val == 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>User diaktifkan</div>');
				
				redirect('superadmin/kelola_user');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>User dinonaktifkan</div>');
				redirect('superadmin/kelola_user');
			}
		}
	}
	
	public function hapus_user($id) {
		$this->db->where('id', $id);
		$this->db->delete('user');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>User <strong>berhasil</strong> dihapus</div>');

		redirect('superadmin/kelola_user');
	}

	public function cek_akses($role,$menu) {
		//cek sudah ada entry yg sama blm
		$res = $this->db->get_where('user_access_menu', array('role_id' => $role, 'menu_id' => $menu))->result_array();

		if (count($res) < 1) {
			//kalo gak ada
			return false;
		} else {
			//kalo ada
			return true;
		}
	}

	public function cek_akses_role($role) {
		//cek sudah ada entry yg sama blm
		$res = $this->db->get_where('user_access_menu', array('role_id' => $role))->result_array();

		return $res;
	}

	public function hak_akses() {
		$data['title'] = 'Kelola Hak Akses';
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		// $this->db->select('*');
		// $this->db->from('user_menu');
		// $this->db->join('user_access_menu', 'user_access_menu.menu_id = user_menu.menu_id', 'right');
		$data['menu'] = $this->db->get('user_menu')->result_array();
		$data['akses'] = $this->db->get('user_access_menu')->result_array();

		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/superadmin/hak_akses', $data);
		$this->load->view('dashboard/template/footer');


		if ($this->input->post('submit_btn') == "simpan") {

			//die;

			$menu = $this->input->post('menu');
			$menu_uncheck = $this->input->post('menu_unchecked');

			//liat per menu ada di db enggak, klo ga ada ditambahkan ke db
			foreach ($menu as $mn) {

				$arr = explode("-", $mn);

				// arr[0] = role
				$r = $arr[0];
				// arr[1] = menu
				$m= $arr[1];

				if (!$this->cek_akses($r,$m)) {
					//masukin entry yg blm ada di db
					$this->db->set('role_id', $r);
					$this->db->set('menu_id', $m);
					$this->db->insert('user_access_menu');
				}
			}

			//ambil menu yg tidak dipilih (unchecked)
			$diff = array_diff($menu_uncheck, $menu);

			//delete menu yg gak unchecked
			foreach ($diff as $m) {

				$arr = explode("-", $m);

				// arr[0] = role
				$r = $arr[0];
				// arr[1] = menu
				$m= $arr[1];

				//delete entry yg unchecked
				$this->db->where('role_id', $r);
				$this->db->where('menu_id', $m);
				$this->db->delete('user_access_menu');

			}

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Hak akses <strong>berhasil</strong> diperbarui</div>');

			redirect('superadmin/hak_akses/');
		}
	}

	public function edit_role() {
		$id = $this->input->post('role_id');
		$role = $this->input->post('role');

		$this->db->set('role', $role);
		$this->db->where('id', $id);

		if ($this->db->update('user_role')) {
			
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Role <strong>berhasil</strong> diperbarui</div>');
		
			redirect('superadmin/hak_akses');
		}


	}

	public function hapus_role($id) {
		$this->db->where('id',$id);
		
		if ($this->db->delete('user_role')) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Role <strong>berhasil</strong> dihapus</div>');
		
			redirect('superadmin/hak_akses');
		}
	}

	public function menu() {
		$data['title'] = 'Kelola Menu';
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'menu', 'required',
				array(
					'required' => 'Kolom %s wajib diisi'
				)
			);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('dashboard/template/header.php', $data);
			$this->load->view('dashboard/template/sidebar.php', $data);
			$this->load->view('dashboard/template/topbar.php', $data);
			$this->load->view('dashboard/superadmin/menu.php', $data);
			$this->load->view('dashboard/template/footer.php');
		} else {
			$this->tambah_menu();
		}
	}

	public function tambah_menu() {

		$menu = $this->input->post('menu');

		$this->db->insert('user_menu', ['menu' => $menu]);

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Menu baru berhasil ditambahkan</div>');

		redirect('superadmin/menu');		
	}

	public function hapus_menu($id) {
		$this->db->where('menu_id', $id);
		$this->db->delete('user_menu');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Menu <strong>berhasil</strong> dihapus</div>');

		redirect('superadmin/menu');
	}

	public function edit_menu($id)
	{
		//Form validation
		$this->form_validation->set_rules('menu', 'Menu', 'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			//validasi gagal

			$data['title'] = "Edit Menu";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['menu'] = $this->db->get_where('user_menu', ['menu_id' => $id])->row_array();

			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/superadmin/edit_menu', $data);
			$this->load->view('dashboard/template/footer');

		} else {
			//validasi berhasil
			$id = $this->input->post('menu_id');
			$menu = $this->input->post('menu');

			$this->db->set('menu', $menu);
			$this->db->where('menu_id', $id);

			if ($this->db->update('user_menu')) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Menu <strong>berhasil</strong> diubah</div>');

				redirect('superadmin/menu');
			}
			
		}
	}

	public function submenu() {
		$data['title'] = 'Kelola Submenu';
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$this->db->select('*');
		$this->db->from('user_sub_menu');
		$this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.menu_id');
		$data['submenu'] = $this->db->get()->result_array();
		$data['menu'] = $this->db->get('user_menu')->result_array();


		$this->form_validation->set_rules('submenu', 'menu', 'required',
				array(
					'required' => 'Kolom %s wajib diisi'
				)
		);
		$this->form_validation->set_rules('url', 'URL', 'required',
				array(
					'required' => 'Kolom %s wajib diisi'
				)
		);
		$this->form_validation->set_rules('ikon', 'ikon', 'required',
				array(
					'required' => 'Kolom %s wajib diisi'
				)
		);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('dashboard/template/header.php', $data);
			$this->load->view('dashboard/template/sidebar.php', $data);
			$this->load->view('dashboard/template/topbar.php', $data);
			$this->load->view('dashboard/superadmin/submenu.php', $data);
			$this->load->view('dashboard/template/footer.php');
		} else {
			$this->tambah_submenu();
		}	
	}

	public function aktifkan_submenu($id,$val) {

		if (isset($val)) {
			$this->db->set('is_active', !$val);
			$this->db->where('id', $id);
			$this->db->update('user_sub_menu');

			if ($val == 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Submenu diaktifkan</div>');
				
				redirect('superadmin/submenu');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-warning alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Submenu dinonaktifkan</div>');
				redirect('superadmin/submenu');
			}
		}
	}

	public function tambah_submenu() {

		$is_active = ($this->input->post('aktif') == "")? "0":"1";

		$submenu = array(
			'menu_id' => $this->input->post('menuutama'),
			'title' => $this->input->post('submenu'),
			'url' => $this->input->post('url'),
			'icon' => "fas fa-fw fa-".$this->input->post('ikon'),
			'is_active' => $is_active
		);

		$this->db->insert('user_sub_menu', $submenu);

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Submenu baru berhasil ditambahkan</div>');

		redirect('superadmin/submenu');		
	}

	public function hapus_submenu($id) {
		$this->db->where('id', $id);
		$this->db->delete('user_sub_menu');

		$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Submenu berhasil dihapus</div>');

		redirect('admin/kelola_submenu');
	}

	public function edit_submenu($id) {

		$this->form_validation->set_rules('submenu', 'menu', 'required',
				array(
					'required' => 'Kolom %s wajib diisi'
				)
		);
		$this->form_validation->set_rules('url', 'URL', 'required',
				array(
					'required' => 'Kolom %s wajib diisi'
				)
		);
		$this->form_validation->set_rules('ikon', 'ikon', 'required',
				array(
					'required' => 'Kolom %s wajib diisi'
				)
		);

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit Submenu';
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$this->db->select('*');
			$this->db->from('user_sub_menu');
			$this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.menu_id');
			$this->db->where('id', $id);
			$data['submenu'] = $this->db->get()->row_array();
			$data['menu'] = $this->db->get('user_menu')->result_array();

			$this->load->view('dashboard/template/header.php', $data);
			$this->load->view('dashboard/template/sidebar.php', $data);
			$this->load->view('dashboard/template/topbar.php', $data);
			$this->load->view('dashboard/superadmin/edit_submenu.php', $data);
			$this->load->view('dashboard/template/footer.php');
		} else {
			$is_active = ($this->input->post('aktif') == "")? "0":"1";

			$submenu = array(
				'menu_id' => $this->input->post('menuutama'),
				'title' => $this->input->post('submenu'),
				'url' => $this->input->post('url'),
				'icon' => "fas fa-fw fa-".$this->input->post('ikon'),
				'is_active' => $is_active
			);

			$this->db->set($submenu);
			$this->db->where('id', $id);

			if ($this->db->update('user_sub_menu')) {
				
				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Submenu baru berhasil diperbarui</div>');

				redirect('superadmin/submenu');
			}
	
		}
	}






}
