<!DOCTYPE html>
<html>
<head>
	<style>
		body {
			font-family: verdana, arial, sans-serif;
			color: #454545;
			padding: 0 0 3.4em;
		}
		p {
			font-size: 0.8em;
			margin: 0.25em;
		}
		h3 {
			font-weight: normal;
			color: #333;
		}
		.field {
			margin: 1em;
		}
		.field label {
			display: inline-block;
			width: 205px;
		}
		input, select, textarea {
			-webkit-box-shadow:inset 0 1px 2px rgba(0,0,0,.07);
			box-shadow:inset 0 1px 2px rgba(0,0,0,.07);
			background-color:#fff;color:#32373c;outline:0;border:1px solid #ddd;
			-webkit-transition:50ms border-color ease-in-out;transition:50ms border-color ease-in-out;
			margin: 1px;padding: 5px 7px; width: 200px; box-sizing: border-box;
		}
		input:not(#submit) { font-family: "Courier New", Courier, Monaco, monospace; }
		input[type="checkbox"] {
			 margin: 0;
			 width: 16px;
			 height: 16px;
		}
		.colorpicker.dropdown-menu {
			max-width: 140px;
			background: #fff;
			-webkit-box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.16);
			-moz-box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.16);
			box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.16);
			position: absolute;
		}
		footer {
			background: #fcfcfc;
			border-top: 1px solid #dfdfdf;
			padding: 0;
			position: fixed;
			bottom: 0;
			left: 0;
			right: 0;
			text-align: center;
		}
		#submit {
			margin: 7px;
		}
	</style>
</head>
<body>
	<section>
		<input  type="hidden" class="button-text" name="text" placeholder="Text" value="<?php echo filter_input( INPUT_GET, 'text' ) ?>">
		<input  type="hidden" class="input-attr" name="href" placeholder="URL" value="<?php echo filter_input( INPUT_GET, 'url' ) ?>">
		<input  type="hidden" class="input-attr" name="target"  value="<?php echo filter_input( INPUT_GET, 'target' ) ?>">
		<h3>Colors</h3>
		<div class="field">
			<label>Background color</label>
			<input class="input-bg-color" name="background-color" type="colorpicker" data-default="#f0f0f1" placeholder="Background color">
		</div>
		<div class="field">
			<label>Second Background color</label>
			<input class="input-bg-color2" name="background-color" type="colorpicker" data-default="" placeholder="Bottom Color for Gradient">
			<p>Use different second background color for a beautiful gradient!</p>
		</div>
		<div class="field">
			<label>Text color</label>
			<input class="input-style" name="color" type="colorpicker" data-default="#111112" placeholder="Text color">
		</div>
		<h3>Border</h3>
		<div class="field">
			<label>Border color</label>
			<input  type="hidden" class="input-style" name="border-style" value="solid">
			<input class="input-style" name="border-color" data-default="#111112" type="colorpicker" placeholder="Border color">
		</div>
		<div class="field">
			<label>Border width ( pixels )</label>
			<input class="input-style" name="border-width" type="number" min="0" max="25" placeholder="Border width">
		</div>
		<div class="field">
			<label>Border Radius ( pixels )</label>
			<input class="input-style" name="border-radius" type="number" min="0" max="100" placeholder="Border Radius">
		</div>
		<div class="field">
			<label>Size</label>
			<select class="input-style" name="font-size">
				<option value="8px">Small</option>
				<option value="12px" selected="selected">Medium</option>
				<option value="16px">Large</option>
				<option value="20px">Extra Large</option>
				<option value="25px">Huge</option>
			</select>
		</div>
	</section>
	<footer>
		<input style="opacity: 0;" type="button" id="submit" value="Insert Button">
	</footer>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.0/js/bootstrap-colorpicker.min.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.0/css/bootstrap-colorpicker.min.css">
	<script>
		jQuery( function ( $ ) {
			var get_input_styles, get_background,
				$style_inputs = $( '.input-style' ),
				$submit = $( '#submit' );

			get_input_styles = function () {
				var return_text = '';
				$style_inputs.each( function () {
					var $t = $( this );
					var val = $t.val();

					if ( ! val ) { return; }
					if ( 'number' == $t.attr( 'type' ) ) { val = $t.val() + 'px;'; }

					return_text += $t.attr( 'name' ) + ':' + val + ';';
				} );
				return return_text + get_background() + 'display:inline-block;padding: 0.5em 1em';
			};

			get_background = function () {
				var return_text = '',
					color = $( '.input-bg-color' ).val(),
					color2 = $( '.input-bg-color2' ).val();
				return_text += 'background:' + color + ';';

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
				$t.colorpicker();
				if ( $t.data( 'default' ) ) {
					$t.colorpicker( 'setValue', $( this ).data( 'default' ) )
				}
				$t.colorpicker().on( 'changeColor.colorpicker', function () {
					$submit.attr( 'style', get_input_styles() );
				} );
			} );

			$submit.click( function () {
				var return_text = '<a ',
					attr = '',
					style = '',
					t = top.tinymce.activeEditor.windowManager.getParams(),
					ed = t.editor;

				// Button attributes
				$( '.input-attr' ).each( function () {
					var $t = $( this );
					return_text += $t.attr( 'name' ) + '="' + $t.val() + '" ';
				} );

				// Button styles
				return_text += 'style="' + get_input_styles() + '">' + $( '.button-text' ).val() + "</a>&nbsp;\n";

				ed.execCommand( 'mceInsertContent', 0, return_text );
				ed.windowManager.close();
			} );

			$style_inputs.change( function () {
				$submit.attr( 'style', get_input_styles() );
			} );
			$style_inputs.last().change();
		} );
	</script>
</body>
</html>