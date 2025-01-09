<?php 
    namespace App\Model;
    use App\Core\Connection;
    use Exception;
    use PDO;

    class LogRequest{
        public int $LOG_ID;
        public String $LOG_Solicitacao;
        public String $LOG_Metodo;
        public String $LOG_Data;

        public static function InsertLog($dados){
            $connect = Connection::GetConnection();

            $query = "INSERT INTO log_api_requests (LOG_Solicitacao, LOG_Metodo) VALUES (:soli, :metodo)";

            $query = $connect->prepare($query);
            
            $query->bindValue(":soli", $dados['LOG_Solicitacao'], PDO::PARAM_STR);
            $query->bindValue(":metodo", $dados['LOG_Metodo'], PDO::PARAM_STR);

            $res = $query->execute();
           
            if($res == 0){
                
                throw new Exception("Erro ao inserir log!");

                return false;
            }

            return true;
        }

        public static function GetAllLogs(){
            $connect = Connection::GetConnection();
            $Logs = array();

            $query = "SELECT * FROM log_api_requests";
            $query = $connect->prepare($query);
            $query->execute();

            while($item = $query->fetchObject('App\\Model\\LogRequest')){
                array_push($Logs, $item);
            }
            
            if(empty($Logs)){
                throw new Exception("Nenhum log encontrado");
            }
            
            return $Logs;
        }

        public static function GetLogById($id){
            $connect = Connection::GetConnection();

            $query = "SELECT * FROM log_api_requests WHERE LOG_ID = :LOG_ID";
            $query = $connect->prepare($query);
            $query->bindValue(":LOG_ID", $id, PDO::PARAM_INT);
            $query->execute();

            $Log = $query->fetchObject('App\\Model\\LogRequest');
            
            if(empty($Log)){
                throw new Exception("Nenhum log encontrado");
            }

            return $Log;
        }
    }