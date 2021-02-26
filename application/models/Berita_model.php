<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_model extends CI_Model
{

	public function get_all_kategori()
	{
		return $this->db->get('kategori_berita')->result_array();
	}

	public function get_all_berita($limit, $start)
	{
		$q = "SELECT `berita`.`id`, `kategori`, `gambar`, `judul`, `konten`, `tanggal_dibuat`, `user`.`name` as `posted_by`, `slug`
				FROM `berita`
				LEFT JOIN `user`
				ON `berita`.`dipost_oleh` = `user`.`id`
				LEFT JOIN `kategori_berita`
				ON `berita`.`kategori_id` = `kategori_berita`.`id`
				ORDER BY `tanggal_dibuat` DESC
				LIMIT $start, $limit";

		return $this->db->query($q)->result_array();
	}

	public function get_some_berita($jml)
	{
		$q = "SELECT `berita`.`id` as `berita_id`, `judul`, `konten`, `arsipkan`, `slug`
					FROM `berita`
				LEFT JOIN `kategori_berita`
					ON `berita`.`kategori_id` = `kategori_berita`.`id`
					ORDER BY RAND()
					LIMIT $jml";

		return $this->db->query($q)->result_array();
	}

	public function get_berita_terbaru($jml)
	{
		$q = "SELECT `berita`.`id` as `berita_id`, `gambar`, `judul`, `konten`, `tanggal_dibuat`, `kategori`, `arsipkan`, `slug`
					FROM `berita`
				LEFT JOIN `kategori_berita`
					ON `berita`.`kategori_id` = `kategori_berita`.`id`
					ORDER BY `tanggal_dibuat` DESC
					LIMIT $jml";

		return $this->db->query($q)->result_array();
	}

	public function get_berita($slug)
	{
		$q = "SELECT `berita`.`id`, `kategori`, `gambar`, `judul`, `konten`, `arsipkan`, `tanggal_dibuat`, `user`.`name` as `posted_by`, `slug`
				FROM `berita`
				LEFT JOIN `user`
				ON `berita`.`dipost_oleh` = `user`.`id`
				LEFT JOIN `kategori_berita`
				ON `berita`.`kategori_id` = `kategori_berita`.`id`
				WHERE `berita`.`slug` = '$slug'";

		return $this->db->query($q)->row_array();
	}

	public function cek_last_id()
	{
		$this->db->select('id');
		return $this->db->get('berita')->last_row();
	}

	public function tambah_berita($data)
	{
		$this->db->insert('berita', $data);

		return true;
	}

	public function count_berita()
	{
		return count($this->db->get('berita')->result_array());
	}

	public function edit($slug, $data)
	{
		$this->db->where('slug', $slug);
		$this->db->update('berita', $data);

		return true;
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('berita');

		return true;
	}

	public function arsipkan($id, $val)
	{
		$this->db->where('id', $id);
		$this->db->set('arsipkan', $val);
		$this->db->update('berita');

		return true;
	}

	public function get_gambar($id)
	{
		$this->db->select('gambar');
		$this->db->where('id', $id);
		return $this->db->get('berita')->row_array();
	}

	public function tambah_kategori($data)
	{
		$this->db->insert('kategori_berita', array('kategori' => $data));

		return true;
	}

	public function edit_kategori($data)
	{
		$this->db->replace('kategori_berita', $data);

		return true;
	}

	public function hapus_kategori($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('kategori_berita');

		return true;
	}

	public function get_next($id)
	{
		$q = "SELECT `berita`.`id`, `kategori`, `gambar`, `judul`, `konten`, `arsipkan`, `tanggal_dibuat`, `user`.`name` as `posted_by`, `slug`
				FROM `berita`
				LEFT JOIN `user`
				ON `berita`.`dipost_oleh` = `user`.`id`
				LEFT JOIN `kategori_berita`
				ON `berita`.`kategori_id` = `kategori_berita`.`id`
				WHERE `berita`.`id` > '$id'
				ORDER BY `id` LIMIT 1";

		return $this->db->query($q)->row_array();
	}

	public function get_prev($id)
	{
		$q = "SELECT `berita`.`id`, `kategori`, `gambar`, `judul`, `konten`, `arsipkan`, `tanggal_dibuat`, `user`.`name` as `posted_by`, `slug`
				FROM `berita`
				LEFT JOIN `user`
				ON `berita`.`dipost_oleh` = `user`.`id`
				LEFT JOIN `kategori_berita`
				ON `berita`.`kategori_id` = `kategori_berita`.`id`
				WHERE `berita`.`id` < '$id'
				ORDER BY `id` DESC LIMIT 1";

		return $this->db->query($q)->row_array();
	}
}
