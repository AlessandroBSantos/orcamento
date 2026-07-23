</main>

<?php include __DIR__ . '/footer.php'; ?>

<!-- =====================================================
     JavaScript Global
====================================================== -->

<script src="<?= BASE_URL ?>/assets/js/utils.js?v=<?= filemtime(__DIR__ . '/../assets/js/utils.js') ?>"></script>

<script src="<?= BASE_URL ?>/assets/js/app.js?v=<?= filemtime(__DIR__ . '/../assets/js/app.js') ?>"></script>

<!-- =====================================================
     JavaScript específico da página
====================================================== -->

<?php foreach ($scripts as $script): ?>

<script
    src="<?= BASE_URL ?>/assets/js/<?= htmlspecialchars($script) ?>?v=<?= filemtime(__DIR__ . '/../assets/js/' . $script) ?>">
</script>

<?php endforeach; ?>

</body>

</html>