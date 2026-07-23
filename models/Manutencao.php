<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Model Manutencao
|--------------------------------------------------------------------------
|
| Esta classe é responsável pelo gerenciamento das
| Ordens de Manutenção (OM) do sistema.
|
| Segue o padrão MVC (Model-View-Controller),
| sendo responsável exclusivamente pelo acesso
| e manipulação dos dados da tabela "manutencoes".
|
| Funcionalidades:
| - Listar Ordens de Manutenção.
| - Buscar manutenção por ID.
| - Gerar número automático da OM.
| - Cadastrar novas Ordens de Manutenção.
| - Atualizar informações.
| - Alterar status.
| - Finalizar ou cancelar Ordens.
| - Fornecer indicadores para o Dashboard.
|--------------------------------------------------------------------------
*/

//
// Carrega a classe BaseModel,
// responsável pela conexão com o banco
// e pelos métodos comuns de acesso aos dados.
//
require_once __DIR__ . '/BaseModel.php';

class Manutencao extends BaseModel
{

    /**
     * Lista todas as manutenções
     *
     * Retorna todas as Ordens de Manutenção
     * cadastradas no sistema juntamente
     * com as informações básicas
     * do equipamento relacionado.
     */
    public function listar()
    {

        //
        // Consulta SQL responsável por listar
        // todas as Ordens de Manutenção.
        //
        $sql = "

            SELECT

                m.*,

                e.codigo,
                e.descricao

            FROM manutencoes m

            INNER JOIN equipamentos e
                ON e.id = m.equipamento_id

            ORDER BY

                m.id DESC

        ";

        //
        // Executa a consulta e retorna
        // todos os registros encontrados.
        //
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Busca manutenção
     *
     * Localiza uma Ordem de Manutenção
     * através do seu identificador.
     */
    public function buscar(int $id)
    {

        //
        // Consulta SQL responsável por localizar
        // uma manutenção específica.
        //
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

        //
        // Executa a consulta utilizando
        // o ID informado e retorna
        // apenas um registro.
        //
        return $this->query($sql,[

            'id'=>$id

        ])->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Gera número da OS
     *
     * Gera automaticamente um número
     * sequencial para a Ordem de Manutenção.
     *
     * Formato:
     * OM000001
     * OM000002
     * OM000003
     */
    public function gerarNumeroOS()
    {

        //
        // Consulta SQL responsável por localizar
        // o maior ID existente na tabela.
        //
        $sql="

            SELECT MAX(id) ultimo

            FROM manutencoes

        ";

        //
        // Obtém o último registro cadastrado.
        //
        $ultimo=$this->query($sql)->fetch(PDO::FETCH_ASSOC);

        //
        // Incrementa o número sequencial.
        //
        $numero=((int)$ultimo['ultimo'])+1;

        //
        // Retorna o número da Ordem
        // preenchendo com zeros à esquerda.
        //
        return "OM".str_pad($numero,6,"0",STR_PAD_LEFT);

    }

    /**
     * Nova manutenção
     */
        /**
     * Nova manutenção
     *
     * Cadastra uma nova Ordem de Manutenção (OM)
     * no sistema.
     *
     * Antes da gravação é gerado automaticamente
     * um número sequencial para identificação
     * da Ordem de Manutenção.
     *
     * Após a inserção, o método retorna o ID
     * do registro recém-criado.
     */
    public function cadastrar(array $dados)
    {

        //
        // Gera automaticamente o número
        // da Ordem de Manutenção.
        //
        $numeroOS = $this->gerarNumeroOS();

        //
        // Instrução SQL responsável por inserir
        // uma nova Ordem de Manutenção.
        //
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

            observacoes,

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

        //
        // Executa a gravação da Ordem de
        // Manutenção associando cada parâmetro
        // aos dados recebidos.
        //
        $this->query($sql,[

            // Número da Ordem de Manutenção.
            'numero_os'=>$numeroOS,

            // Equipamento relacionado.
            'equipamento_id'=>$dados['equipamento_id'],

            // Usuário responsável pela abertura.
            'usuario_abertura'=>$dados['usuario_abertura'],

            // Técnico responsável.
            'tecnico_id'=>$dados['tecnico_id'],

            // Fornecedor relacionado.
            'fornecedor_id'=>$dados['fornecedor_id'],

            // Tipo da manutenção.
            'tipo'=>$dados['tipo'],

            // Prioridade da manutenção.
            'prioridade'=>$dados['prioridade'],

            // Defeito informado pelo solicitante.
            'defeito'=>$dados['defeito_informado'],

            // Diagnóstico técnico.
            'diagnostico'=>$dados['diagnostico'],

            // Serviço executado.
            'servico'=>$dados['servico_executado'],

            // Observações gerais.
            'observacoes'=>$dados['observacoes'],

            // Valor das peças utilizadas.
            'valor_pecas'=>$dados['valor_pecas'],

            // Valor da mão de obra.
            'valor_mao'=>$dados['valor_mao_obra'],

            // Valor total da manutenção.
            'valor_total'=>$dados['valor_total']

        ]);

        //
        // Retorna o ID do registro recém-criado.
        //
        return $this->db->lastInsertId();

    }

    /**
     * Atualiza manutenção
     */
        /**
     * Atualiza manutenção
     *
     * Atualiza as informações de uma
     * Ordem de Manutenção já cadastrada.
     *
     * Permite alterar dados técnicos,
     * financeiros e demais informações,
     * mantendo o número da OM e o usuário
     * responsável pela abertura.
     */
    public function atualizar(array $dados)
    {

        //
        // Instrução SQL responsável por atualizar
        // os dados da Ordem de Manutenção.
        //
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

        //
        // Executa a atualização associando
        // cada parâmetro aos dados recebidos.
        //
        return $this->query($sql,[

            // Identificador da manutenção.
            'id'=>$dados['id'],

            // Técnico responsável.
            'tecnico'=>$dados['tecnico_id'],

            // Fornecedor relacionado.
            'fornecedor'=>$dados['fornecedor_id'],

            // Tipo da manutenção.
            'tipo'=>$dados['tipo'],

            // Prioridade definida.
            'prioridade'=>$dados['prioridade'],

            // Defeito informado.
            'defeito'=>$dados['defeito_informado'],

            // Diagnóstico realizado.
            'diagnostico'=>$dados['diagnostico'],

            // Serviço executado.
            'servico'=>$dados['servico_executado'],

            // Observações adicionais.
            'observacoes'=>$dados['observacoes'],

            // Valor das peças.
            'pecas'=>$dados['valor_pecas'],

            // Valor da mão de obra.
            'mao'=>$dados['valor_mao_obra'],

            // Valor total da manutenção.
            'total'=>$dados['valor_total']

        ]);

    }

    /**
     * Altera Status
     *
     * Atualiza o status atual da
     * Ordem de Manutenção.
     */
    public function alterarStatus(int $id,string $status)
    {

        //
        // Consulta SQL responsável por alterar
        // o status da manutenção.
        //
        $sql="

            UPDATE manutencoes

            SET

                status=:status

            WHERE

                id=:id

        ";

        //
        // Executa a atualização utilizando
        // o ID e o novo status informados.
        //
        return $this->query($sql,[

            // Novo status da manutenção.
            'status'=>$status,

            // Identificador da manutenção.
            'id'=>$id

        ]);

    }

    /**
     * Finalizar
     *
     * Marca a Ordem de Manutenção como
     * FINALIZADA e registra automaticamente
     * a data de encerramento.
     */
    public function finalizar(int $id)
    {

        //
        // Consulta SQL responsável por finalizar
        // a Ordem de Manutenção.
        //
        $sql="

            UPDATE manutencoes

            SET

                status='FINALIZADA',

                data_fim=NOW()

            WHERE

                id=:id

        ";

        //
        // Executa a atualização.
        //
        return $this->query($sql,[

            // Identificador da manutenção.
            'id'=>$id

        ]);

    }

    /**
     * Cancelar
     *
     * Altera o status da Ordem de
     * Manutenção para CANCELADA.
     */
    public function cancelar(int $id)
    {

        //
        // Consulta SQL responsável por cancelar
        // a Ordem de Manutenção.
        //
        $sql="

            UPDATE manutencoes

            SET

                status='CANCELADA'

            WHERE

                id=:id

        ";

        //
        // Executa a atualização.
        //
        return $this->query($sql,[

            // Identificador da manutenção.
            'id'=>$id

        ]);

    }

    /**
     * Dashboard
     */
        /**
     * Dashboard
     *
     * Retorna os indicadores utilizados
     * no painel (Dashboard) do módulo
     * de Manutenção.
     *
     * São contabilizadas todas as Ordens
     * de Manutenção agrupadas por status,
     * permitindo exibir gráficos e cartões
     * informativos na tela inicial.
     */
    public function dashboard()
    {

        //
        // Consulta SQL responsável por calcular
        // os indicadores das Ordens de Manutenção.
        //
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

        //
        // Executa a consulta e retorna
        // um único registro contendo
        // todos os indicadores do Dashboard.
        //
        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);

    }

}

/*
|--------------------------------------------------------------------------
| Fim da Classe Manutencao
|--------------------------------------------------------------------------
|
| Este Model concentra todas as operações relacionadas
| às Ordens de Manutenção (OM) do LLA ERP, incluindo:
|
| • Listagem de Ordens de Manutenção
| • Consulta por identificador (ID)
| • Geração automática do número da OM
| • Cadastro de novas Ordens de Manutenção
| • Atualização das informações da manutenção
| • Alteração de status
| • Finalização da manutenção
| • Cancelamento da manutenção
| • Geração dos indicadores do Dashboard
|
| O método gerarNumeroOS() cria uma numeração
| sequencial no formato:
|
|     OM000001
|     OM000002
|     OM000003
|
| A classe herda BaseModel, reutilizando a
| conexão PDO e os métodos comuns de acesso
| ao banco de dados do LLA ERP.
|--------------------------------------------------------------------------
*/