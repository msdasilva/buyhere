<?php

require_once "../connection.php";

class ProdutoDao {
    
    private $connection;
    private $stmt;

    public function __construct() {
      $this->connection = Connection::getInstance();
    }

    public function salvar(Produto $produto) {
        
        try {
            $this->connection->beginTransaction();
            $this->stmt = $this->connection->prepare("INSERT INTO produto (nome, preco, latitude, longitude, ativo, criacao) VALUES (:nome, :preco, :latitude, :longetude, :ativo, now())");
            $this->stmt->bindValue(':nome', $produto->getNome());
            $this->stmt->bindValue(':preco', $produto->getPreco());
            $this->stmt->bindValue(':latitude', $produto->getLatitude());
            $this->stmt->bindValue(':longitude', $produto->getLongitude());
            $this->stmt->bindValue(':ativo', $produto->getAtivo());
            $this->stmt->execute();
            $this->connection->commit();
        } catch (\Throwable $th) {
            //throw $th;
            $this->connection-rollBack();
        }
    }
    
    public function alterar(Produto $produto) {
        
        try {
            $this->connection->beginTransaction();
            $this->stmt = $this->connection->prepare("UPDATE produto SET nome = :nome, preco = :preco, latitude = :latitude, longitude = :longitude, ativo = :ativo, modificacao = NOW() WHERE id = :id");
            $this->stmt->bindValue(':nome', $produto->getNome());
            $this->stmt->bindValue(':preco', $produto->getPreco());
            $this->stmt->bindValue(':latitude', $produto->getLatitude());
            $this->stmt->bindValue(':longitude', $produto->getLongitude());
            $this->stmt->bindValue(':ativo', $produto->getAtivo());
            $this->stmt->bindValue(':id', $produto->getId());
            $this->stmt->execute();
            $this->connection->commit();
        } catch (\Throwable $th) {
            //throw $th;
            $this->connection-rollBack();
        }
        
    }
    
    public function deletar(Produto $produto) {
        
        try {
            $this->connection->beginTransaction();
            $this->stmt = $this->connection->prepare("UPDATE produto SET ativo = 0, modificacao = NOW() WHERE id = :id");
            $this->stmt->bindValue(':id', $produto->getId());
            $this->stmt->execute();
            $this->connection->commit();
        } catch (\Throwable $th) {
            //throw $th;
            $this->connection-rollBack();
        }
        
    }

    public function listar(Produto $produto) {
        
        try {
            $this->connection->beginTransaction();
            $this->stmt = $this->connection->prepare("select * from produto where nome = :nome");
            $this->stmt->bindValue(':nome', $produto->getNome());
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            //throw $th;
            $this->connection-rollBack();
        }
        
    }

    public function listarAll() {
        
        try {            
            $this->stmt = $this->connection->prepare("SELECT Geo(-34.50696,-33.438673, latitude, longitude) AS Distancia, preco, nome FROM produto ORDER BY Distancia, preco ASC");
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            //throw $th;
        }
     
    }
}
?>