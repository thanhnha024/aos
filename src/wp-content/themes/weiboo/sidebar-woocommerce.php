<?php

if ( ! is_active_sidebar( 'sidebar_shop' ) ) {
  return;}
?>
<div class="col-md-3 sidebar-gap">
  <aside id="secondary" class="widget-area">
    <div class="react-sideabr dynamic-sidebar">
      <?php
        dynamic_sidebar( 'sidebar_shop' );
      ?>
    </div>
  </aside>
</div>

