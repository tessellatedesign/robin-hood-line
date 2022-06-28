<?php

add_action( 'wp_ajax_example_ajax', 'example_ajax' );
add_action( 'wp_ajax_nopriv_example_ajax', 'example_ajax' );

function example_ajax(){	

    $return = [
        "status" => "error",
    ];

    if(isset($_POST['data'])){
        $success = true;
        // do something
        // if ran 
        if($success){
            $return['status'] = "success";
            $return['message'] = "it ran";
        } else {
            $return['message'] = "it failed";
        }

    }

    echo json_encode($return);

	wp_die();
}