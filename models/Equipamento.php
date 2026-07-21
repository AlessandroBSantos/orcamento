<?php

require_once __DIR__ . '/BaseModel.php';

class Equipamento extends BaseModel
{

    /**
     * Lista todos os equipamentos
     */
    public function listar()
    {

        $sql = "

            SELECT *

            FROM equipamentos

            WHERE ativo = 1

            ORDER BY descricao

        ";

        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Busca equipamento pelo ID
     */
    public function buscarPorId(int $id)
    {

        $sql = "

            SELECT *

            FROM equipamentos

            WHERE id = :id

            LIMIT 1

        ";

        return $this->query($sql, [

            'id' => $id

        ])->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Cadastra equipamento
     */
    public function cadastrar(array $dados)
    {

        $sql = "

            INSERT INTO equipamentos (

                codigo,
                patrimonio,
                descricao,
                categoria,
                fabricante,
                marca,
                modelo,
                numero_serie,
                numero_patrimonio,
                localizacao,
                setor,
                responsavel,
                fornecedor_id,
                data_compra,
                garantia_ate,
                valor_compra,
                observacoes,
                status

            )

            VALUES (

                :codigo,
                :patrimonio,
                :descricao,
                :categoria,
                :fabricante,
                :marca,
                :modelo,
                :numero_serie,
                :numero_patrimonio,
                :localizacao,
                :setor,
                :responsavel,
                :fornecedor_id,
                :data_compra,
                :garantia_ate,
                :valor_compra,
                :observacoes,
                :status

            )

        ";

        return $this->query($sql, [

            'codigo' => $dados['codigo'],
            'patrimonio' => $dados['patrimonio'],
            'descricao' => $dados['descricao'],
            'categoria' => $dados['categoria'],
            'fabricante' => $dados['fabricante'],
            'marca' => $dados['marca'],
            'modelo' => $dados['modelo'],
            'numero_serie' => $dados['numero_serie'],
            'numero_patrimonio' => $dados['numero_patrimonio'],
            'localizacao' => $dados['localizacao'],
            'setor' => $dados['setor'],
            'responsavel' => $dados['responsavel'],
            'fornecedor_id' => $dados['fornecedor_id'],
            'data_compra' => $dados['data_compra'],
            'garantia_ate' => $dados['garantia_ate'],
            'valor_compra' => $dados['valor_compra'],
            'observacoes' => $dados['observacoes'],
            'status' => $dados['status']

        ]);

    }

    /**
     * Atualiza equipamento
     */
    public function atualizar(array $dados)
    {

        $sql = "

            UPDATE equipamentos

            SET

                codigo = :codigo,
                patrimonio = :patrimonio,
                descricao = :descricao,
                categoria = :categoria,
                fabricante = :fabricante,
                marca = :marca,
                modelo = :modelo,
                numero_serie = :numero_serie,
                numero_patrimonio = :numero_patrimonio,
                localizacao = :localizacao,
                setor = :setor,
                responsavel = :responsavel,
                fornecedor_id = :fornecedor_id,
                data_compra = :data_compra,
                garantia_ate = :garantia_ate,
                valor_compra = :valor_compra,
                observacoes = :observacoes,
                status = :status

            WHERE id = :id

        ";

        return $this->query($sql, [

            'id' => $dados['id'],
            'codigo' => $dados['codigo'],
            'patrimonio' => $dados['patrimonio'],
            'descricao' => $dados['descricao'],
            'categoria' => $dados['categoria'],
            'fabricante' => $dados['fabricante'],
            'marca' => $dados['marca'],
            'modelo' => $dados['modelo'],
            'numero_serie' => $dados['numero_serie'],
            'numero_patrimonio' => $dados['numero_patrimonio'],
            'localizacao' => $dados['localizacao'],
            'setor' => $dados['setor'],
            'responsavel' => $dados['responsavel'],
            'fornecedor_id' => $dados['fornecedor_id'],
            'data_compra' => $dados['data_compra'],
            'garantia_ate' => $dados['garantia_ate'],
            'valor_compra' => $dados['valor_compra'],
            'observacoes' => $dados['observacoes'],
            'status' => $dados['status']

        ]);

    }

    /**
     * Exclusão lógica
     */
    public function excluir(int $id)
    {

        $sql = "

            UPDATE equipamentos

            SET ativo = 0

            WHERE id = :id

        ";

        return $this->query($sql, [

            'id' => $id

        ]);

    }

    /**
     * Total de equipamentos
     */
    public function total()
    {

        $sql = "

            SELECT COUNT(*) total

            FROM equipamentos

            WHERE ativo = 1

        ";

        return $this->query($sql)->fetch(PDO::FETCH_ASSOC);

    }

}