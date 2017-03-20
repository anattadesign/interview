<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package anatta
 */
?>
<div id="sidebar">
	<div id="login" class="boxed">
		<h2 class="title">User Account</h2>
		<div class="content">
			<form id="form1" method="post" action="<?php echo home_url( 'wp-login.php' ) ?>">
				<fieldset>
					<?php if ( !is_user_logged_in() ) { ?>
						<legend>Sign-In</legend>
						<label for="username">User ID:</label>
						<input id="username" type="text" name="log" value="" />
						<label for="password">Password:</label>
						<input id="password" type="password" name="pwd" value="" />
						<input id="submit" type="submit" name="submit" value="Sign In" />
						<input type="hidden" name="redirect_to" value="<?php echo home_url() ?>">
						<p><a href="#">Forgot your password?</a></p>
					<?php } else { ?>
						<?php $current_user = wp_get_current_user() ?>
						<p>Welcome <?php $current_user->display_name ?>!</p>
					<?php } ?>
				</fieldset>
			</form>
		</div>
	</div>
	<div id="updates" class="boxed">
		<h2 class="title">Quick Link</h2>
		<div class="content">
			<ul>
				<?php if ( is_array( get_field( 'quick_links' ) ) ) { ?>
					<?php foreach ( get_field( 'quick_links' ) as $quick_link ) { ?>
						<li>
							<p><a href="<?php echo $quick_link['link'] ?>"><?php echo $quick_link['text'] ?></a></p>
						</li>
					<?php } ?>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>

<?php
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		return;
	}
?>
<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
