<?php
get_header();
?>

<section class="hero">
    <div>
        <p class="kicker">Archive</p>
        <h1><?php echo esc_html( get_the_archive_title() ?: get_bloginfo( 'name' ) ); ?></h1>
        <p class="subtitle">Default fallback view for posts, archives, and anything without a dedicated template.</p>
    </div>
</section>

<section class="section">
    <div class="cards-grid">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="card">
                    <p class="tag"><?php echo esc_html( get_the_date() ); ?></p>
                    <h3><a class="link-row" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 26, '…' ) ); ?></p>
                </article>
            <?php endwhile; ?>
            <div class="pagination">
                <?php echo paginate_links(); ?>
            </div>
        <?php else : ?>
            <article class="card">
                <p class="tag">Nothing here</p>
                <h3>No content found.</h3>
                <p>Create posts or pages in WordPress and they will show up automatically.</p>
            </article>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
