function initThemeEffects() {
    const navbarLinks = document.querySelectorAll('.nav-links a');
    const currentPath = (window.location.pathname || '/').replace(/\/$/, '') || '/';

    navbarLinks.forEach(link => {
        const linkPath = (new URL(link.href)).pathname.replace(/\/$/, '') || '/';
        if (linkPath === currentPath) {
            link.classList.add('active');
        }
    });

    createParticles();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initThemeEffects);
} else {
    initThemeEffects();
}

function createParticles() {
    const existing = document.querySelector('.particle-canvas');
    if (existing) {
        existing.remove();
    }

    const canvas = document.createElement('canvas');
    canvas.className = 'particle-canvas';
    document.body.prepend(canvas);
    const ctx = canvas.getContext('2d');

    const particles = [];
    const config = {
        count: 130,
        maxVelocity: 0.44,
        minVelocity: 0.01,
        accelRange: 0.012,
        radius: [0.8, 4.8],
        hues: [
            { center: 355, variance: 12, weight: 0.55 }, // guava pink
            { center: 50, variance: 10, weight: 0.2 },   // sun yellow
            { center: 176, variance: 14, weight: 0.25 }, // turquoise
        ],
        lightness: [32, 90],
        flicker: 0.32,
        swirlSpeed: 0.0008,
        flowPush: 0.012,
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
            particles.push(createParticle());
        }
    }

    function update() {
        const now = performance.now();
        const activeBoost = now < speedBoostUntil ? 3 : 1;
        swirlAngle += config.swirlSpeed;
        const flowX = Math.cos(swirlAngle) * config.flowPush;
        const flowY = Math.sin(swirlAngle) * config.flowPush;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        const largeParticles = particles.filter(p => p.r >= 3.4);

        for (const p of particles) {
            // Adjust acceleration slightly to introduce a wandering motion
            p.ax += (Math.random() * 2 - 1) * config.accelRange * 0.35 + p.accelDrift * 0.08;
            p.ay += (Math.random() * 2 - 1) * config.accelRange * 0.35 + p.accelDrift * 0.08;

            if (p.r <= 2.2 && largeParticles.length && Math.random() < 0.18) {
                const target = nearestLarge(p, largeParticles);
                if (target) {
                    const dx = target.x - p.x;
                    const dy = target.y - p.y;
                    const dist = Math.max(1, Math.hypot(dx, dy));
                    const tangential = { x: -dy / dist, y: dx / dist };
                    const pull = {
                        x: (dx / dist) * 0.0025,
                        y: (dy / dist) * 0.0025,
                    };
                    p.vx += tangential.x * 0.035 + pull.x;
                    p.vy += tangential.y * 0.035 + pull.y;
                }
            }

            const localMax = p.maxV * activeBoost;
            p.vx = clamp((p.vx + p.ax + flowX) * activeBoost, -localMax, localMax);
            p.vy = clamp((p.vy + p.ay + flowY) * activeBoost, -localMax, localMax);

            p.x += p.vx;
            p.y += p.vy;

            // Wrap or respawn particles that drift too far so the sky stays populated
            const margin = 48;
            if (p.x < -margin || p.x > canvas.width + margin || p.y < -margin || p.y > canvas.height + margin) {
                resetParticle(p, canvas, config);
            }
        }
    }

    function draw() {
        ctx.lineWidth = 1;
        for (let i = 0; i < particles.length; i++) {
            const p = particles[i];
            p.hue += p.hueDrift;
            const flicker = Math.sin(Date.now() * p.flickerRate + p.flickerOffset) * config.flicker * p.flickerScale;
            const lightness = Math.max(0, Math.min(100, p.lightness + flicker * 100));
            ctx.beginPath();
            ctx.fillStyle = `hsla(${p.hue}, ${p.saturation}%, ${lightness}%, ${p.opacity})`;
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

    function resetParticle(p, canvas, config) {
        const fresh = createParticle();
        Object.assign(p, fresh);
    }

    function createParticle() {
        const edge = Math.floor(Math.random() * 4);
        const margin = 64;
        const bandCenter = canvas.height * 0.5;
        const bandSpread = canvas.height * 0.18;
        const targetY = sampleBand(bandCenter, bandSpread);
        const targetX = Math.random() * canvas.width;

        let x, y;
        if (edge === 0) { // left
            x = -margin;
            y = Math.random() * canvas.height;
        } else if (edge === 1) { // right
            x = canvas.width + margin;
            y = Math.random() * canvas.height;
        } else if (edge === 2) { // top
            x = Math.random() * canvas.width;
            y = -margin;
        } else { // bottom
            x = Math.random() * canvas.width;
            y = canvas.height + margin;
        }

        const dirX = targetX - x;
        const dirY = targetY - y;
        const angle = Math.atan2(dirY, dirX) + (Math.random() * 0.5 - 0.25);
        const speed = Math.random() * (config.maxVelocity - config.minVelocity) + config.minVelocity;

        return {
            x,
            y,
            vx: Math.cos(angle) * speed,
            vy: Math.sin(angle) * speed,
            ax: (Math.random() * 2 - 1) * config.accelRange,
            ay: (Math.random() * 2 - 1) * config.accelRange,
            accelDrift: (Math.random() * 2 - 1) * config.accelRange,
            r: Math.random() * (config.radius[1] - config.radius[0]) + config.radius[0],
            hue: sampleHue(),
            hueDrift: (Math.random() * 2 - 1) * 0.006,
            saturation: 60 + Math.random() * 30,
            maxV: speed * (1.35 + Math.random() * 2.0),
            lightness: Math.random() * (config.lightness[1] - config.lightness[0]) + config.lightness[0],
            flickerOffset: Math.random() * Math.PI * 2,
            flickerScale: 0.55 + Math.random() * 1.35,
            flickerRate: 0.0015 + Math.random() * 0.0025,
            opacity: 0.55 + Math.random() * 0.45,
        };
    }

    function nearestLarge(p, largeParticles) {
        let closest = null;
        let minDist = Infinity;
        for (const big of largeParticles) {
            const dx = big.x - p.x;
            const dy = big.y - p.y;
            const dist = dx * dx + dy * dy;
            if (dist < minDist) {
                minDist = dist;
                closest = big;
            }
        }
        return closest;
    }
}
