<?php
/**
 * Template Name: Merch Demo
 */

get_header();
?>

<section class="hero">
    <div>
        <p class="kicker">Shop</p>
        <h1>Merch grid with the same ambient vibe.</h1>
        <p class="subtitle">Use these sample cards as a guide when replacing content with Hostinger boxes inside
            WordPress.</p>
        <div class="actions">
            <a class="btn primary" href="#tees">View items</a>
            <a class="btn" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Request custom bundle</a>
        </div>
    </div>
</section>

<section id="tees" class="section">
    <div class="section-header">
        <h2 class="section-title">Essentials</h2>
        <span class="pill">Layered · Cozy</span>
    </div>
    <div class="cards-grid">
        <article class="card">
            <p class="tag">T-shirt</p>
            <h3>Glowing Pines</h3>
            <p>Vintage wash cotton tee with neon sapling icon and interior neck print.</p>
            <div class="tag-row">
                <span class="tag">XS-XXL</span>
                <span class="tag">100% Cotton</span>
            </div>
            <div class="price">$32</div>
        </article>
        <article class="card">
            <p class="tag">Crewneck</p>
            <h3>Echo Grid</h3>
            <p>Loopback fleece featuring the particle lattice stitched tone-on-tone across the chest.</p>
            <div class="tag-row">
                <span class="tag">French Terry</span>
                <span class="tag">Limited</span>
            </div>
            <div class="price">$68</div>
        </article>
        <article class="card">
            <p class="tag">Cap</p>
            <h3>Mist Trail</h3>
            <p>Unstructured 6-panel cap with matte silicone emblem and forest-green underbill.</p>
            <div class="tag-row">
                <span class="tag">Adjustable</span>
                <span class="tag">Pre-washed</span>
            </div>
            <div class="price">$28</div>
        </article>
    </div>
</section>

<section class="section">
    <div class="section-header">
        <h2 class="section-title">Collectors</h2>
        <span class="pill">Numbered · Archival</span>
    </div>
    <div class="cards-grid">
        <article class="card">
            <p class="tag">Vinyl</p>
            <h3>Forest Pulse Deluxe</h3>
            <p>2xLP with alternate artwork, copper foil spine and exclusive ambient interludes.</p>
            <div class="price">$54</div>
        </article>
        <article class="card">
            <p class="tag">Poster</p>
            <h3>Signal Bloom</h3>
            <p>18x24 inch screen print on charcoal paper with dual metallic inks and blind emboss.</p>
            <div class="price">$38</div>
        </article>
        <article class="card">
            <p class="tag">Bundle</p>
            <h3>Field Kit</h3>
            <p>Rope-handled tote with a patch set, enamel pin, mini zine and download codes.</p>
            <div class="price">$64</div>
        </article>
    </div>
</section>

<?php
get_footer();
