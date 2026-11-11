<?php
/**
 * Blog article. Primary keyword: "how to format a book for KDP".
 * Secondary: KDP formatting, KDP paperback margins, KDP gutter size, KDP bleed, KDP trim size, Kindle ebook formatting,
 * Kindle Create, KDP file rejected, KDP print previewer.
 * KDP figures checked November 2026 against KDP Help (gutter table, 0.125" bleed, accepted ebook formats, MOBI retired).
 * Re-check KDP Help when updating.
 */
return [
    'slug'      => 'how-to-format-a-book-for-kdp',
    'title'     => 'How to Format a Book for KDP (Paperback & Kindle, 2026)',
    'h1'        => 'How to Format a Book for KDP: <em>paperback and Kindle, step by step</em>',
    'h1_plain'  => 'How to Format a Book for KDP: Paperback and Kindle, Step by Step',
    'description' => 'How to format a book for KDP: trim size, margins, gutter and bleed for paperbacks, Kindle ebook files, and fixes for the errors that get files rejected.',
    'excerpt'   => 'Most KDP rejections come down to a handful of formatting settings. Here are the exact trim, margin, gutter and bleed numbers for paperbacks, how to build a clean Kindle file, and how to fix the errors Print Previewer flags.',
    'date'      => '2026-11-11',
    'updated'   => '2026-11-11',
    'category'  => 'Amazon KDP',
    'keyword'   => 'how to format a book for KDP',
    'keywords'  => ['KDP formatting', 'KDP paperback margins', 'KDP gutter size', 'KDP bleed settings', 'KDP trim size', 'Kindle ebook formatting', 'Kindle Create', 'KDP file rejected', 'KDP Print Previewer'],
    'image'     => '/assets/img/blog/how-to-format-a-book-for-kdp.jpg',
    'image_alt' => 'How to format a book for KDP: paperback trim size, margins, gutter and bleed, plus Kindle ebook formatting',
    'related'   => ['/services/book-formatting-services', '/blog/how-to-publish-a-book-on-amazon', '/pricing', '/services/book-cover-design-services'],

    'faq' => [
        ['What is the best trim size for a KDP paperback?', '6 × 9 inches is the most common trim size for paperbacks in the US and works well for most nonfiction and many novels. Shorter novels often use 5.5 × 8.5 or 5 × 8 inches. Look at bestsellers in your genre and match them, because readers notice books that feel the wrong size.'],
        ['What margins does KDP require?', 'The inside margin (gutter) depends on page count: 0.375 inches for 24–150 pages, 0.5 for 151–300, 0.625 for 301–500, 0.75 for 501–700 and 0.875 for 701–828. Outside margins must be at least 0.25 inches without bleed and 0.375 inches with bleed. Most books look better with more than the minimum, around 0.5 to 0.75 inches.'],
        ['Do I need bleed for my KDP book?', 'Only if images or colour run to the edge of the page. Bleed adds 0.125 inches to the top, bottom and outside edges, so a 6 × 9 book with bleed uses a 6.125 × 9.25 inch page. Text-only books don’t need bleed.'],
        ['What file should I upload for a Kindle ebook?', 'KDP recommends EPUB, DOCX or KPF (the format Kindle Create produces). MOBI is no longer accepted. A clean Word file with proper heading styles converts well for text-only books; books with complex layouts are usually better built as EPUB.'],
        ['Can I use the same file for my paperback and Kindle ebook?', 'Not as-is. A paperback needs a fixed PDF at your trim size with margins, page numbers and headers, while an ebook needs reflowable text that adapts to any screen, without page numbers or fixed line breaks. You can start from the same edited manuscript, but you build two different files.'],
        ['Why does KDP say my fonts aren’t embedded?', 'The PDF was exported without fully embedding every font, or a font’s licence doesn’t allow embedding. Re-export with fonts embedded (PDF/X-1a or your app’s high-quality print setting), check under Document Properties > Fonts in a PDF reader, or switch to a font licensed for commercial use.'],
        ['How much does professional book formatting cost?', 'Simple text-only books are usually formatted for a few hundred dollars, while books with images, tables or complex layouts cost more. Our book formatting service starts from $150, and formatting is included in all our publishing packages.'],
    ],

    'body' => <<<'HTML'
<div class="bp-answer" id="quick-answer">
  <p class="bp-answer-k">Quick answer</p>
  <p><strong>How to format a book for KDP: for a paperback, set your page to your trim size (6 × 9 inches is most common), use a gutter of 0.375–0.875 inches depending on page count, keep outside margins at least 0.25 inches, embed all fonts and export a PDF.</strong> For a Kindle ebook, use real heading styles, remove manual spacing and page numbers, and upload an EPUB, DOCX or Kindle Create (KPF) file. Then check every page in KDP’s Previewer before you publish.</p>
</div>

<p>Formatting is where most first-time KDP uploads go wrong. The writing is finished, the cover looks great, and then Print Previewer flags text in the margins, fonts that aren’t embedded, or a page size that doesn’t match your trim. This guide gives you the exact settings for paperbacks and ebooks, the order to do things in, and the fixes for the errors that get files rejected.</p>

<div class="bp-keys">
  <p class="bp-keys-k">Key takeaways</p>
  <ul>
    <li><strong>Paperbacks and ebooks need different files.</strong> Print is a fixed PDF; Kindle is reflowable text.</li>
    <li>Choose your <strong>trim size first</strong>. Margins, page count and cover size all depend on it.</li>
    <li>The <strong>gutter grows with page count</strong>, from 0.375 inches up to 0.875 inches.</li>
    <li>Bleed is only for images or colour that reach the edge, and it adds <strong>0.125 inches</strong> on three sides.</li>
    <li>Upload ebooks as <strong>EPUB, DOCX or KPF</strong>. MOBI is no longer accepted.</li>
  </ul>
</div>

<h2 id="before-you-format">Before you format: finish the text</h2>
<p>Format last. Every edit after layout can push lines onto new pages, break your table of contents and change your page count, which changes your margins and your cover’s spine width. Make sure the manuscript is edited and proofread first. If it isn’t, start with a <a href="/services/proofreading-services">professional proofread</a>; it costs far less than redoing a layout.</p>
<p>Then decide two things: which formats you’re publishing (most authors do a Kindle ebook and a paperback, sometimes a hardcover), and which tool you’ll use. Kindle Create (free from Amazon) handles text-only books well. Word works if you’re careful with styles. Dedicated tools like Vellum or Atticus, or professional layout in InDesign, give the most control for complex books.</p>

<h2 id="paperback">How to format a paperback for KDP</h2>

<h3 id="trim-size">1. Choose your trim size</h3>
<p>Trim size is the finished size of your book. It sets everything else, so pick it first and don’t change it later.</p>
<div class="bp-table-wrap">
<table class="bp-table">
  <caption>Common KDP paperback trim sizes</caption>
  <thead><tr><th scope="col">Trim size</th><th scope="col">Typical use</th></tr></thead>
  <tbody>
    <tr><th scope="row">5 × 8 in</th><td>Novels, poetry, shorter books</td></tr>
    <tr><th scope="row">5.5 × 8.5 in</th><td>Novels, memoirs, self-help</td></tr>
    <tr><th scope="row">6 × 9 in</th><td>Most nonfiction and many novels; the most common US size</td></tr>
    <tr><th scope="row">7 × 10 in</th><td>Workbooks, textbooks, image-heavy guides</td></tr>
    <tr><th scope="row">8.5 × 11 in</th><td>Workbooks, journals, children’s activity books</td></tr>
  </tbody>
</table>
</div>
<p>In your layout tool, set the page size to your trim size. If you’re using bleed (step 3), the page is slightly larger. KDP also offers <a href="https://kdp.amazon.com/en_US/help/topic/G201834230" target="_blank" rel="noopener">free Word templates for each trim size</a>, which is a safe starting point.</p>

<h3 id="margins">2. Set margins and the gutter</h3>
<p>The gutter is the inside margin, next to the spine. Thicker books curve more at the spine, so KDP requires a wider gutter as page count goes up:</p>
<div class="bp-table-wrap">
<table class="bp-table">
  <caption>KDP minimum inside margin (gutter) by page count</caption>
  <thead><tr><th scope="col">Page count</th><th scope="col">Minimum inside margin</th></tr></thead>
  <tbody>
    <tr><th scope="row">24–150 pages</th><td>0.375 in (9.6 mm)</td></tr>
    <tr><th scope="row">151–300 pages</th><td>0.5 in (12.7 mm)</td></tr>
    <tr><th scope="row">301–500 pages</th><td>0.625 in (15.9 mm)</td></tr>
    <tr><th scope="row">501–700 pages</th><td>0.75 in (19.1 mm)</td></tr>
    <tr><th scope="row">701–828 pages</th><td>0.875 in (22.3 mm)</td></tr>
  </tbody>
</table>
</div>
<p>Outside margins (top, bottom and the outer edge) must be at least <strong>0.25 inches without bleed</strong> and <strong>0.375 inches with bleed</strong>, according to <a href="https://kdp.amazon.com/en_US/help/topic/GVBQ3CMEQW3W2VL6" target="_blank" rel="noopener">KDP’s trim, bleed and margin guide</a>. Those are minimums. Most professionally set books use 0.5 to 0.75 inches outside, which looks less cramped and keeps text away from readers’ thumbs.</p>
<div class="bp-tip"><p><strong>Tip:</strong> estimate your final page count before setting the gutter. If you’re close to a boundary (say 290 pages), use the larger gutter so a few extra pages later don’t make the file non-compliant.</p></div>

<h3 id="bleed">3. Decide on bleed</h3>
<p>You only need bleed if images, colour blocks or backgrounds run to the edge of the page. Bleed extends the page by 0.125 inches on the top, bottom and outside edges, so the printer can trim cleanly. For a 6 × 9 inch book with bleed, set the page to <strong>6.125 × 9.25 inches</strong> and let edge images extend fully into the bleed area. Text-only books should be set up without bleed.</p>

<h3 id="interior">4. Build a clean interior</h3>
<figure class="bp-fig"><img src="/assets/img/lp/layout.webp" alt="Formatted book interior pages with chapter openings, margins and page numbers" width="1400" height="933" loading="lazy" decoding="async"><figcaption>Consistent chapter openings, headers and page numbers are what make an interior look professionally published.</figcaption></figure>
<ul>
  <li><strong>Body text:</strong> a readable serif such as Garamond, Minion or Palatino at 10–12 pt, with line spacing around 1.2–1.4.</li>
  <li><strong>Chapter openings:</strong> start each chapter on a new page (many books start on a right-hand page), with consistent spacing above the title.</li>
  <li><strong>Front matter:</strong> title page, copyright page (with your ISBN), optional dedication and table of contents, in that order.</li>
  <li><strong>Headers and page numbers:</strong> omit them on chapter openers and blank pages, which is standard in traditionally published books.</li>
  <li><strong>Paragraphs:</strong> indent first lines instead of adding space between paragraphs, and don’t indent the first paragraph of a chapter.</li>
  <li><strong>Widows and orphans:</strong> avoid single lines stranded at the top or bottom of a page.</li>
</ul>

<h3 id="export-pdf">5. Export a print-ready PDF</h3>
<p>Export at your exact page size with <strong>all fonts embedded</strong> and images at 300 DPI. Use your app’s high-quality print or PDF/X-1a preset if it has one. Before uploading, open the PDF and check under Document Properties > Fonts that every font says “Embedded”.</p>

<h2 id="kindle">How to format a Kindle ebook</h2>
<p>Ebooks work differently: readers change the font, size and screen, so text has to reflow. Anything that fixes text in place breaks on some devices.</p>
<ol class="bp-ol">
  <li><strong>Use heading styles for chapter titles.</strong> Kindle builds the navigation from them, so readers can jump between chapters.</li>
  <li><strong>Remove manual formatting.</strong> No tabs or spaces for indents, no blank lines to push text down, no manual page breaks except between chapters.</li>
  <li><strong>Delete page numbers, headers and footers.</strong> They don’t exist on a Kindle.</li>
  <li><strong>Add a linked table of contents</strong> at the front, or let Kindle Create generate one.</li>
  <li><strong>Resize images sensibly.</strong> Use clear JPGs, keep them inline with the text, and avoid text inside images where you can.</li>
  <li><strong>Save in an accepted format.</strong> KDP recommends <a href="https://kdp.amazon.com/en_US/help/topic/G200634390" target="_blank" rel="noopener">EPUB, DOCX or KPF</a>. MOBI is no longer supported for new uploads.</li>
</ol>
<p>Books that rely on layout, such as cookbooks, children’s picture books and heavily illustrated guides, often need a fixed-layout ebook instead. These take more work and are usually best built by a professional formatter.</p>

<div class="bp-cta">
  <div>
    <p class="bp-cta-k">Skip the trial and error</p>
    <h2 class="bp-cta-h" id="formatting-help">Print and Kindle files that pass review, from $150</h2>
    <p>Our formatters build your paperback PDF, hardcover and Kindle files to KDP’s specs, with clean typography and a layout that looks traditionally published. Formatting is also included in every publishing package, from $199. You keep 100% of your rights and royalties.</p>
  </div>
  <div class="bp-cta-btns"><a class="btn btn-primary" href="/services/book-formatting-services">See formatting services</a><button type="button" class="btn btn-outline" data-quote="Blog: KDP formatting guide" data-help="1">Get a free quote</button></div>
</div>

<h2 id="previewer">Check everything in the Previewer</h2>
<p>After uploading, KDP’s Previewer shows your book as readers will see it and flags problems. Go through every page, not just the first chapter. Print Previewer mainly checks margins, page size, bleed and fonts; for ebooks, test the Kindle preview on a phone, tablet and Kindle view.</p>
<p>For a paperback, also order a <strong>printed proof</strong> before you publish. You only pay printing and shipping, and holding the book is the only way to judge margins, font size and image quality properly. Our guide to <a href="/blog/how-to-publish-a-book-on-amazon">publishing a book on Amazon</a> covers the full upload process.</p>

<h2 id="errors">Common KDP formatting errors and how to fix them</h2>
<div class="bp-table-wrap">
<table class="bp-table">
  <caption>KDP formatting problems and their fixes</caption>
  <thead><tr><th scope="col">Error</th><th scope="col">Usual cause</th><th scope="col">Fix</th></tr></thead>
  <tbody>
    <tr><th scope="row">Content outside margins</th><td>Gutter too small for the page count, or images too close to the edge</td><td>Increase the gutter to match the page count table; move content inside the margins</td></tr>
    <tr><th scope="row">Page size doesn’t match trim</th><td>Document set to Letter/A4, or bleed set up inconsistently</td><td>Set the page to the trim size (plus bleed if used) before exporting</td></tr>
    <tr><th scope="row">Fonts not embedded</th><td>Export settings, or a font that doesn’t allow embedding</td><td>Re-export with fonts embedded; switch to a commercially licensed font</td></tr>
    <tr><th scope="row">Low-resolution images</th><td>Web images used in print</td><td>Replace with 300 DPI images at the printed size</td></tr>
    <tr><th scope="row">Blank or extra pages</th><td>Stray page breaks or section breaks</td><td>Remove extra breaks; check the page count matches what you expect</td></tr>
    <tr><th scope="row">Broken Kindle layout</th><td>Tabs, spaces and manual line breaks</td><td>Replace with styles; rebuild the file in Kindle Create or as EPUB</td></tr>
  </tbody>
</table>
</div>
<p>KDP’s own <a href="https://kdp.amazon.com/en_US/help/topic/G201834260" target="_blank" rel="noopener">guide to fixing paperback formatting issues</a> lists the full set of Previewer messages.</p>

<h2 id="cover">Don’t forget the cover depends on the interior</h2>
<p>A paperback cover is a single wrap: back, spine and front. The spine width is calculated from your page count and paper type, so the cover can only be finished once the interior is final. If you change the page count later, the cover has to be resized too. That’s why we finish formatting before final <a href="/services/book-cover-design-services">cover design</a> on every project.</p>

<h2 id="diy-or-pro">Format it yourself or hire a formatter?</h2>
<p>Doing it yourself makes sense for a text-only novel or nonfiction book: Kindle Create or a KDP template, careful styles and a printed proof will get you a clean result. Hiring help makes sense when the book has images, tables, footnotes, workbook pages or a fixed-layout ebook, or when you want an interior that matches traditionally published books in your genre.</p>
<p>Whichever route you choose, budget formatting alongside editing and cover design. Our guide to <a href="/blog/how-much-does-it-cost-to-self-publish-a-book">self-publishing costs</a> shows typical prices, and our <a href="/pricing">publishing packages</a> bundle formatting with proofreading, a free 3D cover and upload.</p>

<h2 id="bottom-line">The bottom line</h2>
<p>Knowing how to format a book for KDP comes down to a few decisions made in the right order: <strong>finish the edit, choose your trim size, set the gutter for your page count, use bleed only if you need it, embed your fonts, and build a separate reflowable file for Kindle.</strong> Then check every page in the Previewer and hold a printed proof before you publish.</p>
<p>Want files that pass first time? <a href="/contact">Tell us about your book</a> and we’ll send a free, written formatting quote within one business day.</p>
HTML,
];
