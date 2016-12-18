<?php

function ab_har() {
//Styles
     wp_enqueue_style('bootstrap'      , get_template_directory_uri().'/css/bootstrap.min.css' );
     wp_enqueue_style('font-awesome'   , get_template_directory_uri().'/css/font-awesome.min.css' );
     wp_enqueue_style('hover'          , get_template_directory_uri().'/css/hover.css' );
     wp_enqueue_style('smoothproducts' , get_template_directory_uri().'/css/smoothproducts.css' );
     wp_enqueue_style('animate' , get_template_directory_uri().'/css/animate.css' );
    wp_enqueue_style('style'           , get_stylesheet_uri() );

//Scripts
     wp_enqueue_script('jqueryLib'     , get_template_directory_uri().'/js/jquery.js',array(),'null',true );
     wp_enqueue_script('Jsbootstrap'   , get_template_directory_uri().'/js/bootstrap.min.js',array(),'null',true );
     wp_enqueue_script('smoothproductsJs', get_template_directory_uri().'/js/smoothproducts.min.js',array(),'null',true );
     wp_enqueue_script('masonry', get_template_directory_uri().'/js/masonry.pkgd.min.js',array(),'null',true );
     wp_enqueue_script('WOWJS', get_template_directory_uri().'/js/wow.min.js',array(),'null',true );
     wp_enqueue_script('plugins'       , get_template_directory_uri().'/js/plugins.js',array(),'null',true );
     wp_enqueue_script('respond'       , get_template_directory_uri().'/js/respond.min.js',array(),'null',true );
     wp_script_add_data('respond'      , 'conditional','if lt IE 9');
     wp_enqueue_script('html5shiv'     , get_template_directory_uri().'/js/html5shiv.min.js',array(),'null',true );
     wp_script_add_data('html5shiv'    , 'conditional', 'if lt IE 9');
 }

add_action('wp_enqueue_scripts' , 'ab_har');

//register menu
function registerMyMenu() {
    register_nav_menus(array(
        'header-location' => 'header',
        'footer-location' => 'footer',
    ));
}
add_action('init', 'registerMyMenu');


// product gallery
function sb_get_images_for_product($id){
   $post_thumbnail = get_post_thumbnail_id();//read the thumbnail id

   $atts = get_post_meta($id,'_wpsc_product_gallery');

   $attachments = $atts[0];

   foreach ($attachments as $attachment){
      if ($attachment<> $post_thumbnail){//if we haven't already got the attachment as the post thumbnail
         $image_attributes = wp_get_attachment_image_src($attachment,'post-thumbnail');
		 $full_image_attributes = wp_get_attachment_image_src($attachment,'full');
		 ?>
	<a rel="lightbox[<?php echo wpsc_the_product_title(); ?>]" href="<?php echo $full_image_attributes[0]; ?>" class="<?php echo wpsc_the_product_image_link_classes(); ?>">
	<img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo wpsc_the_product_title(); ?>"/>
	</a>
   <?php }
   }
}


require_once('wp_bootstrap_navwalker.php');
add_theme_support('post-thumbnails');
add_theme_support('title-tag');

?>
