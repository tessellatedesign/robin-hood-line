<?php

/**
 * Sometimes we may want form submissions rather than ajax submissions - heres how you do that
 * Make sure you post the form to admin-post.php not admin-ajax.php
 */

add_action('admin_post_example_form_submit', 'example_form_submit');
add_action('admin_post_nopriv_example_form_submit', 'example_form_submit');

function example_form_submit() {

    if ( !isset($_POST['_mynonce']) || !wp_verify_nonce($_POST['_mynonce'], 'example_form_submit')) {
        // handle form submission if nonce and slug is correct
    } else {
        // nonce not verified or form submitted badly
    }

}
