<?php

class Produto {

    private $id;
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }    
    private $nome;
    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    private $preco;
    public function getPreco() {
        return $this->preco;
    }
    public function setPreco($preco) {
        $this->preco = $preco;
    }
    private $latitude;
    public function getLatitude() {
        return $this->latitude;
    }
    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }
    private $longitude;
    public function getLongitude() {
        return $this->longitude;
    }
    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }
    private $criacao;
    public function getCriacao() {
        return $this->criacao;
    }
    public function setCriacao($criacao) {
        $this->criacao = $criacao;
    }

}

?>