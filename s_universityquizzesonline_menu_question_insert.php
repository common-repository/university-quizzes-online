<?php
if(!defined('ABSPATH')) exit;
$wp_qmsa_question_create_code = $_POST['nonce'];
if (!wp_verify_nonce($wp_qmsa_question_create_code, 'q56fdg34f'))
{
    wp_die();
}

if(current_user_can('manage_options'))
{
    $wp_qmsa_question_create_name = sanitize_text_field($_POST['wp_qmsa_question_create_name']);
    $wp_qmsa_answer_create_name1 = sanitize_text_field($_POST['wp_qmsa_answer_create_name1']);
    $wp_qmsa_answer_create_name2 = sanitize_text_field($_POST['wp_qmsa_answer_create_name2']);
    $wp_qmsa_answer_create_name3 = sanitize_text_field($_POST['wp_qmsa_answer_create_name3']);
    $wp_qmsa_answer_create_name4 = sanitize_text_field($_POST['wp_qmsa_answer_create_name4']);
    $wp_qmsa_answer_create_right = intval($_POST['wp_qmsa_answer_create_right']);
    $wp_qmsa_question_create_course = intval($_POST['wp_qmsa_question_create_course']);
    
    if(!empty($wp_qmsa_question_create_name) && !empty($wp_qmsa_answer_create_name1) && !empty($wp_qmsa_answer_create_name2) && !empty($wp_qmsa_answer_create_right))
    {
        global $wpdb;
        $wp_qmsa_question_admin_db = $wpdb->prefix . "squizmagicstar_questions";
        
        $wpdb->insert($wp_qmsa_question_admin_db, array('q_question_name' => $wp_qmsa_question_create_name, 'q_question_answer_1' => $wp_qmsa_answer_create_name1, 'q_question_answer_2' => $wp_qmsa_answer_create_name2, 'q_question_answer_3' => $wp_qmsa_answer_create_name3, 'q_question_answer_4' => $wp_qmsa_answer_create_name4, 'q_question_right_answer' => $wp_qmsa_answer_create_right, 'q_question_course' => $wp_qmsa_question_create_course ));
    }
    else
    {
        wp_die();
    }
}
?>