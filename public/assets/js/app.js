// Swiper + countdown + map + scroll animations
document.addEventListener('DOMContentLoaded', () => {
  // Swiper (hero fade slideshow + gallery sliding carousel, each initialized independently)
  if (typeof Swiper !== 'undefined') {
    document.querySelectorAll('.hero-swiper').forEach((el) => {
      new Swiper(el, {
        loop: el.querySelectorAll('.swiper-slide').length > 1,
        speed: 1000,
        effect: 'fade',
        fadeEffect: { crossFade: true },
        autoplay: { delay: 3800, disableOnInteraction: false },
        pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
        navigation: {
          nextEl: el.querySelector('.swiper-button-next'),
          prevEl: el.querySelector('.swiper-button-prev'),
        },
      });
    });

    document.querySelectorAll('.gallery-swiper').forEach((el) => {
      const slideCount = el.querySelectorAll('.swiper-slide').length;
      new Swiper(el, {
        loop: slideCount > 3,
        speed: 800,
        slidesPerView: 1,
        spaceBetween: 14,
        autoplay: { delay: 3000, disableOnInteraction: false },
        breakpoints: {
          576: { slidesPerView: 2, spaceBetween: 20 },
          992: { slidesPerView: 3, spaceBetween: 26 },
        },
        pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
        navigation: {
          nextEl: el.querySelector('.swiper-button-next'),
          prevEl: el.querySelector('.swiper-button-prev'),
        },
      });
    });
  }

  // Scroll-in animations (fade-in-up)
  const els = document.querySelectorAll('.fade-in-up');
  if ('IntersectionObserver' in window && els.length) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.18 });
    els.forEach(el => io.observe(el));
  } else {
    // Fallback
    els.forEach(el => el.classList.add('visible'));
  }

  // Countdown to 2026-11-21 (Africa/Lusaka ~ UTC+2)
  const cdD = document.getElementById('cd-d');
  const cdH = document.getElementById('cd-h');
  const cdM = document.getElementById('cd-m');
  const cdS = document.getElementById('cd-s');
  if (cdD && cdH && cdM && cdS) {
    const target = new Date('2026-11-21T00:00:00+02:00').getTime();
    const pad = (n) => String(n).padStart(2, '0');
    const tick = () => {
      const now = new Date().getTime();
      let diff = Math.max(0, target - now);
      const d = Math.floor(diff / (1000*60*60*24)); diff -= d*24*60*60*1000;
      const h = Math.floor(diff / (1000*60*60)); diff -= h*60*60*1000;
      const m = Math.floor(diff / (1000*60)); diff -= m*60*1000;
      const s = Math.floor(diff / 1000);
      cdD.textContent = d; cdH.textContent = pad(h); cdM.textContent = pad(m); cdS.textContent = pad(s);
    };
    tick(); setInterval(tick, 1000);
  }

  // Lightbox for gallery photos
  const lightbox = document.getElementById('lightbox');
  const lightboxImg = document.getElementById('lightbox-img');
  const lightboxClose = document.getElementById('lightbox-close');
  if (lightbox && lightboxImg) {
    const open = (src, alt) => {
      lightboxImg.src = src;
      lightboxImg.alt = alt || '';
      lightbox.classList.add('open');
    };
    const close = () => { lightbox.classList.remove('open'); lightboxImg.src = ''; };
    document.querySelectorAll('.lightbox-trigger').forEach(a => {
      a.addEventListener('click', (e) => {
        e.preventDefault();
        open(a.getAttribute('href'), a.querySelector('img')?.alt);
      });
    });
    lightboxClose?.addEventListener('click', close);
    lightbox.addEventListener('click', (e) => { if (e.target === lightbox) close(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });
  }

  // Map (Civic Centre - marriage blessing venue)
  if (typeof L !== 'undefined' && document.getElementById('mapid')) {
    const map = L.map('mapid', { zoomControl: true }).setView([-15.423129, 28.300381], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
    const marker = L.marker([-15.423129, 28.300381]).addTo(map);
    marker.bindPopup('<b>Hatbit Restaurant and Events Junction</b><br>Marriage Blessing · 09:30 AM<br>Lusaka, Zambia').openPopup();
  }
});
