<?php /** @var array $photos */ ?>
<?php include __DIR__ . '/header.php'; ?>

<!-- HERO -->
<section class="parallax-bg rounded-4 p-0 hero-frame" style="
  background-image:url('https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1600&auto=format&fit=crop');
">
  <div class="p-4 p-lg-5" style="background:linear-gradient(180deg, rgba(255,255,255,.85), rgba(255,255,255,.92)); border-radius:1rem">
    <div class="row g-4 align-items-center">
      <div class="col-lg-6 fade-in-up">
        <div class="hero-eyebrow mb-2">You are invited to celebrate</div>
        <h1 class="display-5 fw-bold text-success">
          Ketty <span class="text-warning">&amp;</span> Musa
        </h1>
        <p class="lead text-secondary mb-2">Join us as we celebrate the beginning of our forever.</p>
        <div class="ornament my-3"></div>

        <div class="d-flex flex-wrap gap-3 align-items-center">
          <div class="cardish px-3 py-2">
            <div class="small text-uppercase text-success fw-semibold">Our Wedding Day</div>
            <div>📅 <strong>Saturday, 21st November 2026</strong></div>
            <div>📍 <strong>Civic Centre</strong> (Blessing) &amp; <strong>Habitat Restaurant and Events Junction</strong> (Reception), Lusaka</div>
          </div>
          <a href="#rsvp" class="btn btn-success btn-lg">RSVP Now</a>
        </div>

        <blockquote class="mt-3 mb-0">
          “We are overjoyed to share this special moment of love and faith with our family and friends. Your presence will make our day complete.”
        </blockquote>

        <div class="mt-4">
          <div class="eyebrow">Countdown to forever</div>
          <div id="countdown" class="countdown-grid">
            <div class="countdown-box"><span class="num" id="cd-d">–</span><span class="lbl">Days</span></div>
            <div class="countdown-box"><span class="num" id="cd-h">–</span><span class="lbl">Hours</span></div>
            <div class="countdown-box"><span class="num" id="cd-m">–</span><span class="lbl">Mins</span></div>
            <div class="countdown-box"><span class="num" id="cd-s">–</span><span class="lbl">Secs</span></div>
          </div>
          <div class="text-muted mt-2">
            <em>“Therefore what God has joined together, let no one separate.” — Mark 10:9</em>
          </div>
        </div>
      </div>

      <div class="col-lg-6 fade-in-up">
        <div class="swiper hero-swiper rounded-4 shadow-sm">
          <div class="swiper-wrapper">
            <?php if (count($photos)): foreach ($photos as $p): ?>
              <div class="swiper-slide">
                <img src="/uploads/photos/<?= htmlspecialchars($p['path']) ?>"
                     alt="<?= htmlspecialchars($p['caption'] ?? 'Photo') ?>" class="w-100">
              </div>
            <?php endforeach; else: ?>
              <!-- <div class="swiper-slide">
                <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=1400&auto=format&fit=crop" class="w-100">
              </div> -->
            <?php endif; ?>
          </div>
          <div class="swiper-pagination"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- OUR STORY -->
<!-- <section id="story" class="mt-5 fade-in-up">
  <div class="section-head">
    <div class="eyebrow">The Beginning</div>
    <h2 class="text-success">Our Story</h2>
    <div class="ornament"></div>
  </div>
  <div class="cardish p-4">
    <h5>How We Met</h5>
    <p>Ketty and Musa’s journey began in school, where a beautiful friendship blossomed into love. Over eight years, they have grown together, supporting each other through life’s milestones with prayer, patience, and love.</p>
    <h5>The Journey</h5>
    <p>Musa has been a loving and sacrificial partner, while Ketty has been his source of encouragement and strength. Together, they’ve built a bond rooted in faith, friendship, and dreams for the future.</p>
    <h5>The Proposal</h5>
    <p>A private and heartfelt moment that sealed the promise of forever 💍.</p>
  </div>
</section> -->

<!-- TIMELINE -->
<section id="ourday" class="mt-5">
  <div class="section-head fade-in-up">
    <div class="eyebrow">Schedule</div>
    <h2 class="text-success">Wedding Day</h2>
    <div class="ornament"></div>
  </div>
  <div class="timeline-line position-relative mt-3">
    <div class="row g-4">
      <div class="col-lg-6 fade-in-up">
        <div class="cardish p-4">
          <div class="timeline-time">09:30 – 11:30 AM</div>
          <h5 class="mb-1">✨ Marriage Blessing</h5>
          <p class="mb-0">Sacred vows surrounded by loved ones, at Civic Centre.</p>
        </div>
      </div>
      <div class="col-lg-6 fade-in-up">
        <div class="cardish p-4">
          <div class="timeline-time">12:00 – 14:00 PM</div>
          <h5 class="mb-1">📸 Photoshoot</h5>
          <p class="mb-0">Cherishing the first moments as husband and wife.</p>
        </div>
      </div>
      <div class="col-lg-6 fade-in-up">
        <div class="cardish p-4">
          <div class="timeline-time">16:00 PM</div>
          <h5 class="mb-1">🎉 Reception</h5>
          <p class="mb-0">Dinner, dance, and heartfelt toasts, at Habitat Restaurant and Events Junction.</p>
        </div>
      </div>
      <div class="col-12 fade-in-up">
        <div class="cardish p-4">
          <h5 class="mb-1">🎁 Gifts</h5>
          <p class="mb-0">Monetary contributions appreciated as we begin our new chapter together 💚.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- GALLERY  -->
<section id="gallery" class="mt-5 fade-in-up">
  <div class="section-head">
    <div class="eyebrow">Moments</div>
    <h2 class="text-success">Gallery</h2>
    <div class="ornament"></div>
    <p class="text-secondary mt-2">📸 A glimpse of our love story through photos (engagement / pre-wedding shoot).</p>
  </div>
  <?php if (count($photos)): ?>
    <div class="swiper gallery-swiper">
      <div class="swiper-wrapper">
        <?php foreach ($photos as $p): ?>
          <div class="swiper-slide">
            <a href="/uploads/photos/<?= htmlspecialchars($p['path']) ?>" class="lightbox-trigger d-block w-100 h-100">
              <img src="/uploads/photos/<?= htmlspecialchars($p['path']) ?>"
                   alt="<?= htmlspecialchars($p['caption'] ?? 'Photo') ?>" class="w-100 h-100">
            </a>
            <?php if (!empty($p['caption'])): ?>
              <div class="gallery-caption"><?= htmlspecialchars($p['caption']) ?></div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  <?php else: ?>
    <div class="cardish p-4">
      <p class="mb-0">Photos will appear here once they’re uploaded from the Admin panel.</p>
    </div>
  <?php endif; ?>
</section>

<!-- RSVP -->
<section id="rsvp" class="mt-5 fade-in-up">
  <div class="section-head">
    <div class="eyebrow">Join Us</div>
    <h2 class="text-success">RSVP</h2>
    <div class="ornament"></div>
  </div>
  <?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
  <?php endif; ?>
  <form method="post" action="?action=rsvp" class="cardish p-4">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Full Name</label>
        <input name="full_name" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
      </div>
      <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input name="phone" class="form-control">
      </div>
      <div class="col-md-6">
        <label class="form-label">Will you attend?</label>
        <select name="attending" class="form-select">
          <option value="yes">Yes</option>
          <option value="no">No</option>
          <option value="maybe" selected>Maybe</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Family Side</label>
        <select name="family_side" class="form-select" required>
          <option value="" selected disabled>Choose one…</option>
          <option value="groom">Groom's Side</option>
          <option value="bride">Bride's Side</option>
        </select>
      </div>
      <div class="col-12">
        <label class="form-label">Message</label>
        <textarea name="message" rows="3" class="form-control"></textarea>
      </div>
    </div>
    <div class="mt-3 d-flex align-items-center gap-2">
      <button class="btn btn-success" type="submit">Send RSVP</button>
      <div class="ms-auto">
        <span class="badge-palette" style="background:#fff"></span>
        <span class="badge-palette" style="background:#9CAF88"></span>
        <span class="badge-palette" style="background:#2F5D50"></span>
        <span class="badge-palette" style="background:#D4AF37"></span>
        <span class="badge-palette" style="background:#F5E1DA"></span>
      </div>
    </div>
  </form>
</section>

<!-- MAP -->
<section id="map" class="mt-5 fade-in-up">
  <div class="section-head">
    <div class="eyebrow">Locations</div>
    <h2 class="text-success">Find Us</h2>
    <div class="ornament"></div>
  </div>
  <div class="row g-4">
    <div class="col-lg-7">
      <div class="cardish p-2">
        <div class="p-2 pb-0 small text-muted">✨ Marriage Blessing — Civic Centre, 09:30 AM</div>
        <div id="mapid" class="map-wrap" style="height:380px"></div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="cardish p-4 h-100 d-flex flex-column">
        <div class="small text-muted">🎉 Reception — 16:00 PM</div>
        <h5 class="mb-1">Habitat Restaurant and Events Junction</h5>
        <p class="mb-3">Lilayi Road, Lusaka, Zambia</p>
        <a class="btn btn-outline-success mt-auto align-self-start"
           href="https://www.google.com/maps/search/?api=1&query=Habitat+Restaurant+and+Events+Junction+Lilayi+Road+Lusaka"
           target="_blank" rel="noopener">Open in Google Maps</a>
      </div>
    </div>
  </div>
</section>

<div class="site-footer-note mt-5 fade-in-up">
  <div class="ornament mb-3" style="max-width:140px"></div>
  <div class="brand-script">Ketty &amp; Musa</div>
  <div class="small mt-1">21 · 11 · 2026 — With love and gratitude for you being part of our story</div>
</div>

<!-- Lightbox -->
<div class="lightbox-overlay" id="lightbox">
  <button class="lightbox-close" id="lightbox-close" aria-label="Close">&times;</button>
  <img id="lightbox-img" src="" alt="">
</div>

<?php include __DIR__ . '/footer.php'; ?>
