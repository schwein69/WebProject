<?php
class UserFunctions
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function insertNewUser($name, $password, $email, $date, $img)
    {
        $query = "INSERT INTO utenti (username, pwd, email, dataDiNascita, formatoFotoProfilo) VALUES (?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $name, $password, $email, date('Y-m-d', strtotime($date)), $img);
        $stmt->execute();
        //return last id after insert
        return $this->db->insert_id;
    }

    //---------- USER DATA ----------

    public function checkUsername($name)
    {
        $query = "SELECT * FROM utenti WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return count($result->fetch_all(MYSQLI_ASSOC))>0;
    }

    public function checkEmail($email)
    {
        $query = "SELECT *  FROM utenti WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return count($result->fetch_all(MYSQLI_ASSOC))>0;
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

    public function getUserDataLogin($username)
    {
        $query = "SELECT * FROM utenti WHERE username = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //---------- USER RELATIONSHIPS ----------

    public function getNumFollowed($idUser)
    { //id dell'utente loggato
        $stmt = $this->db->prepare("
                                    SELECT count(*)
                                    FROM
                                        utenti U1,
                                        utenti U2,
                                        relazioniutenti RE
                                    WHERE
                                        U2.idUtente != U1.idUtente AND U1.idUtente = RE.idFollower AND U2.idUtente = RE.idFollowed AND U1.idUtente = ?;");
        $stmt->bind_param('i', $idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_NUM)[0][0];
    }
    public function getFollowed($idUser)
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

    public function getFollower($idUser)
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

    public function getNumFollower($idUser)
    { //id dell'utente loggato
        $stmt = $this->db->prepare("
                                SELECT count(*)
                                FROM
                                    utenti U1,
                                    utenti U2,
                                    relazioniutenti RE
                                WHERE
                                    U2.idUtente != U1.idUtente AND U2.idUtente = RE.idFollower AND U1.idUtente = RE.idFollowed AND U1.idUtente = ?;");
        $stmt->bind_param('i', $idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_NUM)[0][0];
    }

    function isFollowedByMe($userId,$adminId)
    {
        $stmt = $this->db->prepare("SELECT * FROM relazioniutenti WHERE idFollower=? AND idFollowed=?");
        $stmt->bind_param("ii", $userId, $adminId);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return count($queryRes->fetch_all(MYSQLI_ASSOC)) > 0;
    }
}

?>