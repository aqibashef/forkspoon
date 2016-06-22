<article id="post-<?php the_ID(); ?>" <?php post_class("col-md-12"); ?>>
					
	<div class="post-header">
		
		<?php if(is_single()) : ?>
			<h1><?php the_title(); ?></h1>
		<?php else : ?>
			<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>


		<div class="post_info clearfix">

			<?php if(!get_theme_mod('fs_post_date')) : ?>
				<span class="post-date"><?php the_time( get_option('date_format') ); ?></span>
			<?php endif; ?>

			<span class="post-comments-link">
				<a href="<?php echo get_permalink(); ?>#comments"><?php comments_number( 'no comment', 'One comment', '% Comments' ); ?></a>
			</span>

		</div>
		
	</div>
	
	<?php if(has_post_format('gallery')) : ?>
	
		<?php $images = get_post_meta( $post->ID, '_format_gallery_images', true ); ?>
		
		<?php if($images) : ?>
		<div class="post-img">
		<div class="sideslides">
		<ul class="bxslider">
		<?php foreach($images as $image) : ?>
			
			<?php $the_image = wp_get_attachment_image_src( $image, 'full-thumb' ); ?> 
			<?php $the_caption = get_post_field('post_excerpt', $image); ?>
			<li><img src="<?php echo esc_url($the_image[0]); ?>" <?php if($the_caption) : ?>title="<?php echo $the_caption; ?>"<?php endif; ?> /></li>
			
		<?php endforeach; ?>
		</ul>
		</div>
		</div>
		<?php endif; ?>
	
	<?php elseif(has_post_format('video')) : ?>
	
		<div class="post-img">
			<?php $fs_video = get_post_meta( $post->ID, '_format_video_embed', true ); ?>
			<?php if(wp_oembed_get( $fs_video )) : ?>
				<?php echo wp_oembed_get($fs_video); ?>
			<?php else : ?>
				<?php echo $fs_video; ?>
			<?php endif; ?>
		</div>
	
	<?php elseif(has_post_format('audio')) : ?>
	
		<div class="post-img audio">
			<?php $fs_audio = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
			<?php if(wp_oembed_get( $fs_audio )) : ?>
				<?php echo wp_oembed_get($fs_audio); ?>
			<?php else : ?>
				<?php echo $fs_audio; ?>
			<?php endif; ?>
		</div>
	
	<?php else : ?>
		
		<?php if(has_post_thumbnail()) : ?>
		<?php if(!get_theme_mod('fs_post_thumb')) : ?>
		<div class="post-img">
			<?php if(is_single()) : ?>
				<?php the_post_thumbnail('full-thumb'); ?>
			<?php else : ?>
				<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('full-thumb'); ?></a>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php endif; ?>
		
	<?php endif; ?>
	
	<div class="post-entry">
		
		<?php if(is_single()) : ?>
		
			<?php the_content(); ?>
			
		<?php else : ?>
		
			<?php if(get_theme_mod('fs_post_summary') == 'excerpt') : ?>
				
				<p><?php echo fs_string_limit_words(get_the_excerpt(), 80); ?>&hellip;</p>
				<p><a href="<?php echo get_permalink() ?>" class="more-link"><span class="more-button"><?php _e( 'Continue Reading <span>&raquo;</span>', 'forkspoon' ); ?></span></a>
				
			<?php else : ?>
				
				<?php the_content(__('Continue Reading &raquo;', 'forkspoon')); ?>
				
			<?php endif; ?>
		
		<?php endif; ?>
		
		<?php wp_link_pages(); ?>
		

		<?php if(!get_theme_mod('fs_post_cat')) : ?>
		<?php if(is_single()) : ?>
			<div class="post-cats">
				<?php the_category("&bull;",""); ?>
			</div>
		<?php endif; ?>	
		<?php endif; ?>


		<?php if(!get_theme_mod('fs_post_tags')) : ?>
		<?php if(is_single()) : ?>
		<?php if(has_tag()) : ?>
			<div class="post-tags">
				<?php the_tags("",""); ?>
			</div>
		<?php endif; ?>	
		<?php endif; ?>
		<?php endif; ?>
		
	</div>
	
	
	<?php if(!get_theme_mod('fs_post_author')) : ?>
	<?php if(is_single()) : ?>
		<?php get_template_part('inc/templates/about_author'); ?>
	<?php endif; ?>
	<?php endif; ?>
	
	<?php if(!get_theme_mod('fs_post_related')) : ?>
	<?php if(is_single()) : ?>
		<?php get_template_part('inc/templates/related_posts'); ?>
	<?php endif; ?>
	<?php endif; ?>
	
	<?php comments_template( '', true );  ?>
	
</article>