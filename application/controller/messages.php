<?php
class Messages extends Controller
{
  /*
  * this function is to get the landlord id  from the listing id
  */
  public function contactLandlord($listingId)
  {
    if (isset($_SESSION['loggedIn'])) {
      $landlordId = $this->messageModel->getLandlordId($listingId);
      $landlordUserName = $this->messageModel->getUserName($landlordId);

      // load view
      require APP . 'view/_templates/header.php';
      require APP . 'view/user/writeMessage.php';
      require APP . 'view/_templates/footer.php';

    }
    else{
      header('Location: ' . URL . 'user/login');
    }
  }

  /*
  * this function is to write a new message from the user
  */
  public function addMessage()
  {
    if ($_SESSION['loggedIn']) {
      if (isset($_POST["submit_add_message"])){
        // $userId = $this->messageModel->getUserId($_POST["username"]);
        $userId = $_SESSION['userId'];  // if using session please select this line
        $toId = $this->messageModel->getUserId($_POST["toname"]);
        $this->messageModel->addMessage($userId, $toId, $_POST["content"], $_POST["listingId"]);
      }

      header('Location: ' . URL . 'home');
    }
  }

  /*
  * this function is to show all the messages from the user sent to others,
  *  just as sent box
  */
  public function showToMessage()
  {
    if ($_SESSION['loggedIn']) {
      // if (isset($_POST["submit_show_message"])) {
      //	$userId =  $this->messageModel->getUserId($_POST["username"]);

      $userId = $_SESSION['userId'];  // if using session please select this line
      $messages = $this->messageModel->showToMessage($userId);

      // load views
      require APP . 'view/_templates/header.php';
      require APP . 'view/user/showToMessage.php';
      require APP . 'view/_templates/footer.php';
      // }
    }
  }

  /*
  * this function is to show all the messages sent from others,
  * just as inbox
  */
  public function showFromMessage()
  {
    if ($_SESSION['loggedIn']) {
      $userId = $_SESSION['userId'];
      $messages = $this->messageModel->showFromMessage($userId);

      // load views
      require APP . 'view/_templates/header.php';
      require APP .  'view/user/showFromMessage.php';
      require APP . 'view/_templates/footer.php';
    }
  }

  /*
  * this function is for mile's controller: home/messaging function
  */
  public function showMessageDetail($messageId)
  {
    if ($_SESSION['loggedIn']) {
      $message = $this->messageModel->showMessageDetail($messageId);
      $messageUserName = $this->messageModel->getUsername($message->userId);
      // load views
      require APP . 'view/_templates/header.php';
      require APP . 'view/home/messageDetail.php';
      require APP . 'view/_templates/footer.php';
    }
  }

  /* this function is to show all the messages related to the user, no matter it is sent to the user or sent from the user
  * sort by the listing id
  */
  public function showMessages() {

    if (isset($_SESSION['loggedIn'])) {
      $userId = $_SESSION['userId'];
      $messages = $this->messageModel->showMessages($userId);
      $listings;
      $messageUserNames;
      $index = 0;
      foreach ($messages as $message) {
        $listings[$index] = $this->messageModel->getListing($message->listingId);
        $messageUserNames[$index] = $this->messageModel->getUsername($message->userId);
        $index++;
      }

      // load views
      // please load your views
      require APP . 'view/_templates/header.php';
      require APP . 'view/home/messaging.php';
      require APP . 'view/_templates/footer.php';

    }
    else{
      echo('Please <a href="' . URL . 'user/login">login </a>to view messages.');
    }
  }

}
?>
