<!--
=====================================================
Fim do Conteúdo Principal

Encerra a área principal (<main>) da página.

A partir deste ponto são carregados:
- Rodapé do sistema.
- Arquivos JavaScript globais.
- Arquivos JavaScript específicos da página.
=====================================================
-->

</main>

<!--
=====================================================
Rodapé

Inclui o arquivo footer.php responsável
por exibir o rodapé padrão do sistema.
=====================================================
-->
<?php include __DIR__ . '/footer.php'; ?>

<!-- =====================================================
     JavaScript Global

     Scripts carregados em todas as páginas
     do sistema.

     O parâmetro ?v=filemtime() utiliza a data
     de modificação do arquivo para evitar
     problemas de cache no navegador.
====================================================== -->

<script src="<?= BASE_URL ?>/assets/js/utils.js?v=<?= filemtime(__DIR__ . '/../assets/js/utils.js') ?>"></script>

<script src="<?= BASE_URL ?>/assets/js/app.js?v=<?= filemtime(__DIR__ . '/../assets/js/app.js') ?>"></script>

<!-- =====================================================
     JavaScript específico da página

     Percorre o array $scripts carregando
     automaticamente todos os arquivos JS
     necessários para a página atual.

     Cada arquivo recebe um parâmetro de versão
     baseado na data de modificação (filemtime),
     garantindo que o navegador sempre utilize
     a versão mais recente.
====================================================== -->

<?php foreach ($scripts as $script): ?>

<script
    src="<?= BASE_URL ?>/assets/js/<?= htmlspecialchars($script) ?>?v=<?= filemtime(__DIR__ . '/../assets/js/' . $script) ?>">
</script>

<?php endforeach; ?>

<!-- Final do corpo da página -->
</body>

<!-- Final do documento HTML -->
</html>