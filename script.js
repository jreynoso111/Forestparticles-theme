document.addEventListener('DOMContentLoaded', () => {
    const navbarLinks = document.querySelectorAll('.nav-links a');
    const currentPath = (window.location.pathname || '/').replace(/\/$/, '') || '/';

    navbarLinks.forEach(link => {
        const linkPath = (new URL(link.href)).pathname.replace(/\/$/, '') || '/';
        if (linkPath === currentPath) {
            link.classList.add('active');
        }
    });

    createParticles();
});

function createParticles() {
    const canvas = document.createElement('canvas');
    canvas.className = 'particle-canvas';
    document.body.appendChild(canvas);
    const ctx = canvas.getContext('2d');

    const particles = [];
    const config = {
        count: 130,
        maxVelocity: 0.55,
        minVelocity: 0.06,
        accelRange: 0.012,
        radius: [0.9, 3.2],
        hues: [
            { center: 355, variance: 12, weight: 0.55 }, // guava pink
            { center: 50, variance: 10, weight: 0.2 },   // sun yellow
            { center: 176, variance: 14, weight: 0.25 }, // turquoise
        ],
        lightness: [54, 82],
        flicker: 0.14,
        swirlSpeed: 0.0012,
        flowPush: 0.02,
    };

    let speedBoostUntil = 0;
    let swirlAngle = Math.random() * Math.PI * 2;

    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    function init() {
        particles.length = 0;
        for (let i = 0; i < config.count; i++) {
            const direction = Math.random() * Math.PI * 2;
            const speed = Math.random() * (config.maxVelocity - config.minVelocity) + config.minVelocity;
            const bandCenter = canvas.height * 0.5;
            const bandSpread = canvas.height * 0.18;
            particles.push({
                x: Math.random() * canvas.width,
                y: sampleBand(bandCenter, bandSpread),
                vx: Math.cos(direction) * speed,
                vy: Math.sin(direction) * speed,
                ax: (Math.random() * 2 - 1) * config.accelRange,
                ay: (Math.random() * 2 - 1) * config.accelRange,
                r: Math.random() * (config.radius[1] - config.radius[0]) + config.radius[0],
                hue: sampleHue(),
                lightness: Math.random() * (config.lightness[1] - config.lightness[0]) + config.lightness[0],
                flickerOffset: Math.random() * Math.PI * 2,
            });
        }
    }

    function update() {
        const now = performance.now();
        const activeBoost = now < speedBoostUntil ? 3 : 1;
        swirlAngle += config.swirlSpeed;
        const flowX = Math.cos(swirlAngle) * config.flowPush;
        const flowY = Math.sin(swirlAngle) * config.flowPush;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (const p of particles) {
            // Adjust acceleration slightly to introduce a wandering motion
            p.ax += (Math.random() * 2 - 1) * config.accelRange * 0.25;
            p.ay += (Math.random() * 2 - 1) * config.accelRange * 0.25;

            p.vx = clamp((p.vx + p.ax + flowX) * activeBoost, -config.maxVelocity * activeBoost, config.maxVelocity * activeBoost);
            p.vy = clamp((p.vy + p.ay + flowY) * activeBoost, -config.maxVelocity * activeBoost, config.maxVelocity * activeBoost);

            p.x += p.vx;
            p.y += p.vy;

            if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
            if (p.y < 0 || p.y > canvas.height) p.vy *= -1;
        }
    }

    function draw() {
        ctx.lineWidth = 1;
        for (let i = 0; i < particles.length; i++) {
            const p = particles[i];
            const flicker = Math.sin(Date.now() * 0.002 + p.flickerOffset) * config.flicker;
            const lightness = Math.max(0, Math.min(100, p.lightness + flicker * 100));
            ctx.beginPath();
            ctx.fillStyle = `hsla(${p.hue}, 80%, ${lightness}%, 0.9)`;
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    function clamp(value, min, max) {
        return Math.min(Math.max(value, min), max);
    }

    function tick() {
        update();
        draw();
        requestAnimationFrame(tick);
    }

    window.addEventListener('resize', () => {
        resize();
        init();
    });

    window.addEventListener('scroll', () => {
        speedBoostUntil = performance.now() + 600;
    }, { passive: true });

    window.addEventListener('wheel', () => {
        speedBoostUntil = performance.now() + 600;
    }, { passive: true });

    resize();
    init();
    tick();

    function sampleBand(center, spread) {
        // Use Box-Muller transform to bias particles toward a milky-way band
        let u = 0, v = 0;
        while (u === 0) u = Math.random();
        while (v === 0) v = Math.random();
        const gaussian = Math.sqrt(-2.0 * Math.log(u)) * Math.cos(2.0 * Math.PI * v);
        return clamp(center + gaussian * spread, 0, canvas.height);
    }

    function sampleHue() {
        const roll = Math.random();
        let cumulative = 0;
        for (const option of config.hues) {
            cumulative += option.weight;
            if (roll <= cumulative) {
                return option.center + (Math.random() * 2 - 1) * option.variance;
            }
        }
        const fallback = config.hues[config.hues.length - 1];
        return fallback.center + (Math.random() * 2 - 1) * fallback.variance;
    }
}
