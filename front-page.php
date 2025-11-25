<?php
get_header();
?>

<section class="hero">
    <div>
        <p class="kicker">Immersive ambience</p>
        <h1>Texture & particles made for Hostinger pages.</h1>
        <p class="subtitle">This custom theme keeps the paper-like texture in the background and overlays the drifting
            particle network we built. Use it as a starting point for your WordPress pages.</p>
        <div class="actions">
            <a class="btn primary" href="<?php echo esc_url( home_url( '/merch' ) ); ?>">Shop merch</a>
            <a class="btn" href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Read the blog</a>
            <a class="btn" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Say hola</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="section-header">
        <h2 class="section-title">Featured drops</h2>
        <span class="pill">Fresh · Curated</span>
    </div>
    <div class="cards-grid">
        <article class="card">
            <p class="tag">Vinyl</p>
            <h3>Forest Pulse LP</h3>
            <p>Pressed on moss-green vinyl with a foil-stamped sleeve. Includes a digital booklet.</p>
            <div class="price">$38</div>
        </article>
        <article class="card">
            <p class="tag">Hoodie</p>
            <h3>Particle Drift</h3>
            <p>Soft heavyweight fleece, gradient drawcord tips and an embroidered chest seal.</p>
            <div class="price">$72</div>
        </article>
        <article class="card">
            <p class="tag">Print</p>
            <h3>Ambient Study</h3>
            <p>A3 giclée print on archival cotton paper with matte varnish and signed edge detail.</p>
            <div class="price">$24</div>
        </article>
    </div>
</section>

<section class="section split">
    <div class="panel">
        <div class="pill">Shows</div>
        <h3>Upcoming dates</h3>
        <ul class="list">
            <li>07 · 12 — Santo Domingo · Warehouse Aurora</li>
            <li>07 · 28 — San Juan · Isla Verde Garden Stage</li>
            <li>08 · 16 — CDMX · Foro Bajo la Selva</li>
        </ul>
    </div>
    <div class="panel">
        <div class="pill">Inside the studio</div>
        <h3>Latest blog notes</h3>
        <ul class="list">
            <li>How we mapped particle physics to the new live visuals.</li>
            <li>Five textures sampled from field recordings in El Yunque.</li>
            <li>Building a merch line that feels like the music sounds.</li>
        </ul>
    </div>
</section>

<?php
if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        if ( get_the_content() ) :
            ?>
            <section class="section">
                <div class="section-header">
                    <h2 class="section-title">Your WordPress blocks</h2>
                    <span class="pill">Editable</span>
                </div>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </section>
            <?php
        endif;
    endwhile;
endif;

get_footer();
