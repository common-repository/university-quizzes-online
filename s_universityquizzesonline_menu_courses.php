<?php
if(!class_exists('WP_List_Table')){
   require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

$wp_qadmin_qms_class_table = new qadmin_qms_class_table();

class qadmin_qms_class_table extends WP_List_Table 
{
    function __construct() {
       parent::__construct( array(
      'singular'=> 'wp_list_text_link', 
      'plural' => 'wp_list_test_links', 
      'ajax'   => true
      ) );
    }
    
    
    // search
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
        
        $wp_qms_search_name = $_REQUEST['wp_qmsa_course_search_name'];
        $wp_qms_search_active = $_REQUEST['wp_qmsa_course_search_active'];
        
        ?>
        <div class="wp_qms_search_form_box" style="display:none; width: 600px; min-height: 200px; background: #ffffff; border: 1px solid #c3c4c7;">
            
            <div style="margin: 10px; width: 580px; color: #000000;">
        
                <div style="width: 580px;">
                    <div style="border-bottom: 1px solid #c3c4c7; font-size:20px; line-height: 25px;"><i>Search</i></div>
                </div>
                
                <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                    Course name
                </div>
        
                <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                    <input type="text"placeholder="Course name" style="padding: 5px 8px; font-size: 14px; width: 580px;" name="wp_qmsa_course_search_name" autocomplete="off" value="<?php echo $wp_qms_search_name;?>">
                </div>
                
                <div style="margin: 10px 0px 0px 0px; width: 580px; font-size: 14px;">
                    Status
                </div>
        
                <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                    <select name="wp_qmsa_course_search_active" autocomplete="off" style="width: 160px;">
                        <option <?php if($wp_qms_search_active == 1) { echo 'selected'; } ?> value="1">Active</option>
                        <option <?php if($wp_qms_search_active == 0) { echo 'selected'; } ?> value="0">Inactive</option>
                    </select>
                </div>
                
                <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                    <div style="text-align: right;">
                    <span style="padding: 0px 5px;"><button class="button" onclick="wp_qmsa_course_search_button_cancel(); return false;">Cancel</button></span>
                    <span style="padding: 0px 5px;"> <?php submit_button( 'Search', 'button', false, false, array('id' => 'search-submit') ); ?></span>
                    </div>
                </div>
                
            </div>
            
        </div>

        <script>
        function wp_qmsa_course_search_button_cancel()
        {
            jQuery(".wp_qms_search_form_box").hide();
            jQuery("#wp_qms_search_but_box").show();
        }
        </script>
        <?php
    }
    
    
    // navigation
    function extra_tablenav( $which ) 
    {
        if ( $which == "top" )
        {
            ?>
            <script>
            function wp_qms_courses_create_button()
            {
                jQuery("#wp_qmsa_course_display").hide();
                jQuery("#wp_qmsa_course_create").show();
            }
                
            function wp_qms_search_button()
            {
                jQuery(".wp_qms_search_form_box").show();
                jQuery("#wp_qms_search_but_box").hide();
            }
                
            function wp_qms_change_per_page()
            {
                var wp_qmsper_page_value = parseInt(jQuery(".wp_qmsper_page_class").val());
                var wp_qmsper_page_url = document.location.href+"&wp_qms_per_page_now="+wp_qmsper_page_value;
                document.location = wp_qmsper_page_url;
            }
            </script>

            <div>
                <button class="button" id="wp_qms_search_but_box" onclick="wp_qms_search_button(); return false;">Search</button>
                <button class="button" onclick="wp_qms_courses_create_button(); return false;">Create</button>
                <select onchange="wp_qms_change_per_page(); return false;" class="wp_qmsper_page_class" name="s_per_page">
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
        return $wp_qms_courses_columns= array(
        'q_course_id'=>__('ID'),
        'q_course_name'=>__('Name'),
        'q_course_status'=>__('Status'),
        'q_course_time'=>__('Time'),
        'q_course_attempts'=>__('Attempts'),
        'q_course_edit'=>__('Edit'),
        'q_course_date'=>__('Date'),
        'q_course_shortcode'=>__('Shortcode'),
        'q_course_remove'=>__('X')
        );
    }
    
    // sort
    public function get_sortable_columns() 
    {
        return $wp_qms_courses_sortable = array(
        'q_course_id'=>array('ID', true),
        'q_course_name'=>array('Name', true),
        'q_course_status'=>array('Status', true),
        'q_course_time'=>array('Time', true),
        'q_course_attempts'=>array('Attempts', true),
        'q_course_date'=>array('Date', true)
        );
    }
    
    // prepare
    function prepare_items() 
    {
        global $wpdb, $_wp_column_headers;
        $wp_qms_courses_screen = get_current_screen();
        
        $wp_qms_courses_perpage = intval($_REQUEST['wp_qms_per_page_now']); // per page
        
        // search
        $wp_qms_search_name2 = $_REQUEST['wp_qmsa_course_search_name'];
        $wp_qms_search_active2 = $_REQUEST['wp_qmsa_course_search_active'];
        
        if(!empty($wp_qms_search_name2))
        {
            $wpqmssearchnamedb = " AND q_name_course LIKE '%{$wp_qms_search_name2}%'";
        }
        
        if(!empty($wp_qms_search_active2))
        {
            $wp_qms_search_active_db = " AND q_s_active LIKE '%{$wp_qms_search_active2}%'";
        }
        
        //-----------------------------------------------------------------------------
        
        $qadmin_qms_table_courses = $wpdb->prefix."squizmagicstar_courses";

        $qadmin_qms_courses_query = "SELECT * FROM $qadmin_qms_table_courses";
        $wp_qms_courses_total_items = $wpdb->query($qadmin_qms_courses_query); // total items
        
        if(!empty($wp_qms_search_name2) || !empty($wp_qms_search_active2))  
        {
            $wp_qms_courses_total_items = $wpdb->get_var( "SELECT COUNT(*) FROM $qadmin_qms_table_courses where q_id_course !='' $wp_qms_search_active_db $wpqmssearchnamedb ");
        }
        
        // sort
        $qadmin_orderby = sanitize_text_field($_REQUEST['orderby']);
        $qadmin_order = sanitize_text_field($_REQUEST['order']);
        
        if(!empty($qadmin_orderby) && !empty($qadmin_order))
        {
            if($qadmin_orderby == 'ID')
            {
                $qadmin_orderby_new = ' ORDER BY q_id_course '.$qadmin_order.' ';
            }
            
            if($qadmin_orderby == 'Name')
            {
                $qadmin_orderby_new = ' ORDER BY q_name_course '.$qadmin_order.' ';
            }
            
            if($qadmin_orderby == 'Status')
            {
                $qadmin_orderby_new = ' ORDER BY q_s_active '.$qadmin_order.' ';
            }
            
            if($qadmin_orderby == 'Date')
            {
                $qadmin_orderby_new = ' ORDER BY q_s_date '.$qadmin_order.' ';
            }
            
            if($qadmin_orderby == 'Time')
            {
                $qadmin_orderby_new = ' ORDER BY q_s_time '.$qadmin_order.' ';
            }
            
            if($qadmin_orderby == 'Attempts')
            {
                $qadmin_orderby_new = ' ORDER BY q_s_attempts '.$qadmin_order.' ';
            }
        }
        
        //--------------------------------------------------------------------------
        
        // per page
        if(empty($wp_qms_courses_perpage))
        {
            $wp_qms_courses_per_page2 = 20;
        }
        
        if(!empty($wp_qms_courses_perpage))
        {
            $wp_qms_courses_per_page2 = $wp_qms_courses_perpage;
        }
        
        //---------------------------------------------------------------------------
        
        $wp_qms_courses_columns = $this->get_columns();
        $wp_qms_courses_hidden = array();
        $wp_qms_courses_sortable = $this->get_sortable_columns();
        $this->_column_headers = array($wp_qms_courses_columns, $wp_qms_courses_hidden, $wp_qms_courses_sortable);
        $this->process_bulk_action();
        $wp_qms_courses_paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged'] -1) * $wp_qms_courses_per_page2) : 0;
        
        $this->set_pagination_args(array(
            'total_items' => $wp_qms_courses_total_items, // total items defined above
            'per_page' => $wp_qms_courses_per_page2, // per page constant defined at top of method
            'total_pages' => ceil($wp_qms_courses_total_items / $wp_qms_courses_per_page2) // calculate pages count
        ));
        
        // display colums
        $_wp_column_headers[$wp_qms_courses_screen->id]=$wp_qms_courses_columns;
        
        $this->items = $wpdb->get_results( "SELECT * FROM $qadmin_qms_table_courses where q_id_course !=''   $wp_qms_search_active_db $wpqmssearchnamedb $qadmin_orderby_new LIMIT $wp_qms_courses_per_page2 OFFSET $wp_qms_courses_paged ");
        
        if(empty($this->items))
        {
            $this->items = 'No items found';
        }
        
    }
    
    // display table
    function display_rows()
    {
        global $wpdb, $_wp_column_headers;
        $wp_qms_curses = $this->items;
        list( $columns, $hidden ) = $this->get_column_info();
        
        $wp_qms_curses_check = count($wp_qms_curses);
        
        
        
        if($wp_qms_curses !='No items found')
        {
            foreach($wp_qms_curses as $wp_qms_cursesD)
            {
                
                $wp_qms_curses_status = $wp_qms_cursesD->q_s_active;
                
                
                if($wp_qms_curses_status == 1)
                {
                    $wp_qms_curses_statusD = 'Active';
                }
                
                if($wp_qms_curses_status == 0)
                {
                    $wp_qms_curses_statusD = 'Inactive';
                }
                
                
                
                echo '<tr id="wp_qms_curses_tr'.$wp_qms_cursesD->q_id_course.'">';
                
                    echo '<td>';
                        echo $wp_qms_cursesD->q_id_course;
                    echo '</td>';
                
                    echo '<td>';
                        echo $wp_qms_cursesD->q_name_course;
                    echo '</td>';
                
                    echo '<td>';
                        echo $wp_qms_curses_statusD;
                    echo '</td>';
                
                    echo '<td>';
                        echo $wp_qms_cursesD->q_s_time;
                    echo '</td>';
                
                    echo '<td>';
                        echo $wp_qms_cursesD->q_s_attempts;
                    echo '</td>';
                
                    echo '<td>';
                        ?>
                        <a href="<?php echo get_admin_url();?>admin.php?page=universityquizzesonline_course_edit&id_course=<?php echo $wp_qms_cursesD->q_id_course;?>">Edit</a>
                        <?php
                    echo '</td>';
                
                    echo '<td>';
                        echo $wp_qms_cursesD->q_s_date;
                    echo '</td>';
                
                    echo '<td>';
                        echo '[quiz_ms id="'.$wp_qms_cursesD->q_id_course.'"]';
                    echo '</td>';
                
                    echo '<td>';
                        ?>
                        <a href="" onclick="wpsquizmagicstar_course_remove('<?php echo $wp_qms_cursesD->q_id_course;?>', '<?php echo $wp_qms_cursesD->q_name_course;?>'); return false;" style="color: #e60000;">X</a>
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
<div id="wp_qmsa_course_display" style="padding: 10px;">
    <form method="get">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <?php $wp_qadmin_qms_class_table->prepare_items()?>
        <?php $wp_qadmin_qms_class_table->search_box('Search', 'search-search-input'); ?>
        <?php $wp_qadmin_qms_class_table->display(); ?>
    </form>
</div>

<?php
global $wpdb;
$wp_qmsa_course_db_admin = $wpdb->prefix . "squizmagicstar_courses";
$wp_qmsa_course_posts_db_admin = $wpdb->prefix . "posts";
?>

<!-- Create a courses -->
<div id="wp_qmsa_course_create" style="display:none; margin: 10px; width: 600px; min-height: 200px; background: #ffffff; border: 1px solid #c3c4c7;">
    
    <form id="wp_qmsa_course_create_form" method="post" action="javascript:void(null);">
        <div style="margin: 10px; width: 580px; color: #000000;">
        
            <div style="width: 580px;">
                <div style="border-bottom: 1px solid #c3c4c7; font-size:20px; line-height: 25px;"><i>Create a course</i></div>
            </div>
        
            <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                Course name (*) 
            </div>
        
            <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                <input type="text" onfocus="wp_qmsa_course_create_focus1(); return false;" placeholder="Course name" style="padding: 5px 8px; font-size: 14px; width: 580px;" name="wp_qmsa_course_create_name" autocomplete="off" id="wp_idqmsa_course_create_name">
            </div>
        
            <div style="margin: 10px 0px 0px 0px; width: 580px; font-size: 14px;">
                Course description (*) 
            </div>
        
            <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                <textarea placeholder="Course description" onfocus="wp_qmsa_course_create_focus2(); return false;" style="padding: 5px 8px; height: 100px; resize: none; font-size: 14px; width: 580px;" name="wp_qmsa_course_create_description" autocomplete="off" id="wp_idqmsa_course_create_desc"></textarea>
            </div>
        
            
            <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                Time (seconds) (*)
            </div>
        
            <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                <input type="text" placeholder="0" style="padding: 5px 8px; font-size: 14px; width: 80px;" name="wp_qmsa_course_create_time" autocomplete="off" id="wp_idqmsa_course_create_time" value="0">
            </div>
            
            <!-- PRO VERSION -->
            <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                Attempts (pro version)
            </div>
        
            <div style="margin: 5px 0px 0px 0px; width: 580px; font-size: 14px;">
                <input type="text" placeholder="0" style="padding: 5px 8px; font-size: 14px; width: 80px;" name="wp_qmsa_course_create_attempts" autocomplete="off" id="wp_idqmsa_course_create_attempts" value="0">
            </div>
            
            
            <div style="margin: 10px 0px 0px 0px; width: 580px; font-size: 14px;">
                You must have the woocommerce plugin installed before activating the paid course.You can set the price, taxes and other financial information from within WooCommerce. If you uninstall the product, then the courses will automatically become the free. 
            
                <div style="padding: 10px 0px 0px 0px;">
                    <?php
                    $wp_qmsa_course_posts_admin_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wp_qmsa_course_posts_db_admin where post_status = %s AND post_type = %s ",  "publish", "product" ) );
                
                    if($wp_qmsa_course_posts_admin_count == 0)
                    {
                        ?>
                        <div style="padding:5px 0px 5px 0px; text-align: center; color: #b30000; font-size: 16px;">
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
                                <option value="<?php echo $wp_qmsa_course_post_list_id;?>"><?php echo $wp_qmsa_course_post_list_title;?></option>
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
                <input type="checkbox" value="1" autocomplete="off" name="wp_qmsa_course_create_active" id="wp_idqmsa_course_create_active"> Make an active  course 
            </div>
        
            <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                <u><i>Fields marked with an asterisk are required!</i></u>
            </div>
        
            <div style="margin: 20px 0px 0px 0px; width: 580px; font-size: 14px;">
                <div style="text-align: right;">
                    <span id="wp_qmsa_course_create_button_v1" style="padding: 0px 5px;"><button class="button" onclick="wp_qmsa_course_create_button_cancel(); return false;">Cancel</button></span>
                    <span id="wp_qmsa_course_create_button_v2" style="padding: 0px 5px;"><button class="button" onclick="wp_qmsa_course_create_button_start(); return false;">Create</button></span>
                </div>
            </div>
        
            <div id="wp_qmsa_course_create_error" style="display:none; padding:16px 0px 10px 0px; text-align: center; color: #b30000; font-size: 16px;">
                Error: All fields marked with an asterisk must be completed!
            </div>
        
        </div>
    </form>
    
</div>


<script>    
jQuery(function() {

    jQuery('#wp_idqmsa_course_create_time').bind('input', function(){
    jQuery(this).val(function(_, v1){
    return v1.replace(/[^\d]/g, '');
    });
    });
    
    jQuery('#wp_idqmsa_course_create_attempts').bind('input', function(){
    jQuery(this).val(function(_, v2){
    return v2.replace(/[^\d]/g, '');
    });
    });
    
});  
function wpsquizmagicstar_course_remove(id_course, course_name)
{
    var idcourse = parseInt(id_course);
    if (window.confirm("Are you sure you want to delete this course: "+course_name+" (ID:"+idcourse+") ?")) 
    {
        var formData1 = new FormData();
        formData1.append('action', 'wp_qmsa_course_remove_action');
        formData1.append('nonce', '<?php echo wp_create_nonce('fg4frhy5ec');?>');
        formData1.append('id_course', idcourse);
        jQuery.ajax({
        type: "post",
        url: 'admin-ajax.php',
        data: formData1,
        contentType:false,
        processData:false, 
        beforeSend: function() 
        {
            jQuery("#wp_qms_curses_tr"+idcourse).css('background-color','#800000');
            jQuery("#wp_qms_curses_tr"+idcourse+" td a").css('color','#ffffff');
            jQuery("#wp_qms_curses_tr"+idcourse+" td").css('color','#ffffff');
        },
        success: function(result_remove)
        {
            jQuery("#wp_qms_curses_tr"+idcourse).delay(600).fadeOut(400);
        }
        });
    }
}
    
function wp_qmsa_course_create_focus1()
{
    jQuery("#wp_qmsa_course_create_error").hide();
}
    
function wp_qmsa_course_create_focus2()
{
    jQuery("#wp_qmsa_course_create_error").hide();
}
    
function wp_qmsa_course_create_button_cancel()
{
    location.reload();
}
    
function wp_qmsa_course_create_button_start()
{
    var wp_qmsa_course_create_name = jQuery("#wp_idqmsa_course_create_name").val().length;   
    var wp_qmsa_course_create_description = jQuery("#wp_idqmsa_course_create_desc").val().length;
    var wp_qmsa_course_create_time = jQuery("#wp_idqmsa_course_create_time").val().length;
    
    if(wp_qmsa_course_create_name == 0 || wp_qmsa_course_create_description == 0 || wp_qmsa_course_create_time == 0)
    {
        jQuery("#wp_qmsa_course_create_error").html("Error: All fields marked with an asterisk must be completed!>");
        jQuery("#wp_qmsa_course_create_error").show();
    }
    else
    {
        var formData = new FormData(jQuery('#wp_qmsa_course_create_form')[0]);
        formData.append('action', 'wp_qmsa_course_create_action');
        formData.append('nonce', '<?php echo wp_create_nonce('kofekfpoe');?>');
        jQuery.ajax({
        type: "post",
        url: "admin-ajax.php",
        data: formData,
		contentType:false,
		processData:false,
        beforeSend: function() 
        {
            jQuery("#wp_qmsa_course_create_button_v1").hide(); 
            jQuery("#wp_qmsa_course_create_button_v2").hide(); 
            jQuery("#wp_qmsa_course_create_error").html("Please Wait!");
            jQuery("#wp_qmsa_course_create_error").show();                
        },
        success: function(html)
        {
            location.reload();
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