<div class="fsmw-settings-wrapper">
	<h2><span class="fsmw-settings-logo">Floating Social Media Widget</span> - Configure</h2>
	<p class="fsmw-settings-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation.</p>
	<form name="fsmw-settings-form" method="post" action="">
		<div class="wrap">
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
			<div class="fsmw-settings-form-row">
				<input class="fsmw-button" type="submit" name="Submit" value="Save Changes">
			</div>
		</div>
	</form>

	<div class="fsmw-copyright">
		<hr>
		<p>© Panos Mazarakis 2017 - <a href="mailto:info@panosmazarakis.com">info@panosmazarakis.com</a></p>
	</div>
</div>
<style type="text/css" media="screen">
	.fsmw-settings-wrapper {
		padding: 10px;
		width: 500px;
	}

	.fsmw-settings-wrapper h2 {
		font-weight: 200;
	}

	.fsmw-settings-wrapper .fsmw-settings-logo {
		font-weight: 600;
		color: #37a7ca;
		padding-right: 5px;
	}

	.fsmw-settings-wrapper .fsmw-settings-description {
		color: #737373;
		padding-bottom: 20px;
	}

	.fsmw-settings-wrapper .wrap {
		border: 1px solid #cecece;
		width: 300px;
		height: 300px;
		padding: 20px 55px 20px 15px;
	}

	.fsmw-settings-wrapper .wrap .fsmw-settings-form-row {
		float: right;
		height: 40px;
	}

	.fsmw-settings-wrapper .wrap .fsmw-settings-form-row input {
		margin-right: 0px;
	}

	.fsmw-settings-wrapper .wrap .fsmw-settings-form-row .fsmw-button {
		clear: both;
		margin-top: 20px;
		border: none;
		border-radius: 2px;
		padding: 5px 10px;
		background-color: #37a7ca;
		color: #fff;
	}

	.fsmw-settings-wrapper .wrap .fsmw-settings-form-row .fsmw-button:hover {
		cursor: pointer;
	}

	.fsmw-settings-wrapper .wrap .fsmw-settings-form-row .fsmw-settings-confirm {
		opacity: 0.3;
		margin-bottom: -6px;
		display: none;
	}

	.fsmw-settings-wrapper .fsmw-copyright {
		margin-top: 40px;
		font-weight: 200;
	}

	.fsmw-settings-wrapper .fsmw-copyright a {
		text-decoration: none;
	}

</style>
<script type="text/javascript">
	jQuery(document).ready(function($) {

		//inital check of the fields
		$('.fsmw-settings-wrapper .wrap .fsmw-settings-form-row input').each(function() {
			validate($(this));
		});

		//on field change (event)
		$('.fsmw-settings-wrapper .wrap .fsmw-settings-form-row input').change(function() {
			validate($(this));
			
		});

		//update label color according to the input's data-color value
		function validate(obj) {
			$this = obj;
			$slug = $this.attr('id');
			$label = $('label[for="'+$slug+'"]'); //select input's label
			$confirmSvg = $('*[data-slug="'+$slug+'"] .fsmw-settings-confirm');

			if(obj.val() != '') {
				$label.css('color', $this.data('color'));
				$confirmSvg.show();
			} else {
				$label.css('color', '#b1b1b1');
				$confirmSvg.hide();
			}
		}
	});
</script>