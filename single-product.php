<?php
get_header();

$product = wc_get_product(get_the_ID());

if (!$product) {
    echo 'Błąd: Produkt nie istnieje.';
    return;
}

$attachment_ids = $product->get_gallery_image_ids();

if (!$attachment_ids) {
    echo 'Błąd: Produkt nie ma żadnych obrazów w galerii.';
    return;
}
?>

<div class="row row-offcanvas row-offcanvas-right">

    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>

        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php woocommerce_breadcrumb(); ?>
                    <h1 class="product_title"><?php the_title(); ?></h1>

                    <?php
                    if (has_post_thumbnail()) {
                        the_post_thumbnail();
                    } else {
                        echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" class="img-fluid" />';
                    }
                    ?>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <?php
                    global $product;
                    $product = wc_get_product(get_the_ID());

                    if (!$product) {
                        echo 'Błąd: Produkt nie istnieje.';
                        return;
                    }

                    woocommerce_show_product_images();
                    ?>
                </div>
                <div class="col-md-3">
                    <div class="product_description">
                        <?php the_content(); ?>
                    </div>

                    <div class="product_price">
                        <?php echo $product->get_price_html(); ?>
                    </div>

                    <div class="add_to_cart_button">
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="related products">
            <div class="row">
                <?php

                $related_products = wc_get_related_products($product->get_id(), 8);

                foreach ($related_products as $related_product_id) :
                    $related_product = wc_get_product($related_product_id);
                ?>
                    <div class="col-sm-3">
                        <a href="<?php echo esc_url(get_permalink($related_product->get_id())); ?>">
                            <?php echo $related_product->get_image(); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                            ?>
                            <h6><?php echo $related_product->get_name(); ?></h6>
                        </a>
                        <span class="price"><?php echo $related_product->get_price_html(); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                            ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div><!--/.col-xs-12.col-sm-9-->

    <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
            <?php
            include 'pages/home-list.php';
            ?>
        </div>
    </div><!--/.sidebar-offcanvas-->
</div><!--/row-->

<?php get_footer(); ?>