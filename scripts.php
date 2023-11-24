<?php

add_action('wp_enqueue_scripts', 'cl_frontend_scripts');

function cl_frontend_scripts()
{

    $min = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) ? '' : '.min';

    if (empty($min)) :
        wp_enqueue_script('cl-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true);
    endif;

    wp_register_script('cl-script', CL_URL . 'assets/js/calculadora-leads' . $min . '.js', array('jquery'), '1.0.0', true);

    wp_enqueue_script('cl-script');

    wp_localize_script('cl-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    wp_enqueue_style('cl-style', CL_URL . 'assets/css/calculadora-leads.css', array(), false, 'all');
}
