<tbody>

<?php if (empty($estoque)): ?>

    <tr>
        <td colspan="10" class="text-center">
            Nenhum produto encontrado no estoque.
        </td>
    </tr>

<?php else: ?>

    <?php foreach ($estoque as $item): ?>

        <?php

        if ($item['quantidade_atual'] <= 0) {

            $status = '<span class="badge bg-danger">Sem Estoque</span>';

        } elseif ($item['quantidade_atual'] <= $item['estoque_minimo']) {

            $status = '<span class="badge bg-warning text-dark">Estoque Baixo</span>';

        } elseif (
            $item['estoque_maximo'] > 0 &&
            $item['quantidade_atual'] > $item['estoque_maximo']
        ) {

            $status = '<span class="badge bg-info">Acima do Máximo</span>';

        } else {

            $status = '<span class="badge bg-success">Normal</span>';

        }

        ?>

        <tr>

            <td><?= htmlspecialchars($item['codigo']) ?></td>

            <td><?= htmlspecialchars($item['nome']) ?></td>

            <td class="text-center"><?= number_format($item['quantidade_atual'], 3, ',', '.') ?></td>

            <td class="text-center"><?= number_format($item['quantidade_reservada'], 3, ',', '.') ?></td>

            <td class="text-center"><?= number_format($item['disponivel'], 3, ',', '.') ?></td>

            <td class="text-center"><?= number_format($item['estoque_minimo'], 3, ',', '.') ?></td>

            <td class="text-center"><?= number_format($item['estoque_maximo'], 3, ',', '.') ?></td>

            <td><?= htmlspecialchars($item['localizacao'] ?? '') ?></td>

            <td><?= $status ?></td>

            <td>

                <a href="entrada.php?id=<?= $item['produto_id'] ?>"
                   class="btn btn-success btn-sm">
                    Entrada
                </a>

                <a href="saida.php?id=<?= $item['produto_id'] ?>"
                   class="btn btn-danger btn-sm">
                    Saída
                </a>

            </td>

        </tr>

    <?php endforeach; ?>

<?php endif; ?>

</tbody>