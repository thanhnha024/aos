<?php
if ( has_nav_menu( 'menu-6' ) ) {
    // User has assigned menu to this location;
    // output it
    ?>
    <nav class="nav navbar">
        <div class="navbar-menu dd">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-6',
                    'menu_id'        => 'primary-menu-singles',
                ) );
            ?>
        </div>
    </nav>
    <?php
}
?>