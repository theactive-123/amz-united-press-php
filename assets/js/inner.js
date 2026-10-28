/* AMZ United Press — inner-page interactions (service and resource pages, landing pages).
   Progressive enhancement only: every heading, paragraph and form field is in the HTML before this runs,
   and the page works without it. Respects prefers-reduced-motion. No external libraries. */
(function () {
  'use strict';
  var RM = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;
  var FINE = window.matchMedia && matchMedia('(hover: hover) and (pointer: fine)').matches;
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
  document.documentElement.classList.add('ix-js');

  /* ---- 1. scroll reveals (staggered with --d) ---- */
  var rv = $$('.ix-rv');
  if (RM || !('IntersectionObserver' in window)) rv.forEach(function (e) { e.classList.add('in'); });
  else {
    var io = new IntersectionObserver(function (es) { es.forEach(function (x) { if (x.isIntersecting) { x.target.classList.add('in'); io.unobserve(x.target); } }); }, { threshold: .12, rootMargin: '0px 0px -8% 0px' });
    rv.forEach(function (e) { io.observe(e); });
  }

  /* ---- 2. count-up milestones (final value is already in the HTML) ---- */
  var nums = $$('[data-count]');
  if (!RM && 'IntersectionObserver' in window) {
    var cio = new IntersectionObserver(function (es) {
      es.forEach(function (x) {
        if (!x.isIntersecting) return; cio.unobserve(x.target);
        var el = x.target, end = +el.getAttribute('data-count'), t0 = null, dur = 1400;
        (function tick(t) { if (!t0) t0 = t; var p = Math.min(1, (t - t0) / dur), v = Math.round(end * (1 - Math.pow(1 - p, 3))); el.textContent = v; if (p < 1) requestAnimationFrame(tick); })(performance.now());
      });
    }, { threshold: .5 });
    nums.forEach(function (n) { n.textContent = '0'; cio.observe(n); });
  }

  /* ---- 3. multi-step lead form (same fields, same endpoint, same validation) ---- */
  $$('[data-steps]').forEach(function (wrap) {
    var form = $('form', wrap); if (!form) return;
    var f = function (n) { return $('[data-f="' + n + '"]', form); };
    var help = f('help'), project = f('project'), name = f('name'), email = f('email'), submit = $('button[type=submit]', form), fine = $('.form-fine', form);
    if (!help || !project || !name || !email || !submit) return;
    var names = ['Your project', 'Your book', 'Your details'];
    var head = document.createElement('div'); head.className = 'ix-steps-head';
    head.innerHTML = '<ol>' + names.map(function (n, i) { return '<li' + (i ? '' : ' class="on"') + '><i>' + (i + 1) + '</i><span>' + n + '</span></li>'; }).join('') + '</ol><div class="ix-steps-bar"><i></i></div><p class="ix-steps-count" aria-live="polite">Step 1 of 3</p>';
    var steps = [0, 1, 2].map(function (i) { var d = document.createElement('div'); d.className = 'ix-step-pane' + (i ? '' : ' on'); d.setAttribute('data-pane', i); return d; });

    // step 1: option chips mirror the select (the select stays in the form and is what gets submitted)
    var sel = $('select', help), chips = document.createElement('div');
    chips.className = 'ix-chips-opt'; chips.setAttribute('role', 'radiogroup'); chips.setAttribute('aria-label', $('label', help).textContent.replace('*', '').replace('(required)', '').trim());
    Array.prototype.forEach.call(sel.options, function (o) {
      if (o.disabled) return;
      var b = document.createElement('button'); b.type = 'button'; b.setAttribute('role', 'radio'); b.setAttribute('aria-checked', o.selected && sel.selectedIndex > 0 ? 'true' : 'false'); b.textContent = o.textContent;
      b.addEventListener('click', function () { sel.value = o.value || o.textContent; sel.dispatchEvent(new Event('change', { bubbles: true })); sync(); });
      chips.appendChild(b);
    });
    function sync() { $$('button', chips).forEach(function (b) { b.setAttribute('aria-checked', b.textContent === sel.options[sel.selectedIndex].textContent && sel.selectedIndex > 0 ? 'true' : 'false'); }); }
    sel.addEventListener('change', sync);
    help.classList.add('ix-help-field'); help.insertBefore(chips, sel);
    steps[0].appendChild(help);

    // step 2: where the book is today (adds one line to the project text, so nothing new reaches the server)
    var stage = document.createElement('div'); stage.className = 'ix-stage';
    stage.innerHTML = '<p class="ix-stage-q">Where is your book today?</p><div class="ix-chips-opt" role="radiogroup" aria-label="Where is your book today?">' + ['Just an idea', 'Notes or a partial draft', 'Finished manuscript', 'Already published'].map(function (s) { return '<button type="button" role="radio" aria-checked="false">' + s + '</button>'; }).join('') + '</div>';
    var ta = $('textarea', project);
    $$('button', stage).forEach(function (b) {
      b.addEventListener('click', function () {
        $$('button', stage).forEach(function (x) { x.setAttribute('aria-checked', x === b ? 'true' : 'false'); });
        var line = 'Where my book is: ' + b.textContent;
        ta.value = /^Where my book is: .*$/m.test(ta.value) ? ta.value.replace(/^Where my book is: .*$/m, line) : (line + (ta.value ? '\n' + ta.value : ''));
        project.classList.toggle('filled', !!ta.value.trim());
      });
    });
    steps[1].appendChild(stage); steps[1].appendChild(project);

    // step 3: contact details + the original submit button
    steps[2].appendChild(name); steps[2].appendChild(email);

    var nav = document.createElement('div'); nav.className = 'ix-steps-nav';
    var back = document.createElement('button'); back.type = 'button'; back.className = 'ix-btn ix-btn-back'; back.textContent = 'Back';
    var next = document.createElement('button'); next.type = 'button'; next.className = 'ix-btn ix-btn-primary ix-btn-next'; next.innerHTML = 'Continue <svg class="ix-ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>';
    nav.appendChild(back); nav.appendChild(next); nav.appendChild(submit);

    var banner = $('[data-banner]', form);
    var anchor = banner ? banner.nextSibling : form.firstChild;
    form.insertBefore(head, anchor);
    steps.forEach(function (s) { form.insertBefore(s, fine || null); });
    form.insertBefore(nav, fine || null);
    wrap.classList.add('ix-msf-on');

    var cur = 0;
    function go(i, focus) {
      cur = Math.max(0, Math.min(2, i));
      steps.forEach(function (s, k) { s.classList.toggle('on', k === cur); s.hidden = k !== cur; });
      $$('li', head).forEach(function (li, k) { li.classList.toggle('on', k <= cur); li.classList.toggle('now', k === cur); });
      $('.ix-steps-bar i', head).style.width = ((cur + 1) / 3 * 100) + '%';
      $('.ix-steps-count', head).textContent = 'Step ' + (cur + 1) + ' of 3';
      back.hidden = cur === 0; next.hidden = cur === 2; submit.hidden = cur !== 2;
      if (focus) { var t = $('.ix-step-pane.on input, .ix-step-pane.on button, .ix-step-pane.on textarea', form); if (t) t.focus({ preventScroll: true }); }
    }
    steps.forEach(function (s, k) { s.hidden = k !== 0; });
    next.addEventListener('click', function () {
      if (cur === 0 && window.validateField && !validateField(form, 'help')) { var b = $('button', chips); if (b) b.focus(); return; }
      go(cur + 1, true);
    });
    back.addEventListener('click', function () { go(cur - 1, true); });
    // if the server or validation focuses a field in another step, show that step
    form.addEventListener('focusin', function (e) { var p = e.target.closest('[data-pane]'); if (p && +p.getAttribute('data-pane') !== cur) go(+p.getAttribute('data-pane')); });
    form.addEventListener('keydown', function (e) { if (e.key === 'Enter' && cur < 2 && e.target.tagName !== 'TEXTAREA') { e.preventDefault(); next.click(); } });
    go(0);
  });

  /* ---- 4. scroll-driven process timeline ---- */
  $$('.ix-proc').forEach(function (proc) {
    var items = $$('.ix-pstep', proc), list = $('.ix-proc-list', proc), num = $('[data-proc-num]', proc), ttl = $('[data-proc-title]', proc), ring = $('[data-proc-ring]', proc);
    if (!items.length) return;
    function setActive(i) {
      items.forEach(function (it, k) { it.classList.toggle('on', k === i); it.classList.toggle('done', k < i); });
      if (num) num.textContent = String(i + 1).padStart(2, '0');
      if (ttl) ttl.textContent = items[i].getAttribute('data-title');
      if (ring) ring.style.strokeDashoffset = String(100 - ((i + 1) / items.length) * 100);
    }
    setActive(0);
    if (!('IntersectionObserver' in window)) return;
    var pio = new IntersectionObserver(function (es) { es.forEach(function (x) { if (x.isIntersecting) setActive(items.indexOf(x.target)); }); }, { rootMargin: '-45% 0px -45% 0px' });
    items.forEach(function (it) { pio.observe(it); });
    // the connecting line fills as you scroll through the list
    var ticking = false;
    function fill() { ticking = false; var r = list.getBoundingClientRect(), vh = innerHeight; var p = Math.max(0, Math.min(1, (vh * .55 - r.top) / r.height)); list.style.setProperty('--p', p.toFixed(3)); }
    addEventListener('scroll', function () { if (!ticking) { ticking = true; requestAnimationFrame(fill); } }, { passive: true }); fill();
  });

  /* ---- 5. smooth FAQ accordions (native <details>, animated height) ---- */
  if (!RM) $$('[data-ix-faq] details').forEach(function (d) {
    var s = $('summary', d), a = $('.ans', d); if (!s || !a) return;
    s.addEventListener('click', function (e) {
      e.preventDefault();
      if (d.open) {
        a.style.height = a.scrollHeight + 'px'; requestAnimationFrame(function () { a.style.height = '0px'; });
        d.classList.remove('is-open');
        setTimeout(function () { d.open = false; a.style.height = ''; }, 280);
      } else {
        d.open = true; d.classList.add('is-open'); var h = a.scrollHeight; a.style.height = '0px';
        requestAnimationFrame(function () { a.style.height = h + 'px'; });
        setTimeout(function () { a.style.height = ''; }, 300);
      }
    });
    if (d.open) d.classList.add('is-open');
  });
  else $$('[data-ix-faq] details[open]').forEach(function (d) { d.classList.add('is-open'); });

  /* ---- 6. cursor spotlight on cards (desktop pointers only) ---- */
  if (FINE && !RM) $$('.ix-spot').forEach(function (c) {
    var raf = 0, ev;
    c.addEventListener('pointermove', function (e) { ev = e; if (raf) return; raf = requestAnimationFrame(function () { raf = 0; var r = c.getBoundingClientRect(); c.style.setProperty('--mx', (ev.clientX - r.left) + 'px'); c.style.setProperty('--my', (ev.clientY - r.top) + 'px'); }); });
  });

  /* ---- 7. journey rail: stages light up in turn while visible ---- */
  $$('.ix-journey').forEach(function (j) {
    var li = $$('li', j), i = 0, timer = null; if (RM || !li.length) return;
    function step() { li.forEach(function (x, k) { x.classList.toggle('on', k <= i); x.classList.toggle('now', k === i); }); i = (i + 1) % li.length; }
    var jio = new IntersectionObserver(function (es) { es.forEach(function (x) { if (x.isIntersecting && !timer) timer = setInterval(step, 1500); else if (!x.isIntersecting && timer) { clearInterval(timer); timer = null; } }); });
    jio.observe(j);
  });

  /* ---- 8. subtle parallax on decorative layers (desktop only) ---- */
  if (!RM && FINE) {
    var par = $$('[data-par]'), pt = false;
    function pf() { pt = false; par.forEach(function (el) { var r = el.parentElement.getBoundingClientRect(); var k = +el.getAttribute('data-par'); el.style.transform = 'translate3d(0,' + ((r.top + r.height / 2 - innerHeight / 2) * k).toFixed(1) + 'px,0)'; }); }
    if (par.length) { addEventListener('scroll', function () { if (!pt) { pt = true; requestAnimationFrame(pf); } }, { passive: true }); pf(); }
  }

  /* ---- 9. in-page "start your quote" buttons focus the hero form ---- */
  document.addEventListener('click', function (e) {
    var a = e.target.closest('[data-ix-goto]'); if (!a) return;
    var t = document.querySelector(a.getAttribute('data-ix-goto')); if (!t) return;
    e.preventDefault(); t.scrollIntoView({ behavior: RM ? 'auto' : 'smooth', block: 'center' });
    setTimeout(function () { var b = t.querySelector('.ix-chips-opt button, input'); if (b) b.focus({ preventScroll: true }); }, 500);
  });

  /* ---- 10. reading progress bar ---- */
  var bar = $('.ix-progress i');
  if (bar) { var bt = false; addEventListener('scroll', function () { if (bt) return; bt = true; requestAnimationFrame(function () { bt = false; var h = document.documentElement; bar.style.transform = 'scaleX(' + (h.scrollTop / Math.max(1, h.scrollHeight - h.clientHeight)).toFixed(4) + ')'; }); }, { passive: true }); }
})();
