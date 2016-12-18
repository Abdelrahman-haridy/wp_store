<?php get_header(); ?>
<?php
	// Setup globals
	// @todo: Get these out of template
	global $wp_query;

	// Setup image width and height variables
	// @todo: Investigate if these are still needed here
	$image_width  = get_option( 'single_view_image_width' );
	$image_height = get_option( 'single_view_image_height' );
?>

	<?php
		// Breadcrumbs
		wpsc_output_breadcrumbs();

		// Plugin hook for adding things to the top of the products page, like the live search
		do_action( 'wpsc_top_of_products_page' );
	?>
    <div class="code95-breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li><a href="#">men</a></li>
              <li class="active">t-shirts</li>
            </ol>
        </div>
    </div>

<div id="single_product_page_container" class="product">

<div class="container">


	<div class="single_product_display group">
        <div class="row">
<?php
		/**
		 * Start the product loop here.
		 * This is single products view, so there should be only one
		 */

		while ( wpsc_have_products() ) : wpsc_the_product(); ?>
					<div class="imagecol col-md-5 col-sm-6 col-xs-12">
						<?php if ( wpsc_the_product_thumbnail() ) : ?>
                        <div class="sp-wrap">
								<a rel="<?php echo wpsc_the_product_title(); ?>" class="<?php echo wpsc_the_product_image_link_classes(); ?>" href="<?php echo wpsc_the_product_thumbnail(); ?>">
									<img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail(); ?>"/>
								</a>
								<?php
								sb_get_images_for_product(wpsc_the_product_id());//...and then display all the rest of the images
								?>
						<?php else: ?>
									<a href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>">
									<img class="no-image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="No Image" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo WPSC_CORE_THEME_URL; ?>wpsc-images/noimage.png" width="<?php echo get_option('product_image_width'); ?>" height="<?php echo get_option('product_image_height'); ?>" />
									</a>
                        </div>
						<?php endif; ?>


            </div>

					</div><!--close imagecol-->
					<div class="productcol col-md-7 col-sm-6 col-xs-12">
                        <div class="product-info">
                            <h3><?php the_title(); ?></h3>

                <ul class="main-info list-unstyled">
                        <li><span class="name">Availability:</span><span class="boolean-value">YES </span><span>(92 items in stock)</span></li>
                        <li><span class="name">Reference:</span><span>PR0000190</span></li>
                        <li><span class="name">Manufacturer:</span><span>Nicole Miller</span></li>
                    </ul>

                            <div class="more-product-info">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#More_info" aria-controls="More_info" role="tab" data-toggle="tab">More info</a></li>
                        <li role="presentation"><a href="#Sheet" aria-controls="Sheet" role="tab" data-toggle="tab">Data Sheet</a></li>
                        <li role="presentation"><a href="#Accessories" aria-controls="Accessories" role="tab" data-toggle="tab">Accessories</a></li>
                        <li role="presentation"><a href="#Comments" aria-controls="Comments" role="tab" data-toggle="tab">Comments</a></li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="More_info">
                            <?php do_action('wpsc_product_before_description', wpsc_the_product_id(), $wp_query->post); ?>
						<div class="product_description">
							<?php echo wpsc_the_product_description(); ?>
						</div><!--close product_description -->
                        </div>
                        <div role="tabpanel" class="tab-pane" id="Sheet">...</div>
                        <div role="tabpanel" class="tab-pane" id="Accessories">...</div>
                        <div role="tabpanel" class="tab-pane" id="Comments">...</div>
                      </div>

						<?php do_action( 'wpsc_product_addon_after_descr', wpsc_the_product_id() ); ?>

                                <!-- product options -->
						<form class="product_form options" enctype="multipart/form-data" action="<?php echo esc_url( wpsc_this_page_url() ); ?>" method="post" name="1" id="product_<?php echo wpsc_the_product_id(); ?>">
                             <div class="row form-inline">
							<?php do_action ( 'wpsc_product_form_fields_begin' ); ?>
							<?php if ( wpsc_product_has_personal_text() ) : ?>
								<fieldset class="custom_text">
									<legend><?php _e( 'Personalize Your Product', 'wp-e-commerce' ); ?></legend>
									<p><?php _e( 'Complete this form to include a personalized message with your purchase.', 'wp-e-commerce' ); ?></p>
									<textarea cols='55' rows='5' name="custom_text"></textarea>
								</fieldset>
							<?php endif; ?>

							<?php if ( wpsc_product_has_supplied_file() ) : ?>

								<fieldset class="custom_file">
									<legend><?php _e( 'Upload a File', 'wp-e-commerce' ); ?></legend>
									<p><?php _e( 'Select a file from your computer to include with this purchase.', 'wp-e-commerce' ); ?></p>
									<input type="file" name="custom_file" />
								</fieldset>
							<?php endif; ?>
						<?php /** the variation group HTML and loop */?>
                        <?php if (wpsc_have_variation_groups()) { ?>
                        <fieldset><legend><?php _e('Product Options', 'wp-e-commerce'); ?></legend>
						<div class="wpsc_variation_forms">
                        	<table>
							<?php while (wpsc_have_variation_groups()) : wpsc_the_variation_group(); ?>
								<tr><td class="col1"><label for="<?php echo wpsc_vargrp_form_id(); ?>"><?php echo wpsc_the_vargrp_name(); ?>:</label></td>
								<?php /** the variation HTML and loop */?>
								<td class="col2"><select class="wpsc_select_variation" name="variation[<?php echo wpsc_vargrp_id(); ?>]" id="<?php echo wpsc_vargrp_form_id(); ?>">
								<?php while (wpsc_have_variations()) : wpsc_the_variation(); ?>
									<option value="<?php echo wpsc_the_variation_id(); ?>" <?php echo wpsc_the_variation_out_of_stock(); ?>><?php echo wpsc_the_variation_name(); ?></option>
								<?php endwhile; ?>
								</select></td></tr>
							<?php endwhile; ?>
                            </table>
   							<div id="variation_display_<?php echo wpsc_the_product_id(); ?>" class="is_variation"><?php _e('Combination of product variants is not available', 'wp-e-commerce'); ?></div>
						</div><!--close wpsc_variation_forms-->
                        </fieldset>
						<?php } ?>
						<?php /** the variation group HTML and loop ends here */?>

							<?php
							/**
							 * Quantity options - MUST be enabled in Admin Settings
							 */
							?>
							<?php if(wpsc_has_multi_adding()): ?>
                            	<div class="col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="quantity"><?php _e('Quantity', 'wp-e-commerce'); ?>: </label>
                                        <div class="wpsc_quantity_update">
                                          <input class="form-control" type="text" id="quantity wpsc_quantity_update_<?php echo wpsc_the_product_id(); ?>" name="wpsc_quantity_update" size="2" value="1" />
								<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
								<input type="hidden" name="wpsc_update_quantity" value="true" />
								<input type='hidden' name='wpsc_ajax_action' value='wpsc_update_quantity' />

                                        </div><!--close wpsc_quantity_update-->
                                     </div>
                                 </div>
							<?php endif ;?>

                                 <div class="col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="size">size: </label>
                                        <select class="form-control" id="size" >
                                            <option selected>XS (0-2)</option>
                                            <option>XS (0-2)</option>
                                            <option>XS (0-2)</option>
                                            <option>XS (0-2)</option>
                                            <option>XS (0-2)</option>
                                            <option>XS (0-2)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="color">color: </label>
                                        <select class="form-control" id="color" >
                                            <option selected>Red</option>
                                            <option>Blur</option>
                                            <option>Green</option>
                                        </select>
                                    </div>
                                </div>

                                 <div class="col-sm-4 col-xs-12">
							<div class="wpsc_product_price">
								<?php if(wpsc_show_stock_availability()): ?>
									<?php if(wpsc_product_has_stock()) : ?>
										<div id="stock_display_<?php echo wpsc_the_product_id(); ?>" class="in_stock"><?php _e('Product in stock', 'wp-e-commerce'); ?></div>
									<?php else: ?>
										<div id="stock_display_<?php echo wpsc_the_product_id(); ?>" class="out_of_stock"><?php _e('Product not in stock', 'wp-e-commerce'); ?></div>
									<?php endif; ?>
								<?php endif; ?>
								<?php if(wpsc_product_is_donation()) : ?>
									<label for="donation_price_<?php echo wpsc_the_product_id(); ?>"><?php _e('Donation', 'wp-e-commerce'); ?>: </label>
									<input type="text" id="donation_price_<?php echo wpsc_the_product_id(); ?>" name="donation_price" value="<?php echo wpsc_calculate_price(wpsc_the_product_id()); ?>" size="6" />
								<?php else : ?>
									<?php wpsc_the_product_price_display(); ?>
									 <!-- multi currency code -->
                                    <?php if(wpsc_product_has_multicurrency()) : ?>
	                                    <?php echo wpsc_display_product_multicurrency(); ?>
                                    <?php endif; ?>

								<?php endif; ?>
							</div><!--close wpsc_product_price-->
                                 </div>

							<!-- ShareThis -->
							<?php if ( get_option( 'wpsc_share_this' ) == 1 ): ?>
							<div class="st_sharethis" displayText="ShareThis"></div>
							<?php endif; ?>
							<!-- End ShareThis -->

							<input type="hidden" value="add_to_cart" name="wpsc_ajax_action" />
							<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id" />
							<?php if( wpsc_product_is_customisable() ) : ?>
								<input type="hidden" value="true" name="is_customisable"/>
							<?php endif; ?>

							<?php
							/**
							 * Cart Options
							 */
							?>

							<?php if((get_option('hide_addtocart_button') == 0) &&  (get_option('addtocart_or_buynow') !='1')) : ?>
								<?php if(wpsc_product_has_stock()) : ?>
                                 <div class="col-sm-4 col-xs-12">
									<div class="wpsc_buy_button_container">
											<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
											<?php $action = wpsc_product_external_link( wpsc_the_product_id() ); ?>
											<input class="wpsc_buy_button" type="submit" value="<?php echo wpsc_product_external_link_text( wpsc_the_product_id(), __( 'Buy Now', 'wp-e-commerce' ) ); ?>" onclick="return gotoexternallink('<?php echo esc_url( $action ); ?>', '<?php echo wpsc_product_external_link_target( wpsc_the_product_id() ); ?>')">
											<?php else: ?>
                                        <button type="submit" value="<?php _e('Add To Cart', 'wp-e-commerce'); ?>" name="Buy" class="wpsc_buy_button btn btn-default" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"><i class="fa fa-shopping-cart"></i> buy this dress</button>
											<?php endif; ?>
										<div class="wpsc_loading_animation">
											<img title="Loading" alt="Loading" src="<?php echo wpsc_loading_animation_url(); ?>" />
											<?php _e('Updating cart...', 'wp-e-commerce'); ?>
										</div><!--close wpsc_loading_animation-->
                                     </div></div><!--close wpsc_buy_button_container-->
								<?php else : ?>
									<p class="soldout"><?php _e('This product has sold out.', 'wp-e-commerce'); ?></p>
								<?php endif ; ?>
							<?php endif ; ?>
							<?php do_action ( 'wpsc_product_form_fields_end' ); ?>
                            </div>
						</form><!--close product_form-->

						<?php
							if ( (get_option( 'hide_addtocart_button' ) == 0 ) && ( get_option( 'addtocart_or_buynow' ) == '1' ) )
								echo wpsc_buy_now_button( wpsc_the_product_id() );

							echo wpsc_product_rater();

							echo wpsc_also_bought( wpsc_the_product_id() );

						if(wpsc_show_fb_like()): ?>
	                        <div class="FB_like">
	                        <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo wpsc_the_product_permalink(); ?>&amp;layout=standard&amp;show_faces=true&amp;width=435&amp;action=like&amp;font=arial&amp;colorscheme=light" frameborder="0"></iframe>
	                        </div><!--close FB_like-->
                        <?php endif; ?>
                        </div>
					</div><!--close productcol-->
					<form onsubmit="submitform(this);return false;" action="<?php echo esc_url( wpsc_this_page_url() ); ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_extra_<?php echo wpsc_the_product_id(); ?>">
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="prodid"/>
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="item"/>
					</form>
            </div>
		</div><!--close single_product_display-->
		<?php echo wpsc_product_comments(); ?>

<?php endwhile;

    do_action( 'wpsc_theme_footer' ); ?>

    </div>
</div><!--close single_product_page_container-->
<!-- realted products -->
<div class="realted-products">
    <div class="container">
        <h3>realted products</h3>
        <div class="row">
            <div class="col-md-3 col-xs-6">
                <div class="item">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/img/product-1.jpg" alt="...">
                    <h4>Lorem Ipsum is simply dummy text.</h4>
                    <span class="price">$229.99</span>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="item">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/img/product-2.jpg" alt="...">
                    <h4>Lorem Ipsum is simply dummy text.</h4>
                    <span class="price">$229.99</span>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="item">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/img/product-3.jpg" alt="...">
                    <h4>Lorem Ipsum is simply dummy text.</h4>
                    <span class="price">$229.99</span>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="item">
                    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/img/product-4.jpg" alt="...">
                    <h4>Lorem Ipsum is simply dummy text.</h4>
                    <span class="price">$229.99</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--// realted products -->
<?php get_footer(); ?>
