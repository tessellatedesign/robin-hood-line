<?php
/*
 * Tessellate functions and definitions
 */

function tessellate_theme_setup() {
	load_theme_textdomain('tessellate_theme');
	register_nav_menus(
		array(
			'primary' => 'Main Menu'
		)
	);
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
	add_theme_support('title-tag');
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'tessellate_theme_setup');




function tessellate_theme_scripts() {
	if(is_singular() && comments_open() && get_option('thread_comments')):
		wp_enqueue_script('comment-reply');
	endif;

	wp_dequeue_style('wp-block-library');
	wp_deregister_script('wp-embed');
	wp_deregister_style('wc-block-style');

	wp_enqueue_style('theme-style', get_stylesheet_directory_uri().'/style.css', array(), null);
	wp_enqueue_style('theme-styling', get_stylesheet_directory_uri().'/assets/scss/css/style.css', array(), null);
	wp_enqueue_script('theme-bootstrap-scripts', get_stylesheet_directory_uri().'/assets/js/javascript/bootstrap.js', array('jquery'), null, true);
	wp_enqueue_script('theme-scripts', get_stylesheet_directory_uri().'/assets/js/javascript/functions.js', array('jquery'), null, true);

	//check if mobile
	if(wp_is_mobile()){
		$mobile = 1;
	} else {
		$mobile = 0;
	}
	//for mobile and for AJAX calls
	$sitedata = array(
		"ismobile" => $mobile,
		"adminajax" => admin_url( 'admin-ajax.php' )
	);
	// pass the js script and the is_mobile variable
	wp_localize_script("theme-scripts", "site_data", $sitedata);

	wp_style_add_data('theme-ie', 'conditional', 'lt IE 10');
}
add_action('wp_enqueue_scripts', 'tessellate_theme_scripts');



add_filter('woocommerce_enqueue_styles', '__return_empty_array');




//create 3 images based off of originmal crop image size
add_action('after_setup_theme', 'tessellate_image_setup');

function tessellate_image_setup() {
	$prefix = 'custom';
	$divide = 1;

	$image_size_array = array(
		array(
			'name' => 'xl',
		),
		array(
			'name' => 'lg',
		),
		array(
			'name' => 'md',
		),
	);

	foreach($image_size_array as $size){

		if($divide == 1){
			$width = 1920;
			$height = 925;
		}else{
			$width = $newWidth;
			$height = $newHeight;
		}

		$newWidth = $width / $divide;
		$newHeight = $height / $divide;
		//create image size
		// echo $newWidth.'X'.$newHeight.'<br>';
		add_image_size($prefix.'_'.$size['name'], $newWidth, $newHeight, true);
		//next loop divide by to create same aspect ratio
		$divide = 1.5;
	}

}

//new image function
function get_picture_acf($desktop_image_id, $mobile_image_id = false, $desktop_image_size ,$mobile_image_size, $max_width, $class, $id){
	if($desktop_image_id != '') {
		//desktop
		$desktop_image_src = wp_get_attachment_image_url( $desktop_image_id, $desktop_image_size );
		$desktop_image_alt = get_post_meta($desktop_image_id, '_wp_attachment_image_alt', TRUE);
		$desktop_image_srcset = wp_get_attachment_image_srcset( $desktop_image_id, $desktop_image_size );

		//mobile
		if($mobile_image_id != false){
			$mobile_image_src = wp_get_attachment_image_url( $mobile_image_id, $mobile_image_size );
			$mobile_image_alt = get_post_meta($mobile_image_id, '_wp_attachment_image_alt', TRUE);
			$mobile_image_srcset = wp_get_attachment_image_srcset( $mobile_image_id, $mobile_image_size );
		}else{
			$mobile_image_src = wp_get_attachment_image_url( $desktop_image_id, $desktop_image_size );
			$mobile_image_alt = get_post_meta($desktop_image_id, '_wp_attachment_image_alt', TRUE);
			$mobile_image_srcset = wp_get_attachment_image_srcset( $desktop_image_id, $desktop_image_size );
		}

		$image_html = '
		<picture>
			<source media="(min-width:769px)" srcset="'.$desktop_image_srcset.'">
			<img id="'.$id.'" class="'.$class.'" src="'.$mobile_image_src.'" srcset="'.$mobile_image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'" alt="'.$desktop_image_alt.'" style="width:auto;">
	  	</picture>
		';

		return $image_html;
	}
}

//function to get the src set for responsive images
function get_img_acf($image_id, $image_size, $max_width, $class, $id){
    // check the image ID is not blank
    if($image_id != '') {
        // set the default src image size
        $image_src = wp_get_attachment_image_url( $image_id, $image_size );
        // set the srcset with various image sizes
        $image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );
        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
        // generate the markup for the responsive image
        $image_html = '<img id="'.$id.'" class="'.$class.'" src="'.$image_src.'" srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"  alt="'.$image_alt.'" />' ;
        return $image_html;
    }
}


//Include files in folders
$folder_names = [
    "models",
    "shortcodes",
	"cpt",
    "hooks",
    "ajax",
    "forms",
	"acf-json"
];


// loop through and load all files in each of the defined folders
foreach($folder_names as $folder){
    // load all files across these folders
	if($folder == 'cpt'){
		function custom_post_type() {
			foreach(glob(get_theme_file_path() . "/theme-files/cpt/*.php") as $file){
				// don't load files starting with an underscore, these should be example folders
				if($file[0] != "_"){
					require $file;
				}
			}
		}
		add_action( 'init', 'custom_post_type', 0 );
		
	}else{
		foreach(glob(get_theme_file_path() . "/theme-files/".$folder."/*.php") as $file){
			// don't load files starting with an underscore, these should be example folders
			if($file[0] != "_"){
				require $file;
			}
		}
	}
}



// Tells WP dashboard user what plugins are needed for the theme
require get_template_directory() . '/theme-includes/required_plugins.php';


// Load ACF settings JSON
require get_template_directory() . '/theme-includes/acf-settings.php';






/*------------------------------------------------------
Remove content area in admin
--------------------------------------------------------

function remove_editor() {
    if (isset($_GET['post'])) {
        $id = $_GET['post'];
        $template = get_post_meta($id, '_wp_page_template', true);

		//use if only want to disable for custom templates
        // if($template == 'template_name.php'){ 
            
        // }

		//remove content on pages
		remove_post_type_support('page', 'editor' );
		//remove content on posts
		remove_post_type_support('post', 'editor' );
    }
}
add_action('init', 'remove_editor');


/*------------------------------------------------------
END
--------------------------------------------------------*/


/*------------------------------------------------------
Trial custom css for wysiwyg
--------------------------------------------------------

add_filter( 'tiny_mce_before_init', 'override_mp6_tinymce_styles' );
function override_mp6_tinymce_styles( $mce_init ) {
	
	// make sure we don't override other custom <code>content_css</code> files
	$content_css = get_stylesheet_directory_uri() . '/assets/scss/css/editor.css';
	if ( isset( $mce_init[ 'content_css' ] ) )
	$content_css .= ',' . $mce_init[ 'content_css' ];
	
	$mce_init[ 'content_css' ] = $content_css;
	
	return $mce_init;

}

/*------------------------------------------------------
END
--------------------------------------------------------*/



/*------------------------------------------------------
Rewrite function
--------------------------------------------------------

function change_post_types_slug($args, $post_type){
	if( 'stories' == $post_type ){
		$args['rewrite']['slug'] = '';
	}

	return $args;
}

add_filter( 'register_post_type_args', 'change_post_types_slug', 10, 2 );

/*------------------------------------------------------
END
--------------------------------------------------------*/

//get menu array
function wp_get_menu_array($menu_name) {
	$array_menu = wp_get_nav_menu_items($menu_name);
	$sub_submenu_items = array(); //prevents duplicate menu items

	$menu = array();
	foreach ($array_menu as $m) {
		if (empty($m->menu_item_parent)) {
			$menu[$m->ID] = array();
			$menu[$m->ID]['ID'] = $m->ID;
			$menu[$m->ID]['title'] = $m->title;
			$menu[$m->ID]['url'] = $m->url;
			$menu[$m->ID]['description'] = $m->description;
			$menu[$m->ID]['classes'] = $m->classes[0];
			$menu[$m->ID]['children'] = array();
		}
	}
	
	$submenu = array();
	foreach ($array_menu as $m) {

		if ($m->menu_item_parent) {

			if (!in_array($m->ID, $sub_submenu_items)) {

				$submenu[$m->ID] = array();
				$submenu[$m->ID]['ID'] = $m->ID;
				$submenu[$m->ID]['title'] = $m->title;
				$submenu[$m->ID]['url'] = $m->url;
				$submenu[$m->ID]['classes'] = $m->classes[0];
				$submenu[$m->ID]['children'] = array();
				$menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
	
				$sub_submenu = array();
				foreach ($array_menu as $sm) {
					if ($m->menu_item_parent) {
						if ($menu[$m->menu_item_parent]['children'][$m->ID]['ID'] == $sm->menu_item_parent) {
							$sub_submenu[$sm->ID] = array();
							$sub_submenu[$sm->ID]['ID'] = $sm->ID;
							$sub_submenu[$sm->ID]['title'] = $sm->title;
							$sub_submenu[$sm->ID]['url'] = $sm->url;
							$menu[$m->menu_item_parent]['children'][$m->ID]['children'][$sm->ID] = $sub_submenu[$sm->ID];

							array_push($sub_submenu_items, $sm->ID);
						}
					}
				}
			}
		}
	}

	return $menu;
}

//HOW TO USE ABOVE FUNCTION

/*					
<?php $menuName = 'primary'; ?>

<div class="menu-<?php echo $menuName ?>-container">
	<ul id="menu-<?php echo $menuName ?>" class="parent_ul menu-<?php echo $menuName ?>">
		<?php	
		foreach(wp_get_menu_array($menuName) as $menu_item){

		}
		?>
	</ul>
</div>
*/
