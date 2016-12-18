<?php get_header(); ?>

<div id="myslider" class="carousel home-slide hidden-xs" data-ride="carousel">
    <?php
        $args = array('category_name'=>'home_slider','order'=>'asc', 'posts_per_page'=>'3');

        $query = new wp_query($args); ?>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
<?php
        if ($query -> have_posts()) {
            while ($query -> have_posts()) {
                $query -> the_post(); ?>

                <div class="item <?php if($query->current_post==0) { ?> active <?php } ?>">
                    <?php the_post_thumbnail(); ?>
                  <div class="carousel-caption ">
                  <h1><?php the_title(); ?></h1>
                  <div class="content"><?php the_content(); ?></div>
                      <p class="slider-price">Only <span>$<?php echo(types_render_field( "price", array("output" => "raw") )); ?></span></p>
                      <a class="btn btn-default" href="<?php echo(types_render_field( "shop-now", array("output" => "raw") )); ?>"><i class="fa fa-shopping-cart"></i>shop now</a>
                  </div>
                </div>
             <?php
            }
        }

      ?>
      <?php wp_reset_postdata(); ?>

  </div>

  <!-- Controls -->
    <div class="home-slider-control">
      <a class="left carousel-control" href="#myslider" role="button" data-slide="prev">
        <span class="fa fa-angle-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myslider" role="button" data-slide="next">
        <span class="fa fa-angle-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</div>
<div class="clear"></div>
<!-- Testimonial -->
<div class="testimonial">
    <div class="container">
        <div id="testimonialslider" class="carousel testimonial-slide hidden-xs" data-ride="carousel">
            <?php
                $args = array('post_type'=>'Testimonial','order'=>'asc');

                $query = new wp_query($args); ?>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
        <?php
                if ($query -> have_posts()) {
                    while ($query -> have_posts()) {
                        $query -> the_post(); ?>

                        <div class="item <?php if($query->current_post==0) { ?> active <?php } ?>">
                          <div class="carouselcaption ">
                          <div class="content">"<?php the_content(); ?>"</div>
                             <p class="clint"><?php the_title(); ?>,<span> Happy Clint</span></p>
                          </div>
                        </div>
                     <?php
                    }
                }

              ?>
              <?php wp_reset_postdata(); ?>

          </div>
        </div>
    </div>
</div>
<!-- //Testimonial -->

<!-- products grid -->
<div class="products-grid">
    <div class="container">
        <?php
                $args = array('post_type'=>'wpsc-product','order'=>'asc');
                $query = new wp_query($args); ?>
        <div class="grid" id="masonry-grid">
            <?php
                if ($query -> have_posts()) {
                    while ($query -> have_posts()) {
                        $query -> the_post(); ?>
          <div class="grid-item wow fadeInUp"  data-wow-duration="2s">
              <div class="item thumbnail">
                  <img src="<?php echo wpsc_the_product_thumbnail(); ?>" alt="<?php the_title(); ?>">
                  <div class="caption">
                      <h5><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h5>
                    <p class="brand-name">brand here</p>
                    <div class="price"><?php wpsc_the_product_price_display(); ?></div>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-default" role="button"><i class="fa fa-shopping-cart"></i> shop</a>
                        </div>
                         <div class="col-md-3">
                            <a href="#" class="btn btn-default gray" role="button"><i class="fa fa-heart"></i></a>
                        </div>
                        <div class="col-md-3">
                            <a href="#" class="btn btn-default gray" role="button"><i class="fa fa-comment"></i></a>
                        </div>
                      </div>
                      <p class="want-this"><i class="fa fa-heart"></i> 5 people want this</p>
                  </div>
              </div>
            </div>
            <?php }}
            wp_reset_postdata(); ?>
        </div>
        <div class="load-more-product text-center">
            <a href="#" class="btn btn-default" role="button">Load more products <i class="fa fa-plus"></i></a>
        </div>
    </div>
</div>
<!-- //products grid -->

<?php get_footer(); ?>
