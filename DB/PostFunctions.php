<?php
class PostFunctions
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    //-------- CREATING POSTS -------

    public function insertPost($user, $testo, $dataPost)
    {
        $stmt = $this->db->prepare("INSERT INTO posts(idUser,testo,dataPost) VALUES (?,?,?)");
        $stmt->bind_param("iss", $user, $testo, $dataPost);
        $stmt->execute();
        return $this->db->insert_id;
    }

    //-------- UPDATING POSTS -------

    public function addCommentToPost($user,$postId, $testo)
    {
        $query = "INSERT INTO commenti(dataCommento, testo, idPost,idUtente)
                VALUES (NOW(),?,?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sii",$testo,$postId, $user);
        $stmt->execute();
        $query = "UPDATE posts
                SET numCommenti=numCommenti+1
                WHERE idPost=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i",$postId);
        $stmt->execute();
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
    
    public function removeTagsFromPost($postId)
    {
        $stmt = $this->db->prepare("DELETE FROM posttags WHERE idPost=?");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        
    }

    public function addMediaToPost($postId, $path, $fileType, $desc)
    {
        $stmt = $this->db->prepare("INSERT INTO contenutimultimediali(formato,nomeImmagine,idPost,descrizione) VALUES (?,?,?,?)");
        $stmt->bind_param("ssis",$fileType,$path,$postId,$desc);
        $stmt->execute();
    }

    public function likePost($user, $postId)
    {
        $stmt = $this->db->prepare("INSERT INTO postpiaciuti(idUtente,idPost) VALUES (?,?)");
        $stmt->bind_param("ii",$user,$postId);
        $stmt->execute();
        $stmt = $this->db->prepare('UPDATE posts SET numLike=numLike+1 WHERE idPost=?');
        $stmt->bind_param("i",$postId);
        $stmt->execute();
    }

    public function dislikePost($user, $postId)
    {
        $stmt = $this->db->prepare("DELETE FROM postpiaciuti WHERE idUtente=? AND idPost=?");
        $stmt->bind_param("ii",$user,$postId);
        $stmt->execute();
        $stmt = $this->db->prepare('UPDATE posts SET numLike=numLike-1 WHERE idPost=?');
        $stmt->bind_param("i",$postId);
        $stmt->execute();
    }

    public function savePost($user, $postId)
    {
        $stmt = $this->db->prepare("INSERT INTO postsalvati(idUtente,idPost) VALUES (?,?)");
        $stmt->bind_param("ii",$user,$postId);
        $stmt->execute();
    }

    public function unsavePost($user, $postId)
    {
        $stmt = $this->db->prepare("DELETE FROM postsalvati WHERE idUtente=? AND idPost=?");
        $stmt->bind_param("ii",$user,$postId);
        $stmt->execute();
    }

    public function updatePost($postId, $testo, $dataPost)
    {
        $stmt = $this->db->prepare("UPDATE posts SET testo=?, dataPost=? WHERE idPost=?");
        $stmt->bind_param("ssi",$testo, $dataPost,$postId);
        $stmt->execute();
    }

    public function deletePostMedia($mediaId)
    {
        $stmt = $this->db->prepare("DELETE FROM contenutimultimediali WHERE idContenuto=?");
        $stmt->bind_param("i",$mediaId);
        $stmt->execute();
    }

    public function removePost($postId)
    {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE idPost=?");
        $stmt->bind_param("i",$postId);
        $stmt->execute();
    }

    //-------- GETTING POST DATA -------

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

    public function getPostTags($postId)
    {
        $query = "SELECT *
                FROM tags
                WHERE idTag IN (SELECT T.idTag
                                FROM tags T
                                JOIN posttags PT ON T.idTag = PT.idTag
                                JOIN posts P ON PT.idPost = P.idPost
                                WHERE PT.idPost = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return $queryRes->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostComments($postId)
    {
        $query = "SELECT dataCommento, testo, U.idUtente, username, formatoFotoProfilo
                    FROM commenti C
                    JOIN Utenti U ON C.idUtente = U.idUtente
                    WHERE idPost=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return $queryRes->fetch_all(MYSQLI_ASSOC);
    }

    public function isPostLiked($user, $postId)
    {
        $stmt = $this->db->prepare("SELECT * FROM postpiaciuti WHERE idUtente=? AND idPost=?");
        $stmt->bind_param("ii", $user, $postId);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return count($queryRes->fetch_all(MYSQLI_ASSOC)) > 0;
    }

    public function isPostSaved($user, $postId)
    {
        $stmt = $this->db->prepare("SELECT * FROM postsalvati WHERE idUtente=? AND idPost=?");
        $stmt->bind_param("ii", $user, $postId);
        $stmt->execute();
        $queryRes = $stmt->get_result();
        return count($queryRes->fetch_all(MYSQLI_ASSOC)) > 0;
    }
    
    //-------- GETTING POSTS -------

    public function getRandomPosts($idUser, $oldPostIds=array(), $n=5)
    {
        $query = "SELECT  *
                FROM posts
                WHERE idUser != ? ";

        $length = count($oldPostIds);
        if($length > 0){
            $query .= "AND idPost NOT IN(";
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
            $query .= ") ";
        }
        $query .= "ORDER BY RAND() LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $idUser, $n );
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfilePosts($n=-1, $idUser)
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

    public function getSavedPosts($idUser,$start=0,$end=7)
    { //id dell'utente loggato
        $stmt = $this->db->prepare("SELECT P.*
                                    FROM
                                        posts P,
                                        postsalvati PS
                                    WHERE
                                        PS.idUtente = ? AND PS.idPost = P.idPost
                                    ORDER BY
                                        PS.idPostSalvato 
                                    DESC
                                    LIMIT ?,?");
        $stmt->bind_param('iii', $idUser,$start,$end);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowedPosts($idUser,$start=0,$end=7)
    { //id dell'utente loggato
        $query = "SELECT * 
                FROM posts
                WHERE idUser IN (SELECT idFollowed
                                FROM relazioniutenti
                                WHERE idFollower=?)
                ORDER BY dataPost DESC 
                LIMIT ?,?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $idUser,$start,$end);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>