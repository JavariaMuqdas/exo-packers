/* Exo Packers and Movers: interactions (no libraries, fast and SEO friendly) */
(function () {
  clearTimeout(window.__t);                       // JS loaded fine, cancel the "show everything" fallback
  const $ = (s, c = document) => c.querySelector(s);
  const $$ = (s, c = document) => Array.from(c.querySelectorAll(s));
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const fine = matchMedia('(hover: hover) and (pointer: fine)').matches;

  /* ---------- Menu ---------- */
  const nav = $('#siteNav'), menu = $('#nav'), burger = $('#burger');
  const setMenu = (open) => {
    menu.classList.toggle('is-open', open);
    burger.classList.toggle('is-open', open);
    burger.setAttribute('aria-expanded', open);
    burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    document.body.style.overflow = open ? 'hidden' : '';
  };
  burger.addEventListener('click', () => setMenu(!menu.classList.contains('is-open')));
  $$('a', menu).forEach((a) => a.addEventListener('click', () => setMenu(false)));
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setMenu(false); });

  /* ---------- Split headline words ---------- */
  $$('[data-words]').forEach((el) => {
    const words = el.textContent.trim().split(/\s+/);
    el.innerHTML = words.map((w, i) => `<span class="w" style="--i:${i}"><span>${w}</span></span>`).join(' ');
    el.classList.add('is-split');
  });

  /* ---------- Hero: slides, sky and truck swap (home page only) ---------- */
  const stage = $('#stage');
  if (stage) {
    const hs = $$('.hslide'), rigs = $$('.rig'), dots = $$('#heroDots button');
    const nextImg = $('#nextImg'), nextTitle = $('#nextTitle'), nextNo = $('#nextNo'), nextBar = $('.next__bar i');
    const thumbs = ['assets/img/hero-1.jpg', 'assets/img/hero-2.jpg', 'assets/img/hero-3.jpg'];
    const titles = hs.map((s) => s.dataset.title);
    let cur = 0, busy = false, timer;
    const pad = (n) => String(n).padStart(2, '0');

    const paintNext = () => {
      const n = (cur + 1) % hs.length;
      nextImg.src = thumbs[n]; nextTitle.textContent = titles[n]; nextNo.textContent = pad(cur + 1);
      nextBar.style.animation = 'none'; void nextBar.offsetWidth; nextBar.style.animation = '';
    };
    const go = (n) => {
      n = (n + hs.length) % hs.length;
      if (n === cur || busy) return;
      busy = true;
      const old = rigs[cur];
      old.classList.remove('is-in'); old.classList.add('is-out');            // old truck drives away
      hs[cur].classList.remove('is-active'); dots[cur].classList.remove('is-active');
      cur = n;
      stage.dataset.s = cur + 1;                                              // sky, sun and tint change
      hs[cur].classList.add('is-active'); dots[cur].classList.add('is-active');
      hs.forEach((s, i) => s.setAttribute('aria-hidden', i !== cur));
      paintNext(); restart();
      setTimeout(() => { rigs[cur].classList.remove('is-out'); rigs[cur].classList.add('is-in'); }, 650);   // new truck drives in
      setTimeout(() => { old.classList.remove('is-out'); busy = false; }, 1300);
    };
    const restart = () => { clearTimeout(timer); if (!reduce) timer = setTimeout(() => go(cur + 1), 7200); };
    $('#heroNext').addEventListener('click', () => go(cur + 1));
    dots.forEach((d, i) => d.addEventListener('click', () => go(i)));
    stage.addEventListener('mouseenter', () => { stage.classList.add('is-paused'); clearTimeout(timer); });
    stage.addEventListener('mouseleave', () => { stage.classList.remove('is-paused'); restart(); });
    let sx = null;                                                             // swipe on phones
    stage.addEventListener('pointerdown', (e) => { sx = e.clientX; });
    stage.addEventListener('pointerup', (e) => { if (sx !== null && Math.abs(e.clientX - sx) > 60) go(cur + (e.clientX < sx ? 1 : -1)); sx = null; });
    hs.forEach((s, i) => s.setAttribute('aria-hidden', i !== 0));
    if (reduce) rigs[0].classList.add('is-in');
    paintNext(); restart();
  }

  /* ---------- Nav: solid after scroll, hide on scroll down, active link ---------- */
  let lastY = 0, tick = false;
  const tb = $('#topbar');
  let tbH = tb ? tb.offsetHeight : 0;
  addEventListener('resize', () => { tbH = tb ? tb.offsetHeight : 0; });
  const onScroll = () => {
    const y = scrollY;
    nav.style.setProperty('--tbv', Math.max(0, tbH - y) + 'px');   // navbar slides up as the top bar leaves
    nav.classList.toggle('is-solid', y > tbH + 24);
    if (!menu.classList.contains('is-open')) nav.classList.toggle('is-hidden', y > lastY && y > 520);
    lastY = y; tick = false;
  };
  addEventListener('scroll', () => { if (!tick) { tick = true; requestAnimationFrame(onScroll); } }, { passive: true });
  onScroll();

  /* ---------- Reveal on scroll ---------- */
  const io = 'IntersectionObserver' in window ? new IntersectionObserver((entries) => entries.forEach((e) => {
    if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
  }), { threshold: .12, rootMargin: '0px 0px -40px 0px' }) : null;
  $$('[data-reveal]').forEach((el) => {
    el.style.setProperty('--d', (parseInt(el.dataset.delay || 0, 10) * 0.1) + 's');
    io ? io.observe(el) : el.classList.add('in');
  });

  /* ---------- Counters ---------- */
  const count = (el) => {
    const target = parseInt(el.dataset.count, 10);
    if (reduce) { el.textContent = target.toLocaleString(); return; }
    const t0 = performance.now(), dur = 1900;
    const step = (t) => {
      const p = Math.min((t - t0) / dur, 1), e = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(target * e).toLocaleString();
      if (p < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
  };
  const co = io ? new IntersectionObserver((entries) => entries.forEach((e) => { if (e.isIntersecting) { count(e.target); co.unobserve(e.target); } }), { threshold: .6 }) : null;
  $$('[data-count]').forEach((el) => co ? co.observe(el) : count(el));

  /* ---------- Steps line draws when visible ---------- */
  const steps = $('[data-steps]');
  if (steps && io) {
    const so = new IntersectionObserver((en) => en.forEach((e) => { if (e.isIntersecting) { steps.classList.add('drawn'); so.disconnect(); } }), { threshold: .35 });
    so.observe(steps);
  } else if (steps) steps.classList.add('drawn');

  /* ---------- Gentle parallax ---------- */
  const px = $$('[data-parallax]');
  if (px.length && !reduce) {
    let queued = false;
    const run = () => {
      queued = false;
      const vh = innerHeight;
      px.forEach((el) => {
        const box = (el.tagName === 'IMG' ? el.parentElement : el.parentElement).getBoundingClientRect();
        if (box.bottom < -120 || box.top > vh + 120) return;
        const lim = box.height * (el.tagName === 'IMG' ? .06 : .16);
        const y = Math.max(-lim, Math.min(lim, (box.top + box.height / 2 - vh / 2) * -parseFloat(el.dataset.parallax)));
        const sc = el.dataset.scale || 1;
        el.style.transform = `translate3d(0, ${y.toFixed(1)}px, 0) scale(${sc})`;
      });
    };
    const q = () => { if (!queued) { queued = true; requestAnimationFrame(run); } };
    addEventListener('scroll', q, { passive: true }); addEventListener('resize', q); run();
  }

  /* ---------- Magnetic buttons ---------- */
  if (fine && !reduce) $$('.btn--mag').forEach((b) => {
    b.addEventListener('mousemove', (e) => { const r = b.getBoundingClientRect(); b.style.transform = `translate(${(e.clientX - r.left - r.width / 2) * .18}px, ${(e.clientY - r.top - r.height / 2) * .3}px)`; });
    b.addEventListener('mouseleave', () => { b.style.transform = ''; });
    b.style.transition += ', transform .4s cubic-bezier(.2,.8,.2,1)';
  });

  /* ---------- FAQ accordion ---------- */
  $$('[data-accordion]').forEach((acc) => $$('.acc__btn', acc).forEach((btn) => btn.addEventListener('click', () => {
    const item = btn.closest('.acc__item'), open = !item.classList.contains('is-open');
    $$('.acc__item', acc).forEach((i) => { i.classList.remove('is-open'); $('.acc__btn', i).setAttribute('aria-expanded', 'false'); });
    if (open) { item.classList.add('is-open'); btn.setAttribute('aria-expanded', 'true'); }
  })));

  /* ---------- Vehicle slider ---------- */
  const fs = $('#fleetSlider');
  if (fs) {
    const bar = $('#fleetBar');
    const stepW = () => (fs.querySelector('.vcard')?.offsetWidth || 280) + 18;
    $('#fleetNext').addEventListener('click', () => fs.scrollBy({ left: stepW(), behavior: 'smooth' }));
    $('#fleetPrev').addEventListener('click', () => fs.scrollBy({ left: -stepW(), behavior: 'smooth' }));
    const upd = () => {
      const max = fs.scrollWidth - fs.clientWidth, p = max > 0 ? fs.scrollLeft / max : 0;
      const w = Math.max(fs.clientWidth / fs.scrollWidth, .12);
      bar.style.width = (w * 100) + '%'; bar.style.transform = `translateX(${p * (1 / w - 1) * 100}%)`;
    };
    fs.addEventListener('scroll', upd, { passive: true }); addEventListener('resize', upd); upd();
  }

  /* ---------- Testimonials ---------- */
  const rv = $$('.rv__slide');
  if (rv.length) {
    const dotsBox = $('#rvDots'); let i = 0, timer;
    rv.forEach((_, k) => { const b = document.createElement('button'); b.setAttribute('aria-label', 'Review ' + (k + 1)); b.addEventListener('click', () => show(k, true)); dotsBox.appendChild(b); });
    const show = (n, user) => {
      i = (n + rv.length) % rv.length;
      rv.forEach((s, k) => s.classList.toggle('is-active', k === i));
      $$('button', dotsBox).forEach((d, k) => d.classList.toggle('is-active', k === i));
      if (user) restart();
    };
    const restart = () => { clearInterval(timer); if (!reduce) timer = setInterval(() => show(i + 1), 6500); };
    $('#rvNext').addEventListener('click', () => show(i + 1, true));
    $('#rvPrev').addEventListener('click', () => show(i - 1, true));
    $('#reviewSlider').addEventListener('mouseenter', () => clearInterval(timer));
    $('#reviewSlider').addEventListener('mouseleave', restart);
    show(0); restart();
  }
  /* Back to top button: appears after scrolling, ring shows how far down the page you are */
  (function () {
    const btn = document.getElementById('toTop');
    if (!btn) return;
    const bar = btn.querySelector('.totop__bar');
    const C = 2 * Math.PI * 24;
    bar.style.strokeDasharray = C;
    const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
    let queued = false;
    const update = () => {
      queued = false;
      const max = document.documentElement.scrollHeight - innerHeight;
      const p = max > 0 ? Math.min(1, scrollY / max) : 0;
      bar.style.strokeDashoffset = C * (1 - p);
      btn.classList.toggle('is-visible', scrollY > 500);
    };
    addEventListener('scroll', () => { if (!queued) { queued = true; requestAnimationFrame(update); } }, { passive: true });
    addEventListener('resize', update);
    update();
    btn.addEventListener('click', () => {
      btn.classList.add('is-going');
      scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
      setTimeout(() => btn.classList.remove('is-going'), 800);
    });
  })();


  /* Services mega menu: hover works with CSS alone; this only powers the phone accordion */
  (function () {
    const drop = document.querySelector('.nav__drop');
    if (!drop) return;
    const toggle = (btn, box) => btn.addEventListener('click', () => { const open = !box.classList.contains('is-open'); box.classList.toggle('is-open', open); btn.setAttribute('aria-expanded', open); });
    toggle(drop.querySelector('.nav__tg'), drop);
    drop.querySelectorAll('.mega__tg').forEach((b) => toggle(b, b.closest('.mega__item')));
  })();

})();
