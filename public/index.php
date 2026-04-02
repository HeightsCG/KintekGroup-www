<?php
$submitted = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    if ($email) {
        $dir  = dirname(__DIR__) . '/data';
        $file = $dir . '/signups.csv';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $new = !file_exists($file);
        $fh  = fopen($file, 'a');
        if ($fh) {
            if ($new) fputcsv($fh, ['email', 'date', 'ip']);
            fputcsv($fh, [$email, date('Y-m-d H:i:s'), $_SERVER['REMOTE_ADDR'] ?? '']);
            fclose($fh);
            $submitted = true;
        } else {
            $error = 'Could not save your email. Please try again.';
        }
    } else {
        $error = 'Please enter a valid email address.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kintek Group — Something Big Is Coming</title>

    <!-- SEO -->
    <meta name="description" content="Kintek Group is relaunching. Be the first to know when we lift the curtain. Sign up for early access updates.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.kintekgroup.com/">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.kintekgroup.com/">
    <meta property="og:site_name" content="Kintek Group">
    <meta property="og:title" content="Kintek Group — Something Big Is Coming">
    <meta property="og:description" content="Kintek Group is relaunching. Be the first to know when we lift the curtain. Sign up for early access updates.">
    <meta property="og:image" content="https://www.kintekgroup.com/images/spartan-helmet.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Kintek Group — Something Big Is Coming">
    <meta name="twitter:description" content="Kintek Group is relaunching. Be the first to know when we lift the curtain.">
    <meta name="twitter:image" content="https://www.kintekgroup.com/images/spartan-helmet.jpg">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,600;1,300&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Organization",
                "@id": "https://www.kintekgroup.com/#organization",
                "name": "Kintek Group",
                "url": "https://www.kintekgroup.com/",
                "logo": "https://www.kintekgroup.com/images/KG-logo.png",
                "sameAs": []
            },
            {
                "@type": "WebSite",
                "@id": "https://www.kintekgroup.com/#website",
                "url": "https://www.kintekgroup.com/",
                "name": "Kintek Group",
                "publisher": { "@id": "https://www.kintekgroup.com/#organization" }
            },
            {
                "@type": "WebPage",
                "@id": "https://www.kintekgroup.com/#webpage",
                "url": "https://www.kintekgroup.com/",
                "name": "Kintek Group — Something Big Is Coming",
                "description": "Kintek Group is relaunching. Be the first to know when we lift the curtain.",
                "isPartOf": { "@id": "https://www.kintekgroup.com/#website" }
            }
        ]
    }
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YXBKSB10LB"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-YXBKSB10LB');
    </script>
</head>
<body>

    <img src="/images/spartan-helmet.jpg" alt="Kintek Group" class="spartan-helmet">

    <div class="noise"></div>

    <header class="site-header">
        <span class="wordmark">
            <span class="kintek">KINTEK</span> <span class="group">GROUP</span>
        </span>
        <div class="header-right">
            <button class="cta-btn" onclick="document.getElementById('modal').classList.add('open')">
                Get Notified
            </button>
        </div>
    </header>

    <main class="hero">

        <div class="hero-eyebrow">
            <span class="dot"></span>
            <span class="eyebrow-text">Relaunch in progress</span>
        </div>

    </main>

    <!-- Modal -->
    <div class="modal-overlay" id="modal" onclick="if(event.target===this)this.classList.remove('open')">
        <div class="modal">
            <button class="modal-close" onclick="document.getElementById('modal').classList.remove('open')" aria-label="Close">&times;</button>

            <?php if ($submitted): ?>
            <div class="success-message">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span>You&rsquo;re on the list. Stay tuned.</span>
            </div>
            <?php else: ?>
            <h2 class="modal-heading">Be the first to know.</h2>
            <p class="modal-subtext">Something significant is being built. Drop your email and we&rsquo;ll signal you when the curtain lifts.</p>
            <form method="POST" action="">
                <div class="input-group">
                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                        autocomplete="email"
                        <?php if ($error): ?>aria-describedby="email-error"<?php endif; ?>
                    >
                    <button type="submit">Notify Me</button>
                </div>
                <?php if ($error): ?>
                <p class="form-error" id="email-error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <p class="form-note">No spam. No spoilers. Just the signal when it&rsquo;s time.</p>
            </form>
            <?php endif; ?>
        </div>
    </div><?php if ($submitted): ?><script>document.getElementById('modal').classList.add('open');</script><?php endif; ?>

    <footer class="site-footer">
        <p>&copy; <?= date('Y') ?> Kintek Group. All rights reserved.</p>
    </footer>


</body>
</html>
