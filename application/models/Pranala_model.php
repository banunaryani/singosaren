<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pranala_model extends CI_Model {
	public function tambah($data)
	{	
		$this->db->insert('pranala', $data);

		return true;
	}

	public function cek_last_id() {
		$this->db->select('id');

		return $this->db->get('pranala')->last_row();
	}

	public function get_all_pranala() {
		return $this->db->get('pranala')->result_array();
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pranala');

		return true;
	}

	public function get_gambar($id) {
		$this->db->select('logo');
		$this->db->where('id',$id);

		return $this->db->get('pranala')->row_array();
	}

	public function get_pranala($id) {
		$this->db->where('id',$id);

		return $this->db->get('pranala')->row_array();
	}

	public function edit($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('pranala',$data);

		return true;
	}
}