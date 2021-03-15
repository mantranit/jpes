			<!-- footer -->
			<footer class="footer" role="contentinfo">
				<div class="logo-bottom">
					<!-- logo -->
					<a class="logo" href="<?php echo home_url(); ?>">
						<!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
						<img src="<?php echo get_template_directory_uri(); ?>/images/JP_logo_white.png" alt="JP Energo Service">
					</a>
					<!-- /logo -->
				</div>
				<div class="rabel-bottom">
					<div class="container">
						<!-- nav -->
						<nav class="navigation" role="navigation">
							<?php edexNavigationAtFooter(); ?>
						</nav>
						<!-- /nav -->
						<div class="navbar-footer clearfix">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-footer" aria-expanded="false" aria-controls="navbar-footer">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<div class="navbar-brand">
								<div class="navbar-social">
									
									<a class="fa fa-twitter" href="#"></a>
                                    <a class="fa fa-facebook" href="#"></a>
                                    <a class="fa fa-linkedin" href="#"></a>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
			(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
			(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
			l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
			ga('send', 'pageview');
		</script>
	</body>
</html>
