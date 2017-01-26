<div class="container">
  <div class="box">
    <h3>Write message</h3>
    <div class="panel-group">
      <div class="panel panel-default">
        <form action="<?php echo URL; ?>messages/addMessage" method="POST">
          <div class="panel-body">
            <div class="col-md-3">
              <label>Send a message to:</label><br>
              <input type="text" name="toname" value=<?php echo $landlordUserName ; ?> required readonly/>
            </div>
            <div class="col-md-3">
              <label>Listing ID:</label><br>
              <input type="text" name="listingId" value =<?php echo $listingId ; ?> required readonly/>
            </div>
          </div>
          <br>
          <div class="panel-body">
            <div class="col-md-6">
              <label>Message:</label><br>
              <textarea type="text" name="content" value="" rows="5" cols="50" required /></textarea>
            </div></div>
            <br>
            <div class="panel-body">
              <div class="col-md-6">
                <input type="submit" name="submit_add_message" value="Send message" style="float:right;"/>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
