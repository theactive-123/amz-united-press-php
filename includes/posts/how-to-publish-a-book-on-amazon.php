<?php
/**
 * Blog article. Primary keyword: "how to publish a book on Amazon".
 * Secondary: how to publish on Amazon KDP, Kindle Direct Publishing step by step, how to self-publish on Amazon,
 * KDP paperback, KDP Select, KDP keywords and categories, KDP royalties, how long does KDP review take.
 * Amazon figures checked November 2026 against KDP Help (70% ebook band $2.99–$12.99 on Amazon.com since July 7, 2026;
 * 7 keywords; up to 3 categories; free ISBN for print only). Re-check KDP Help when updating.
 */
return [
    'slug'      => 'how-to-publish-a-book-on-amazon',
    'title'     => 'How to Publish a Book on Amazon (2026 Step-by-Step Guide)',
    'h1'        => 'How to Publish a Book on Amazon: <em>a step-by-step KDP guide for 2026</em>',
    'h1_plain'  => 'How to Publish a Book on Amazon: A Step-by-Step KDP Guide for 2026',
    'description' => 'How to publish a book on Amazon in 2026: set up KDP, prepare files, pick keywords and categories, price for royalties and go live, step by step.',
    'excerpt'   => 'Publishing on Amazon is free and takes about three days once your files are ready. This guide walks through every KDP screen in order, with the 2026 royalty rules and the mistakes that delay or sink a launch.',
    'date'      => '2026-11-09',
    'updated'   => '2026-11-09',
    'category'  => 'Amazon KDP',
    'keyword'   => 'how to publish a book on Amazon',
    'keywords'  => ['how to publish on Amazon KDP', 'Kindle Direct Publishing step by step', 'how to self-publish a book on Amazon', 'publish a paperback on Amazon', 'KDP keywords and categories', 'KDP Select', 'KDP royalties 2026', 'how long does KDP review take'],
    'image'     => '/assets/img/blog/how-to-publish-a-book-on-amazon.jpg',
    'image_alt' => 'Step-by-step guide to publishing a book on Amazon KDP: account, files, details, pricing and launch',
    'related'   => ['/services/publishing-services', '/pricing', '/services/book-formatting-services', '/blog/how-much-does-it-cost-to-self-publish-a-book'],

    'faq' => [
        ['Is it free to publish a book on Amazon?', 'Yes. Kindle Direct Publishing (KDP) charges nothing to create an account, upload a book or keep it on sale, and it gives paperbacks and hardcovers a free ISBN. Amazon is paid from each sale instead: its share of the price, plus the printing cost on print books. Any money you spend goes on preparing the book, such as editing, cover design and formatting.'],
        ['How long does it take to publish a book on Amazon?', 'Once your files are ready, setting up the listing takes an hour or two. KDP then reviews the book, which typically takes up to 72 hours, and the book can take up to another 72 hours to appear in Amazon search. Writing, editing, cover design and formatting take far longer, so most authors plan four to twelve weeks from finished draft to launch.'],
        ['Do I need an ISBN to publish on Amazon?', 'Not for a Kindle ebook: Amazon gives it an ASIN instead. Paperbacks and hardcovers need an ISBN, and KDP offers one free for each print format. A free KDP ISBN can only be used on KDP and lists the publisher as “Independently published”. Buy your own ISBN if you want your own imprint name or plan to sell the same edition through other printers.'],
        ['How much does Amazon pay authors per book?', 'Kindle ebooks earn 70% of the list price minus a small delivery fee when priced between $2.99 and $12.99 on Amazon.com (the band since July 7, 2026), or 35% outside it. Paperbacks earn 60% of the list price minus the print cost when priced at $9.99 or more. For example, a $4.99 ebook earns about $3.40 and a 250-page paperback at $14.99 earns about $5.'],
        ['Should I enroll my book in KDP Select?', 'Enroll if most of your readers buy on Amazon and read in Kindle Unlimited, which is common for romance, thrillers and other genre fiction. KDP Select pays you for pages read and adds promotion tools, but it requires your ebook to be exclusive to Amazon for each 90-day term. If you want the ebook on Apple Books, Kobo or other stores, stay out of Select. It never affects your paperback.'],
        ['Can I publish on Amazon from outside the United States?', 'Yes. KDP accepts authors from most countries, sells in Amazon stores worldwide and pays by bank transfer in many currencies. Non-US authors fill in the W-8BEN form in the KDP tax interview, which can lower US withholding on royalties if your country has a tax treaty with the US.'],
        ['Can I change my book after it is published?', 'Yes. You can upload a corrected manuscript or cover, or change the description, keywords, categories and price at any time from your KDP Bookshelf. Each change goes through review again, usually within 72 hours, and the book stays on sale while it is reviewed. A new edition with substantial changes to a print book needs a new ISBN.'],
    ],

    'body' => <<<'HTML'
<div class="bp-answer" id="quick-answer">
  <p class="bp-answer-k">Quick answer</p>
  <p><strong>How to publish a book on Amazon: create a free Kindle Direct Publishing (KDP) account, finish your tax and bank details, then add your book’s details, upload an edited manuscript and cover, set your price and click Publish.</strong> KDP reviews most books within 72 hours. It costs nothing to publish; Amazon takes its share from each sale, and you keep your rights.</p>
</div>

<p>Amazon’s publishing platform is free and the steps are simple. Yet first-time authors still lose weeks to rejected files, a listing nobody finds, or a price that quietly halves their royalty. This guide takes you through every screen in the order KDP shows it, explains each choice in plain English, and flags where most first launches go wrong.</p>

<div class="bp-keys">
  <p class="bp-keys-k">Key takeaways</p>
  <ul>
    <li>Publishing on <strong>Amazon KDP is free</strong>. You need an Amazon account, tax details and a bank account for royalties.</li>
    <li>Every format is set up separately: <strong>Kindle ebook, paperback and hardcover</strong>. Amazon links them on one product page.</li>
    <li>Your listing has <strong>7 keyword slots and up to 3 categories</strong>. Together they decide where readers find you.</li>
    <li>Since July 7, 2026, ebooks priced <strong>$2.99–$12.99</strong> on Amazon.com can earn the 70% royalty.</li>
    <li>Order a <strong>printed proof</strong> before you publish a paperback. It is the cheapest insurance you can buy.</li>
  </ul>
</div>

<h2 id="before-you-start">What you need before you start</h2>
<p>Getting these ready first turns setup into an afternoon’s work instead of a week of back-and-forth.</p>
<div class="bp-table-wrap">
<table class="bp-table">
  <caption>Your Amazon publishing checklist</caption>
  <thead><tr><th scope="col">Item</th><th scope="col">Ebook</th><th scope="col">Paperback / hardcover</th></tr></thead>
  <tbody>
    <tr><th scope="row">Edited, proofread manuscript</th><td>Required</td><td>Required</td></tr>
    <tr><th scope="row">Interior file</th><td>EPUB or Word (DOCX)</td><td>Print-ready PDF at your trim size</td></tr>
    <tr><th scope="row">Cover</th><td>Front cover image (JPG or TIFF)</td><td>Full wrap PDF: back, spine and front</td></tr>
    <tr><th scope="row">ISBN</th><td>Not needed (Amazon assigns an ASIN)</td><td>Free from KDP, or your own</td></tr>
    <tr><th scope="row">Book description</th><td colspan="2">Up to 4,000 characters, written to sell</td></tr>
    <tr><th scope="row">Keywords and categories</th><td colspan="2">7 keywords and up to 3 categories, researched in advance</td></tr>
    <tr><th scope="row">Tax and bank details</th><td colspan="2">Tax ID and an account that can receive royalties</td></tr>
  </tbody>
</table>
</div>
<p>If the manuscript isn’t edited yet, stop here. Amazon will publish an unedited book, but reviews will point out every error, and early reviews are hard to recover from. Our guide to <a href="/blog/how-much-does-it-cost-to-self-publish-a-book">how much it costs to self-publish a book</a> shows what editing, covers and formatting cost if you plan to hire help.</p>

<h2 id="steps">How to publish a book on Amazon in 9 steps</h2>

<h3 id="step-1">Step 1: Create your KDP account</h3>
<p>Go to <a href="https://kdp.amazon.com" target="_blank" rel="noopener">kdp.amazon.com</a> and sign in with an Amazon account, or create a new one. Many authors set up a separate account just for publishing, which keeps book income apart from personal shopping. Amazon may ask you to verify your identity before you can publish, so set up the account a few weeks before you plan to launch.</p>

<h3 id="step-2">Step 2: Complete your tax and payment details</h3>
<p>Under <strong>Your Account</strong>, complete the tax interview and add a bank account. US authors fill in a W-9; authors outside the US fill in a W-8BEN, which can reduce US withholding on royalties if their country has a tax treaty with the US. KDP pays royalties about 60 days after the end of the month in which a sale happens. You can set up a book before this is done, but you can’t publish it until the tax interview is complete.</p>

<h3 id="step-3">Step 3: Prepare your manuscript and cover files</h3>
<p>This is the step that decides whether your book looks self-published or professionally published.</p>
<ul>
  <li><strong>Ebook interior:</strong> upload an EPUB or a cleanly styled Word file. Use real heading styles for chapter titles so the Kindle table of contents works, and avoid manual spacing with tabs and blank lines.</li>
  <li><strong>Print interior:</strong> upload a PDF at your chosen trim size (6 × 9 inches is the most common for nonfiction and many novels), with fonts embedded, correct margins for your page count, and no blank pages where KDP doesn’t expect them.</li>
  <li><strong>Cover:</strong> the ebook needs a front cover only. Print books need a full wrap whose spine width depends on page count and paper colour, so the cover is finished <em>after</em> the interior is final.</li>
</ul>
<figure class="bp-fig"><img src="/assets/img/lp/layout.webp" alt="Formatted book interior pages showing chapter openings, margins and typography" width="1400" height="933" loading="lazy" decoding="async"><figcaption>Print interiors need correct margins, embedded fonts and the right trim size before KDP will accept them.</figcaption></figure>
<p>Amazon’s free <strong>Kindle Create</strong> tool handles text-only books well. Books with images, tables or complex layouts usually need <a href="/services/book-formatting-services">professional book formatting</a>, and print covers often need <a href="/services/book-cover-design-services">a designer who knows KDP’s cover specs</a>.</p>
<div class="bp-tip"><p><strong>Common rejection:</strong> text or images too close to the edge of the page. Keep everything that isn’t meant to bleed inside KDP’s minimum margins, and download the cover template from KDP for your exact page count.</p></div>

<h3 id="step-4">Step 4: Create a new title on your Bookshelf</h3>
<p>From the <strong>Bookshelf</strong>, choose <strong>+ Create</strong> and pick a format: Kindle eBook, Paperback or Hardcover. Each format has three tabs: <em>Details</em>, <em>Content</em> and <em>Rights &amp; Pricing</em>. Start with the format you’ll launch first; most authors start with the ebook, then add the paperback from the same Bookshelf entry so the two link automatically.</p>

<h3 id="step-5">Step 5: Fill in your book details</h3>
<p>The Details tab is your Amazon product page. Take your time here, because this is what shoppers read.</p>
<ul>
  <li><strong>Title and subtitle:</strong> must match your cover exactly. A subtitle that tells readers who the book is for helps nonfiction sell.</li>
  <li><strong>Series:</strong> add series information now so Amazon groups the books together.</li>
  <li><strong>Author and contributors:</strong> use the exact pen name you’ll use on every book, so they all appear on one Author Central page.</li>
  <li><strong>Description:</strong> up to 4,000 characters. Lead with a hook, not a plot summary, and use short paragraphs and bold text. It is your sales page.</li>
  <li><strong>Publishing rights and audience:</strong> confirm you own the rights, and set reading age if it’s a children’s or teen book.</li>
  <li><strong>AI content:</strong> KDP asks whether your text, images or translation were created with AI. Answer honestly. It is required, and KDP says it does not currently show the answer to customers.</li>
</ul>

<h3 id="step-6">Step 6: Choose keywords and categories</h3>
<p>These two fields decide where your book appears when someone searches or browses, and they’re where most first-time listings underperform.</p>
<p><strong>Keywords.</strong> You get <a href="https://kdp.amazon.com/en_US/help/topic/G201298500" target="_blank" rel="noopener">seven keyword slots</a>. Don’t repeat words already in your title, and don’t waste slots on single generic words like “book” or “novel”. Use the phrases readers actually type: start typing in Amazon’s search bar and note the autocomplete suggestions, for example <em>“cozy mystery with cats”</em> or <em>“budgeting for couples”</em>.</p>
<p><strong>Categories.</strong> Choose <a href="https://kdp.amazon.com/en_US/help/topic/G200652170" target="_blank" rel="noopener">up to three categories</a>. A good category is popular enough that readers browse it but not so crowded that a new book disappears. Look at the categories shown on the product pages of books similar to yours: a category where top books have modest sales ranks gives you a realistic chance at a visible ranking.</p>

<h3 id="step-7">Step 7: Upload your content and preview it</h3>
<p>On the Content tab you upload the interior and cover, and choose your ISBN for print. KDP’s <a href="https://kdp.amazon.com/en_US/help/topic/GTJ8LBXL6Z4WV5QX" target="_blank" rel="noopener">free ISBN</a> works only on KDP and lists the publisher as “Independently published”. If you want your own imprint, buy ISBNs from your national agency (Bowker in the US) and enter one here.</p>
<p>Then open the <strong>Previewer</strong> and check every page, not just the first few. Look for blank pages, broken chapter breaks, images that don’t fit and text running into the margins. For a paperback, also order a <strong>proof copy</strong>: you pay only the printing cost and shipping, and holding the book is the only way to see the colour, spine and paper as readers will.</p>

<h3 id="step-8">Step 8: Set your price and royalty option</h3>
<p>On the Rights &amp; Pricing tab, choose where to sell (worldwide rights is usual for original work), your royalty plan and your price. Here’s how the money works on Amazon.com:</p>
<div class="bp-table-wrap">
<table class="bp-table">
  <caption>KDP royalties on Amazon.com (November 2026)</caption>
  <thead><tr><th scope="col">Format</th><th scope="col">Royalty</th><th scope="col">Conditions</th></tr></thead>
  <tbody>
    <tr><th scope="row">Kindle ebook</th><td>70% of list price minus delivery fee</td><td>Priced $2.99–$12.99 and meets KDP’s other 70% requirements</td></tr>
    <tr><th scope="row">Kindle ebook</th><td>35% of list price</td><td>Priced outside the 70% band</td></tr>
    <tr><th scope="row">Paperback</th><td>60% of list price minus print cost</td><td>List price $9.99 or more</td></tr>
    <tr><th scope="row">Paperback</th><td>50% of list price minus print cost</td><td>List price under $9.99</td></tr>
  </tbody>
</table>
</div>
<p>The 70% ebook band rose from $9.99 to <strong>$12.99</strong> on July 7, 2026, according to <a href="https://kdp.amazon.com/en_US/help/topic/G200634500" target="_blank" rel="noopener">KDP’s pricing page</a>. That matters for longer nonfiction, which can now be priced higher without dropping to 35%. Existing books don’t change automatically: if you priced above $9.99 at 35% before July, you have to switch the royalty option yourself.</p>
<div class="bp-math">
  <p><span>Paperback list price</span><b>$14.99</b></p>
  <p><span>60% royalty rate</span><b>$8.99</b></p>
  <p><span>Print cost, 250 pages black ink ($1.00 + 250 × $0.012)</span><b>− $4.00</b></p>
  <p class="t"><span>Your royalty per copy</span><b>≈ $4.99</b></p>
</div>
<p><strong>KDP Select</strong> is offered on this tab too. Enrolling puts your ebook in Kindle Unlimited, where you’re paid for pages read, and unlocks promotions such as free-book days and Kindle Countdown Deals. The catch: the ebook must be <a href="https://kdp.amazon.com/en_US/help/topic/G200798990" target="_blank" rel="noopener">exclusive to Amazon</a> for each 90-day term, so you can’t also sell it on Apple Books, Kobo or other ebook stores. Paperbacks are never affected.</p>

<h3 id="step-9">Step 9: Publish, then check your live listing</h3>
<p>Click <strong>Publish</strong>. KDP reviews the book, typically within 72 hours, and emails you when it’s live. It can take up to another 72 hours for the book to show up in Amazon search, so don’t panic if searching your title finds nothing on day one; use the link in your Bookshelf instead.</p>
<p>Once live, check the product page on desktop and mobile, make sure the ebook and paperback are linked, and claim your <strong>Author Central</strong> page to add a photo and bio. If you want the ebook available before launch day, KDP also lets you set it up as a <strong>pre-order</strong>, which gives you a link to share and collects sales ahead of launch.</p>

<h2 id="timeline">How long does it take to publish on Amazon?</h2>
<p>The Amazon part is fast. The preparation is what takes time.</p>
<ul>
  <li><strong>Editing and proofreading:</strong> two to eight weeks, depending on length and the level of edit.</li>
  <li><strong>Cover design:</strong> one to three weeks, including revisions.</li>
  <li><strong>Formatting:</strong> a few days to two weeks.</li>
  <li><strong>KDP setup:</strong> an hour or two per format.</li>
  <li><strong>KDP review:</strong> typically up to 72 hours, plus up to 72 hours to appear in search.</li>
  <li><strong>Printed proof:</strong> allow one to two weeks for printing and delivery.</li>
</ul>
<p>For a finished draft, four to twelve weeks to launch is realistic. Rushing the cover or skipping the proof is how most authors end up re-uploading files after launch, often after the first reviews are in.</p>

<h2 id="after-publishing">What to do after your book goes live</h2>
<ol class="bp-ol">
  <li><strong>Ask early readers for honest reviews.</strong> Give advance copies to readers who might review the book, and never pay for reviews or swap them with other authors. Amazon removes them and can penalise your account.</li>
  <li><strong>Add the paperback (or hardcover) if you haven’t.</strong> A print edition makes the ebook price look better value and brings in readers who don’t read on Kindle.</li>
  <li><strong>Watch your first month of data.</strong> KDP Reports show sales and Kindle Unlimited page reads. If people visit but don’t buy, fix the cover, description or price before paying for traffic.</li>
  <li><strong>Test Amazon Ads with a small budget.</strong> Start with a few dollars a day on keyword ads, and turn off the ones that spend without selling.</li>
  <li><strong>Build an email list.</strong> Put a link at the back of the book to a free extra. Your list is the one audience Amazon doesn’t control.</li>
</ol>
<p>Our <a href="/services/book-marketing-services">book marketing services</a> cover launch planning, Amazon Ads and listing optimisation if you’d rather not do this alone.</p>

<h2 id="mistakes">7 mistakes that delay or sink a launch</h2>
<ul class="bp-flags">
  <li><strong>Publishing an unedited manuscript.</strong> Readers forgive a plain cover more readily than typos on page one. At minimum, get a <a href="/services/proofreading-services">professional proofread</a>.</li>
  <li><strong>A cover that doesn’t fit the genre.</strong> Shoppers judge the thumbnail in a second, and a cover that signals the wrong genre attracts the wrong readers.</li>
  <li><strong>Mismatched title data.</strong> The title, subtitle and author name on the cover must match the Details tab exactly, or KDP will reject the book.</li>
  <li><strong>Wasted keyword slots.</strong> Repeating your title or using single generic words throws away free visibility.</li>
  <li><strong>Pricing just outside a royalty band.</strong> A $2.49 ebook earns 35%; at $2.99 it can earn 70%. Check the band before you choose a price.</li>
  <li><strong>Skipping the printed proof.</strong> Colours, spine text and margins often look different in print than on screen.</li>
  <li><strong>Handing over your account.</strong> Never let a company publish your book on <em>their</em> KDP account. You lose control of the listing, the reviews and the royalties.</li>
</ul>

<div class="bp-cta">
  <div>
    <p class="bp-cta-k">Want it done right the first time?</p>
    <h2 class="bp-cta-h" id="publish-with-us">We publish your book on Amazon, on your account, from $199</h2>
    <p>Our packages cover proofreading, formatting, a free 3D cover, ISBN and barcode, and full setup on Amazon KDP, including keywords, categories and pricing, for one clear fee: <strong>$199, $499 or $899</strong>. Your name, your account, and you keep 100% of your rights and royalties.</p>
  </div>
  <div class="bp-cta-btns"><a class="btn btn-primary" href="/pricing">See the packages</a><button type="button" class="btn btn-outline" data-quote="Blog: how to publish a book on Amazon" data-help="3">Get a free quote</button></div>
</div>

<h2 id="diy-or-help">Should you publish yourself or get help?</h2>
<p>You can absolutely publish on Amazon yourself. Everything in this guide is free to do, and many authors enjoy learning the process. DIY makes most sense when your book is text-only, you’re comfortable with Word or Kindle Create, and you have time to research keywords and check every proof.</p>
<p>Help makes more sense when the book has images or a complex layout, when you want a professional cover and print interior without learning design software, or when your time is worth more spent writing the next book. If you hire anyone, check that they publish on <strong>your</strong> KDP account, hand over every file, and take <strong>no share of your royalties</strong>. That’s how our <a href="/services/publishing-services">publishing services</a> work.</p>

<h2 id="bottom-line">The bottom line</h2>
<p>Learning how to publish a book on Amazon takes an afternoon; publishing a book that sells takes preparation. <strong>Create your KDP account early, get the manuscript edited and the files right, research your keywords and categories, price inside the royalty bands, and order a proof before you click Publish.</strong></p>
<p>Do that and your launch week is spent telling readers about your book, not fixing rejected files. Want a second pair of eyes before you publish? <a href="/contact">Tell us about your book</a> and we’ll reply with a free, written quote within one business day.</p>
HTML,
];
