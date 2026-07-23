<!--
=====================================================
LLA ERP
Rodapé (Footer)

Este componente exibe o rodapé padrão do sistema.

Informações apresentadas:
- Nome do sistema.
- Ano atual obtido automaticamente pelo PHP.

O ano é atualizado dinamicamente utilizando
a função date('Y'), dispensando alterações
manuais a cada novo ano.
=====================================================
-->

<footer class="footer">

    <!--
        Exibe o nome do sistema seguido
        do ano atual.
    -->
    LLA ERP Comercial © <?= date('Y') ?>

</footer>