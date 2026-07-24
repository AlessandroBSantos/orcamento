<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../models/Manutencao.php';
require_once __DIR__ . '/BaseController.php';

class ManutencaoController extends BaseController
{

    private Manutencao $manutencao;

    public function __construct()
    {
        $this->manutencao = new Manutencao();
    }

    /**
     * Dashboard
     */
    public function dashboard()
    {
        return $this->manutencao->dashboard();
    }

    /**
     * Lista todas as Ordens
     */
    public function index()
    {
        return $this->manutencao->listar();
    }

    /**
     * Busca uma Ordem
     */
    public function buscar(int $id)
    {
        return $this->manutencao->buscar($id);
    }

    /**
     * Nova Ordem
     */
    public function cadastrar(array $dados)
    {

        if (empty($dados['equipamento_id'])) {
            throw new Exception("Selecione um equipamento.");
        }

        if (empty($dados['defeito_informado'])) {
            throw new Exception("Informe o defeito.");
        }

        if (empty($dados['tipo'])) {
            $dados['tipo'] = 'CORRETIVA';
        }

        if (empty($dados['prioridade'])) {
            $dados['prioridade'] = 'MEDIA';
        }

        if (!isset($dados['usuario_abertura'])) {
            $dados['usuario_abertura'] = $_SESSION['usuario_id'] ?? null;
        }

        if (!isset($dados['tecnico_id'])) {
            $dados['tecnico_id'] = null;
        }

        if (!isset($dados['fornecedor_id'])) {
            $dados['fornecedor_id'] = null;
        }

        if (!isset($dados['diagnostico'])) {
            $dados['diagnostico'] = '';
        }

        if (!isset($dados['servico_executado'])) {
            $dados['servico_executado'] = '';
        }

        if (!isset($dados['observacoes'])) {
            $dados['observacoes'] = '';
        }

        if (!isset($dados['valor_pecas'])) {
            $dados['valor_pecas'] = 0;
        }

        if (!isset($dados['valor_mao_obra'])) {
            $dados['valor_mao_obra'] = 0;
        }

        if (!isset($dados['valor_total'])) {
            $dados['valor_total'] = 0;
        }

        return $this->manutencao->cadastrar($dados);

    }

    /**
     * Atualizar Ordem
     */
    public function atualizar(array $dados)
    {

        if (empty($dados['id'])) {
            throw new Exception("Ordem inválida.");
        }

        return $this->manutencao->atualizar($dados);

    }

    /**
     * Alterar Status
     */
    public function alterarStatus(int $id, string $status)
    {

        return $this->manutencao->alterarStatus($id, $status);

    }

    /**
     * Finalizar Ordem
     */
    public function finalizar(int $id)
    {

        return $this->manutencao->finalizar($id);

    }

    /**
     * Cancelar Ordem
     */
    public function cancelar(int $id)
    {

        return $this->manutencao->cancelar($id);

    }

}