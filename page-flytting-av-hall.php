<?php
/**
 * Template Name: Flytting av hall
 */
get_header();

$template_args = [
    'default_title1' => 'Flytting',
    'default_title2' => 'av hall',
    'default_desc'   => 'Vi flytter alle typer haller i hele landet — trygt, raskt og effektivt.',
    'default_image'  => get_template_directory_uri() . '/assets/images/hero-default.jpg',
];
include locate_template('template-parts/service-page.php');

get_footer();
