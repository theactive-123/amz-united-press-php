<?php
/**
 * AMZ United Press — site content.
 * Everything that appears as text on the website lives here, so you can edit it in one place.
 * Items marked PLACEHOLDER are sample content: replace them with real, verified details before launch.
 */

$D = [

    // Contact details shown in the header, footer and contact page. (PLACEHOLDER: replace with real details.)
    'site' => [
        'name' => 'AMZ United Press',
        'tagline' => 'Ebook writing, editing, design and publishing',
        'url' => '',
        'phone' => '+1 (800) 555-0142',
        'email' => 'hello@amzunitedpress.com',
        'address' => '240 Publishing Lane, Suite 200, Austin, TX 78701',
        'hours' => 'Mon–Fri, 9am–6pm CT',
        'show_placeholder_notes' => false,
        // Offer sticker on the landing pages (/lp/). Set 'on' => false to hide it everywhere.
        // 'ends' is optional, e.g. '30 November' -> shows "Ends 30 November"; empty shows the 'note' text.
        'offer' => ['on' => true, 'top' => 'Super sale', 'big' => '50% OFF', 'note' => 'Limited-time offer', 'ends' => ''],
    ],

    // Portfolio books and review counts supplied for the website.
    'genres' => ['Recent', 'Books'],
    'svcset' => [
        'Editing · Cover design · Publishing',
        'Ghostwriting · Editing · Formatting',
        'Cover design · Formatting · Publishing',
        'Developmental edit · Proofreading · Launch',
    ],
    'work' => [
        [
            't' => 'You Only Die Twice',
            'g' => 'Books',
            'by' => 'Paige Black',
            'r' => 1,
            'v' => 0,
            'image' => '/assets/img/portfolio/You Only Die Twice.jpg',
            'reviews' => null,
            'description' => 'A body in the Cascades leads FBI Agent Avery Carver to a man with two identities. His records point to someone who died seven years earlier. Two grieving families hold the pieces of his hidden life.',
        ],
        [
            't' => 'Dead By Morning',
            'g' => 'Books',
            'by' => 'Paige Black',
            'r' => 1,
            'v' => 0,
            'image' => '/assets/img/portfolio/Dead By Morning.jpg',
            'reviews' => 301,
            'description' => 'FBI Agent Avery Carver has kept a deadly secret for seven years. While hunting a poisoner, she receives a photograph from her past. Someone knows what happened on her honeymoon.',
        ],
        [
            't' => 'Wired In',
            'g' => 'Books',
            'by' => 'Toby Neal',
            'r' => 1,
            'v' => 0,
            'image' => '/assets/img/portfolio/wired-in.jpg',
            'reviews' => 7555,
            'description' => 'FBI hacker Sophie Ang investigates a child kidnapping in Hawaii. Her search uncovers a mysterious vigilante operating online. The case draws her toward the violence she hoped to escape.',
        ],
        [
            't' => 'He Has His Hands on Me',
            'g' => 'Books',
            'by' => 'Aunica Miles',
            'r' => 1,
            'v' => 0,
            'image' => '/assets/img/portfolio/hehashishandsonme.jpg',
            'reviews' => 1,
            'description' => 'Aunica Miles shares encouragement for those facing a traumatic past. She reflects on faith, resilience and finding purpose through hardship. Your beginning does not have to dictate your end.',
        ],
        [
            't' => 'Susan, You\'re The Chosen One',
            'g' => 'Books',
            'by' => 'Lauretta Hignett',
            'r' => 1,
            'v' => 0,
            'image' => '/assets/img/portfolio/Susan.jpg',
            'reviews' => 3559,
            'description' => 'Susan Moore is rebuilding her life after losing everything. Then unexpected visitors declare her the chosen one. What seems like fantasy may be a very real world of magic.',
        ],
        [
            't' => 'Unclean Choices',
            'g' => 'Books',
            'by' => 'Sabrina R. Dennis',
            'r' => 1,
            'v' => 0,
            'image' => '/assets/img/portfolio/Unclean.jpg',
            'reviews' => 4,
            'description' => 'Sabrina R. Dennis reflects on her roots in Detroit and life in Atlanta. Dreams and visions inspire her to begin writing. Her story follows resilience, transformation and a new purpose.',
        ],
        [
            't' => 'The Blood Stone',
            'g' => 'Books',
            'by' => 'Jason J. Nugent',
            'r' => 1,
            'v' => 0,
            'image' => '/assets/img/portfolio/bloodstone.jpg',
            'reviews' => 240,
            'description' => 'Dragonslayer Lailoken seeks a stone that can control dragons. His journey is driven by the mysterious disappearance of his wife. An ancient dragon challenges everything he believes.',
        ],
        [
            't' => 'Tigra',
            'g' => 'Books',
            'by' => 'R.J. Leahy',
            'r' => 1,
            'v' => 0,
            'image' => '/assets/img/portfolio/Tigra.jpg',
            'reviews' => 876,
            'description' => 'Soldier Jeena Garza crash-lands on the desert world of Ararat. There she meets Samson, a gentle creature feared as a beast. Their bond draws her into a battle over the world\'s future.',
        ],
        [
            't' => 'The Reset',
            'g' => 'Books',
            'by' => 'Carter Woods',
            'r' => 1,
            'v' => 0,
            'image' => '/assets/img/portfolio/thereset.jpg',
            'reviews' => 93,
            'description' => 'The power grid collapses without warning in a desert town. Cars stop working and radios carry only static. One woman realizes this is more than an ordinary blackout.',
        ],
        [
            't' => 'Wings of Destiny set',
            'g' => 'Books',
            'by' => 'Karen Kanouse',
            'r' => 1,
            'v' => 0,
            'image' => '/assets/img/portfolio/wingsofdestinyset.jpg',
            'reviews' => 451,
            'description' => 'Zia forms a forbidden bond with a legendary winged horse. Hunted across the kingdom, she must rescue her siblings and face hidden magic. This collection brings together all four fantasy adventures.',
        ],
        [
            't' => 'Becoming Larry',
            'g' => 'Books',
            'by' => 'Phillip R. Zeller',
            'r' => 1,
            'v' => 0,
            'image' => '/assets/img/portfolio/becoming-larry.jpg',
            'reviews' => null,
            'description' => 'Becoming Larry explores the lasting effects of childhood abuse. It examines how early trauma can push a person to breaking point. The story focuses on the consequences of that experience.',
        ],
    ],

    // The four service menus (as in the header). Each service has its own content file in includes/services/{slug}.php
    // and its own page at /services/{slug}. To add a service, create its file and add the slug to the right list below.
    'cats' => [
        [
            'k' => 'write',
            't' => 'Writing Services',
            'help' => 0,
            'd' => 'Ghostwriting and ebook writing services for every genre, from fiction and novels to memoirs, biographies and nonfiction, written in your voice.',
            'slugs' => ['ghostwriting-services', 'ebook-writing-services', 'fiction-writing-services', 'nonfiction-writing-services', 'memoir-writing-services', 'novel-ghostwriting-services', 'biography-writing-services', 'autobiography-writing-services'],
        ],
        [
            'k' => 'publish',
            't' => 'Publishing Services',
            'help' => 3,
            'd' => 'Ebook publishing and Amazon KDP publishing handled for you, from file preparation and metadata to a live listing, with every right and royalty kept in your name.',
            'slugs' => ['publishing-services'],
        ],
        [
            'k' => 'edit',
            't' => 'Editing Services',
            'help' => 1,
            'd' => 'Professional book editing, proofreading and formatting that make your manuscript clear, correct and ready for readers on any screen or page.',
            'slugs' => ['book-editing-services', 'proofreading-services', 'book-formatting-services'],
        ],
        [
            'k' => 'other',
            't' => 'Other Services',
            'help' => 4,
            'd' => 'Book marketing, audiobooks, cover design, video trailers, author websites and content writing that help your book find its readers.',
            'slugs' => ['book-marketing-services', 'audiobook-services', 'blog-writing-services', 'website-content-writing-services', 'book-cover-design-services', 'video-book-trailer-services', 'author-website-design-services', 'article-writing-services'],
        ],
    ],
    'subs' => [], // filled from includes/services/*.php at the bottom of this file

    // "How it works" steps.
    'steps' => [
        [
            't' => 'Share Your Idea',
            'd' => 'Tell us about your book, your readers and your goals. We listen, match you with the right writer or editor for your genre, and send a written plan and quote.',
            'you' => 'Share your idea, draft or goals with us.',
            'we' => 'Recommend the right services and send a written quote.',
            'time' => '1–3 days',
        ],
        [
            't' => 'Professional Writing',
            'd' => 'Your writer turns your ideas into clear, engaging chapters in your voice, or our editors start work on the manuscript you already have.',
            'you' => 'Review chapters and give feedback as they arrive.',
            'we' => 'Write or edit in stages and keep you updated.',
            'time' => '4–12 weeks',
        ],
        [
            't' => 'Editing & Polishing',
            'd' => 'Editors and proofreaders check every page for clarity, flow and accuracy, while designers create your cover and format the interior.',
            'you' => 'Approve the edits, cover and layout.',
            'we' => 'Edit, proofread, design and format the book.',
            'time' => '2–4 weeks',
        ],
        [
            't' => 'Publishing & Launch',
            'd' => 'We make any final changes you ask for, publish your book on Amazon and other stores under your name, and help you plan the launch.',
            'you' => 'Approve the final book and your store listing.',
            'we' => 'Publish, check every listing and support your launch.',
            'time' => '1–2 weeks',
        ],
    ],

    // PLACEHOLDER: sample prices. Replace with your real packages.
    // Publishing packages. Converted from GBP at 1 GBP = 1.3305 USD (XE mid-market, 28 Oct 2026), rounded to whole dollars.
    'prices' => [
        [
            't' => 'Economical Author Package',
            's' => '',
            'p' => '$198',
            'l' => [
                'Professional Proofreading',
                'eBook Formatting & Typesetting',
                'E-Book & Paperback',
                'Publishing on Amazon',
                'Free 3D Book Cover Design',
                'ISBN & Barcode',
                'Print on Demand Setup',
                'Dedicated Project Manager',
                '100% Ownership Rights',
            ],
            'b' => 'Get Started',
            'f' => 0,
        ],
        [
            't' => 'Author Choice Package',
            's' => '',
            'p' => '$531',
            'l' => [
                'Everything in Economical',
                'Professional Proofreading & Editing',
                'Formatting & Typesetting',
                'E-book, Paperback, & Hardcover',
                'Publishing On Top 5 Platforms',
                'Author Central Account Setup',
                'Dedicated Chief Editor',
                'Free 3D Book Cover Design with Unlimited Revisions',
                'ISBN & Barcode',
                'Print on Demand Setup',
                'Dedicated Project Manager',
                '100% Ownership Rights',
            ],
            'b' => 'Get Started',
            'f' => 1,
        ],
        [
            't' => 'Author Bestseller',
            's' => '',
            'p' => '$930',
            'l' => [
                'Professional Proofreading & Editing',
                'Formatting & Typesetting',
                'E-book, Paperback, & Hardcover',
                'Publishing on Top 10+ Platforms',
                'Author Central Account Setup',
                'Press Releases',
                'Social Media Page Creation',
                'Free 3D Book Cover Design with Unlimited Revisions',
                'ISBN & Barcode',
                'Complimentary Author Copies',
                'Print on Demand Setup',
                'Dedicated Project Manager',
                '100% Ownership Rights',
                '100% Royalty Rights',
            ],
            'b' => 'Get Started',
            'f' => 0,
        ],
    ],

    // PLACEHOLDER: sample figures. Replace with verified numbers.
    'stats' => [
        [500, '+', 'Books published'],
        [320, '+', 'Authors served'],
        [12, '', 'Genres covered'],
        [8, '', 'Years in publishing'],
    ],

    // PLACEHOLDER: sample testimonials. Replace with real client quotes, used with permission.
    'testimonials' => [
        [
            'Helen M.',
            'Memoir author',
            'They took my scattered notes and turned them into a book that sounds exactly like me. Every step was explained clearly, and I always knew what came next.',
        ],
        [
            'Daniel R.',
            'Business author',
            'Professional from the first call. The cover and layout looked better than books from big publishers, and the quote I was given never changed.',
        ],
        [
            'Robert K.',
            'Children’s author',
            'As a first-time author I was nervous, but the team was patient and kind. My book was live on Kindle within weeks, and I kept all my rights.',
        ],
    ],

    'values' => [
        ['pen', 'Plain language', 'If we use a publishing term, we explain it. You should never feel lost.'],
        ['shield', 'Honest advice', 'We tell you what we really think of your book, kindly and clearly.'],
        ['clock', 'No surprises', 'You see the scope, timeline and price before any work starts.'],
        ['edit', 'Your voice', 'We help you say it better. We never change who you are on the page.'],
    ],
    'team' => [
        ['G', 'Ghostwriters', 'Interview you, learn your voice and draft your chapters.', 'var(--tint)'],
        ['E', 'Editors', 'Read closely and make every page clear, consistent and correct.', '#FFF1D6'],
        ['D', 'Designers', 'Create covers and layouts that look right on every screen.', '#FFD9A0'],
        ['P', 'Production team', 'Format files, set up stores and check every listing.', '#F3E3C8'],
    ],
    'faq' => [
        'Getting started' => [
            [
                'I have never written or published a book. Can you still help?',
                'Yes. Many of the people we help are first-time authors. We explain each step in plain English so you always know what is happening and why.',
            ],
            [
                'What if I only have an idea, not a draft?',
                'That is a perfectly good place to start. Our writing service can take you from a conversation to a finished manuscript in your own voice.',
            ],
            [
                'What if I’m not sure what I need?',
                'Choose “Other / Not Sure Yet” on the form and tell us a little about your book. We’ll suggest the simplest next step.',
            ],
        ],
        'Cost & timing' => [
            [
                'How much will it cost?',
                'It depends on the length of your book, the services you choose and where you’re starting from. We give you a clear written quote before any work begins. Single services start from $150, and our publishing packages run from $198 to $930.',
            ],
            [
                'How long does it take?',
                'Timelines depend on the services and the length of your book. We agree a schedule with you before work starts. Proofreading takes about a week, and a complete idea-to-publication project usually takes three to five months.',
            ],
            [
                'Do I have to pay everything upfront?',
                'No. Most projects are paid in two or three stages, so you only ever pay for the work that is under way. The schedule is in your written proposal.',
            ],
        ],
        'Your book & rights' => [
            [
                'Do I keep the rights to my book?',
                'That is the intention: it is your book. You own your manuscript, cover and final files once the project is fully paid, and you are the publisher of record on every store listing.',
            ],
            [
                'Will my book still sound like me?',
                'Yes. We help you say it better, never differently. You review everything and can ask for changes.',
            ],
            [
                'Can I see samples of your work?',
                'Yes. See our portfolio, and ask us for more. Ask us for a sample pack and we will send examples of edits, covers and formatted files.',
            ],
        ],
        'Publishing' => [
            [
                'Where will my ebook be sold?',
                'We publish to Amazon Kindle, Apple Books, Kobo and Google Play Books as standard, and can add other stores on request.',
            ],
            [
                'Will you help me tell people about my book?',
                'Yes. Our launch support includes your book description, keywords, an author page and a launch plan. Ongoing promotion is available as a separate service.',
            ],
            [
                'Can I make changes after it is published?',
                'Yes. Corrections and updated editions can be uploaded at any time. Small fixes in the first 30 days after publication are free.',
            ],
        ],
    ],

    // Home page FAQ (also used for the FAQPage schema on the home page).
    'home_faq' => [
        ['What is a self-publishing company?', 'A self-publishing company gives independent authors the professional help a traditional publisher would, without taking your rights. At AMZ United Press that means [[ghostwriting-services|ghostwriting]], editing, cover design, formatting, publishing and marketing, all from one team, while you stay the publisher of record and keep every royalty.'],
        ['What is the difference between a book writer and an author?', 'The author is the person whose name is on the cover and who owns the work. A book writer, often called a ghostwriter, is a professional hired to put the author’s ideas into words. When you hire our writers, you remain the author, and the finished text belongs entirely to you.'],
        ['Is it legal to hire someone to write and publish my ebook?', 'Yes. Hiring a ghostwriter is legal and very common, from business leaders to celebrities. What matters is a clear written agreement on ownership. Our contracts transfer full copyright to you once the project is paid, and our writers work under a signed NDA.'],
        ['How much do your self-publishing services cost?', 'It depends on the length of your book, where you are starting from and which services you choose. Single services such as [[proofreading-services|proofreading]] start from a few hundred dollars, and complete writing-to-publishing projects are quoted individually. You always get a written quote before any work begins. See [[/pricing|our pricing]] for typical packages.'],
        ['Do you produce audiobooks?', 'Yes. Our [[audiobook-services|audiobook production]] service covers narrator casting, recording, editing and mastering to the technical standards of Audible and other audio stores, so your book reaches readers who prefer to listen.'],
        ['Why should I hire an ebook writer?', 'A professional ebook writer helps you finish faster, write with a clear structure and present your ideas in a polished, readable way. It frees you to focus on your expertise or your story while an experienced writer handles the drafting, research and revisions.'],
        ['I’m already a published author. Can you still help?', 'Absolutely. Many of our clients have published before and come to us for a single service, such as [[book-marketing-services|book marketing]], a new cover, a re-edit or an audiobook edition of an existing title.'],
        ['Do you work with authors outside the USA?', 'Yes. We work with authors worldwide by phone, video call and email, and we publish to stores that sell in every major market, including Amazon, Apple Books, Kobo and Google Play Books.'],
        ['Do I keep the rights and royalties to my book?', 'Yes. You keep 100% of your rights and 100% of your royalties. Your book is published under your own account and name, and we never take a share of your sales.'],
        ['How do I get started?', 'Send us a few details through the form or call us. A real person replies within one business day to talk through your book, recommend the simplest route and send a written quote. Nothing starts until you say yes.'],
    ],

    // Options in the "What do you need help with?" menu of every form.
    'help_options' => [
        'Book writing or ghostwriting',
        'Book editing, proofreading or formatting',
        'Book cover design',
        'Ebook or Amazon publishing',
        'Book marketing & promotion',
        'Audiobook, video trailer or author website',
        'Blog, article or website content writing',
        'Everything, from start to finish',
        'Other / Not Sure Yet',
    ],
];

// Load every service page's content, in menu order.
foreach ($D['cats'] as $c) {
    foreach ($c['slugs'] as $slug) {
        $f = __DIR__ . '/services/' . $slug . '.php';
        if (is_file($f)) $D['subs'][] = require $f;
    }
}
return $D;
