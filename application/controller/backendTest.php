<?php
//Use to test Back End functions
//It will have good examples for front-end on how to use these functions
class BackendTest extends Controller{

  public function index(){
    require APP . "view/backendTest/header.php";
    require APP . "view/backendTest/index.php";
    require APP . "view/backendTest/footer.php";
  }

  //Creates an account and inputs data into DB
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

    require APP . "view/backendTest/header.php";
    require APP . "view/backendTest/register.php";
    require APP . "view/backendTest/footer.php";
  }

  public function login(){

    if(isset($_POST['submitLogin'])){
     $username = $_POST['username'];
     $password = $_POST['password'];

     $this->userModel->login($username, $password);
    }
    
    require APP . "view/backendTest/header.php";
    require APP . "view/backendTest/login.php";
    require APP . "view/backendTest/footer.php";
  }

  public function success(){
    require APP . "view/backendTest/success.php";
  }

  public function failed(){
    require APP . "view/backendTest/failed.php";
  }

  public function post(){
    require APP . "view/_templates/header.php";
    require APP . "view/backendTest/post.php";
    require APP . "view/_templates/footer.php";
  }

}
?>
