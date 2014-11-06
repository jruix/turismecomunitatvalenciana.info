<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */

get_header(); ?>

	<div id="container">
	<?php get_sidebar(); ?>
		<div id="content" role="main">

			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( 'No encontrada', 'mantra' ); ?></h1>
				<div class="entry-content">
					<p><?php _e( 'Lo sentimos pero la página a la que intenta acceder no se encuentra en turismo en la comunitat valenciana.', 'mantra' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #container -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>
