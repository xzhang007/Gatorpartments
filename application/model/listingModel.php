<?php

/*
*  Example to use listings
*
*  $listing = getAllListing();
*
*  foreach($listing as $row){
*   echo $row->address_1
*      . $row->state
*      . $row->zip_code ;
*  }
*
*  $listing data field,
*    id, title, room_size, price, description, address_1, address_2, city, state, zip_code, landlord_id,
*    phone, image_main, images.
*
*  Make sure to use $this->priceFormat($row->price); to display formatted value to look like currency.
*
*/

class ListingModel
{
  //Connectes and creates db object
  function __construct($db)
  {
    try {
      $this->db = $db;
        } catch (PDOException $e) {
          exit('Database connection could not be established.');
    }
  }

  //Gets all listings in the 'listing' table in the DB
  public function getAllListing()
  {
    $sql = "SELECT * FROM listing";
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetchAll();
   }

  //Gets listings if a keyword is matched
  //Used in search button
  public function getListingBySearch($search)
  {
    $search = "%$search%";
    $sql = "SELECT * FROM listing WHERE CONCAT_WS('', street_address, city, zip_code, title, room_size, price) LIKE :search";
    $query = $this->db->prepare($sql);
    $query->bindParam(':search', $search);
    $query->execute();
    return $query->fetchAll();
  }

  //Gets listing by listing's id
  public function getListingById($id)
  {
    $sql = "SELECT * FROM listing WHERE id=:id";
    $query = $this->db->prepare($sql);
    $query->bindParam(':id', $id);
    $query->execute();
    return $query->fetch();
  }

  //Gets listing by listing's listing_id
  public function getListingByListingId($listingId)
  {
    $sql = "SELECT * FROM listing WHERE listing_id=:listingId";
    $query = $this->db->prepare($sql);
    $query->bindParam(':listingId', $listingId);
    $query->execute();
    return $query->fetch();
  }


  //Given strings, it will put it in an array
  public function getImagesArray($string)
  {
    $images = explode(" ",$string);
    return $images;
  }

  //Gets all listings in random order
  public function getListingByRandom()
  {
    $sql = "SELECT * FROM listing ORDER BY RAND()";
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }

  //Get all listing by Lowest Price first
  public function getListingByLowestPrice()
  {
    $sql = "SELECT * FROM listing ORDER BY price";
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }

  //Get all listing by Highest Price first
  public function getListingByHighestPrice()
  {
    $sql = "SELECT * FROM listing ORDER BY price DESC";
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }

  //Gets listings given a minimum price
  public function getListingByMinPrice($minPrice)
  {
    $sql = "SELECT * FROM listing WHERE price > :minPrice";
    $query = $this->db->prepare($sql);
    $query->bindParam(':minPrice',$minPrice);
    $query->execute();
    return $query->fetchAll();
  }

  //Gets listing given max price
  public function getListingByMaxPrice($maxPrice)
  {
    $sql = "SELECT * FROM listing WHERE price < :maxPrice";
    $query = $this->db->prepare($sql);
    $query->bindParam(':maxPrice', $maxPrice);
    $query->execute();
    return $query->fetchAll();
  }

  public function uploadImage($listindId) {
    //define('SITE_ROOT', realpath(dirname(__FILE__)));
    // $fileSize is the max file size of an image, measured in bytes
    define('IMAGES_FOLDER', __DIR__ . '/../../public/images/');
    // define('IMAGES_FOLDER', '/home/nhan/public_html/gatorpartments/public/images/');
    $fileSize = 5000000;
    $totalImages = count($_FILES["fileToUpload"]["name"]);

    // if mkdir gives permission error, user must chmod folder path to 777
    // chmod -R 777 SITE_ROOT
    // The chmod provided above doesn't allow me to delete the folder created, have not found a workaround for it yet
    if(!file_exists(IMAGES_FOLDER)) {
      echo "Attempting to create folder at: <br>" . IMAGES_FOLDER;
      mkdir(IMAGES_FOLDER, 0777, true);
      echo "If mkdir returns permission error, read the comments in the code on how to workaround it in the function <br>";
    }

    // loop through incase there are multiple file uploads
    for($i = 0; $i < $totalImages; $i++) {
      $target_file = $_FILES["fileToUpload"]["name"][$i];
      $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
      $uploadOk = 1;

      // check if the file already exists in the server, if so output error message and stop upload
      if(file_exists(IMAGES_FOLDER . $_FILES["fileToUpload"]["name"][$i])) {
        echo "File already exists! <br>";
        $uploadOk = 0;
      }

      // Check if image file is a actual iamge or fake image
      if(isset($_POST["submitPost"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
        if($check !== false) {
          $uploadOk = 1;
        } else {
          echo "File is not an image. <br>";
          $uploadOk = 0;
        }
      }

      // if file exists, append a number, such as (1), to the end to workaround existing file error
      //if(file_exists($target_file)) {
        //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]) . "(1)";
      //}

      // Check file size
      if($_FILES["fileToUpload"]["size"][$i] > $fileSize) {
        echo "Sorry, your file is too large. <br>";
        $uploadOk = 0;
      }

      // Allow only certain file formats pertaining to images
      if($imageFileType != "JPG" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG,PNG, & GIF files are allowed. <br>";
        $uploadOk = 0;
      }
      //Rename files with ext
      $temp = explode(".", $_FILES["fileToUpload"]["name"][$i]);
      $newfilename = time() . $i . '.' . end($temp);

      // Check if image is okay and meets all the criterias before uploading
      if($uploadOk == 0) {
        echo "Sorry, your file was no uploaded. <br>";
      } else {
        if((move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], IMAGES_FOLDER.$newfilename))) {
          //inserts image name into db
          $this->insertImage($newfilename, $listindId);
        } else {
          echo "Sorry, there was an error uploading your file. <br>";
        }
      }
    }
  }
  //Inserts listing into DB
  public function postListing($listingId, $landlordId, $address1, $address2, $city, $state, $zipCode, $rentalType,$term, $price, $squareFeet, $roomSize, $bathSize, $electricity, $gas, $water, $elevator, $laundry,$outdoor, $parking, $pool, $wheelchair, $cats, $dogs, $smoking, $comments){

    $sql = "INSERT into listing";
    $sql .= "(listing_id, landlord_id, address_1, address_2, city, state, zip_code, rental_type, term, price,";
    $sql .= "square_feet, room_size, bath_size, electricity, gas, water, elevator, laundry, outdoor,";
    $sql .= "parking, pool, wheelchair, cats, dogs, smoking, comments)";
    $sql .= "VALUES";
    $sql .= "(:listingId, :landlordId, :address1, :address2, :city, :state, :zipCode, :rentalType, :term, :price,";
    $sql .= ":squareFeet, :roomSize, :bathSize, :electricity, :gas, :water, :elevator, :laundry,";
    $sql .= ":outdoor, :parking, :pool, :wheelchair, :cats, :dogs, :smoking, :comments)";

    $query = $this->db->prepare($sql);
    $query->bindParam(':listingId', $listingId);
    $query->bindParam(':landlordId',$landlordId);
    $query->bindParam(':address1',$address1);
    $query->bindParam(':address2',$address2);
    $query->bindParam(':city',$city);
    $query->bindParam(':state',$state);
    $query->bindParam(':zipCode',$zipCode);
    $query->bindParam(':rentalType',$rentalType);
    $query->bindParam(':term', $term);
    $query->bindParam(':price', $price);
    $query->bindParam(':squareFeet',$squareFeet);
    $query->bindParam(':roomSize',$roomSize);
    $query->bindParam(':bathSize',$bathSize);
    $query->bindParam(':electricity', $electricity);
    $query->bindParam(':gas', $gas);
    $query->bindParam(':water',$water);
    $query->bindParam(':elevator',$elevator);
    $query->bindParam(':laundry',$laundry);
    $query->bindParam(':outdoor',$outdoor);
    $query->bindParam(':parking',$parking);
    $query->bindParam(':pool',$pool);
    $query->bindParam(':wheelchair',$wheelchair);
    $query->bindParam(':cats',$cats);
    $query->bindParam(':dogs',$dogs);
    $query->bindParam(':smoking',$smoking);
    $query->bindParam(':comments',$comments);
    $query->execute();
  }

  //Insert images into DB
  public function insertImage($image, $listingId){
    $sql = "INSERT INTO image (image, listing_id) VALUES (:image, :listingId)";
    $query = $this->db->prepare($sql);
    $query->bindParam(':image', $image);
    $query->bindParam(':listingId', $listingId);
    $query->execute();
  }

  //Generates a 6 digit random number for Listing ID
  public function generateListingId(){

    //This do while loop will keep looping if an id already exists on the database
    //If it doesn't, the randomly generated number will be our new ID
    do {
    $listingId = mt_rand(1, 999999);

    $sql = "SELECT listing_id FROM listing WHERE listing_id = :listingId";
    $query = $this->db->prepare($sql);
    $query->bindParam(":listingId", $listingId);
    $query->execute();
    $result = $query->fetch();

    } while($result);

    return $listingId;
  }

  //Gets all images of a listing id
  public function getAllImages($listingId){
    $sql="SELECT * FROM image WHERE listing_id = :listingId";
    $query = $this->db->prepare($sql);
    $query->bindParam(':listingId', $listingId);
    $query->execute();
    $result = $query->fetchAll();
    return $result;
  }

  //Sets an image to be main thumbnail image
  public function setMainImage($listingId, $image){
    $sql="UPDATE listing SET image_main = :image WHERE listing_id = :listingId";
    $query = $this->db->prepare($sql);
    $query->bindParam(':listingId', $listingId);
    $query->bindParam(':image', $image);
    $query->execute();
  }

}
?>
