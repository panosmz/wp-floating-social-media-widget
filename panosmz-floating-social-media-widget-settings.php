<div class="fsmw-settings-wrapper">
	<h2><span class="fsmw-settings-logo">Floating Social Media Widget</span> - Configure</h2>
	<p class="fsmw-settings-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation.</p>
	<form name="fsmw-settings-form" method="post" action="">
		<div class="wrap settings">
			<span class="fsmw-wrap-tag">Settings</span>
			<div class="fsmw-settings-form-row">
				<label for="fsmw_theme">Theme: </label>
				<select name="fsmw_theme">
					<?php 

					foreach ($fsmwData['theme-options'] as $themeOption) {
						?>
						<option value="<?php echo $themeOption['slug']; ?>"<?php if ($themeOption['slug'] == $fsmwData['theme']) { echo 'selected'; } ?>><?php echo $themeOption['title']; ?></option>
						<?php
					}

					?>
				</select>
			</div>
		</div>
		<div class="wrap links">
			<span class="fsmw-wrap-tag">Links</span>
			<?php
			foreach ($fsmwData['social-media-links'] as $fsmwLinks) {
			?>
			<div class="fsmw-settings-form-row" data-slug="<?php echo $fsmwLinks['slug']; ?>">
				<img src="<?php echo WP_PLUGIN_URL . '/panosmz-floating-social-media-widget/assets/valid.svg'; ?>" height="15" class="fsmw-settings-confirm">
				<label for="<?php echo $fsmwLinks['slug']; ?>"><?php echo $fsmwLinks['title']; ?>:</label>
				<input type="text" name="fsmw_<?php echo $fsmwLinks['slug']; ?>" id="<?php echo $fsmwLinks['slug']; ?>" data-color="<?php echo $fsmwLinks['color']; ?>" value="<?php echo esc_attr($fsmwLinks['url']); ?>">
			</div>
			<?php
			}
			?>
		</div>
		<div class="wrap wrap-button">
			<span class="fsmw-wrap-tag">Save</span>
			<div class="fsmw-settings-form-row">
				<input class="fsmw-button" type="submit" name="Submit" value="Save Changes">
				<img src="<?php echo WP_PLUGIN_URL . '/panosmz-floating-social-media-widget/assets/loading.svg'; ?>" height="25" id="fsmw-settings-loading">
			</div>
		</div>
	</form>

	<div class="fsmw-copyright">
		<hr>
		<p>© Panos Mazarakis 2017 - <a href="mailto:info@panosmazarakis.com">info@panosmazarakis.com</a></p>
	</div>
</div>
<?php 
	wp_register_style ('fsmwAdmin', plugin_dir_url( __FILE__ ).'css/admin.css' );
	wp_enqueue_style ('fsmwAdmin');

	wp_enqueue_script( 'fsmwSettings', plugin_dir_url( __FILE__ ).'js/settings.js', array(), '1.0.0', true );
?>