<?php
class UserFunctions
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insertNewUser($name, $password, $email, $date, $img, $lang)
    {
        $query = "INSERT INTO utenti (username, pwd, email, dataDiNascita, formatoFotoProfilo, lang) VALUES (?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        $bday = date('Y-m-d', strtotime($date));
        $stmt->bind_param('ssssss', $name, $password, $email, $bday, $img, $lang);
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
        return count($result->fetch_all(MYSQLI_ASSOC)) > 0;
    }

    public function checkEmail($email)
    {
        $query = "SELECT *  FROM utenti WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return count($result->fetch_all(MYSQLI_ASSOC)) > 0;
    }

    public function checkRecoveryCode($code)
    {
        $query = "SELECT * FROM utenti WHERE codiceRecupero = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();
        return count($result->fetch_all(MYSQLI_ASSOC)) > 0;
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

    public function getUserDataByRecoveryCode($code)
    {
        $query = "SELECT * FROM utenti WHERE codiceRecupero = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $code);
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

    public function getUserByKeepConnectionCode($code)
    {
        $query = "SELECT idUtente, username, tema, lang FROM utenti WHERE keepCon=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $queyResult = $stmt->get_result();
        $result = $queyResult->fetch_all(MYSQLI_ASSOC);
        return count($result) > 0 ? $result[0] : null;
    }

    public function getSearchUser($username, $idUser)
    {
        $query = "SELECT idUtente,username,formatoFotoProfilo,descrizione FROM utenti WHERE username like CONCAT ('%', ?, '%') AND idUtente != ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $username, $idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function checkUserExist($idUser)
    {
        $query = "SELECT * FROM utenti WHERE idUtente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idUser);
        $stmt->execute();
        $result = $stmt->get_result();
        return count($result->fetch_all(MYSQLI_ASSOC)) > 0;
    }

    //---------- USER RELATIONSHIPS ----------

    //count total users followed by idUser
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
    //get users followed by idUser
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

    //get users who follow idUser
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

    //count total users who follow idUser
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

    public function isFollowedByMe($userId, $adminId)
    {
        $stmt = $this->db->prepare("SELECT * FROM relazioniutenti WHERE idFollower=? AND idFollowed=?");
        $stmt->bind_param("ii", $userId, $adminId);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return count($queryRes->fetch_all(MYSQLI_ASSOC)) > 0;
    }

    //---------- UPDATE DATA ----------

    public function updateKeepLogin($userId, $code)
    {
        $stmt = $this->db->prepare("UPDATE utenti SET keepCon=? WHERE idUtente=?");
        $stmt->bind_param("si", $code, $userId);
        $stmt->execute();
    }

    public function addRecoveryCode($email, $code)
    {
        $stmt = $this->db->prepare("UPDATE utenti SET codiceRecupero = ? WHERE email = ?");
        $stmt->bind_param("ss", $code, $email);
        $stmt->execute();
    }

    public function followUser($userId, $adminId)
    {
        $stmt = $this->db->prepare("INSERT INTO relazioniutenti(idFollower,idFollowed) VALUES (?,?)");
        $stmt->bind_param("ii", $userId, $adminId);
        $stmt->execute();
    }

    public function unfollowUser($userId, $adminId)
    {
        $stmt = $this->db->prepare("DELETE FROM relazioniutenti WHERE idFollower=? AND idFollowed=?");
        $stmt->bind_param("ii", $userId, $adminId);
        $stmt->execute();
    }

    public function changeLanguage($userId, $newLanguage)
    {
        $stmt = $this->db->prepare('UPDATE utenti SET lang=? WHERE idUtente=?');
        $stmt->bind_param("si", $newLanguage, $userId);
        $stmt->execute();
    }

    public function changeTheme($userId, $newTheme)
    {
        $stmt = $this->db->prepare('UPDATE utenti SET tema=? WHERE idUtente=?');
        $stmt->bind_param("si", $newTheme, $userId);
        $stmt->execute();
    }

    public function updatePassword($pass, $idUtente)
    {
        $stmt = $this->db->prepare("UPDATE utenti SET pwd = ? WHERE idUtente = ?");
        $stmt->bind_param("si", $pass, $idUtente);
        $stmt->execute();
        $stmt = $this->db->prepare("UPDATE utenti SET codiceRecupero = NULL WHERE idUtente = ?");
        $stmt->bind_param("i", $idUtente);
        $stmt->execute();
    }

    public function updateUsername($username, $userId)
    {
        $stmt = $this->db->prepare("UPDATE utenti SET username = ? WHERE idUtente = ?");
        $stmt->bind_param("si", $username, $userId);
        $stmt->execute();
    }

    public function updateUserEmail($email, $userId)
    {
        $stmt = $this->db->prepare("UPDATE utenti SET email = ? WHERE idUtente = ?");
        $stmt->bind_param("si", $email, $userId);
        $stmt->execute();
    }

    public function updateUserAvatar($avatar, $userId)
    {
        $stmt = $this->db->prepare("UPDATE utenti SET formatoFotoProfilo = ? WHERE idUtente = ?");
        $stmt->bind_param("si", $avatar, $userId);
        $stmt->execute();
    }

    public function updateUserBirthday($date, $userId)
    {
        $query = "UPDATE utenti SET dataDiNascita=? WHERE idUtente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $date, $userId);
        $stmt->execute();
    }
    public function updateUserDescription($userId, $description)
    {
        $query = "UPDATE utenti SET descrizione=? WHERE idUtente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $description, $userId);
        $stmt->execute();
    }
    public function removeUser($userId)
    {
        $stmt = $this->db->prepare("DELETE FROM utenti WHERE idUtente =?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
    }
}

?>