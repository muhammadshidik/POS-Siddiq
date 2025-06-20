<?php
$id_user = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '';
$queryMainMenu = mysqli_query(
    $config,
    "SELECT DISTINCT menus.* FROM menus 
    JOIN menu_roles ON menus.id = menu_roles.id_menu
    JOIN user_roles ON user_roles.id_role = menu_roles.id_roles
    WHERE user_roles.id_user = '$id_user' 
    AND parent_id = 0 OR parent_id = ''
    ORDER BY urutan ASC"
);
$rowMainMenu = mysqli_fetch_all($queryMainMenu, MYSQLI_ASSOC);
// echo "<pre>";
// print_r($rowMainMenu);
// die;
?>

        

<div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img
                src="assets/img/kaiadmin/logo_light.svg"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                    <i class="fa fa-ellipsis-h"></i>
                     </span>
                <h4 class="text-section">Poin of sale</h4>
              </li>
                  <?php foreach ($rowMainMenu as $mainMenu): ?>
                              <?php
                              $id_menu = $mainMenu['id'];
                              $querySubMenu = mysqli_query(
                                  $config,
                                  "SELECT DISTINCT menus.* FROM menus
                                   JOIN menu_roles ON menus.id = menu_roles.id_menu
                                   JOIN user_roles ON user_roles.id_role = menu_roles.id_roles
                                   WHERE user_roles.id_user = '$id_user'
                                   AND parent_id ='$id_menu' ORDER BY urutan ASC"
                              );
                              ?>
                              <?php if (mysqli_num_rows($querySubMenu) > 0): ?>
                                  <li class="nav-item active ">
                                      <a class="collapsed" data-bs-target="#menu-<?php echo $mainMenu['id'] ?>" data-bs-toggle="collapse" href="#">
                                          <i class="<?php echo $mainMenu['icon'] ?> "></i><span><?php echo $mainMenu['name'] ?></span><i class=""></i>
                                      </a>
                                      <ul id="menu-<?php echo $mainMenu['id'] ?>" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                                          <?php while ($rowSubMenu = mysqli_fetch_assoc($querySubMenu)): ?>
                                              <li>
                                                  <a class="" href="?page=<?php echo $rowSubMenu['url'] ?>">
                                                      <i class="<?php echo $rowSubMenu['icon'] ?>"></i><span><?php echo $rowSubMenu['name'] ?></span>
                                                  </a>
                                              </li>
                                          <?php endwhile ?>
                                      </ul>
                                  </li><!-- End Components Nav -->
                              <?php elseif (!empty($mainMenu['url'])): ?>
                                  <li class="nav-item">
                                      <a class="collapsed" href="<?php echo $mainMenu['url'] ?>">
                                          <i class="<?php echo $mainMenu['icon'] ?>"></i>
                                          <span><?php echo $mainMenu['name'] ?></span>
                                      </a>
                                  </li>
                              <?php endif ?>
                          <?php endforeach ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
