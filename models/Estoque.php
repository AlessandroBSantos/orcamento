<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Model Estoque
|--------------------------------------------------------------------------
|
| Esta classe é responsável pelo gerenciamento do
| estoque de produtos do sistema.
|
| Segue o padrão MVC (Model-View-Controller),
| sendo responsável pelo acesso à tabela de estoque
| e ao histórico de movimentações.
|
| Funcionalidades:
| - Listar estoque.
| - Consultar estoque por produto.
| - Registrar entradas.
| - Registrar saídas.
| - Consultar histórico de movimentações.
|--------------------------------------------------------------------------
*/

//
// Carrega a classe BaseModel,
// responsável pela conexão com o banco
// e pelos métodos comuns de consulta.
//
require_once __DIR__ . '/BaseModel.php';

class Estoque extends BaseModel
{

    /**
     * Lista todos os produtos do estoque
     *
     * Retorna todos os produtos ativos
     * juntamente com as informações
     * de estoque disponíveis.
     */
    public function listar()
    {

        //
        // Consulta SQL responsável por listar
        // os produtos cadastrados no estoque.
        //
        $sql = "
            SELECT
                e.id,
                e.produto_id,
                p.codigo,
                p.nome,
                e.quantidade_atual,
                e.quantidade_reservada,
                (e.quantidade_atual - e.quantidade_reservada) AS disponivel,
                e.estoque_minimo,
                e.estoque_maximo,
                e.localizacao,
                e.lote,
                e.numero_serie,
                e.ultima_movimentacao
            FROM estoque e
            INNER JOIN produtos p
                ON p.id = e.produto_id
            WHERE p.ativo = 1
            ORDER BY p.nome
        ";

        //
        // Executa a consulta e retorna
        // todos os registros encontrados.
        //
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Busca um produto do estoque
     *
     * Localiza as informações de estoque
     * de um produto específico através
     * do seu identificador.
     */
    public function buscarPorProduto(int $produtoId)
    {

        //
        // Consulta SQL responsável por localizar
        // um produto específico no estoque.
        //
        $sql = "
            SELECT
                e.*,
                e.produto_id,
                p.codigo,
                p.nome
            FROM estoque e
            INNER JOIN produtos p
                ON p.id = e.produto_id
            WHERE e.produto_id = :produto_id
            LIMIT 1
        ";

        //
        // Executa a consulta utilizando
        // o ID do produto informado
        // e retorna apenas um registro.
        //
        return $this->query($sql, [
            'produto_id' => $produtoId
        ])->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Entrada de estoque
     */
        /**
     * Entrada de estoque
     *
     * Registra uma entrada de produtos no estoque.
     *
     * O processo é executado dentro de uma transação
     * do banco de dados para garantir que todas as
     * operações sejam concluídas com sucesso ou,
     * em caso de erro, desfeitas integralmente.
     *
     * Etapas realizadas:
     * - Bloqueia o registro do estoque.
     * - Obtém o saldo atual.
     * - Calcula o novo saldo.
     * - Atualiza o estoque.
     * - Registra a movimentação.
     * - Confirma a transação.
     */
    public function entrada(array $dados)
    {

        //
        // Inicia uma transação no banco
        // para garantir a integridade
        // das informações.
        //
        $this->db->beginTransaction();

        try {

            //
            // Consulta SQL responsável por
            // bloquear o registro do estoque
            // durante a atualização.
            //
            $sql = "
                SELECT quantidade_atual
                FROM estoque
                WHERE produto_id = :produto_id
                FOR UPDATE
            ";

            //
            // Prepara a consulta SQL.
            //
            $stmt = $this->db->prepare($sql);

            //
            // Executa a consulta utilizando
            // o produto informado.
            //
            $stmt->execute([
                'produto_id' => $dados['produto_id']
            ]);

            //
            // Recupera o estoque atual.
            //
            $estoque = $stmt->fetch(PDO::FETCH_ASSOC);

            //
            // Caso o produto não exista
            // gera uma exceção.
            //
            if (!$estoque) {

                throw new Exception("Produto não encontrado.");

            }

            //
            // Quantidade existente antes
            // da movimentação.
            //
            $estoqueAnterior = (float)$estoque['quantidade_atual'];

            //
            // Calcula o novo saldo
            // após a entrada.
            //
            $estoqueAtual = $estoqueAnterior + $dados['quantidade'];

            //
            // Atualiza a quantidade disponível
            // no estoque.
            //
            $sql = "
                UPDATE estoque
                SET
                    quantidade_atual = :quantidade,
                    ultima_movimentacao = NOW()
                WHERE produto_id = :produto_id
            ";

            //
            // Prepara a atualização.
            //
            $stmt = $this->db->prepare($sql);

            //
            // Executa a atualização.
            //
            $stmt->execute([

                // Novo saldo disponível.
                'quantidade' => $estoqueAtual,

                // Produto atualizado.
                'produto_id' => $dados['produto_id']

            ]);

            //
            // SQL responsável por registrar
            // o histórico da movimentação.
            //
            $sql = "
                INSERT INTO movimentacoes_estoque (
                    produto_id,
                    usuario_id,
                    fornecedor_id,
                    tipo,
                    documento,
                    quantidade,
                    valor_unitario,
                    valor_total,
                    estoque_anterior,
                    estoque_atual,
                    lote,
                    numero_serie,
                    observacoes,
                    data_movimentacao
                )
                VALUES (
                    :produto_id,
                    :usuario_id,
                    :fornecedor_id,
                    'ENTRADA',
                    :documento,
                    :quantidade,
                    :valor_unitario,
                    :valor_total,
                    :estoque_anterior,
                    :estoque_atual,
                    :lote,
                    :numero_serie,
                    :observacoes,
                    NOW()
                )
            ";

            //
            // Prepara o registro
            // da movimentação.
            //
            $stmt = $this->db->prepare($sql);

            //
            // Executa a gravação
            // do histórico.
            //
            $stmt->execute([

                // Produto movimentado.
                'produto_id' => $dados['produto_id'],

                // Usuário responsável.
                'usuario_id' => $dados['usuario_id'],

                // Fornecedor relacionado.
                'fornecedor_id' => $dados['fornecedor_id'],

                // Documento fiscal ou interno.
                'documento' => $dados['documento'],

                // Quantidade recebida.
                'quantidade' => $dados['quantidade'],

                // Valor unitário.
                'valor_unitario' => $dados['valor_unitario'],

                // Valor total da movimentação.
                'valor_total' => $dados['valor_unitario'] * $dados['quantidade'],

                // Estoque antes da entrada.
                'estoque_anterior' => $estoqueAnterior,

                // Estoque após a entrada.
                'estoque_atual' => $estoqueAtual,

                // Número do lote.
                'lote' => $dados['lote'],

                // Número de série.
                'numero_serie' => $dados['numero_serie'],

                // Observações adicionais.
                'observacoes' => $dados['observacoes']

            ]);

            //
            // Confirma todas as alterações
            // realizadas na transação.
            //
            $this->db->commit();

            //
            // Retorna sucesso.
            //
            return true;

        } catch (Exception $e) {

            //
            // Em caso de erro desfaz todas
            // as alterações realizadas.
            //
            $this->db->rollBack();

            //
            // Repassa a exceção para que
            // seja tratada pela aplicação.
            //
            throw $e;

        }

    }

    /**
     * Saída de estoque
     */
        /**
     * Saída de estoque
     *
     * Registra uma saída de produtos do estoque.
     *
     * Todo o processo é executado dentro de uma
     * transação do banco de dados para garantir
     * a integridade das informações.
     *
     * Etapas realizadas:
     * - Bloqueia o registro do estoque.
     * - Obtém o saldo atual.
     * - Valida se existe quantidade suficiente.
     * - Calcula o novo saldo.
     * - Atualiza o estoque.
     * - Registra a movimentação.
     * - Confirma a transação.
     */
    public function saida(array $dados)
    {

        //
        // Inicia uma transação para garantir
        // que todas as operações sejam
        // executadas com segurança.
        //
        $this->db->beginTransaction();

        try {

            //
            // Consulta SQL responsável por bloquear
            // o registro do estoque durante
            // a movimentação.
            //
            $sql = "
                SELECT quantidade_atual
                FROM estoque
                WHERE produto_id = :produto_id
                FOR UPDATE
            ";

            //
            // Prepara a consulta SQL.
            //
            $stmt = $this->db->prepare($sql);

            //
            // Executa a consulta utilizando
            // o produto informado.
            //
            $stmt->execute([
                'produto_id' => $dados['produto_id']
            ]);

            //
            // Recupera os dados atuais
            // do estoque.
            //
            $estoque = $stmt->fetch(PDO::FETCH_ASSOC);

            //
            // Caso o produto não exista,
            // interrompe o processo.
            //
            if (!$estoque) {

                throw new Exception("Produto não encontrado.");

            }

            //
            // Quantidade existente antes
            // da saída.
            //
            $estoqueAnterior = (float)$estoque['quantidade_atual'];

            //
            // Verifica se existe saldo suficiente
            // para atender à solicitação.
            //
            if ($dados['quantidade'] > $estoqueAnterior) {

                throw new Exception("Estoque insuficiente.");

            }

            //
            // Calcula o saldo após
            // a saída do produto.
            //
            $estoqueAtual = $estoqueAnterior - $dados['quantidade'];

            //
            // Atualiza a quantidade disponível
            // no estoque.
            //
            $sql = "
                UPDATE estoque
                SET
                    quantidade_atual = :quantidade,
                    ultima_movimentacao = NOW()
                WHERE produto_id = :produto_id
            ";

            //
            // Prepara a atualização.
            //
            $stmt = $this->db->prepare($sql);

            //
            // Executa a atualização.
            //
            $stmt->execute([

                // Novo saldo disponível.
                'quantidade' => $estoqueAtual,

                // Produto atualizado.
                'produto_id' => $dados['produto_id']

            ]);

            //
            // SQL responsável por registrar
            // o histórico da saída.
            //
            $sql = "
                INSERT INTO movimentacoes_estoque (
                    produto_id,
                    usuario_id,
                    fornecedor_id,
                    tipo,
                    documento,
                    quantidade,
                    valor_unitario,
                    valor_total,
                    estoque_anterior,
                    estoque_atual,
                    lote,
                    numero_serie,
                    observacoes,
                    data_movimentacao
                )

                VALUES (
                    :produto_id,
                    :usuario_id,
                    :fornecedor_id,
                    'SAIDA',
                    :documento,
                    :quantidade,
                    :valor_unitario,
                    :valor_total,
                    :estoque_anterior,
                    :estoque_atual,
                    :lote,
                    :numero_serie,
                    :observacoes,
                    NOW()
                )
            ";

            //
            // Prepara o registro da movimentação.
            //
            $stmt = $this->db->prepare($sql);

            //
            // Executa a gravação do histórico.
            //
            $stmt->execute([

                // Produto movimentado.
                'produto_id' => $dados['produto_id'],

                // Usuário responsável pela operação.
                'usuario_id' => $dados['usuario_id'],

                // Fornecedor relacionado.
                'fornecedor_id' => $dados['fornecedor_id'],

                // Documento fiscal ou interno.
                'documento' => $dados['documento'],

                // Quantidade movimentada.
                'quantidade' => $dados['quantidade'],

                // Valor unitário.
                'valor_unitario' => $dados['valor_unitario'],

                // Valor total da movimentação.
                'valor_total' => $dados['valor_unitario'] * $dados['quantidade'],

                // Estoque antes da saída.
                'estoque_anterior' => $estoqueAnterior,

                // Estoque após a saída.
                'estoque_atual' => $estoqueAtual,

                // Número do lote.
                'lote' => $dados['lote'],

                // Número de série.
                'numero_serie' => $dados['numero_serie'],

                // Observações da movimentação.
                'observacoes' => $dados['observacoes']

            ]);

            //
            // Confirma todas as alterações
            // realizadas na transação.
            //
            $this->db->commit();

            //
            // Retorna sucesso.
            //
            return true;

        } catch (Exception $e) {

            //
            // Em caso de erro, desfaz todas
            // as alterações realizadas.
            //
            $this->db->rollBack();

            //
            // Repassa a exceção para tratamento
            // pela aplicação.
            //
            throw $e;

        }

    }

    /**
     * Histórico das movimentações
     */
        /**
     * Histórico das movimentações
     *
     * Retorna todas as movimentações de estoque
     * registradas no sistema.
     *
     * A consulta reúne informações da movimentação,
     * do produto e do usuário responsável pela
     * operação, ordenando os registros do mais
     * recente para o mais antigo.
     */
    public function listarMovimentacoes()
    {

        //
        // Consulta SQL responsável por listar
        // todas as movimentações do estoque.
        //
        $sql = "

            SELECT
                m.id,
                m.tipo,
                m.documento,
                m.quantidade,
                m.valor_unitario,
                m.valor_total,
                m.estoque_anterior,
                m.estoque_atual,
                m.observacoes,
                m.data_movimentacao,
                p.codigo,
                p.nome,
                u.nome AS usuario
            FROM movimentacoes_estoque m
            INNER JOIN produtos p
                ON p.id = m.produto_id
            LEFT JOIN usuarios u
                ON u.id = m.usuario_id
            ORDER BY
                m.data_movimentacao DESC,
                m.id DESC

        ";

        //
        // Executa a consulta e retorna
        // todas as movimentações encontradas.
        //
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

}

/*
|--------------------------------------------------------------------------
| Fim da Classe Estoque
|--------------------------------------------------------------------------
|
| Este Model concentra todas as operações relacionadas
| ao controle de estoque do LLA ERP, incluindo:
|
| • Listagem dos produtos em estoque
| • Consulta de estoque por produto
| • Registro de entradas
| • Registro de saídas
| • Controle transacional utilizando PDO
| • Registro do histórico de movimentações
| • Consulta completa das movimentações
|
| As operações de entrada e saída utilizam transações
| do banco de dados (beginTransaction, commit e
| rollBack), garantindo consistência dos dados e
| integridade das movimentações de estoque.
|
| A classe herda BaseModel, reutilizando a conexão
| PDO e os métodos comuns de acesso ao banco de
| dados do LLA ERP.
|--------------------------------------------------------------------------
*/