<?php
class User extends Controller {

  public function register(){
    //If the submitRegister button is clicked
    if(isset($_POST['submitRegister'])){
      $fullName = $_POST['fullName'];
      $phoneNumber = $_POST['phoneNumber'];
      $email = $_POST['email'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      if(isset($_POST['checkboxLandlord'])){
        $checkboxLandlord = 1;
      } else {
        $checkboxLandlord = 0;
      }

      if(isset($_POST['checkboxStudent'])){
        $checkboxStudent = 1;
      } else {
        $checkboxStudent = 0;
      }

      $this->userModel->register($fullName, $phoneNumber, $email, $username, $password, $checkboxLandlord, $checkboxStudent);
    }

    require APP . "view/_templates/header.php";
    require APP . "view/user/register.php";
    require APP . "view/_templates/footer.php";
  }

  public function login(){

    if(isset($_POST['submitLogin'])){
     $username = $_POST['username'];
     $password = $_POST['password'];

     $this->userModel->login($username, $password);
    }

    require APP . "view/_templates/header.php";
    require APP . "view/user/login.php";
    require APP . "view/_templates/footer.php";
  }

  public function logout(){
    $this->userModel->logout();
  }

  public function checkLoginStatus() {
    $this->userModel->checkLoginStatus();
  }

  public function checkUsernameExist($username){
    echo $this->userModel->checkUsernameExist($username);
  }

}
?>
