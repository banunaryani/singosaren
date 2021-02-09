<?php

function is_logged_in()
{
	$ci = get_instance();

	if ($ci->session->userdata('logged') == FALSE)
    {
        redirect('auth');
    }

}

function is_authorized()
{
	$ci = get_instance();

	$role = $ci->session->userdata('role_id');
	$menu = $ci->uri->segment(1);

	$qmenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
	$m = $qmenu['menu_id'];

	$qaccess = $ci->db->get_where('user_access_menu', ['menu_id' => $m, 'role_id' => $role])->row_array();

	if ($qaccess == null) {
		redirect('auth/blocked');
	}

}