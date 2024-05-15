<?php
/**
 * Team custom post type
 * This file is the basic custom post type for use any where in theme.
 * 
 * @package Team Post Type
 * @author ReacTheme
 * @link http://www.reactheme.com
 */
// Register Team Post Type
function reactheme_team_register_post_type() {
	$labels = array(
		'name'               => esc_html__( 'Teams', 'rtelements'),
		'singular_name'      => esc_html__( 'Team', 'rtelements'),
		'add_new'            => esc_html_x( 'Add New Team', 'rtelements'),
		'add_new_item'       => esc_html__( 'Add New Team', 'rtelements'),
		'edit_item'          => esc_html__( 'Edit Team', 'rtelements'),
		'new_item'           => esc_html__( 'New Team', 'rtelements'),
		'all_items'          => esc_html__( 'All Team', 'rtelements'),
		'view_item'          => esc_html__( 'View Team', 'rtelements'),
		'search_items'       => esc_html__( 'Search Teams', 'rtelements'),
		'not_found'          => esc_html__( 'No Teams found', 'rtelements'),
		'not_found_in_trash' => esc_html__( 'No Teams found in Trash', 'rtelements'),
		'parent_item_colon'  => esc_html__( 'Parent Team:', 'rtelements'),
		'menu_name'          => esc_html__( 'Teams', 'rtelements'),
	);	
	
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_in_menu'       => true,
		'show_in_admin_bar'  => true,
		'can_export'         => true,
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 20,		
		'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
		'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' )
	);
	register_post_type( 'teams', $args );
}
add_action( 'init', 'reactheme_team_register_post_type' );

function reactheme_tr_create_team() {
	
	register_taxonomy(
		'team-category',
		'teams',
		array(
			'label' => esc_html__( 'Team Categories','rtelements'),			
			'hierarchical' => true,
			'show_admin_column' => true,		
		)
	);
}
add_action( 'init', 'reactheme_tr_create_team' );

function reactheme_team_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('team-category');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'attorneys' ){
 			foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);

			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);		
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug.'>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'reactheme_team_add_taxonomy_filters' );



// Meta Box
/*--------------------------------------------------------------
*			Member info
*-------------------------------------------------------------*/
function rsaddon_pro_team_member_info_meta_box() {
	add_meta_box( 'member_info_meta', esc_html__( 'Member General Info', 'rtelements'), 'rsaddon_pro_team_member_info_meta_callback', 'teams', 'advanced', 'high', 1 );
}
add_action( 'add_meta_boxes', 'rsaddon_pro_team_member_info_meta_box');
// member info callback
function rsaddon_pro_team_member_info_meta_callback( $member_info ) {
	wp_nonce_field( 'member_social_metabox', 'member_social_metabox_nonce' ); ?>
		
	<div class="rs-admin-input"><label for="designation"><?php esc_html_e( 'Designation', 'rtelements') ?></label>
	<?php $designation = get_post_meta( $member_info->ID, 'designation', true ); ?>
		<input type="text" name="designation" id="designation" class="designation" value="<?php echo esc_html($designation); ?>"/>
	</div> 

	
	<div class="rs-admin-input"><label for="phone"><?php esc_html_e( 'Phone', 'rtelements') ?></label>
	<?php $phone = get_post_meta( $member_info->ID, 'phone', true ); ?>
	<input type="text" name="phone" id="phone" class="phone" value="<?php echo esc_html($phone); ?>"/>
	</div>

	<div class="rs-admin-input"><label for="email"><?php esc_html_e( 'Email', 'rtelements') ?></label>
	<?php $email = get_post_meta( $member_info->ID, 'email', true ); ?>
	<input type="text" name="email" id="email" class="email" value="<?php echo esc_html($email); ?>"/>
	</div> 
	<div class="rs-admin-input"><label for="location"><?php esc_html_e( 'Location', 'rtelements') ?></label>
	<?php $location = get_post_meta( $member_info->ID, 'location', true ); ?>
	<input type="text" name="location" id="location" class="location" value="<?php echo esc_html($location); ?>"/>
	</div> 
	<div  class="rs-admin-input"><label for="shortbio"><?php esc_html_e( 'Short Description', 'rtelements') ?></label>
	<?php $shortbio = get_post_meta( $member_info->ID, 'shortbio', true ); ?>
	<textarea name="shortbio" id="shortbio" rows="4" cols="50"><?php echo esc_html($shortbio); ?></textarea>	
	</div> 

	<div class="rs-admin-input"><label for="getin"><?php esc_html_e( 'Gen In Touch Button Text', 'rtelements') ?></label>
	<?php $getin = get_post_meta( $member_info->ID, 'getin', true ); ?>
	<input type="text" name="getin" id="getin" class="getin" value="<?php echo esc_html($getin); ?>"/>
	</div>

	<div class="rs-admin-input"><label for="getinurl"><?php esc_html_e( 'Gen In Touch Button Link', 'rtelements') ?></label>
	<?php $getinurl = get_post_meta( $member_info->ID, 'getinurl', true ); ?>
	<input type="text" name="getinurl" id="getinurl" class="getinurl" value="<?php echo esc_html($getinurl); ?>"/>
	</div>




<?php }
/*--------------------------------------------------------------
* Member social links
*-------------------------------------------------------------*/
function rsaddon_pro_team_member_social_link_meta_box() {
	add_meta_box( 'member_social_link_meta', esc_html__( 'Social Links', 'rtelements'), 'rsaddon_pro_team_social_meta_link_callback', 'teams', 'advanced', 'high', 2 );
}
add_action( 'add_meta_boxes', 'rsaddon_pro_team_member_social_link_meta_box' );
// Social Meta Callback
function rsaddon_pro_team_social_meta_link_callback( $social_meta ) {
	wp_nonce_field( 'member_social_metabox', 'member_social_metabox_nonce' ); ?>
	<!-- member social -->
	<div class="wrap-meta-group">
		<div class="rs-admin-input"><label for="facebook"><?php esc_html_e( 'Facebook', 'rtelements') ?></label>
			<?php $facebook = get_post_meta( $social_meta->ID, 'facebook', true ); ?>
			<input type="text" name="facebook" id="facebook" class="facebook" value="<?php echo esc_html($facebook); ?>"/>
		</div>
		<div class="rs-admin-input"><label for="twitter"><?php esc_html_e(
					'Twitter', 'rtelements') ?></label>
			<?php $twitter = get_post_meta( $social_meta->ID, 'twitter', true ); ?>
			<input type="text" name="twitter" id="twitter" class="twitter" value="<?php echo esc_html($twitter); ?>"/>
		</div>
		<div class="rs-admin-input"><label for="instagram"><?php esc_html_e( 'Instagram', 'rtelements') ?></label>
			<?php $instagram = get_post_meta( $social_meta->ID, 'instagram', true ); ?>
			<input type="text" name="instagram" id="instagram" class="instagram" value="<?php echo esc_html($instagram); ?>"/>
		</div>
		<div class="rs-admin-input"><label for="linkedin"><?php esc_html_e( 'Linkedin', 'rtelements') ?></label>
			<?php $linkedin= get_post_meta( $social_meta->ID, 'linkedin', true ); ?>
			<input type="text" name="linkedin" id="linkedin" class="linkedin" value="<?php echo esc_html($linkedin); ?>"/>
		</div>
	</div>
<?php }
/*--------------------------------------------------------------
 *			Save member social meta
*-------------------------------------------------------------*/
function save_rs_pro_team_member_social_meta( $post_id ) {
	if ( ! isset( $_POST['member_social_metabox_nonce'] ) ) {
		return $post_id;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	if ( 'teams' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}
	$mymeta = array( 'facebook', 'twitter', 'instagram', 'linkedin', 'designation', 'phone','email', 'shortbio', 'location','getin', 'getinurl' );
	foreach ( $mymeta as $keys ) {
		if ( is_array( sanitize_text_field ($_POST[ $keys ]) ) ) {
			$data = array();
			foreach ( sanitize_text_field($_POST[ $keys ]) as $key => $value ) {
				$data[] = $value;
			}
		} else {
			$data = sanitize_text_field( $_POST[ $keys ] );
		}
		update_post_meta( $post_id, $keys, $data );
	}
}
add_action( 'save_post', 'save_rs_pro_team_member_social_meta' );