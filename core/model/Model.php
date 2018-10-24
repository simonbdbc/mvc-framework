<?php
    namespace Core\Model;

    abstract class Model{

        protected $dbConnec;
        
        public function __construct()
        {    
            $host = $GLOBALS["conf"]->host;
            $dbName = $GLOBALS["conf"]->database;
            $username = $GLOBALS["conf"]->username;
            $password = $GLOBALS["conf"]->pass;
            
            $dsn = "mysql:host=" . $host . ";port=3306;dbname=" . $dbName;
            $opt = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                \PDO::ATTR_EMULATE_PREPARES => false,
            );
            
            try {
                $this->dbConnec = new \PDO($dsn, $username, $password, $opt);
            } catch(\PDOException $e) {
                throw new \PDOException($e->getMessage(), $e->getCode());
            };   
        }

        public function getAll($column = [])
        {
            $data = array();

           if (count($column) == 0){
               $selectColumn = "";
               for ($i=0; $i < count($column); $i++) {
                   if($i == (count($column) - 1)) {
                       $selectColumn .= $column[$i];
                    } else {
                        $selectColumn .= $column[$i] . ', ';
                    }
                }
                $query = "SELECT ".$selectColumn." FROM " . $this->tableName;
            } else {
                $query = "SELECT * FROM " . $this->tableName;
            }
            
            $request = $this->dbConnec->prepare($query);
            
            if($request->execute()){       
                while($row = $request->fetch(\PDO::FETCH_OBJ)) {   
                    $data[] = $row;
                }
                return json_encode($data);
            } else {
                return false;
            }    
            // return $request->fetchAll();
        }

        public function getOne($column, $value)
        {
            $query = "SELECT * FROM " . $this->tableName ." WHERE " .$column. "= :value";

            $request = $this->dbConnec->prepare($query);
            $request->bindParam(":value", $value);           
            
            if($request->execute()){
                $data = $request->fetch(\PDO::FETCH_ASSOC);
                return $data;
            }
        
            return false; 
        }

        public function getOneById($value)
        {
            $query = "SELECT * FROM " . $this->tableName ." WHERE id = :value";

            $request = $this->dbConnec->prepare($query);
            $request->bindParam(":value", $value);           
            
            if($request->execute()){
                $data = $request->fetch(\PDO::FETCH_ASSOC);
                return $data;
            }
        
            return false; 
        }


        public function update($aParams)
        {
            $query = "UPDATE " . $this->tableName ." SET title = :title, content = :content WHERE id = :id";

            $request = $this->dbConnec->prepare($query);
            $request->bindParam(":id", $aParams['id']); 
            $request->bindParam(":title", $aParams['title']);           
            $request->bindParam(":content", $aParams['content']);           
            if($request->execute()){
                // var_dump($request);die;
                return true;
            }
            return false;
        }

    }
    ?>