<?php
if(!defined('ABSPATH')) exit;
$wp_qmsa_course_remove_code = $_POST['nonce'];
if (!wp_verify_nonce($wp_qmsa_course_remove_code , 'fg4frhy5ec'))
{
    wp_die();
}

if(current_user_can('manage_options'))
{
    $wp_qmsa_course_id = intval($_POST['id_course']);
    
    if(!empty($wp_qmsa_course_id))
    {
        global $wpdb;
        $wp_qmsa_course_admin_db = $wpdb->prefix . "squizmagicstar_courses"; 
        
        $wp_qmsa_course_remove_check = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wp_qmsa_course_admin_db WHERE q_id_course = %d", $wp_qmsa_course_id ) );
        
        if($wp_qmsa_course_remove_check == 1)
        {
            $wpdb->delete($wp_qmsa_course_admin_db, array( 'q_id_course' =>$wp_qmsa_course_id));   
        }
        else
        {
            wp_die();
        }
        
    }
    else
    {
        wp_die();
    }
}
?>