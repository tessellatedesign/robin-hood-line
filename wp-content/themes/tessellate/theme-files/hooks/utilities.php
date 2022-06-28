<?php

//tessellate utilities

// Add noindex meta tag on staging/dev environment
function tessellate_add_robots_meta_tag() {
	if(defined('WP_ENV') and WP_ENV !== 'production'):
		echo '<meta name="robots" content="noindex,follow" />';
	endif;
}
add_action('wp_head', 'tessellate_add_robots_meta_tag');



// Add current environment node to admin bar
function tessellate_add_environment_admin_bar_item($admin_bar) {
	if(defined('WP_ENV') and WP_ENV !== 'production'):
		$admin_bar->add_menu(array(
			'id'    => 'wp-env',
			'parent'=> 'top-secondary',
			'title' => '<span class="ab-icon"></span><span class="ab-label">'.esc_html(ucfirst(WP_ENV)).'</span>',
			'meta'  => array(
				'title' => 'Environment',
				'class' => 'env-' . sanitize_title(WP_ENV),
			),
		));
	endif;
}
add_action('admin_bar_menu', 'tessellate_add_environment_admin_bar_item');



// Set ACF pro licence key from config constant
function tessellate_acf_pro_license_option($pre) {
	if(!defined('ACF_PRO_LICENSE') || empty(ACF_PRO_LICENSE)) return $pre;
	$data = array('key' => ACF_PRO_LICENSE, 'url' => home_url());
	return base64_encode(serialize($data));
}
add_filter('pre_option_acf_pro_license', 'tessellate_acf_pro_license_option');


// Prevent WP Rocket from adding constant to config
add_filter('rocket_set_wp_cache_constant', '__return_false');


// Remove some default admin bar nodes
function tessellate_remove_admin_bar_menu($wp_admin_bar) {
	$wp_admin_bar->remove_menu('customize');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('new-content');
	$wp_admin_bar->remove_menu('search');

	$my_account = $wp_admin_bar->get_node('my-account');
	$newtext = str_replace('Howdy, ', '', $my_account->title);
	$newtext = str_replace('Hi, ', '', $newtext);
	$wp_admin_bar->add_node(array('id' => 'my-account', 'title' => $newtext));
}
add_action('admin_bar_menu', 'tessellate_remove_admin_bar_menu', 99);


// Rename WP rocket node to Cache options
function tessellate_rename_wp_rocket_node($wp_admin_bar) {
	if($wp_admin_bar->get_node('wp-rocket')):
		$wp_admin_bar->add_node(array('id' => 'wp-rocket', 'title' => 'Cache Options'));
	endif;
}
add_filter('admin_bar_menu', 'tessellate_rename_wp_rocket_node', PHP_INT_MAX - 9);


// Add inline admin styles
function tessellate_admin_inline_styles() {
	echo '<style>';
	echo '
		#wpadminbar ul li#wp-admin-bar-wp-env .ab-item,#wpadminbar ul li#wp-admin-bar-wp-env .ab-label{background:none!important;color:#fff!important}
		#wpadminbar ul li#wp-admin-bar-wp-env.env-development{background-color:#3b9843}
		#wpadminbar ul li#wp-admin-bar-wp-env.env-staging{background-color: #d79d00}
		#wp-admin-bar-wp-env > div > span.ab-icon:before{content:"\\f534";top:2px;color:rgba(240,245,250,.6)!important}
	';
	if(!current_user_can('administrator')):
		echo '
			body.nav-menus-php nav.nav-tab-wrapper, body.nav-menus-php .add-new-menu-action, body.nav-menus-php .menu-theme-locations,
			body.nav-menus-php .manage-menus, body.nav-menus-php #nav-menu-footer .delete-action, .hide-if-no-customize,
			.user-rich-editing-wrap, .user-syntax-highlighting-wrap, .user-admin-color-wrap, .user-comment-shortcuts-wrap,
			.user-admin-bar-front-wrap, .user-url-wrap, .user-description-wrap, .user-profile-picture,
			.user-tsf_facebook_page-wrap, .user-tsf_twitter_page-wrap, #wpfooter, #adminmenu li.wp-menu-separator{display:none}
		';
	endif;
	echo '</style>';
}
add_action('admin_head', 'tessellate_admin_inline_styles');

// Add inline frontend styles for editors
function tessellate_inline_styles() {
	if(current_user_can('edit_posts')):
		echo '<style>';
		echo '
			#wpadminbar ul li#wp-admin-bar-wp-env .ab-item,#wpadminbar ul li#wp-admin-bar-wp-env .ab-label{background:none!important;color:#fff!important}
			#wpadminbar ul li#wp-admin-bar-wp-env.env-development{background-color:#3b9843}
			#wpadminbar ul li#wp-admin-bar-wp-env.env-staging{background-color: #d79d00}
			#wp-admin-bar-wp-env > div > span.ab-icon:before{content:"\\f534";top:2px;color:rgba(240,245,250,.6)!important}
		';
		echo '</style>';
	elseif(defined('WP_ENV') and WP_ENV !== 'production' and class_exists('woocommerce')):
		echo '<style>';
		echo '
			#tessellate-store-notice{position:fixed;z-index:99999;top:0;left:0;width:100%;padding:5px;color:#fff;background:#f00;text-align:center;font-size:16px;}
			#tessellate-store-notice:hover{opacity:0.1}
		';
	endif;
}
add_action('wp_head', 'tessellate_inline_styles');


// Add theme and WP rocket capabilities for editor/shop manager
function tessellate_add_editor_caps() {
	if($role = get_role('editor')):
		$role->add_cap('edit_theme_options');
		$role->add_cap('manage_privacy_options');
		$role->add_cap('rocket_purge_cache');
		$role->add_cap('rocket_purge_cloudflare_cache');
		$role->add_cap('rocket_purge_sucuri_cache');
		$role->add_cap('rocket_preload_cache');
	endif;

	if($role = get_role('shop_manager')):
		$role->add_cap('edit_theme_options');
		$role->add_cap('manage_privacy_options');
		$role->add_cap('rocket_purge_cache');
		$role->add_cap('rocket_purge_cloudflare_cache');
		$role->add_cap('rocket_purge_sucuri_cache');
		$role->add_cap('rocket_preload_cache');
	endif;
}
add_action('admin_init', 'tessellate_add_editor_caps');

// Allow editors and shop managers to edit privacy policy
function tessellate_manage_privacy_options($caps, $cap, $user_id, $args) {
	if(!is_user_logged_in()) return $caps;

	$user_meta = get_userdata($user_id);
	if(array_intersect(['editor', 'administrator', 'shop_manager'], $user_meta->roles)):
		if('manage_privacy_options' === $cap):
			$manage_name = is_multisite() ? 'manage_network' : 'manage_options';
			$caps = array_diff($caps, [$manage_name]);
		endif;
	endif;
	return $caps;
}
add_action('map_meta_cap', 'tessellate_manage_privacy_options', 1, 4);

// Disable all emoji scripts and styles
function tessellate_disable_emojis() {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'tessellate_disable_emojis_tinymce');
	add_filter('wp_resource_hints', 'tessellate_disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'tessellate_disable_emojis');

function tessellate_disable_emojis_tinymce($plugins) {
	if(is_array($plugins)):
		return array_diff($plugins, array('wpemoji'));
	endif;
	return array();
}


function tessellate_disable_emojis_remove_dns_prefetch($urls, $relation_type) {
	if('dns-prefetch' == $relation_type):
		$emoji_svg_url_bit = 'https://s.w.org/images/core/emoji/';
		foreach($urls as $key => $url):
			if(strpos($url, $emoji_svg_url_bit) !== false):
				unset($urls[$key]);
			endif;
		endforeach;
	endif;
	return $urls;
}


// Changes to admin menus
function tessellate_edit_admin_menus() {
	if(!current_user_can('administrator')):
		add_menu_page('Menus',
			'Menus',
			'edit_theme_options',
			'nav-menus.php',
			null,
			'dashicons-menu-alt',
			60);

		remove_menu_page('themes.php');
		remove_menu_page('tools.php');
		remove_menu_page('options-general.php');
		remove_menu_page('plugins.php');
	endif;
}
add_action('admin_menu', 'tessellate_edit_admin_menus');

// Remove default dashboard widgets
function tessellate_remove_dashboard_widgets() {
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
	remove_meta_box('dashboard_primary', 'dashboard', 'side');
	remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
	remove_meta_box('dashboard_activity', 'dashboard', 'normal');
	remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
	remove_meta_box('example_dashboard_widget', 'dashboard', 'normal');
	remove_meta_box('woocommerce_dashboard_status', 'dashboard', 'normal');
}
add_action('admin_init', 'tessellate_remove_dashboard_widgets');


// Remove screen help button
function tessellate_remove_help_tab() {
	$screen = get_current_screen();
	$screen->remove_help_tabs();
}
add_filter('admin_head', 'tessellate_remove_help_tab');




// Remove quick edit functionality
function remove_quick_edit( $actions ) {
    unset($actions['inline hide-if-no-js']);
    return $actions;
}
if ( !current_user_can('manage_options') ) {
    add_filter('page_row_actions','remove_quick_edit',10,1);
    add_filter('post_row_actions','remove_quick_edit',10,1);
}


// Remove WP welcome panel
remove_action('welcome_panel', 'wp_welcome_panel');


// Hide admin notices for non admin
function tessellate_hide_admin_notices() {
	if(!current_user_can('administrator')):
		remove_all_actions('admin_notices');
	endif;
}
add_action('admin_head', 'tessellate_hide_admin_notices', 1);

// Disable author archive pages
add_action('template_redirect', function() {
	if(isset($_GET['author']) || is_author()):
		global $wp_query;
		$wp_query->set_404();
		status_header(404);
		nocache_headers();
	endif;
}, 1);

add_filter('the_author_posts_link', '__return_empty_string', 99);

function tessellate_store_notice() {
	if(defined('WP_ENV') and WP_ENV !== 'production'
		and class_exists('woocommerce') and !current_user_can('edit_posts')):
		echo '<div id="tessellate-store-notice">DEMO STORE - ORDERS WILL NOT BE FULFILLED</div>';
	endif;
}
add_action('wp_footer', 'tessellate_store_notice');

?>