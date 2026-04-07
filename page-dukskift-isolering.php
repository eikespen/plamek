<?php
/**
 * Template Name: Dukskift og isolering
 */
get_header();

$template_args = [
    'default_title1' => 'Dukskift og',
    'default_title2' => 'isolering',
    'default_desc'   => 'Vi bytter hele eller deler av duken på haller. Vi tilbyr også mange løsninger på isolerte haller.',
    'default_image'  => get_template_directory_uri() . '/assets/images/dukskift.webp',
];
include locate_template('template-parts/service-page.php');

get_footer();
