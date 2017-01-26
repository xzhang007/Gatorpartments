<?php
/*
*  This model is used for anything related to Users
*
*
*/
class UserModel {
  function __construct($db) {
    try {
      $this->db = $db;
    } catch (PDOException $e) {
      exit('Database connection could not be established.');
    }
  }

  //Creates a new User account
  //Inserts the arguments into user table in DB
  //The password is hashed and then stored in DB
  public function register($fullName, $phoneNumber, $email, $username, $password, $isLandlord, $isStudent) {
    $sql = "INSERT INTO user (full_name, phone_number, email, username, password, isLandlord, isStudent, landlord_id) VALUES (:fullName, :phoneNumber, :email, :username, :password, :isLandlord, :isStudent, :landlordId)";
    $query = $this->db->prepare($sql);

    $query->bindParam(':fullName', $fullName);
    $query->bindParam(':phoneNumber', $phoneNumber);
    $query->bindParam(':email', $email);
    $query->bindParam(':username', $username);

    // hash the password and stores into the db
    $password1 = password_hash($password, PASSWORD_DEFAULT);
    $query->bindParam(':password', $password1);

    $query->bindParam(':isLandlord', $isLandlord);
    $query->bindParam(':isStudent', $isStudent);

    if($isLandlord){
      $landlordId = $this->generateLandlordId();
      $query->bindParam(':landlordId', $landlordId);
    } else {
      $query->bindValue(':landlordId', 0);
    }

    $query->execute();

    header("Location:" . URL . "home/index");
    exit();
  }

  //Compares the argument's username and password in DB
  //If matches, we load user info into sessions for persistent data
  public function login($username, $password) {
    $sql = "SELECT * FROM user WHERE username=:username";
    $query = $this->db->prepare($sql);
    $query->bindParam(':username', $username);
    $query->execute();
    $result = $query->fetch();
    $dbPassword = $result->password;

    //If passwords match
    if(password_verify($password, $dbPassword)){
      // Creates a session to store the users ID, and make them always log in upon visiting the site
      $_SESSION['userId'] = $result->id;
      $_SESSION['username'] = $result->username;
      $_SESSION['fullName'] = $result->full_name;
      $_SESSION['email'] = $result->email;
      $_SESSION['isLandlord'] = $result->isLandlord;
      $_SESSION['isStudent'] = $result->isStudent;
      $_SESSION['loggedIn'] = true;

      if($result->isLandlord){
        $_SESSION['landlordId'] = $result->landlord_id;
      }

      header("Location:" . URL . "home/index");
      exit();
    } else {
      $_SESSION['loggedIn'] = false;
      header("Location:" . URL . "backendTest/failed");
      exit();
    }
  }


  //Logs user out of site, killing session cookies
  public function logout() {
    // code obtained from : http://php.net/manual/en/function.session-destroy.php
    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
      $params["path"], $params["domain"],
      $params["secure"], $params["httponly"]);
    }

    // Destroy the session.
    session_destroy();

    header("Location: " . URL . "home/index");
  }

  public function checkStatus($userId) {
  }

  public function displayMessage($message) {
    echo $message;
    // return $message;
  }

  // used to check whether user fulfills the criteria before entering "post listing" page
  public function checkLoginStatus() {
    if(!isset($_SESSION) || $_SESSION['loggedIn'] == false || !$_SESSION['isLandlord']) {
      header("Location: " . URL . "user/login");
      exit();
    } elseif(!$_SESSION['isLandlord']) {
      header("Location: " . URL . "user/not%landlord%page");
      exit();
    }
  }

  //Checks if user is logged in
  public function isLoggedIn(){
    if(isset($_SESSION['loggedIn'])){
      if($_SESSION['loggedIn'] == '' || $_SESSION['loggedIn'] == false){
        return false;
      }
    }

    if(!(isset($_SESSION['loggedIn']))){
      return false;
    }

    return true;
  }

  //Checks if user is Landlord
  public function isLandlord(){
    if(isset($_SESSION['isLandlord'])){
      if($_SESSION['isLandlord'])
        return true;
    }

    if(!(isset($_SESSION['isLandlord']))){
      return false;
    }
    return false;
  }

  //Checks if a username exists in the database
  public function checkUsernameExist($username){
    $sql = "SELECT username FROM user WHERE username=:username";
    $query = $this->db->prepare($sql);
    $query->bindParam(':username', $username);
    $query->execute();
    $result = $query->fetch();

    if($result){
      return 1;
    } else {
      return 0;
    }
  }

  //Return user's id
  public function getUserId() {
    if(isset($_SESSION['userId'])){
      return $_SESSION['userId'];
    }

    return null;
  }

  public function getUserName(){
    if(isset($_SESSION['userName'])){
      return $_SESSION['userName'];
    }

    return null;
  }

  //Generates a 6 digit random number for User ID
  public function generateUserId(){

    //This do while loop will keep looping if an id already exists on the database
    //If it doesn't, the randomly generated number will be our new ID
    do {
    $id = mt_rand(1, 999999);

    $sql = "SELECT id FROM user WHERE id=:id";
    $query = $this->db->prepare($sql);
    $query->bindParam(":id", $id);
    $query->execute();
    $result = $query->fetch();

    } while($result);

    return $id;
  }

  //Generates a 6 digit random number for landlord ID
  public function generateLandlordId(){

    //This do while loop will keep looping if an id already exists on the database
    //If it doesn't, the randomly generated number will be our new ID
    do {
    $landlordId = mt_rand(1, 999999);

    $sql = "SELECT landlord_id FROM user WHERE landlord_id=:landlord_id";
    $query = $this->db->prepare($sql);
    $query->bindParam(":landlord_id", $landlordId);
    $query->execute();
    $result = $query->fetch();

    } while($result);

    return $landlordId;
  }

}
?>
