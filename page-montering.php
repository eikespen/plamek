<?php
/**
 * Template Name: Montering
 */
get_header();

$template_args = [
    'default_title1' => 'Montering',
    'default_title2' => 'av haller',
    'default_desc'   => 'Profesjonell montering og demontering av duk- og stålhaller over hele landet.',
    'default_image'  => get_template_directory_uri() . '/assets/images/montering.webp',
];
include locate_template('template-parts/service-page.php');

get_footer();
