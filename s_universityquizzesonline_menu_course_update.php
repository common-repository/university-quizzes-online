<?php
if(!defined('ABSPATH')) exit;
$wp_qmsa_course_create_code1 = $_POST['nonce'];
if (!wp_verify_nonce($wp_qmsa_course_create_code1, 'wpcke3v99'))
{
    wp_die();
}

if(current_user_can('manage_options'))
{
    global $wpdb;
    $wp_qmsa_course_admin_db = $wpdb->prefix . "squizmagicstar_courses"; 
    
    $wp_qmsa_course_edit_name = sanitize_text_field($_POST['wp_qmsa_course_create_name']);
    $wp_qmsa_course_edit_description = sanitize_text_field($_POST['wp_qmsa_course_create_description']);
    $wp_qmsa_course_edit_product = intval($_POST['wp_qmsa_course_create_product']);
    $wp_qmsa_course_edit_active = intval($_POST['wp_qmsa_course_create_active']);
    $wp_qmsa_course_edit_paid = intval($_POST['wp_qmsa_course_create_paid']);
    $wp_qmsa_course_edit_idcourse = intval($_POST['wp_qmsa_course_edit_idcourse']);
    $wp_qmsa_course_edit_time = intval($_POST['wp_qmsa_course_edit_time']);
    $wp_qmsa_course_edit_attempts = intval($_POST['wp_qmsa_course_create_attempts']);
    
    $wp_qmsa_course_edit_check = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wp_qmsa_course_admin_db WHERE q_id_course = %d", $wp_qmsa_course_edit_idcourse ) );
    
    if(!empty($wp_qmsa_course_edit_name) && !empty($wp_qmsa_course_edit_description && $wp_qmsa_course_edit_check == 1))
    {
        
        if(empty($wp_qmsa_course_edit_time))
        {
            $wp_qmsa_course_edit_time = 0;
        }
        
        if(empty($wp_qmsa_course_edit_attempts))
        {
            $wp_qmsa_course_edit_attempts = 0;
        }
        
        if(empty($wp_qmsa_course_edit_product))
        {
            $wp_qmsa_course_edit_product = 0;
        }
        
        if(empty($wp_qmsa_course_edit_active))
        {
            $wp_qmsa_course_edit_active = 0;
        }
        
        if(empty($wp_qmsa_course_edit_paid))
        {
            $wp_qmsa_course_edit_paid = 0;
        }
        
        
        $wpdb->update(
        $wp_qmsa_course_admin_db,
        array( 'q_name_course' => $wp_qmsa_course_edit_name, 'q_description_course' => $wp_qmsa_course_edit_description, 'q_s_active' => $wp_qmsa_course_edit_active, 'q_id_post_woo' => $wp_qmsa_course_edit_product, 'q_free_pay' => $wp_qmsa_course_edit_paid, 'q_s_time' => $wp_qmsa_course_edit_time, 'q_s_attempts' => $wp_qmsa_course_edit_attempts ),
        array( 'q_id_course' => $wp_qmsa_course_edit_idcourse )
        );
        
    }
    else
    {
        wp_die();
    }
    
}
?>