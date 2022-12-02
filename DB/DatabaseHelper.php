<?php 
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    }

    public function getPostData($id){
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE idPost=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();

        $queryRes = $stmt->get_result();
        $res = $queryRes->fetch_all(MYSQLI_ASSOC);
        $numRes = count($res);
        return $numRes != 0 ? $res[0] : null;
    }

    public function getAuthorName($userId){
        $stmt = $this->db->prepare("SELECT * FROM utenti WHERE idUtente=?");
        $stmt->bind_param("i",$userId);
        $stmt->execute();

        $queryRes = $stmt->get_result();
        $res = $queryRes->fetch_all(MYSQLI_ASSOC);
        $numRes = count($res);
        return $numRes != 0 ? $res[0] : null;
    }

    public function getPostComments($postId){
        $query = "SELECT dataCommento, testo, U.idUtente, username, fotoProfilo
                    FROM commenti C 
                    JOIN Utenti U ON C.idUtente = U.idUtente
                    WHERE idPost=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i",$postId);
        $stmt->execute();

        $queryRes = $stmt->get_result();
        
        return $queryRes->fetch_all(MYSQLI_ASSOC);
    }
}
?>