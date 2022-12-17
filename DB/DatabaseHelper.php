<?php
require 'UserFunctions.php';
require 'PostFunctions.php';
require 'ChatFunctions.php';

class DatabaseHelper{
    private $db;
    private $userFunctions;
    private $postFunctions;
    private $chatFunctions;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $this->userFunctions = new UserFunctions($this->db);
        $this->postFunctions = new PostFunctions($this->db);
        $this->chatFunctions = new ChatFunctions($this->db);
    }

    //--------------- USER FUNCTIONS ------------------

    public function getUserDataLogin($username)
    {
        return $this->userFunctions->getUserDataLogin($username);
    }

    public function insertNewUser($name, $password, $email, $date, $img)
    {
        return $this->userFunctions->insertNewUser($name, $password, $email, $date, $img);
    }
    public function checkUsername($name)
    {
        return $this->userFunctions->checkUsername($name);
    }

    public function checkEmail($email)
    {
        return $this->userFunctions->checkEmail($email);
    }

    public function getUserData($idUser)
    {
        return $this->userFunctions->getUserData($idUser);
    }

    public function getNumFollower($idUser)
    {
        return $this->userFunctions->getNumFollower($idUser);

    }

    public function getNumFollowed($idUser)
    {
        return $this->userFunctions->getNumFollowed($idUser);

    }

    function isFollowedByMe($userId,$adminId)
    {
        return $this->userFunctions->isFollowedByMe($userId,$adminId);
    }

    //--------------- POST FUNCTIONS ------------------

    public function getPostData($id)
    {
        return $this->postFunctions->getPostData($id);
    }

    public function getPostComments($postId)
    {
        return $this->postFunctions->getPostComments($postId);
    }

    public function addCommentToPost($user,$postId, $testo)
    {
        $this->postFunctions->addCommentToPost($user,$postId, $testo);
    }
    
    public function getRandomPosts($idUser)
    {
        return $this->postFunctions->getRandomPosts($idUser);
    }

    public function getRandomPostsWithArray($n, $idUser, $oldPostIds)
    {
        return $this->postFunctions->getRandomPostsWithArray($n, $idUser, $oldPostIds);

    }

    public function getProfilePosts($n = -1, $idUser)
    {
        return $this->postFunctions->getProfilePosts($n, $idUser);

    }

    public function getFollowedPosts($idUser,$start=0,$end=1)
    {
        return $this->postFunctions->getFollowedPosts($idUser,$start,$end);

    }

    public function insertPost($user, $testo, $dataPost)
    {
        return $this->postFunctions->insertPost($user, $testo, $dataPost);

    }

    public function getPostContents($postId)
    {
        return $this->postFunctions->getPostContents($postId);
    }

    public function addTagsToPost($postId, $tags)
    {
        $this->postFunctions->addTagsToPost($postId, $tags);
    }

    public function addMediaToPost($postId, $path, $desc, $fileType)
    {
        $this->postFunctions->addMediaToPost($postId, $path, $desc, $fileType);

    }

    function isPostLiked($user, $postId)
    {
        return $this->postFunctions->isPostLiked($user, $postId);
    }

    function likePost($user, $postId)
    {
        $this->postFunctions->likePost($user, $postId);
    }

    function dislikePost($user, $postId)
    {
        $this->postFunctions->dislikePost($user, $postId);
    }

    //--------------- CHAT FUNCTIONS ------------------

    public function isUserInChat($chatId, $user)
    {
        return $this->chatFunctions->isUserInChat($chatId, $user);
    }

    public function getChatUser($chatId, $user1)
    {
        return $this->chatFunctions->getChatUser($chatId, $user1);
    }

    public function getRecentChats($user,$user2="",$initialChat=0, $numChats=5)
    {
        return $this->chatFunctions->getRecentChats($user,$user2,$initialChat, $numChats);    
    }
    
    public function getRecentMessagesFromChat($chat, $initialMsg=0, $numMsgs=10)
    {
        return $this->chatFunctions->getRecentMessagesFromChat($chat, $initialMsg, $numMsgs);    
    }

    public function insertMessage($chatid,$user,$msg)
    {
        $this->chatFunctions->insertMessage($chatid,$user,$msg);    
    }

    public function updateChatPreview($chatid,$msg)
    {
        $this->chatFunctions->updateChatPreview($chatid,$msg);    
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

    function getNotifications($user, $first=0, $num=5)
    {
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