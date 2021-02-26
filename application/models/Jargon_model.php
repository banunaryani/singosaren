<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jargon_model extends CI_Model
{

    public function update($data)
    {
        $this->db->where('id', 1);
        return $this->db->update('jargon', $data);
    }

    public function get_all()
    {
        return $this->db->get('jargon')->row_array();
    }

    public function get_old_favicon()
    {
        $this->db->select('favicon');
        return $this->db->get('deskripsi')->row_array();
    }

    public function get_old_logo()
    {
        $this->db->select('logo');
        return $this->db->get('deskripsi')->row_array();
    }
}
