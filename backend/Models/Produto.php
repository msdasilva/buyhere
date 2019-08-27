<?php

    class Produto {

        private $id;
        public function getId() { return $this->id; }
        public function setId($id) { $this->id = $id; }
        
        private $nome;
        public function getNome() { return $this->nome; }
        public function setNome($nome) { $this->nome = $nome; }
                
        private $preco;
        public function getPreco() { return $this->preco; }
        public function setPreco($preco) { $this->preco = $preco; }

        private $latitude;
        public function getLatitude() { return $this->latitude; }
        public function setLatitude($latitude) { $this->latitude = $latitude; }
        
        private $longetude;
        public function getLongetude() { return $this->longetude; }
        public function setLongetude($longetude) { $this->longetude = $longetude; }
        
        private $ativo;
        public function getAtivo() { return $this->ativo; }
        public function setAtivo($ativo) { $this->ativo = $ativo; }
        
        private $criacao;
        public function getCriacao() { return $this->criacao; }
        public function setCriacao($criacao) { $this->criacao = $criacao; }

        private $modificacao;
        public function getModificacao() { return $this->modificacao; }
        public function setModificacao($modificacao) { $this->modificacao = $modificacao; }
        
    }
?>