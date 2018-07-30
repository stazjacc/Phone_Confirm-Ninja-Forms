<?php
/*
 * Plugin Name: Ninja Forms - Phone Confirm
 * Description: Adds an "Phone Confirm" field for Ninja Forms.
 * Version: 1.0.0
 * Author: João A. Costa da Cunha
 *
 * Copyright 2018 João A. Costa da Cunha.
 */

if( ! function_exists( 'NF_PhoneConfirm' ) ) {
    function NF_PhoneConfirm()
    {
        static $instance;
        if( ! isset( $instance ) ) {
            require_once plugin_dir_path(__FILE__) . 'includes/plugin.php';
            $instance = new NF_PhoneConfirm_Plugin( '1.0.0', __FILE__ );
        }
        return $instance;
    }
}
NF_PhoneConfirm();
