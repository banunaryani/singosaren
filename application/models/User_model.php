<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function update_kontak($data) {
		$this->db->where('id',1);
		return $this->db->update('kontak', $data);
	}

	public function get_kontak() {
		return $this->db->get('kontak')->row_array();
	}

	public function get_old_favicon() {
		$this->db->select('favicon');
		return $this->db->get('deskripsi')->row_array();
	}

	public function get_old_logo() {
		$this->db->select('logo');
		return $this->db->get('deskripsi')->row_array();
	}
}