<?php
/*
Plugin Name: University quizzes online
Plugin URI: http://oleksandrustymenko.net.ua
Description: Organize online exams on your website. With this plugin, you can create various quizzes on your website, conduct exams and assign grades to students.
Version: 1.4
Author: Oleksandr Ustymenko
Author URI: http://oleksandrustymenko.net.ua
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if(!defined('ABSPATH')) exit;
global $jal_db_version;
$jal_db_version = "1.0";


register_activation_hook(__FILE__,'s_quizmagicstar_active');

function s_quizmagicstar_active()
{
    global $wpdb;
	global $jal_db_version;
    $s_quizmagicstar_tcourses = $wpdb->prefix . "squizmagicstar_courses";
	if($wpdb->get_var("show tables like '$s_quizmagicstar_tcourses'") != $s_quizmagicstar_tcourses)
    {
        $s_quizmagicstar_tcoursessql = "CREATE TABLE " .$s_quizmagicstar_tcourses. " (
		q_id_course INTEGER NOT NULL AUTO_INCREMENT,
        q_id_user INTEGER,
		q_s_date TEXT,
        q_name_course TEXT,
        q_description_course TEXT,
        q_s_active INTEGER,
        q_free_pay INTEGER,
        q_id_post_woo INTEGER,
        q_s_time INTEGER,
        q_s_attempts INTEGER,
		UNIQUE KEY (q_id_course));";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($s_quizmagicstar_tcoursessql);
		add_option("jal_db_version", $jal_db_version);  
    }
    
    //--------------------------------------------
    $s_quizmagicstar_tattempts = $wpdb->prefix . "squizmagicstar_attempts";
	if($wpdb->get_var("show tables like '$s_quizmagicstar_tattempts'") != $s_quizmagicstar_tattempts)
    {
        $s_quizmagicstar_tattemptssql = "CREATE TABLE " .$s_quizmagicstar_tattempts. " (
		q_attempts_id INTEGER NOT NULL AUTO_INCREMENT,
        q_attempts_user INTEGER,
        q_attempts_course INTEGER,
        q_attempts_pointer INTEGER,
		UNIQUE KEY (q_attempts_id));";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($s_quizmagicstar_tattemptssql);
		add_option("jal_db_version", $jal_db_version);  
    }
    
    $s_quizmagicstar_tquestions = $wpdb->prefix . "squizmagicstar_questions";
	if($wpdb->get_var("show tables like '$s_quizmagicstar_tquestions'") != $s_quizmagicstar_tquestions)
    {
        $s_quizmagicstar_tquestionsssql = "CREATE TABLE " .$s_quizmagicstar_tquestions. " (
		q_question_id INTEGER NOT NULL AUTO_INCREMENT,
        q_question_name TEXT,
		q_question_date TEXT,
        q_question_answer_1 TEXT,
        q_question_answer_2 TEXT,
        q_question_answer_3 TEXT,
        q_question_answer_4 TEXT,
        q_question_right_answer INTEGER,
        q_question_course INTEGER,
		UNIQUE KEY (q_question_id));";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($s_quizmagicstar_tquestionsssql);
		add_option("jal_db_version", $jal_db_version);  
    }
}


// admin scripts and styles
add_action('admin_enqueue_scripts', 'squizmagicstarscripts_admin');

function quizmagicstarscripts_admin()
{
    wp_enqueue_script('jquery');
}

// front scripts and styles
add_action('wp_enqueue_scripts', 'squizmagicstarscripts_front'); 
function squizmagicstarscripts_front_front()
{
    wp_enqueue_script('jquery');
    wp_localize_script( 'jquery', 'squizmagicstarscripts_frontcode', 
	array(
   'squizmagicstarscriptscode_url'   => admin_url('admin-ajax.php'),
   'squizmagicstarscriptscode_nonce' => wp_create_nonce('x5gkfmc45f')
	));
}

add_action('admin_menu', 'wp_squizmagicstar_menu');

// admin menu
function wp_squizmagicstar_menu()
{
    add_menu_page('University quizzes online', 'University quizzes online', 'manage_options', 'universityquizzesonline', 'universityquizzesonline_page');
    
    add_submenu_page('universityquizzesonline', 'University quizzes online', 'Courses', 'manage_options', 'universityquizzesonline_courses', 'universityquizzesonline_courses_page');
    
    add_submenu_page(null, 'University quizzes online', 'Edit Course', 'manage_options', 'universityquizzesonline_course_edit', 'universityquizzesonline_courseedit_page');
    
    add_submenu_page('universityquizzesonline', 'University quizzes online', 'Questions', 'manage_options', 'universityquizzesonline_questions', 'universityquizzesonline_questions_page');
    
    add_submenu_page(null, 'University quizzes online', 'Edit Course', 'manage_options', 'universityquizzesonline_question_edit', 'universityquizzesonline_questionedit_page');
    
}

function universityquizzesonline_page()
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_menu_main.php');
}

// admin submenu: Questions
function universityquizzesonline_questions_page()
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_menu_questions.php');
}

// admin submenu: Courses
function universityquizzesonline_courses_page()
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_menu_courses.php');
}

// admin create curse (code)
function wp_qmsa_course_create_action_funct()
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_menu_courses_insert.php');
    exit;
}

add_action( 'wp_ajax_wp_qmsa_course_create_action', 'wp_qmsa_course_create_action_funct');

// admin edit course
function universityquizzesonline_courseedit_page()
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_menu_course_edit.php');
}

// admin update course
function wp_qmsa_course_update_action_funct()
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_menu_course_update.php');
}
add_action( 'wp_ajax_wp_qmsa_course_update_action', 'wp_qmsa_course_update_action_funct');

// admin edit course -> remove
function wp_qmsa_course_remove_action_funct()
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_menu_course_remove.php');
    exit;
}
add_action( 'wp_ajax_wp_qmsa_course_remove_action', 'wp_qmsa_course_remove_action_funct');

/*********************************************

                QUESTION

*********************************************/

// admin question -> create
function wp_qmsa_question_create_action_funct()
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_menu_question_insert.php');
    exit;
}
add_action( 'wp_ajax_wp_qmsa_question_create_action', 'wp_qmsa_question_create_action_funct');


// admin question -> edit
function universityquizzesonline_questionedit_page()
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_menu_question_edit.php');
}

// admin question -> update
function wp_qmsa_question_update_action_funct()
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_menu_question_update.php');
    exit;
}
add_action( 'wp_ajax_wp_qmsa_question_update_action', 'wp_qmsa_question_update_action_funct');

// admin question -> remove
function wp_qmsa_question_remove_action_funct()
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_menu_question_remove.php');
    exit;
}
add_action( 'wp_ajax_wp_qmsa_question_remove_action', 'wp_qmsa_question_remove_action_funct');

//-------------------------------------------------------------------------------------------

// shortcode: free
function uqo_ms_free_courses_func()
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_free_courses.php');
}

add_shortcode('uqo_ms_free_courses', 'uqo_ms_free_courses_func');

// shortcode: only course
function quiz_ms_func($quiz_ms_atts)
{
    require_once( plugin_dir_path(__FILE__).'s_universityquizzesonline_only_courses.php');
}

add_shortcode('quiz_ms', 'quiz_ms_func');

?>