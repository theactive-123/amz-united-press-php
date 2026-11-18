/* Paid-ads landing pages: reveal on scroll, video pause/play, one FAQ open at a time, package buttons pre-fill the form. */
(function () {
  var els = document.querySelectorAll('.ad-rv');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (es) { es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } }); }, { rootMargin: '0px 0px -8% 0px' });
    els.forEach(function (e) { io.observe(e); });
  } else els.forEach(function (e) { e.classList.add('in'); });

  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  document.querySelectorAll('[data-ad-video]').forEach(function (box) {
    var v = box.querySelector('video'), b = box.querySelector('.ad-video-btn');
    var pause = '<svg class="ad-ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14M16 5v14"/></svg>';
    var play = '<svg class="ad-ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 4.5v15l12-7.5z"/></svg>';
    function sync() { var p = v.paused; b.innerHTML = p ? play : pause; b.setAttribute('aria-label', p ? 'Play video' : 'Pause video'); }
    if (reduce) { v.removeAttribute('autoplay'); v.pause(); }
    b.addEventListener('click', function () { if (v.paused) v.play(); else v.pause(); });
    v.addEventListener('play', sync); v.addEventListener('pause', sync); sync();
  });

  document.querySelectorAll('.ad-faq,.x-faq').forEach(function (box) {
    box.addEventListener('toggle', function (e) {
      if (!e.target.open) return;
      box.querySelectorAll('details[open]').forEach(function (d) { if (d !== e.target) d.open = false; });
    }, true);
  });

  document.querySelectorAll('[data-pkg]').forEach(function (b) {
    b.addEventListener('click', function () {
      var t = document.getElementById('lp-form-project');
      if (t && !t.value) t.value = 'Interested in: ' + b.getAttribute('data-pkg');
    });
  });
})();

/* VSL: first tap turns the sound on and restarts the video from the beginning, with controls. */
document.querySelectorAll('[data-vsl]').forEach(function (box) {
  var v = box.querySelector('video'), s = box.querySelector('[data-sound]');
  if (!v || !s) return;
  s.addEventListener('click', function () {
    v.muted = false; v.loop = false; v.currentTime = 0; v.controls = true;
    var p = v.play(); if (p && p.catch) p.catch(function () {});
    box.classList.add('sound-on');
    window.dataLayer = window.dataLayer || []; dataLayer.push({ event: 'vsl_sound_on', page: location.pathname });
  });
});

/* Count-up for big stats when they scroll into view. */
(function () {
  var els = document.querySelectorAll('[data-countup]');
  if (!els.length || !('IntersectionObserver' in window) || matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  var io = new IntersectionObserver(function (es) {
    es.forEach(function (e) {
      if (!e.isIntersecting) return; io.unobserve(e.target);
      var el = e.target, to = +el.getAttribute('data-countup'), t0 = null;
      function step(ts) { if (!t0) t0 = ts; var p = Math.min(1, (ts - t0) / 1400), v = Math.round(to * (1 - Math.pow(1 - p, 3)));
        el.textContent = v.toLocaleString('en-US') + '+'; if (p < 1) requestAnimationFrame(step); }
      requestAnimationFrame(step);
    });
  }, { threshold: .4 });
  els.forEach(function (el) { io.observe(el); });
})();
