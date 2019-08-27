<?php

require_once "Connection.php";
require_once "UtilFactory.php";
require_once "Constantes.php";
require_once "../model/Produto.php";

class ProdutoDao {

    private $stmt;
    private $connection;    

	public function __construct() {
		if (!isset($this->connection))			
			$this->connection = Connection::getInstance();
	}

	public function loadProduto($idFornecedor, $nomeDoArquivo, $tamanhoDoArquivo) {

		try {
			if ($tamanhoDoArquivo > 0) {
				
				$file = fopen($nomeDoArquivo, "r");
				
				$this->deletar($idFornecedor);

				while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {            
					$produto = new Produto($column[0], $column[1], $column[2], $column[3]);
					UtilFactory::debug($produto, false);
					$this->adicionar($produto);
				}
			}
		} catch (Exception $e) {
			throw $e;
		}

	}
	
	public function deletar($idFornecedor) {

		try {

			$this->connection->beginTransaction();

			$query = "UPDATE fornecedor_produto SET ativo = 0, modificao = NOW() WHERE id_fornecedor = :id_fornecedor AND criacao != NOW())";
			$stmt = $this->connection->prepare($query);
			$stmt->bindValue(":id_fornecedor", $idFornecedor);
			$stmt->execute();

			$this->connection->commit();

		} catch (Exception $e) {
			$this->connection->rollBack();
			throw $e;
		}
	}

	public function adicionar($produto) {

		try {

			$this->connection->beginTransaction();

			$stmt = $this->connection->prepare(Constantes::INSERT_PRODUTO);
			$stmt->bindValue(":nome", $produto->getNome());
			$stmt->bindValue(":preco", $produto->getPreco());
			$stmt->bindValue(":latitude", $produto->getLatitude());
			$stmt->bindValue(":longitude", $produto->getLongitude());
			$stmt->bindValue(":criacao", NOW());
			$stmt->execute();					

			$stmt = $this->connection->prepare(Constantes::INSERT_FORNECEDOR_PRODUTO);
			$stmt->bindValue(":id_fornecedor", $_SESSION['id']);
			$stmt->bindValue(":id_produto", $this->connection->lastInsertId());
			$stmt->bindValue(":ativo", 1);
			$stmt->bindValue(":criacao", NOW());
			$stmt->execute();

			$this->connection->commit();

		} catch (Exception $e) {
			$this->connection->rollBack();
			throw $e;
		}

	}

	public function listar($nome) {
		try {

			$query = "SELECT p.nome, p.preco, f.razaoSocial, f.localizacao FROM produto p INNER JOIN fornecedor_produto fp ON p.id = fp.id_produto INNER JOIN fornecedor f ON f.id = fp.id_fornecedor WHERE nome = :nome";
			$stmt = $this->connection->prepare($query);
			$stmt->bindValue(":nome", $nome);
			$stmt->execute();

			return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

		} catch (Exception $e) {
			throw $e;
		}
	}

	public function listaAll() {

		try {

			$query = "SELECT * FROM categorias";            
            $this->stmt = $this->connection->prepare($query);
			$this->stmt->execute();
			return json_encode($this->stmt->fetchAll(PDO::FETCH_ASSOC));
		} catch (Exception $e) {
			throw $e;
		}
	}	
}
?>