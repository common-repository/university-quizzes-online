<?php
if(!defined('ABSPATH')) exit;
if(current_user_can('manage_options'))
{
    global $wpdb;
    
    $wp_qmsa_course_id_course = intval($_GET['id_course']);
    
    $wp_qmsa_course_table = $wpdb->prefix."squizmagicstar_courses";
    $wp_qmsa_course_posts_db_admin = $wpdb->prefix . "posts";
    
    $wp_qmsa_course_check = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wp_qmsa_course_table WHERE q_id_course = %d", $wp_qmsa_course_id_course ) );
    
    $wp_qmsa_course_link1 = get_admin_url().'admin.php?page=universityquizzesonline_courses';
    
    if($wp_qmsa_course_check == 0)
    {
        ?>
        <script>
        function wp_qmsa_course_edit_error1()
        {
            window.location.replace("<?php echo $wp_qmsa_course_link1;?>");
        }
        </script>
        <div style="margin: 10px; width: 600px; background: #ffffff; border: 1px solid #c3c4c7;">
            
            <div style="padding: 50px 0px; font-size: 18px; text-align:center;">
                <b>Error! This course is no longer available!</b>
                
                <div style="padding: 20px 0px 0px 0px;">
                    <button onclick="wp_qmsa_course_edit_error1(); return false;">Back</button>
                </div>
                
            </div>
            
        </div>
        <?php
    }
    else
    {
        $wp_qmsa_course_edit_admin_ma = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wp_qmsa_course_table WHERE q_id_course = %d",  $wp_qmsa_course_id_course ) );
        
        foreach($wp_qmsa_course_edit_admin_ma as $wp_qmsa_course_edit_admin_ma2)
        {
            $wp_qmsa_course_edit_id_course = $wp_qmsa_course_edit_admin_ma2->q_id_course;
            $wp_qmsa_course_edit_name_course = $wp_qmsa_course_edit_admin_ma2->q_name_course;
            $wp_qmsa_course_edit_description_course =$wp_qmsa_course_edit_admin_ma2->q_description_course;
            $wp_qmsa_course_edit_s_active = $wp_qmsa_course_edit_admin_ma2->q_s_active;
            $wp_qmsa_course_edit_woo = $wp_qmsa_course_edit_admin_ma2->q_id_post_woo;
            $wp_qmsa_course_edit_free = $wp_qmsa_course_edit_admin_ma2->q_free_pay;
            $wp_qmsa_course_edit_time = $wp_qmsa_course_edit_admin_ma2->q_s_time;
            $wp_qmsa_course_edit_attempts = $wp_qmsa_course_edit_admin_ma2->q_s_attempts;
            ?>
            <div style="margin: 10px; width: 600px; min-height: 200px; background: #ffffff; border: 1px solid #c3c4c7;">
    
                <form id="wp_qmsa_course_edit_form" method="post" action="javascript:void(null);">
                    
                    <input type="hidden" name="wp_qmsa_course_edit_idcourse" autocomplete="off" value="<?php echo $wp_qmsa_course_edit_id_course;?>">
                    
                    <div style="margin: 10px; width: 580px; color: #000000;">
        
                        <div style="width: 580px;">
                            <div style="border-bottom: 1px solid #c3c4c7; font-size:20px; line-height: 25px;"><i>Edit course</i></div>
                        </div>
        
                        <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                            Course name (*) 
                        </div>
        
                        <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                            <input type="text" onfocus="wp_qmsa_course_create_focus_e1(); return false;" placeholder="Course name" style="padding: 5px 8px; font-size: 14px; width: 580px;" name="wp_qmsa_course_create_name" autocomplete="off" id="wp_idqmsa_course_edit_name_e" value="<?php echo $wp_qmsa_course_edit_name_course;?>">
                        </div>
        
                        <div style="margin: 10px 0px 0px 0px; width: 580px; font-size: 14px;">
                            Course description (*) 
                        </div>
        
                        <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                            <textarea placeholder="Course description" onfocus="wp_qmsa_course_create_focus_e2(); return false;" style="padding: 5px 8px; height: 100px; resize: none; font-size: 14px; width: 580px;" name="wp_qmsa_course_create_description" autocomplete="off" id="wp_idqmsa_course_edit_description_e"><?php echo $wp_qmsa_course_edit_description_course;?></textarea>
                        </div>
        
                        <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                            Time (seconds) (*)
                        </div>
        
                        <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                            <input type="text" placeholder="0" style="padding: 5px 8px; font-size: 14px; width: 80px;" name="wp_qmsa_course_edit_time" autocomplete="off" id="wp_idqmsa_course_create_time" value="<?php echo $wp_qmsa_course_edit_time;?>">
                        </div>
            
                        <!-- PRO VERSION -->
                        <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                            Attempts (pro version)
                        </div>
        
                        <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                            <input type="text" placeholder="0" style="padding: 5px 8px; font-size: 14px; width: 80px;" name="wp_qmsa_course_create_attempts" autocomplete="off" id="wp_idqmsa_course_edit_attempts" value="<?php echo $wp_qmsa_course_edit_attempts;?>">
                        </div>
        
                        <div style="margin: 10px 0px 0px 0px; width: 580px; font-size: 14px;">
                            You must have the woocommerce plugin installed before activating the paid course.You can set the price, taxes and other financial information from within WooCommerce. If you uninstall the product, then the courses will automatically become the free. 
            
                            <div style="padding: 10px 0px 0px 0px;">
                                <?php
                                $wp_qmsa_course_posts_admin_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wp_qmsa_course_posts_db_admin where post_status = %s AND post_type = %s ",  "publish", "product" ) );
            
                                if($wp_qmsa_course_posts_admin_count == 0)
                                {
                                    ?>
                                    <div style="padding:5px 0px 5px 0px; text-align: center; color:     #b30000; font-size: 16px;">
                                        You have not created any product yet!
                                    </div>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <select name="wp_qmsa_course_create_product" autocomplete="off" style="padding: 5px; width: 100%;">
                                        <option value="">Without product</option>
                                        <?php
                                        $wp_qmsa_course_posts_db_vsql = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wp_qmsa_course_posts_db_admin where post_status = %s AND post_type = %s ",  "publish", "product" ) );
                                    
                                        foreach($wp_qmsa_course_posts_db_vsql as $wp_qmsa_course_posts_db_vsqn)
                                        {
                                            $wp_qmsa_course_post_list_id = $wp_qmsa_course_posts_db_vsqn->ID;
                                            $wp_qmsa_course_post_list_title = $wp_qmsa_course_posts_db_vsqn->post_title;
                                            ?>
                                            <option <?php if($wp_qmsa_course_edit_woo == $wp_qmsa_course_post_list_id) { echo 'selected'; } ?> value="<?php echo $wp_qmsa_course_post_list_id;?>"><?php echo $wp_qmsa_course_post_list_title;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                }
                                ?>
                            </div>
            
                        </div>
        
                        <!-- END PRO VERSION -->
        
                        <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                            <input type="checkbox" value="1" autocomplete="off" <?php if($wp_qmsa_course_edit_s_active == '1') { echo 'checked'; } ?>  name="wp_qmsa_course_create_active"> Make an active  course 
                        </div>
        
                        <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                            <u><i>Fields marked with an asterisk are required!</i></u>
                        </div>
        
                        <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                            <div style="text-align: right;">
                                <span id="wp_qmsa_course_edit_button_v1" style="padding: 0px 5px;"><button class="button" onclick="wp_qmsa_course_edit_button_cancel(); return false;">Cancel</button></span>
                                <span id="wp_qmsa_course_edit_button_v2" style="padding: 0px 5px;"><button class="button" onclick="wp_qmsa_course_edit_button_start(); return false;">Update</button></span>
                            </div>
                        </div>
        
                        <div id="wp_qmsa_course_create_error_e" style="display:none; padding:16px 0px 10px 0px; text-align: center; color: #b30000; font-size: 16px;">
                            Error: All fields marked with an asterisk must be completed!
                        </div>
        
                    </div>
                </form>
            </div>

            <script>
            jQuery(function() {

            jQuery('#wp_idqmsa_course_edit_time').bind('input', function(){
            jQuery(this).val(function(_, v3){
            return v3.replace(/[^\d]/g, '');
            });
            });
    
            jQuery('#wp_idqmsa_course_edit_attempts').bind('input', function(){
            jQuery(this).val(function(_, v4){
            return v4.replace(/[^\d]/g, '');
            });
            });
    
            });
                
            function wp_qmsa_course_create_focus_e1()
            {
                jQuery("#wp_qmsa_course_create_error_e").hide();
            }
    
            function wp_qmsa_course_create_focus_e2()
            {
                jQuery("#wp_qmsa_course_create_error_e").hide();
            }
                
            function wp_qmsa_course_edit_button_cancel()
            {
                window.location.replace("<?php echo $wp_qmsa_course_link1;?>");
            }
                
            function wp_qmsa_course_edit_button_start()
            {
                var wp_qmsa_course_edit_name = jQuery("#wp_idqmsa_course_edit_name_e").val().length;   
                var wp_qmsa_course_edit_description = jQuery("#wp_idqmsa_course_edit_description_e").val().length;
    
                var wp_qmsa_course_edit_time = jQuery("#wp_idqmsa_course_create_time").val().length;
                
                if(wp_qmsa_course_edit_name == 0 || wp_qmsa_course_edit_description == 0 || wp_qmsa_course_edit_time == 0)
                {
                    jQuery("#wp_qmsa_course_create_error_e").html("Error: All fields marked with an asterisk must be completed!>");
                    jQuery("#wp_qmsa_course_create_error_e").show();
                }
                else
                {
                    var formData = new FormData(jQuery('#wp_qmsa_course_edit_form')[0]);
                    formData.append('action', 'wp_qmsa_course_update_action');
                    formData.append('nonce', '<?php echo wp_create_nonce('wpcke3v99');?>');
                    jQuery.ajax({
                    type: "post",
                    url: "admin-ajax.php",
                    data: formData,
		            contentType:false,
		            processData:false,
                    beforeSend: function() 
                    {
                        jQuery("#wp_qmsa_course_edit_button_v1").hide(); 
                        jQuery("#wp_qmsa_course_edit_button_v2").hide(); 
                        jQuery("#wp_qmsa_course_create_error_e").html("Please Wait!");
                        jQuery("#wp_qmsa_course_create_error_e").show();                
                    },
                    success: function(html)
                    {
                        window.location.replace("<?php echo $wp_qmsa_course_link1;?>");
		            }
                    });    
                }
    
            }
            </script>
            <?php
        }
    }
}
?>