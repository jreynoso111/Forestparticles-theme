<?php
get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section class="hero">
        <div>
            <p class="kicker">Page</p>
            <h1><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
                <p class="subtitle"><?php echo esc_html( get_the_excerpt() ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="section">
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </section>
<?php endwhile; endif; ?>

<?php
get_footer();
