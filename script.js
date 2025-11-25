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
        count: 90,
        maxVelocity: 0.55,
        minVelocity: 0.08,
        accelRange: 0.009,
        radius: [1, 2.6],
        hueCenter: 355,
        hueVariance: 18,
        lightness: [60, 72],
        flicker: 0.08,
    };

    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    function init() {
        particles.length = 0;
        for (let i = 0; i < config.count; i++) {
            const direction = Math.random() * Math.PI * 2;
            const speed = Math.random() * (config.maxVelocity - config.minVelocity) + config.minVelocity;
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                vx: Math.cos(direction) * speed,
                vy: Math.sin(direction) * speed,
                ax: (Math.random() * 2 - 1) * config.accelRange,
                ay: (Math.random() * 2 - 1) * config.accelRange,
                r: Math.random() * (config.radius[1] - config.radius[0]) + config.radius[0],
                hue: config.hueCenter + (Math.random() * 2 - 1) * config.hueVariance,
                lightness: Math.random() * (config.lightness[1] - config.lightness[0]) + config.lightness[0],
                flickerOffset: Math.random() * Math.PI * 2,
            });
        }
    }

    function update() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (const p of particles) {
            // Adjust acceleration slightly to introduce a wandering motion
            p.ax += (Math.random() * 2 - 1) * config.accelRange * 0.25;
            p.ay += (Math.random() * 2 - 1) * config.accelRange * 0.25;

            p.vx = clamp(p.vx + p.ax, -config.maxVelocity, config.maxVelocity);
            p.vy = clamp(p.vy + p.ay, -config.maxVelocity, config.maxVelocity);

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

    resize();
    init();
    tick();
}
