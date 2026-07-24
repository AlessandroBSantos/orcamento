<?php

require_once __DIR__ . '/BaseModel.php';

class Manutencao extends BaseModel
{

    /**
     * Lista todas as manutenções
     */
    public function listar()
    {

        $sql = "

            SELECT$sql = "

INSERT INTO manutencao_historico
(
    manutencao_id,
    usuario_id,
    status,
    descricao
)

VALUES
(
    :manutencao,
    :usuario,
    :status,
    :descricao
)

";

$stmt = $db->prepare($sql);

$stmt->execute([

    'manutencao' => $idManutencao,

    'usuario' => $_SESSION['usuario_id'] ?? null,

    'status' => 'ABERTA',

    'descricao' => 'Ordem de manutenção criada.'

]);

                m.*,

                e.codigo,
                e.descricao

            FROM manutencoes m

            INNER JOIN equipamentos e
                ON e.id = m.equipamento_id

            ORDER BY

                m.id DESC

        ";

        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Busca manutenção
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
                ON e.id=m.equipamento_id

            WHERE

                m.id=:id

            LIMIT 1

        ";

        return $this->query($sql,[

            'id'=>$id

        ])->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Gera número da OS
     */
    public function gerarNumeroOS()
    {

        $sql="

            SELECT MAX(id) ultimo

            FROM manutencoes

        ";

        $ultimo=$this->query($sql)->fetch(PDO::FETCH_ASSOC);

        $numero=((int)$ultimo['ultimo'])+1;

        return "OM".str_pad($numero,6,"0",STR_PAD_LEFT);

    }

    /**
     * Nova manutenção
     */
    public function cadastrar(array $dados)
    {

        $numeroOS=$this->gerarNumeroOS();

        $sql="

        INSERT INTO manutencoes(

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

            descricao,

            valor_pecas,

            valor_mao_obra,

            valor_total,

            status

        )

        VALUES(

            :numero_os,

            :equipamento_id,

            :usuario_abertura,

            :tecnico_id,

            :fornecedor_id,

            :tipo,

            :prioridade,

            :defeito,

            :diagnostico,

            :servico,

            :observacoes,

            :valor_pecas,

            :valor_mao,

            :valor_total,

            'ABERTA'

        )

        ";

        $this->query($sql,[

            'numero_os'=>$numeroOS,

            'equipamento_id'=>$dados['equipamento_id'],

            'usuario_abertura'=>$dados['usuario_abertura'],

            'tecnico_id'=>$dados['tecnico_id'],

            'fornecedor_id'=>$dados['fornecedor_id'],

            'tipo'=>$dados['tipo'],

            'prioridade'=>$dados['prioridade'],

            'defeito'=>$dados['defeito_informado'],

            'diagnostico'=>$dados['diagnostico'],

            'servico'=>$dados['servico_executado'],

            'observacoes'=>$dados['observacoes'],

            'valor_pecas'=>$dados['valor_pecas'],

            'valor_mao'=>$dados['valor_mao_obra'],

            'valor_total'=>$dados['valor_total']

        ]);

        return $this->db->lastInsertId();

    }

    /**
     * Atualiza manutenção
     */
    public function atualizar(array $dados)
    {

        $sql="

        UPDATE manutencoes

        SET

            tecnico_id=:tecnico,

            fornecedor_id=:fornecedor,

            tipo=:tipo,

            prioridade=:prioridade,

            defeito_informado=:defeito,

            diagnostico=:diagnostico,

            servico_executado=:servico,

            observacoes=:observacoes,

            valor_pecas=:pecas,

            valor_mao_obra=:mao,

            valor_total=:total

        WHERE

            id=:id

        ";

        return $this->query($sql,[

            'id'=>$dados['id'],

            'tecnico'=>$dados['tecnico_id'],

            'fornecedor'=>$dados['fornecedor_id'],

            'tipo'=>$dados['tipo'],

            'prioridade'=>$dados['prioridade'],

            'defeito'=>$dados['defeito_informado'],

            'diagnostico'=>$dados['diagnostico'],

            'servico'=>$dados['servico_executado'],

            'observacoes'=>$dados['observacoes'],

            'pecas'=>$dados['valor_pecas'],

            'mao'=>$dados['valor_mao_obra'],

            'total'=>$dados['valor_total']

        ]);

    }

    /**
     * Altera Status
     */
    public function alterarStatus(int $id,string $status)
    {

        $sql="

            UPDATE manutencoes

            SET

                status=:status

            WHERE

                id=:id

        ";

        return $this->query($sql,[

            'status'=>$status,

            'id'=>$id

        ]);

    }

    /**
     * Finalizar
     */
    public function finalizar(int $id)
    {

        $sql="

            UPDATE manutencoes

            SET

                status='FINALIZADA',

                data_fim=NOW()

            WHERE

                id=:id

        ";

        return $this->query($sql,[

            'id'=>$id

        ]);

    }

    /**
     * Cancelar
     */
    public function cancelar(int $id)
    {

        $sql="

            UPDATE manutencoes

            SET

                status='CANCELADA'

            WHERE

                id=:id

        ";

        return $this->query($sql,[

            'id'=>$id

        ]);

    }

    /**
     * Dashboard
     */
    public function dashboard()
    {

        $sql="

        SELECT

        COUNT(*) total,

        SUM(status='ABERTA') abertas,

        SUM(status='EM_ANALISE') analise,

        SUM(status='AGUARDANDO_PECA') aguardando,

        SUM(status='EM_MANUTENCAO') manutencao,

        SUM(status='TESTE') teste,

        SUM(status='FINALIZADA') finalizadas

        FROM manutencoes

        ";

        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);

    }

}