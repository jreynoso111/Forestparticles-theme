<?php
/**
 * Template Name: Merch Demo
 */

get_header();
?>

<section class="hero">
    <div>
        <p class="kicker">Obra</p>
        <h1>Piezas que viven en este universo.</h1>
        <p class="subtitle">Un muestrario curado para mostrar discos, sesiones y arte visual de Riccie. Reemplaza cada
            bloque con tus módulos de WordPress y mantén la misma atmósfera.</p>
        <div class="actions">
            <a class="btn primary" href="#tees">Ver piezas</a>
            <a class="btn" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Solicitar colaboración</a>
        </div>
    </div>
</section>

<section id="tees" class="section">
    <div class="section-header">
        <h2 class="section-title">Música</h2>
        <span class="pill">Discografía · Sesiones</span>
    </div>
    <div class="cards-grid">
        <article class="card">
            <p class="tag">LP</p>
            <h3>Oraciones de humo</h3>
            <p>La nueva entrega de Riccie, con percusión afrocaribeña y sintetizadores granulares.</p>
            <div class="tag-row">
                <span class="tag">Vinilo · Digital</span>
                <span class="tag">2024</span>
            </div>
        </article>
        <article class="card">
            <p class="tag">Sesión</p>
            <h3>Patio infinito</h3>
            <p>Grabada en vivo con proyecciones de partículas reactivas; invita a la comunidad a un espacio íntimo.</p>
            <div class="tag-row">
                <span class="tag">Video</span>
                <span class="tag">Live</span>
            </div>
        </article>
        <article class="card">
            <p class="tag">Single</p>
            <h3>Brisa roja</h3>
            <p>Una canción breve y luminosa que mezcla acordeón y glitches; ideal para un teaser o estreno.</p>
            <div class="tag-row">
                <span class="tag">Streaming</span>
                <span class="tag">Acústico</span>
            </div>
        </article>
    </div>
</section>

<section class="section">
    <div class="section-header">
        <h2 class="section-title">Visuales</h2>
        <span class="pill">Collage · Motion</span>
    </div>
    <div class="cards-grid">
        <article class="card">
            <p class="tag">Serie</p>
            <h3>Manos de coral</h3>
            <p>Capas de pigmento en movimiento sobre texturas de archivo; el brillo sigue el ritmo de las congas.</p>
        </article>
        <article class="card">
            <p class="tag">Foto</p>
            <h3>Residencia en la montaña</h3>
            <p>Serie fotográfica de la residencia creativa; incluye notas a mano y sonidos de campo.</p>
        </article>
        <article class="card">
            <p class="tag">Instalación</p>
            <h3>Faro de humo</h3>
            <p>Una pieza inmersiva con audio espacializado y partículas proyectadas sobre fibras rojas.</p>
        </article>
    </div>
</section>

<?php
get_footer();
