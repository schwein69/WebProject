<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getUserDataLogin($username)
    {
        $query = "SELECT * FROM utenti WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertNewUser($name, $password, $email, $date, $img)
    {
        $query = "INSERT INTO utenti (username, password, email, dataDiNascita, fotoProfilo) VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $name, $password, $email, $date, $img);
        return $stmt->execute();
    }
    public function checkUsername($name)
    {
        $query = "SELECT * FROM utenti WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkEmail($email)
    {
        $query = "SELECT *  FROM utenti WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserData($idUser)
    {
        $query = "SELECT * FROM utenti WHERE idUtente=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getPostData($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE idPost=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $queryRes = $stmt->get_result();
        $res = $queryRes->fetch_all(MYSQLI_ASSOC);
        $numRes = count($res);
        return $numRes != 0 ? $res[0] : null;
    }

    public function getAuthorName($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM utenti WHERE idUtente=?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $queryRes = $stmt->get_result();
        $res = $queryRes->fetch_all(MYSQLI_ASSOC);
        $numRes = count($res);
        return $numRes != 0 ? $res[0] : null;
    }

    public function getPostComments($postId)
    {
        $query = "SELECT dataCommento, testo, U.idUtente, username, fotoProfilo
                    FROM commenti C 
                    JOIN Utenti U ON C.idUtente = U.idUtente
                    WHERE idPost=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $postId);
        $stmt->execute();

        $queryRes = $stmt->get_result();

        return $queryRes->fetch_all(MYSQLI_ASSOC);
    }
    public function getRandomPosts($idUser)
    {
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
                                    ORDER BY RAND() LIMIT 1;");
        $stmt->bind_param('i', $idUser);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRandomPostsWithArray($n, $idUser, $oldPostIds)
    {
        $query = "
                SELECT DISTINCT
                    P.*, U.username, U.fotoProfilo, U.idUtente
                FROM
                    posts P,
                    utenti U,
                    posttags T,
                    tags TA
                WHERE
                    P.idUser = U.idUtente AND T.idTag = TA.idTag AND T.idPost = P.idPost AND U.idUtente != ? AND P.idPost NOT IN (";


        $length = count($oldPostIds);
        for ($i = 0; $i < $length; $i++) {
            if (is_numeric($oldPostIds[$i])) {
                $query .= $oldPostIds[$i];
            } else {
                die("elements is not a number");
            }
            if ($i < $length - 1) {
                $query .= ",";
            }
        }
        $query .= ") ORDER BY RAND() LIMIT ?";

        //...decomprime array in stream

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $idUser, $n );
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSearchUser($username,$idUser)
    {
        $query = "SELECT idUtente,username,fotoProfilo,descrizione FROM utenti WHERE username like CONCAT ('%', ?, '%') AND idUtente != ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $username,$idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTags($tagName)
    {
        $query = "SELECT * FROM tags WHERE nomeTag like CONCAT ('%', ?, '%')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $tagName);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getSearchTagPosts($tag,$idUser,$start = 0,$end = 1)
    {
        $query = "
        SELECT DISTINCT
            P.*, U.username, U.fotoProfilo, U.idUtente
        FROM
            posts P,
            utenti U,
            posttags T,
            contenutimultimediali C,
            tags TA
        WHERE
            P.idUser = U.idUtente AND T.idTag = TA.idTag AND T.idPost = P.idPost AND C.idPost = P.idPost AND TA.nomeTag like CONCAT ('%', ?, '%') AND idUtente != ?
            ORDER BY P.dataPost DESC LIMIT ?,?";
       
        $stmt = $this->db->prepare($query);                  
        $stmt->bind_param('siii', $tag,$idUser,$start,$end);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfilePosts($n = -1, $idUser)
    {
        $query = "SELECT DISTINCT P.* FROM posts P, utenti U WHERE  P.idUser = U.idUtente AND U.idUtente = ?  ORDER BY P.dataPost DESC";
        if ($n > 0) {
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if ($n > 0) {
            $stmt->bind_param('ii', $idUser, $n);
        } else {
            $stmt->bind_param('i', $idUser);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowedPosts($idUser,$start=0,$end=1)
    { //id dell'utente loggato
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
                                    P.dataPost DESC LIMIT ?,?");
        $stmt->bind_param('iii', $idUser,$start,$end);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNumFollower($idUser)
    { //id dell'utente loggato
        $stmt = $this->db->prepare("
                                    SELECT DISTINCT *
                                    FROM
                                        utenti U1,
                                        utenti U2,
                                        relazioniutenti RE
                                    WHERE
                                        U2.idUtente != U1.idUtente AND U1.idUtente = RE.idFollower AND U2.idUtente = RE.idFollowed AND U1.idUtente = ?;");
        $stmt->bind_param('i', $idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNumFollowed($idUser)
    { //id dell'utente loggato
        $stmt = $this->db->prepare("
                                SELECT DISTINCT *
                                FROM
                                    utenti U1,
                                    utenti U2,
                                    relazioniutenti RE
                                WHERE
                                    U2.idUtente != U1.idUtente AND U2.idUtente = RE.idFollower AND U1.idUtente = RE.idFollowed AND U1.idUtente = ?;");
        $stmt->bind_param('i', $idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getPostContents($postId)
    {
        $stmt = $this->db->prepare("
                                    SELECT C.*
                                    FROM
                                    posts P,
                                    contenutimultimediali C
                                    WHERE
                                    C.idPost = P.idPost AND P.idPost=?");
        $stmt->bind_param('i', $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function insertPost($user, $testo, $dataPost)
    {
        $stmt = $this->db->prepare("INSERT INTO posts(idUser,testo,dataPost) VALUES (?,?,?)");
        $stmt->bind_param("iss", $user, $testo, $dataPost);
        $stmt->execute();
        return $this->db->insert_id;
    }

    private function getTagId($tag)
    {
        $stmt = $this->db->prepare("SELECT idTag FROM tags WHERE nomeTag=?");
        $stmt->bind_param("s", $tag);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        $res = $queryRes->fetch_all(MYSQLI_NUM);
        return count($res) > 0 ? $res[0][0] : -1;
    }

    private function insertTag($tag)
    {
        $stmt = $this->db->prepare("INSERT INTO tags(nomeTag) VALUES (?)");
        $stmt->bind_param("s", $tag);
        $stmt->execute();
        return $this->db->insert_id;
    }

    public function addTagsToPost($postId, $tags)
    {
        $stmt = $this->db->prepare("INSERT INTO posttags(idPost,idTag) VALUES (?,?)");
        foreach ($tags as $tag) {
            $tagId = $this->getTagId($tag);
            if ($tagId < 0) {
                $tagId = $this->insertTag($tag);
            }
            $stmt->bind_param("ii", $postId, $tagId);
            $stmt->execute();
        }
    }

    public function addMediaToPost($postId, $path, $desc, $fileType)
    {
        $stmt = $this->db->prepare("INSERT INTO contenutimultimediali(formato,percorso,idPost,descrizione) VALUES (?,?,?,?)");
        $stmt->bind_param("ssis", $fileType, $path, $postId, $desc);
        $stmt->execute();
    }

    public function getRecentChats($user, $initialChat = 0, $numChats = 5)
    {
        //retrieving chats
        $query = "SELECT idChat, usr1, usr2, anteprimachat, "
            . "(SELECT max(msgTimestamp) "
            . "FROM messaggi M "
            . "WHERE C.idChat = M.idChat) AS tempo "
            . "FROM chat C WHERE usr1=? OR usr2=? "
            . "ORDER BY tempo DESC "
            . "LIMIT ?,?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiii", $user, $user, $initialChat, $numChats);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        $result = $queryRes->fetch_all(MYSQLI_ASSOC);
        //retrieving info about users
        $stmt = $this->db->prepare("SELECT username, fotoProfilo FROM utenti WHERE idUtente=?");
        $chats = array();
        foreach ($result as $userchat) {
            $arrayElem["idChat"] = $userchat["idChat"];
            $arrayElem["anteprimaChat"] = $userchat["anteprimachat"];
            $arrayElem["idUtente"] = $userchat["usr1"] == $user
                ? $userchat["usr2"]
                : $userchat["usr1"];
            $stmt->bind_param("i", $arrayElem["idUtente"]);
            $stmt->execute();
            $queryRes = $stmt->get_result();
            $result = $queryRes->fetch_all(MYSQLI_ASSOC);
            $arrayElem["username"] = $result[0]['username'];
            $arrayElem["fotoProfilo"] = $result[0]['fotoProfilo'];
            array_push($chats, $arrayElem);
        }
        return $chats;
    }

    function isPostLiked($user, $postId)
    {
        $stmt = $this->db->prepare("SELECT * FROM postpiaciuti WHERE idUtente=? AND idPost=?");
        $stmt->bind_param("ii", $user, $postId);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return count($queryRes->fetch_all(MYSQLI_ASSOC)) > 0;
    }
    function isFollowedByMe($userId,$adminId)//seguito da me
    {
        $stmt = $this->db->prepare("SELECT * FROM relazioniutenti WHERE idFollower=? AND idFollowed=?");
        $stmt->bind_param("ii", $userId, $adminId);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return count($queryRes->fetch_all(MYSQLI_ASSOC)) > 0;
    }
    function followUser($userId, $adminId)
    {
        $stmt = $this->db->prepare("INSERT INTO relazioniutenti(idFollower,idFollowed) VALUES (?,?)");
        $stmt->bind_param("ii", $userId, $adminId);
        $stmt->execute();
    }
    function unfollowUser($userId, $adminId)
    {
        $stmt = $this->db->prepare("DELETE FROM relazioniutenti WHERE idFollower=? AND idFollowed=?");
        $stmt->bind_param("ii", $userId, $adminId);
        $stmt->execute();
    }
    function likePost($user, $postId)
    {
        $stmt = $this->db->prepare("INSERT INTO postpiaciuti(idUtente,idPost) VALUES (?,?)");
        $stmt->bind_param("ii", $user, $postId);
        $stmt->execute();
        $stmt = $this->db->prepare('UPDATE posts SET numLike=numLike+1 WHERE idPost=?');
        $stmt->bind_param("i", $postId);
        $stmt->execute();
    }
    function dislikePost($user, $postId)
    {
        $stmt = $this->db->prepare("DELETE FROM postpiaciuti WHERE idUtente=? AND idPost=?");
        $stmt->bind_param("ii", $user, $postId);
        $stmt->execute();
        $stmt = $this->db->prepare('UPDATE posts SET numLike=numLike-1 WHERE idPost=?');
        $stmt->bind_param("i", $postId);
        $stmt->execute();
    }
    //it fetches chat messages starting from the last and goint up to numMsgs messages
    public function getRecentMessagesFromChat($chat, $initialMsg = 0, $numMsgs = 10)
    {
        //retrieving chats
        $query = "SELECT testoMsg, msgTimestamp, letto, idMittente "
            . "FROM messaggi WHERE idChat=? "
            . "ORDER BY msgTimestamp DESC "
            . "LIMIT ?,?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii", $chat, $initialMsg, $numMsgs);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return $queryRes->fetch_all(MYSQLI_ASSOC);
        ;
    }
    function changeTheme($userId, $newTheme)
    {
        $stmt = $this->db->prepare('UPDATE utenti SET tema=? WHERE idUtente=?');
        $stmt->bind_param("si", $newTheme, $userId);
        $stmt->execute();
    }

}
?>