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
        <img
          src="admin/uploads/lorem.png"
          alt="navbar brand"
          class="navbar-brand"
          height="70"
          width="150"
        />
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
        <?php foreach ($rowMainMenu as $mainMenu): ?>
          <?php
            $id_menu = $mainMenu['id'];
            $querySubMenu = mysqli_query(
              $config,
              "SELECT DISTINCT menus.* FROM menus
               JOIN menu_roles ON menus.id = menu_roles.id_menu
               JOIN user_roles ON user_roles.id_role = menu_roles.id_roles
               WHERE user_roles.id_user = '$id_user'
               AND parent_id = '$id_menu' ORDER BY urutan ASC"
            );
          ?>
          <?php if (mysqli_num_rows($querySubMenu) > 0): ?>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#menu-<?php echo $mainMenu['id'] ?>" class="collapsed" aria-expanded="false">
                <i class="<?php echo $mainMenu['icon'] ?>"></i>
                <p><?php echo $mainMenu['name'] ?></p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="menu-<?php echo $mainMenu['id'] ?>">
                <ul class="nav nav-collapse">
                  <?php while ($rowSubMenu = mysqli_fetch_assoc($querySubMenu)): ?>
                    <li>
                      <a href="?page=<?php echo $rowSubMenu['url'] ?>">
                        <span class="sub-item"><?php echo $rowSubMenu['name'] ?></span>
                      </a>
                    </li>
                  <?php endwhile; ?>
                </ul>
              </div>
            </li>
          <?php elseif (!empty($mainMenu['url'])): ?>
            <li class="nav-item">
              <a href="<?php echo $mainMenu['url'] ?>">
                <i class="<?php echo $mainMenu['icon'] ?>"></i>
                <p><?php echo $mainMenu['name'] ?></p>
              </a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
