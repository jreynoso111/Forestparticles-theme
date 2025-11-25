<?php
/**
 * Template Name: Contact Demo
 */

get_header();
?>

<section class="hero">
    <div>
        <p class="kicker">Contact</p>
        <h1>Reach out while the particles drift around.</h1>
        <p class="subtitle">Swap these details with your own form or Hostinger widgets. The layout keeps the texture
            and glow in place.</p>
        <div class="actions">
            <a class="btn primary" href="#contact">Get in touch</a>
            <a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back home</a>
        </div>
    </div>
</section>

<section id="contact" class="section split">
    <div class="panel">
        <div class="pill">Message</div>
        <h3>Drop a note</h3>
        <div class="list">
            <p>Booking & shows: <a class="link-row" href="mailto:hola@forestparticles.com">hola@forestparticles.com</a></p>
            <p>Custom merch: <a class="link-row" href="mailto:merch@forestparticles.com">merch@forestparticles.com</a></p>
            <p>Press & collabs: <a class="link-row" href="mailto:press@forestparticles.com">press@forestparticles.com</a></p>
        </div>
    </div>
    <div class="panel">
        <div class="pill">Visit</div>
        <h3>Studio hours</h3>
        <ul class="list">
            <li>Wed – Fri: 2pm to 7pm</li>
            <li>Sat: 12pm to 5pm</li>
            <li>Sun – Tue: by appointment only</li>
        </ul>
        <div class="list">
            <p>Address: 112 Greenway, Suite 3B · Forest City</p>
            <p>Phone: <a class="link-row" href="tel:+18005551234">+1 (800) 555-1234</a></p>
        </div>
    </div>
</section>

<?php
get_footer();
