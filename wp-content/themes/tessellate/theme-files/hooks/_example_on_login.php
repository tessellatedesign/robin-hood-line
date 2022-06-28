<?php

/**
 * Example hook - on user login
 */

function user_logged_in( $user_login, $user ) {
    // user logged in
}
 
// action hook
add_action( 'wp_login', 'user_logged_in', 10, 2 );