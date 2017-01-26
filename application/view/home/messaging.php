
<?php
if(isset($_SESSION['isLandlord'])){
  $inboxType = 'landlord';
  echo("Landlord inbox.");
}
elseif (isset($_SESSION['isStudent'])) {
  $inboxType = 'student';
  echo("Student inbox.");
}
else{
  echo("No user type is defined.");
}

if(isset($_POST['content'])){
  $response = $_POST['content'];
  echo $response;
}
if(isset($_POST['toname'])){
  $sendTo = $_POST['toname'];
  echo $sendTo;
}
?>
<div class="panel">
  <div class="panel-body">
    <div class="col-md-3 list-group"><b>Property</b><br>
      <?php
      $index = 0;
      foreach($messages as $message){ ?>
        <a onclick="setContentBox( <?php echo "'" . $messageUserNames[$index] . "','";
        echo $message->content . "','" . $message->listingId;
        echo "'"; ?>)" class="list-group-item list-group-item-action">
          <?php echo($listings[$index]->address_1);
            ?>
        </a>
        <?php } ?>



      </div>
      <div class="col-md-3 list-group"><b>Message from</b><br>
        <?php
        $index = 0;
        foreach($messages as $message){ ?>
          <a onclick="setContentBox( <?php echo "'" . $messageUserNames[$index] . "','";
          echo $message->content . "','" . $message->listingId;
          echo "'"; ?>)" class="list-group-item list-group-item-action">
            <?php echo $messageUserNames[$index];
            $index++; ?>
          </a>
          <?php } ?>

        </div>
        <div class="col-md-4 panel"><b>Message content</b>
          <br />
          <div class="panel-body" id="messageContentBox">
            <?php
            echo('Message content goes here.');
            ?>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="col-md-6"><br /></div>
        <div class="col-md-4 form-group">
          Reply to message.<br />
          <form action="<?php echo URL . 'messages/addMessage'; ?>" method="post">
            Reply to: <input type="text" name="toname" id="toname" style="float:right;" readonly><br>
            <textarea class="form-control" rows="5" id="content" name="content"></textarea>
              <span style="float:right;">
                <input type="submit" name="submit_add_message" value="Send" style="float:right;">
                <input type="hidden" name="listingId" id="listingId">
              </span>
            </form>
          </div>
        </div>
      </div>
      <br>

      <script type="text/javascript">
      function setContentBox(messageRecipient,messageText,listing){
        document.getElementById("toname").value = messageRecipient;
        document.getElementById("messageContentBox").innerHTML = messageText;
        document.getElementById("listingId").value = listing;
      }

      </script>
