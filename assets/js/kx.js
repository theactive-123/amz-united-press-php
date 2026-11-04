/* KDP campaign pages: reveal on scroll, one FAQ open at a time, package buttons pre-fill the form. */
(function () {
  var els = document.querySelectorAll('.kx-rv');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (es) { es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } }); }, { rootMargin: '0px 0px -8% 0px' });
    els.forEach(function (e) { io.observe(e); });
  } else els.forEach(function (e) { e.classList.add('in'); });

  document.querySelectorAll('.kx-faq').forEach(function (box) {
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
