<?php get_header(); ?>
	
	<div class="container">
		
		<div class="row">
			<div class="<?php if(get_theme_mod('fs_sidebar_archive') == true) { ?>col-sm-12 fullwidth<?php } else {?> col-sm-8 <?php } if(get_theme_mod('fs_archive_layout') == 'full_grid') echo 'full_grid'?>" >
			
				<div class="archive-box">
	
					<?php
						if ( is_day() ) :
							echo _e( '<span>Daily Archives</span>', 'forkspoon' );
							printf( __( '<h1>%s</h1>', 'forkspoon' ), get_the_date() );

						elseif ( is_month() ) :
							echo _e( '<span>Monthly Archives</span>', 'forkspoon' );
							printf( __( '<h1>%s</h1>', 'forkspoon' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'forkspoon' ) ) );

						elseif ( is_year() ) :
							echo _e( '<span>Yearly Archives</span>', 'forkspoon' );
							printf( __( '<h1>%s</h1>', 'forkspoon' ), get_the_date( _x( 'Y', 'yearly archives date format', 'forkspoon' ) ) );

						else :
							_e( '<h1>Archives</h1>', 'forkspoon' );

						endif;
					?>
					
				</div>
			
				<?php if(get_theme_mod('fs_archive_layout') == 'grid' || get_theme_mod('fs_archive_layout') == 'full_grid') : ?><ul class="sp-grid"><?php endif; ?>
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<?php if(get_theme_mod('fs_archive_layout') == 'grid') : ?>
					
						<?php get_template_part('content', 'grid'); ?>
					
					<?php elseif(get_theme_mod('fs_archive_layout') == 'list') : ?>
					
						<?php get_template_part('content', 'list'); ?>
						
					<?php elseif(get_theme_mod('fs_archive_layout') == 'full_list') : ?>
					
						<?php if( $wp_query->current_post == 0 && !is_paged() ) : ?>
							<?php get_template_part('content'); ?>
						<?php else : ?>
							<?php get_template_part('content', 'list'); ?>
						<?php endif; ?>
					
					<?php elseif(get_theme_mod('fs_archive_layout') == 'full_grid') : ?>
					
						<?php if( $wp_query->current_post == 0 && !is_paged() ) : ?>
							<?php get_template_part('content'); ?>
						<?php else : ?>
							<?php get_template_part('content', 'grid'); ?>
						<?php endif; ?>
					
					<?php else : ?>
						
						<?php get_template_part('content'); ?>
						
					<?php endif; ?>	
						
				<?php endwhile; ?>
				
				<?php if(get_theme_mod('fs_archive_layout') == 'grid' || get_theme_mod('fs_archive_layout') == 'full_grid') : ?></ul><?php endif; ?>
				
					<?php themewagon_pagination(); ?>
				
				<?php else : ?>
					
					<?php get_template_part('content', 'none'); ?>
					
				<?php endif; ?>
				
			</di
			<?php if(get_theme_mod('fs_sidebar_archive')) : else : ?>

				<div class="col-sm-4">
					<?php get_sidebar(); ?>					
				</div><!--/.col-sm-4-->

			<?php endif; ?>

<?php get_footer(); ?>