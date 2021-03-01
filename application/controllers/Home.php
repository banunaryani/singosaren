<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('layanan_model');
		$this->load->model('berita_model');
		$this->load->model('potensi_model');
		$this->load->model('pranala_model');
		$this->load->model('user_model');
		$this->load->model('profil_model');
		$this->load->model('jargon_model');
		$this->load->model('peta_model');
	}

	public function index()
	{
		$data['deskripsi'] = $this->db->get('deskripsi')->row_array();
		$data['title'] = $data['deskripsi']['desa'] . ' - ' . $data['deskripsi']['kabkota'] . ', ' . $data['deskripsi']['provinsi'];

		$this->db->from('slideshow');
		$this->db->where('arsipkan', 0);
		$this->db->order_by('urutan ASC');
		$data['slideshow'] = $this->db->get()->result_array();
		$data['navbar'] = get_navbar(); //dari helper
		$data['layanan'] = $this->layanan_model->get_layanan_depan();
		$data['berita'] = $this->berita_model->get_berita_terbaru(5);
		$data['potensi'] = $this->potensi_model->get_all_potensi(6, 0);
		$data['kat_potensi'] = $this->potensi_model->get_all_kategori();
		$data['pranala'] = $this->pranala_model->get_all_pranala();
		$data['kontak'] = $this->user_model->get_kontak();
		$data['berita_f'] = $this->berita_model->get_berita_terbaru(2);
		$data['jargon'] = $this->jargon_model->get_all();

		$this->load->view('template/header', $data);
		$this->load->view('index', $data);
		$this->load->view('template/footer', $data);
	}

	public function layanan()
	{
		$data['title'] = "Layanan Masyarakat";
		$data['deskripsi'] = $this->db->get('deskripsi')->row_array();
		$data['navbar'] = get_navbar(); //dari helper
		$data['kategori'] = $this->layanan_model->get_all_kategori();
		$data['layanan'] = $this->layanan_model->get_all_layanan_publik();
		$data['kontak'] = $this->user_model->get_kontak();
		$data['berita_f'] = $this->berita_model->get_berita_terbaru(2);

		$this->load->view('template/header', $data);
		$this->load->view('layanan', $data);
		$this->load->view('template/footer', $data);
	}

	public function detail_layanan($slug)
	{
		$dat = $this->layanan_model->get_layanan($slug);

		$data['title'] = $dat['judul'];
		$data['deskripsi'] = $this->db->get('deskripsi')->row_array();
		$data['navbar'] = get_navbar(); //dari helper
		$data['layanan'] = $dat;
		$data['some_layanan'] = $this->layanan_model->get_some_layanan(4);
		$data['kontak'] = $this->user_model->get_kontak();
		$data['berita_f'] = $this->berita_model->get_berita_terbaru(2);

		$this->load->view('template/header', $data);
		$this->load->view('detail_layanan', $data);
		$this->load->view('template/footer', $data);
	}

	public function berita()
	{
		$data['title'] = "Kabar Desa";
		$data['deskripsi'] = $this->db->get('deskripsi')->row_array();
		$data['navbar'] = get_navbar(); //dari helper
		$data['kategori'] = $this->berita_model->get_all_kategori();
		$data['kontak'] = $this->user_model->get_kontak();
		$data['berita_f'] = $this->berita_model->get_berita_terbaru(2);

		//pagination
		$config['base_url'] = base_url('berita');
		$config['total_rows'] = $this->berita_model->count_berita();
		$config['per_page'] = 6;
		$config['query_string_segment'] = 'page';
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination-list">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li class="page-numbers">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-numbers current"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);

		$page_now = ($this->input->get('page')) ? $this->input->get('page') : 0;

		$data['pages'] = $this->pagination->create_links();

		$data['berita'] = $this->berita_model->get_active_berita($config['per_page'], $page_now);

		$this->load->view('template/header', $data);
		$this->load->view('berita', $data);
		$this->load->view('template/footer', $data);
	}

	public function detail_berita($slug)
	{
		$dat = $this->berita_model->get_berita($slug);

		$data['title'] = $dat['judul'];
		$data['deskripsi'] = $this->db->get('deskripsi')->row_array();
		$data['navbar'] = get_navbar(); //dari helper
		$data['berita'] = $dat;
		$data['some_berita'] = $this->berita_model->get_some_berita(4);
		$data['next'] = $this->berita_model->get_next($dat['id']);
		$data['prev'] = $this->berita_model->get_prev($dat['id']);
		$data['kontak'] = $this->user_model->get_kontak();
		$data['berita_f'] = $this->berita_model->get_berita_terbaru(2);

		$this->load->view('template/header', $data);
		$this->load->view('detail_berita', $data);
		$this->load->view('template/footer', $data);
	}

	public function potensi()
	{
		$data['title'] = "Potensi Desa";
		$data['deskripsi'] = $this->db->get('deskripsi')->row_array();
		$data['navbar'] = get_navbar(); //dari helper
		$data['kategori'] = $this->potensi_model->get_all_kategori();
		$data['potensi'] = $this->potensi_model->get_all_potensi($this->potensi_model->count_potensi(), 0);
		$data['kontak'] = $this->user_model->get_kontak();
		$data['berita_f'] = $this->berita_model->get_berita_terbaru(2);

		$this->load->view('template/header', $data);
		$this->load->view('potensi', $data);
		$this->load->view('template/footer', $data);
	}

	public function detail_potensi($slug)
	{
		$dat = $this->potensi_model->get_potensi($slug);

		$data['title'] = $dat['judul'];
		$data['deskripsi'] = $this->db->get('deskripsi')->row_array();
		$data['navbar'] = get_navbar(); //dari helper
		$data['potensi'] = $dat;
		$data['some_potensi'] = $this->potensi_model->get_some_potensi(4);
		$data['kontak'] = $this->user_model->get_kontak();
		$data['berita_f'] = $this->berita_model->get_berita_terbaru(2);

		$this->load->view('template/header', $data);
		$this->load->view('detail_potensi', $data);
		$this->load->view('template/footer', $data);
	}

	public function profil()
	{
		$data['title'] = 'Profil Desa';
		$data['deskripsi'] = $this->db->get('deskripsi')->row_array();
		$data['navbar'] = get_navbar(); //dari helper
		$data['kontak'] = $this->user_model->get_kontak();
		$data['berita_f'] = $this->berita_model->get_berita_terbaru(2);
		$data['profil'] = $this->profil_model->get_profil();

		$this->load->view('template/header', $data);
		$this->load->view('profil', $data);
		$this->load->view('template/footer', $data);
	}

	public function peta()
	{
		$data['title'] = 'Peta Wilayah Desa';
		$data['deskripsi'] = $this->db->get('deskripsi')->row_array();
		$data['navbar'] = get_navbar(); //dari helper
		$data['kontak'] = $this->user_model->get_kontak();
		$data['berita_f'] = $this->berita_model->get_berita_terbaru(2);
		$data['profil'] = $this->profil_model->get_profil();

		$this->load->view('template/header', $data);
		$this->load->view('maps', $data);
		$this->load->view('template/footer', $data);
	}

	public function get_persil()
	{
		$no = $this->input->post('no');
		$rt = $this->input->post('rt');
		$data = $this->peta_model->get_persil($no, $rt);

		echo json_encode($data);
	}

	public function get_rt()
	{
		$rt = $this->input->post('rt');
		$dukuh = $this->input->post('dukuh');
		$data = $this->peta_model->get_rt($rt, $dukuh);

		echo json_encode($data);
	}

	public function get_dukuh()
	{
		$id = $this->input->post('id');
		$data = $this->peta_model->get_dukuh($id);

		echo json_encode($data);
	}
}
