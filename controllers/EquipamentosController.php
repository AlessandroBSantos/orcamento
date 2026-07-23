<?php

require_once __DIR__ . '/../models/Equipamento.php';
require_once __DIR__ . '/BaseController.php';

class EquipamentosController extends BaseController
{

    private Equipamento $equipamento;

    public function __construct()
    {
        $this->equipamento = new Equipamento();
    }

    /**
     * Lista todos os equipamentos
     */
    public function index()
    {
        return $this->equipamento->listar();
    }

    /**
     * Busca equipamento pelo ID
     */
    public function buscar(int $id)
    {
        return $this->equipamento->buscarPorId($id);
    }

    /**
     * Cadastra equipamento
     */
    public function cadastrar(array $dados)
    {

        if (empty($dados['descricao'])) {
            throw new Exception("Informe a descrição do equipamento.");
        }

        if (empty($dados['codigo'])) {
            throw new Exception("Informe o código do equipamento.");
        }

        return $this->equipamento->cadastrar($dados);

    }

    /**
     * Atualiza equipamento
     */
    public function atualizar(array $dados)
    {

        if (empty($dados['id'])) {
            throw new Exception("ID inválido.");
        }

        if (empty($dados['descricao'])) {
            throw new Exception("Informe a descrição.");
        }

        return $this->equipamento->atualizar($dados);

    }

    /**
     * Exclui equipamento
     */
    public function excluir(int $id)
    {

        if ($id <= 0) {
            throw new Exception("ID inválido.");
        }

        return $this->equipamento->excluir($id);

    }

    /**
     * Total de equipamentos
     */
    public function total()
    {
        return $this->equipamento->total();
    }

}