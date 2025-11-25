<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="noise-overlay"></div>
<header>
    <div class="wrapper navbar">
        <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span></span><?php bloginfo( 'name' ); ?></a>
        <nav>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'nav-links',
                    'fallback_cb'    => function () {
                        echo '<ul class="nav-links">';
                        echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Inicio</a></li>';
                        echo '<li><a href="' . esc_url( home_url( '/merch' ) ) . '">Obra</a></li>';
                        echo '<li><a href="' . esc_url( home_url( '/blog' ) ) . '">Bitácora</a></li>';
                        echo '<li><a href="' . esc_url( home_url( '/contact' ) ) . '">Contacto</a></li>';
                        echo '</ul>';
                    },
                )
            );
            ?>
        </nav>
    </div>
</header>

<main class="wrapper">
