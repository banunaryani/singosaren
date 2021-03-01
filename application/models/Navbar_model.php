<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Navbar_model extends CI_Model
{

	public function get_all_menu_submenu()
	{
		$q = "SELECT `id`, `menu_nav`, `link`, `is_active`, `urutan`, GROUP_CONCAT(`submenu` separator ', ') as `submenus`
					FROM `navbar`
				LEFT JOIN `navbar_submenu`
					ON `navbar`.`id` = `navbar_submenu`.`navbar_menu`
				GROUP BY `id`
				ORDER BY `urutan` ASC";

		return $this->db->query($q)->result_array();
	}

	public function get_all_submenu()
	{
		return $this->db->get('navbar_submenu')->result_array();
	}

	public function aktifkan($id, $val)
	{
		$this->db->set('is_active', !$val);
		$this->db->where('id', $id);

		return $this->db->update('navbar');
	}

	public function get_menu($id)
	{
		$this->db->select('*');
		$this->db->from('navbar');
		$this->db->where('id', $id);

		return $this->db->get()->row_array();
	}

	public function get_submenu($id)
	{
		$this->db->select('id_submenu ,navbar_menu, submenu, link_submenu');
		$this->db->from('navbar');
		$this->db->join('navbar_submenu', 'navbar.id = navbar_submenu.navbar_menu');
		$this->db->where('navbar_menu', $id);

		return $this->db->get()->result_array();
	}

	public function count_navbar()
	{
		return $this->db->count_all('navbar');
	}

	public function edit($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('navbar', $data);
	}

	public function tambah($data)
	{
		return $this->db->insert('navbar', $data);
	}

	public function get_insert_id()
	{
		return $this->db->insert_id();
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('navbar');
	}

	public function tambah_submenu($data)
	{
		return $this->db->insert('navbar_submenu', $data);
	}

	public function hapus_submenu_by_menu_id($id)
	{
		$this->db->where('navbar_menu', $id);
		return $this->db->delete('navbar_submenu');
	}

	public function hapus_submenu_by_id($id)
	{
		$this->db->where('id_submenu', $id);
		return $this->db->delete('navbar_submenu');
	}

	public function edit_submenu($id, $data)
	{
		$this->db->where('id_submenu', $id);
		return $this->db->update('navbar_submenu', $data);
	}
}
