<?php

namespace App\DAO;

use App\Model\ProdutoModel;
use \PDO;



class ProdutoDAO extends DAO
{

    public function __construct() 
    {
        parent::__construct();
    }


    public function insert(ProdutoModel $model) 
    {

        $sql = "INSERT INTO produto 
                (nome, preco, descricao) 
                VALUES (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);  
        
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->preco);
        $stmt->bindValue(3, $model->descricao);

        $stmt->execute();      
    }
    
    /**
     * Método que recebe o Model preenchido e atualiza no banco de dados.
     * Note que neste model é necessário ter a propriedade id preenchida.
     */
    public function update(ProdutoModel $model)
    {
        $sql = "UPDATE produto SET nome=?, preco=?, descricao=? WHERE id=? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->preco);
        $stmt->bindValue(3, $model->descricao);
        $stmt->bindValue(4, $model->id);
        $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM produto ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);        
    }


    public function selectById(int $id)
    {

        $sql = "SELECT * FROM produto WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("ProdutoModel"); 
    }


    public function delete(int $id)// id é inteiro.
    {
        $sql = "DELETE FROM produto WHERE id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }


}