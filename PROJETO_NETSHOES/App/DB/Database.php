<?php

class Database{
    private $conn;
    private string $local='localhost'; //10.28.0.155
    private string $db = 'netshoes'; 
    private string $user = 'root'; //devweb
    private string $password = '';
    private string $table;

    function __construct($tabela = null){
        $this->table = $tabela;
        $this->conecta();
    }

    private function conecta(){
        try{
            $this->conn = new PDO("mysql:host=".$this->local.";dbname=".$this->db,$this->user,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            //echo "Conectado com sucesso!";
        }catch(PDOException $err){
            die("Conection Failed ".$err->getMessage());
        }
    }

    public function execute($query, $binds = []){
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute($binds);
            return $stmt;

        }catch (PDOException $err){
            die("Connection Failed ".$err->getMessage());
        }
    }

    public function insert($values){ 
        //VALUES é um ARRAY ASSOCIATIVO -> tipo um DICIONARIO DO PYTHON
        $fields = array_keys($values); //quebra o ARRAY em 2 partes
        $binds = array_pad([],count($fields),'?');
        $query = 'INSERT INTO '.$this->table. ' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';
        $res = $this->execute($query, array_values($values));

        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function select($where = null,$order = null,$limit = null,$fields = '*'){

        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        $query = 'SELECT '.$fields.' FROM '.$this->table .' '.$where.' '.$order. ' '.$limit;
        // echo $query;
        // exit;
        return $this->execute($query);
    }

    public function update($where,$array){
        //parametro $where (id_table = 4) / parametro $values array com os dados para atualizar
        // array_shift($array);//tirar primeiro elemento
        $fields = array_keys($array);

        $param = array_values($array); //os valores do array que veio como parametro
        //montar a query
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;
        
        //DEBUG
        // echo $query;
        // exit;
        $res = $this->execute($query,$param);
        if($res){
            return true;
        }
    }

    public function delete($where){
        //montar query
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;
        $result = $this->execute($query);

        if($result->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}
