<?php


/* Start Standard theme code */

// add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
// function my_acf_json_save_point( $path ) {
    
//     // update path
//     $path = get_stylesheet_directory() . '/theme-files/acf-json';
    
    
//     // return
//     return $path;
    
// }
 
// add_filter('acf/settings/load_json', 'my_acf_json_load_point');

// function my_acf_json_load_point( $paths ) {
    
//     // remove original path (optional)
//     unset($paths[0]);
    
    
//     // append path
//     $paths[] = get_stylesheet_directory() . '/theme-files/acf-json';
    
    
//     // return
//     return $paths;
    
// }

/* End Standard theme code */

// WRITE OPTIONS PAGES HERE


if(function_exists('acf_add_options_page')){
    acf_add_options_page();
}
