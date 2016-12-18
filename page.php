<?php get_header(); ?>
<!-- products grid -->
<div class="products-grid">
    <div class="container">
        <div class="grid" id="masonry-grid">
         <?php /** start the product loop here */ ?>
            <?php while (wpsc_have_products()) :  wpsc_the_product(); ?>
          <div class="grid-item wow fadeInUp"  data-wow-duration="2s">
              <div class="item thumbnail">
                  <img src="<?php echo wpsc_the_product_thumbnail(); ?>" alt="<?php echo the_title(); ?>">
                  <div class="caption">
                      <h5><a href="<?php the_permalink(); ?>" target="_blank"><?php echo wpsc_the_product_title(); ?></a></h5>
                      <?php echo the_title(); ?>
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
                <?php endwhile; ?>
 <?php /** end the product loop here */ ?>
        </div>
    </div>
</div>
<!-- //products grid -->
<?php get_footer(); ?>
