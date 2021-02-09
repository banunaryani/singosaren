<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan_Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_logged_in();
		$this->load->model('layanan_model');
	}

	public function index()
	{
		//Form validation
		$this->form_validation->set_rules('kategori', 'Nama kategori', 'required',
			array(
				'required' => '%s wajib diisi'
			)
		);

		if ($this->form_validation->run() == FALSE) {

			$data['title'] = "Layanan";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['kategori'] = $this->db->get('kategori_layanan')->result_array();
			$q = "SELECT `layanan`.`id` as `layanan_id`, `kategori_id`, `kategori`, `judul`, `konten`, `arsipkan`, `slug`, `tampil_beranda`, `file`
					FROM `layanan`
				LEFT JOIN `kategori_layanan`
						ON `layanan`.`kategori_id` = `kategori_layanan`.`id`
				ORDER BY `layanan_id` DESC";

			$data['layanan'] = $this->db->query($q)->result_array();
			
			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/user/layanan', $data);
			$this->load->view('dashboard/template/footer');

		} else {

			$this->tambah_kategori();

			redirect('admin/layanan');

		}

	}


	private function tambah_kategori() {
		$kategori = $this->input->post('kategori');

		$this->layanan_model->tambah_kategori($kategori);

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kategori <strong>berhasil</strong> ditambahkan</div>');
	}

	public function hapus_kategori($id) {
		$this->layanan_model->hapus_kategori($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kategori <strong>berhasil</strong> dihapus</div>');

		redirect('admin/layanan');
	}

	public function edit_kategori() {

		$id = $this->input->post('id');
		$kategori = $this->input->post('kategori');

		for ($i=0; $i < count($id)-1; $i++) { 

			$data = array(
				'id' => $id[$i],
				'kategori' => $kategori[$i]
			);

			$this->layanan_model->edit_kategori($data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Kategori <strong>berhasil</strong> diperbarui</div>');

		redirect('admin/layanan');
	}

	public function upload_file($file) {
		if ($file['name']) {

		$config['upload_path']          = './assets/files/';
        $config['allowed_types']        = 'png|jpg|gif|jpeg|tiff|mp4|mp3|text|pdf|doc|docx|xls|xlsx|csv|ppt';
        $config['overwrite']			= TRUE;
        $config['file_name']			= 'layanan-'.$file['name'];

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

	        if ($this->upload->do_upload('lampiran')) {

	        	return $this->upload->data('file_name');

	        } else {
	        	$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');

	        	redirect('admin/layanan/tambah_layanan');

	        }
	    }
	}

	public function tambah_layanan() {

		//Form validation
		$this->form_validation->set_rules('judul', 'Judul', 'required|max_length[140]',
			array(
				'required' => '%s tidak boleh kosong',
				'max_length' => '%s terlalu panjang. Maksimal 140 karakter.'
			)
		);

		$this->form_validation->set_rules('kategori', 'Kategori', 'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);

		$this->form_validation->set_rules('konten', 'Konten', 'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);

		if ($this->form_validation->run() == FALSE) {

			$data['title'] = "Tambah Layanan Baru";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['kategori'] = $this->db->get('kategori_layanan')->result_array();
			
			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/user/tambah_layanan', $data);
			$this->load->view('dashboard/template/footer');

		} else {

			$arsipkan = ($this->input->post('arsipkan'))? 1:0;
			$judul = $this->input->post('judul');

			$data = array(
				'kategori_id' => $this->input->post('kategori'),
				'judul' => $judul,
				'konten' => $this->input->post('konten'),
				'arsipkan' => $arsipkan,
				'slug' => url_title($judul, 'dash', TRUE)
			);

			if ($_FILES['lampiran']) {
				$data['file'] = $this->upload_file($_FILES['lampiran']);
			}

			if ($this->layanan_model->tambah_layanan($data)) {
			 	
				$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Layanan baru <strong>berhasil</strong> ditambahkan</div>');
			 } else {
			 	$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Layanan baru <strong>gagal</strong> ditambahkan</div>');
			 }

			redirect('admin/layanan');

		}

	}

	public function edit_layanan($id) {
		//Form validation
		$this->form_validation->set_rules('judul', 'Judul', 'required|max_length[140]',
			array(
				'required' => '%s tidak boleh kosong',
				'max_length' => '%s terlalu panjang. Maksimal 140 karakter.'
			)
		);

		$this->form_validation->set_rules('kategori', 'Kategori', 'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);

		$this->form_validation->set_rules('konten', 'Konten', 'required',
			array(
				'required' => '%s tidak boleh kosong'
			)
		);

		if ($this->form_validation->run() == FALSE) {

			$data['title'] = "Edit Layanan";
			$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
			$data['kategori'] = $this->db->get('kategori_layanan')->result_array();
			$q = "SELECT `layanan`.`id`, `kategori_id`, `kategori`, `judul`, `konten`, `arsipkan`, `file`, `tampil_beranda`
					FROM `layanan`
				LEFT JOIN `kategori_layanan`
					ON `layanan`.`kategori_id` = `kategori_layanan`.`id`
				WHERE `layanan`.`id` = $id
				ORDER BY `layanan`.`id` ASC";

			$data['layanan'] = $this->db->query($q)->row_array();
			
			$this->load->view('dashboard/template/header', $data);
			$this->load->view('dashboard/template/sidebar', $data);
			$this->load->view('dashboard/template/topbar', $data);
			$this->load->view('dashboard/user/edit_layanan', $data);
			$this->load->view('dashboard/template/footer');

		} else {

			$id = $this->input->post('id');

			$judul = $this->input->post('judul');

			$data = array(
				'kategori_id' => $this->input->post('kategori'),
				'judul' => $judul,
				'konten' => $this->input->post('konten'),
				'slug' => url_title($judul, 'dash', TRUE)
			);

			if ($_FILES["lampiran"]["error"] == 4) {

				$data['file'] = $this->input->post('old_file');

			} else {
				$file_lama = $this->input->post('old_file');
				unlink(FCPATH.'assets/files/'.$file_lama);

				$data['file'] = $this->upload_file($_FILES['lampiran']);
			}

			$this->layanan_model->edit_layanan($id,$data);

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Layanan <strong>berhasil</strong> diperbarui</div>');

			redirect('admin/layanan');

		}
	}

	public function hapus_layanan($id) {
		$this->layanan_model->hapus_layanan($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Layanan <strong>berhasil</strong> dihapus</div>');

		redirect('admin/layanan');
	}

	public function arsipkan_layanan($id,$val) {

		$this->layanan_model->arsipkan($id, $val);

		if ($val == 1) {
			//jika akan diarsipakan
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Layanan <strong>diarsipkan</strong></div>');

		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Layanan <strong>batal</strong> diarsipkan</div>');

		}

			redirect('admin/layanan/edit_layanan/'.$id);

	}

	public function detail($slug) {

		$dat = $this->layanan_model->get_layanan($slug);

		$data['title'] = $dat['judul'];
		$data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
		$data['kategori'] = $this->db->get('kategori_layanan')->result_array();
		$data['layanan'] = $dat;
		
		$this->load->view('dashboard/template/header', $data);
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/user/detail_layanan', $data);
		$this->load->view('dashboard/template/footer');

	}

	public function tampilkan_depan($id,$val) {

		$jml_max_depan = 4;

		$is_avail = $this->layanan_model->is_avail_layanan_depan($jml_max_depan);
		$is_archived = $this->layanan_model->is_archived($id);

		if ($val == 1 && $is_avail && $is_archived == 0) {

			$this->layanan_model->tampilkan_depan($id, $val);

			//jika akan diarsipakan
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Layanan <strong>berhasil</strong> ditampilkan di beranda</div>');

		} elseif($val == 0) {

			$this->layanan_model->tampilkan_depan($id, $val);

			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Layanan <strong>batal</strong> ditampilkan di beranda</div>');

		} elseif($val == 1 && !$is_avail) {

			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Jumlah <strong>maksimal</strong> sudah terpenuhi. Hanya <strong>'.$jml_max_depan.' layanan</strong> yang dapat ditampilkan dihalaman depan. Silakan batalkan dahulu layanan yang lain.</div>');
		} elseif ($is_archived == 1) {
			
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Layanan yang diarsipkan <strong>tidak dapat</strong> ditampilkan di beranda</div>');
		}

		redirect('admin/layanan/edit_layanan/'.$id);

	}

	public function hapus_file($id) {

		if ($this->layanan_model->hapus_file($id)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>File lampiran <strong>berhasil</strong> dihapus</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert_dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>File lampiran <strong>gagal</strong> dihapus</div>');
		}
		
		redirect('admin/layanan/edit_layanan/'.$id);
	}




}
