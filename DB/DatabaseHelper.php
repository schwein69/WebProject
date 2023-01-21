<?php
require 'UserFunctions.php';
require 'PostFunctions.php';
require 'ChatFunctions.php';
require 'NotificationFunctions.php';

class DatabaseHelper
{
    private $db;
    private $userFunctions;
    private $postFunctions;
    private $chatFunctions;
    private $notifFunctions;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
        $this->userFunctions = new UserFunctions($this->db);
        $this->postFunctions = new PostFunctions($this->db);
        $this->chatFunctions = new ChatFunctions($this->db);
        $this->notifFunctions = new NotificationFunctions($this->db);
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
    public function getFollowed($idUser)
    {
        return $this->userFunctions->getFollowed($idUser);

    }

    public function getFollower($idUser)
    {
        return $this->userFunctions->getFollower($idUser);

    }
    public function getNumFollowed($idUser)
    {
        return $this->userFunctions->getNumFollowed($idUser);

    }

    public function isFollowedByMe($userId, $adminId)
    {
        return $this->userFunctions->isFollowedByMe($userId, $adminId);
    }

    public function updateKeepLogin($userId,$code)
    {
        $this->userFunctions->updateKeepLogin($userId, $code);
    }

    public function getUserByKeepConnectionCode($code)
    {
        return $this->userFunctions->getUserByKeepConnectionCode($code);
    }

    //--------------- POST FUNCTIONS ------------------

    public function getPostData($id)
    {
        return $this->postFunctions->getPostData($id);
    }

    public function getPostTags($postId)
    {
        return $this->postFunctions->getPostTags($postId);
    }

    public function getPostComments($postId)
    {
        return $this->postFunctions->getPostComments($postId);
    }

    public function addCommentToPost($user, $postId, $testo)
    {
        $this->postFunctions->addCommentToPost($user, $postId, $testo);
    }

    public function getRandomPosts($idUser, $oldPostIds=array(), $n=5)
    {
        return $this->postFunctions->getRandomPosts($idUser,$oldPostIds, $n);
    }

    public function getProfilePosts($n = -1, $idUser)
    {
        return $this->postFunctions->getProfilePosts($n, $idUser);

    }

    public function getFollowedPosts($idUser, $start = 0, $end = 7)
    {
        return $this->postFunctions->getFollowedPosts($idUser, $start, $end);

    }

    public function getSavedPosts($idUser, $start = 0, $end = 7)
    {
        return $this->postFunctions->getSavedPosts($idUser, $start, $end);

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

    function isPostSaved($user, $postId)
    {
        return $this->postFunctions->isPostSaved($user, $postId);
    }

    function savePost($user, $postId)
    {
        $this->postFunctions->savePost($user, $postId);
    }

    function unsavePost($user, $postId)
    {
        $this->postFunctions->unsavePost($user, $postId);
    }

    function removePost($postId)
    {
        $this->postFunctions->removePost($postId);
    }

    function updatePost($postId, $testo, $dataPost)
    {
        $this->postFunctions->updatePost($postId, $testo, $dataPost);
    }

    function deletePostMedia($mediaId)
    {
        $this->postFunctions->deletePostMedia($mediaId);
    }
    
    function removeTagsFromPost($postId)
    {
        $this->postFunctions->removeTagsFromPost($postId);
    }

    //--------------- CHAT FUNCTIONS ------------------

    public function isUserInChat($chatId, $user)
    {
        return $this->chatFunctions->isUserInChat($chatId, $user);
    }

    public function activateChat($idChat)
    {
        return $this->chatFunctions->activateChat($idChat);
    }

    public function deactivateChat($idChat)
    {
        return $this->chatFunctions->deactivateChat($idChat);
    }

    public function getChatUser($chatId, $user1)
    {
        return $this->chatFunctions->getChatUser($chatId, $user1);
    }

    public function getRecentChats($user, $user2 = "", $initialChat = 0, $numChats = 5)
    {
        return $this->chatFunctions->getRecentChats($user, $user2, $initialChat, $numChats);
    }

    public function getRecentMessagesFromChat($chat, $initialMsg = 0, $numMsgs = 10, $letto = true, $user = -1)
    {
        return $this->chatFunctions->getRecentMessagesFromChat($chat, $initialMsg, $numMsgs, $letto, $user);
    }

    public function insertMessage($chatid, $user, $msg)
    {
        $this->chatFunctions->insertMessage($chatid, $user, $msg);
    }

    public function updateChatPreview($chatid, $msg)
    {
        $this->chatFunctions->updateChatPreview($chatid, $msg);
    }

    public function readAllMessages($chatId, $user)
    {
        $this->chatFunctions->readAllMessages($chatId, $user);
    }

    public function createChat($admin, $user)
    {
        return $this->chatFunctions->createChat($admin, $user);
    }

    public function getChatWithUsers($user1,$user2){
        return $this->chatFunctions->getChatWithUsers($user1,$user2);
    }

    public function isChatActive($idChat){
        return $this->chatFunctions->isChatActive($idChat);
    }

    public function chatCreated($admin, $user)
    { 
        $stmt = $this->db->prepare("SELECT p.* FROM partecipazione p WHERE p.idUtente=? AND p.idChat in (SELECT a.idChat FROM partecipazione a WHERE a.idUtente = ?)");
        $stmt->bind_param("ii",$admin,$user);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return count($queryRes->fetch_all(MYSQLI_ASSOC)) > 0;
    }

    //--------------- NOTIFICATION FUNCTIONS ------------------

    function getChatsNotifications($user)
    {
        return $this->notifFunctions->getChatsNotifications($user);
    }

    function getNotifications($user, $first = 0, $num = 5)
    {
        return $this->notifFunctions->getNotifications($user, $first, $num);
    }

    function getUnreadNotificationsNumber($user)
    {
        return $this->notifFunctions->getUnreadNotificationsNumber($user);
    }

    function readAllNotifications($user)
    {
        $this->notifFunctions->readAllNotifications($user);
    }

    function notifUserLike($userId, $postId, $targetId)
    {
        $this->notifFunctions->notifUser($userId, "like", $targetId, $postId);
    }

    function notifUserComment($userId, $postId, $targetId)
    {
        $this->notifFunctions->notifUser($userId, "comment", $targetId, $postId);
    }

    function notifUserFollow($userId, $targetId)
    {
        $this->notifFunctions->notifUser($userId, "follow", $targetId);
    }

    function getUnreadChatMessages($user, $chat){
        return $this->notifFunctions->getUnreadChatMessages($user, $chat);
    }
    //--------------- OTHER FUNCTIONS ------------------

    public function getSearchUser($username, $idUser)
    {
        $query = "SELECT idUtente,username,formatoFotoProfilo,descrizione FROM utenti WHERE username like CONCAT ('%', ?, '%') AND idUtente != ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $username, $idUser);
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

    public function getSearchTagPosts($tag, $idUser, $start = 0, $end = 1)
    {
        $query = "
        SELECT DISTINCT
            P.*, U.username, U.formatoFotoProfilo, U.idUtente
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
        $stmt->bind_param('siii', $tag, $idUser, $start, $end);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
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
    function changeLanguage($userId, $newLanguage)
    {
        $stmt = $this->db->prepare('UPDATE utenti SET lang=? WHERE idUtente=?');
        $stmt->bind_param("si", $newLanguage, $userId);
        $stmt->execute();
    }

    function changeTheme($userId, $newTheme)
    {
        $stmt = $this->db->prepare('UPDATE utenti SET tema=? WHERE idUtente=?');
        $stmt->bind_param("si", $newTheme, $userId);
        $stmt->execute();
    }
    function generateCode($email, $code)
    {
        $stmt = $this->db->prepare("UPDATE utenti SET codiceRecupero = ? WHERE email = ?");
        $stmt->bind_param("ss", $code, $email);
        $stmt->execute();
    }
    public function checkCode($code)
    {
        $query = "SELECT * FROM utenti WHERE codiceRecupero = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();
        return count($result->fetch_all(MYSQLI_ASSOC)) > 0;
    }

    public function getUserDataByCode($code)
    {
        $query = "SELECT * FROM utenti WHERE codiceRecupero = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    function changePassword($pass, $idUtente)
    {
        $stmt = $this->db->prepare("UPDATE utenti SET pwd = ? WHERE idUtente = ?");
        $stmt->bind_param("si", $pass, $idUtente);
        $stmt->execute();
        $stmt = $this->db->prepare("UPDATE utenti SET codiceRecupero = NULL WHERE idUtente = ?");
        $stmt->bind_param("i", $idUtente);
        $stmt->execute();

    }

    function updateUsername($username, $userId)
    {
        $stmt = $this->db->prepare("UPDATE utenti SET username = ? WHERE idUtente = ?");
        $stmt->bind_param("si", $username, $userId);
        $stmt->execute();
    }

    function updateUserEmail($email, $userId)
    {
        $stmt = $this->db->prepare("UPDATE utenti SET email = ? WHERE idUtente = ?");
        $stmt->bind_param("si", $email, $userId);
        $stmt->execute();
    }
    function updateUserAvatar($avatar, $userId)
    {
        $stmt = $this->db->prepare("UPDATE utenti SET formatoFotoProfilo = ? WHERE idUtente = ?");
        $stmt->bind_param("si", $avatar, $userId);
        $stmt->execute();
    }
    public function updateUseBirthday($date, $userId)
    {
        $query = "UPDATE utenti SET dataDiNascita=? WHERE idUtente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $date, $userId);
        $stmt->execute();
    }




}
?>