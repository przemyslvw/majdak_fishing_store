<style>
    /* Style for the product list item */
    .product {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 20px;
        background-color: #fff;
        transition: box-shadow .3s ease-in-out;
    }

    .product:hover {
        box-shadow: 0 0 11px rgba(33, 33, 33, .2);
    }

    /* Style for the product link */
    .product a {
        color: #333;
        text-decoration: none;
    }

    /* Style for the product image */
    .product img {
        width: 100%;
        height: auto;
        margin-bottom: 15px;
    }

    /* Style for the product title */
    .product .woocommerce-loop-product__title {
        margin-bottom: 10px;
        font-size: 18px;
        font-weight: bold;
    }

    /* Style for the product price */
    .product .price {
        margin-bottom: 15px;
        color: #007bff;
        font-size: 16px;
        font-weight: bold;
    }

    /* Style for the add to cart button */
    .product .button {
        color: #fff;
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        transition: background-color .3s;
        display: inline-block;

    }


    .product .button:hover {
        background-color: #0056b3;
    }

    li::marker {
        content: "";
    }
</style>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 12,
    'paged' => $paged,
);

$current_term = get_queried_object();

if (is_object($current_term) && isset($current_term->term_id)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $current_term->term_id,
        ),
    );
}

$loop = new WP_Query($args);

if ($loop->have_posts()) {
    echo '<div class="row">'; // Add row div here
    while ($loop->have_posts()) : $loop->the_post();
        echo '<div class="col-lg-3">'; // Add column div here
        wc_get_template_part('content', 'product');
        echo '</div>'; // Close column div here
    endwhile;
    echo '</div>'; // Close row div here
} else {
    echo __('No products found');
}

wp_reset_postdata();
?>

<!-- Pagination -->
<nav class="woocommerce-pagination">
    <?php
    echo paginate_links(array(
        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'total' => $loop->max_num_pages,
        'current' => max(1, get_query_var('paged')),
        'format' => '?paged=%#%',
        'show_all' => false,
        'prev_next' => true,
        'prev_text' => __('« Previous'),
        'next_text' => __('Next »'),
        'type' => 'plain',
        'end_size' => 2,
        'mid_size' => 1
    ));
    ?>
</nav>