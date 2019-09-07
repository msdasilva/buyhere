<?php

require_once '../Models/Produto.php';
require_once '../Models/ProdutoDao.php';

$produto = new Produto();
$produtoDao = new ProdutoDao();

switch ($variable) {
    case 'SAVE':
        $produto->setNome("pao");
        $produto->setPreco(2.5);
        $produto->setLatitude(-22.9116586);
        $produto->setLongitude(-43.2037627);
        $produto->setAtivo(1);
        break;
    case 'DESTROY':
        /**
         * Method GET para deletar
         */
        $id = ($_GET['id'] !== null && (int)$_GET['id'] > 0) ? mysqli_real_escape_string($con, (int)$_GET['id']) : false;
        if(!$id) {
        return http_response_code(400);
        } else {
            $produto->setId($id);
            $produtoDao->deletar($produto);
        } 
        break;
    case 'UPDATE':
        $produto->setId(3);
        $produto->setNome("bicoito");
        $produto->setPreco(5.5);
        $produto->setLatitude(-22.9116586);
        $produto->setLongitude(-23.2037627);
        $produto->setAtivo(0);
        $produtoDao->alterar($produto);
        break;
    default:
        /**
         * Method GET para listar tudo pelo geolocalização
         */
        $nome = ($_GET['nome'] !== null) ? mysqli_real_escape_string($con, $_GET['nome']) : false;
        $latitude = ($_GET['latitude'] !== null && is_float($_GET['latitude'])) ? mysqli_real_escape_string($con, is_float($_GET['latitude'])) : false;
        $longitude = ($_GET['longitude'] !== null && is_float($_GET['longitude'])) ? mysqli_real_escape_string($con, is_float($_GET['longitude'])) : false;
        if(!$nome && !$latitude && !$longitude) {
        return http_response_code(400);
        } else {
            $nome = (!$nome) ? $nome : "%";
            $produto->setNome($nome);
            $produto->setLatitude($latitude);
            $produto->setLongitude($longitude);
            echo json_encode($produtoDao->listarAll($produto));
        }
        break;
}




?>