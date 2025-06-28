<?php
$id_user = $_SESSION['ID_USER'] ?? '';
$queryMainMenu = mysqli_query(
    $config,
    "SELECT DISTINCT menus.* FROM menus 
    JOIN menu_roles ON menus.id = menu_roles.id_menu
    JOIN user_roles ON user_roles.id_role = menu_roles.id_roles
    WHERE user_roles.id_user = '$id_user' 
    AND (parent_id = 0 OR parent_id = '')
    ORDER BY urutan ASC"
);
$rowMainMenu = mysqli_fetch_all($queryMainMenu, MYSQLI_ASSOC);

// Pisahkan dashboard ke atas
$dashboardMenu = [];
$otherMenus = [];

foreach ($rowMainMenu as $menu) {
    if ($menu['url'] === 'dashboard') {
        $dashboardMenu[] = $menu;
    } else {
        $otherMenus[] = $menu;
    }
}

// Gabungkan kembali, dashboard duluan
$finalMenus = array_merge($dashboardMenu, $otherMenus);
?>

<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="?page=dashboard" class="logo">
                <img src="template/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
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
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <?php foreach ($finalMenus as $mainMenu): ?>
                    <?php
                    $id_menu = $mainMenu['id'];
                    $querySubMenu = mysqli_query(
                        $config,
                        "SELECT DISTINCT menus.* FROM menus
                        JOIN menu_roles ON menus.id = menu_roles.id_menu
                        JOIN user_roles ON user_roles.id_role = menu_roles.id_roles
                        WHERE user_roles.id_user = '$id_user'
                        AND parent_id = '$id_menu' 
                        ORDER BY urutan ASC"
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
                                        <li <?= (isset($_GET['page']) && $_GET['page'] == $rowSubMenu['url']) ? 'class="active"' : '' ?>>
                                            <a href="?page=<?php echo $rowSubMenu['url'] ?>">
                                                <span class="sub-item"><?php echo $rowSubMenu['name'] ?></span>
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </li>
                    <?php elseif (!empty($mainMenu['url'])): ?>
                        <li class="nav-item <?= (isset($_GET['page']) && $_GET['page'] == $mainMenu['url']) ? 'active' : '' ?>">
                            <a href="?page=<?php echo $mainMenu['url'] ?>">
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
