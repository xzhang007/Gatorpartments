<!DOCTYPE html>
<html>
<body>

  <form action="<?php echo URL . 'uploadImage/upload'?>" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple"/>
    <input type="submit" value="Upload Image">
  </form>

</body>
</html>
