<?php
/**
 *
 */
 function ccl_test_navigation(){
	 if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME']) !== FALSE) {
	 	setcookie('check-cookie-lite', 'accept', time() + (365*24*60*60),'/');
	 }
}
add_action( 'init', 'ccl_test_navigation' );

/**
 * Ajout des assets nécessaires si il n'y a pas le cookie
 */
function ccl_add_front() {

	//navigation sur le site (au moins la deuxieme page de navigation)
	if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME']) == true){
		return;
	}
	//si il n'y a pas de cookie et pas de navigation on affiche la banniere
	if(!isset($_COOKIE['check-cookie-lite']) ):
		wp_enqueue_style( 'ccl_style', plugin_dir_url(dirname( __FILE__) ) . 'check-cookie-lite/assets/css/check-cookie-lite.css' );
		wp_enqueue_script( 'ccl_script', plugin_dir_url(dirname( __FILE__) ) . 'check-cookie-lite/assets/js/check-cookie-lite.js');
		?>
		<div id="check-cookie-lite-container">
			<p>
				<?php if(!empty(get_option( 'ccl_content'))):
					echo get_option( 'ccl_content');
				else:
					_e('We use cookies to guarantee you the best experience on our site.<br />
					By continuing your navigation, we will consider that you accept the use of cookies', 'check-cookie-lite');
				endif; ?>

				<br />

				<?php
				$classBtn = "button";
				if(!empty(get_option( 'ccl_class_button_accept'))):
					$classBtn = get_option( 'ccl_class_button_accept');
				endif; ?>

				<?php if(!empty(get_option( 'ccl_link_cnil')) && !empty(get_option( 'ccl_label_cnil'))):?>
					<a href="<?php echo get_option( 'ccl_link_cnil');?>" id="info-cookie" target="_blank" class="<?php echo $classBtn;?>">
						<?php echo get_option( 'ccl_label_cnil');?>
					</a>
				<?php else: ?>
					<a href="https://www.cnil.fr/fr/cookies-traceurs-que-dit-la-loi" id="info-cookie" target="_blank" class="<?php echo $classBtn;?>">
						<?php _e('What the law says ?', 'check-cookie-lite'); ?>
					</a>
				<?php endif;?>

				<?php $labelBtn = __("Accept", 'check-cookie-lite');
				if(!empty(get_option( 'ccl_label_button_accept'))):
					$labelBtn = get_option( 'ccl_label_button_accept');
				endif; ?>

				<button id="ccl-accept-cookie" class="<?php echo $classBtn;?>"><?php echo $labelBtn;?></button>
			</p>
		</div>
	<?php endif;
}
add_action( 'wp_footer', 'ccl_add_front' );
