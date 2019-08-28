<?php

require_once '../Models/Produto.php';
require_once '../Models/ProdutoDao.php';

$produto = new Produto();
$produtoDao = new ProdutoDao();

$produto->setNome("pao");
$produto->setPreco(2.5);
$produto->setLatitude(-22.9116586);
$produto->setLongetude(-43.2037627);
$produto->setAtivo(1);
//$produtoDao->salvar($produto);

echo json_encode($produtoDao->listarAll());

$produto->setId(1);
$produto->setNome("pao");
$produto->setPreco(5.5);
$produto->setLatitude(-22.9116586);
$produto->setLongetude(-43.2037627);
$produto->setAtivo(0);
$produtoDao->alterar($produto);

echo json_encode($produtoDao->listarAll());

$produto->setId(1);
$produto->setNome("pao");
$produto->setPreco(2.5);
$produto->setLatitude(-22.9116586);
$produto->setLongetude(-43.2037627);
$produto->setAtivo(0);
$produtoDao->deletar($produto);

echo json_encode($produtoDao->listarAll());


$produto->setId(1);
$produto->setNome("bicoito");
$produto->setPreco(2.5);
$produto->setLatitude(-22.9116586);
$produto->setLongetude(-43.2037627);
$produto->setAtivo(0);
//$produtoDao->listar($produto);

echo json_encode($produtoDao->listar($produto));

?>