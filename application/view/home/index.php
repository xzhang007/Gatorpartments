<!-- map,listing,ads -->
<div class="row">

	<!-- listing -->
	<div class="col-sm-7 index-list">

		<div class="well center title-list">
			<ul style="margin: 0;font-weight: bold;">Most Recent Listings:</ul>
		</div>

		<div class="col-sm-12 scroll-list">

			<!-- property -->
                        <?php $count = 0; ?>
			<?php foreach($listing as $row) { ?>
                        <?php $count++; ?>
				<div class="mini_property_wrapper">
					<div class="row">
						<div class="col-sm-12">

							<!-- property IMG-->
							<div class="col-xs-6 thumb thumb_property center">
								<a href="<?php echo URL . '/home/property/' . $row->listing_id ;?>" class="img_holder">
									<img src="<?php echo IMAGE_PATH . $row->image_main ;?>" alt="">
									<a><button onclick="location.href = '<?php echo URL . '/home/property/' . $row->listing_id ;?>"><?php echo $count ;?></button></a>
								</a>
							</div>
							<!-- /property IMG-->

							<!-- property Info-->
							<div class="col-xs-6 thumb_info">
								<h3>Price: <?php echo htmlspecialchars($this->formatPrice($row->price)) ;?></h3>
								<p><button onclick="location.href = '<?php echo URL . '/home/property/' . $row->listing_id ;?>">Available now</button></p>
								<br>
								<p>
									<p><?php echo htmlspecialchars($row->room_size) ;?></p>
									<p>
										<?php echo htmlspecialchars($row->address_1) ;?>
										<?php echo htmlspecialchars($row->address_2) ;?>
										<?php echo htmlspecialchars($row->city) ;?>
										<?php echo htmlspecialchars($row->state) . ", " ;?>
										<?php echo htmlspecialchars($row->zip_code) ;?>
									</p>
									<a href="<?php echo URL . '/home/property/' . $row->listing_id ;?>">more info...</a>
								</p>
							</div>
							<!-- /property Info-->

						</div>
					</div>
					<div class="row"><hr id="hr"></div>
				</div>
				<?php } ?>
				<!-- /property -->

			</div>

		</div>
		<!-- /listing -->

		<!-- map & ads -->
		<div class="col-sm-5 row">

			<!-- map -->
			<div class="row map-wrapper">
				<div id="gmap"></div>
			</div>
			<!-- /map -->

			<!-- ads -->
			<div class="row">
				<div class="col-sm-12 col-xs-6 ad">
					<img src="http://i4.mirror.co.uk/incoming/article4773907.ece/ALTERNATES/s615b/Coca-Cola-christmas.jpg">
				</div>
			</div>
			<!-- /ads -->

		</div>
		<!-- /map & ads -->

	</div>
	<!-- /map,listing,ads -->

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
  <script type="text/javascript" src="<?php echo URL;?>js/map_index.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBB0tVY_PUrlqdB87rV6X9jhEW-aTcX91o&callback=initMap"></script>
  <!-- /google maps -->
