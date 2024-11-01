<?php
if(!class_exists('WP_List_Table')){
   require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

global $wpdb;
$wp_qmsa_course_db_admin = $wpdb->prefix."squizmagicstar_courses";

$wp_qadmin_qms_class_table_questions = new qadmin_qms_class_table_questions();


class qadmin_qms_class_table_questions extends WP_List_Table 
{
    function __construct() {
       parent::__construct( array(
      'singular'=> 'wp_list_text_link', 
      'plural' => 'wp_list_test_links', 
      'ajax'   => true
      ) );
    }
    
    function search_box( $text, $input_id )
    {
        global $wpdb;
        if ( empty( $_REQUEST['s_search'] ) && !$this->has_items() )
        {
            return;
        }
        
        $input_id = $input_id . '-search-input';

        if ( ! empty( $_REQUEST['orderby'] ) )
            echo '<input type="hidden" name="orderby" value="' . esc_attr( $_REQUEST['orderby'] ) . '" />';
        if ( ! empty( $_REQUEST['order'] ) )
            echo '<input type="hidden" name="order" value="' . esc_attr( $_REQUEST['order'] ) . '" />';
        if ( ! empty( $_REQUEST['post_mime_type'] ) )
            echo '<input type="hidden" name="post_mime_type" value="' . esc_attr( $_REQUEST['post_mime_type'] ) . '" />';
        if ( ! empty( $_REQUEST['detached'] ) )
            echo '<input type="hidden" name="detached" value="' . esc_attr( $_REQUEST['detached'] ) . '" />';
        
        $wp_qmsa_course_db_adminS = $wpdb->prefix."squizmagicstar_courses";
        
        $wp_qms_search_question_name = $_REQUEST['wp_qmsa_question_search_name'];
        $wp_qms_search_course_id = $_REQUEST['wp_qmsa_question_search_course'];
        
        ?>
        <div class="wp_qms_search_form_boxQ" style="display:none; width: 600px; min-height: 200px; background: #ffffff; border: 1px solid #c3c4c7;">
            
            <div style="margin: 10px; width: 580px; color: #000000;">
        
                <div style="width: 580px;">
                    <div style="border-bottom: 1px solid #c3c4c7; font-size:20px; line-height: 25px;"><i>Search</i></div>
                </div>
                
                <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                    Question
                </div>
        
                <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                    <input type="text"placeholder="Question" style="padding: 5px 8px; font-size: 14px; width: 580px;" name="wp_qmsa_question_search_name" autocomplete="off" value="<?php echo $wp_qms_search_question_name;?>">
                </div>
                
                <div style="margin: 10px 0px 0px 0px; width: 580px; font-size: 14px;">
                    Course (Name, Id)
                </div>
                
                <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">  
                    <?php
                    $wp_qmsa_course_q_countS = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM $wp_qmsa_course_db_adminS "));
                
                    if($wp_qmsa_course_q_countS ==0)
                    {
                        ?>
                        <b>You don't have any courses created. You must create a course if you want this course search to be available</b>
                        <?php
                    }
                    else
                    {
                        ?>
                        <select name="wp_qmsa_question_search_course" autocomplete="off" style="padding: 5px; width: 580px !important; max-width: none;">
                            <option value="">Select a course</option> 
                            <?php
                            $wp_qmsa_course_db_vsqCW = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $wp_qmsa_course_db_adminS"));
                            foreach($wp_qmsa_course_db_vsqCW as $wp_qmsa_course_db_vsqCQ)
                            {
                                $wp_qmsa_coursem_list_idS = $wp_qmsa_course_db_vsqCQ->q_id_course;
                                $wp_qmsa_coursem_list_titleS = $wp_qmsa_course_db_vsqCQ->q_name_course;
                                ?>
                                <option <?php if($wp_qms_search_course_id == $wp_qmsa_coursem_list_idS) { echo 'selected'; } ?> value="<?php echo $wp_qmsa_coursem_list_idS;?>"><?php echo $wp_qmsa_coursem_list_titleS.' (ID:'.$wp_qmsa_coursem_list_idS.')'?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php
                    }
                    ?>
                </div>
                
                <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                    <div style="text-align: right;">
                    <span style="padding: 0px 5px;"><button class="button" onclick="wp_qmsa_question_search_button_cancel(); return false;">Cancel</button></span>
                    <span style="padding: 0px 5px;"> <?php submit_button( 'Search', 'button', false, false, array('id' => 'search-submit') ); ?></span>
                    </div>
                </div>
                
            </div>
        </div>
        <script>
        function wp_qmsa_question_search_button_cancel()
        {
            jQuery(".wp_qms_search_form_boxQ").hide();
            jQuery("#wp_qms_search_but_boxQuestion").show();
        }
        </script>
        <?php
        
    }
    
    function extra_tablenav( $which ) 
    {
        if ( $which == "top" )
        {
            ?>
            <script>
            function wp_qms_search_buttonQuestion()
            {
                jQuery("#wp_qms_search_but_boxQuestion").hide();
                jQuery(".wp_qms_search_form_boxQ").show();
            }
                
            function wp_qms_question_create_button()
            {
                jQuery("#wp_qmsa_question_display").hide();
                jQuery("#wp_qmsa_question_create").show();
            }
                
            function wp_qms_change_per_pageQ()
            {
                var wp_qmsper_page_value = parseInt(jQuery(".wp_qmsper_page_classQ").val());
                var wp_qmsper_page_url = document.location.href+"&wp_qms_per_page_now="+wp_qmsper_page_value;
                document.location = wp_qmsper_page_url;
            }
            </script>
            <div>
                <button class="button" id="wp_qms_search_but_boxQuestion" onclick="wp_qms_search_buttonQuestion(); return false;">Search</button>
                <button class="button" onclick="wp_qms_question_create_button(); return false;">Create</button>
                <select onchange="wp_qms_change_per_pageQ(); return false;" class="wp_qmsper_page_classQ" name="s_per_page">
                    <?php
                    $wp_qms_per_page_now2 = intval($_REQUEST['wp_qms_per_page_now']);
                    ?>
                    <option <?php if($wp_qms_per_page_now2 == 20 || empty($wp_qms_per_page_now2)) {echo 'selected';} ?> value="20">20 per page</option>
                    <option <?php if($wp_qms_per_page_now2 == 30) {echo 'selected';} ?> value="30">30 per page</option>
                    <option <?php if($wp_qms_per_page_now2 == 50) {echo 'selected';} ?> value="50">50 per page</option>
                    <option <?php if($wp_qms_per_page_now2 == 100) {echo 'selected';} ?> value="100">100 per page</option>
                </select>
            </div>
            <?php
        }
    }
    
    // colums of table
    function get_columns() 
    {
        return $wp_qms_questions_columns= array(
        'q_question_id'=>__('ID'),
        'q_question_name'=>__('Name'),
        'q_question_edit'=>__('Edit'),
        'q_question_course'=>__('Course (id)'),
        'q_question_remove'=>__('X')
        );
    }
    
    // sort
    public function get_sortable_columns() 
    {
        return $wp_qms_questions_sortable = array(
        'q_question_id'=>array('ID', true),
        'q_question_name'=>array('Name', true),
        'q_question_course'=>array('Status', true)
        );
    }
    
    // prepare
    function prepare_items()
    {
        global $wpdb, $_wp_column_headers;
        $wp_qms_questions_screen = get_current_screen();
        
        $wp_qms_edit_perpage = intval($_REQUEST['wp_qms_per_page_now']); // per page
        
        $wp_qms_search_question_name = $_REQUEST['wp_qmsa_question_search_name'];
        $wp_qms_search_course_id = $_REQUEST['wp_qmsa_question_search_course'];
        
        if(!empty($wp_qms_search_question_name))
        {
            $wp_qms_search_question_namedb = " AND q_question_name LIKE '%{$wp_qms_search_question_name}%'";
        }
        
        if(!empty($wp_qms_search_course_id))
        {
            $wp_qms_search_course_iddb = " AND q_question_course LIKE '%{$wp_qms_search_course_id}%'";
        }
        
        // sort
        $qadmin_qmsedit_orderby = sanitize_text_field($_REQUEST['orderby']);
        $qadmin_qmsedit_order = sanitize_text_field($_REQUEST['order']);
        
        if(!empty($qadmin_qmsedit_orderby) && !empty($qadmin_qmsedit_order))
        {
            if($qadmin_qmsedit_orderby == 'ID')
            {
                $qadmin_qmsedit_orderby_new = ' ORDER BY q_question_id '.$qadmin_qmsedit_order.' ';
            }
            
            if($qadmin_qmsedit_orderby == 'Name')
            {
                $qadmin_qmsedit_orderby_new = ' ORDER BY q_question_name '.$qadmin_qmsedit_order.' ';
            }
            
            if($qadmin_qmsedit_orderby == 'Course (id)')
            {
                $qadmin_qmsedit_orderby_new = ' ORDER BY q_question_course '.$qadmin_qmsedit_order.' ';
            }
        }
        
        $qadmin_qms_table_questions = $wpdb->prefix."squizmagicstar_questions";

        $qadmin_qms_questions_query = "SELECT * FROM $qadmin_qms_table_questions";
        $wp_qms_questions_total_items = $wpdb->query($qadmin_qms_questions_query); // total items
        
        if(!empty($wp_qms_search_question_name) || !empty($wp_qms_search_course_id))  
        {
            $wp_qms_questions_total_items = $wpdb->get_var( "SELECT COUNT(*) FROM $qadmin_qms_table_questions where q_question_id !='' $wp_qms_search_course_iddb $wp_qms_search_question_namedb ");
        }
        
        // per page
        if(empty($wp_qms_edit_perpage))
        {
            $wp_qms_questions_per_page2 = 20;
        }
        
        if(!empty($wp_qms_edit_perpage))
        {
            $wp_qms_questions_per_page2 = $wp_qms_edit_perpage;
        }
        
        $wp_qms_questions_columns = $this->get_columns();
        $wp_qms_questions_hidden = array();
        $wp_qms_questions_sortable = $this->get_sortable_columns();
        $this->_column_headers = array($wp_qms_questions_columns, wp_qms_questions_hidden, $wp_qms_questions_sortable);
        $this->process_bulk_action();
        $wp_qms_questions_paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged'] -1) * $wp_qms_questions_per_page2) : 0;
        
        $this->set_pagination_args(array(
            'total_items' => $wp_qms_questions_total_items,
            'per_page' => $wp_qms_questions_per_page2, 
            'total_pages' => ceil($wp_qms_questions_total_items / $wp_qms_questions_per_page2)
        ));
        
        $_wp_column_headers[$wp_qms_questions_screen->id]=$wp_qms_questions_columns;
        
        $this->items = $wpdb->get_results( "SELECT * FROM $qadmin_qms_table_questions where q_question_id !='' $wp_qms_search_course_iddb $wp_qms_search_question_namedb $qadmin_qmsedit_orderby_new LIMIT $wp_qms_questions_per_page2 OFFSET $wp_qms_questions_paged ");
        
        if(empty($this->items))
        {
            $this->items = 'No items found';
        }
        
    }
    
    // display table
    function display_rows()
    {
        global $wpdb, $_wp_column_headers;
        $wp_qms_questions = $this->items;
        list( $columns, $hidden ) = $this->get_column_info();
        
        if($wp_qms_questions !='No items found')
        {
            foreach($wp_qms_questions as $wp_qms_questionsD)
            {
                echo '<tr id="wp_qms_questions_tr'.$wp_qms_questionsD->q_question_id.'">';
                
                    echo '<td>';
                        echo $wp_qms_questionsD->q_question_id;
                    echo '</td>';
                
                    echo '<td>';
                        echo $wp_qms_questionsD->q_question_name;
                    echo '</td>';
                
                    echo '<td>';
                        ?>
                        <a href="<?php echo get_admin_url();?>admin.php?page=universityquizzesonline_question_edit&id_question=<?php echo $wp_qms_questionsD->q_question_id;?>">Edit</a>
                        <?php
                    echo '</td>';
                
                    echo '<td>';
                        echo $wp_qms_questionsD->q_question_course;
                    echo '</td>';
                
                    echo '<td>';
                        ?>
                        <a href="" onclick="wpsquizmagicstar_question_remove('<?php echo $wp_qms_questionsD->q_question_id;?>', '<?php echo $wp_qms_questionsD->q_question_name;?>'); return false;" style="color: #e60000;">X</a>
                        <?php
                    echo '</td>';
                
                echo '</tr>';
                
            }
        }
        else
        {
            echo '<tr>';
                echo '<td style="text-align:center;">No items found</td>';
            echo '</tr>';
        }
        
    }
    
}
?>
<script>
function wpsquizmagicstar_question_remove(question_id, question_name);
{
    alert("test");
}
</script>
<div id="wp_qmsa_question_display" style="padding: 10px;">
    <form method="get">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <?php $wp_qadmin_qms_class_table_questions->prepare_items()?>
        <?php $wp_qadmin_qms_class_table_questions->search_box('Search', 'search-search-input'); ?>
        <?php $wp_qadmin_qms_class_table_questions->display(); ?>
    </form>
</div>


<!-- Create a question -->
<div id="wp_qmsa_question_create" style="display:none; margin: 10px; width: 600px; min-height: 200px; background: #ffffff; border: 1px solid #c3c4c7;">
    
    <form id="wp_qmsa_question_create_form" method="post" action="javascript:void(null);">
        
        <div style="margin: 10px; width: 580px; color: #000000;">
            <div style="width: 580px;">
                <div style="border-bottom: 1px solid #c3c4c7; font-size:20px; line-height: 25px;"><i>Create a question</i></div>
            </div>
        
            <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                Question (*) 
            </div>
        
            <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                <input type="text" onfocus="wp_qmsa_question_create_focus1(); return false;" placeholder="Question" style="padding: 5px 8px; font-size: 14px; width: 580px;" name="wp_qmsa_question_create_name" autocomplete="off" id="wp_idqmsa_question_create_name">
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
                        <input type="text" onfocus="wp_qmsa_answer1_create_focus(); return false;" placeholder="Answer: 1" style="padding: 5px 8px; font-size: 14px; width: 550px;" name="wp_qmsa_answer_create_name1" autocomplete="off" id="wp_idqmsa_answer_create_name1">
                    </div>
                    
                    <div style="padding: 10px 0px 0px 0px; width: 550px; font-size: 14px;">
                        Answer: 2 (*) 
                    </div>
        
                    <div style="padding: 5px 0px 0px 0px; width: 560px; font-size: 14px;">
                        <input type="text" onfocus="wp_qmsa_answer2_create_focus(); return false;" placeholder="Answer: 2" style="padding: 5px 8px; font-size: 14px; width: 550px;" name="wp_qmsa_answer_create_name2" autocomplete="off" id="wp_idqmsa_answer_create_name2">
                    </div>
                    
                    <div style="padding: 10px 0px 0px 0px; width: 550px; font-size: 14px;">
                        Answer: 3
                    </div>
        
                    <div style="padding: 5px 0px 0px 0px; width: 560px; font-size: 14px;">
                        <input type="text" placeholder="Answer: 3" style="padding: 5px 8px; font-size: 14px; width: 550px;" name="wp_qmsa_answer_create_name3" autocomplete="off" id="wp_idqmsa_answer_create_name3">
                    </div>
                    
                    <div style="padding: 10px 0px 0px 0px; width: 550px; font-size: 14px;">
                        Answer: 4
                    </div>
        
                    <div style="padding: 5px 0px 0px 0px; width: 560px; font-size: 14px;">
                        <input type="text" placeholder="Answer: 4" style="padding: 5px 8px; font-size: 14px; width: 550px;" name="wp_qmsa_answer_create_name4" autocomplete="off" id="wp_idqmsa_answer_create_name4">
                    </div>
                    
                    <div style="padding: 10px 0px 0px 0px; width: 550px; font-size: 14px;">
                        Correct answer (enter question number) (*) 
                    </div>
        
                    <div style="padding: 5px 0px 15px 0px; width: 560px; font-size: 14px;">
                        <input type="text" onfocus="wp_qmsa_answerR_create_focus(); return false;"  placeholder="0" style="padding: 5px 8px; font-size: 14px; width: 50px; text-align:center;" name="wp_qmsa_answer_create_right" autocomplete="off" id="wp_idqmsa_answer_create_right">
                    </div>
                    
                </div>
                
            </div>
            
            <div style="margin: 10px 0px 0px 0px; width: 580px; font-size: 14px;">
                Add a question to the next course
            </div>
        
            <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">  
                <?php
                $wp_qmsa_course_q_count = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM $wp_qmsa_course_db_admin "));
                
                if($wp_qmsa_course_q_count ==0)
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
                        $wp_qmsa_course_db_vsql = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $wp_qmsa_course_db_admin"));
                        foreach($wp_qmsa_course_db_vsql as $wp_qmsa_course_db_vsqlD)
                        {
                            $wp_qmsa_course_list_id = $wp_qmsa_course_db_vsqlD->q_id_course;
                            $wp_qmsa_course_list_title = $wp_qmsa_course_db_vsqlD->q_name_course;
                            ?>
                            <option value="<?php echo $wp_qmsa_course_list_id;?>"><?php echo $wp_qmsa_course_list_title;?></option>
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
                    <span id="wp_qmsa_question_create_button_v1" style="padding: 0px 5px;"><button class="button" onclick="wp_qmsa_question_question_button_cancel(); return false;">Cancel</button></span>
                    <span id="wp_qmsa_question_create_button_v2" style="padding: 0px 5px;"><button class="button" onclick="wp_qmsa_question_create_button_start(); return false;">Create</button></span>
                </div>
            </div>
        
            <div id="wp_qmsa_question_create_error" style="display:none; padding:16px 0px 10px 0px; text-align: center; color: #b30000; font-size: 16px;">
                Error: All fields marked with an asterisk must be completed!
            </div>
        
        </div>   
            
    </form>
    
</div>
<script>
jQuery(function() {
    jQuery('#wp_idqmsa_answer_create_right').bind('input', function(){
    jQuery(this).val(function(_, vq1){
    return vq1.replace(/[^\d]/g, '');
    });
    });
});     
    
function wp_qmsa_question_question_button_cancel()
{
    location.reload();
}
   
function wp_qmsa_question_create_focus1()
{
    jQuery("#wp_qmsa_question_create_error").hide();
}
    
function wp_qmsa_answer1_create_focus()
{
    jQuery("#wp_qmsa_question_create_error").hide();
}
    
function wp_qmsa_answer2_create_focus()
{
    jQuery("#wp_qmsa_question_create_error").hide();
}
    
function wp_qmsa_answerR_create_focus()
{
    jQuery("#wp_qmsa_question_create_error").hide();
}
    
function wp_qmsa_question_create_button_start()
{
    var wp_qmsa_question_create_name = jQuery("#wp_idqmsa_question_create_name").val().length;   
    var wp_qmsa_question_create_answer1 = jQuery("#wp_idqmsa_answer_create_name1").val().length;
    var wp_qmsa_question_create_answer2 = jQuery("#wp_idqmsa_answer_create_name2").val().length;
    var wp_qmsa_question_create_rightanswer = jQuery("#wp_idqmsa_answer_create_right").val().length;
    
    if(wp_qmsa_question_create_name == 0 || wp_qmsa_question_create_answer1 == 0 || wp_qmsa_question_create_answer2 == 0 || wp_qmsa_question_create_rightanswer == 0)
    {
        jQuery("#wp_qmsa_question_create_error").html("Error: All fields marked with an asterisk must be completed!>");
        jQuery("#wp_qmsa_question_create_error").show();
    }
    else
    {
        var wp_qmsa_questionC = new FormData(jQuery('#wp_qmsa_question_create_form')[0]);
        wp_qmsa_questionC.append('action', 'wp_qmsa_question_create_action');
        wp_qmsa_questionC.append('nonce', '<?php echo wp_create_nonce('q56fdg34f');?>');
        jQuery.ajax({
        type: "post",
        url: "admin-ajax.php",
        data: wp_qmsa_questionC,
		contentType:false,
		processData:false,
        beforeSend: function() 
        {
            jQuery("#wp_qmsa_question_create_button_v1").hide(); 
            jQuery("#wp_qmsa_question_create_button_v2").hide(); 
            jQuery("#wp_qmsa_question_create_error").html("Please Wait!");
            jQuery("#wp_qmsa_question_create_error").show();                
        },
        success: function(html)
        {
            location.reload();
		}
        }); 
    }
}
    
function wpsquizmagicstar_question_remove(id_question, question_name)
{
    var idquestion = parseInt(id_question);
    if (window.confirm("Are you sure you want to delete this question: "+question_name+" (ID:"+idquestion+") ?")) 
    {
        var formData1 = new FormData();
        formData1.append('action', 'wp_qmsa_question_remove_action');
        formData1.append('nonce', '<?php echo wp_create_nonce('ewrty3344');?>');
        formData1.append('id_question', idquestion);
        jQuery.ajax({
        type: "post",
        url: 'admin-ajax.php',
        data: formData1,
        contentType:false,
        processData:false, 
        beforeSend: function() 
        {
            jQuery("#wp_qms_questions_tr"+idquestion).css('background-color','#800000');
            jQuery("#wp_qms_questions_tr"+idquestion+" td a").css('color','#ffffff');
            jQuery("#wp_qms_questions_tr"+idquestion+" td").css('color','#ffffff');
        },
        success: function(result_remove)
        {
            jQuery("#wp_qms_questions_tr"+idquestion).delay(600).fadeOut(400);
        }
        });
    }
}
</script>

<script>
jQuery(function() {
    setTimeout(function() { jQuery( "input[name*='_wp_http_referer']" ).remove(); }, 501); 
}); 
</script>
