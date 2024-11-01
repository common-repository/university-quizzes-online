<?php
if(!defined('ABSPATH')) exit;
$wp_qmsa_course_create_code = $_POST['nonce'];
if (!wp_verify_nonce($wp_qmsa_course_create_code, 'kofekfpoe'))
{
    wp_die();
}

if(current_user_can('manage_options'))
{
    $wp_qmsa_course_create_name = sanitize_text_field($_POST['wp_qmsa_course_create_name']);
    $wp_qmsa_course_create_description = sanitize_text_field($_POST['wp_qmsa_course_create_description']);
    $wp_qmsa_course_create_product = intval($_POST['wp_qmsa_course_create_product']);
    $wp_qmsa_course_create_active = intval($_POST['wp_qmsa_course_create_active']);
    $wp_qmsa_course_create_paid = intval($_POST['wp_qmsa_course_create_paid']);
    $wp_qmsa_course_create_time = intval($_POST['wp_qmsa_course_create_time']);
    $wp_qmsa_course_create_attempts = intval($_POST['wp_qmsa_course_create_attempts']);
    
    if(!empty($wp_qmsa_course_create_name) && !empty($wp_qmsa_course_create_description))
    {
        global $wpdb;
        $wp_qmsa_course_admin_db = $wpdb->prefix . "squizmagicstar_courses"; 
        
        if(empty($wp_qmsa_course_create_time))
        {
            $wp_qmsa_course_create_time = 0;
        }
        
        if(empty($wp_qmsa_course_create_attempts))
        {
            $wp_qmsa_course_create_attempts = 0;
        }
        
        if(empty($wp_qmsa_course_create_product))
        {
            $wp_qmsa_course_create_product = 0;
        }
        
        if(empty($wp_qmsa_course_create_active))
        {
            $wp_qmsa_course_create_active = 0;
        }
        
        if(empty($wp_qmsa_course_create_paid))
        {
            $wp_qmsa_course_create_paid = 0;
        }
        
        $wp_qmsa_course_admin_date = date('Y-m-d H:i:s'); 
        $wp_qmsa_course_admin_user = get_current_user_id();
        
        $wpdb->insert($wp_qmsa_course_admin_db, array('q_id_user' => $wp_qmsa_course_admin_user, 'q_s_date' => $wp_qmsa_course_admin_date, 'q_name_course' => $wp_qmsa_course_create_name, 'q_description_course' => $wp_qmsa_course_create_description, 'q_s_active' => $wp_qmsa_course_create_active, 'q_id_post_woo' => $wp_qmsa_course_create_product, 'q_free_pay' => $wp_qmsa_course_create_paid, 'q_s_time' => $wp_qmsa_course_create_time, 'q_s_attempts' => $wp_qmsa_course_create_attempts ));
        
    }
    
}
?>