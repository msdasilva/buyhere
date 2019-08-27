<?php

require_once '../connection.php';
require_once '../Models/ProdutoDao.php';

$produtoDao = new ProdutoDao();

echo json_encode($produtoDao->listarAll());
?>