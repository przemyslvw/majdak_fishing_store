<?php
/**
 *
 * @link https://majdak.online
 *
 * @package WordPress
 * @subpackage majdak_fishing_store
 * @since 1.0.0
 */
get_header(); ?>


      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1>Hello, world!</h1>
            <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
          </div>
          <?php
            include 'pages/home-products.php';
          ?>
        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
            <?php
            $product_categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=0');
            if (!empty($product_categories)) {
                foreach ($product_categories as $parent_product_category) {
                    echo '<div class="dropdown">';
                    echo '<a href="#" class="list-group-item dropdown-toggle" data-toggle="dropdown">' . $parent_product_category->name . ' <span class="caret"></span></a>';

                    $child_product_categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=' . $parent_product_category->term_id);
                    if (!empty($child_product_categories)) {
                        echo '<ul class="dropdown-menu">';
                        foreach ($child_product_categories as $child_product_category) {
                            echo '<li><a href="' . get_term_link($child_product_category) . '">' . $child_product_category->name . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->

<?php get_footer(); ?>