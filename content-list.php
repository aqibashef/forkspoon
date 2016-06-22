<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 list-item'); ?>>
	
	<?php if(has_post_thumbnail()) : ?>
	<div class="post-img">
		<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('misc-thumb'); ?></a>
	</div>
	<?php endif; ?>
	
	<div class="list-content">
	
		<div class="post-header">
			
			<div class="post_info clearfix">

				<?php if(!get_theme_mod('fs_post_date')) : ?>
					<span class="post-date"><?php the_time( get_option('date_format') ); ?></span>
				<?php endif; ?>

				<span class="post-comments-link">
					<a href="<?php echo get_permalink(); ?>#comments"><?php comments_number( 'no comment', 'One comment', '% Comments' ); ?></a>
				</span>

			</div>
			
		</div>
		
		<div class="post-entry">
							
			<p><?php echo fs_string_limit_words(get_the_excerpt(), 39); ?>&hellip;</p>
							
		</div>
	
	</div>
	
</article>