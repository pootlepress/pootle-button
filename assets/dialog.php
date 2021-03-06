<?php
$editing = ! empty( $_GET['edit_button'] );
$assets_url = esc_attr( $_GET['assets_url'] );
?>
<!DOCTYPE html>
<html>
<head>
	<style>
		html {
			margin: 2px !important;
		}
		body.wp-core-ui {
			font-family: verdana, arial, sans-serif;
			color: #454545;
			overflow: initial;
			height: auto;
		}
		section {
			padding: 70px 0 70px;
		}
		p {
			font-size: 0.88em;
			margin: 0.5em;
		}
		h3 {
			font-weight: normal;
			color: #333;
		}
		.field {
			margin: 1em 0;
		}

		.field > label {
			display: inline-block;
			width: 205px;
		}

		.field > * {
			vertical-align: middle;
		}

		.field > .input-wrap, .field > input, .field select {
			width: 178px;
		}

		.field > .input-wrap {
			display: inline-block;
			position: relative;
			font-size: 0;
		}

		.field > .input-wrap * {
			font-size: 16px;
		}

		.field input[type="range"] {
			width: 133px;
		}

		.field #font-size-helper {
			width: 40px;
			margin-left: 5px;
		}

		header, footer {
			background: #fcfcfc;
			padding: 5px;
			position: fixed;
			bottom: 0;
			left: 0;
			right: 0;
			text-align: right;
			z-index: 16;
		}
		footer {
			border-top: 1px solid #dfdfdf;
		}
		header.preview {
			border-bottom: 1px solid #dfdfdf;
			bottom: auto;
			top: 0;
			text-align: center;
		}
		.preview p {
			position: absolute;
			top: 0;
			margin: 0;
		}

		input[type=range] {
			-webkit-appearance: none;
			margin: 5px 0;
			padding: 0;
		}
		input[type=range]:focus {
			outline: none;
		}
		input[type=range]::-webkit-slider-runnable-track {
			height: 10px;
			cursor: pointer;
			background: #ffffff;
			border-radius: 5px;
			border: 1px solid #ccc;
		}
		input[type=range]::-webkit-slider-thumb {
			border: 1px solid #aaa;
			height: 16px;
			width: 16px;
			border-radius: 8px;
			background: #ffffff;
			cursor: pointer;
			-webkit-appearance: none;
			margin-top: -4px;
		}
		input[type=range]:focus::-webkit-slider-runnable-track {
			background: #ffffff;
		}
		input[type=range]::-moz-range-track {
			height: 10px;
			cursor: pointer;
			background: #ffffff;
			border-radius: 5px;
			border: 1px solid #ccc;
		}
		input[type=range]::-moz-range-thumb {
			border: 1px solid #aaa;
			height: 16px;
			width: 16px;
			border-radius: 8px;
			background: #ffffff;
			cursor: pointer;
			margin-top: -4px;
		}
		input[type=range]::-ms-track {
			height: 10px;
			cursor: pointer;
			background: transparent;
			border-color: transparent;
			color: transparent;
		}
		input[type=range]::-ms-fill-lower {
			background: #f2f2f2;
			border: 1px solid #ccc;
			border-radius: 10px;
		}
		input[type=range]::-ms-fill-upper {
			background: #ffffff;
			border: 1px solid #ccc;
			border-radius: 10px;
		}
		input[type=range]::-ms-thumb {
			border: 1px solid #aaa;
			height: 16px;
			width: 16px;
			border-radius: 8px;
			background: #ffffff;
			cursor: pointer;
			margin-top: -4px;
		}
		input[type=range]:focus::-ms-fill-lower {
			background: #ffffff;
		}
		input[type=range]:focus::-ms-fill-upper {
			background: #ffffff;
		}

		.wp-picker-container {
			display: inline-block;
		}

		a.wp-color-result.button:after {
			content: attr(title);
			background: #f7f7f7;
			border-radius: 0 2px 2px 0;
			border-left: 1px solid #ccc;
			color: #555;
			display: block;
			line-height: 22px;
			padding: 0 6px;
			text-align: center;
			position: relative;
		}

		a.wp-color-result.button {
			position: relative;
			font-size: 11px;
			padding: 0 0 0 30px;
			height: auto;
		}

		@media screen and (max-width: 782px) {
			.wp-picker-container a.wp-color-result.button:after {
				padding: 0 10px;
				font-size: inherit;
				line-height: inherit;
			}
		}
	</style>
	<?php
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'wp-admin' );
	wp_enqueue_style( 'dashicons' );

	// Admin CSS
	wp_enqueue_style( 'wp-admin',				"/wp-admin/css/wp-admin.min.css", array( 'open-sans', 'dashicons' ) );
	wp_enqueue_style( 'login',					"/wp-admin/css/login.min.css", array( 'buttons', 'open-sans', 'dashicons' ) );
	wp_enqueue_style( 'install',				"/wp-admin/css/install.min.css", array( 'buttons', 'open-sans' ) );
	wp_enqueue_style( 'wp-color-picker',		"/wp-admin/css/color-picker.min.css" );
	wp_enqueue_style( 'customize-controls',		"/wp-admin/css/customize-controls.min.css", array( 'wp-admin', 'colors', 'ie', 'imgareaselect' ) );
	wp_enqueue_style( 'customize-widgets',		"/wp-admin/css/customize-widgets.min.css", array( 'wp-admin', 'colors' ) );
	wp_enqueue_style( 'customize-nav-menus',	"/wp-admin/css/customize-nav-menus.min.css", array( 'wp-admin', 'colors' ) );
	wp_enqueue_style( 'press-this',				"/wp-admin/css/press-this.min.css", array( 'open-sans', 'buttons' ) );
	?>
</head>
<body class="wp-core-ui">
	<header class="preview">
		<p>Preview</p>
		<a href="#" id="preview"></a>
	</header>
	<section>
		<h3>General</h3>
		<div class="field">
			<label>Button Text</label>
			<input type="text" class="button-text" name="text" placeholder="Text" value="<?php echo filter_input( INPUT_GET, 'text' ) ?>">
		</div>
		<div class="field">
			<label>Button Link</label>
			<input type="text" class="input-attr" name="href" placeholder="URL" value="<?php echo filter_input( INPUT_GET, 'url' ) ?>">
		</div>
		<div class="field">
			<label>Open in a new window</label>
			<input type="checkbox" class="input-attr" name="target"  value="_blank">
		</div>
		<div class="field">
			<label>Icon</label>
			<input type="hidden" class="button-icon" name="dashicon"  value="<?php echo htmlspecialchars( filter_input( INPUT_GET, 'icon' ) ) ?>">
		</div>
		<div class="field">
			<label>Size</label>
			<span class="input-wrap">
				<input class="input-style" name="font-size" min="8" max="70" step="2" type="range" value="25" onchange='jQuery("#font-size-helper").val(this.value)'>
				<input id="font-size-helper" readonly="readonly">
			</span>
		</div>
		<div class="field">
			<label>Align</label>
			<select class="input-style align" name="float">
				<option value="" selected="selected">None</option>
				<option value="left">Left</option>
				<option value="none">Center</option>
				<option value="right">Right</option>
			</select>
		</div>
		<h3>Colors</h3>
		<div class="field">
			<label>Background color</label>
			<input class="input-attr input-bg-color" name="data-bg-color" type="colorpicker"  data-alpha="true" value="#f0f0f1" placeholder="Background color">
		</div>
		<div class="field">
			<label>Second Background color</label>
			<input class="input-attr input-bg-color2" name="data-bg-color2" type="colorpicker"  data-alpha="true" value="" placeholder="Bottom Color for Gradient">
			<p>Use different second background color for a beautiful gradient!</p>
		</div>
		<div class="field">
			<label>Text color</label>
			<input class="input-style" name="color" type="colorpicker"  data-alpha="true" value="#111112" placeholder="Text color">
		</div>
		<div class="field">
			<label>Hover color</label>
			<input class="input-attr" name="data-hover-color" type="colorpicker"  data-alpha="true" placeholder="Hover Color" value="<?php echo filter_input( INPUT_GET, 'hoverClr' ) ?>">
		</div>
		<h3>Border</h3>
		<div class="field">
			<label>Border color</label>
			<input  type="hidden" class="input-style" name="border-style" value="solid">
			<input class="input-style" name="border-color" value="#111112" type="colorpicker"  data-alpha="true" placeholder="Border color">
		</div>
		<div class="field">
			<label>Border width ( pixels )</label>
			<input class="input-style" name="border-width" type="number" min="0" value="1" max="25">
		</div>
		<div class="field">
			<label>Border Radius ( pixels )</label>
			<input class="input-style" name="border-radius" type="number" min="0" value="0" max="99">
		</div>
		<input type="hidden" class="input-attr" name="class" value="pbtn">
	</section>
	<footer>
		<input type="button" class="button-primary" id="submit" value="<?php echo $editing ? 'Update Button' : 'Insert Button'; ?>">
	</footer>

	<?php wp_print_footer_scripts(); ?>
	<script src="<?php echo $assets_url . 'alpha-color.js' ?>"></script>
	<link rel="stylesheet" href="<?php echo $assets_url . 'dashicons-select.css' ?>">
	<script src="<?php echo $assets_url . 'dashicons-select.js?v=1.0.1' ?>"></script>

	<script>
		jQuery( function ( $ ) {
			var get_input_attr, get_input_styles, get_background, preview,
				params = top.tinymce.activeEditor.windowManager.getParams(),
				$icon = $( '.button-icon' ),
				$prevu = $( '#preview' ),
				$text = $( '.button-text' ),
				$align = $( '.input-style.align' ),
				$style_inputs = $( '.input-style' ),
				$attr_inputs = $( '.input-attr' ),
				$submit = $( '#submit' );

			<?php
			if ( $editing ) {
				?>
				params.editing = true;
				$style_inputs.each( function () {
					var $t = $( this ),
						name = $t.attr( 'name' ),
						val = params.button.css( name );
					if ( val ) {
						if ( 'number' == $t.attr( 'type' ) || 'range' == $t.attr( 'type' ) ) { val = val.replace( 'px', '' ); }
						$t.val( val );
					}
				} );
				$attr_inputs.each( function () {
					var $t = $( this ),
						name = $t.attr( 'name' ),
						val = params.button.attr( name );
					if ( val ) {
						if ( 'checkbox' == $t.attr( 'type' ) ) {
							$t.prop( 'checked', true );
						} else {
							$t.val( val );
						}
					}
				} );

				if ( 'center' != params.button.closest( 'p.pbtn' ).css( 'text-align' ) ) {
					if ( 'none' == $align.val() ) {
						$align.val( '' );
					}
				}
				<?php
			}
			?>

			$icon.dashiconSelector();

			preview = function () {
				var text = $text.val() ? $text.val() : 'Text';
				$prevu
					.attr( 'style', get_input_styles() )
					.data( 'hover-color', $( '.input-attr[name="data-hover-color"]' ).val() )
					.html( $icon.val() + ' ' + text );
				$( 'section' ).css( 'padding-top', $( 'header.preview' ).outerHeight() - 7 );
			};

			get_input_attr = function () {
				var return_text = '';

				// Button attributes
				$attr_inputs.each( function () {
					var $t = $( this );
					if ( $t.attr( 'type' ) != 'checkbox' || $t.prop( 'checked' ) ) {
						if ( $t.val() ) {
							return_text += $t.attr( 'name' ) + '="' + $t.val() + '" ';
						}
					}
				} );

				// Button styles
				return_text += 'style="' + get_input_styles();
				return return_text;
			};

			get_input_styles = function () {
				var return_text = '';
				$style_inputs.each( function () {
					var $t = $( this );
					var val = $t.val();

					if ( ! val ) { return; }
					if ( 'number' == $t.attr( 'type' ) || 'range' == $t.attr( 'type' ) ) { val = $t.val() + 'px'; }

					return_text += $t.attr( 'name' ) + ':' + val + ';';
				} );
				return return_text + get_background() + 'display:inline-block;padding:0.5em 0.7em;text-decoration:none;line-height:1;';
			};

			get_background = function () {
				var return_text = '',
					color = $( '.input-bg-color' ).val(),
					color2 = $( '.input-bg-color2' ).val();
				return_text += 'background-color:' + color + ';';
				if ( color2 ) {
					var gradient = 'linear-gradient(' + color + ',' + color2 + ')';
					return_text += 'background:-webkit-' + gradient + ';';
					return_text += 'background:-o-' + gradient + ';';
					return_text += 'background:-moz-' + gradient + ';';
					return_text += 'background:' + gradient + ';';
				}
				return return_text;
			};

			$( 'input[type="colorpicker"]' ).each( function () {
				var $t = $( this );
				$t.libColorPicker( {
					change: preview,
					clear: preview
				} );
			} );

			$submit.click( function () {
				var return_text = '<a ',
					attr = '',
					style = '',
					ed = params.editor;

				return_text += get_input_attr() + '">' + $icon.val() + ' ' + $text.val() + "</a>&nbsp;\n";

				if ( params.editing ) {
					ed.dom.setStyle( params.button.closest( 'p.pbtn' )[0], 'text-align', '' );
					if ( 'none' == $align.val() ) {
						ed.dom.setStyle( params.button.closest( 'p.pbtn' )[0], 'text-align', 'center' );
					}
				} else if ( 'none' == $align.val() ) {
					return_text = '<p class="pbtn" style="clear:both;text-align:center">' + return_text + '</p>';
				} else {
					return_text = '<p class="pbtn" style="clear:both;">' + return_text + '</p>';
				}
				ed.execCommand( 'mceInsertContent', 0, return_text );
				ed.windowManager.close();
			} );

			$style_inputs.change( preview );
			$( '.button-text, .button-icon' ).change( preview );
			$style_inputs.filter('[name="font-size"]').change();
			$prevu.hover(
				function() {
					var $t = $( this );
					if ( ! $t.data( 'hover-color' ) ) {
						$t.css( 'opacity', '0.7' );
						return;
					}
					$t.data( 'background', $t.css( 'background' ) );
					$t.css( 'background', $t.data( 'hover-color' ) );
				},
				function() {
					var $t = $( this );
					if ( ! $t.data( 'background' ) ) {
						$t.css( 'opacity', 1 );
						return;
					}
					$t.css( {
						'background' : $t.data( 'background' ),
					} );
				}
			);
		} );
	</script>
</body>
</html>
<?php die(); ?>
