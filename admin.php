<?php

function ccl_RegisterSettings( )
{
	register_setting( 'ccl', 'ccl_content' );
	register_setting( 'ccl', 'ccl_link_cnil' );
	register_setting( 'ccl', 'ccl_label_cnil' );
	register_setting( 'ccl', 'ccl_label_button_accept' );
	register_setting( 'ccl', 'ccl_class_button_accept' );
	register_setting( 'ccl', 'ccl_background-color' );
	register_setting( 'ccl', 'ccl_text-color' );
}

// la fonction ccl_AdminMenu( ) sera exécutée
// quand WordPress mettra en place le menu d'admin
add_action( 'admin_menu', 'ccl_AdminMenu' );
function ccl_AdminMenu( )
{
	add_options_page(
	   'Check Cookie Lite',
	   'Check Cookie Lite',
	   'manage_options',
	   'ccl_setting',
	   'ccl_SettingsPage'
   );

	add_action( 'admin_init', 'ccl_RegisterSettings' );

}

function ccl_SettingsPage( )
{
	$ccl_background_color = get_option('ccl_background-color', 'rgba(0,0,0,.9)');
	if(empty($ccl_background_color)){
		$ccl_background_color = 'rgba(0,0,0,.9)';
	}

	$ccl_color_color = get_option('ccl_text-color', '#fff');
	if(empty($ccl_color_color)){
		$ccl_color_color = '#fff';
	}

	$fp = fopen(plugin_dir_path( __DIR__ ) . 'check-cookie-lite/assets/css/check-cookie-lite.css', 'w');
	fwrite($fp, '#check-cookie-lite-container{
		width:100%;
		position:fixed;
		bottom:0;
		text-align: center;
		background-color: '.$ccl_background_color.';
		padding:.5em;
		box-shadow: -1em 0 1em black;
	}
	#check-cookie-lite-container p{
		color:'.$ccl_color_color.';
		margin:0;
	}');
	fclose($fp);

?>
	<div class="wrap">
		<h2><?php _e('Setting Check Cookie Lite', 'check-cookie-lite');?></h2>

		<form method="post" action="options.php">

			<?php
				settings_fields( 'ccl' );
			?>
			<table class="form-table">
				<?php
				ccl_add_option_text('ccl_content', __('Check cookie message', 'check-cookie-lite'));
				ccl_add_option_text('ccl_link_cnil', __('More information link' , 'check-cookie-lite'));
				ccl_add_option_text('ccl_label_cnil', __('More information label' , 'check-cookie-lite'));
				ccl_add_option_text('ccl_label_button_accept', __('Accept button label' , 'check-cookie-lite'));
				ccl_add_option_text('ccl_class_button_accept', __('Buttons class' , 'check-cookie-lite'));
				ccl_add_option_text('ccl_background-color', __('Container background-color' , 'check-cookie-lite'));
				ccl_add_option_text('ccl_text-color', __('Text color' , 'check-cookie-lite'));
				?>
			</table>
			<?php submit_button();?>
		</form>
	</div>
<?php
}


function ccl_add_option_text($name, $label){
	echo '	<tr valign="top">
				<th scope="row"><label for="'.$name.'">'.$label.'</label></th>
				<td><input type="text" id="'.$name.'" name="'.$name.'" class="regular-text" value="'.get_option( $name ).'" /></td>
			</tr>';

}
