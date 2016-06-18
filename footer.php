	
		<!-- END CONTENT -->
		</div>
	
	<!-- END CONTAINER -->
	</div>
	
	<div id="instagram-footer">
		<div class="container">

		<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Instagram Footer') ) ?>
		</div>
		
	</div>
	
	<footer id="footer">
		
		<div class="container">
			
			<?php if(!get_theme_mod('fs_footer_share')) : ?>
			<div id="footer-social">
				
				<?php if(get_theme_mod('fs_facebook')) : ?><a href="http://facebook.com/<?php echo esc_html(get_theme_mod('fs_facebook')); ?>" target="_blank"><i class="fa fa-facebook"></i> <span>Facebook</span></a><?php endif; ?>
				<?php if(get_theme_mod('fs_twitter')) : ?><a href="http://twitter.com/<?php echo esc_html(get_theme_mod('fs_twitter')); ?>" target="_blank"><i class="fa fa-twitter"></i> <span>Twitter</span></a><?php endif; ?>
				<?php if(get_theme_mod('fs_instagram')) : ?><a href="http://instagram.com/<?php echo esc_html(get_theme_mod('fs_instagram')); ?>" target="_blank"><i class="fa fa-instagram"></i> <span>Instagram</span></a><?php endif; ?>
				<?php if(get_theme_mod('fs_pinterest')) : ?><a href="http://pinterest.com/<?php echo esc_html(get_theme_mod('fs_pinterest')); ?>" target="_blank"><i class="fa fa-pinterest"></i> <span>Pinterest</span></a><?php endif; ?>
				<?php if(get_theme_mod('fs_bloglovin')) : ?><a href="http://bloglovin.com/<?php echo esc_html(get_theme_mod('fs_bloglovin')); ?>" target="_blank"><i class="fa fa-heart"></i> <span>Bloglovin</span></a><?php endif; ?>
				<?php if(get_theme_mod('fs_google')) : ?><a href="http://plus.google.com/<?php echo esc_html(get_theme_mod('fs_google')); ?>" target="_blank"><i class="fa fa-google-plus"></i> <span>Google +</span></a><?php endif; ?>
				<?php if(get_theme_mod('fs_tumblr')) : ?><a href="http://<?php echo esc_html(get_theme_mod('fs_tumblr')); ?>.tumblr.com/" target="_blank"><i class="fa fa-tumblr"></i> <span>Tumblr</span></a><?php endif; ?>
				<?php if(get_theme_mod('fs_youtube')) : ?><a href="http://youtube.com/<?php echo esc_html(get_theme_mod('fs_youtube')); ?>" target="_blank"><i class="fa fa-youtube-play"></i> <span>Youtube</span></a><?php endif; ?>
				<?php if(get_theme_mod('fs_dribbble')) : ?><a href="http://dribbble.com/<?php echo esc_html(get_theme_mod('fs_dribbble')); ?>" target="_blank"><i class="fa fa-dribbble"></i> <span>Dribbble</span></a><?php endif; ?>
				<?php if(get_theme_mod('fs_soundcloud')) : ?><a href="http://soundcloud.com/<?php echo esc_html(get_theme_mod('fs_soundcloud')); ?>" target="_blank"><i class="fa fa-soundcloud"></i> <span>Soundcloud</span></a><?php endif; ?>
				<?php if(get_theme_mod('fs_vimeo')) : ?><a href="http://vimeo.com/<?php echo esc_html(get_theme_mod('fs_vimeo')); ?>" target="_blank"><i class="fa fa-vimeo-square"></i> <span>Vimeo</span></a><?php endif; ?>
				<?php if(get_theme_mod('fs_linkedin')) : ?><a href="<?php echo esc_html(get_theme_mod('fs_linkedin')); ?>" target="_blank"><i class="fa fa-linkedin"></i> <span>LinkedIn</span></a><?php endif; ?>
				<?php if(get_theme_mod('fs_rss')) : ?><a href="<?php echo esc_url(get_theme_mod('fs_rss')); ?>" target="_blank"><i class="fa fa-rss"></i> <span>RSS</span></a><?php endif; ?>
				
			</div>
			<?php endif; ?>
			
			<div id="footer-copyright">

				<p class="copyright"><?php echo wp_kses_post(get_theme_mod('fs_footer_copyright', '&copy; 2016 - ThemeWagon. All Rights Reserved. Designed & Developed by <a href="http://themewagon.com">ThemeWagon.com</a>')); ?></p>
				
			</div>
			
		</div>
		
	</footer>
	
	<?php wp_footer(); ?>
	
</body>

</html>