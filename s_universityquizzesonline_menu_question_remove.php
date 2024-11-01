<?php
if(!defined('ABSPATH')) exit;
$wp_qmsa_question_remove_code = $_POST['nonce'];
if (!wp_verify_nonce($wp_qmsa_question_remove_code , 'ewrty3344'))
{
    wp_die();
}

if(current_user_can('manage_options'))
{
    $wp_qmsa_question_id = intval($_POST['id_question']);
    
    if(!empty($wp_qmsa_question_id))
    {
        global $wpdb;
        $wp_qmsa_questions_table = $wpdb->prefix."squizmagicstar_questions";
        
        $wp_qmsa_course_remove_check = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wp_qmsa_questions_table WHERE q_question_id = %d", $wp_qmsa_question_id ) );
        
        if($wp_qmsa_course_remove_check == 1)
        {
            $wpdb->delete($wp_qmsa_questions_table, array( 'q_question_id' =>$wp_qmsa_question_id));   
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