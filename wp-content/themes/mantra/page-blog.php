<?php /*
Template Name: page-blog
*/ ?>


<?php get_header(); ?>

		<div id="container">
		<?php get_sidebar(); ?>
			<div id="content" role="main">

	


	<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('post_status=publish,future&orderby=date&order=desc&posts_per_page='.get_option('posts_per_page').'&paged=' . $paged);?>


		<?php if ( have_posts() ) : ?>

				<?php mantra_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php mantra_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'mantra' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mantra' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>




			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
