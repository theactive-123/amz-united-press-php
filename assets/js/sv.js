/* AMZ United Press — service page interactions (progressive: all content is in the HTML). */
(function () {
  'use strict';
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
  var RM = matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* Switches: segmented buttons + panes, with optional autoplay while visible. */
  $$('[data-sv-sw]').forEach(function (sw) {
    var btns = $$('[data-k]', sw), panes = $$('[data-pane]', sw), cur = 0, timer = null, stopped = false;
    var auto = +sw.getAttribute('data-auto') || 0;
    function show(i) {
      cur = i;
      btns.forEach(function (b, j) { b.classList.toggle('on', j === i); b.setAttribute('aria-pressed', j === i ? 'true' : 'false'); });
      panes.forEach(function (p, j) { p.classList.toggle('on', j === i); });
    }
    btns.forEach(function (b, i) { b.addEventListener('click', function () { stopped = true; stop(); sw.classList.remove('auto'); show(i); }); });
    function tick() { show((cur + 1) % btns.length); }
    function start() { if (stopped || timer || RM || !auto) return; sw.classList.add('auto'); sw.style.setProperty('--dur', auto + 'ms'); show(cur); timer = setInterval(tick, auto); }
    function stop() { clearInterval(timer); timer = null; }
    if (auto && 'IntersectionObserver' in window) {
      new IntersectionObserver(function (es) { es.forEach(function (e) { e.isIntersecting ? start() : stop(); }); }, { threshold: .25 }).observe(sw.closest('section') || sw);
      sw.addEventListener('focusin', function () { stopped = true; stop(); sw.classList.remove('auto'); });
    }
  });

  /* Live bindings: inputs update matching [data-out] text; [data-len] shows length. */
  $$('[data-bind]').forEach(function (inp) {
    var k = inp.getAttribute('data-bind'), scope = inp.closest('[data-sv-bind],[data-sv-outline]') || document, def = inp.value;
    function upd() {
      var v = inp.value.trim() || def;
      $$('[data-out="' + k + '"]', scope).forEach(function (o, i) {
        o.textContent = (o.closest('li') ? v.charAt(0).toLowerCase() + v.slice(1) : v);
      });
      $$('[data-len="' + k + '"]', scope).forEach(function (o) { o.textContent = inp.value.length; o.parentNode.classList.toggle('over', inp.value.length > 60); });
    }
    inp.addEventListener('input', upd);
  });

  /* Proofreading game: tap errors to reveal the fix. */
  $$('[data-sv-spot]').forEach(function (box) {
    var errs = $$('.svx-err', box), n = $('[data-found]', box);
    function count() { n.textContent = errs.filter(function (e) { return e.classList.contains('found'); }).length; }
    errs.forEach(function (e) {
      function hit() { e.classList.add('found'); e.setAttribute('aria-label', 'Corrected to ' + e.getAttribute('data-fix')); count(); }
      e.addEventListener('click', hit);
      e.addEventListener('keydown', function (ev) { if (ev.key === 'Enter' || ev.key === ' ') { ev.preventDefault(); hit(); } });
    });
    var r = $('[data-reveal]', box);
    if (r) r.addEventListener('click', function () { errs.forEach(function (e) { e.classList.add('found'); }); count(); });
  });

  /* Horizontal step track: arrows + progress bar. */
  $$('[data-sv-track]').forEach(function (t) {
    var sec = t.closest('section'), bar = $('[data-sv-bar]', sec), prev = $('[data-sv-prev]', sec), next = $('[data-sv-next]', sec);
    function step() { var li = t.querySelector('li'); return li ? li.getBoundingClientRect().width + 18 : 300; }
    function upd() { var max = t.scrollWidth - t.clientWidth; if (bar) bar.style.width = (max > 0 ? Math.max(12, (t.scrollLeft / max) * 100) : 100) + '%'; }
    if (prev) prev.addEventListener('click', function () { t.scrollBy({ left: -step(), behavior: RM ? 'auto' : 'smooth' }); });
    if (next) next.addEventListener('click', function () { t.scrollBy({ left: step(), behavior: RM ? 'auto' : 'smooth' }); });
    t.addEventListener('scroll', upd, { passive: true }); addEventListener('resize', upd); upd();
  });
})();
