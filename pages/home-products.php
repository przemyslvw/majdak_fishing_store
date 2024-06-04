<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'product',
    'posts_per_page' => 12,
    'paged' => $paged
);

$products = new WP_Query($args);

echo '<div class="row">';

while ($products->have_posts()) : $products->the_post();
    global $product;
    ?>
    <div class="homepage col-xs-6 col-lg-4">
        <h3><?php echo $product->get_name(); ?></h3>
        <p><?php echo $product->get_short_description(); ?></p>
        <p><a class="btn btn-default" href="<?php echo $product->get_permalink(); ?>" role="button">View details &raquo;</a></p>
    </div><!--/.col-xs-6.col-lg-4-->
    <?php
endwhile;

echo '</div><!--/row-->';

// Pagination
echo '<div class="pagination">';
echo paginate_links(array(
    'total' => $products->max_num_pages
));
echo '</div>';

wp_reset_postdata();
?>