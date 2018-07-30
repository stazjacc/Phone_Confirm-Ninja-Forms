<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_PhoneConfirm_Field
 */
class NF_PhoneConfirm_Field extends NF_Fields_Textbox
{
    protected $_name = 'phoneconfirm';

    protected $_type = 'phoneconfirm';

    protected $_nicename = 'Phone Confirm';

    protected $_section = 'userinfo';

    protected $_icon = 'phone';

    protected $_error_message = '';

    protected $_settings = array( 'confirm_field' );

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Phone Confirm', 'ninja-forms' );

        $this->_settings[ 'confirm_field' ][ 'value' ] = __( 'phone', 'ninja-forms' );
        $this->_settings[ 'confirm_field' ][ 'field_types' ] = array( 'phone' );
        $this->_settings[ 'confirm_field' ][ 'field_value_format' ] = 'key';
        $this->_settings[ 'confirm_field' ][ 'group' ] = 'primary';

        add_filter( 'nf_sub_hidden_field_types', array( $this, 'hide_field_type' ) );
    }

    public function validate( $field, $data )
    {
        $errors = parent::validate( $field, $data );

        $phone_fields = $this->get_phone_fields( $data );

        if( ! is_array( $phone_fields ) || empty( $phone_fields ) ) return $errors;

        foreach( $phone_fields as $phone_field ){

            if( $this->is_matching_values( $field, $phone_field ) ) continue;

            $errors[] = $this->get_error_message();
        }

        return $errors;
    }

    private function get_phone_fields( $data )
    {
        $phone_fields = array();

        foreach( $data[ 'fields' ] as $field ){

            if( 'phone' != $field[ 'type' ] ) continue;

            $phone_fields[] = $field;
        }

        return $phone_fields;
    }

    private function is_matching_values( $a, $b )
    {
        return $a[ 'value' ] === $b[ 'value' ];
    }

    private function get_error_message()
    {
        if( $this->_error_message ) return $this->_error_message;

        $error_message = __( 'Phones do not match', 'ninja-forms-phone-confirm-field' );

        return $this->_error_message = $error_message;
    }

    public function hide_field_type( $field_types )
    {
        $field_types[] = $this->_name;

        return $field_types;
    }
}
