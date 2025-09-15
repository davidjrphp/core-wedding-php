// Swiper + countdown + map + scroll animations
document.addEventListener('DOMContentLoaded', () => {
  // Swiper
  if (typeof Swiper !== 'undefined') {
    new Swiper('.swiper', {
      loop: true,
      speed: 1000,
      effect: 'fade',
      fadeEffect: { crossFade: true },
      autoplay: { delay: 3200, disableOnInteraction: false },
      pagination: { el: '.swiper-pagination', clickable: true },
      navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
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

  // Countdown to 2025-10-04 (Africa/Lusaka ~ UTC+2)
  const el = document.getElementById('countdown');
  if (el) {
    const target = new Date('2025-10-04T00:00:00+02:00').getTime();
    const tick = () => {
      const now = new Date().getTime();
      let diff = Math.max(0, target - now);
      const d = Math.floor(diff / (1000*60*60*24)); diff -= d*24*60*60*1000;
      const h = Math.floor(diff / (1000*60*60)); diff -= h*60*60*1000;
      const m = Math.floor(diff / (1000*60)); diff -= m*60*1000;
      const s = Math.floor(diff / 1000);
      el.textContent = `${d} days ${h}h ${m}m ${s}s`;
    };
    tick(); setInterval(tick, 1000);
  }

  // Map (Lusaka + Sarai Gardens approx)
  if (typeof L !== 'undefined' && document.getElementById('mapid')) {
    const map = L.map('mapid', { zoomControl: true }).setView([-15.4167, 28.2833], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
    const marker = L.marker([-15.3745, 28.3340]).addTo(map);
    marker.bindPopup('<b>Sarai Gardens</b><br>Lusaka, Zambia').openPopup();
  }
});
