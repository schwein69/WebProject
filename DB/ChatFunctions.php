<?php 
class ChatFunctions
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function readAllMessages($chatId, $user)
    {
        $query = "UPDATE messaggi
                SET letto=1
                WHERE idChat=? AND idMittente<>? AND ? IN (SELECT idUtente
                                                                FROM partecipazione
                                                                WHERE idChat=?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiii",$chatId,$user,$user,$chatId);
        $stmt->execute();
    }

    public function isUserInChat($chatId, $user)
    {
        $query = "SELECT idUtente FROM partecipazione WHERE idChat=? AND idUtente=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii",$chatId,$user);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return count($queryRes->fetch_all(MYSQLI_ASSOC)) > 0;
    }

    public function getChatUser($chatId, $user1)
    {
        $query = "SELECT U.idUtente, username, formatoFotoProfilo "
                ."FROM utenti U "
                ."JOIN partecipazione P ON U.idUtente=P.idUtente "
                ."WHERE idChat=? AND U.idUtente<>?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii",$chatId,$user1);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return $queryRes->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getRecentChats($user,$user2,$initialChat, $numChats)
    {
        //retrieving chats
        $query = "SELECT C.idChat, P.idUtente, username, formatoFotoProfilo, anteprimaChat, "
                   ."(SELECT max(msgTimestamp) "
                   ."FROM messaggi M "
                   ."WHERE C.idChat = M.idChat) AS tempo "
                ."FROM chat C "
                ."JOIN partecipazione P ON C.idChat=P.idChat "
                ."JOIN utenti U ON U.idUtente=P.idUtente "
                ."WHERE C.attiva=1 AND P.idUtente<>? ";
        
        if($user2 != ""){
            $query .= 'AND username LIKE ? ';
        }
        $query .= "AND C.idChat IN (SELECT C2.idChat "
                                    ."FROM chat C2 "
                                    ."JOIN partecipazione P2 ON P2.idChat = C2.idChat "
                                    ."WHERE idUtente=?) "
                ."ORDER BY tempo DESC, idChat DESC "
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
    public function getRecentMessagesFromChat($chat, $initialMsg, $numMsgs, $letto, $user)
    {
        //retrieving chats
        $query = "SELECT testoMsg, msgTimestamp, letto, idMittente
                 FROM messaggi WHERE idChat=? ";
        if(!$letto){
            $query .= "AND (letto=0 AND idMittente<>?) ";
        }

        $query .= "ORDER BY msgTimestamp DESC "
                ."LIMIT ?,?";
        $stmt = $this->db->prepare($query);
        if($letto){
            $stmt->bind_param("iii",$chat,$initialMsg,$numMsgs);
        } else {
            $stmt->bind_param("iiii",$chat,$user,$initialMsg,$numMsgs);
        }
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return $queryRes->fetch_all(MYSQLI_ASSOC);;
    }

    public function insertMessage($chatid,$user,$msg)
    {
        $stmt = $this->db->prepare("INSERT INTO messaggi(testoMsg,msgTimestamp,letto,idMittente, idChat) VALUES (?,NOW(),0,?,?)");
        $stmt->bind_param("sii",$msg,$user,$chatid);
        $stmt->execute();
    }

    public function updateChatPreview($chatid,$msg)
    {
        $stmt = $this->db->prepare("UPDATE chat SET anteprimaChat=? WHERE idChat=?");
        $stmt->bind_param("si",$msg,$chatid);
        $stmt->execute();
    }

    public function createChat($admin,$user)
    {
        $stmt = $this->db->prepare("INSERT INTO chat(anteprimaChat) VALUES (\"\")");//creo chat
        $stmt->execute();

        $chatId = $this->db->insert_id;

        $stmt = $this->db->prepare("INSERT INTO partecipazione(idChat,idUtente) VALUES (?,?)");
        $stmt->bind_param("ii",$chatId,$admin);
        $stmt->execute();

        $stmt = $this->db->prepare("INSERT INTO partecipazione(idChat,idUtente) VALUES (?,?)");
        $stmt->bind_param("ii",$chatId,$user);
        $stmt->execute();

        return $chatId;
    }
    
    public function activateChat($idChat)
    {
        $this->setChatActivity($idChat,1);
    }

    public function deactivateChat($idChat)
    {
        $this->setChatActivity($idChat,0);
    }

    private function setChatActivity($idChat, $activity)
    {
        $stmt = $this->db->prepare("UPDATE chat SET attiva=? WHERE idChat=?");
        $stmt->bind_param("ii", $activity, $idChat);
        $stmt->execute();
    }

    public function getChatWithUsers($user1,$user2)
    {
        $query = "SELECT C.idChat
                FROM chat C
                JOIN partecipazione P ON C.idChat = P.idChat
                WHERE P.idUtente = ? AND C.idChat IN (SELECT C2.idChat
                                                    FROM chat C2
                                                    JOIN partecipazione P2 ON C2.idChat = P2.idChat
                                                    WHERE P2.idUtente = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $user1, $user2);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        $res = $queryRes->num_rows > 0 ? $queryRes->fetch_all(MYSQLI_NUM)[0][0] : 0;
        return $res;
    }

    public function isChatActive($idChat)
    {
        $stmt = $this->db->prepare("SELECT attiva FROM chat WHERE idChat=?");
        $stmt->bind_param("i", $idChat);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        $res = $queryRes->num_rows > 0 ? $queryRes->fetch_all(MYSQLI_NUM)[0][0] : 0;
        return $res > 0;
    
    }
}

?>