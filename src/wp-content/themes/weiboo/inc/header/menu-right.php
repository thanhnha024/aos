<?php
if ( has_nav_menu( 'menu-5' ) ) {
    // User has assigned menu to this location;
    // output it
    ?>
    <nav class="nav navbar">
        <div class="navbar-menu">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-5',
                    'menu_id'        => 'primary-menu-singles1',
                ) );
            ?>
        </div>
    </nav>
    <?php
}
?>