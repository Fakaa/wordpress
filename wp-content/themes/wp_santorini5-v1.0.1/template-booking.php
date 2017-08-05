<?php
/*
 * Template Name: Booking Page
 */
?>

<?php
	// Sanitize data, or initialize if they don't exist.
	$clientname = isset($_POST['ci_name']) ? esc_html(trim($_POST['ci_name'])) : '';
	$email = isset($_POST['ci_email']) ? esc_html(trim($_POST['ci_email'])) : '';
	$arrive = isset($_POST['arrive']) ? esc_html(trim($_POST['arrive'])) : '';
	$depart = isset($_POST['depart']) ? esc_html(trim($_POST['depart'])) : '';
	$guests = isset($_POST['adults']) ? intval($_POST['adults']) : '0';
	$children = isset($_POST['children']) ? intval($_POST['children']) : '0';
	$message = isset($_POST['ci_comments']) ? sanitize_text_field(stripslashes($_POST['ci_comments'])) : '';
	if(!empty($_POST['room_select']))
		$room_id = intval($_POST['room_select']);
	elseif(!empty($_GET['room_select']))
		$room_id = intval($_GET['room_select']);
	else
		$room_id = '';

	$errorString = '';
	$emailSent = false;

	if(isset($_POST['send_booking']))
	{
		// We are here because the form was submitted. Let's validate!

		if(empty($clientname) or mb_strlen($clientname) < 2)
			$errorString .= '<li><i class="fa fa-times"></i> '.__('Your name is required.', 'ci_theme').'</li>';

		if(empty($email) or !is_email($email))
			$errorString .= '<li><i class="fa fa-times"></i> '.__('A valid email is required.', 'ci_theme').'</li>';

		if(empty($arrive) or strlen($arrive) != 10)
			$errorString .= '<li><i class="fa fa-times"></i> '.__('A complete arrival date is required.', 'ci_theme').'</li>';

		if(!checkdate(substr($arrive, 5, 2), substr($arrive, 8, 2), substr($arrive, 0, 4)))
			$errorString .= '<li><i class="fa fa-times"></i> '.__('The arrival date must be in the form yyyy/mm/dd.', 'ci_theme').'</li>';

		if(empty($depart) or strlen($depart) != 10)
			$errorString .= '<li><i class="fa fa-times"></i> '.__('A complete departure date is required.', 'ci_theme').'</li>';

		if(!checkdate(substr($depart, 5, 2), substr($depart, 8, 2), substr($depart, 0, 4)))
			$errorString .= '<li><i class="fa fa-times"></i> '.__('The departure date must be in the form yyyy/mm/dd.', 'ci_theme').'</li>';

		if(empty($guests) or !is_numeric($guests) or $guests < 1)
			$errorString .= '<li><i class="fa fa-times"></i> '.__('A number of one or more adults is required.', 'ci_theme').'</li>';

		if(empty($room_id) or !is_numeric($room_id) or $room_id < 1)
		{
			$errorString .= '<li><i class="fa fa-times"></i> '.__('You must select the room you are interested in.', 'ci_theme').'</li>';
		}
		else
		{
			$room = get_post($room_id);
			if($room===null or get_post_type($room)!='room')
			{
				// Someone tried to pass a post id that isn't a room. Kinky.
				$errorString .= '<li><i class="fa fa-times"></i> '.__('You must select the room you are interested in.', 'ci_theme').'</li>';
			}
		}

		// Message is optional, so, no check.


		// Alright, lets send the email already!
		if(empty($errorString))
		{
			$mailbody  = __("Name:", 'ci_theme') . " " . $clientname . "\n";
			$mailbody .= __("Email:", 'ci_theme') . " " . $email . "\n";
			$mailbody .= __("Arrival:", 'ci_theme') . " " . $arrive . "\n";
			$mailbody .= __("Departure:", 'ci_theme') . " " . $depart . "\n";
			$mailbody .= __("Adults:", 'ci_theme') . " " . $guests . "\n";
			$mailbody .= __("Children:", 'ci_theme') . " " . $children . "\n";
			$mailbody .= __("Room:", 'ci_theme') . " " . $room->post_title . "\n";
			$mailbody .= __("Message:", 'ci_theme') . " " . $message . "\n";

			// If you want to receive the email using the address of the sender, comment the next $emailSent = ... line
			// and uncomment the one after it.
			// Keep in mind the following comment from the wp_mail() function source:
			/* If we don't have an email from the input headers default to wordpress@$sitename
			* Some hosts will block outgoing mail from this address if it doesn't exist but
			* there's no easy alternative. Defaulting to admin_email might appear to be another
			* option but some hosts may refuse to relay mail from an unknown domain. See
			* http://trac.wordpress.org/ticket/5007.
			*/
			$emailSent = wp_mail(ci_setting('booking_form_email'), ci_setting('logotext').' - '. __('Booking form', 'ci_theme'), $mailbody);
			//$emailSent = wp_mail(ci_setting('contact_form_email'), ci_setting('logotext').' - '. __('Contact form', 'ci_theme'), $mailbody, 'From: "'.$clientname.'" <'.$email.'>');
		}

	}
?>

<?php get_header(); ?>

	<main id="main">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h2 class="page-title"><?php the_title(); ?></h2>

					<div class="row">
						<div class="col-sm-8">
							<article <?php post_class('entry'); ?>>
								<?php if(!empty($errorString)): ?>
									<ul id="formerrors">
										<?php echo $errorString; ?>
									</ul>
								<?php endif; ?>

								<?php if($emailSent===true): ?>
									<p id="formsuccess"><i class="fa fa-check"></i> <?php _e('Your booking request has been sent. We will contact you as soon as possible.', 'ci_theme'); ?></p>
								<?php elseif($emailSent===false and isset($_POST['send_booking']) and $errorString==''): ?>
									<p id="sendfail"><?php _e('There was a problem while sending the email. Please try again later.', 'ci_theme'); ?></p>
								<?php endif; ?>


								<?php the_content(); ?>

								<?php if(  !isset($_POST['send_booking'])  or  (isset($_POST['send_booking']) and !empty($errorString))  ): ?>
								<form class="booking" action="<?php the_permalink(); ?>" method="post">

									<div class="row">
										<div class="col-md-6">
											<input type="text" name="ci_name" id="ci_name" placeholder="<?php _e('your name', 'ci_theme'); ?>" value="<?php echo esc_attr($clientname); ?>">
										</div>

										<div class="col-md-6">
											<input type="email" name="ci_email" id="ci_email" class="datepicker" placeholder="<?php _e('your email', 'ci_theme'); ?>" value="<?php echo esc_attr($email); ?>">
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<input type="text" name="arrive" id="arrive" class="datepicker" placeholder="<?php _e('arrival', 'ci_theme'); ?>" value="<?php echo esc_attr($arrive); ?>">
										</div>

										<div class="col-md-6">
											<input type="text" name="depart" id="depart" class="datepicker" placeholder="<?php _e('departure', 'ci_theme'); ?>" value="<?php echo esc_attr($depart); ?>">
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<select name="adults" id="adults" class="dk">
												<option selected disabled><?php _e('adults', 'ci_theme'); ?></option>
												<option value="1" <?php selected($guests, '1'); ?>>1</option>
												<option value="2" <?php selected($guests, '2'); ?>>2</option>
												<option value="3" <?php selected($guests, '3'); ?>>3</option>
												<option value="4" <?php selected($guests, '4'); ?>>4</option>
												<option value="5" <?php selected($guests, '5'); ?>>5</option>
												<option value="6" <?php selected($guests, '6'); ?>>6</option>
											</select>
										</div>

										<div class="col-md-6">
											<select name="children" id="children" class="dk">
												<option selected disabled><?php _e('children', 'ci_theme'); ?></option>
												<option value="1" <?php selected($children, '1'); ?>>1</option>
												<option value="2" <?php selected($children, '2'); ?>>2</option>
												<option value="3" <?php selected($children, '3'); ?>>3</option>
												<option value="4" <?php selected($children, '4'); ?>>4</option>
												<option value="5" <?php selected($children, '5'); ?>>5</option>
												<option value="6" <?php selected($children, '6'); ?>>6</option>
											</select>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<?php
												wp_dropdown_posts(array(
													'id' => 'room_select',
													'post_type' => 'room',
													'selected' => $room_id,
													'class' => 'dk'
												), 'room_select');
											?>
											<textarea name="ci_comments" id="ci_comments" cols="30" rows="10" placeholder="<?php _e('comments', 'ci_theme'); ?>"></textarea>

											<button type="submit" name="send_booking"><?php _e('submit', 'ci_theme'); ?></button>
										</div>
									</div>
								</form>
								<?php endif; ?>
							</article>
						</div>
						<?php endwhile; endif; ?>
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>