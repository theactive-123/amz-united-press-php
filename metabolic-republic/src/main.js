/* Metabolic Republic — main.js (vanilla, no dependencies) */
(function () {
  'use strict';

  /* ------------------------------------------------------------------
     Config: fill these in when the backend / partner URLs are ready.
     ------------------------------------------------------------------ */
  var FORM_ENDPOINT = '';   // e.g. 'https://formspree.io/f/xxxx' (POST, JSON). Empty = demo mode.
  var PROVIDER_URL = '#';   // OakTree Allied provider portal / website URL (placeholder).

  /* ------------------------------------------------------------------
     Single source of truth for classes. The Home carousel, the class
     library and the timetable all render from this object, so names and
     durations can never drift apart.
     ------------------------------------------------------------------ */
  var CLASSES = {
    'strength-foundations': {
      name: 'Strength Foundations', category: 'Strength', duration: '50 min', level: 'All levels', group: 'Up to 12',
      description: 'Slow, controlled strength work that builds muscle and confidence, coached step by step.',
      image: 'assets/img/pillar-strength.jpg', alt: 'A coach guiding a member through a strength exercise',
      home: { image: 'assets/img/class-strength-foundations.jpg', alt: 'A member training with dumbbells', category: 'Strength' }
    },
    'strength-balance': {
      name: 'Strength & Balance', category: 'Strength', duration: '50 min', level: 'All levels', group: 'Up to 10',
      description: 'Single-leg work, carries and stability training for strength that carries into everyday life.',
      image: 'assets/img/class-strength-balance.jpg', alt: 'A small group doing balance work'
    },
    'core-posture': {
      name: 'Core & Posture', category: 'Strength', duration: '40 min', level: 'All levels', group: 'Up to 12',
      description: 'Deep core control and posture work to ease tension and support your back.',
      image: 'assets/img/pillar-movement.jpg', imageClass: 'pos-69-8', alt: 'A coach guiding members through a forward fold'
    },
    'low-impact-cardio': {
      name: 'Low-impact Cardio', category: 'Movement', duration: '40 min', level: 'All levels', group: 'Up to 12',
      description: 'Steady intervals on bikes, rowers and treadmills that lift your energy without the pounding.',
      image: 'assets/img/class-low-impact-cardio.jpg', imageClass: 'pos-50-18', alt: 'A member on a bike by a window',
      home: { image: 'assets/img/class-low-impact-cardio.jpg', alt: 'A member on a cardio bike', category: 'Movement' }
    },
    'mobility-flow': {
      name: 'Mobility Flow', category: 'Movement', duration: '45 min', level: 'All levels', group: 'Up to 14',
      description: 'Flowing sequences that open the hips, spine and shoulders and leave you feeling looser.',
      image: 'assets/img/class-mobility-flow.jpg', imageClass: 'pos-62-49', alt: 'A member moving through a flowing stretch',
      home: { image: 'assets/img/class-mobility-flow.jpg', alt: 'A member lifting a kettlebell from the floor', category: 'Mobility' }
    },
    'breathwork': {
      name: 'Breathwork', category: 'Recovery', duration: '30 min', level: 'All levels', group: 'Up to 14',
      description: 'Guided breathing and meditation to settle your nervous system and support better sleep.',
      image: 'assets/img/pillar-recovery.jpg', alt: 'A member breathing calmly with eyes closed',
      home: { image: 'assets/img/class-breathwork.jpg', alt: 'A member using massage balls on a mat', category: 'Recovery' }
    },
    'restore': {
      name: 'Restore', category: 'Recovery', duration: '45 min', level: 'All levels', group: 'Up to 10',
      description: 'Stretching, soft-tissue work and stillness to help you recover between sessions.',
      image: 'assets/img/class-breathwork.jpg', alt: 'A member resting with massage balls on a mat',
      home: { image: 'assets/img/class-restore.jpg', alt: 'A member resting on a mat', category: 'Recovery' }
    },
    'personal-coaching': {
      name: 'Personal coaching', category: 'One-on-one', duration: '60 min', level: 'Any level', group: 'Just you',
      description: 'Private sessions with a plan built entirely around you, plus check-ins between visits.',
      image: 'assets/img/about-gallery-2.jpg', alt: 'An instructor assisting a member on a reformer'
    }
  };

  // Order of the Home "Sessions for Every Pace" carousel (as in Figma).
  var HOME_CLASSES = ['strength-foundations', 'mobility-flow', 'breathwork', 'low-impact-cardio', 'restore'];

  // Launch-week timetable (null = no class).
  var DAYS = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
  var DAY_NAMES = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
  var TIMETABLE = [
    { time: '6:00 am',  slots: ['strength-foundations', 'low-impact-cardio', 'strength-foundations', 'breathwork', 'strength-foundations', null, null] },
    { time: '7:15 am',  slots: ['low-impact-cardio', 'core-posture', 'mobility-flow', 'strength-balance', 'low-impact-cardio', 'strength-foundations', 'mobility-flow'] },
    { time: '12:15 pm', slots: ['mobility-flow', 'breathwork', 'low-impact-cardio', 'mobility-flow', 'core-posture', 'low-impact-cardio', 'restore'] },
    { time: '5:30 pm',  slots: ['strength-balance', 'strength-foundations', 'core-posture', 'low-impact-cardio', 'breathwork', 'mobility-flow', null] },
    { time: '6:45 pm',  slots: ['breathwork', 'restore', 'strength-foundations', 'restore', null, null, null] }
  ];

  var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  document.documentElement.classList.add('js');

  function $(sel, ctx) { return (ctx || document).querySelector(sel); }
  function $$(sel, ctx) { return Array.prototype.slice.call((ctx || document).querySelectorAll(sel)); }
  function esc(s) {
    return String(s).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }

  /* ------------------------------------------------------------------
     Renderers
     ------------------------------------------------------------------ */
  function renderHomeClasses(el) {
    el.innerHTML = HOME_CLASSES.map(function (key) {
      var c = CLASSES[key], h = c.home || {};
      return '<div class="class-card" role="listitem">' +
        '<div class="class-card_media">' +
          '<img src="' + (h.image || c.image) + '" width="340" height="425" alt="' + esc(h.alt || c.alt) + '" loading="lazy">' +
          '<span class="tag">' + esc(c.duration) + '</span>' +
        '</div>' +
        '<div><h3 class="class-card_title">' + esc(c.name) + '</h3>' +
        '<p class="class-card_cat">' + esc(h.category || c.category) + '</p></div>' +
      '</div>';
    }).join('');
  }

  function renderClassList(el, filter) {
    var keys = Object.keys(CLASSES).filter(function (k) {
      return !filter || filter === 'all' || CLASSES[k].category === filter;
    });
    el.innerHTML = keys.map(function (key) {
      var c = CLASSES[key];
      return '<li class="class-row" id="class-' + key + '">' +
        '<div class="class-row_media"><img' + (c.imageClass ? ' class="' + c.imageClass + '"' : '') + ' src="' + c.image + '" width="240" height="170" alt="' + esc(c.alt) + '" loading="lazy"></div>' +
        '<div><p class="class-row_cat">' + esc(c.category) + '</p><h3 class="class-row_name">' + esc(c.name) + '</h3></div>' +
        '<p class="class-row_desc">' + esc(c.description) + '</p>' +
        '<dl class="class-row_meta">' +
          '<div><dt>Length</dt><dd>' + esc(c.duration) + '</dd></div>' +
          '<div><dt>Level</dt><dd>' + esc(c.level) + '</dd></div>' +
          '<div><dt>Group</dt><dd>' + esc(c.group) + '</dd></div>' +
        '</dl>' +
      '</li>';
    }).join('');
  }

  function slotHtml(key) {
    if (!key) return '<span class="tt-empty" aria-label="No class">—</span>';
    var c = CLASSES[key];
    return '<span class="tt-class"><span class="tt-class_name">' + esc(c.name) + '</span><span class="tt-class_dur">' + esc(c.duration) + '</span></span>';
  }

  function renderTimetable(el) {
    var head = '<tr><th scope="col">Time</th>' + DAYS.map(function (d, i) {
      return '<th scope="col"><abbr title="' + DAY_NAMES[i] + '">' + d + '</abbr></th>';
    }).join('') + '</tr>';
    var body = TIMETABLE.map(function (row) {
      return '<tr><th scope="row">' + row.time + '</th>' + row.slots.map(function (k) {
        return '<td>' + slotHtml(k) + '</td>';
      }).join('') + '</tr>';
    }).join('');
    var table = '<div class="tt-desktop"><table class="tt-table"><caption class="visually-hidden">Weekly timetable, launch week</caption><thead>' + head + '</thead><tbody>' + body + '</tbody></table></div>';

    var tabs = '<div class="tabs tt-tabs" role="tablist" aria-label="Choose a day">' + DAYS.map(function (d, i) {
      return '<button class="tabs_tab" type="button" role="tab" id="tt-tab-' + i + '" aria-controls="tt-panel" aria-selected="' + (i === 0) + '" tabindex="' + (i === 0 ? 0 : -1) + '" data-day="' + i + '">' + d + '</button>';
    }).join('') + '</div>';
    var mobile = '<div class="tt-mobile">' + tabs + '<div id="tt-panel" role="tabpanel" aria-labelledby="tt-tab-0"></div></div>';
    el.innerHTML = table + mobile;

    var panel = $('#tt-panel', el);
    function showDay(i) {
      var items = TIMETABLE.filter(function (r) { return r.slots[i]; });
      panel.setAttribute('aria-labelledby', 'tt-tab-' + i);
      panel.innerHTML = '<h3 class="visually-hidden">' + DAY_NAMES[i] + '</h3>' + (items.length ? '<ul class="tt-day-list">' + items.map(function (r) {
        return '<li><span class="tt-time">' + r.time + '</span>' + slotHtml(r.slots[i]) + '</li>';
      }).join('') + '</ul>' : '<p>No classes.</p>');
    }
    setupTabs($('.tt-tabs', el), function (btn) { showDay(+btn.getAttribute('data-day')); });
    showDay(0);
  }

  // Accessible tablist: click + arrow keys.
  function setupTabs(list, onSelect) {
    if (!list) return;
    var tabs = $$('[role="tab"]', list);
    function select(btn, focus) {
      tabs.forEach(function (t) {
        var on = t === btn;
        t.setAttribute('aria-selected', on);
        t.setAttribute('tabindex', on ? 0 : -1);
      });
      if (focus) btn.focus();
      onSelect(btn);
    }
    tabs.forEach(function (t, i) {
      t.addEventListener('click', function () { select(t); });
      t.addEventListener('keydown', function (e) {
        var n = null;
        if (e.key === 'ArrowRight') n = tabs[(i + 1) % tabs.length];
        if (e.key === 'ArrowLeft') n = tabs[(i - 1 + tabs.length) % tabs.length];
        if (e.key === 'Home') n = tabs[0];
        if (e.key === 'End') n = tabs[tabs.length - 1];
        if (n) { e.preventDefault(); select(n, true); }
      });
    });
  }

  /* ------------------------------------------------------------------
     Router (all pages live in this one file; #/route switches pages)
     ------------------------------------------------------------------ */
  var pages = $$('.page');
  var nav = $('#nav');
  var metaDesc = $('meta[name="description"]');
  var metaRobots = $('#meta-robots');
  var ogTitle = $('#og-title');
  var ogDesc = $('#og-description');
  var ROUTE_ALIASES = { '/index': '/', '/index.html': '/', '/membership-a': '/membership' };

  function currentRoute() {
    var h = location.hash || '#/';
    if (h.indexOf('#/') !== 0) return null; // in-page anchor, not a route
    var r = h.slice(1).replace(/\.html$/, '').split('?')[0] || '/';
    if (r.length > 1 && r.charAt(r.length - 1) === '/') r = r.slice(0, -1);
    return ROUTE_ALIASES[r] || r;
  }

  function showRoute(initial) {
    var route = currentRoute();
    var anchor = location.hash && location.hash.indexOf('#/') !== 0 ? document.getElementById(location.hash.slice(1)) : null;
    function scrollToAnchor() {
      if (!anchor) return;
      anchor.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'center' });
      if (anchor.focus) anchor.focus({ preventScroll: true });
    }
    // In-page anchor (e.g. #footer-email) while a page is already showing: just scroll.
    if (route === null && !initial) { scrollToAnchor(); return; }
    if (route === null) route = '/';
    // Separate-page build: one .page per file, so always show it.
    var page = pages.length === 1 ? pages[0] :
               pages.filter(function (p) { return p.getAttribute('data-route') === route; })[0] ||
               pages.filter(function (p) { return p.getAttribute('data-route') === '/'; })[0];
    pages.forEach(function (p) { p.hidden = p !== page; });

    document.title = page.getAttribute('data-title');
    metaDesc.setAttribute('content', page.getAttribute('data-description'));
    ogTitle.setAttribute('content', page.getAttribute('data-title'));
    ogDesc.setAttribute('content', page.getAttribute('data-description'));
    metaRobots.setAttribute('content', page.hasAttribute('data-noindex') ? 'noindex, nofollow' : 'index, follow');
    document.body.classList.toggle('is-bare', page.hasAttribute('data-bare'));
    document.body.classList.toggle('footer-flat', page.getAttribute('data-footer') === 'flat');

    $$('.nav_link, .menu_link').forEach(function (a) {
      var r = page.getAttribute('data-route');
      var href = a.getAttribute('href');
      if (href === '#' + r || href === (r === '/' ? 'index.html' : r.slice(1) + '.html')) a.setAttribute('aria-current', 'page');
      else a.removeAttribute('aria-current');
    });

    closeMenu(true);
    window.scrollTo(0, 0);
    onScroll();
    observeReveals(page);
    if (anchor) { scrollToAnchor(); return; }
    if (!initial) {
      var h1 = $('h1', page);
      if (h1) { h1.setAttribute('tabindex', '-1'); h1.focus({ preventScroll: true }); }
    }
  }

  /* ------------------------------------------------------------------
     Nav: solid after 80px, mobile menu with focus trap
     ------------------------------------------------------------------ */
  function onScroll() { nav.classList.toggle('is-scrolled', window.scrollY > 80); }
  window.addEventListener('scroll', onScroll, { passive: true });

  var menu = $('#menu');
  var toggle = $('.nav_toggle');
  var lastFocus = null;

  function openMenu() {
    lastFocus = document.activeElement;
    menu.hidden = false;
    // next frame so the fade-in transition runs
    requestAnimationFrame(function () { menu.classList.add('is-open'); });
    toggle.setAttribute('aria-expanded', 'true');
    document.body.classList.add('menu-open');
    $('.menu_close', menu).focus();
  }
  function closeMenu(silent) {
    if (menu.hidden) return;
    menu.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('menu-open');
    menu.hidden = true;
    if (!silent && lastFocus) lastFocus.focus();
  }
  toggle.addEventListener('click', openMenu);
  $('.menu_close', menu).addEventListener('click', function () { closeMenu(); });
  $$('a', menu).forEach(function (a) { a.addEventListener('click', function () { closeMenu(true); }); });
  document.addEventListener('keydown', function (e) {
    if (menu.hidden) return;
    if (e.key === 'Escape') { closeMenu(); return; }
    if (e.key === 'Tab') {
      var f = $$('a, button', menu);
      var first = f[0], last = f[f.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    }
  });
  window.addEventListener('resize', function () { if (window.innerWidth > 991) closeMenu(true); });

  /* ------------------------------------------------------------------
     Reveal on scroll
     ------------------------------------------------------------------ */
  var io = null;
  if (!reduceMotion && 'IntersectionObserver' in window) {
    io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add('is-visible'); io.unobserve(en.target); }
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
  }
  function observeReveals(scope) {
    $$('.reveal', scope).forEach(function (el) {
      if (io) io.observe(el); else el.classList.add('is-visible');
    });
  }
  observeReveals($('#footer'));

  /* ------------------------------------------------------------------
     Carousel (Home classes)
     ------------------------------------------------------------------ */
  function setupCarousel(section) {
    var track = $('[data-carousel]', section);
    var prev = $('[data-carousel-prev]', section);
    var next = $('[data-carousel-next]', section);
    if (!track) return;
    function step() { var c = $('.class-card', track); return c ? c.getBoundingClientRect().width + 20 : 360; }
    function update() {
      prev.disabled = track.scrollLeft <= 2;
      next.disabled = track.scrollLeft + track.clientWidth >= track.scrollWidth - 2;
    }
    prev.addEventListener('click', function () { track.scrollBy({ left: -step(), behavior: reduceMotion ? 'auto' : 'smooth' }); });
    next.addEventListener('click', function () { track.scrollBy({ left: step(), behavior: reduceMotion ? 'auto' : 'smooth' }); });
    track.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();
  }

  /* ------------------------------------------------------------------
     FAQ accordion
     ------------------------------------------------------------------ */
  $$('.faq_button').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var open = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', String(!open));
      document.getElementById(btn.getAttribute('aria-controls')).hidden = open;
    });
  });

  /* ------------------------------------------------------------------
     Membership billing toggle (Figma shows monthly prices only;
     annual prices are a placeholder until the client supplies them)
     ------------------------------------------------------------------ */
  $$('.billing-toggle_btn').forEach(function (btn, _, all) {
    btn.addEventListener('click', function () {
      var annual = btn.getAttribute('data-billing') === 'annual';
      all.forEach(function (b) { b.setAttribute('aria-pressed', String(b === btn)); });
      $$('.plan').forEach(function (plan) {
        var amount = $('.plan_amount', plan), period = $('.plan_period', plan), note = $('.plan_note', plan);
        var annualPrice = amount.getAttribute('data-annual');
        if (annual) {
          amount.textContent = annualPrice || amount.getAttribute('data-monthly');
          period.textContent = annualPrice ? 'a year' : 'a month';
          note.textContent = annualPrice ? 'Billed annually, no enrolment fee' : 'Annual price to be confirmed';
        } else {
          amount.textContent = amount.getAttribute('data-monthly');
          period.textContent = 'a month';
          note.textContent = note.getAttribute('data-monthly');
        }
      });
    });
  });

  /* ------------------------------------------------------------------
     Forms: inline validation, honeypot, success state
     ------------------------------------------------------------------ */
  var EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
  var PHONE_RE = /^[+()\-.\s\d]{7,}$/;
  var SUCCESS = {
    'waitlist': ['You’re on the list.', 'We’ll email you first with location, hours and opening date.'],
    'footer-waitlist': ['You’re on the list.', 'Opening news and founding member offers are on their way.'],
    'contact-waitlist': ['You’re on the list.', 'We’ll let you know before opening day.'],
    'contact': ['Thank you, your message is on its way.', 'We’ll reply within one business day.'],
    'callback': ['Thank you. We’ll be in touch.', 'A member of our team will call you within 24 hours.'],
    'interview': ['Thank you. Your request is in.', 'We’ll confirm your interview time shortly.'],
    'provider-login': ['The provider portal is coming soon.', 'Sign-in is not available yet.']
  };

  function fieldMessage(input) {
    var v = input.value.trim();
    var label = input.labels && input.labels[0] ? input.labels[0].textContent.replace(/\s*\(optional\)/i, '') : 'This field';
    if (input.required && !v) {
      if (input.tagName === 'SELECT') return 'Please choose an option.';
      return 'Please enter your ' + label.toLowerCase() + '.';
    }
    if (v && input.type === 'email' && !EMAIL_RE.test(v)) return 'Please enter a valid email address, like you@example.com.';
    if (v && input.type === 'tel' && !PHONE_RE.test(v)) return 'Please enter a valid phone number.';
    return '';
  }

  function setError(input, msg) {
    var field = input.closest('.field');
    if (!field) return;
    var out = $('.field_error', field);
    field.classList.toggle('has-error', !!msg);
    input.setAttribute('aria-invalid', msg ? 'true' : 'false');
    if (out) {
      if (!out.id) out.id = input.id + '-error';
      out.textContent = msg;
      if (msg) input.setAttribute('aria-describedby', out.id); else input.removeAttribute('aria-describedby');
    }
  }

  function showSuccess(form, key) {
    var msg = SUCCESS[key] || ['Thank you.', ''];
    var box = document.createElement('div');
    box.className = 'form-success';
    box.setAttribute('role', 'status');
    box.setAttribute('tabindex', '-1');
    box.innerHTML = '<p class="form-success_title">' + esc(msg[0]) + '</p>' + (msg[1] ? '<p>' + esc(msg[1]) + '</p>' : '');
    form.replaceWith(box);
    box.focus({ preventScroll: true });
  }

  $$('.js-form').forEach(function (form) {
    var inputs = $$('input:not([type="hidden"]):not([type="checkbox"]), select, textarea', form).filter(function (i) { return !i.closest('.hp-field'); });
    inputs.forEach(function (input) {
      input.addEventListener('blur', function () { if (input.value) setError(input, fieldMessage(input)); });
      input.addEventListener('input', function () { if (input.getAttribute('aria-invalid') === 'true') setError(input, fieldMessage(input)); });
      input.addEventListener('change', function () { if (input.getAttribute('aria-invalid') === 'true') setError(input, fieldMessage(input)); });
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var firstBad = null;
      inputs.forEach(function (input) {
        var msg = fieldMessage(input);
        setError(input, msg);
        if (msg && !firstBad) firstBad = input;
      });
      if (firstBad) { firstBad.focus(); return; }

      var key = form.getAttribute('data-form');
      var data = {};
      new FormData(form).forEach(function (v, k) { data[k] = v; });
      var honeypot = data.company;
      delete data.company;
      if (honeypot) { showSuccess(form, key); return; } // bot: pretend success, send nothing

      if (key === 'provider-login') { showSuccess(form, key); return; } // placeholder portal

      data.form = key;
      data.page = location.hash || '#/';
      if (!FORM_ENDPOINT) {
        console.log('[Metabolic Republic] form submission (demo mode, FORM_ENDPOINT is empty):', data);
        showSuccess(form, key);
        return;
      }
      var btn = $('button[type="submit"]', form);
      if (btn) btn.disabled = true;
      fetch(FORM_ENDPOINT, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(data)
      }).then(function (res) {
        if (!res.ok) throw new Error('HTTP ' + res.status);
        showSuccess(form, key);
      }).catch(function () {
        if (btn) btn.disabled = false;
        var last = inputs[inputs.length - 1];
        setError(last, 'Sorry, something went wrong. Please try again or email membership@metabolicrepublic.com.');
      });
    });
  });

  /* ------------------------------------------------------------------
     Provider redirect: no auto-redirect yet, button uses PROVIDER_URL
     ------------------------------------------------------------------ */
  $$('[data-provider-link]').forEach(function (a) { a.setAttribute('href', PROVIDER_URL); });
  $$('[data-go-back]').forEach(function (a) {
    a.addEventListener('click', function (e) {
      if (history.length > 1) { e.preventDefault(); history.back(); }
    });
  });

  /* ------------------------------------------------------------------
     Init
     ------------------------------------------------------------------ */
  $$('[data-render="home-classes"]').forEach(renderHomeClasses);
  $$('[data-render="class-list"]').forEach(function (el) {
    renderClassList(el, 'all');
    var tablist = $('.tabs', el.parentNode);
    setupTabs(tablist, function (btn) { renderClassList(el, btn.getAttribute('data-filter')); });
  });
  $$('[data-render="timetable"]').forEach(renderTimetable);
  $$('.classes-strip').forEach(setupCarousel);

  window.addEventListener('hashchange', function () { showRoute(false); });
  showRoute(true);
})();
