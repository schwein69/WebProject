<?php 
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    }

    public function checkLogin($username, $password){
        $query = "SELECT * FROM utenti WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }  

    public function insertNewUser($name, $password,$email,$date,$img){
        $query = "INSERT INTO utenti (username, password, email, dataDiNascita, fotoProfilo) VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss',$name, $password,$email,$date,$img);
        return $stmt->execute();
    }
    public function checkUsername($name){
        $query = "SELECT * FROM utenti WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkEmail($email){
        $query = "SELECT *  FROM utenti WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserData($idUser){
        $query = "SELECT * FROM utenti WHERE AND idAutore=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
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
    public function getRandomPosts($n){
        $stmt = $this->db->prepare("
                                    SELECT DISTINCT
                                            P.*, U.username, U.fotoProfilo, U.idUtente
                                        FROM
                                            posts P,
                                            utenti U,
                                            posttags T,
                                            contenutimultimediali C,
                                            tags TA
                                        WHERE
                                            P.idUser = U.idUtente AND T.idTag = TA.idTag AND T.idPost = P.idPost AND C.idPost = P.idPost
                                            ORDER BY RAND() LIMIT ?");
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getPostContents($postId){
        $stmt = $this->db->prepare("
                                    SELECT C.*
                                    FROM
                                    posts P,
                                    contenutimultimediali C
                                    WHERE
                                    C.idPost = P.idPost AND P.idPost=?");
        $stmt->bind_param('i',$postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>