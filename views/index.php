<?php
session_start();
require_once __DIR__ . '/backend/languages/langConfig.php';

$isArabic = isset($lang['lang']) && $lang['lang'] === 'ar';
$locale = $isArabic ? 'ar' : 'en';
$copy = $isArabic ? [
    'title' => 'سوق الخرطوم للأوراق المالية | KSE Sudan',
    'description' => 'بوابتك للتعرّف على سوق الأوراق المالية السوداني ومتابعة أخبار السوق.',
    'eyebrow' => 'سوق الخرطوم للأوراق المالية',
    'nav_market' => 'السوق', 'nav_about' => 'عن السوق', 'nav_services' => 'الخدمات', 'nav_contact' => 'تواصل معنا',
    'login' => 'دليل المستثمر', 'hero_tag' => 'بوابتك إلى أسواق السودان',
    'hero_title' => 'استثمر في <span>مستقبل السودان</span>',
    'hero_text' => 'اكتشف سوق الأوراق المالية السوداني، وتعرّف على فرص الاستثمار ومعلومات السوق من مكان واحد.',
    'explore' => 'استكشف السوق', 'learn' => 'تعرّف على KSE', 'market_open' => 'لوحة السوق',
    'market_note' => 'بيانات السوق الحية غير متصلة حالياً', 'market_index' => 'مؤشر السوق', 'market_volume' => 'حجم التداول', 'market_status' => 'حالة السوق',
    'unavailable' => '—', 'status' => 'تحقق من آخر تحديث رسمي', 'disclaimer' => 'واجهة تعريفية تجريبية — لا تعرض أسعاراً أو بيانات تداول حية.',
    'section_label' => 'فرص واعدة، ورؤية أوضح', 'section_title' => 'كل ما تحتاجه لفهم السوق',
    'section_text' => 'مصدر موحّد للتعرّف على سوق المال، وأدوات تساعد المستثمرين على اتخاذ قرارات أكثر وعياً.',
    'feature1_title' => 'معلومات السوق', 'feature1_text' => 'تابع مؤشرات السوق وإعلانات الشركات عند ربط الموقع بمصدر بيانات رسمي.',
    'feature2_title' => 'دليل المستثمر', 'feature2_text' => 'تعرّف على أساسيات الاستثمار وخطوات الوصول إلى المعلومات الموثوقة.',
    'feature3_title' => 'إفصاحات الشركات', 'feature3_text' => 'مكان واضح للأخبار والإفصاحات الرسمية للشركات المدرجة.',
    'about_label' => 'عن السوق', 'about_title' => 'سوق يربط رأس المال بفرص النمو',
    'about_text' => 'تعرّف على سوق الخرطوم للأوراق المالية وخدماته، واستكشف المعلومات الرسمية التي يحتاجها المستثمرون والشركات.',
    'about_cta' => 'تواصل للاستفسار', 'market_label' => 'نظرة السوق', 'market_title' => 'متابعة واضحة، دون ضجيج',
    'market_text' => 'ستظهر هنا بيانات المؤشرات والأسهم عند تفعيل تكامل رسمي مع مصدر بيانات السوق.',
    'table_asset' => 'الأداة', 'table_price' => 'آخر سعر', 'table_change' => 'التغير', 'table_update' => 'التحديث', 'demo' => 'بانتظار ربط البيانات',
    'cta_title' => 'هل تبحث عن معلومة رسمية؟', 'cta_text' => 'تواصل مع السوق مباشرة للحصول على أحدث التفاصيل والإعلانات المعتمدة.',
    'contact' => 'تواصل معنا', 'footer_about' => 'بوابة معلوماتية للتعرّف على سوق الأوراق المالية السوداني.',
    'quick_links' => 'روابط سريعة', 'risk' => 'المحتوى لأغراض التعريف فقط، ولا يُعد نصيحة استثمارية أو عرضاً للتداول.',
    'copyright' => 'جميع الحقوق محفوظة لسوق الخرطوم للأوراق المالية.'
] : [
    'title' => 'Khartoum Stock Exchange | KSE Sudan',
    'description' => 'Your gateway to learn about Sudan’s securities market and follow market information.',
    'eyebrow' => 'KHARTOUM STOCK EXCHANGE',
    'nav_market' => 'Market', 'nav_about' => 'About', 'nav_services' => 'Services', 'nav_contact' => 'Contact',
    'login' => 'Investor guide', 'hero_tag' => 'Your gateway to Sudanese markets',
    'hero_title' => 'Invest in <span>Sudan’s future</span>',
    'hero_text' => 'Discover Sudan’s securities market, explore investment information, and find market resources in one place.',
    'explore' => 'Explore the market', 'learn' => 'Learn about KSE', 'market_open' => 'Market overview',
    'market_note' => 'Live market data is not connected', 'market_index' => 'Market index', 'market_volume' => 'Trading volume', 'market_status' => 'Market status',
    'unavailable' => '—', 'status' => 'Check official updates', 'disclaimer' => 'Preview interface — no live prices or trading data are shown.',
    'section_label' => 'Opportunity with clarity', 'section_title' => 'Everything you need to understand the market',
    'section_text' => 'A central place to learn about the market, with resources to help investors make more informed decisions.',
    'feature1_title' => 'Market information', 'feature1_text' => 'Follow market indices and company announcements when connected to an official data source.',
    'feature2_title' => 'Investor guide', 'feature2_text' => 'Learn the basics of investing and how to find reliable market information.',
    'feature3_title' => 'Company disclosures', 'feature3_text' => 'A clear home for official news and disclosures from listed companies.',
    'about_label' => 'About KSE', 'about_title' => 'Connecting capital with opportunities to grow',
    'about_text' => 'Learn about the Khartoum Stock Exchange and its services, and explore official information for investors and companies.',
    'about_cta' => 'Get in touch', 'market_label' => 'Market snapshot', 'market_title' => 'Clear information, without the noise',
    'market_text' => 'Index and share data will appear here once an official market-data integration is configured.',
    'table_asset' => 'Instrument', 'table_price' => 'Last price', 'table_change' => 'Change', 'table_update' => 'Update', 'demo' => 'Awaiting data connection',
    'cta_title' => 'Looking for official information?', 'cta_text' => 'Contact the exchange directly for the latest verified details and announcements.',
    'contact' => 'Contact us', 'footer_about' => 'An information portal to learn about Sudan’s securities market.',
    'quick_links' => 'Quick links', 'risk' => 'For information only; this is not investment advice or an offer to trade.',
    'copyright' => 'Khartoum Stock Exchange. All rights reserved.'
];
$dir = $isArabic ? 'rtl' : 'ltr';
?>
<!doctype html>
<html lang="<?= htmlspecialchars($locale, ENT_QUOTES, 'UTF-8') ?>" dir="<?= $dir ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= htmlspecialchars($copy['description'], ENT_QUOTES, 'UTF-8') ?>">
  <meta name="theme-color" content="#071b26">
  <title><?= htmlspecialchars($copy['title'], ENT_QUOTES, 'UTF-8') ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&family=Tajawal:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/views/css/style.css">
</head>
<body>
  <div class="announcement"><span class="announcement-dot"></span><?= htmlspecialchars($copy['market_note'], ENT_QUOTES, 'UTF-8') ?><span class="announcement-sep">•</span><?= htmlspecialchars($copy['disclaimer'], ENT_QUOTES, 'UTF-8') ?></div>
  <header class="site-header">
    <div class="container nav-wrap">
      <a class="brand" href="#home" aria-label="KSE Sudan home"><span class="brand-mark"><svg viewBox="0 0 42 42" aria-hidden="true"><path d="M4 31.5 14.5 21l7 7L37 10.5"/><path d="M26 10h11v11"/><path d="M7 37h28"/></svg></span><span class="brand-copy"><strong>KSE<span>.</span></strong><small>KHARTOUM STOCK EXCHANGE</small></span></a>
      <button class="menu-toggle" type="button" aria-label="Open navigation" aria-expanded="false"><span></span><span></span><span></span></button>
      <nav class="main-nav" aria-label="Main navigation"><a href="#market"><?= $copy['nav_market'] ?></a><a href="#about"><?= $copy['nav_about'] ?></a><a href="#services"><?= $copy['nav_services'] ?></a><a href="#contact"><?= $copy['nav_contact'] ?></a></nav>
      <div class="nav-actions"><a class="language-switch" href="?lang=<?= $isArabic ? 'en' : 'ar' ?>"><?= $isArabic ? 'EN' : 'العربية' ?></a><a class="button button-small" href="#contact"><?= $copy['login'] ?><span class="arrow">↗</span></a></div>
    </div>
  </header>
  <main>
    <section class="hero" id="home"><div class="hero-grid container"><div class="hero-copy"><div class="eyebrow"><span class="eyebrow-line"></span><?= $copy['hero_tag'] ?></div><h1><?= $copy['hero_title'] ?></h1><p class="hero-description"><?= $copy['hero_text'] ?></p><div class="hero-buttons"><a class="button" href="#market"><?= $copy['explore'] ?><span class="arrow">↗</span></a><a class="text-link" href="#about"><?= $copy['learn'] ?><span>→</span></a></div><div class="hero-trust"><div class="trust-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3 4.5 6v5.3c0 4.4 3.2 8.3 7.5 9.7 4.3-1.4 7.5-5.3 7.5-9.7V6L12 3Z"/><path d="m8.5 12 2.2 2.2 4.8-5"/></svg></div><span><?= $isArabic ? 'معلومات موثوقة من مصادر السوق الرسمية' : 'Reliable information from official market sources' ?></span></div></div>
      <div class="hero-visual"><div class="visual-glow"></div><div class="chart-card"><div class="chart-head"><div><span class="chart-overline"><?= $copy['market_open'] ?></span><strong><?= $copy['market_index'] ?></strong></div><span class="live-pill"><i></i><?= $isArabic ? 'تجريبي' : 'PREVIEW' ?></span></div><div class="chart-value"><?= $copy['unavailable'] ?><span><?= $isArabic ? 'لا توجد بيانات متصلة' : 'No connected data' ?></span></div><div class="chart-area"><div class="chart-guides"><i></i><i></i><i></i><i></i></div><svg viewBox="0 0 520 175" preserveAspectRatio="none" role="img" aria-label="Decorative market chart illustration"><defs><linearGradient id="fill" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#b9ec55" stop-opacity=".26"/><stop offset="1" stop-color="#b9ec55" stop-opacity="0"/></linearGradient></defs><path class="chart-fill" d="M0 140 C35 128 45 150 78 120 S126 132 153 94 190 118 218 88 250 100 282 62 320 79 348 49 383 73 405 39 445 63 470 28 500 41 520 18 V175 H0Z"/><path class="chart-line" d="M0 140 C35 128 45 150 78 120 S126 132 153 94 190 118 218 88 250 100 282 62 320 79 348 49 383 73 405 39 445 63 470 28 500 41 520 18"/><circle cx="500" cy="41" r="5"/></svg><div class="chart-axis"><span>09:00</span><span>12:00</span><span>15:00</span><span>18:00</span></div></div><div class="chart-footer"><span><?= $copy['market_volume'] ?></span><strong><?= $copy['unavailable'] ?></strong><span class="muted-dot">•</span><span><?= $copy['status'] ?></span></div></div><div class="floating-card"><span class="floating-icon">↗</span><span><small><?= $isArabic ? 'نظرة أوضح' : 'A clearer view' ?></small><strong><?= $isArabic ? 'بيانات موثوقة' : 'Trusted insights' ?></strong></span></div><div class="hero-decoration deco-one"></div><div class="hero-decoration deco-two"></div></div>
    </div><div class="hero-bottom container"><span><?= $isArabic ? 'معلومات السوق في مكان واحد' : 'Market information, all in one place' ?></span><div class="hero-bottom-line"></div><span class="bottom-coordinates">15° 36′ N&nbsp;&nbsp; 32° 32′ E</span></div></section>
    <section class="features section-pad" id="services"><div class="container"><div class="section-heading centered"><span class="section-kicker"><?= $copy['section_label'] ?></span><h2><?= $copy['section_title'] ?></h2><p><?= $copy['section_text'] ?></p></div><div class="feature-grid"><article class="feature-card"><div class="feature-icon icon-lime"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 19V5m0 14h17M7 15l4-5 3 3 6-7"/><path d="M16 6h4v4"/></svg></div><h3><?= $copy['feature1_title'] ?></h3><p><?= $copy['feature1_text'] ?></p><a href="#market" class="card-link"><?= $isArabic ? 'عرض لوحة السوق' : 'View market overview' ?> <span>→</span></a></article><article class="feature-card"><div class="feature-icon icon-blue"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3 4.5 6v5.3c0 4.4 3.2 8.3 7.5 9.7 4.3-1.4 7.5-5.3 7.5-9.7V6L12 3Z"/><path d="M9 12h6m-3-3v6"/></svg></div><h3><?= $copy['feature2_title'] ?></h3><p><?= $copy['feature2_text'] ?></p><a href="#about" class="card-link"><?= $isArabic ? 'ابدأ من هنا' : 'Get started' ?> <span>→</span></a></article><article class="feature-card"><div class="feature-icon icon-gold"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 3h9l4 4v14H6z"/><path d="M14 3v5h5M9 12h7m-7 4h7"/></svg></div><h3><?= $copy['feature3_title'] ?></h3><p><?= $copy['feature3_text'] ?></p><a href="#contact" class="card-link"><?= $isArabic ? 'اعرف المزيد' : 'Learn more' ?> <span>→</span></a></article></div></div></section>
    <section class="about-section section-pad" id="about"><div class="container about-grid"><div class="about-art"><div class="about-art-bg"></div><div class="about-stat"><span class="stat-icon">⌁</span><span><small><?= $isArabic ? 'مركز السوق' : 'Market hub' ?></small><strong><?= $isArabic ? 'الخرطوم، السودان' : 'Khartoum, Sudan' ?></strong></span></div><div class="about-lines"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div><div class="about-caption"><strong>15° 36′ 00″ N</strong><span>KHARTOUM · SUDAN</span></div></div><div class="about-copy"><span class="section-kicker"><?= $copy['about_label'] ?></span><h2><?= $copy['about_title'] ?></h2><p><?= $copy['about_text'] ?></p><ul class="check-list"><li><span>✓</span><?= $isArabic ? 'معلومات واضحة للمستثمرين والشركات' : 'Clear information for investors and companies' ?></li><li><span>✓</span><?= $isArabic ? 'وصول سهل إلى الإعلانات الرسمية' : 'Easy access to official announcements' ?></li><li><span>✓</span><?= $isArabic ? 'تجربة عربية وإنجليزية متجاوبة' : 'Responsive Arabic and English experience' ?></li></ul><a href="#contact" class="button button-dark"><?= $copy['about_cta'] ?><span class="arrow">↗</span></a></div></div></section>
    <section class="market-section section-pad" id="market"><div class="container"><div class="market-heading"><div><span class="section-kicker"><?= $copy['market_label'] ?></span><h2><?= $copy['market_title'] ?></h2><p><?= $copy['market_text'] ?></p></div><span class="data-status"><i></i><?= $copy['demo'] ?></span></div><div class="market-table-wrap"><table class="market-table"><thead><tr><th><?= $copy['table_asset'] ?></th><th><?= $copy['table_price'] ?></th><th><?= $copy['table_change'] ?></th><th><?= $copy['table_update'] ?></th></tr></thead><tbody><tr><td><span class="asset-symbol">KSE</span><span class="asset-name"><?= $isArabic ? 'مؤشر السوق' : 'Market index' ?><small><?= $isArabic ? 'السوق السوداني' : 'Sudan market' ?></small></span></td><td>—</td><td><span class="neutral-change">—</span></td><td><span class="awaiting"><i></i><?= $copy['demo'] ?></span></td></tr><tr><td><span class="asset-symbol symbol-orange">SDG</span><span class="asset-name"><?= $isArabic ? 'بيانات الشركات' : 'Company data' ?><small><?= $isArabic ? 'الإفصاحات الرسمية' : 'Official disclosures' ?></small></span></td><td>—</td><td><span class="neutral-change">—</span></td><td><span class="awaiting"><i></i><?= $copy['demo'] ?></span></td></tr><tr><td><span class="asset-symbol symbol-blue">FX</span><span class="asset-name"><?= $isArabic ? 'معلومات العملات' : 'Currency information' ?><small><?= $isArabic ? 'مرجع معلوماتي' : 'Information reference' ?></small></span></td><td>—</td><td><span class="neutral-change">—</span></td><td><span class="awaiting"><i></i><?= $copy['demo'] ?></span></td></tr></tbody></table></div><p class="table-disclaimer"><?= $copy['disclaimer'] ?></p></div></section>
    <section class="cta-section" id="contact"><div class="container cta-inner"><div><span class="section-kicker"><?= $isArabic ? 'نحن هنا لمساعدتك' : 'We are here to help' ?></span><h2><?= $copy['cta_title'] ?></h2><p><?= $copy['cta_text'] ?></p></div><a class="button button-dark" href="mailto:info@kse.sd"><?= $copy['contact'] ?><span class="arrow">↗</span></a><div class="cta-decoration"></div></div></section>
  </main>
  <footer class="site-footer"><div class="container footer-main"><div class="footer-brand"><a class="brand" href="#home"><span class="brand-mark"><svg viewBox="0 0 42 42" aria-hidden="true"><path d="M4 31.5 14.5 21l7 7L37 10.5"/><path d="M26 10h11v11"/><path d="M7 37h28"/></svg></span><span class="brand-copy"><strong>KSE<span>.</span></strong><small>KHARTOUM STOCK EXCHANGE</small></span></a><p><?= $copy['footer_about'] ?></p></div><div class="footer-links"><strong><?= $copy['quick_links'] ?></strong><a href="#market"><?= $copy['nav_market'] ?></a><a href="#about"><?= $copy['nav_about'] ?></a><a href="#services"><?= $copy['nav_services'] ?></a></div><div class="footer-links"><strong><?= $copy['nav_contact'] ?></strong><a href="mailto:info@kse.sd">info@kse.sd</a><span><?= $isArabic ? 'الخرطوم، السودان' : 'Khartoum, Sudan' ?></span><a href="?lang=<?= $isArabic ? 'en' : 'ar' ?>"><?= $isArabic ? 'English' : 'العربية' ?></a></div></div><div class="container footer-bottom"><span>© <?= date('Y') ?> <?= $copy['copyright'] ?></span><span><?= $copy['risk'] ?></span></div></footer>
  <script>
    const toggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.main-nav');
    toggle.addEventListener('click', () => {
      const open = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!open));
      nav.classList.toggle('is-open', !open);
    });
    nav.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
      nav.classList.remove('is-open'); toggle.setAttribute('aria-expanded', 'false');
    }));
  </script>
</body>
</html>
