<?php 

if( ! defined('ABSPATH')) {
	exit;
}


add_filter( 'woocommerce_checkout_fields' , 'zelproducts_override_checkout_fields' );

function zelproducts_override_checkout_fields( $fields ) {
	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_country']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['billing']['billing_state']);
	unset($fields['billing']['billing_city']);
    $fields['billing']['billing_first_name']['placeholder'] = "Имя";
    $fields['billing']['billing_last_name']['placeholder'] = "Фамилия";
    
    $fields['billing']['billing_address_2']['placeholder'] = "Квартира, номер помещения/офиса";
    $fields['billing']['billing_phone']['placeholder'] = "89001234567";
    $fields['billing']['billing_email']['placeholder'] = "example@domain.com";
    

    return $fields;
}



add_filter( 'woocommerce_billing_fields', 'wc_unrequire_fields');

function wc_unrequire_fields( $fields ) {
	
	$fields['billing_email']['required'] = false;
    $fields['billing_address_1']['priority'] = 4;
    $fields['billing_address_2']['priority'] = 5;
    $fields['billing_address_1']['placeholder'] = "Выберите на карте или введите адрес";
    $fields['billing_address_1']['label'] = "";

	return $fields;
}


add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );

// Our hooked in function - $address_fields is passed via the filter!

function custom_override_default_address_fields( $address_fields ) {
     $address_fields['city']['required'] = false;
     $address_fields['state']['required'] = false;
     $address_fields['postcode']['required'] = false;
     $address_fields['country']['required'] = false;
     $address_fields['company']['required'] = false;
     $address_fields['email']['required'] = false;
     

     return $address_fields;
}

add_action('woocommerce_before_order_notes', 'add_delivery_time');

function add_delivery_time($checkout) {
    echo '<div id="custom_checkout_field"><h2>' . __('Время доставки') . '</h2>';
    woocommerce_form_field('delivery_time', array(
        'type' => 'select',
        'class' => array(
            'my-field-class form-row-wide'
        ),
        //'label' => __('Выберите время доставки') ,
        'placeholder' => __('Время доставки') ,
        'options' =>    ['10:00 - 10:30' => '10:00 - 10:30', 
                        '10:30 - 11:00' => '10:30 - 11:00', 
                        '11:00 - 11:30' => '11:00 - 11:30', 
                        '11:30 - 12:00' => '11:30 - 12:00', 
                        '12:00 - 12:30' => '12:00 - 12:30', 
                        '12:30 - 13:00' => '12:30 - 13:00',
                        '13:00 - 13:30' => '13:00 - 13:30', 
                        '13:30 - 14:00' => '13:30 - 14:00',
                        '13:30 - 14:00' => '13:30 - 14:00',
                        '14:30 - 15:00' => '14:30 - 15:00', 
                        '15:00 - 15:30' => '15:00 - 15:30', 
                        '15:30 - 16:00' => '15:30 - 16:00']
                    
    ),

    $checkout->get_value('custom_field_name'));

    echo '</div>';
}

add_action( 'woocommerce_checkout_update_order_meta', 'delivery_time_update_order_meta' );

function delivery_time_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['delivery_time'] ) ) {
        update_post_meta( $order_id, 'Время доставки', sanitize_text_field( $_POST['delivery_time'] ) );
    }
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'delivery_time_display_admin_order_meta', 10, 1 );

function delivery_time_display_admin_order_meta($order){
    echo '<p><strong>'.__('Время доставки').':</strong> ' . get_post_meta( $order->id, 'Время доставки', true ) . '</p>';
}

add_filter( 'woocommerce_email_order_meta_fields', 'custom_woocommerce_email_order_meta_fields', 10, 3 );

function custom_woocommerce_email_order_meta_fields( $fields, $sent_to_admin, $order ) {
    $fields['deliveryTime'] = array(
        'label' => __( 'Время доставки' ),
        'value' => get_post_meta( $order->id, 'Время доставки', true ),
    );
    return $fields;
}



add_action( 'woocommerce_before_checkout_billing_form' , 'zelproducts_add_map' );

function zelproducts_add_map() { ?>

	<div id="map"></div>

<?
}

?>