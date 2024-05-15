<?php

// Adds Weiboo Product Categories widget.
class weiboo_pcats extends WP_Widget {

	// Register widget with WordPress.
	function __construct() {
		parent::__construct(
			'weiboo_pcats', // Base ID
			__( 'Weiboo Product Categories', 'weiboo' ), // Name
			array( 'description' => __( 'Show Product Categories and Subcategories', 'weiboo' ), ) // Args
		);
	}

	// Front-end display of widget.
	public function widget( $args, $instance ) {
		// echo $args['before_widget'];
		?>
			<div class="widget weiboo-pcat col-lg-12 mx-auto mb25">
				<div id="categories" class="widget-bg p20">
					<h2 class="widget-title"><?php esc_html_e( 'Product Category', 'weiboo' ); ?></h2>

					<nav class='animated bounceInDown'>
						<ul>
							<?php
							$taxonomies = get_terms( array(
								'taxonomy' => 'product_cat', //Custom taxonomy name
								'hide_empty' => true
							) );

							if ( !empty($taxonomies) ) :
								foreach( $taxonomies as $category ) {
									if( $category->parent == 0 ) {
										
										//remove uncategorized from loop
										if( $category->slug == 'uncategorized' ){
											continue;
										}
										$name_count = $category->name.' ('.$category->count.')';
										$clink = get_term_link( $category );
										//Parent category information
										// echo esc_html__($category->name, 'text-domain');
										// echo esc_html__($category->description, 'text-domain');
										// echo esc_html__($category->slug, 'text-domain');
										// echo esc_html__($category->count, 'text-domain');
										$cat_child = get_term_children($category->term_id, 'product_cat');
										if($cat_child){
											//Sub category information
											?>
											<li class='sub-menu'>
												<a href='<?php echo esc_url($clink); ?>'><?php echo esc_html__( $name_count, 'text-domain' ) ?>
													<!-- <div class='fa fa-caret-down right'></div> -->
												</a>
												<div class='toggler'><i class="rt-angle-down"></i> </div>
											<ul>

												<?php
													foreach($cat_child as $ch_id){
														$catc = get_term_by('id', $ch_id, 'product_cat');
														$chid_name = $catc->name.' ('.$catc->count.')';
														$child_link = get_term_link( $catc );
														?>
														<li><a href="<?php echo esc_url($child_link); ?>"><?php echo esc_html__($chid_name, 'text-domain') ?></a></li>
														<?php
													}
												?>
											</ul>
										</li>
										<?php
										}else{
											echo "<li><a href='".esc_url($clink)."'>". esc_html__( $name_count, 'text-domain') ."</a></li>";
										}
									}
								}
							endif;
							?>
						</ul>
					</nav>

					
	
			    </div>
			</div> 
		<?php //echo $args['after_widget'];
	}

} // class weiboo categories

// register weiboo categories
function weiboo_register_custom_widgets() {
    register_widget( 'weiboo_pcats' );
}
add_action( 'widgets_init', 'weiboo_register_custom_widgets' );