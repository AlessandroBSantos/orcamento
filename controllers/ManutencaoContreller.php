<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| ManutencaoController
|--------------------------------------------------------------------------
|
| Controller responsável pelo gerenciamento das
| Ordens de Serviço (Manutenção) do sistema.
|
| Segue o padrão MVC (Model-View-Controller),
| realizando a comunicação entre as Views e o
| Model Manutencao.
|
| Responsabilidades:
| - Dashboard de manutenção.
| - Listagem de Ordens de Serviço.
| - Consulta de Ordem por ID.
| - Cadastro de novas Ordens.
| - Atualização de Ordens.
| - Alteração de status.
| - Finalização de Ordens.
| - Cancelamento de Ordens.
|--------------------------------------------------------------------------
*/

//
// Carrega o Model de Manutenção.
//
require_once __DIR__ . '/../models/Manutencao.php';

//
// Carrega a classe base dos Controllers.
//
require_once __DIR__ . '/BaseController.php';

class ManutencaoController extends BaseController
{

    //
    // Instância do Model Manutencao.
    //
    private Manutencao $manutencao;

    /*
    |--------------------------------------------------------------------------
    | Construtor
    |--------------------------------------------------------------------------
    |
    | Instancia automaticamente o Model de
    | Manutenção sempre que o Controller é criado.
    |--------------------------------------------------------------------------
    */
    public function __construct()
    {
        $this->manutencao = new Manutencao();
    }

    /**
     * Dashboard
     *
     * Retorna os indicadores utilizados
     * na tela inicial da manutenção.
     */
    public function dashboard()
    {
        return $this->manutencao->dashboard();
    }

    /**
     * Lista todas as Ordens
     *
     * Retorna todas as Ordens de Serviço
     * cadastradas no sistema.
     */
    public function index()
    {
        return $this->manutencao->listar();
    }

    /**
     * Busca uma Ordem
     *
     * Localiza uma Ordem de Serviço
     * através do seu identificador.
     */
    public function buscar(int $id)
    {
        return $this->manutencao->buscar($id);
    }

    /**
     * Nova Ordem
     *
     * Realiza as validações necessárias,
     * define valores padrão quando necessário
     * e envia os dados para o Model.
     */
    public function cadastrar(array $dados)
    {

        // Verifica se foi informado
        // o equipamento da manutenção.
        if (empty($dados['equipamento_id'])) {
            throw new Exception("Selecione um equipamento.");
        }

        // Verifica se foi informado
        // o defeito apresentado.
        if (empty($dados['defeito_informado'])) {
            throw new Exception("Informe o defeito.");
        }

        // Define o tipo padrão da manutenção.
        if (empty($dados['tipo'])) {
            $dados['tipo'] = 'CORRETIVA';
        }

        // Define a prioridade padrão.
        if (empty($dados['prioridade'])) {
            $dados['prioridade'] = 'MEDIA';
        }

        // Caso não seja informado,
        // utiliza o usuário logado.
        if (!isset($dados['usuario_abertura'])) {
            $dados['usuario_abertura'] = $_SESSION['usuario_id'] ?? null;
        }

        // Técnico responsável.
        // Inicialmente permanece vazio.
        if (!isset($dados['tecnico_id'])) {
            $dados['tecnico_id'] = null;
        }

        // Fornecedor responsável.
        if (!isset($dados['fornecedor_id'])) {
            $dados['fornecedor_id'] = null;
        }

        // Diagnóstico inicial.
        if (!isset($dados['diagnostico'])) {
            $dados['diagnostico'] = '';
        }

        // Serviço executado.
        if (!isset($dados['servico_executado'])) {
            $dados['servico_executado'] = '';
        }

        // Observações adicionais.
        if (!isset($dados['observacoes'])) {
            $dados['observacoes'] = '';
        }

        // Valor das peças.
        if (!isset($dados['valor_pecas'])) {
            $dados['valor_pecas'] = 0;
        }

        // Valor da mão de obra.
        if (!isset($dados['valor_mao_obra'])) {
            $dados['valor_mao_obra'] = 0;
        }

        // Valor total da Ordem.
        if (!isset($dados['valor_total'])) {
            $dados['valor_total'] = 0;
        }

        // Envia os dados para o Model.
        return $this->manutencao->cadastrar($dados);

    }

    /**
     * Atualizar Ordem
     *
     * Atualiza uma Ordem de Serviço
     * já cadastrada.
     */
    public function atualizar(array $dados)
    {

        // Verifica se existe um ID válido.
        if (empty($dados['id'])) {
            throw new Exception("Ordem inválida.");
        }

        // Atualiza os dados da Ordem.
        return $this->manutencao->atualizar($dados);

    }

    /**
     * Alterar Status
     *
     * Modifica o status atual
     * da Ordem de Serviço.
     */
    public function alterarStatus(int $id, string $status)
    {

        return $this->manutencao->alterarStatus($id, $status);

    }

    /**
     * Finalizar Ordem
     *
     * Marca uma Ordem de Serviço
     * como finalizada.
     */
    public function finalizar(int $id)
    {

        return $this->manutencao->finalizar($id);

    }

    /**
     * Cancelar Ordem
     *
     * Cancela uma Ordem de Serviço.
     */
    public function cancelar(int $id)
    {

        return $this->manutencao->cancelar($id);

    }

}