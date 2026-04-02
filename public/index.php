<?php
$submitted = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    if ($email) {
        // TODO: persist $email (e.g. database insert or Mailchimp API call)
        $submitted = true;
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,600;1,300&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <div class="noise"></div>

    <header class="site-header">
        <span class="wordmark">KINTEK GROUP</span>
        <span class="badge">UNCLASSIFIED</span>
    </header>

    <main class="hero">

        <div class="hero-eyebrow">
            <span class="dot"></span>
            <span>Relaunch in progress</span>
        </div>

        <p class="hero-subtext">
            Something significant is being built behind closed doors.<br>
            Be among the first to know when we lift the curtain.
        </p>

        <?php if ($submitted): ?>
        <div class="success-message">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            <span>You&rsquo;re on the list. Stay tuned.</span>
        </div>
        <?php else: ?>
        <form class="email-form" method="POST" action="">
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

    </main>

    <footer class="site-footer">
        <p>&copy; <?= date('Y') ?> Kintek Group. All rights reserved.</p>
    </footer>


</body>
</html>
