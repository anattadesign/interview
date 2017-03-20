<?php
/**
 * Template Name: Home Page
 */

get_header(); ?>
<?php get_sidebar(); the_post(); ?>
	<div id="main">
		<?php echo get_the_content(); ?>
	</div>

<?php
get_footer();
