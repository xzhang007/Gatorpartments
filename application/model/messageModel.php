<?php
class MessageModel
{
    //Create Db Connection
    function __construct($db)
    {
	try {
	    $this->db = $db;
	} catch (PDOEXCEPTION $e) {
	    exit('Database connection could not be established.');
	}
    }
   
   /*
   * this function is to get the userid  based on the username
   * @param $username is the username from the user table
   */
    public function getUserId($username)
    {
	$sql = "SELECT id from user where username =:username";
	$query = $this->db->prepare($sql);
	$parameters = array(':username' => $username);

	$query->execute($parameters);

	return $query->fetch()->id;
    }

    //creates a message onto message table in DB
    //Takes in user's id, receipient's id, and message content
    public function addMessage($userId, $toId, $content, $listingId)
    {	
	$sql = "INSERT INTO message (userId, toId, content, listingId, created_date) VALUES (:userId, :toId, :content, :listingId, Now())";
	$query = $this->db->prepare($sql);
	$parameters = array(':userId' => $userId, ':toId' => $toId, ':content' => $content, ':listingId' => $listingId);

	$query->execute($parameters);
    }

    /*
    * this function is to get the username from user table based on the userid
    * @param $userid is the user id  from the user table
    */	
    public function getUsername($userId)
    {
	$sql =  "select username from user where id = :userId";
	$query = $this->db->prepare($sql);
	$parameters = array(':userId' => $userId);

	$query->execute($parameters);
   	return $query->fetch()->username;
    } 

   /*
   * this function is to get all the messages sent from the user  and sent to others
   * just as sentbox
   * @param  $userId is the user Id  of the the user
   */
   public function showToMessage($userId)
   {
        $sql = "select u.username, m.content, m.listingId from user u, message m where u.id = m.toId and m.userId = :userId";
	$query = $this->db->prepare($sql);
        $parameters = array(':userId' => $userId);

	$query->execute($parameters);
	return $query->fetchAll(); 
    }

  /*
  * this function is to get all the messages sent from others
  * just as inbox
  * @param $userId is the user id of the user
  */
   public function showFromMessage($userId)
   {
	$sql = "select u.username, m.content, m.listingId from user u, message m where u.id = m.userId and m.toId = :userId";
	$query = $this->db->prepare($sql);
	$parameters =  array(':userId' => $userId);

	$query->execute($parameters);
	return $query->fetchAll();
   }

  /*
  * this function is to  coorporate with  mile's controller function: home/messaging
  * @param $messageId passed from the button
  */
  public function showMessageDetail($messageId)
  {
      $sql = "select * from message where id=:messageId";
      $query = $this->db->prepare($sql);
      $parameters = array(':messageId' => $messageId);

      $query->execute($parameters);
      return $query->fetch();
  }

 /*
  * this function is to get landlord id from the listing table
 */
  public function getLandlordId($listingId)
  {
      $sql = "select landlord_id from listing where id=:listingId";
      $query = $this->db->prepare($sql);
      $parameters = array(':listingId' => $listingId);

      $query->execute($parameters);
      return $query->fetch()->landlord_id;
  }

 /* this function is to get all the messages related to the user, no matter it is sent to the user or sent from the user
  * and sort by the listing id
  * @param $userId is the user id of the user
 */
  public  function showMessages($userId){
	$sql = "select * from message where userid = :userId or toid = :userId order by listingid";
        $query = $this->db->prepare($sql);
        $parameters =  array(':userId' => $userId, ':userId' => $userId);

        $query->execute($parameters);
        return $query->fetchAll();
  }

  public function getListing($listingId) {
	$sql = "select * from listing where id = :listingId";
        $query = $this->db->prepare($sql);
        $parameters = array(':listingId' => $listingId);

        $query->execute($parameters);
        return $query->fetch();
   }  
  
}
?>


