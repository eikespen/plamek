<?php
/**
 * Template Name: Vedlikehold
 */
get_header();

$template_args = [
    'default_title1' => 'Vedlikehold',
    'default_title2' => 'og service',
    'default_desc'   => 'Profesjonelt vedlikehold holder hallen din i topp stand. Service-avtaler reduserer driftsstans og uforutsette kostnader.',
    'default_image'  => get_template_directory_uri() . '/assets/images/vedlikehold.webp',
];
include locate_template('template-parts/service-page.php');

get_footer();
