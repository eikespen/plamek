/* Plamek theme — front-end JS */
(function () {
    'use strict';

    /* ── Mobile menu toggle ── */
    var btn      = document.getElementById('pl-mobile-menu-button');
    var menu     = document.getElementById('pl-mobile-menu');
    var iconOpen = document.getElementById('pl-menu-icon');
    var iconClose= document.getElementById('pl-close-icon');
    if (btn && menu) {
        btn.addEventListener('click', function () {
            menu.classList.toggle('hidden');
            if (iconOpen)  iconOpen.classList.toggle('hidden');
            if (iconClose) iconClose.classList.toggle('hidden');
        });
    }

    /* ── Mobile services submenu toggle ── */
    var svcToggle = document.getElementById('pl-mobile-services-toggle');
    var svcMenu   = document.getElementById('pl-mobile-services-menu');
    if (svcToggle && svcMenu) {
        svcToggle.addEventListener('click', function () {
            svcMenu.classList.toggle('hidden');
        });
    }

    /* ── Hero slider ── */
    var slider = document.getElementById('pl-hero-slider');
    if (slider) {
        var slides = slider.querySelectorAll('.pl-hero-slide');
        var dots   = document.querySelectorAll('#pl-hero-dots button');
        var idx    = 0;
        var interval = parseInt(slider.getAttribute('data-interval'), 10) || 6000;

        function go(n) {
            idx = (n + slides.length) % slides.length;
            slides.forEach(function (s, i) {
                s.classList.toggle('opacity-100', i === idx);
                s.classList.toggle('opacity-0',   i !== idx);
            });
            dots.forEach(function (d, i) {
                d.classList.toggle('bg-white', i === idx);
                d.classList.toggle('scale-125', i === idx);
                d.classList.toggle('bg-white/60', i !== idx);
            });
        }
        dots.forEach(function (d) {
            d.addEventListener('click', function () { go(parseInt(d.getAttribute('data-index'), 10)); });
        });
        if (slides.length > 1) {
            setInterval(function () { go(idx + 1); }, interval);
        }
    }
})();
