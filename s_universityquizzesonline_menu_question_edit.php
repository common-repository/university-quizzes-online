<?php
if(!defined('ABSPATH')) exit;
if(current_user_can('manage_options'))
{
    global $wpdb;
    $wp_qmsa_question_id = intval($_GET['id_question']);
    $wp_qmsa_questions_table = $wpdb->prefix."squizmagicstar_questions";
    $wp_qmsa_course_db_admin = $wpdb->prefix."squizmagicstar_courses";
    
    $wp_qmsa_question_check = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wp_qmsa_questions_table WHERE q_question_id = %d", $wp_qmsa_question_id ) );
    
    $wp_qmsa_question_link1 = get_admin_url().'admin.php?page=universityquizzesonline_questions';
    
    if($wp_qmsa_question_check == 0)
    {
        ?>
        <script>
        function wp_qmsa_question_edit_error1()
        {
            window.location.replace("<?php echo $wp_qmsa_question_link1;?>");
        }
        </script>
        <div style="margin: 10px; width: 600px; background: #ffffff; border: 1px solid #c3c4c7;">
            
            <div style="padding: 50px 0px; font-size: 18px; text-align:center;">
                <b>Error! This question is no longer available!</b>
                
                <div style="padding: 20px 0px 0px 0px;">
                    <button onclick="wp_qmsa_question_edit_error1(); return false;">Back</button>
                </div>
                
            </div>
            
        </div>
        <?php
    }
    else
    {
        $wp_qmsa_course_question_admin_ma = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wp_qmsa_questions_table WHERE q_question_id = %d", $wp_qmsa_question_id ) );
        
        foreach($wp_qmsa_course_question_admin_ma as $wp_qmsa_course_question_admin_maD)
        {
            $wp_qmsa_question_edit_id = $wp_qmsa_course_question_admin_maD->q_question_id;
            $wp_qmsa_question_edit_name = $wp_qmsa_course_question_admin_maD->q_question_name;
            $wp_qmsa_question_edit_ans1 = $wp_qmsa_course_question_admin_maD->q_question_answer_1;
            $wp_qmsa_question_edit_ans2 = $wp_qmsa_course_question_admin_maD->q_question_answer_2;
            $wp_qmsa_question_edit_ans3 = $wp_qmsa_course_question_admin_maD->q_question_answer_3;
            $wp_qmsa_question_edit_ans4 = $wp_qmsa_course_question_admin_maD->q_question_answer_4;
            $wp_qmsa_question_edit_rightanswer = $wp_qmsa_course_question_admin_maD->q_question_right_answer;
            $wp_qmsa_question_edit_course = $wp_qmsa_course_question_admin_maD->q_question_course;
            ?>
            <div style="margin: 10px; width: 600px; min-height: 200px; background: #ffffff; border: 1px solid #c3c4c7;">
                
                <form id="wp_qmsa_question_edit_form" method="post" action="javascript:void(null);">
                    
                    <input type="hidden" autocomplete="off" name="wp_qmsa_question_id" value="<?php echo $wp_qmsa_question_edit_id;?>">
                    
                    <div style="margin: 10px; width: 580px; color: #000000;">
                        <div style="width: 580px;">
                            <div style="border-bottom: 1px solid #c3c4c7; font-size:20px; line-height: 25px;"><i>Edit question</i></div>
                        </div>
                        
                        <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                            Question (*) 
                        </div>
        
                        <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                            <input type="text" onfocus="wp_qmsa_question_edit_focus1(); return false;" placeholder="Question" style="padding: 5px 8px; font-size: 14px; width: 580px;" name="wp_qmsa_question_create_name" autocomplete="off" id="wp_idqmsa_question_edit_name" value="<?php echo $wp_qmsa_question_edit_name;?>">
                        </div>
                        
                        <div style="margin: 10px 0px 0px 0px; width: 580px; font-size: 14px; background: #f2f2f3;">
                
                            <div style="padding: 15px; font-size: 14px; ">
                                <b><i>Answer options (*)</i></b>
                            </div>
                
                            <div style="padding: 5px 15px 0px 15px;">
                
                                <div style="width: 550px; font-size: 14px;">
                                    Answer: 1 (*) 
                                </div>
        
                                <div style="padding: 5px 0px 0px 0px; width: 560px; font-size: 14px;">
                                    <input type="text" onfocus="wp_qmsa_answer1_edit_focus(); return false;" placeholder="Answer: 1" style="padding: 5px 8px; font-size: 14px; width: 550px;" name="wp_qmsa_answer_create_name1" autocomplete="off" id="wp_idqmsa_answer_edit_name1" value="<?php echo $wp_qmsa_question_edit_ans1;?>">
                                </div>
                    
                                <div style="padding: 10px 0px 0px 0px; width: 550px; font-size: 14px;">
                                    Answer: 2 (*) 
                                </div>
        
                                <div style="padding: 5px 0px 0px 0px; width: 560px; font-size: 14px;">
                                    <input type="text" onfocus="wp_qmsa_answer2_edit_focus(); return false;" placeholder="Answer: 2" style="padding: 5px 8px; font-size: 14px; width: 550px;" name="wp_qmsa_answer_create_name2" autocomplete="off" id="wp_idqmsa_answer_edit_name2" value="<?php echo $wp_qmsa_question_edit_ans2;?>">
                                </div>
                    
                                <div style="padding: 10px 0px 0px 0px; width: 550px; font-size: 14px;">
                                    Answer: 3
                                </div>
        
                                <div style="padding: 5px 0px 0px 0px; width: 560px; font-size: 14px;">
                                    <input type="text" placeholder="Answer: 3" style="padding: 5px 8px; font-size: 14px; width: 550px;" name="wp_qmsa_answer_create_name3" autocomplete="off" value="<?php echo $wp_qmsa_question_edit_ans3;?>">
                                </div>
                    
                                <div style="padding: 10px 0px 0px 0px; width: 550px; font-size: 14px;">
                                    Answer: 4
                                </div>
        
                                <div style="padding: 5px 0px 0px 0px; width: 560px; font-size: 14px;">
                                    <input type="text" placeholder="Answer: 4" style="padding: 5px 8px; font-size: 14px; width: 550px;" name="wp_qmsa_answer_create_name4" autocomplete="off" value="<?php echo $wp_qmsa_question_edit_ans4;?>">
                                </div>
                    
                                <div style="padding: 10px 0px 0px 0px; width: 550px; font-size: 14px;">
                                    Correct answer (enter question number) (*) 
                                </div>
        
                                <div style="padding: 5px 0px 15px 0px; width: 560px; font-size: 14px;">
                                    <input type="text" onfocus="wp_qmsa_answerR_edit_focus(); return false;"  placeholder="0" style="padding: 5px 8px; font-size: 14px; width: 50px; text-align:center;" name="wp_qmsa_answer_create_right" autocomplete="off" id="wp_idqmsa_answer_edit_right" value="<?php echo $wp_qmsa_question_edit_rightanswer;?>">
                                </div>
                    
                            </div>
                        </div>
                        
                        <div style="margin: 10px 0px 0px 0px; width: 580px; font-size: 14px;">
                            Add a question to the next course
                        </div>
                        
                        <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">  
                            <?php
                            $wp_qmsa_course_q_countD = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM $wp_qmsa_course_db_admin "));
                
                            if($wp_qmsa_course_q_countD ==0)
                            {
                                ?>
                                <b>You don't have any courses created. You must first create a course if you want to add this question to the course</b>
                                <?php
                            }
                            else
                            {
                                ?>
                                <select name="wp_qmsa_question_create_course" autocomplete="off" style="padding: 5px; width: 580px !important; max-width: none;">
                                    <option value="">Select a course</option> 
                                    <?php
                                    $wp_qmsa_course_db_vsqC = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $wp_qmsa_course_db_admin"));
                                    foreach($wp_qmsa_course_db_vsqC as $wp_qmsa_course_db_vsqM)
                                    {
                                        $wp_qmsa_coursem_list_id = $wp_qmsa_course_db_vsqM->q_id_course;
                                        $wp_qmsa_coursem_list_title = $wp_qmsa_course_db_vsqM->q_name_course;
                                        ?>
                                        <option <?php if($wp_qmsa_question_edit_course == $wp_qmsa_coursem_list_id) { echo 'selected'; } ?> value="<?php echo $wp_qmsa_coursem_list_id;?>"><?php echo $wp_qmsa_coursem_list_title;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php
                            }
                            ?>
                        </div>
                        
                        <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                            <u><i>Fields marked with an asterisk are required!</i></u>
                        </div>
                        
                        <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                            <div style="text-align: right;">
                                <span id="wp_qmsa_question_edit_button_v1" style="padding: 0px 5px;"><button class="button" onclick="wp_qmsa_question_edit_button_cancel(); return false;">Cancel</button></span>
                                <span id="wp_qmsa_question_edit_button_v2" style="padding: 0px 5px;"><button class="button" onclick="wp_qmsa_question_edit_button_start(); return false;">Update</button></span>
                            </div>
                        </div>
                        
                        <div id="wp_qmsa_question_edit_error" style="display:none; padding:16px 0px 10px 0px; text-align: center; color: #b30000; font-size: 16px;">
                            Error: All fields marked with an asterisk must be completed!
                        </div>
                        
                    </div>
                </form>
                
            </div>
            <?php
        }
    }
}
?>
<script>
jQuery(function() {
    jQuery('#wp_idqmsa_answer_edit_right').bind('input', function(){
    jQuery(this).val(function(_, vq1){
    return vq1.replace(/[^\d]/g, '');
    });
    });
}); 
function wp_qmsa_question_edit_button_start()
{
    var wp_qmsa_question_edit_name = jQuery("#wp_idqmsa_question_edit_name").val().length;   
    var wp_qmsa_question_edit_answer1 = jQuery("#wp_idqmsa_answer_edit_name1").val().length;
    var wp_qmsa_question_edit_answer2 = jQuery("#wp_idqmsa_answer_edit_name2").val().length;
    var wp_qmsa_question_edit_rightanswer = jQuery("#wp_idqmsa_answer_edit_right").val().length;
    
    if(wp_qmsa_question_edit_name == 0 || wp_qmsa_question_edit_answer1 == 0 || wp_qmsa_question_edit_answer2 == 0 || wp_qmsa_question_edit_rightanswer == 0)
    {
        jQuery("#wp_qmsa_question_edit_error").html("Error: All fields marked with an asterisk must be completed!>");
        jQuery("#wp_qmsa_question_edit_error").show();
    }
    else
    {
        var wp_qmsa_questionE = new FormData(jQuery('#wp_qmsa_question_edit_form')[0]);
        wp_qmsa_questionE.append('action', 'wp_qmsa_question_update_action');
        wp_qmsa_questionE.append('nonce', '<?php echo wp_create_nonce('ed3yhj53f');?>');
        jQuery.ajax({
        type: "post",
        url: "admin-ajax.php",
        data: wp_qmsa_questionE,
		contentType:false,
		processData:false,
        beforeSend: function() 
        {
            jQuery("#wp_qmsa_question_edit_button_v1").hide(); 
            jQuery("#wp_qmsa_question_edit_button_v2").hide(); 
            jQuery("#wp_qmsa_question_edit_error").html("Please Wait!");
            jQuery("#wp_qmsa_question_edit_error").show();                
        },
        success: function(html)
        {
            window.location.replace("<?php echo $wp_qmsa_question_link1;?>");
		}
        }); 
    }
}
    
function wp_qmsa_question_edit_button_cancel()
{
    window.location.replace("<?php echo $wp_qmsa_question_link1;?>");
}
    
function wp_qmsa_question_edit_focus1()
{
    jQuery("#wp_qmsa_question_edit_error").hide();
}
    
function wp_qmsa_answer1_edit_focus()
{
    jQuery("#wp_qmsa_question_edit_error").hide();
}
    
function wp_qmsa_answer2_edit_focus()
{
    jQuery("#wp_qmsa_question_edit_error").hide();
}
    
function wp_qmsa_answerR_edit_focus()
{
    jQuery("#wp_qmsa_question_edit_error").hide();
}   
</script>