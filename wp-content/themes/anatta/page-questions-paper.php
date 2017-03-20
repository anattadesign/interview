<?php
	/**
	 * Template Name: Question Paper
	 */

get_header(); the_post(); ?>

<?php
	if ( !is_user_logged_in() ) {
		echo "You do not have access of this page";
		return;
	}

	$total_time  = get_field( 'total_time' ); // this should be in seconds
	$user_id = get_current_user_id();
	$time = new DateTime( 'now' );
	$first_time = true;
	$start_time_diff_from_current_time = 0;
	$time_difference_in_submit = 0;

	if ( !( $start_time = get_user_meta( $user_id, 'exam_start_time', true ) ) ) {
		update_user_meta( $user_id, 'exam_start_time', $time->getTimestamp() );
	} else {
		$first_time = false;
		$start_time_diff_from_current_time = $time->getTimestamp() - $start_time;
	}

	if ( isset( $_POST['user_id'] ) ) {
		anatta_save_user_answers( $start_time_diff_from_current_time );
	}

	if ( !$first_time && $start_time_diff_from_current_time > $total_time ) {
		$time_difference_in_submit = $start_time_diff_from_current_time - $total_time;
	}

	$answers = get_user_meta($user_id, 'question_answers', true );
	$questions = new WP_Query( array( 'post_type' => 'question', 'post_status' => 'publish', 'posts_per_page' => -1 ) );
?>
	<div id="main" class="main post">
		<?php if ( $time_difference_in_submit ) { ?>
			<div class="exam_timer" data-time_in_second="0">Exam Time Finished</div>
		<?php } else { ?>
			<div class="exam_timer" data-time_in_second="<?php echo ( $total_time - $start_time_diff_from_current_time ) ?>">Exam Time:- <?php echo number_format( ( ( $total_time - $start_time_diff_from_current_time ) / 60 ), 2 )  ?> Minutes</div>
		<?php } ?>

		<h2 class="title"><?php the_title(); ?></h2>
		<div class="content"><?php echo get_the_content(); ?></div>
		<form name="question-paper" action="<?php echo home_url( 'question-paper' ) ?>" method="post">
			<?php if ( $questions->have_posts() ) { ?>
				<?php while ( $questions->have_posts() ) { $questions->the_post(); ?>
					<div class="question-wrapper">
						<h3 class="question">Q <?php echo $questions->post_count ?>:- <?php the_title(); ?></h3>
						<?php $question_id = get_the_Id(); ?>
						<?php if ( !$time_difference_in_submit ) { ?>
							<textarea class="answer" name="question-<?php the_ID() ?>"><?php if ( is_array( $answers ) && isset( $answers[ $question_id ] ) ) echo $answers[ $question_id ]; ?></textarea>
						<?php } else { ?>
							<p class="answer"><b>Answer:- </b><?php if ( is_array( $answers ) && isset( $answers[ $question_id ] ) ) { echo $answers[ $question_id ]; } else { echo "N/A"; }?></p>
						<?php } ?>
						<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
					</div>
				<?php } ?>
			<?php } wp_reset_query(); ?>
			<?php if ( !$time_difference_in_submit ) { ?>
				<input type="submit" value="SUBMIT" class="question-submit">
			<?php } ?>
		</form>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
