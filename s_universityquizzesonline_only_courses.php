<?php
global $wpdb;
$qfree_qms_table_courses = $wpdb->prefix."squizmagicstar_courses";

$qfree_qms_id_count = intval($quiz_ms_atts[id]);
$wp_qmsa_course_active = 1;

$wp_qmsa_course_check_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $qfree_qms_table_courses where q_id_course = %d AND q_s_active = %d", $qfree_qms_id_count, $wp_qmsa_course_active ));
    
if($wp_qmsa_course_check_count == 0)
{
    ?>
    <div style="padding: 30px 20px; font-size: 20px; border: 1px solid #c3c4c7; text-align: center;">
        <b>The course is not found!</b>    
    </div>
    <?php
}
else
{
        $qfree_qms_table_questions = $wpdb->prefix."squizmagicstar_questions";
        
        $wp_qmsa_questions_check_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $qfree_qms_table_questions where q_question_course = %d", $qfree_qms_id_count));
        
        if($wp_qmsa_questions_check_count == 0)
        {
            ?>
            <div style="padding: 30px 20px; font-size: 20px; border: 1px solid #c3c4c7; text-align: center;">
                <b>Error! No questions found for this course!</b> 
                
                <div style="padding: 15px 0px 0px 0px; text-align: center;">
                    <a href="?id_course=x" class="wp_qmsa_course_link1"><b>Back</b></a>
                </div>
                
            </div>
            <?php
        }
        else
        {
            
            $wp_qmsa_course_free_sql2 = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $qfree_qms_table_courses where q_id_course = %d AND q_s_active = %d",$qfree_qms_id_count, $wp_qmsa_course_active ));
            foreach($wp_qmsa_course_free_sql2 as $wp_qmsa_course_free_sql2D)
            {
                $wp_qmsa_course_free_id2 = $wp_qmsa_course_free_sql2D->q_id_course;
                $wp_qmsa_course_free_name2 = $wp_qmsa_course_free_sql2D->q_name_course;
                $wp_qmsa_course_free_timer2 = $wp_qmsa_course_free_sql2D->q_s_time;
                
                //list question
                
                ?>
                <style>
                ol.wp_qmsa_question_od 
                {
                    list-style-type: lower-alpha !important;
                    cursor: pointer !important;
                }
                li.ol.wp_qmsa_question_li,
                li.ol.wp_qmsa_question_li:link
                {
                    color: #000000 !important;
                    padding: 8px 0px !important;
                }
                li.wp_qmsa_question_li:hover
                {
                    color: #339933 !important;
                    cursor: pointer !important;
                }
                    
                @media only screen and (max-width: 520px)
                {
                    #wp_qmsa_course_free_left,
                    #wp_qmsa_course_free_center,
                    #wp_qmsa_course_free_right
                    {
                        float: none !important;
                        text-align: left !important;
                    }
                    #wp_qmsa_course_result_left,
                    #wp_qmsa_course_result_center,
                    #wp_qmsa_course_result_right
                    {
                        float: none !important;
                        text-align: center !important;
                        width: 100% !important;
                    }
                }
                </style>

                <div id="wp_qmsa_question_window">
                    <div style="font-size: 22px; color: #000000;"><?php echo $wp_qmsa_course_free_name2;?></div>
                    <?php
                    $wp_qmsa_question_free_total = 1;
                    $wp_qmsa_question_free_sql2 = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $qfree_qms_table_questions where q_question_course = %d", $qfree_qms_id_count));
                    foreach($wp_qmsa_question_free_sql2 as $wp_qmsa_question_free_sql2D)
                    {
                        $wp_qmsa_question_free_anser2_1 ='';
                        $wp_qmsa_question_free_anser2_2 ='';
                        $wp_qmsa_question_free_anser2_3 ='';
                        $wp_qmsa_question_free_anser2_4 ='';
                        $wp_qmsa_question_free_id2 = $wp_qmsa_question_free_sql2D->q_question_id;
                        $wp_qmsa_question_free_name2 = $wp_qmsa_question_free_sql2D->q_question_name;
                        $wp_qmsa_question_free_anser2_1 = $wp_qmsa_question_free_sql2D->q_question_answer_1;
                        $wp_qmsa_question_free_anser2_2 = $wp_qmsa_question_free_sql2D->q_question_answer_2;
                        $wp_qmsa_question_free_anser2_3 = $wp_qmsa_question_free_sql2D->q_question_answer_3;
                        $wp_qmsa_question_free_anser2_4 = $wp_qmsa_question_free_sql2D->q_question_answer_4;
                        $wp_qmsa_question_free_right2 = $wp_qmsa_question_free_sql2D->q_question_right_answer;
                        $wp_qmsa_question_free_course2 = $wp_qmsa_question_free_sql2D->q_question_course;
                        ?>
                        <input type="hidden" autocomplete="off" id="wp_qmsa_question_r<?php echo $wp_qmsa_question_free_total;?>" value="<?php echo $wp_qmsa_question_free_right2;?>">
                        
                        <div class="wp_qmsa_question_free_one wp_qmsa_question_free_total<?php echo $wp_qmsa_question_free_total;?>" style="display:none; margin: 15px 0px 0px 0px; min-height: 100px;  color: #000000; border: 1px solid #ffd699; border-radius: 10px; background: #ffd699;">
                            
                            <div style="padding: 15px 20px; font-size: 18px; text-align: left;">
                                <?php echo $wp_qmsa_question_free_name2;?>
                            </div>
                        
                            <div style="padding: 0px 20px 15px 20px;">
                                <ol class="wp_qmsa_question_od">
                                    <?php
                                    if(!empty($wp_qmsa_question_free_anser2_1))
                                    {
                                        ?>
                                        <li onclick="wp_qmsa_questions_li(1); return false;" class="wp_qmsa_question_li"><?php echo $wp_qmsa_question_free_anser2_1;?></li>
                                        <?php
                                    }
                                    if(!empty($wp_qmsa_question_free_anser2_2))
                                    {
                                        ?>
                                        <li onclick="wp_qmsa_questions_li(2); return false;" class="wp_qmsa_question_li"><?php echo $wp_qmsa_question_free_anser2_2;?></li>
                                        <?php
                                    }
                                    if(!empty($wp_qmsa_question_free_anser2_3))
                                    {
                                        ?>
                                        <li onclick="wp_qmsa_questions_li(3); return false;" class="wp_qmsa_question_li"><?php echo $wp_qmsa_question_free_anser2_3;?></li>
                                        <?php
                                    }
                                    if(!empty($wp_qmsa_question_free_anser2_4))
                                    {
                                        ?>
                                        <li onclick="wp_qmsa_questions_li(4); return false;" class="wp_qmsa_question_li"><?php echo $wp_qmsa_question_free_anser2_4;?></li>
                                        <?php
                                    }
                                    ?>
                                </ol>
                            </div>
                        
                        </div>
                        <?php
                        $wp_qmsa_question_free_total++;
                    }
                    ?>

                    <div style="width: 100%; overflow: hidden;">
                        <div id="wp_qmsa_course_free_left" style="float:left; width: 33%; color: #000000; text-align: left;">
                            <b>Correct answers:</b> <span class="wp_qmsa_course_free_left_1">0</span>
                        </div>
                        <div id="wp_qmsa_course_free_center" style="float:left; width: 34%; color: #000000; text-align: center;">
                            <b>Question:</b> <span class="wp_qmsa_course_free_center_1">1</span> of <?php echo $wp_qmsa_questions_check_count;?>
                        </div>
                        <div id="wp_qmsa_course_free_right" style="float:left; width: 33%; color: #000000; text-align: right;">
                            <b>Timer:</b> <span class="wp_qmsa_course_free_right_1"><?php echo $wp_qmsa_course_free_timer2;?></span>
                        </div>
                    </div>

                    <div style="padding: 15px 0px 0px 0px; text-align: center; font-size: 14px;">
                        <u><i>click on one of the answer options to answer the question</i></u>
                    </div>
                    
                </div>
                <input type="hidden" autocomplete="off" id="wp_qmsa_question_CA" value="0">
                <script>
                var wp_qmsa_question_position = 1;
                var wp_qmsa_questions_NOW = 1;
                var wp_qmsa_questions_timer;
                var wp_qmsa_questions_timeDefault = <?php echo $wp_qmsa_course_free_timer2;?>;
                var wp_qmsa_questions_time = <?php echo $wp_qmsa_course_free_timer2;?>;
                clearInterval(wp_qmsa_questions_timer);
                jQuery(function(){
                    
                    jQuery(".wp_qmsa_question_free_total1").show();

                }); 
                    
                wp_qmsa_questions_timer = setInterval(wp_qmsa_questions_timer_func, 1000);
                  
                function wp_qmsa_questions_timer_func()
                {
                    wp_qmsa_questions_time--;
                    jQuery(".wp_qmsa_course_free_right_1").html(wp_qmsa_questions_time);
                    
                    if(wp_qmsa_questions_time == 0)
                    {
                        clearInterval(wp_qmsa_questions_timer);
                        wp_qmsa_questions_results();
                    }
                    
                }
                    
                function wp_qmsa_questions_li(x)
                {
                    var wp_qmsa_questions_ALL = parseInt("<?php echo $wp_qmsa_questions_check_count;?>");
                    var wp_qmsa_questions_E1 = parseInt(jQuery("#wp_qmsa_question_r"+wp_qmsa_question_position).val());
                    var wp_qmsa_questions_E2 = parseInt(x);
                    var wp_qmsa_questions_CA = parseInt(jQuery("#wp_qmsa_question_CA").val());
                    if(wp_qmsa_questions_E1 == wp_qmsa_questions_E2)
                    {
                        wp_qmsa_questions_CA++;
                        jQuery("#wp_qmsa_question_CA").val(wp_qmsa_questions_CA);
                        jQuery(".wp_qmsa_course_free_left_1").html(wp_qmsa_questions_CA);
                    }
                    
                    if(2==2)
                    {
                        
                        if(wp_qmsa_questions_NOW == wp_qmsa_questions_ALL)
                        {
                            wp_qmsa_questions_results();
                        }
                        else
                        {
                            wp_qmsa_questions_NOW++;
                            jQuery(".wp_qmsa_course_free_center_1").html(wp_qmsa_questions_NOW);
                            jQuery(".wp_qmsa_question_free_total"+wp_qmsa_question_position).hide();
                            wp_qmsa_question_position++;
                            jQuery(".wp_qmsa_question_free_total"+wp_qmsa_question_position).show();
                        }
                    }   
                }
                    
                function wp_qmsa_questions_results()
                {
                    clearInterval(wp_qmsa_questions_timer);
                    
                    var wp_qmsa_questions_timerRes = parseInt(wp_qmsa_questions_timeDefault) - parseInt(wp_qmsa_questions_time);
                    var wp_qmsa_questions_caR = jQuery("#wp_qmsa_question_CA").val();
                    
                    jQuery("#wp_qmsa_course_result_leftTIME").html(wp_qmsa_questions_timerRes);
                    jQuery("#wp_qmsa_course_result_centerCA").html(wp_qmsa_questions_caR);
                    
                    jQuery(".wp_qmsa_question_free_total"+wp_qmsa_question_position).hide();
                    jQuery("#wp_qmsa_question_window").hide();
                    
                    jQuery("#wp_qmsa_question_resultsW").show();
                }
                </script>

                <div id="wp_qmsa_question_resultsW" style="display: none;">
                    
                    <div class="wp_qmsa_question_ResultWindow" style="margin: 15px 0px 0px 0px; min-height: 100px;  color: #000000; border: 1px solid #ffd699; border-radius: 10px; background: #ffd699;">
                    
                        <div style="padding: 0px 0px 20px 0px;">    
                            <div style="padding: 15px 20px; font-size: 24px; text-align: center;">
                                <b>Your results</b>
                            </div>
                        
                            <div style="width: 100%; overflow: hidden; color: #404040;">
                                
                                <div id="wp_qmsa_course_result_left" style="float:left; width: 33%; text-align: center; font-size: 18px;">
                                    <b>Your exam time (s)</b>
                                    <div id="wp_qmsa_course_result_leftTIME" style="padding: 5px 0px 0px 0px; text-align: center; font-size: 24px;">0</div>
                                </div>
                                
                                <div id="wp_qmsa_course_result_center" style="float:left; width: 34%; text-align: center; font-size: 18px;">
                                    <b>Correct answers</b>
                                    <div id="wp_qmsa_course_result_centerCA" style="padding: 5px 0px 0px 0px; text-align: center; font-size: 24px;">0</div>
                                </div>
                                
                                <div id="wp_qmsa_course_result_right" style="float:left; width: 33%; text-align: center; font-size: 18px;">
                                    <b>Number of questions</b>
                                    <div style="padding: 5px 0px 0px 0px; text-align: center; font-size: 24px;"><?php echo $wp_qmsa_questions_check_count;?></div>
                                </div> 
                            </div>
                            
                            <div style="padding: 15px 0px 0px 0px; text-align: center;">
                                <a href="" class="wp_qmsa_course_link1"><b>Close</b></a>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                <?php
                
            }
            
        } 
}
?>