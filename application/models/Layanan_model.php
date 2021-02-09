<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan_model extends CI_Model {

	public function tambah_kategori($data)
	{	
		$this->db->insert('kategori_layanan', array('kategori' => $data));

		return true;
	}

	public function hapus_kategori($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('kategori_layanan');

		return true;
	}

	public function edit_kategori($data) {
		$this->db->replace('kategori_layanan', $data);

		return true;
	}

	public function tambah_layanan($data)
	{	
		$this->db->insert('layanan', $data);

		return true;
	}

	public function edit_layanan($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('layanan', $data);

		return true;
	}

	public function arsipkan($id, $val) {
		$this->db->where('id', $id);
		$this->db->set('arsipkan', $val);
		$this->db->update('layanan');

		return true;
	}

	public function hapus_layanan($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('layanan');

		return true;
	}

	public function get_all_layanan() {
		$q = "SELECT `layanan`.`id` as `layanan_id`, `kategori`, `judul`, `konten`,`file`, `arsipkan`, `slug`, `tampil_beranda`
					FROM `layanan`
				LEFT JOIN `kategori_layanan`
					ON `layanan`.`kategori_id` = `kategori_layanan`.`id`";

		return $this->db->query($q)->result_array();
	}

	public function get_some_layanan($jml) {
		$q = "SELECT `layanan`.`id` as `layanan_id`, `kategori`, `judul`, `konten`, `arsipkan`, `slug`, `tampil_beranda`
					FROM `layanan`
				LEFT JOIN `kategori_layanan`
					ON `layanan`.`kategori_id` = `kategori_layanan`.`id`
					ORDER BY RAND()
					LIMIT $jml";

		return $this->db->query($q)->result_array();
	}

	public function get_all_kategori() {
		return $this->db->get('kategori_layanan')->result_array();
	}

	public function get_layanan($slug)
	{
		$q = "SELECT `layanan`.`id` as `layanan_id`, `kategori`, `judul`,`file`, `konten`, `arsipkan`, `slug`, `tampil_beranda`
					FROM `layanan`
				LEFT JOIN `kategori_layanan`
					ON `layanan`.`kategori_id` = `kategori_layanan`.`id`
				WHERE `slug` = '$slug'";

		return $this->db->query($q)->row_array();
	}

	public function get_kategori($id)
	{
		return $this->db->get_where('kategori_layanan', ['id' => $id])->row_array();
	}

	public function tampilkan_depan($id, $val) {
		$this->db->where('id', $id);
		$this->db->set('tampil_beranda', $val);
		$this->db->update('layanan');

		return true;
	}

	public function get_layanan_depan() {
		return $this->db->get_where('layanan' ,['tampil_beranda' => 1, 'arsipkan' => 0])->result_array();
	}

	public function is_avail_layanan_depan($max) {
		$this->db->where('tampil_beranda', 1);
		$count = $this->db->count_all_results('layanan');

		if ($count > $max || $count == $max) {
			return false;
		} else {
			return true;
		}
	}

	public function is_archived($id)
	{
		return $this->db->get_where('layanan', ['id' => $id])->row()->arsipkan;

	}

	public function hapus_file($id) {
		$this->db->set('file',null);
		$this->db->where('id', $id);
		
		return $this->db->update('layanan');
	}
}
