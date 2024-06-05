<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo get_bloginfo('name'); ?></title>
    <meta name="description" content="">
    <meta name="author" content="majdak.online">

    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon.ico">
    <?php wp_head(); ?>
</head>

<body>
    <?php
    include 'pages/nav.php';
    ?>