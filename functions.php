<?php
/**
 * Forest Particles Theme setup.
 */

function forestparticles_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'forestparticles' ),
        )
    );
}
add_action( 'after_setup_theme', 'forestparticles_setup' );

function forestparticles_assets() {
    wp_enqueue_style(
        'forestparticles-fonts',
        'https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Outfit:wght@400;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'forestparticles-style',
        get_stylesheet_uri(),
        array( 'forestparticles-fonts' ),
        filemtime( get_stylesheet_directory() . '/style.css' )
    );

    wp_enqueue_script(
        'forestparticles-scripts',
        get_template_directory_uri() . '/script.js',
        array(),
        filemtime( get_template_directory() . '/script.js' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'forestparticles_assets' );
