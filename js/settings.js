jQuery(document).ready(function($) {

	//inital check of the fields
	$('.fsmw-settings-wrapper .wrap .fsmw-settings-form-row input').each(function() {
		validate($(this));
	});

	//on field change (event)
	$('.fsmw-settings-wrapper .wrap .fsmw-settings-form-row input').change(function() {
		validate($(this));
		
	});

	//button click
	$('.fsmw-settings-wrapper .wrap .fsmw-settings-form-row .fsmw-button').click(function() {
		$(this).css('opacity', '0');
		$('.fsmw-settings-wrapper #fsmw-settings-loading').css('-webkit-animation', 'spin 3s infinite linear');
		$('.fsmw-settings-wrapper #fsmw-settings-loading').show();
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