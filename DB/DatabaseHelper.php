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

    public function getUserFunctionHandler()
    {
        return $this->userFunctions;
    }

    public function getPostFunctionHandler()
    {
        return $this->postFunctions;
    }

    public function getChatFunctionHandler()
    {
        return $this->chatFunctions;
    }

    public function getNotificationFunctionHandler()
    {
        return $this->notifFunctions;
    }

    public function chatCreated($admin, $user)
    { 
        $stmt = $this->db->prepare("SELECT p.* FROM partecipazione p WHERE p.idUtente=? AND p.idChat in (SELECT a.idChat FROM partecipazione a WHERE a.idUtente = ?)");
        $stmt->bind_param("ii",$admin,$user);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return count($queryRes->fetch_all(MYSQLI_ASSOC)) > 0;
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