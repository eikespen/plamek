<?php
/**
 * Template Name: Reparering av skader
 */
get_header();

$template_args = [
    'default_title1' => 'Reparering av',
    'default_title2' => 'skader',
    'default_desc'   => 'Har hallen din fått en skade? Vi reparerer alle slags skader på dukhaller raskt og pålitelig.',
    'default_image'  => get_template_directory_uri() . '/assets/images/hero-default.jpg',
];
include locate_template('template-parts/service-page.php');

get_footer();
