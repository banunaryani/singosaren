<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('logged') == TRUE) {
			if ($this->session->userdata('role_id') == 3) {
				redirect('superadmin');
			}
		}

		//Form validation
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email',
			array(
				'valid_email' => 'Email tidak valid',
				'required' => '%s wajib diisi'
			)
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|min_length[6]',
			array(
				'required' => '%s wajib diisi',
				'min_length' => '%s terlalu pendek'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			//validasi gagal

			$data['title'] = "Login - Desaspasial";
			$this->load->view("login");
		} else {
			//validasi berhasil
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			// cek apakah user sudah verifikasi email
			if ($user['is_active'] == 1) {
				//cek password
				if (password_verify($password, $user['password'])) {

					$data = [
						'id' => $user['id'],
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'logged' => TRUE
					];

					$this->session->set_userdata($data);

					if ($user['role_id'] == 1) {
						redirect('user');
					} elseif ($user['role_id'] == 2) {
						redirect('admin');
					} else {
						redirect('superadmin');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Password salah</small></div>');

					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Akun belum diaktivasi!</small></div>');

				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Email tidak terdaftar!</small></div>');

			redirect('auth');
		}
	}

	public function registrasi()
	{
		//Form validation
		$this->form_validation->set_rules(
			'name',
			'Nama',
			'required|max_length[128]',
			array(
				'required' => '%s wajib diisi'
			)
		);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email|is_unique[user.email]',
			array(
				'valid_email' => 'Email tidak valid',
				'is_unique' => 'Email sudah terdaftar',
				'required' => '%s wajib diisi'
			)
		);
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'required|min_length[6]|matches[password2]',
			array(
				'required' => '%s wajib diisi',
				'matches' => 'Password yang Anda isikan tidak sama',
				'min_length' => 'Password terlalu pendek'
			)
		);
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password1]');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Registrasi User - Desaspasial";
			$data['role'] = $this->get_role();

			$this->load->view("dashboard/register", $data);
		} else {
			//Get user data
			$userdata = array(
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'password' =>  password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => $this->input->post('role_id'),
				'date_created' => date('Y-m-d'),
				'is_active' => 0
			);

			$token = base64_encode(random_bytes(32));

			$user_token = [
				'email' => htmlspecialchars($this->input->post('email', true)),
				'token' => $token,
				'date_created' => date("Y-m-d H:i:s")
			];

			if ($this->db->insert('user', $userdata)) {
				$this->db->insert('user_token', $user_token);
				//kirim email aktivasi
				$this->_send_email($token, 'verify', $this->input->post('email', true));

				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>User berhasil terdaftar. Silakan cek email untuk verifikasi akun.</small></div>');

				redirect('auth');
			}
		}
	}

	private function _send_email($token, $type, $email_to)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_user' => 'hello.labiba@gmail.com',
			'smtp_pass' => '2020oyee',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('no-reply@desaspasial.com', 'Desa Spasial');
		$this->email->to($this->input->post('email', true));

		if ($type == 'verify') {
			$this->email->subject('Verifikasi Akun Desa Spasial Anda');
			$this->email->message('<p>Klik link berikut untuk melakukan verifikasi akun Anda:</p> <a href="' . base_url('auth/verify?') . 'email=' . $email_to . '&token=' . urlencode($token) . '">Verifikasi</a>');
		} elseif ($type = 'resetpass') {
			$this->email->subject('Reset Password');
			$this->email->message('<p>Klik link berikut untuk reset password akun Anda:</p> <a href="' . base_url('auth/reset_password?') . 'email=' . $email_to . '&token=' . urlencode($token) . '">Reset Password</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		$token = $this->db->get_where('user_token', ['email' => $email, 'token' => $token])->row_array();

		if ($user['is_active'] == 1) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Akun ' . $email . ' sudah aktif</small></div>');

			redirect('auth');
		} else {
			// jika ada user dan ada token
			if ($user && $token == null) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Link tidak valid</small></div>');

				redirect('auth');
			} elseif ($user == null) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Akun ' . $email . ' tidak terdaftar!</small></div>');

				redirect('auth');
			} elseif ($user && $token) {
				$this->db->set('is_active', 1);
				$this->db->where('email', $email);
				$this->db->update('user');

				$this->db->where('email', $email);
				$this->db->where('token', $token);
				$this->db->delete('user_token');

				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Akun ' . $email . ' berhasil diaktivasi. Silakan login!</small></div>');

				redirect('auth');
			}
		}
	}

	public function lupa_password()
	{
		//Form validation
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email',
			array(
				'valid_email' => 'Email tidak valid',
				'required' => '%s wajib diisi'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view("lupa_password");
		} else {
			$email = htmlspecialchars($this->input->post('email', true));

			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
			// cek apakah email exist
			if ($user) {
				$token = base64_encode(random_bytes(32));

				$user_token = [
					'email' => htmlspecialchars($this->input->post('email', true)),
					'token' => $token,
					'date_created' => date("Y-m-d H:i:s")
				];

				$this->db->insert('user_token', $user_token);

				$this->_send_email($token, 'resetpass', $email);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Kami telah mengirimkan link untuk melakukan reset password ke email Anda</small></div>');

				redirect('auth/lupa_password');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>User tidak aktif atau tidak terdaftar</small></div>');

				redirect('auth/lupa_password');
			}
		}
	}

	public function reset_password()
	{
		$email = $this->input->get("email");
		$token = $this->input->get("token");

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		$token = $this->db->get_where('user_token', ['email' => $email, 'token' => $token])->row_array();

		if ($user) {
			if ($token) {
				$this->session->set_userdata('reset_email', $email);
				// jika user ada dan token valid
				$this->ganti_password();
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Link tidak valid</small></div>');

				redirect('auth/lupa_password');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Akun ' . $email . ' tidak terdaftar!</small></div>');

			redirect('auth/lupa_password');
		}
	}

	public function ganti_password()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}
		//Form validation
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email',
			array(
				'valid_email' => 'Email tidak valid',
				'required' => '%s wajib diisi'
			)
		);

		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|min_length[6]|matches[password2]',
			array(
				'required' => '%s wajib diisi',
				'matches' => 'Password yang Anda isikan tidak sama',
				'min_length' => 'Password terlalu pendek'
			)
		);

		$this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password]');

		if ($this->form_validation->run() == FALSE) {
			$data['email'] = $this->session->userdata('reset_email');
			$this->load->view("ganti_password", $data);
		} else {
			$email = $this->session->userdata('reset_email');
			$new_pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

			$this->db->where('email', $email);
			$this->db->set('password', $new_pass);
			$this->db->update('user');

			$this->db->where('email', $email);
			$this->db->delete('user_token');

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Password berhasil direset</small></div>');

			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Anda berhasil keluar</small></div>');

		redirect('auth');
	}

	public function get_role()
	{
		return $this->db->get('user_role')->result_array();
	}

	public function blocked()
	{
		$data['title'] = '403 Forbidden Access';
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

		$this->load->view('errors/forbidden.php', $data);
	}
}
