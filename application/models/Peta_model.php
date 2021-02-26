<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peta_model extends CI_Model
{

	public function get_all_dukuh()
	{
		return $this->db->get('map_dukuh')->result_array();
	}

	public function get_dukuh($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('map_dukuh')->row_array();
	}

	public function replace_pedukuhan($id, $data)
	{
		$this->db->set($data);
		$this->db->where('id', $id);

		return $this->db->update('map_dukuh');
	}


	public function get_all_rt()
	{
		$this->db->select('map_rt.id as id, rt, map_dukuh.dukuh as dukuh, map_rt.penduduk as penduduk, map_rt.luas as luas');
		$this->db->from('map_rt');
		$this->db->join('map_dukuh', 'map_rt.dukuh = map_dukuh.id', 'left');
		$this->db->order_by('map_rt.dukuh', 'ASC');
		return $this->db->get()->result_array();
	}

	public function get_rt($rt, $dukuh)
	{
		$this->db->select('map_rt.id as rt_id, map_dukuh.id as dukuh_id, rt, map_dukuh.dukuh, map_rt.penduduk as penduduk_rt, map_rt.luas as luas_rt');
		$this->db->from('map_rt');
		$this->db->join('map_dukuh', 'map_rt.dukuh = map_dukuh.id', 'left');
		$this->db->where('rt', $rt);
		$this->db->where('map_rt.dukuh', $dukuh);
		return $this->db->get()->row_array();
	}


	public function replace_rt($rt, $dukuh, $data)
	{

		// $q = "INSERT INTO `map_rt` (`rt`, `dukuh`, `penduduk`, `luas`)
		// 	SELECT * FROM (SELECT '".$rt."' as rt, '".$dukuh."' as dukuh, '".$data['penduduk']."' as penduduk, '".$data['luas']."' as luas) AS tmp
		// 	WHERE NOT EXISTS ( SELECT `rt`,`dukuh` FROM `map_rt` WHERE `rt` = '".$rt."' AND `dukuh` = '".$dukuh."' AND `penduduk` = '".$data['penduduk']."' AND `luas` = '".$data['luas']."') LIMIT 1";

		// return $this->db->query($q);

		$this->db->set($data);
		$this->db->where('rt', $rt);
		$this->db->where('dukuh', $dukuh);
		return $this->db->update('map_rt');
	}


	public function get_all_persil()
	{
		$this->db->select('map_persil.no as no_persil, rt, map_dukuh.dukuh, map_dukuh.id as dukuh_id, rw, map_persil.penduduk as penduduk, map_persil.luas as luas');
		$this->db->from('map_persil');
		$this->db->join('map_dukuh', 'map_persil.dukuh = map_dukuh.id', 'left');
		$this->db->order_by('map_persil.dukuh', 'ASC');
		return $this->db->get()->result_array();
	}

	public function get_persil($no, $rt)
	{
		$this->db->select('map_persil.id as persil_id, map_persil.no as persil_no, rt, rw, map_dukuh.id as dukuh_id, map_dukuh.dukuh as dukuh, rt, map_persil.penduduk as penduduk, map_persil.luas as luas');
		$this->db->from('map_persil');
		$this->db->join('map_dukuh', 'map_persil.dukuh = map_dukuh.id', 'left');
		$this->db->where('map_persil.no', $no);
		$this->db->where('map_persil.rt', $rt);

		return $this->db->get()->row_array();
	}

	private function is_exist_persil($persil, $rt, $dukuh)
	{
		$this->db->where('no', $persil);
		$this->db->where('rt', $rt);
		$this->db->where('dukuh', $dukuh);
		return $this->db->get('map_persil')->num_rows();
	}


	public function replace_persil($data)
	{

		if ($this->is_exist_persil($data['no'], $data['rt'], $data['dukuh']) == 0) {
			echo "insert";
			return $this->db->insert('map_persil', $data);
		} else {
			echo "update";
			$this->db->set($data);
			$this->db->where('no', $data['no']);
			$this->db->where('rt', $data['rt']);
			return $this->db->update('map_persil');
		}

		// $q = "INSERT INTO `map_persil` (`no`, `rt`, `dukuh`)
		// 	SELECT * FROM (SELECT '".$persil."' as no, '".$rt."' as rt, '".$dukuh."' as dukuh) AS tmp
		// 	WHERE NOT EXISTS ( SELECT `no`,`rt`,`dukuh` FROM `map_persil` WHERE `no` = '".$persil."' AND `rt` = '".$rt."' AND `dukuh` = '".$dukuh."' ) LIMIT 1";

		// return $this->db->query($q);

	}
}
