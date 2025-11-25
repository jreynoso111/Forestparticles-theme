<?php
/**
 * Template Name: Blog Demo
 */

get_header();
?>

<section class="hero">
    <div>
        <p class="kicker">Stories</p>
        <h1>Blog layout on the textured particle canvas.</h1>
        <p class="subtitle">Assign this template to any page to preview how your posts will look layered over the
            ambient background.</p>
        <div class="actions">
            <a class="btn primary" href="#latest">Latest posts</a>
            <a class="btn" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Pitch a topic</a>
        </div>
    </div>
</section>

<section id="latest" class="section">
    <div class="section-header">
        <h2 class="section-title">Recent writing</h2>
        <span class="pill">Dynamic · From WordPress</span>
    </div>
    <div class="cards-grid">
        <?php
        $blog_query = new WP_Query(
            array(
                'posts_per_page' => 3,
                'post_status'    => 'publish',
            )
        );

        if ( $blog_query->have_posts() ) :
            while ( $blog_query->have_posts() ) :
                $blog_query->the_post();
                ?>
                <article class="card">
                    <p class="tag"><?php echo esc_html( get_the_date() ); ?></p>
                    <h3><a class="link-row" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 28, '…' ) ); ?></p>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <article class="card">
                <p class="tag">Studio</p>
                <h3>How we mapped particle physics to the new live visuals.</h3>
                <p>A walkthrough of the shader graph, the color palette, and how the visuals react to tempo changes.</p>
            </article>
            <article class="card">
                <p class="tag">Field notes</p>
                <h3>Five textures sampled from field recordings in El Yunque.</h3>
                <p>Listen for the cicadas, distant thunder and water drips that inspired the ambience of the new set.</p>
            </article>
            <article class="card">
                <p class="tag">Merch</p>
                <h3>Building a merch line that feels like the music sounds.</h3>
                <p>Behind-the-scenes on fabrics, dyes, and why every tag is stitched with reflective filament.</p>
            </article>
            <?php
        endif;
        ?>
    </div>
</section>

<?php
get_footer();
