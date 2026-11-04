/* Blog article: active table-of-contents item and the cost calculator. */
(function () {
  var links = [].slice.call(document.querySelectorAll('[data-bp-toc]'));
  var heads = links.map(function (a) { return document.getElementById(a.getAttribute('href').slice(1)); }).filter(Boolean);
  function onScroll() {
    var cur = 0;
    heads.forEach(function (h, i) { if (h.getBoundingClientRect().top < 140) cur = i; });
    links.forEach(function (a, i) { a.classList.toggle('on', i === cur); });
  }
  addEventListener('scroll', onScroll, { passive: true }); onScroll();

  document.querySelectorAll('[data-bp-calc]').forEach(function (box) {
    var out = box.querySelector('[data-bp-total]'), be = box.querySelector('[data-bp-be]');
    function sum() {
      var t = 0;
      box.querySelectorAll('input:checked').forEach(function (i) { t += +i.value; });
      out.textContent = '$' + t.toLocaleString('en-US');
      var copies = Math.ceil(t / 4.99);
      be.textContent = 'Break-even: about ' + copies.toLocaleString('en-US') + ' paperback' + (copies === 1 ? '' : 's') + ' at $14.99 (≈ $4.99 royalty each)';
    }
    box.addEventListener('change', sum); sum();
  });
})();
