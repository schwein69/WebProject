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

    public function insertPost($user, $testo, $dataPost){
        $stmt = $this->db->prepare("INSERT INTO posts(idUser,testo,dataPost) VALUES (?,?,?)");
        $stmt->bind_param("iss",$user,$testo,$dataPost);
        $stmt->execute();
        return $this->db->insert_id;
    }

    private function getTagId($tag) {
        $stmt = $this->db->prepare("SELECT idTag FROM tags WHERE nomeTag=?");
        $stmt->bind_param("s",$tag);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        $res = $queryRes->fetch_all(MYSQLI_NUM);
        return count($res) > 0 ? $res[0][0] : -1;
    }

    private function insertTag($tag) {
        $stmt = $this->db->prepare("INSERT INTO tags(nomeTag) VALUES (?)");
        $stmt->bind_param("s",$tag);
        $stmt->execute();
        return $this->db->insert_id;
    }

    public function addTagsToPost($postId, $tags){
        $stmt = $this->db->prepare("INSERT INTO posttags(idPost,idTag) VALUES (?,?)");
        foreach($tags as $tag){
            $tagId = $this->getTagId($tag);
            if($tagId < 0){
                $tagId = $this->insertTag($tag);
            }
            $stmt->bind_param("ii",$postId,$tagId);
            $stmt->execute();
        }
    }

    public function addMediaToPost($postId, $path, $desc, $fileType){
        $stmt = $this->db->prepare("INSERT INTO contenutimultimediali(formato,percorso,idPost,descrizione) VALUES (?,?,?,?)");    
        $stmt->bind_param("ssis",$fileType,$path,$postId,$desc);
        $stmt->execute();  
    }

    public function getRecentChats($user, $initialChat=0, $numChats=5){
        //retrieving chats
       $query = "SELECT idChat, usr1, usr2, anteprimachat, "
                   ."(SELECT max(msgTimestamp) "
                   ."FROM messaggi M "
                   ."WHERE C.idChat = M.idChat) AS tempo "
                ."FROM chat C WHERE usr1=? OR usr2=? "
                ."ORDER BY tempo DESC "
                ."LIMIT ?,?";
        $stmt = $this->db->prepare($query);    
        $stmt->bind_param("iiii",$user,$user,$initialChat,$numChats);
        $stmt->execute();
        $queryRes = $stmt->get_result(); 
        $result = $queryRes->fetch_all(MYSQLI_ASSOC);
        //retrieving info about users
        $stmt = $this->db->prepare("SELECT username, fotoProfilo FROM utenti WHERE idUtente=?");
        $chats = array();
        foreach($result as $userchat){
            $arrayElem["idChat"] = $userchat["idChat"]; 
            $arrayElem["anteprimaChat"] = $userchat["anteprimachat"];
            $arrayElem["idUtente"] = $userchat["usr1"] == $user
                                    ? $userchat["usr2"]
                                    : $userchat["usr1"];
            $stmt->bind_param("i",$arrayElem["idUtente"]);
            $stmt->execute();
            $queryRes = $stmt->get_result(); 
            $result = $queryRes->fetch_all(MYSQLI_ASSOC);
            $arrayElem["username"] = $result[0]['username'];
            $arrayElem["fotoProfilo"] = $result[0]['fotoProfilo'];
            array_push($chats,$arrayElem);      
        }
        var_dump($chats);
        return $chats;
    }
}
?>