<?php get_header(); ?>

	<main role="main" class="has-sidebar">
		<div class="container">
			<!-- section -->
			<section class="listing">
				<ul class="breadcrumb">
					<li><a href="<?php echo home_url(); ?>">Home</a></li>
					<li><a href="/blog/">Blog</a></li>
				</ul>

				<h1>Author</h1>

				<?php get_template_part('loop'); ?>

				<?php get_template_part('pagination'); ?>

			</section>
			<!-- /section -->

			<?php get_sidebar(); ?>
		</div>
	</main>

<?php get_footer(); ?>