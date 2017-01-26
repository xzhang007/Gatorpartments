<?php
class Listing extends Controller
{
  //If user is landlord, user can access post a listing page
  public function postListing(){

    if( (isset($_POST['submitPost'])) && ($this->userModel->isLandlord()) ){
      $listingId = $this->listingModel->generateListingId();
      $landlordId = $_SESSION['landlordId'];
      $address1 = $_POST['address1'];

      if(isset($_POST['address2'])){
        $address2 = $_POST['address2'];
      } else {
        $address2 = NULL;
      }

      $city = $_POST['city'];
      $state = $_POST['state'];
      $zipCode = $_POST['zipCode'];
      $rentalType = $_POST['rentalType'];
      $term = $_POST['term'];
      $price = $_POST['price'];
      $squareFeet = $_POST['squareFeet'];
      $roomSize = $_POST['roomSize'];
      $bathSize = $_POST['bathSize'];

      if(isset($_POST['electricity'])){
        $electricity = 1;
      } else {
        $electricity = 0;
      }

      if(isset($_POST['gas'])){
        $gas = 1;
      } else {
        $gas = 0;
      }

      if(isset($_POST['water'])){
        $water = 1;
      } else {
        $water = 0;
      }

      if(isset($_POST['elevator'])){
        $elevator = 1;
      } else {
        $elevator = 0;
      }

      if(isset($_POST['laundry'])){
        $laundry = 1;
      } else {
        $laundry = 0;
      }

      if(isset($_POST['outdoor'])){
        $outdoor = 1;
      } else {
        $outdoor = 0;
      }

      if(isset($_POST['parking'])){
        $parking = 1;
      } else {
        $parking = 0;
      }

      if(isset($_POST['pool'])){
        $pool = 1;
      } else {
        $pool = 0;
      }

      if(isset($_POST['wheelchair'])){
        $wheelchair = 1;
      } else {
        $wheelchair = 0;
      }

      if(isset($_POST['cats'])){
        $cats = 1;
      } else {
        $cats = 0;
      }

      if(isset($_POST['dogs'])){
        $dogs = 1;
      } else {
        $dogs = 0;
      }

      if(isset($_POST['smoking'])){
        $smoking = 1;
      } else {
        $smoking = 0;
      }

      if(isset($_POST['comments'])){
        $comments = $_POST['comments'];
      } else {
        $comments = NULL;
      }
      //Insert a Listing into DB
      $this->listingModel->postListing($listingId, $landlordId, $address1, $address2, $city, $state, $zipCode, $rentalType, $term, $price, $squareFeet, $roomSize, $bathSize, $electricity, $gas, $water, $elevator, $laundry, $outdoor, $parking, $pool, $wheelchair, $cats, $dogs, $smoking, $comments );
      //Insert images into image table
      $this->listingModel->uploadImage($listingId);
      //Get all images from DB
      $result = $this->listingModel->getAllImages($listingId);
      //Assign first image to image_main
      $this->listingModel->setMainImage($listingId, $result[0]->image);
      //Reroute to Success page
      header("Location:" . URL . 'listing/postSuccess');
      exit();
    }

    if($this->userModel->isLandlord()){
    // load views
      require APP . 'view/_templates/header.php';
      require APP . 'view/listing/postListing.php';
      require APP . 'view/_templates/footer.php';
    }  else {
      header("Location:" . URL . 'problem/landlordError' );
      exit();
    }
  }

  public function postSuccess(){
    require APP . 'view/_templates/header.php';
    require APP . 'view/listing/postSuccess.php';
    require APP . 'view/_templates/footer.php';
  }

} //End Class
?>
