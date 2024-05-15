<?php
if ( has_nav_menu( 'menu-4' ) ) {
    // User has assigned menu to this location;
    // output it
    ?>
    <nav class="nav navbar">
        <div class="navbar-menu">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-4',
                    'menu_id'        => 'primary-menu-single8',
                ) );
            ?>
        </div>
    </nav>
    <?php
}
?>