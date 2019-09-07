<?php

require_once "../connection.php";
require_once "../helpers.php";

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

    public function listarAll(Produto $produto) {
        
        try {            
            $this->stmt = $this->connection->prepare("SELECT Geo('{$produto->getLatitude()}','s{$produto->getLongitude()}', latitude, longitude) AS Distancia, preco, nome FROM produto WHERE nome = :nome ORDER BY Distancia, preco ASC");
            $this->stmt->bindValue(':nome', "LIKE '%{$produto->getNome()}'" );
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            //throw $th;
        }
     
    }

    public function loadProduto($idFornecedor, $nomeDoArquivo, $tamanhoDoArquivo) {

		try {
			if ($tamanhoDoArquivo > 0) {
				
				$file = fopen($nomeDoArquivo, "r");
				
				$this->deletar($idFornecedor);

				while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {            
					$produto = new Produto($column[0], $column[1], $column[2], $column[3]);
					UtilFactory::debug($produto, true);
					$this->adicionar($produto);
				}
			}
		} catch (Exception $e) {
			throw $e;
		}

	}
}
?>