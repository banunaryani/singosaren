<!-- Footer -->
		<footer class="footer" style="background-image:url('img/map.png')">
			<!-- Footer Top -->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-md-6 col-12">
							<!-- Footer About -->		
							<div class="single-widget footer-about widget">	
								<div class="logo">
									<div class="img-logo">
										<a class="logo" href="index.html">
											<img class="img-responsive" src="<?= base_url('assets/img/').'white-'.$deskripsi['logo'] ?>" alt="logo">
										</a>
									</div>
								</div>
								<div class="footer-widget-about-description">
									<p>Tetap terhubung dengan kami</p>
								</div>	
								<div class="social">
									<!-- Social Icons -->
									<ul class="social-icons">
										<li><a class="facebook" href="<?= $kontak['facebook'] ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
										<li><a class="twitter" href="<?= $kontak['twitter'] ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
										<li><a class="instagram" href="<?= $kontak['instagram'] ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
									</ul>
								</div>
							</div>		
							<!--/ End Footer About -->		
						</div>
						<div class="col-lg-2 col-md-6 col-12">
							<!-- Footer Links -->		
							<div class="single-widget f-link widget">
								<h3 class="widget-title">Menu</h3>
								<ul>
									<?php foreach ($navbar as $n) {
									?>
									<li><a href="<?= $n['link'] ?>"><?= $n['menu_nav'] ?></a></li>
									<?php
									} ?>
								</ul>
							</div>			
							<!--/ End Footer Links -->			
						</div>
						<div class="col-lg-4 col-md-6 col-12">
							<!-- Footer News -->
							<div class="single-widget footer-news widget">	
								<h3 class="widget-title">Kabar Terbaru</h3>
								<?php foreach ($berita_f as $b) {
								?>
								<!-- Single News -->
								<div class="single-f-news">
									<div class="post-thumb"><a href="#"><img src="<?= base_url('assets/img/berita/').$b['gambar'] ?>" alt="#"></a></div>
									<div class="content">
										<p class="post-meta"><time class="post-date"><i class="fa fa-clock-o"></i><?= date('j F Y',strtotime($b['tanggal_dibuat'])) ?></time></p>
										<h4 class="title"><a href="<?= base_url('berita/').$b['slug'] ?>"><?= $b['judul'] ?></a></h4>
									</div>
								</div>
								<!--/ End Single News -->
								<?php
								} ?>
								
							</div>			
							<!--/ End Footer News -->			
						</div>
						<div class="col-lg col-md-6 col-12">	
							<!-- Footer Contact -->		
							<div class="single-widget footer_contact widget">	
								<h3 class="widget-title">Kontak</h3>
								<ul class="address-widget-list">
									<li class="footer-mobile-number"><i class="fa fa-phone"></i><?= $kontak['telp'] ?></li>
									<li class="footer-mobile-number"><i class="fa fa-envelope"></i><?= $kontak['email'] ?></li>
									<li class="footer-mobile-number"><i class="fa fa-map-marker"></i><?= $kontak['alamat'] ?></li>
								</ul>
							</div>		
							<!--/ End Footer Contact -->						
						</div>
					</div>
				</div>
			</div>
			<!-- Copyright -->
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="copyright-content">
								<!-- Copyright Text -->
								<p>© Copyright <?php echo date("Y"); ?> Desaspasial by CV. Geo Art Science. Theme By ThemeLamp</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Copyright -->
		</footer>

		<script src="<?= base_url('assets/') ?>js/jquery-migrate-3.0.0.js"></script>

		<!-- munculkan mouse koordinat-->
	    <script src="<?= base_url('assets/vendor/leaflet/') ?>leaflet-mouseposition/L.Control.MousePosition.js"></script>
	    <!-- munculkan navigasi pengukuran-->
	    <script src="<?= base_url('assets/vendor/leaflet/') ?>leaflet-measure/leaflet-measure.js"></script>

	    <script src="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js"></script>

	    
		<!-- Chart JS -->
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
		<!-- Popper JS -->
		<script src="<?= base_url('assets/') ?>js/popper.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="<?= base_url('assets/') ?>js/bootstrap.min.js"></script>
		<!-- Modernizr JS -->
		<script src="<?= base_url('assets/') ?>js/modernizr.min.js"></script>
		<!-- ScrollUp JS -->
		<script src="<?= base_url('assets/') ?>js/scrollup.js"></script>
		<!-- FacnyBox JS -->
		<script src="<?= base_url('assets/') ?>js/jquery-fancybox.min.js"></script>
		<!-- Cube Portfolio JS -->
		<script src="<?= base_url('assets/') ?>js/cubeportfolio.min.js"></script>
		<!-- Slick Nav JS -->
		<script src="<?= base_url('assets/') ?>js/slicknav.min.js"></script>
		<!-- Slick Nav JS -->
		<script src="<?= base_url('assets/') ?>js/slicknav.min.js"></script>
		<!-- Slick Slider JS -->
		<script src="<?= base_url('assets/') ?>js/owl-carousel.min.js"></script>
		<!-- Easing JS -->
		<script src="<?= base_url('assets/') ?>js/easing.js"></script>
		<!-- Magnipic Popup JS -->
		<script src="<?= base_url('assets/') ?>js/magnific-popup.min.js"></script>
		<!-- Active JS -->
		<script src="<?= base_url('assets/') ?>js/active.js"></script>

		<script src="<?= base_url('assets/') ?>js/demografi.js"></script>
		
			    
	</body>
</html>