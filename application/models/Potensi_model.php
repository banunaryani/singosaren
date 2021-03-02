<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Potensi_model extends CI_Model
{
	public function tambah($data)
	{
		$this->db->insert('potensi', $data);

		return true;
	}

	public function cek_last_id()
	{
		$this->db->select('id');

		return $this->db->get('potensi')->last_row();
	}

	public function get_all_kategori()
	{
		return $this->db->get('kategori_potensi')->result_array();
	}

	public function get_all_potensi($limit, $start)
	{
		$q = "SELECT `potensi`.`id`, `kategori`, `gambar`, `judul`, `konten`, `tanggal_dibuat`, `arsipkan`, `user`.`name` as `posted_by`, `slug`
				FROM `potensi`
				LEFT JOIN `user`
				ON `potensi`.`dipost_oleh` = `user`.`id`
				LEFT JOIN `kategori_potensi`
				ON `potensi`.`kategori_id` = `kategori_potensi`.`id`
				ORDER BY `tanggal_dibuat` DESC
				LIMIT $start, $limit";

		return $this->db->query($q)->result_array();
	}

	public function get_active_potensi($limit, $start)
	{
		$q = "SELECT `potensi`.`id`, `kategori`, `gambar`, `judul`, `konten`, `tanggal_dibuat`, `arsipkan`, `user`.`name` as `posted_by`, `slug`
				FROM `potensi`
				LEFT JOIN `user`
				ON `potensi`.`dipost_oleh` = `user`.`id`
				LEFT JOIN `kategori_potensi`
				ON `potensi`.`kategori_id` = `kategori_potensi`.`id`
				WHERE `arsipkan` = 0
				ORDER BY `tanggal_dibuat` DESC
				LIMIT $start, $limit";

		return $this->db->query($q)->result_array();
	}

	public function count_potensi()
	{
		return count($this->db->get('potensi')->result_array());
	}

	public function count_active_potensi()
	{
		return count($this->db->where('arsipkan', 0)->get('potensi')->result_array());
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('potensi');

		return true;
	}

	public function get_gambar($id)
	{
		$this->db->select('gambar');
		$this->db->where('id', $id);

		return $this->db->get('potensi')->row_array();
	}

	public function get_potensi($slug)
	{
		$q = "SELECT `potensi`.`id`, `kategori`, `gambar`, `judul`, `konten`, `arsipkan`, `tanggal_dibuat`, `user`.`name` as `posted_by`, `slug`
				FROM `potensi`
				LEFT JOIN `user`
				ON `potensi`.`dipost_oleh` = `user`.`id`
				LEFT JOIN `kategori_potensi`
				ON `potensi`.`kategori_id` = `kategori_potensi`.`id`
				WHERE `potensi`.`slug` = '$slug'";

		return $this->db->query($q)->row_array();
	}

	public function get_some_potensi($jml)
	{
		$q = "SELECT `potensi`.`id` as `potensi`, `judul`, `konten`, `arsipkan`, `slug`
					FROM `potensi`
				LEFT JOIN `kategori_potensi`
					ON `potensi`.`kategori_id` = `kategori_potensi`.`id`
					ORDER BY RAND()
					LIMIT $jml";

		return $this->db->query($q)->result_array();
	}

	public function edit($slug, $data)
	{
		$this->db->where('slug', $slug);
		$this->db->update('potensi', $data);

		return true;
	}

	public function arsipkan($slug, $val)
	{
		$this->db->where('slug', $slug);
		$this->db->set('arsipkan', $val);
		$this->db->update('potensi');

		return true;
	}

	// ======================================
	// KATEGORI
	// ======================================

	public function tambah_kategori($data)
	{
		$this->db->insert('kategori_potensi', array('kategori' => $data));

		return true;
	}

	public function edit_kategori($id, $kat)
	{
		$this->db->set('kategori', $kat);
		$this->db->where('id', $id);
		$this->db->update('kategori_potensi');

		return true;
	}

	public function hapus_kategori($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('kategori_potensi');

		return true;
	}
}
