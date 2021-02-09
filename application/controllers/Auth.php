<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('logged') == TRUE)
	    {
	    	if ($this->session->userdata('role_id') == 3) {
		        redirect('superadmin');
	    	}
	    }

		//Form validation
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email',
			array(
				'valid_email' => 'Email tidak valid',
				'required' => '%s wajib diisi'
			)
		);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]',
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

	private function _login() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		
		if ($user) {
			//cek password
			if (password_verify($password, $user['password'])) {
				
				$data= [
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
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Email tidak terdaftar!</small></div>');

			redirect('auth');
		}
	}

	public function registrasi() {
		//Form validation
		$this->form_validation->set_rules('name', 'Nama', 'required|max_length[128]',
        array(
                'required' => '%s wajib diisi'
        	)
		);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',
			array(
				'valid_email' => 'Email tidak valid',
				'is_unique' => 'Email sudah terdaftar',
				'required' => '%s wajib diisi'
			)
		);
		$this->form_validation->set_rules('password1', 'Password', 'required|min_length[6]|matches[password2]',
			array(
				'required' => '%s wajib diisi',
				'matches' => 'Password yang Anda isikan tidak sama',
				'min_length' => 'Password terlalu pendek'
			)
		);
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password1]');

        if ($this->form_validation->run() == FALSE)
        {
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
				'date_created' => date('Y-m-d')
			);	

			//Input to database
			$this->db->insert('user', $userdata);

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>User berhasil terdaftar</small></div>');

			redirect('auth');
        }
	}

	public function logout() {
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('logged');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><small>Anda berhasil keluar</small></div>');

		redirect('auth');
	}

	public function get_role() {
		return $this->db->get('user_role')->result_array();
	}

	public function blocked() {
		$data['title'] = '403 Forbidden Access';
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		
		$this->load->view('errors/forbidden.php', $data);
	}
}
