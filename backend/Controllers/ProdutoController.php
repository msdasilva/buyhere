<?php

require_once '../connection.php';
require_once '../Models/Produto.php';
require_once '../Models/ProdutoDao.php';

$produto = new Produto();
$produto->setNome("pao");
$produto->setPreco(2.5);
$produto->setLatitude(-22.9116586);
$produto->setLongetude(-43.2037627);
$produto->setAtivo(1);

$produtoDao = new ProdutoDao();
$produtoDao->salvar($produto);

echo json_encode($produtoDao->listarAll());
?>