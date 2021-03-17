<?php /* Template Name: Blog Template */ get_header(); ?>

<main role="main" class="has-sidebar">
    <div class="container">
        <!-- section -->
        <section class="listing">
            <ul class="breadcrumb">
                <li><a href="<?php echo home_url(); ?>">Home</a></li>
                <li><span>Blog</span></li>
            </ul>
            <?php
            $paged = ( is_front_page() ) ? 'page' : 'paged' ;
            $args = array(
                'orderby'=>'date',
                'order'=>'desc',
                'post_type'=>'post',
                'paged' => get_query_var($paged),
                'posts_per_page'=> 3,
            );
            query_posts($args);
            ?>

            <h1>Blog</h1>

            <?php get_template_part('loop'); ?>

            <?php get_template_part('pagination'); ?>

        </section>
        <!-- /section -->

        <?php get_sidebar(); ?>
    </div>
</main>

<?php get_footer(); ?>
