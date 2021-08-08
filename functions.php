<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
);
}
add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );

register_sidebar( array (
'name' => __( 'Footer', 'blankslate' ),
'id' => 'footer-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function blankslate_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Extra profile information", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="puesto"><?php _e("Puesto"); ?></label></th>
        <td>
            <input type="text" name="puesto" id="puesto" value="<?php echo esc_attr( get_the_author_meta( 'puesto', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Puesto"); ?></span>
        </td>
    </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'puesto', $_POST['puesto'] );
}

/**
 * Plugin class
 **/
if ( ! class_exists( 'CT_TAX_META' ) ) {

class CT_TAX_META {

  public function __construct() {
    //
  }
 
 /*
  * Initialize the class and start calling our hooks and filters
  * @since 1.0.0
 */
 public function init() {
   add_action( 'category_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
   add_action( 'created_category', array ( $this, 'save_category_image' ), 10, 2 );
   add_action( 'category_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
   add_action( 'edited_category', array ( $this, 'updated_category_image' ), 10, 2 );
   add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
   add_action( 'admin_footer', array ( $this, 'add_script' ) );
 }

public function load_media() {
 wp_enqueue_media();
}
 
 /*
  * Add a form field in the new category page
  * @since 1.0.0
 */
 public function add_category_image ( $taxonomy ) { ?>
   <div class="form-field term-group">
     <label for="category-image-id"><?php _e('Image', 'hero-theme'); ?></label>
     <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
     <div id="category-image-wrapper"></div>
     <p>
       <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
       <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
    </p>
   </div>
 <?php
 }
 
 /*
  * Save the form field
  * @since 1.0.0
 */
 public function save_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
     $image = $_POST['category-image-id'];
     add_term_meta( $term_id, 'category-image-id', $image, true );
   }
 }
 
 /*
  * Edit the form field
  * @since 1.0.0
 */
 public function update_category_image ( $term, $taxonomy ) { ?>
   <tr class="form-field term-group-wrap">
     <th scope="row">
       <label for="category-image-id"><?php _e( 'Image', 'hero-theme' ); ?></label>
     </th>
     <td>
       <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
       <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
       <div id="category-image-wrapper">
         <?php if ( $image_id ) { ?>
           <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
         <?php } ?>
       </div>
       <p>
         <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
         <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
       </p>
     </td>
   </tr>
 <?php
 }

/*
 * Update the form field value
 * @since 1.0.0
 */
 public function updated_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
     $image = $_POST['category-image-id'];
     update_term_meta ( $term_id, 'category-image-id', $image );
   } else {
     update_term_meta ( $term_id, 'category-image-id', '' );
   }
 }

/*
 * Add script
 * @since 1.0.0
 */
 public function add_script() { ?>
   <script>
     jQuery(document).ready( function($) {
       function ct_media_upload(button_class) {
         var _custom_media = true,
         _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if ( _custom_media ) {
               $('#category-image-id').val(attachment.id);
               $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
             } else {
               return _orig_send_attachment.apply( button_id, [props, attachment] );
             }
            }
         wp.media.editor.open(button);
         return false;
       });
     }
     ct_media_upload('.ct_tax_media_button.button'); 
     $('body').on('click','.ct_tax_media_remove',function(){
       $('#category-image-id').val('');
       $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
     });
     // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
     $(document).ajaxComplete(function(event, xhr, settings) {
       var queryStringArr = settings.data.split('&');
       if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
         var xml = xhr.responseXML;
         $response = $(xml).find('term_id').text();
         if($response!=""){
           // Clear the thumb image
           $('#category-image-wrapper').html('');
         }
       }
     });
   });
 </script>
 <?php }

  }
 
$CT_TAX_META = new CT_TAX_META();
$CT_TAX_META -> init();
 
}

/**
 * Add new user profile fields
 *
 */

if ( ! function_exists( 'ld_modify_contact_methods' ) ) :

    function ld_modify_contact_methods( $contactmethods ) {
        $contactmethods['twitter'] = __( 'Twitter' );
        $contactmethods['instagram'] = __( 'Instagram' );
        $contactmethods['facebook'] = __( 'Facebook' );

        return $contactmethods;
    }
    add_filter('user_contactmethods','ld_modify_contact_methods', 10, 1);

endif;

function new_subcategory_hierarchy() {  
    $category = get_queried_object();
 
    $parent_id = $category->category_parent;
 
    $templates = array();
     
    if ( $parent_id == 0 ) {
        // Use default values from get_category_template()
        $templates[] = "category-{$category->slug}.php";
        $templates[] = "category-{$category->term_id}.php";
        $templates[] = 'category.php';      
    } else {
        // Create replacement $templates array
        $parent = get_category( $parent_id );
 
        // Current first
        $templates[] = "category-{$category->slug}.php";
        $templates[] = "category-{$category->term_id}.php";
 
        // Parent second
        $templates[] = "category-{$parent->slug}.php";
        $templates[] = "category-{$parent->term_id}.php";
        $templates[] = 'category.php';  
    }
    return locate_template( $templates );
}
 
add_filter( 'category_template', 'new_subcategory_hierarchy' );

function the_breadcrumb() {
 if (!is_home()) {
 echo '<a href="';
 echo get_option('home');
         echo '">';
 bloginfo('name');
 echo "</a> / ";
 if (is_category() || is_single()) {
 the_category(' / ');
 if (is_single()) {

 }
 } elseif (is_page()) {

 }
 }
}  