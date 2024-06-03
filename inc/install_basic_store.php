<?php

global $categories;

$categories = array(
    'Wędki' => array('Spinningowe', 'Feederowe', 'Karpiowe', 'Teleskopowe', 'Morskie', 'Matchowe', 'Muchowe', 'Podlodowe', 'Sumowe'),
    'Kołowrotki' => array('Spinningowe', 'Karpiowe', 'Matchowe', 'Morskie', 'Muchowe', 'Baitcastowe', 'Multiplikatory', 'Podlodowe', 'Sumowe'),
    'Przynęty' => array('Woblery', 'Gumy', 'Obrotówki', 'Muchy', 'Błystki', 'Jigi', 'Cykały', 'Sztuczne robaki', 'Pilery'),
    'Żyłki i plecionki' => array('Żyłki', 'Plecionki', 'Fluorocarbon', 'Leadery', 'Przypony', 'Strzałówki'),
    'Akcesoria wędkarskie' => array('Haczyki', 'Ciężarki', 'Spławiki', 'Agrafki', 'Przypony', 'Stalki', 'Światełka chemiczne', 'Kleje', 'Korki', 'Sprężyny'),
    'Odzież wędkarska' => array('Kurtki', 'Spodnie', 'Buty', 'Kamizelki', 'Rękawice', 'Czapki', 'Polary', 'Kombinezony', 'Koszulki', 'Bielizna termoaktywna'),
    'Elektonika wędkarska' => array('Echosondy', 'GPS', 'Kamery podwodne', 'Latarki', 'Ładowarki', 'Baterie', 'Sonary'),
    'Pojemniki i torby' => array('Pudełka', 'Torby', 'Plecaki', 'Walizki', 'Koszyki', 'Organizerki', 'Skrzynki wędkarskie'),
    'Namioty i parasole' => array('Namioty', 'Parasole', 'Krzesła', 'Łóżka', 'Bivvy', 'Mata podłogowa', 'Śpiwory', 'Namioty ekspresowe'),
    'Podbieraki i siatki' => array('Podbieraki', 'Siatki', 'Worki karpiowe', 'Szczypce', 'Chwytaki', 'Przepływki'),
    'Podpórki i statywy' => array('Podpórki', 'Rod pody', 'Statywy', 'Haki', 'Tripody', 'Buzzbary'),
    'Zanęty i dodatki' => array('Zanęty', 'Aromaty', 'Dipy', 'Kulki proteinowe', 'Pellet', 'Przynęty naturalne', 'Mieszanki zanętowe'),
    'Łodzie i pontony' => array('Łodzie', 'Pontony', 'Silniki elektryczne', 'Silniki spalinowe', 'Akcesoria do łodzi', 'Pompki', 'Kapoki', 'Echosondy do łodzi'),
    'Zestawy wędkarskie' => array('Zestawy dla początkujących', 'Zestawy profesjonalne', 'Zestawy spinningowe', 'Zestawy karpiowe', 'Zestawy morskie', 'Zestawy podlodowe'),
    'Literatura i media' => array('Książki', 'DVD', 'Czasopisma', 'Przewodniki', 'Mapy', 'Kalendarze'),
);

function addProductCategories() {

    foreach ($categories as $category => $subcategories) {
        // Insert the category into the database
        $parent_term = wp_insert_term($category, 'product_cat');

        // Check if there was an error
        if (!is_wp_error($parent_term)) {
            // Get the parent term ID
            $parent_term_id = $parent_term['term_id'];

            // Insert each subcategory into the database with the parent ID set to the category ID
            foreach ($subcategories as $subcategory) {
                // Check if subcategory already exists
                if (!term_exists($subcategory, 'product_cat')) {
                    // Add the subcategory
                    wp_insert_term($subcategory, 'product_cat', array('parent' => $parent_term_id));
                }
            }
        }
    }
}

// Run the function after WooCommerce installation
add_action('woocommerce_installed', 'addProductCategories');

function removeProductCategories() {

    foreach ($categories as $category => $subcategories) {
        // Get the term ID of the category
        $parent_term = get_term_by('name', $category, 'product_cat');

        // Check if there was an error
        if ($parent_term) {
            // Get the parent term ID
            $parent_term_id = $parent_term->term_id;

            // Remove each subcategory
            foreach ($subcategories as $subcategory) {
                // Get the term ID of the subcategory
                $child_term = get_term_by('name', $subcategory, 'product_cat');

                // Check if subcategory exists
                if ($child_term) {
                    // Remove the subcategory
                    wp_delete_term($child_term->term_id, 'product_cat');
                }
            }

            // Remove the category
            wp_delete_term($parent_term_id, 'product_cat');
        }
    }
}

// Run the function after theme deactivation
add_action('switch_theme', 'removeProductCategories');

?>