
<!-- details,map & ads -->
<div class="row">


  <!-- property details -->
  <div class="col-sm-8 property-col">

    <div class="well center title-list">
      <ul style="margin: 0;font-weight: bold;">Property Description</ul>
    </div>

    <div class="col-sm-12 property-list">
      <div class="row" style="margin-top: 10px;">
        <div class="col-sm-5 col-xs-8">
          <h3><?php echo htmlspecialchars($listing->room_size) ;?></h3>
          <h6><?php echo htmlspecialchars($listing->address_1) ;?></h6>
          <h6><?php echo htmlspecialchars($listing->city) . " " .  htmlspecialchars($listing->zip_code) . ", " . htmlspecialchars($listing->state);?></h6>
        </div>
        <div class="col-sm-3 col-xs-4 text-right pull-right">
          <h2 class="text-right"><?php echo htmlspecialchars($this->formatPrice($listing->price)) ;?></h2>
        </div>
      </div>

      <div class="centermid carousel-slide">
        <div style="background-color: white;" data-ride="carousel" class="carousel slide" id="myCarousel">
          <!-- Indicators -->
          <ol class="carousel-indicators" style="bottom: 0px;">
          <?php $count2 = 0; ?>
          <?php foreach($images as $image){ ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $count2 ;?>" class=""></li>
          <?php $count2++; } ?>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner center carousel-height" role="listbox">
            <?php $count = 0 ;?>
            <?php foreach($images as $image){  ?>
            <div class="item <?php if($count == 0){echo "active";} ?>">
              <img class="img-responsive"  src="<?php echo IMAGE_PATH . $image->image ;?>">
            </div>
            <?php $count++; } ?>
          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="max-width: 40px;">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" style="max-width: 40px;">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="padding-left:12.5px;"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>

      <div class="row">
        <div class="col-sm-12 visible">
          <div class="row">
            <div class="col-xs-9">
              <h4>Features:</h4>
              <div class=" col-xs-6">
                <ul>
                  <li><?php echo htmlspecialchars($listing->room_size); ?></li>
                  <li><?php echo htmlspecialchars($listing->bath_size); ?></li>
                </ul>
              </div>
              <div class="col-xs-6">
                <ul>
                  <li><?php echo htmlspecialchars($listing->square_feet) . " Square Foot" ;?></li>
                  <li><?php echo htmlspecialchars($listing->term) ;?></li>
                </ul>
              </div>

            </div>

            <div class="col-xs-3 property-desc">
              <ul>
                <form action="<?php echo URL . 'messages/contactLandlord/' . $listing->id ;?>" method = "POST" id="form1">
                </form> 
                <button class="b b0 navbar-right msg-btn" style="background-color: #609b62;" type="submit" form="form1" name="submit_contact"><h4>Message</h4></button>
                <br>
                <button class="b b0 navbar-right cncl-btn" onclick="location.href = '<?php echo URL . 'home/listings' ;?>"><h5>Back to Search</h5></button>
              </ul>
            </div>
          </div>
          <p>
            <?php echo htmlspecialchars($listing->comments) ?>
          </p>
        </div>
      </div>

    </div>

  </div>
  <!-- /property details -->

  <!-- map & ads -->
  <div class="col-sm-4 row">

    <!-- map -->
    <div class="row map-wrapper">
      <div id="gmap"></div>
    </div>
    <!-- /map -->

    <!-- ads -->
    <div class="row">
      <div class="col-sm-12 ad">
        <img src="https://hannahmorley.files.wordpress.com/2012/11/screen-shot-2012-11-29-at-00-49-49.png">
      </div>
    </div>
    <!-- /ads -->

  </div>
  <!-- /map & ads -->

</div>
<!-- /details,map & ads -->

<!-- footer -->
<footer>

  <div class="col-xs-6">
    <p>
      <a href="<?php echo URL;?>home/index">Home</a> |
      <a href="<?php echo URL;?>home/about">About</a> |
      <a href="<?php echo URL;?>home/typography">Typography</a> |
      <a href="<?php echo URL;?>home/terms">Terms and Conditions</a> |
      <a href="<?php echo URL;?>home/contact">Contact Us</a>
    </p>
  </div>

  <div class="col-xs-6 pull-right text-right">
    <p>
      All content © 2014 | <a href="<?php echo URL;?>home/about">Built with Twitter Bootstrap</a> | <a href="https://wrapbootstrap.com/">WrapBootstrap</a>
    </p>
  </div>

</footer>
<!-- /footer -->

<!-- google maps -->
<script type="text/javascript" src="<?php echo URL;?>js/map_property.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBB0tVY_PUrlqdB87rV6X9jhEW-aTcX91o&callback=propMap"></script>
<!-- /google maps -->
