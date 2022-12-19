<?php 
class ChatFunctions
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
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

    public function getRecentChats($user,$user2,$initialChat, $numChats)
    {
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
    public function getRecentMessagesFromChat($chat, $initialMsg, $numMsgs)
    {
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
}

?>