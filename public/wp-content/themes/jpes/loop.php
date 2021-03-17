<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<?php
	$etCls = '';
	if ( has_post_thumbnail()){ $etCls = 'has-thumbnail';}
	?>
	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class($etCls); ?>>

		<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a class="blog-list" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php echo get_the_post_thumbnail(null, 'blog-list'); ?>
			</a>
		<?php endif; ?>
		<!-- /post thumbnail -->

		<!-- post title -->
		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>
		<!-- /post title -->

		<!-- post details -->
		<span class="date"><?php _e( 'Post on', 'html5blank' ); ?> <?php the_time('j F Y'); ?></span>
		<span class="author"><?php _e( 'by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
        <span class="categories"><?php _e( 'in', 'html5blank' ); ?> <?php the_category(', '); ?></span>
		<!-- /post details -->
		<div class="summary">
			<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
            <a class="view-article" href="<?php the_permalink(); ?>">Read full post</a>
		</div>

	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
