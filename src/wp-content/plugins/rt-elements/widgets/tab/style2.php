  <div class="rstab-main style-2 <?php echo esc_attr($settings['type']); ?> <?php echo esc_attr($settings['tabs_item_width']); ?>"> 
    <di class="row">
        <div class="col-lg-4">
            <ul  class="nav nav-nav-tabs <?php echo esc_attr($settings['tab_design']);?> <?php echo esc_attr($settings['tab_icon_position']);?>">
                <?php
                $unique = rand(2012,3554120);
                $x = 0;
               
                foreach ( $tabs as $index => $item ) :
                    $x++;
                   

                    if($x == 1){
                        $active_tab = 'active';
                    }else{
                        $active_tab = '';
                    }

                    $tab_count = $index + 1;
                    $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

                    $this->add_render_attribute( $tab_title_setting_key, [
                        'id' => 'elementor-tab-title-' . $id_int . $tab_count,
                        'class' => [ 'elementor-tab-title', 'elementor-tab-desktop-title' ],
                        'data-tab' => $tab_count,
                        'role' => 'tab',
                        'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                    ] );

                    $icon = !empty($item['tab_icon']) ? '<i class="'.$item['tab_icon'].'"></i>': '';
                    
                    $titleimg    = !empty($item['selected_image']) ? '<img src="'. $item['selected_image']['url']. '"  alt="tab-iamge"/>' : '';
                    ?>
                    <li class="nav-item"><a class="nav-link <?php echo esc_attr($active_tab); ?>" data-toggle="tab" href="#a<?php echo esc_html($x);?><?php echo esc_html( $unique );?>" role="tablist" aria-selected="true">
                        <?php if(!empty($icon)){
                            echo wp_kses_post ( $icon );
                            } else{
                                echo ($titleimg);
                            }
                        ?>
                        <?php echo esc_html($item['tab_title']); ?>
                        <i class="rt-arrow-right-long"></i></a>
                    </li>

                <?php endforeach; ?>                    
            </ul>
        </div>
        <div class="col-lg-8">
            <div class="tab-content clearfix">
                <?php
                    $x = 0;
                    foreach ( $tabs as $index => $item ) :
                        $tab_count = $index + 1;
                        $x++;
                        if($x == 1){
                            $active_tab = 'active';
                        }else{
                            $active_tab = '';
                        }
                        $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

                        $tab_title_mobile_setting_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

                        $this->add_render_attribute( $tab_content_setting_key, [
                            'id' => 'elementor-tab-content-' . $id_int . $tab_count,
                            'class' => [ 'elementor-tab-content', 'elementor-clearfix' ],
                            'data-tab' => $tab_count,
                            'role' => 'tabpanel',
                            'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
                        ] );

                        $this->add_render_attribute( $tab_title_mobile_setting_key, [
                            'class' => [ 'elementor-tab-title', 'elementor-tab-mobile-title' ],
                            'data-tab' => $tab_count,
                            'role' => 'tab',
                        ] );

                        $this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );                       
                        ?>
                       
                        <div class="tab-pane <?php echo esc_attr($active_tab);?>" id="a<?php echo esc_html($x);?><?php echo esc_html($unique);?>">
                            <?php echo $this->parse_text_editor( $item['tab_content'] ); ?>                                
                        </div>
                <?php endforeach; ?>
                                               
            </div>
        </div>
    </di>    
          
</div>