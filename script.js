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
        maxVelocity: 0.35,
        radius: [1, 2.4],
    };

    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    function init() {
        particles.length = 0;
        for (let i = 0; i < config.count; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                vx: (Math.random() * 2 - 1) * config.maxVelocity,
                vy: (Math.random() * 2 - 1) * config.maxVelocity,
                r: Math.random() * (config.radius[1] - config.radius[0]) + config.radius[0],
                hue: Math.random() * 30 + 345,
            });
        }
    }

    function update() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (const p of particles) {
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
            ctx.beginPath();
            ctx.fillStyle = `hsla(${p.hue}, 75%, 64%, 0.9)`;
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fill();
        }
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
