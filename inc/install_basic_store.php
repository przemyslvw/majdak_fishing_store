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

function addProductCategories()
{

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

function removeProductCategories()
{

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


// Add a simple products

global $woblers;

$woblers = array(
    array('title' => 'Wobler Głęboko Nurkujący', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '45.99', 'sku' => 'WB001'),
    array('title' => 'Wobler Powierzchniowy Błysk', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '39.50', 'sku' => 'WB002'),
    array('title' => 'Wobler Średniotonowy Pstrąg', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '54.00', 'sku' => 'WB003'),
    array('title' => 'Wobler Ratlin Srebrny', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '49.75', 'sku' => 'WB004'),
    array('title' => 'Wobler Żaba Zielona', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '44.20', 'sku' => 'WB005'),
    array('title' => 'Wobler Sinking Minnow', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '51.30', 'sku' => 'WB006'),
    array('title' => 'Wobler Pływający Perch', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '46.85', 'sku' => 'WB007'),
    array('title' => 'Wobler Król Wody', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '58.40', 'sku' => 'WB008'),
    array('title' => 'Wobler Miedziany Smużak', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '48.75', 'sku' => 'WB009'),
    array('title' => 'Wobler Jaskółka Złota', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '55.25', 'sku' => 'WB010'),
    array('title' => 'Wobler Szybki Strumień', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '47.99', 'sku' => 'WB011'),
    array('title' => 'Wobler Cykada Czarna', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '53.50', 'sku' => 'WB012'),
    array('title' => 'Wobler Wesoły Karpiuś', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '49.20', 'sku' => 'WB013'),
    array('title' => 'Wobler Srebrzysty Drako', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '56.75', 'sku' => 'WB014'),
    array('title' => 'Wobler Nokturno', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '52.99', 'sku' => 'WB015'),
    array('title' => 'Wobler Świecąca Krewetka', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '45.00', 'sku' => 'WB016'),
    array('title' => 'Wobler Bajeczna Okoń', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '47.80', 'sku' => 'WB017'),
    array('title' => 'Wobler Neonowy Szczupak', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '55.30', 'sku' => 'WB018'),
    array('title' => 'Wobler Migotka', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '44.50', 'sku' => 'WB019'),
    array('title' => 'Wobler Śnieżny Błysk', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '53.75', 'sku' => 'WB020'),
    array('title' => 'Wobler Czerwona Płetwa', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '49.99', 'sku' => 'WB021'),
    array('title' => 'Wobler Drapieżnik', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '51.50', 'sku' => 'WB022'),
    array('title' => 'Wobler Czarna Woda', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '54.99', 'sku' => 'WB023'),
    array('title' => 'Wobler Błyskawica', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '48.20', 'sku' => 'WB024'),
    array('title' => 'Wobler Srebrna Jaskółka', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '56.00', 'sku' => 'WB025'),
    array('title' => 'Wobler Tropikalna Ryba', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '47.25', 'sku' => 'WB026'),
    array('title' => 'Wobler Księżycowy Pstrąg', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '50.75', 'sku' => 'WB027'),
    array('title' => 'Wobler Perłowy Szczupak', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '52.40', 'sku' => 'WB028'),
    array('title' => 'Wobler Rubinowa Szprotka', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '54.10', 'sku' => 'WB029'),
    array('title' => 'Wobler Złoty Węgorz', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '49.65', 'sku' => 'WB030'),
    array('title' => 'Wobler Szybki Szczupak', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '47.30', 'sku' => 'WB031'),
    array('title' => 'Wobler Lśniąca Sardynka', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '51.85', 'sku' => 'WB032'),
    array('title' => 'Wobler Chyża Kleń', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '45.20', 'sku' => 'WB033'),
    array('title' => 'Wobler Szybki Struś', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '56.50', 'sku' => 'WB034'),
    array('title' => 'Wobler Turbo Cykada', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '52.10', 'sku' => 'WB035'),
    array('title' => 'Wobler Miedziany Smok', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '48.95', 'sku' => 'WB036'),
    array('title' => 'Wobler Jaskrawozielony', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '54.75', 'sku' => 'WB037'),
    array('title' => 'Wobler Srebrny Wilk', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '53.20', 'sku' => 'WB038'),
    array('title' => 'Wobler Złoty Delfin', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '46.80', 'sku' => 'WB039'),
    array('title' => 'Wobler Głębinowy Węgorz', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '50.30', 'sku' => 'WB040'),
    array('title' => 'Wobler Świetlik', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '55.60', 'sku' => 'WB041'),
    array('title' => 'Wobler Czarna Cykada', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '49.40', 'sku' => 'WB042'),
    array('title' => 'Wobler Tęczowa Okoń', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '47.10', 'sku' => 'WB043'),
    array('title' => 'Wobler Lśniąca Łososiowa', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '52.85', 'sku' => 'WB044'),
    array('title' => 'Wobler Turkusowy Błysk', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '48.75', 'sku' => 'WB045'),
    array('title' => 'Wobler Nocny Struś', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '53.30', 'sku' => 'WB046'),
    array('title' => 'Wobler Zielona Kobra', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '51.10', 'sku' => 'WB047'),
    array('title' => 'Wobler Rubinowy Karp', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '46.50', 'sku' => 'WB048'),
    array('title' => 'Wobler Górska Ryba', 'tax_input' => array('product_cat' => array(30, 31)), 'price' => '55.99', 'sku' => 'WB049'),
    array('title' => 'Wobler Neonowa Płoć',  'tax_input' => array('product_cat' => array(30, 31)), 'price' => '49.20', 'sku' => 'WB050')
);

global $spinners;

$spinners = array(
    array('title' => 'Spinner Głęboko Nurkujący', 'tax_input' => array('product_cat' => array(30, 33)), 'price' => '45.99', 'sku' => 'SP001'),
    array('title' => 'Spinner Klasyczny', 'tax_input' => array('product_cat' => array(30, 33)), 'price' => '25.99', 'sku' => 'SP002'),
    array('title' => 'Spinner Łososiowy', 'tax_input' => array('product_cat' => array(30, 33)), 'price' => '55.99', 'sku' => 'SP003'),
    array('title' => 'Spinner Szczupakowy', 'tax_input' => array('product_cat' => array(30, 33)), 'price' => '35.99', 'sku' => 'SP004'),
    array('title' => 'Spinner Trollingowy', 'tax_input' => array('product_cat' => array(30, 33)), 'price' => '40.99', 'sku' => 'SP005'),
    array('title' => 'Spinner Szybki', 'tax_input' => array('product_cat' => array(30, 33)), 'price' => '30.99', 'sku' => 'SP006'),
    array('title' => 'Spinner Mały', 'tax_input' => array('product_cat' => array(30, 33)), 'price' => '20.99', 'sku' => 'SP007'),
    array('title' => 'Spinner Średni', 'tax_input' => array('product_cat' => array(30, 33)), 'price' => '25.99', 'sku' => 'SP008'),
    array('title' => 'Spinner Duży', 'tax_input' => array('product_cat' => array(30, 33)), 'price' => '50.99', 'sku' => 'SP009'),
    array('title' => 'Spinner Ultra Lekki', 'tax_input' => array('product_cat' => array(30, 33)), 'price' => '15.99', 'sku' => 'SP010'),
);

$spinning = array(
    array('title' => 'Wędka Spinningowa 1', 'tax_input' => array('product_cat' => array(17, 18)), 'price' => '99.99', 'sku' => 'SPN001'),
    array('title' => 'Wędka Spinningowa 2', 'tax_input' => array('product_cat' => array(17, 18)), 'price' => '109.99', 'sku' => 'SPN002'),
    array('title' => 'Wędka Spinningowa 3', 'tax_input' => array('product_cat' => array(17, 18)), 'price' => '119.99', 'sku' => 'SPN003'),
    array('title' => 'Wędka Spinningowa 4', 'tax_input' => array('product_cat' => array(17, 18)), 'price' => '129.99', 'sku' => 'SPN004'),
    array('title' => 'Wędka Spinningowa 5', 'tax_input' => array('product_cat' => array(17, 18)), 'price' => '139.99', 'sku' => 'SPN005'),
    array('title' => 'Wędka Spinningowa 6', 'tax_input' => array('product_cat' => array(17, 18)), 'price' => '149.99', 'sku' => 'SPN006'),
    array('title' => 'Wędka Spinningowa 7', 'tax_input' => array('product_cat' => array(17, 18)), 'price' => '159.99', 'sku' => 'SPN007'),
    array('title' => 'Wędka Spinningowa 8', 'tax_input' => array('product_cat' => array(17, 18)), 'price' => '169.99', 'sku' => 'SPN008'),
    array('title' => 'Wędka Spinningowa 9', 'tax_input' => array('product_cat' => array(17, 18)), 'price' => '179.99', 'sku' => 'SPN009'),
    array('title' => 'Wędka Spinningowa 10', 'tax_input' => array('product_cat' => array(17, 18)), 'price' => '189.99', 'sku' => 'SPN010')
);

$feeder = array(
    array('title' => 'Wędka Feederowa 1', 'tax_input' => array('product_cat' => array(17, 19)), 'price' => '99.99', 'sku' => 'FED001'),
    array('title' => 'Wędka Feederowa 2', 'tax_input' => array('product_cat' => array(17, 19)), 'price' => '109.99', 'sku' => 'FED002'),
    array('title' => 'Wędka Feederowa 3', 'tax_input' => array('product_cat' => array(17, 19)), 'price' => '119.99', 'sku' => 'FED003'),
    array('title' => 'Wędka Feederowa 4', 'tax_input' => array('product_cat' => array(17, 19)), 'price' => '129.99', 'sku' => 'FED004'),
    array('title' => 'Wędka Feederowa 5', 'tax_input' => array('product_cat' => array(17, 19)), 'price' => '139.99', 'sku' => 'FED005'),
    array('title' => 'Wędka Feederowa 6', 'tax_input' => array('product_cat' => array(17, 19)), 'price' => '149.99', 'sku' => 'FED006'),
    array('title' => 'Wędka Feederowa 7', 'tax_input' => array('product_cat' => array(17, 19)), 'price' => '159.99', 'sku' => 'FED007'),
    array('title' => 'Wędka Feederowa 8', 'tax_input' => array('product_cat' => array(17, 19)), 'price' => '169.99', 'sku' => 'FED008'),
    array('title' => 'Wędka Feederowa 9', 'tax_input' => array('product_cat' => array(17, 19)), 'price' => '179.99', 'sku' => 'FED009'),
    array('title' => 'Wędka Feederowa 10', 'tax_input' => array('product_cat' => array(17, 19)), 'price' => '189.99', 'sku' => 'FED010')
);
$carp = array(
    array('title' => 'Wędka Karpiowa 1', 'tax_input' => array('product_cat' => array(17, 20)), 'price' => '99.99', 'sku' => 'CARP001'),
    array('title' => 'Wędka Karpiowa 2', 'tax_input' => array('product_cat' => array(17, 20)), 'price' => '109.99', 'sku' => 'CARP002'),
    array('title' => 'Wędka Karpiowa 3', 'tax_input' => array('product_cat' => array(17, 20)), 'price' => '119.99', 'sku' => 'CARP003'),
    array('title' => 'Wędka Karpiowa 4', 'tax_input' => array('product_cat' => array(17, 20)), 'price' => '129.99', 'sku' => 'CARP004'),
    array('title' => 'Wędka Karpiowa 5', 'tax_input' => array('product_cat' => array(17, 20)), 'price' => '139.99', 'sku' => 'CARP005'),
    array('title' => 'Wędka Karpiowa 6', 'tax_input' => array('product_cat' => array(17, 20)), 'price' => '149.99', 'sku' => 'CARP006'),
    array('title' => 'Wędka Karpiowa 7', 'tax_input' => array('product_cat' => array(17, 20)), 'price' => '159.99', 'sku' => 'CARP007'),
    array('title' => 'Wędka Karpiowa 8', 'tax_input' => array('product_cat' => array(17, 20)), 'price' => '169.99', 'sku' => 'CARP008'),
    array('title' => 'Wędka Karpiowa 9', 'tax_input' => array('product_cat' => array(17, 20)), 'price' => '179.99', 'sku' => 'CARP009'),
    array('title' => 'Wędka Karpiowa 10', 'tax_input' => array('product_cat' => array(17, 20)), 'price' => '189.99', 'sku' => 'CARP010')
);

$telescopic = array(
    array('title' => 'Wędka Teleskopowa 1', 'tax_input' => array('product_cat' => array(17, 21)), 'price' => '99.99', 'sku' => 'TEL001'),
    array('title' => 'Wędka Teleskopowa 2', 'tax_input' => array('product_cat' => array(17, 21)), 'price' => '109.99', 'sku' => 'TEL002'),
    array('title' => 'Wędka Teleskopowa 3', 'tax_input' => array('product_cat' => array(17, 21)), 'price' => '119.99', 'sku' => 'TEL003'),
    array('title' => 'Wędka Teleskopowa 4', 'tax_input' => array('product_cat' => array(17, 21)), 'price' => '129.99', 'sku' => 'TEL004'),
    array('title' => 'Wędka Teleskopowa 5', 'tax_input' => array('product_cat' => array(17, 21)), 'price' => '139.99', 'sku' => 'TEL005'),
    array('title' => 'Wędka Teleskopowa 6', 'tax_input' => array('product_cat' => array(17, 21)), 'price' => '149.99', 'sku' => 'TEL006'),
    array('title' => 'Wędka Teleskopowa 7', 'tax_input' => array('product_cat' => array(17, 21)), 'price' => '159.99', 'sku' => 'TEL007'),
    array('title' => 'Wędka Teleskopowa 8', 'tax_input' => array('product_cat' => array(17, 21)), 'price' => '169.99', 'sku' => 'TEL008'),
);

function add_sample_products()
{
    global $spinners;
    global $woblers;
    global $spinning;
    global $feeder;
    global $carp;
    global $telescopic;

    $products = array_merge($spinners, $woblers, $spinning, $feeder, $carp, $telescopic);

    foreach ($products as $product) {
        if (get_page_by_title($product['title'], OBJECT, 'product') == null) {
            $post_id = wp_insert_post(array(
                'post_title' => $product['title'],
                'post_content' => 'Oto produkt wędkarski wysokiej jakości, zaprojektowany dla entuzjastów na każdym poziomie zaawansowania. Jego trwała konstrukcja zapewnia długowieczność i niezawodność w różnych warunkach wędkarskich. Łatwy w użyciu i bardzo skuteczny, znacząco zwiększa efektywność połowów. Idealny zarówno do wędkowania w wodach słodkich, jak i słonych.',
                'post_status' => 'publish',
                'post_type' => 'product',
                'tax_input' => $product['tax_input']
            ));

            update_post_meta($post_id, '_visibility', 'visible');
            update_post_meta($post_id, '_stock_status', 'instock');
            update_post_meta($post_id, 'total_sales', '0');
            update_post_meta($post_id, '_downloadable', 'no');
            update_post_meta($post_id, '_virtual', 'no');
            update_post_meta($post_id, '_regular_price', $product['price']);
            update_post_meta($post_id, '_sale_price', '');
            update_post_meta($post_id, '_purchase_note', '');
            update_post_meta($post_id, '_featured', 'no');
            update_post_meta($post_id, '_weight', '0.3');
            update_post_meta($post_id, '_length', '10');
            update_post_meta($post_id, '_width', '2');
            update_post_meta($post_id, '_height', '2');
            update_post_meta($post_id, '_sku', $product['sku']);
            update_post_meta($post_id, '_product_attributes', array());
            update_post_meta($post_id, '_sale_price_dates_from', '');
            update_post_meta($post_id, '_sale_price_dates_to', '');
            update_post_meta($post_id, '_price', $product['price']);
            update_post_meta($post_id, '_sold_individually', '');
            update_post_meta($post_id, '_manage_stock', 'no');
            update_post_meta($post_id, '_backorders', 'no');
            update_post_meta($post_id, '_stock', '');
        }
    }
}

// Run the function after WooCommerce installation
add_action('woocommerce_installed', 'add_sample_products');


// Load images

function add_images_on_theme_install()
{
    $image_dir = get_template_directory() . '/assets/images/';
    $images = glob($image_dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE); // Get all image files from the directory

    foreach ($images as $image) {
        $filetype = wp_check_filetype(basename($image), null);
        $wp_upload_dir = wp_upload_dir();

        $image_title = preg_replace('/\.[^.]+$/', '', basename($image));

        // Check if the image already exists in the media library
        if (get_page_by_title($image_title, OBJECT, 'attachment') == null) {
            $attachment = array(
                'guid' => $wp_upload_dir['url'] . '/' . basename($image),
                'post_mime_type' => $filetype['type'],
                'post_title' => $image_title,
                'post_content' => '',
                'post_status' => 'inherit'
            );

            $attach_id = wp_insert_attachment($attachment, $image);
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attach_data = wp_generate_attachment_metadata($attach_id, $image);
            wp_update_attachment_metadata($attach_id, $attach_data);
        }
    }
}

add_action('woocommerce_installed', 'add_images_on_theme_install');
