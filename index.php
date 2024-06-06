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

<div class="container-fluid">
    <div class="row">

        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <?php
            include 'pages/home-list.php';
            ?>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <?php
            if (is_page()) {
                // Jeśli jesteś na dowolnej stronie statycznej, wyświetl jej treść
                the_content();
            } else {
                // W przeciwnym razie załącz plik strony głównej
                include 'pages/home-products.php';
            }
            ?>
        </main>
    </div>
</div>

<?php get_footer(); ?>