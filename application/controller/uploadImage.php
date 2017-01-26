<?php
  class uploadImage extends Controller {
    public function index() {
      require APP . 'view/_templates/header.php';
      require APP . 'view/uploadImage/index.php';
      require APP . 'view/_templates/footer.php';
    }

    public function upload() {
      $this->listingModel->uploadImage(1);
    }
  }
?>
