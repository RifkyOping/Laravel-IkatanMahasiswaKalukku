/**
 * Starfield 3D + bintang jatuh (meteor) untuk halaman login IMK.
 *
 * - Proyeksi perspektif sederhana (FOV) supaya bintang terasa punya kedalaman 3D.
 * - Render mengikuti devicePixelRatio, jadi tetap tajam di layar FHD (1920x1080) ke atas.
 * - Menghormati prefers-reduced-motion: hanya menggambar satu frame statis.
 * - Animasi dijeda saat tab tidak aktif supaya hemat baterai.
 *
 * Dipakai tanpa build step (file publik), cukup <canvas id="starfield"> di layout.
 */
(function () {
    'use strict'

    var canvas = document.getElementById('starfield')
    if (!canvas || !canvas.getContext) return

    var ctx = canvas.getContext('2d')
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches

    var FOV = 340 // makin kecil = perspektif makin ekstrem
    var w = 0
    var h = 0
    var dpr = 1
    var stars = []
    var meteors = []
    var running = false
    var rafId = null
    var lastTime = 0

    function rand(min, max) {
        return min + Math.random() * (max - min)
    }

    // ---------- Bintang latar ----------

    function makeStar(spread) {
        return {
            x: rand(-spread, spread),
            y: rand(-spread, spread),
            z: rand(60, 1400),
            size: rand(0.5, 1.5),
            twinkle: rand(0, Math.PI * 2),
            speed: rand(6, 26), // kecepatan mendekat ke kamera (unit z per detik)
        }
    }

    function buildScene() {
        var spread = Math.max(w, h) * 1.15
        var count = Math.max(90, Math.min(320, Math.round((w * h) / 8200)))

        stars = []
        for (var i = 0; i < count; i++) stars.push(makeStar(spread))

        meteors = []
    }

    // ---------- Meteor / bintang jatuh ----------

    function makeMeteor() {
        var z = rand(150, 950)
        var speed = rand(320, 760)
        var angle = rand(0.55, 0.95) // radian, arah miring ke kanan-bawah

        return {
            x: rand(-w * 0.85, w * 0.35),
            y: rand(-h * 0.95, -h * 0.05),
            z: z,
            vx: Math.cos(angle) * speed,
            vy: Math.sin(angle) * speed,
            vz: rand(-120, -30), // sedikit mendekat ke kamera
            trail: rand(0.055, 0.115), // panjang jejak dalam satuan detik
            core: rand(1.1, 2.4),
            life: 1,
        }
    }

    function project(x, y, z) {
        var scale = FOV / Math.max(z, 1)
        return {
            sx: w / 2 + x * scale,
            sy: h / 2 + y * scale,
            scale: scale,
        }
    }

    // ---------- Resize ----------

    function resize() {
        dpr = Math.min(window.devicePixelRatio || 1, 2)
        w = canvas.clientWidth || window.innerWidth
        h = canvas.clientHeight || window.innerHeight

        canvas.width = Math.max(1, Math.floor(w * dpr))
        canvas.height = Math.max(1, Math.floor(h * dpr))
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0)

        buildScene()
        if (reduceMotion) drawFrame(0)
    }

    // ---------- Gambar ----------

    function drawStars(dt) {
        var spread = Math.max(w, h) * 1.15

        for (var i = 0; i < stars.length; i++) {
            var s = stars[i]

            if (dt > 0) {
                s.z -= s.speed * dt
                s.twinkle += dt * 2.2
                if (s.z < 50) {
                    stars[i] = makeStar(spread)
                    stars[i].z = rand(1250, 1400)
                    continue
                }
            }

            var p = project(s.x, s.y, s.z)
            if (p.sx < -40 || p.sx > w + 40 || p.sy < -40 || p.sy > h + 40) continue

            var depth = 1 - Math.min(s.z / 1400, 1)
            var radius = Math.max(0.35, s.size * (0.45 + depth * 1.25))
            var alpha = (0.22 + depth * 0.6) * (0.72 + Math.sin(s.twinkle) * 0.28)

            ctx.beginPath()
            ctx.fillStyle = 'rgba(233, 248, 236, ' + alpha.toFixed(3) + ')'
            ctx.arc(p.sx, p.sy, radius, 0, Math.PI * 2)
            ctx.fill()

            // Bintang terdekat diberi sedikit halo
            if (depth > 0.72) {
                ctx.beginPath()
                ctx.fillStyle = 'rgba(142, 182, 155, ' + ((depth - 0.72) * 0.5).toFixed(3) + ')'
                ctx.arc(p.sx, p.sy, radius * 3.2, 0, Math.PI * 2)
                ctx.fill()
            }
        }
    }

    function drawMeteor(m) {
        var head = project(m.x, m.y, m.z)
        var tail = project(
            m.x - m.vx * m.trail,
            m.y - m.vy * m.trail,
            m.z - m.vz * m.trail
        )

        var depth = 1 - Math.min(m.z / 1000, 1)
        var alpha = Math.min(1, m.life) * (0.42 + depth * 0.58)
        var width = Math.max(0.8, m.core * (0.5 + depth * 1.6))

        var gradient = ctx.createLinearGradient(tail.sx, tail.sy, head.sx, head.sy)
        gradient.addColorStop(0, 'rgba(142, 182, 155, 0)')
        gradient.addColorStop(0.55, 'rgba(218, 241, 222, ' + (alpha * 0.45).toFixed(3) + ')')
        gradient.addColorStop(1, 'rgba(255, 255, 255, ' + alpha.toFixed(3) + ')')

        ctx.strokeStyle = gradient
        ctx.lineWidth = width
        ctx.lineCap = 'round'
        ctx.beginPath()
        ctx.moveTo(tail.sx, tail.sy)
        ctx.lineTo(head.sx, head.sy)
        ctx.stroke()

        // Kepala meteor + cahaya
        ctx.beginPath()
        ctx.fillStyle = 'rgba(255, 255, 255, ' + alpha.toFixed(3) + ')'
        ctx.arc(head.sx, head.sy, width * 0.95, 0, Math.PI * 2)
        ctx.fill()

        ctx.beginPath()
        ctx.fillStyle = 'rgba(218, 241, 222, ' + (alpha * 0.18).toFixed(3) + ')'
        ctx.arc(head.sx, head.sy, width * 4.5, 0, Math.PI * 2)
        ctx.fill()
    }

    function updateMeteors(dt) {
        // Peluang spawn: rata-rata sekitar 1,6 meteor per detik
        if (dt > 0 && meteors.length < 14 && Math.random() < dt * 1.6) {
            meteors.push(makeMeteor())
        }

        for (var i = meteors.length - 1; i >= 0; i--) {
            var m = meteors[i]

            if (dt > 0) {
                m.x += m.vx * dt
                m.y += m.vy * dt
                m.z = Math.max(60, m.z + m.vz * dt)
            }

            var head = project(m.x, m.y, m.z)
            var offscreen = head.sx > w + 260 || head.sy > h + 260

            if (offscreen) {
                meteors.splice(i, 1)
                continue
            }

            drawMeteor(m)
        }
    }

    function drawFrame(dt) {
        ctx.clearRect(0, 0, w, h)
        ctx.globalCompositeOperation = 'lighter'
        drawStars(dt)
        updateMeteors(dt)
        ctx.globalCompositeOperation = 'source-over'
    }

    function loop(time) {
        if (!running) return

        var dt = lastTime ? Math.min((time - lastTime) / 1000, 0.05) : 0
        lastTime = time

        drawFrame(dt)
        rafId = window.requestAnimationFrame(loop)
    }

    function start() {
        if (running || reduceMotion) return
        running = true
        lastTime = 0
        rafId = window.requestAnimationFrame(loop)
    }

    function stop() {
        running = false
        if (rafId) window.cancelAnimationFrame(rafId)
        rafId = null
    }

    var resizeTimer = null
    window.addEventListener(
        'resize',
        function () {
            if (resizeTimer) window.clearTimeout(resizeTimer)
            resizeTimer = window.setTimeout(resize, 150)
        },
        { passive: true }
    )

    document.addEventListener('visibilitychange', function () {
        if (document.hidden) stop()
        else start()
    })

    resize()
    if (reduceMotion) drawFrame(0)
    else start()
})()
