<?php

class ProdutoDao {
    
    private $connection;
    private $stmt;

    public function __construct() {
      $this->connection = Connection::getInstance();
    } 
    
    public function salvar($produto) {
        
        try {
            $this->connection->beginTransaction();
            $this->stmt = $this->connection->prepare(Constante::INSERT_PRODUTO);
            $this->stmt->bindParam(':nome', $produto->getNome());
            $this->stmt->bindParam(':preco', $produto->getPreco());
            $this->stmt->bindParam(':latitude', $produto->getLatitude());
            $this->stmt->bindParam(':longetude', $produto->getLongetude());
            $this->stmt->bindParam(':ativo', $produto->getAtivo());
            $this->stmt->bindParam(':criacao', $produto->getCriacao());
            $this->stmt->execute();
            $this->connection->commit();
        } catch (\Throwable $th) {
            //throw $th;
            $this->connection-rollBack();
        }
    }
    
    public function alterar($produto) {
        
        try {
            $this->connection->beginTransaction();
            $this->stmt = $this->connection->prepare(Constante::UPDATE_PRODUTO);
            $this->stmt->bindParam(':nome', $produto->getNome());
            $this->stmt->bindParam(':preco', $produto->getPreco());
            $this->stmt->bindParam(':latitude', $produto->getLatitude());
            $this->stmt->bindParam(':longetude', $produto->getLongetude());
            $this->stmt->bindParam(':ativo', $produto->getAtivo());
            $this->stmt->bindParam(':modificacao', $produto->getModificacao());
            $this->stmt->bindParam(':id', $produto->getId());
            $this->stmt->execute();
            $this->connection->commit();
        } catch (\Throwable $th) {
            //throw $th;
            $this->connection-rollBack();
        }
        
    }
    
    public function deletar($produto) {
        
        try {
            $this->connection->beginTransaction();
            $this->stmt = $this->connection->prepare(Constante::DELETE_PRODUTO);
            $this->stmt->bindParam(':ativo', $produto->getAtivo());
            $this->stmt->bindParam(':modificacao', $produto->getModificacao());
            $this->stmt->bindParam(':id', $produto->getId());
            $this->stmt->execute();
            $this->connection->commit();
        } catch (\Throwable $th) {
            //throw $th;
            $this->connection-rollBack();
        }
        
    }

    public function listar($produto) {
        
        try {
            $this->connection->beginTransaction();
            $this->stmt = $this->connection->prepare(Constante::SELECT_PRODUTO);
            $this->stmt->bindParam(':nome', $produto->getNome());
            $this->stmt->execute();
            $this->connection->commit();
        } catch (\Throwable $th) {
            //throw $th;
            $this->connection-rollBack();
        }
        
    }

    public function listarAll() {
        
        try {            
            $this->stmt = $this->connection->prepare(Constante::SELECT_ALL_PRODUTO);            
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }
}
?>