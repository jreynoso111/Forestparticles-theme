<?php
get_header();
?>

<section class="hero">
    <div>
        <p class="kicker">Blog</p>
        <h1><?php bloginfo( 'name' ); ?> — latest posts.</h1>
        <p class="subtitle">If you set a posts page in WordPress, this layout keeps the floating particles and textured
            background for the feed.</p>
        <div class="actions">
            <a class="btn primary" href="#posts">Read on</a>
            <a class="btn" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Say hola</a>
        </div>
    </div>
</section>

<section id="posts" class="section">
    <div class="section-header">
        <h2 class="section-title">Latest entries</h2>
        <span class="pill">From the loop</span>
    </div>
    <div class="cards-grid">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article class="card">
                    <p class="tag"><?php echo esc_html( get_the_date() ); ?></p>
                    <h3><a class="link-row" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 26, '…' ) ); ?></p>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <article class="card">
                <p class="tag">Coming soon</p>
                <h3>No posts published yet.</h3>
                <p>Add posts in WordPress and they will appear automatically in this grid.</p>
            </article>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
