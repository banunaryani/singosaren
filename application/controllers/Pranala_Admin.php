<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pranala_Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();

		is_logged_in();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('pranala_model');
	}

	public function index()
	{
		$data['title'] = "Pranala Luar";
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$data['pranala'] = $this->pranala_model->get_all_pranala();
		
		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/pranala/list', $data);
		$this->load->view('dashboard/template/footer');
	}

	public function upload_gambar($file, $id) {

		if ($file['name']) {

		$config['upload_path']          = './assets/img/pranala/';
        $config['allowed_types']        = 'png|jpg|gif';
        $config['overwrite']			= TRUE;
        $config['file_name']			= 'pranala-'.$id.'-'.$file['name'].'.jpg';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

	        if ($this->upload->do_upload('logo')) {

	        	return $this->upload->data('file_name');

	        } else {
	        	$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');

	        	redirect('admin/pranala/tambah');

	        }
	    }
	}

	public function tambah()
	{
		//Form validation
		$this->form_validation->set_rules('judul', 'Judul', 'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			
			$data['title'] = "Tambah Pranala";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			
			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/pranala/tambah', $data);
			$this->load->view('dashboard/template/footer');
		} else {

			$last_id = ($this->pranala_model->cek_last_id()->id !== null)? $this->pranala_model->cek_last_id()->id++:1;

			$judul = $this->input->post('judul');
			$logo = $this->upload_gambar($_FILES['logo'], $last_id);

			$data = array(
				'judul' => $judul,
				'logo' => $logo,
				'alamat' => $this->input->post('alamat'),
				'telp' => $this->input->post('telp'),
				'website' => $this->input->post('web'),
				'fb' => $this->input->post('fb'),
				'ig' => $this->input->post('ig'),
				'twitter' => $this->input->post('twitter')
			);

			if ($this->pranala_model->tambah($data)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Pranala baru <strong>berhasil</strong> ditambahkan</div>');

			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Pranala <strong>gagal</strong> ditambahkan</div>');
			}
				redirect('admin/pranala');
		}

	}

	public function hapus($id) {

		$gbr = $this->pranala_model->get_gambar($id);
		unlink(FCPATH.'assets/img/pranala/'.$gbr);

		if ($this->pranala_model->hapus($id)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Pranala <strong>berhasil</strong> dihapus</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Pranala <strong>gagal</strong> dihapus</div>');
		}

		redirect('admin/pranala');
	}

	public function edit($id) {
		//Form validation
		$this->form_validation->set_rules('judul', 'Judul', 'required|max_length[128]',
			array(
				'required' => '%s tidak boleh kosong',
				'max_length' => '%s terlalu panjang. Maksimal 128 karakter.'
			)
		);

		if ($this->form_validation->run() == FALSE) {

			$data['title'] = "Edit Pranala";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['pranala'] = $this->pranala_model->get_pranala($id);
			
			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/pranala/edit', $data);
			$this->load->view('dashboard/template/footer');

		} else {
			$id = $this->input->post('id');
			$judul = $this->input->post('judul');

			$data = array(
				'judul' => $judul,
				'alamat' => $this->input->post('alamat'),
				'telp' => $this->input->post('telp'),
				'website' => $this->input->post('web'),
				'fb' => $this->input->post('fb'),
				'ig' => $this->input->post('ig'),
				'twitter' => $this->input->post('twitter')
			);

			if ($_FILES["logo"]["error"] == 4) {

				$data['logo'] = $this->input->post('gambar_lama');

			} else {
				$gbr = $this->input->post('gambar_lama');
				unlink(FCPATH.'assets/img/pranala/'.$gbr);

				$data['logo'] = $this->upload_gambar($_FILES['logo'], $id);
			}

			if ($this->pranala_model->edit($id,$data)) {

				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Potensi <strong>berhasil</strong> diperbarui</div>');
			}

			redirect('admin/pranala');

		}
	}

}