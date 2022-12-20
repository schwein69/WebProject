<?php 
class NotificationFunctions
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    
    function getChatsNotifications($user)
    {
        $query = "SELECT C.idChat, count(*) AS numMsgs, (SELECT max(msgTimestamp)
                                                        FROM messaggi M2
                                                        WHERE M2.idChat = C.idChat) AS tempo
                 FROM partecipazione P 
                 JOIN chat C ON P.idChat = C.idChat
                 JOIN messaggi M ON C.idChat = M.idChat
                 WHERE P.idUtente=? AND letto=0 AND M.idMittente<>?
                 GROUP BY C.idChat
                 ORDER BY tempo DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii",$user,$user);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return $queryRes->fetch_all(MYSQLI_ASSOC);
    }

    function getNotifications($user, $first, $num)
    {
        $query = "SELECT idUtenteNotificante, idPostRiferimento, nomeTipo, letto"
        ." FROM notifiche N"
        ." JOIN tipi T ON N.idTipo = T.idTipo"
        ." WHERE idUtente=? ORDER BY idNotifica LIMIT ?,?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iii",$user,$first, $num);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return $queryRes->fetch_all(MYSQLI_ASSOC);      
    }

    function getUnreadNotificationsNumber($user)
    {
        $query = "SELECT count(*)"
        ." FROM notifiche N"
        ." WHERE idUtente=? AND letto=0";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i",$user);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return $queryRes->fetch_all(MYSQLI_NUM)[0][0];
    }
    
    function readAllNotifications($user)
    {
        $stmt = $this->db->prepare("UPDATE notifiche SET letto=1 WHERE idUtente=?");
        $stmt->bind_param("i",$user);
        $stmt->execute();
    }
    
    function notifUser($user, $notifType, $targetId, $postId=-1)
    {
        $query = "INSERT INTO notifiche(idUtenteNotificante, idPostRiferimento, idTipo, idUtente)
                    VALUES (?,";
        $query .= $postId != -1 ? "?," : "NULL,";
        switch ($notifType) {
            case 'like':
                $query .= "1";
                break;
            
            case 'comment':
                $query .= "2";
                break;

            case 'follow':
                $query .= "3";
                break;

            default:
                die('Unknown notification type');
                break;
        }
        $query .= ",?)";
        $stmt = $this->db->prepare($query);
        if($postId != -1){
            $stmt->bind_param("iii",$user, $postId, $targetId);
        } else {
            $stmt->bind_param("ii",$user, $targetId);
        }
        $stmt->execute();
    }
}

?>