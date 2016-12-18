<div class="container">
         <?php /** start the product loop here */?>
 <?php while (wpsc_have_products()) :  wpsc_the_product(); ?>

    <?php the_title(); ?>

    <?php endwhile; ?>
 <?php /** end the product loop here */ ?>
</div><!--close default_products_page_container-->
