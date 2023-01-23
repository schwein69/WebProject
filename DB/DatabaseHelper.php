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

    //--------------- OTHER FUNCTIONS ------------------

    public function getTags($tagName)
    {
        $query = "SELECT * FROM tags WHERE nomeTag like CONCAT ('%', ?, '%')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $tagName);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllLikes($idPost)
    {
        $query = "SELECT p.*,u.username,u.formatoFotoProfilo,u.idUtente FROM postpiaciuti p, utenti u WHERE p.idPost = ? AND p.idUtente = u.idUtente";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idPost);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>