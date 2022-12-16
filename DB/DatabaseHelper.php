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
        $query = "SELECT * FROM utenti WHERE username = ? AND pwd = ?";
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
        $query = "SELECT * FROM utenti WHERE idUtente=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0];
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

    public function addCommentToPost($user,$postId, $testo){
        $query = "INSERT INTO commenti(dataCommento, testo, idPost,idUtente)
                VALUES (NOW(),?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sii",$testo,$postId, $user);
        $stmt->execute();
    }
    
    public function getRandomPosts($n,$idUser){
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
                                    P.idUser = U.idUtente AND T.idTag = TA.idTag AND T.idPost = P.idPost AND C.idPost = P.idPost AND U.idUtente != ?
                                    ORDER BY RAND() LIMIT ?;");
        $stmt->bind_param('ii',$idUser,$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfilePosts($n,$idUser){
        $stmt = $this->db->prepare("
                                SELECT DISTINCT
                                    P.*
                                FROM
                                    posts P,
                                    utenti U
                                WHERE
                                    P.idUser = U.idUtente AND U.idUtente = ?
                                ORDER BY
                                    P.dataPost
                                LIMIT ?;");
        $stmt->bind_param('ii',$idUser,$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowedPosts($idUser){//id dell'utente loggato
        $stmt = $this->db->prepare("
                                SELECT DISTINCT
                                    P.*,
                                    U2.username,
                                    U2.fotoProfilo,
                                    U2.idUtente
                                FROM
                                    posts P,
                                    utenti U1,
                                    utenti U2,
                                    posttags T,
                                    relazioniutenti RE,
                                    contenutimultimediali C,
                                    tags TA
                                WHERE
                                    P.idUser = U2.idUtente AND T.idTag = TA.idTag AND T.idPost = P.idPost AND C.idPost = P.idPost AND U2.idUtente != U1.idUtente AND U1.idUtente = RE.idFollower AND U2.idUtente = RE.idFollowed
                                    AND U1.idUtente = ?
                                ORDER BY
                                    P.dataPost;");
        $stmt->bind_param('i',$idUser);
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

    public function getChatUser($chatId, $user1){
        $query = "SELECT U.idUtente, username, fotoProfilo "
                ."FROM utenti U "
                ."JOIN partecipazione P ON U.idUtente=P.idUtente "
                ."WHERE idChat=? AND U.idUtente<>?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii",$chatId,$user1);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return $queryRes->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getRecentChats($user,$user2="",$initialChat=0, $numChats=5){
        //retrieving chats
       $query = "SELECT C.idChat, P.idUtente, username, fotoProfilo, anteprimaChat, "
                   ."(SELECT max(msgTimestamp) "
                   ."FROM messaggi M "
                   ."WHERE C.idChat = M.idChat) AS tempo "
                ."FROM chat C "
                ."JOIN partecipazione P ON C.idChat=P.idChat "
                ."JOIN utenti U ON U.idUtente=P.idUtente "
                ."WHERE P.idUtente<>? ";
        
        if($user2 != ""){
            $query .= 'AND username LIKE ? ';
        }
        $query .= "AND C.idChat IN (SELECT C2.idChat "
                                    ."FROM chat C2 "
                                    ."JOIN partecipazione P2 ON P2.idChat = C2.idChat "
                                    ."WHERE idUtente=?) "
                ."ORDER BY tempo DESC "
                ."LIMIT ?,?";
        $stmt = $this->db->prepare($query);
  
        if($user2 != ""){
            $usrPattern = "%".$user2."%";
            $stmt->bind_param("isiii",$user,$usrPattern,$user,$initialChat,$numChats);
        }else{
            $stmt->bind_param("iiii",$user,$user,$initialChat,$numChats);
        }
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return $queryRes->fetch_all(MYSQLI_ASSOC);
    }
    //it fetches chat messages starting from the last and goint up to numMsgs messages
    public function getRecentMessagesFromChat($chat, $initialMsg=0, $numMsgs=10){
        //retrieving chats
        $query = "SELECT testoMsg, msgTimestamp, letto, idMittente "
                ."FROM messaggi WHERE idChat=? "
                ."ORDER BY msgTimestamp DESC "
                ."LIMIT ?,?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii",$chat,$initialMsg,$numMsgs);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return $queryRes->fetch_all(MYSQLI_ASSOC);;
    }

    public function insertMessage($chatid,$user,$msg) {
        $stmt = $this->db->prepare("INSERT INTO messaggi(testoMsg,msgTimestamp,letto,idMittente, idChat) VALUES (?,NOW(),0,?,?)");
        $stmt->bind_param("sii",$msg,$user,$chatid);
        $stmt->execute();
    }

    public function updateChatPreview($chatid,$msg) {
        $stmt = $this->db->prepare("UPDATE chat SET anteprimaChat=? WHERE idChat=?");
        $stmt->bind_param("si",$msg,$chatid);
        $stmt->execute();
    }

    function isPostLiked($user, $postId){
        $stmt = $this->db->prepare("SELECT * FROM postpiaciuti WHERE idUtente=? AND idPost=?");
        $stmt->bind_param("ii",$user,$postId);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return count($queryRes->fetch_all(MYSQLI_ASSOC)) > 0;
    }
    function likePost($user, $postId){
        $stmt = $this->db->prepare("INSERT INTO postpiaciuti(idUtente,idPost) VALUES (?,?)");
        $stmt->bind_param("ii",$user,$postId);
        $stmt->execute();
        $stmt = $this->db->prepare('UPDATE posts SET numLike=numLike+1 WHERE idPost=?');
        $stmt->bind_param("i",$postId);
        $stmt->execute();
    }
    function dislikePost($user, $postId){
        $stmt = $this->db->prepare("DELETE FROM postpiaciuti WHERE idUtente=? AND idPost=?");
        $stmt->bind_param("ii",$user,$postId);
        $stmt->execute();
        $stmt = $this->db->prepare('UPDATE posts SET numLike=numLike-1 WHERE idPost=?');
        $stmt->bind_param("i",$postId);
        $stmt->execute();
    }

    function getNotifications($user, $first=0, $num=5){
        $query =    "SELECT idUtenteNotificante, idPostRiferimento, nomeTipo, letto"
        ." FROM notifiche N"
        ." JOIN tipi T ON N.idTipo = T.idTipo"
        ." WHERE idUtente=? ORDER BY idNotifica LIMIT ?,?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii",$user,$first, $num);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return $queryRes->fetch_all(MYSQLI_ASSOC);      
    }
}
?>