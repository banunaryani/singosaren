<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">Dashboard</div>
      </a>

      <?php

      $role_id = $this->session->userdata('role_id');

      $q1 = "SELECT `user_menu`.`menu_id`, `menu`
                  FROM `user_menu`
            INNER JOIN `user_access_menu`
                    ON `user_menu`.`menu_id`=`user_access_menu`.`menu_id`
                 WHERE `user_access_menu`.`role_id`=$role_id
              ORDER BY `user_access_menu`.`menu_id` DESC";

      $menu = $this->db->query($q1)->result_array();

      foreach ($menu as $m) {

      ?>

      <!-- Heading -->
      <div class="sidebar-heading mb-2">
        <?= $m['menu'] ?>
      </div>

      <?php
      $id_menu = $m['menu_id'];

      $q2 = "SELECT `user_sub_menu`.`id`, `user_sub_menu`.`title`, `url`, `icon`
                  FROM `user_sub_menu`
            INNER JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id`=`user_menu`.`menu_id`
                 WHERE `user_sub_menu`.`menu_id`= $id_menu && `user_sub_menu`.`is_active`=1
              ORDER BY `user_sub_menu`.`id` ASC";

      $submenu = $this->db->query($q2)->result_array();

      foreach ($submenu as $sm) {

      ?>

      <!-- Nav Item - Charts -->
      <li class="nav-item <?= ($title == $sm['title'])? "active":"" ?>">
        <a class="nav-link" href="<?= base_url().$sm['url'] ?>">
          <i class="<?= $sm['icon'] ?>"></i>
          <span><?= $sm['title'] ?></span></a>
      </li>

      <?php
      }
      ?>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <?php
      } //end foreach menu as m
      ?>

      <!-- Nav Item - Utilities Collapse Menu -->
    <!--   <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
          </div>
        </div>
      </li> -->

    </ul>
    <!-- End of Sidebar -->