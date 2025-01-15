<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Default Title' ?></title>
    
    <!-- Společné CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main>
        <?= $content ?>
    </main>
    <!-- Dynamické JS -->
    <?php if (isset($script)): ?>
        <script src="<?= $script ?>"></script>
    <?php endif; ?>
</body>
</html>
