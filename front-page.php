<?php
get_header();
?>

<section class="hero">
    <div>
        <p class="kicker">Riccie Oriach</p>
        <h1>Folclore futurista sobre un lienzo carmesí.</h1>
        <p class="subtitle">Texturas oscuras, brillos ámbar y partículas errantes para presentar la música, los visuales y las crónicas de Riccie. Reemplaza estos bloques con tus secciones en WordPress y mantén el mismo aura.</p>
        <div class="actions">
            <a class="btn primary" href="<?php echo esc_url( home_url( '/music' ) ); ?>">Escuchar ahora</a>
            <a class="btn" href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Bitácora</a>
            <a class="btn" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contacto</a>
        </div>
    </div>
    <div class="hero-visual">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/hero.png' ); ?>" alt="Portada de Riccie Oriach" />
    </div>
</section>

<section class="section">
    <div class="section-header">
        <h2 class="section-title">Obra destacada</h2>
        <span class="pill">Canciones · Visuales</span>
    </div>
    <div class="cards-grid">
        <article class="card">
            <p class="tag">Álbum</p>
            <h3>Oraciones de humo</h3>
            <p>Ritmos caribeños, capas electrónicas y coros que giran como luciérnagas sobre la selva roja.</p>
        </article>
        <article class="card">
            <p class="tag">Sesión en vivo</p>
            <h3>Patio infinito</h3>
            <p>Performance íntima entre velas y proyecciones, grabada en una sola toma durante la gira isleña.</p>
        </article>
        <article class="card">
            <p class="tag">Visual</p>
            <h3>Manos de coral</h3>
            <p>Collage digital con pigmentos en movimiento; las partículas responden al tempo de la percusión.</p>
        </article>
    </div>
</section>

<section class="section split">
    <div class="panel">
        <div class="pill">Agenda</div>
        <h3>Próximas presentaciones</h3>
        <ul class="list">
            <li>07 · 12 — Santo Domingo · Warehouse Aurora</li>
            <li>07 · 28 — San Juan · Isla Verde Garden Stage</li>
            <li>08 · 16 — CDMX · Foro Bajo la Selva</li>
        </ul>
    </div>
    <div class="panel">
        <div class="pill">Bitácora</div>
        <h3>Últimas notas</h3>
        <ul class="list">
            <li>Cómo las partículas siguen la percusión en vivo.</li>
            <li>Texturas grabadas en los ríos de Jarabacoa.</li>
            <li>Un diario visual desde la residencia en la montaña.</li>
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
