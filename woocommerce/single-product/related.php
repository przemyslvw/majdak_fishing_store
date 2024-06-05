<div class="related products">
    <div class="row">
        <?php foreach ($related_products as $related_product) : ?>
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