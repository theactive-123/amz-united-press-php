</main>

<?php if (!empty($meta['lp'])): ?>
<footer class="lpf">
  <div class="w">
    <div class="lpf-in">
      <a class="logo" href="<?= e(url('/')) ?>" aria-label="<?= e(site('name')) ?> — home"><img src="<?= e(asset('img/logo-light.png')) ?>" width="491" height="213" alt="<?= e(site('name')) ?>" loading="lazy"></a>
      <div class="lpf-contact">
        <a href="tel:<?= e(tel_href()) ?>" data-lp-call><?= ic('phone') ?><?= e(site('phone')) ?></a>
        <?= email_reveal('Email us') ?>
        <span><?= ic('clock') ?><?= e(site('hours')) ?></span>
      </div>
    </div>
    <div class="lpf-bottom"><span>© <?= date('Y') ?> <?= e(site('name')) ?>. All rights reserved.</span><span><a href="<?= e(url('/privacy')) ?>">Privacy Policy</a> &nbsp;·&nbsp; <a href="<?= e(url('/terms')) ?>">Terms &amp; Conditions</a></span></div>
  </div>
</footer>
<?php else: ?>
<footer class="site-footer">
  <div class="wrap">
    <div class="foot-grid foot-grid-x">
      <div>
        <a class="foot-logo" href="<?= e(url('/')) ?>" aria-label="<?= e(site('name')) ?> — home"><img src="<?= e(asset('img/logo-light.png')) ?>" width="491" height="213" alt="<?= e(site('name')) ?>" loading="lazy"></a>
        <p style="margin-top:24px;max-width:24em">Ghostwriting, ebook writing, editing, publishing and book marketing services for authors and businesses. You keep 100% of your rights and royalties.</p>
        <ul class="foot-contact">
          <li><a href="tel:<?= e(tel_href()) ?>"><?= ic('phone') ?><?= e(site('phone')) ?></a></li>
          <li><?= email_reveal() ?></li>
          <li><?= ic('clock') ?><?= e(site('hours')) ?></li>
          <li><?= ic('pin') ?><?= e(site('address')) ?></li>
        </ul>
      </div>
      <?php foreach (data('cats') as $c): if ($c['k'] === 'edit') continue; ?>
      <div><h4><?= e($c['t']) ?></h4><ul>
        <?php foreach (subs_of($c['k']) as $s): ?><li><a href="<?= e(url('/services/' . $s['slug'])) ?>"><?= e($s['name']) ?></a></li><?php endforeach; ?>
        <?php if ($c['k'] === 'publish'): ?></ul><h4 class="foot-h-gap"><?= e(cat_by_key('edit')['t']) ?></h4><ul><?php foreach (subs_of('edit') as $s): ?><li><a href="<?= e(url('/services/' . $s['slug'])) ?>"><?= e($s['name']) ?></a></li><?php endforeach; ?><?php endif; ?>
      </ul></div>
      <?php endforeach; ?>
      <div><h4>Resources</h4><ul>
        <li><a href="<?= e(url('/portfolio')) ?>">Portfolio</a></li><li><a href="<?= e(url('/how-it-works')) ?>">How It Works</a></li><li><a href="<?= e(url('/faq')) ?>">FAQs</a></li><li><a href="<?= e(url('/pricing')) ?>">Pricing</a></li><li><a href="<?= e(url('/about')) ?>">About Us</a></li><li><a href="<?= e(url('/contact')) ?>">Contact Us</a></li><li><a href="<?= e(url('/services')) ?>">All Services</a></li>
      </ul></div>
    </div>
    <div class="foot-bottom"><span>© <span id="yr"><?= date('Y') ?></span> <?= e(site('name')) ?>. All rights reserved.</span><span><a href="<?= e(url('/privacy')) ?>">Privacy Policy</a> &nbsp;·&nbsp; <a href="<?= e(url('/terms')) ?>">Terms &amp; Conditions</a></span></div>
  </div>
</footer>
<?php endif; ?>

<div class="dock"><a class="btn btn-dark" href="tel:<?= e(tel_href()) ?>"<?= !empty($meta['lp']) ? ' data-lp-call' : '' ?>><svg class="ic" aria-hidden="true"><use href="#i-phone"/></svg>Call us</a><?php if (!empty($meta['lp'])): ?><a class="btn btn-primary" href="#lp-form" data-lp-cta>Free quote</a><?php else: ?><button type="button" class="btn btn-primary" data-quote>Free quote</button><?php endif; ?></div>

<!-- Pop-ups -->
<dialog id="workDialog" aria-labelledby="dlgTitle"><div class="modal-in" id="dlgBody"></div></dialog>
<dialog id="quoteDialog" aria-label="Request a free quote"><div class="qd"><button type="button" class="modal-close" data-qclose aria-label="Close"><svg class="ic" aria-hidden="true"><use href="#i-close"/></svg></button>
  <div data-form-host="quote"><?= render_form('quote', 'Request a free quote', 'Tell us about your book. We reply personally, with no obligation.', 'quote') ?></div>
</div></dialog>

<script>window.AMZ=<?= json_encode(['base' => rtrim((string)cfg('base_path', ''), '/'), 'work' => data('work'), 'genres' => data('genres'), 'svcset' => data('svcset')], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?>;</script>
<script src="<?= e(asset('js/covers.js')) ?>"></script>
<script src="<?= e(asset('js/main.js')) ?>"></script>
<script src="<?= e(asset('js/forms.js')) ?>"></script>
<?php if (!empty($meta['lp'])): ?><script src="<?= e(asset('js/lp.js')) ?>"></script><?php endif; ?>
</body>
</html>
