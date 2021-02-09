<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_model extends CI_Model {

	public function update($kolom,$data)
	{	
		$this->db->set($kolom,$data);
		$this->db->where('id',1);
		return $this->db->update('profil');
	}

	public function update_pedukuhan($data)
	{
		$this->db->set('pedukuhan',$data);
		$this->db->where('id',1);
		return $this->db->update('profil');
	}

	public function update_visi_misi($data)
	{
		$this->db->set('visi',$data['visi']);
		$this->db->set('misi',$data['misi']);
		$this->db->where('id',1);
		return $this->db->update('profil');
	}

	public function update_struktur($data)
	{
		$this->db->set('struktur',$data['struktur']);
		$this->db->set('gambar_struktur',$data['gambar_struktur']);
		$this->db->where('id',1);
		return $this->db->update('profil');
	}

	public function get_profil() {
		return $this->db->get('profil')->row_array();
	}
}
