<?php

require './App/DB/Database.php';

class Produto{

    public int $id_produto;
    public string $foto;
    public string $nome;
    public string $marca;
    public string $descricao;
    public string $modelo;
    public string $cor;
    public string $tamanho;
    public string $quantidade;
    public string $preco;
    public int $id_tipo;
 
    public function cadastrar(){
        //instancia o banco 
        $db = new Database('produto');
        //chama a funcao insert do banco e passa o ARRAY como parametro
        $res = $db->insert(
                [
                    'foto'=> $this->foto,
                    'nome'=> $this->nome,
                    'marca'=> $this->marca,
                    'descricao' => $this->descricao,
                    'modelo' => $this->modelo,
                    'cor' => $this->cor,
                    'tamanho' => $this->tamanho,
                    'quantidade' => $this->quantidade,
                    'preco' => $this->preco,
                    'id_tipo' => $this->id_tipo
                ]
            );

        return $res;
    }

    public function buscar($where = null,$order = null,$limit = null){
        //instancia o banco 
        $db = new Database('produto');

        $res = $db->select($where,$order,$limit)->fetchAll(PDO::FETCH_CLASS,self::class);
        return $res;
    }

    public function buscar_por_id($id){
        //instancia o banco 
        $db = new Database('produto');
        $where = 'id_produto ='.$id;
        $res = $db->select($where)->fetchObject(self::class);
        return $res;
    }

    public function atualizar(){
        $db = new Database('produto');
        $res = $db->update('id_produto ='.$this->id_produto,
            [
                "nome" => $this->nome,
                "email" => $this->email,
                "fone" => $this->fone
            ]
        );
        return $res;
    }

    public function excluir(){
        //instancia o banco 
        $db = new Database('produto');
        $where = 'id_produto ='.$this->id_produto;
        $res = $db->delete($where);
        return $res;
    }
}