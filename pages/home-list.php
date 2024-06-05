<style>
    /* Hide sub-menu by default */
    .sub-menu {
        display: none;
        transition: all 2.5s ease !important;
        /* Adjust time as needed */



    }

    /* Show sub-menu on hover */
    .nav-item:hover .sub-menu,
    .nav-item.active .sub-menu {
        display: block;
        transition: all 2.5s ease !important;
        /* Adjust time as needed */


    }
</style>
<ul class="nav flex-column">
    <?php
    $product_categories = get_terms('product_cat', array(
        'hide_empty' => false,
        'parent' => 0, // Only top level categories
        'orderby' => 'name', // Order by category name
        'order' => 'ASC', // Ascending order
    ));

    $current_term = get_queried_object();

    foreach ($product_categories as $product_category) : ?>
        <li class="nav-item <?php if (is_object($current_term) && (isset($current_term->parent) && $current_term->parent == $product_category->term_id || $current_term->term_id == $product_category->term_id)) echo 'active'; ?>">
            <a class="nav-link" href="<?php echo get_term_link($product_category); ?>">
                <?php echo $product_category->name; ?>
            </a>
            <?php
            $child_categories = get_terms('product_cat', array(
                'hide_empty' => false,
                'parent' => $product_category->term_id, // Get child categories
            ));

            if (!empty($child_categories)) : ?>
                <ul class="nav flex-column ml-3 sub-menu">
                    <?php foreach ($child_categories as $child_category) : ?>
                        <li class="nav-item <?php if (is_object($current_term) && isset($current_term->term_id) && $current_term->term_id == $child_category->term_id) echo 'active'; ?>">
                            <a class="nav-link" href="<?php echo get_term_link($child_category); ?>">
                                <?php echo $child_category->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>