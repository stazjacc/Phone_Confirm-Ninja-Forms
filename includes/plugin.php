<?php

final class NF_PhoneConfirm_Plugin
{
    private $version;
    private $url;
    private $dir;
    private $api;

    public function __construct( $version, $file )
    {
        $this->version = $version;
        $this->url = plugin_dir_url( $file );
        $this->dir = plugin_dir_path( $file );

        add_filter( 'ninja_forms_register_fields', array( $this, 'register_fields' ) );
    }

    public function register_fields( $fields )
    {
        require_once $this->dir( 'includes/fields/phone-confirm.php' );
        $fields[ 'phoneconfirm' ] = new NF_PhoneConfirm_Field();
        return $fields;
    }

    public function version()
    {
        return $this->version;
    }

    public function url( $url = '' )
    {
        return trailingslashit( $this->url ) . $url;
    }

    public function dir( $path = '' )
    {
        return trailingslashit( $this->dir ) . $path;
    }
}
