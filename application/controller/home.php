<?php

class Home extends Controller
{

    public function about()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/about.html';
        require APP . 'view/_templates/footer.php';
    }
    public function compare()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/compare.html';
        require APP . 'view/_templates/footer.php';
    }
    public function contact()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/contact.html';
        require APP . 'view/_templates/footer.php';
    }
    public function listings()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/listings.html';
        require APP . 'view/_templates/footer.php';
    }
    public function post()
    {
	if($this->userModel->isLandlord()){
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/postListing.php';
        require APP . 'view/_templates/footer.php';
        }  else {
           require APP . 'view/_templates/header.php';
           require APP . 'view/home/index.php';
           require APP . 'view/_templates/footer.php';
        }
    }
    //Home page
    public function index()
    {
      	if(isset($_POST['submitSearch'])){
      	    $keyword = $_POST['inputLocation'];
      	    $listing = $this->listingModel->getListingBySearch($keyword);
      	} else {
      	    $listing = $this->listingModel->getAllListing();
      	}
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }



   public function messaging(){
      require APP . 'view/_templates/header.php';
      require APP . 'view/home/messaging.php';
      require APP . 'view/_templates/footer.php';
    }

    //Individual Listing Page
    public function property($listingId){

    	if(isset($listingId)){
    	   $listing = $this->listingModel->getListingByListingId($listingId);

    	   $images = $this->listingModel->getAllImages($listingId);

           $_SESSION['listingId'] =  $listing->id;

            }
	// load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/property.php';
        require APP . 'view/_templates/footer.php';
    }

    public function terms()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/terms.html';
        require APP . 'view/_templates/footer.php';
    }
    public function typography()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/typography.html';
        require APP . 'view/_templates/footer.php';
    }
}

?>
