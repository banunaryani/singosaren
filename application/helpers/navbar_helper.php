<?php

function get_navbar() {

	$ci = get_instance();

	$q = "SELECT `id`, `menu_nav`, `link`, `is_active`, GROUP_CONCAT(
				DISTINCT CONCAT(`submenu`,',',`link_submenu`)
				ORDER BY `id_submenu`
				SEPARATOR ';'
			) as `submenus`
				FROM `navbar`
			LEFT JOIN `navbar_submenu`
				ON `navbar`.`id` = `navbar_submenu`.`navbar_menu`
				WHERE `is_active` = 1
			GROUP BY `id`
			ORDER BY `urutan` ASC";

	return $ci->db->query($q)->result_array();
}

?>