<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa - Acara 13</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>
    <?php include __DIR__ . '/../partials/navbar.php'; ?>
    <main class="container mt-4">
        <?php include __DIR__ . '/../partials/flash.php'; ?><!-- ===== TUGAS MANDIRI ===== -->
        <?php require $content; ?>
    </main>
    <?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>