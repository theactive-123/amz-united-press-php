<?php
require dirname(__DIR__) . '/includes/bootstrap.php';
require dirname(__DIR__) . '/includes/lp.php';

$mk = sub_by_slug('book-marketing-services');
$FAQ = [
    ['What is book marketing?', 'Book marketing is everything that helps the right readers discover, trust and buy your book: a strong Amazon listing, advertising, reviews, social media, email, press and an author brand readers can follow. Good marketing starts before launch day and keeps working long after it.'],
    ['How do you market a self-published book?', 'Start with the foundations: a professional cover, a description that sells and the right Amazon keywords and categories. Then build visibility through editorial reviews, targeted Amazon and social ads, a reader email list and outreach to bloggers, podcasts and media. Our book marketing services for self-published authors cover each of these steps.'],
    ['Can I hire someone to market my book?', 'Yes. When you hire a book marketer at AMZ United Press, a dedicated marketing team plans and runs your campaign while you approve the strategy, the budget and every piece of content that goes out in your name.'],
    ['How much do book marketing services cost?', 'Our book marketing services start from ' . $mk['price'] . '. The final price depends on the channels you choose, your timeline and any advertising budget, which you control and pay directly to the platform. You get a written plan and quote before anything starts.'],
    ['Do you guarantee sales or bestseller status?', 'No honest book promotion agency can guarantee sales or rankings, and we never will. What we do promise is a clear strategy, proven tactics, transparent reporting and a team that adjusts the campaign based on real results.'],
    ['How do you market a book launch?', 'We plan the launch six to eight weeks ahead: advance reader copies for early reviews, a pre-order or launch-week price strategy, an email and social countdown, media and blogger outreach, and Amazon ads timed to go live on launch day.'],
    ['Can I use your marketing if I published elsewhere?', 'Yes. You can hire us only for book marketing, whether your book was published by you, by us or by another company. We just need access to your listing and any accounts you want us to manage.'],
    ['How do books get popular?', 'Books grow through visibility and word of mouth: readers have to find the book, trust it enough to buy, and enjoy it enough to recommend it. Reviews, a compelling listing, consistent promotion and an author brand readers connect with all feed that cycle.'],
];
$meta = [
    'lp' => true,
    'title' => 'Book Marketing Services | Book Promotion Agency | AMZ United Press',
    'description' => 'Book marketing services for self-published authors: Amazon ads, editorial reviews, social media, email and PR. Hire a book marketer today. Free strategy call.',
    'path' => '/lp/book-marketing-services', 'nav' => '',
    'schema' => lp_schema('Book Marketing Services', 'Book marketing and book promotion services for self-published and independent authors: Amazon optimisation and ads, editorial reviews, social media, email marketing, media outreach and author branding.', '/lp/book-marketing-services', $FAQ, $mk['price']),
];
include dirname(__DIR__) . '/includes/header.php';
$goal = function ($t, $sub, $amt, $items, $feat, $btn, $txt = false) {
    return '<div class="tier' . ($feat ? ' feat' : '') . '">' . ($feat ? '<span class="tag">Most chosen</span>' : '') . '<h3 class="h3">' . e($t) . '</h3><p>' . e($sub) . '</p><span class="from">' . ($txt ? 'Quoted for' : 'From') . '</span><div class="amt' . ($txt ? ' txt-amt' : '') . '">' . e($amt) . '</div>'
         . lp_checks($items) . '<a class="btn ' . ($feat ? 'btn-primary' : 'btn-dark') . '" href="#lp-form" data-lp-cta>' . e($btn) . ' ' . ic('arrow') . '</a></div>';
};
?>
<div class="page" data-page="lp-marketing">

<?= lp_hero([
    'orange' => true,
    'eyebrow' => 'Book marketing services',
    'h1' => 'Book marketing that gets your book <em>noticed, and bought.</em>',
    'lead' => 'You wrote a great book. Now readers need to find it. Our book marketing experts build and run a promotion plan around your book and your budget: Amazon ads and listing optimisation, editorial reviews, social media, email and media outreach, with clear reports so you always see what’s working.',
    'cta' => 'Get a Free Marketing Plan',
    'ticks' => ['Free strategy call', 'You control the ad budget', 'No long contracts'],
    'extra' => lp_hero_faces('<b>Authors like these</b> trusted us to find readers for their books.'),
    'form' => ['Get your free marketing plan', 'Tell us about your book and your goals. We reply within one business day.', 4, 'Get My Free Plan'],
]) ?>

<?= lp_trust('We market books sold on') ?>

<?= lp_vs('bg-sand', 'Why marketing matters', 'Great books don’t <em>sell themselves.</em>', 'Millions of titles compete for attention on Amazon alone. Without a plan, even a brilliant book can sit unseen on page twenty of the search results. Professional book promotion puts it in front of the readers most likely to love it.',
    ['Without a marketing plan', ['Launch week comes and goes with a handful of sales', 'Too few reviews for new readers to take a chance', 'Ad spend wasted on the wrong keywords and audiences', 'No idea which efforts actually sell books']],
    ['With AMZ United Press', ['A launch plan that builds momentum before release day', 'Honest editorial reviews and advance reader outreach', 'Targeted campaigns, tracked and improved every week', 'Clear monthly reports on what is working']]) ?>

<section class="sec bg-ink" aria-labelledby="ch-h">
  <div class="w">
    <?= lp_head('What we do', 'Book promotion services across <em>every channel</em> that sells books.', 'Pick the channels that fit your genre and budget, or let our book marketers recommend the mix most likely to work for your readers.', false, 'ch-h') ?>
    <?= lp_cards([
        ['tag', 'Amazon optimisation', 'Keywords, categories, a description that converts and A+ content, so your listing ranks and persuades.'],
        ['publish', 'Amazon & BookBub ads', 'Targeted ad campaigns built around your genre’s readers, with daily budgets you set and control.'],
        ['check', 'Editorial reviews', 'Advance reader copies and outreach to genuine reviewers and bloggers. We never buy ratings.'],
        ['users', 'Social media marketing', 'Content and ads on Facebook, Instagram and TikTok that grow a real readership around your book.'],
        ['globe', 'Goodreads visibility', 'Author profile, giveaways and reader engagement on the world’s largest community of book lovers.'],
        ['mail', 'Email marketing', 'A reader magnet, sign-up page and launch sequence that turn one-time buyers into loyal fans.'],
        ['headset', 'Media & podcast outreach', 'Pitches to journalists, podcasts and book bloggers who cover your genre or subject.'],
        ['layout', 'Video promotion', 'Book trailers and short social videos that make your story stop the scroll.'],
        ['pen', 'Author brand building', 'A clear author identity, bio and website that readers recognise and follow from book to book.'],
    ], 3) ?>
  </div>
</section>

<section class="sec bg-white" aria-labelledby="gl-h">
  <div class="w">
    <?= lp_head('Choose your goal', 'Marketing built around <em>where your book is now.</em>', 'Every campaign starts with a free strategy call. These are the three plans authors choose most.', true, 'gl-h') ?>
    <div class="tiers rv">
      <?= $goal('Launch a new book', 'For books releasing in the next few months.', $mk['price'], ['Launch plan and timeline', 'Amazon listing optimisation', 'Advance reader copy campaign', 'Launch-week Amazon ads', 'Email and social countdown'], false, 'Plan my launch') ?>
      <?= $goal('Revive an existing book', 'For published books that deserve more readers.', 'Your book', ['Listing and keyword audit', 'Cover and description review', 'Ongoing Amazon ad management', 'Review and Goodreads outreach', 'Monthly performance reports'], true, 'Boost my sales', true) ?>
      <?= $goal('Build your author brand', 'For authors planning a series or a career.', 'Your goals', ['Author website and bio', 'Reader email list set-up', 'Social media content plan', 'Media and podcast pitching', 'Series and backlist strategy'], false, 'Build my brand', true) ?>
    </div>
    <p class="muted" style="text-align:center;margin:28px 0 0;font-size:.92rem">Advertising budgets are separate, set by you and paid directly to the platform.</p>
  </div>
</section>

<?= lp_band('Want more readers this month?', 'Get a free marketing plan from a book marketing expert.') ?>

<section class="sec bg-sand" aria-labelledby="az-h">
  <div class="w split">
    <?= lp_books(3, 7) ?>
    <div><span class="eyebrow">Amazon book marketing</span><h2 class="h2" id="az-h">Most books are sold on Amazon. <em>We make yours stand out.</em></h2><p class="lead">Your Amazon page is your shop window. Before we spend a dollar on ads, we make sure it is ready to convert.</p>
      <?= lp_checks(['Keyword and category research', 'A description written to sell', 'A+ content and author page', 'Price and promotion strategy', 'Sponsored product ads', 'Review and rating growth'], true) ?></div>
  </div>
</section>

<?= lp_authors('Authors who trusted us with their books') ?>

<section class="sec bg-white" aria-labelledby="ps-h">
  <div class="w split split-57 top">
    <div class="sticky"><span class="eyebrow">Our book marketing process</span><h2 class="h2" id="ps-h">A clear plan, <em>then steady results.</em></h2><p class="lead">You approve the strategy and the budget. We do the work, track the numbers and keep improving.</p><?= lp_ctas('Start with a free call', '#lp-form', false) ?></div>
    <?= lp_steps([
        ['Free strategy call', 'We learn about your book, your readers, your goals and your budget.'],
        ['Book & market audit', 'We review your cover, listing and reviews and study the best-selling books in your category.'],
        ['Your marketing plan', 'You get a written plan with channels, timeline, budget and the results we will track.'],
        ['Listing & brand set-up', 'We optimise your Amazon page, author profile and website before driving traffic to them.'],
        ['Campaigns go live', 'Ads, review outreach, social content, email and media pitches launch on schedule.'],
        ['Track, report & improve', 'Clear reports show what is working, and we move budget towards the channels that sell.'],
    ]) ?>
  </div>
</section>

<section class="sec bg-sand" aria-labelledby="cp-h">
  <div class="w">
    <?= lp_head('Compare', 'Why hire a book marketer <em>at AMZ United Press?</em>', '', false, 'cp-h') ?>
    <?= lp_table(['Marketing it yourself', 'Large PR agencies', 'AMZ United Press'], [
        ['Cost', 'Your time, plus trial-and-error ad spend', 'Often thousands per month', 'From ' . $mk['price'] . ', quoted in writing'],
        ['Book-industry specialists', '—', 'Not always book-focused', '✓ Books only'],
        ['Amazon ads & listing expertise', 'Learn as you go', 'Often not included', '✓ Core service'],
        ['You control the ad budget', 'Yes', 'Sometimes', '✓ Always'],
        ['Clear, regular reporting', '—', 'Varies', '✓ Every month'],
        ['Long contracts', 'None', 'Often required', '✓ None required'],
    ]) ?>
  </div>
</section>

<?= lp_band('Book marketing that finds your readers.' . lp_offer_suffix(), 'Book your free strategy call today.') ?>

<section class="sec bg-white" aria-labelledby="rv-h">
  <div class="w">
    <?= lp_head('Authors say', 'Authors who <em>found their readers.</em>', '', true, 'rv-h') ?>
    <?= lp_quotes() ?>
    <div class="mt"><?= lp_stats() ?></div>
  </div>
</section>

<?= lp_faq('bg-sand', 'Book marketing <em>questions,</em> answered.', $FAQ) ?>

<?= lp_final('Free strategy call', 'Let’s get your book <em>in front of readers.</em>', 'Tell us about your book and what success looks like for you. A book marketing expert will reply within one business day with ideas and a written plan.', ['Free strategy call', 'You control the budget', 'No long contracts'], ['Get my free marketing plan', 'Takes about a minute. No obligation.', 4, 'Get My Free Plan']) ?>
</div>
<?php include dirname(__DIR__) . '/includes/footer.php'; ?>
