<?php

require_once __DIR__ . '/BaseModel.php';

class Cliente extends BaseModel
{

    /**
     * Lista todos os clientes
     */
    public function listar()
    {

        $sql = "
            SELECT
                id,
                tipo,
                nome,
                nome_fantasia,
                cpf_cnpj,
                cidade,
                status
            FROM clientes
            ORDER BY nome
        ";

        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Busca um cliente pelo ID
     */
    public function buscarPorId(int $id)
    {

        $sql = "
            SELECT *
            FROM clientes
            WHERE id = :id
            LIMIT 1
        ";

        return $this->query($sql, [
            'id' => $id
        ])->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Salva um novo cliente
     */
    public function salvar(array $dados)
    {

        $sql = "INSERT INTO clientes (

            tipo,
            nome,
            nome_fantasia,
            cpf_cnpj,
            rg_ie,
            inscricao_municipal,
            cep,
            endereco,
            numero,
            complemento,
            bairro,
            cidade,
            estado,
            status

        ) VALUES (

            :tipo,
            :nome,
            :nome_fantasia,
            :cpf_cnpj,
            :rg_ie,
            :inscricao_municipal,
            :cep,
            :endereco,
            :numero,
            :complemento,
            :bairro,
            :cidade,
            :estado,
            :status

        )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([

            'tipo' => $dados['tipo'],
            'nome' => $dados['nome'],
            'nome_fantasia' => $dados['nome_fantasia'],
            'cpf_cnpj' => $dados['cpf_cnpj'],
            'rg_ie' => $dados['rg_ie'],
            'inscricao_municipal' => $dados['inscricao_municipal'],
            'cep' => $dados['cep'],
            'endereco' => $dados['endereco'],
            'numero' => $dados['numero'],
            'complemento' => $dados['complemento'],
            'bairro' => $dados['bairro'],
            'cidade' => $dados['cidade'],
            'estado' => $dados['estado'],
            'status' => $dados['status']

        ]);

    }

}