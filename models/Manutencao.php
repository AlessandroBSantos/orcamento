<?php

require_once __DIR__ . '/BaseModel.php';

class Manutencao extends BaseModel
{

    /**
     * Lista todas as Ordens de Manutenção
     */
    public function listar()
    {

        $sql = "

            SELECT

                m.*,

                e.codigo,
                e.descricao

            FROM manutencoes m

            INNER JOIN equipamentos e
                ON e.id = m.equipamento_id

            ORDER BY m.id DESC

        ";

        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Busca uma Ordem de Manutenção
     */
    public function buscar(int $id)
    {

        $sql = "

            SELECT

                m.*,

                e.codigo,
                e.descricao

            FROM manutencoes m

            INNER JOIN equipamentos e
                ON e.id = m.equipamento_id

            WHERE m.id = :id

            LIMIT 1

        ";

        return $this->query($sql, [

            'id' => $id

        ])->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Gera automaticamente o número da Ordem
     */
    private function gerarNumeroOS()
    {

        $sql = "

            SELECT MAX(id) AS ultimo

            FROM manutencoes

        ";

        $ultimo = $this->query($sql)->fetch(PDO::FETCH_ASSOC);

        $numero = ((int)$ultimo['ultimo']) + 1;

        return 'OM' . str_pad($numero, 6, '0', STR_PAD_LEFT);

    }

    /**
     * Cadastro de Ordem de Manutenção
     */
    public function cadastrar(array $dados)
    {

        $numeroOS = $this->gerarNumeroOS();

        $sql = "

            INSERT INTO manutencoes
            (

                numero_os,
                equipamento_id,
                usuario_abertura,
                tecnico_id,
                fornecedor_id,
                tipo,
                prioridade,
                defeito_informado,
                diagnostico,
                servico_executado,
                observacoes,
                valor_pecas,
                valor_mao_obra,
                valor_total,
                status,
                data_abertura

            )

            VALUES
            (

                :numero_os,
                :equipamento_id,
                :usuario_abertura,
                :tecnico_id,
                :fornecedor_id,
                :tipo,
                :prioridade,
                :defeito_informado,
                :diagnostico,
                :servico_executado,
                :observacoes,
                :valor_pecas,
                :valor_mao_obra,
                :valor_total,
                'ABERTA',
                NOW()

            )

        ";

        $this->query($sql, [

            'numero_os'         => $numeroOS,
            'equipamento_id'    => $dados['equipamento_id'],
            'usuario_abertura'  => $dados['usuario_abertura'],
            'tecnico_id'        => $dados['tecnico_id'],
            'fornecedor_id'     => $dados['fornecedor_id'],
            'tipo'              => $dados['tipo'],
            'prioridade'        => $dados['prioridade'],
            'defeito_informado' => $dados['defeito_informado'],
            'diagnostico'       => $dados['diagnostico'],
            'servico_executado' => $dados['servico_executado'],
            'observacoes'       => $dados['observacoes'],
            'valor_pecas'       => $dados['valor_pecas'],
            'valor_mao_obra'    => $dados['valor_mao_obra'],
            'valor_total'       => $dados['valor_total']

        ]);

        return $this->db->lastInsertId();

    }
        /**
     * Atualiza uma Ordem de Manutenção
     */
    public function atualizar(array $dados)
    {

        $sql = "

            UPDATE manutencoes

            SET

                equipamento_id      = :equipamento_id,
                tecnico_id          = :tecnico_id,
                fornecedor_id       = :fornecedor_id,
                tipo                = :tipo,
                prioridade          = :prioridade,
                defeito_informado   = :defeito_informado,
                diagnostico         = :diagnostico,
                servico_executado   = :servico_executado,
                observacoes         = :observacoes,
                valor_pecas         = :valor_pecas,
                valor_mao_obra      = :valor_mao_obra,
                valor_total         = :valor_total

            WHERE

                id = :id

        ";

        return $this->query($sql,[

            'id'                 => $dados['id'],
            'equipamento_id'     => $dados['equipamento_id'],
            'tecnico_id'         => $dados['tecnico_id'],
            'fornecedor_id'      => $dados['fornecedor_id'],
            'tipo'               => $dados['tipo'],
            'prioridade'         => $dados['prioridade'],
            'defeito_informado'  => $dados['defeito_informado'],
            'diagnostico'        => $dados['diagnostico'],
            'servico_executado'  => $dados['servico_executado'],
            'observacoes'        => $dados['observacoes'],
            'valor_pecas'        => $dados['valor_pecas'],
            'valor_mao_obra'     => $dados['valor_mao_obra'],
            'valor_total'        => $dados['valor_total']

        ]);

    }

    /**
     * Altera o status da Ordem
     */
    public function alterarStatus(int $id, string $status)
    {

        $sql = "

            UPDATE manutencoes

            SET

                status = :status

            WHERE

                id = :id

        ";

        $this->query($sql,[

            'status' => $status,
            'id'     => $id

        ]);

        return true;

    }

    /**
     * Finaliza a Ordem
     */
    public function finalizar(int $id)
    {

        $sql = "

            UPDATE manutencoes

            SET

                status = 'FINALIZADA',

                data_fim = NOW()

            WHERE

                id = :id

        ";

        $this->query($sql,[

            'id' => $id

        ]);

        return true;

    }
        /**
     * Cancela uma Ordem de Manutenção
     */
    public function cancelar(int $id)
    {

        $sql = "

            UPDATE manutencoes

            SET

                status = 'CANCELADA'

            WHERE

                id = :id

        ";

        $this->query($sql, [

            'id' => $id

        ]);

        return true;

    }

    /**
     * Lista Ordens por Status
     */
    public function buscarPorStatus(string $status)
    {

        $sql = "

            SELECT

                m.*,
                e.codigo,
                e.descricao

            FROM manutencoes m

            INNER JOIN equipamentos e
                ON e.id = m.equipamento_id

            WHERE

                m.status = :status

            ORDER BY

                m.data_abertura DESC,
                m.id DESC

        ";

        return $this->query($sql, [

            'status' => $status

        ])->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Dashboard da Manutenção
     */
    public function dashboard()
    {

        $sql = "

            SELECT

                COUNT(*) AS total,

                SUM(CASE WHEN status='ABERTA' THEN 1 ELSE 0 END) AS abertas,

                SUM(CASE WHEN status='EM_ANALISE' THEN 1 ELSE 0 END) AS analise,

                SUM(CASE WHEN status='AGUARDANDO_PECA' THEN 1 ELSE 0 END) AS aguardando,

                SUM(CASE WHEN status='EM_MANUTENCAO' THEN 1 ELSE 0 END) AS manutencao,

                SUM(CASE WHEN status='TESTE' THEN 1 ELSE 0 END) AS teste,

                SUM(CASE WHEN status='FINALIZADA' THEN 1 ELSE 0 END) AS finalizadas,

                SUM(CASE WHEN status='CANCELADA' THEN 1 ELSE 0 END) AS canceladas

            FROM manutencoes

        ";

        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Total de Ordens
     */
    public function total()
    {

        $sql = "

            SELECT COUNT(*) AS total

            FROM manutencoes

        ";

        $resultado = $this->query($sql)->fetch(PDO::FETCH_ASSOC);

        return (int) $resultado['total'];

    }

}