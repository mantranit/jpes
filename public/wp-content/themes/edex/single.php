<?php get_header(); ?>

<main role="main" class="has-sidebar">
	<div class="container">
		<!-- section -->
		<section>
			<ul class="breadcrumb">
				<li><a href="<?php echo home_url(); ?>">Home</a></li>
				<li><a href="/blog/">Blog</a></li>
				<li><?php the_category(', '); ?></li>
				<li><span><?php the_title(); ?></span></li>
			</ul>
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<h1>Blog: <?php the_category(', '); ?></h1>
				<!-- article -->
				<?php
				$etCls = '';
				if ( has_post_thumbnail()){ $etCls = 'has-thumbnail';}
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class($etCls); ?>>
					<header>
						<!-- post thumbnail -->
						<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
							<span class="blog-list">
								<?php echo get_the_post_thumbnail(null, 'blog-list'); ?>
							</span>
						<?php endif; ?>
						<!-- /post thumbnail -->
						<div class="title-area">
							<!-- post title -->
							<h2><?php the_title(); ?></h2>
							<!-- /post title -->

							<!-- post details -->
							<span class="date"><?php _e( 'Post on', 'html5blank' ); ?> <?php the_time('j F Y'); ?></span>
							<span class="author"><?php _e( 'by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
							<span class="categories"><?php _e( 'in', 'html5blank' ); ?> <?php the_category(', '); ?></span>
							<!-- /post details -->
						</div>
					</header>
					<br clear="all"/>
					<div class="body">
						<?php the_content(); // Dynamic Content ?>
					</div>
					<?php edit_post_link(); // Always handy to have Edit Post Links available ?>
					<div class="social">
						<span class='st_facebook_hcount' displayText='Facebook'></span>
						<span class='st_twitter_hcount' displayText='Tweet'></span>
						<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
						<span class='st_googleplus_hcount' displayText='Google +'></span>
						<span class='st_pinterest_hcount' displayText='Pinterest'></span>
						<span class='st_email_hcount' displayText='Email'></span>
					</div>
					<nav class="extra-links">
						<?php echo get_previous_post_link('%link', '&#8592; Previous'); ?>
						<?php echo get_next_post_link('%link', 'Newer &#8594;'); ?>
					</nav>
				</article>
				<!-- /article -->

			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>

					<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

				</article>
				<!-- /article -->

			<?php endif; ?>

		</section>
		<!-- /section -->

		<?php get_sidebar(); ?>
	</div>
</main>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "f5aa822b-dd9d-40c5-ab1d-949e4ccb9e9c", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<?php get_footer(); ?>
