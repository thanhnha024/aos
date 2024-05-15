<?php 
/** Added all post type
*/
class RT_Elements_Post_Type{
	public function __construct(){
		$this->load_post_type();
	}
	public function load_post_type(){
		//require plugin_dir_path( __FILE__ ). '/team/team.php';	
		require plugin_dir_path( __FILE__ ). '/header.php';	
		require plugin_dir_path( __FILE__ ). '/footer.php';	
		require plugin_dir_path( __FILE__ ). '/canvas-content.php';	
		require plugin_dir_path( __FILE__ ). '/testimonial/testimonial.php';
		//require plugin_dir_path( __FILE__ ). '/portfolio/portfolio.php';
	}	
}
new RT_Elements_Post_Type();