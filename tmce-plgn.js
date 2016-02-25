/**
 * Buttons tmce plugin file
 * @package pootle buttons
 * @since 0.7
 * @developer http://wpdevelopment.me <shramee@wpdevelopment.me>
 */
pbtn = {};

(function($) {
	/* Register the buttons */
	tinymce.create('tinymce.plugins.MyButtons', {
		init : function(ed, url) {
			var ass_url = pbtn.ass_url = url + '/assets/';
			pbtn.init();
			/**
			 * Adds HTML tag to selected content
			 */
			ed.addButton( 'pbtn_add_btn', {
				title : 'Insert Button',
				image : ass_url + 'icon.png',
				cmd: 'pbtn_add_btn_cmd'
			});
			ed.addCommand( 'pbtn_add_btn_cmd', function() {
				var selected_text = ed.selection.getContent();

				wpLink.textarea = $( '#' + window.wpActiveEditor ).get( 0 );

				wpLink.refresh();
				pbtn.linkDialog.addClass( 'pbtn-active' ).show();
				pbtn.linkTextField.val( selected_text );
				pbtn.editor = ed;
				pbtn.oldLinkTitle = pbtn.linkDialogTitle.html();
				pbtn.linkDialogTitle.html( 'Choose link for your button' );
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	/* Start the buttons */
	tinymce.PluginManager.add( 'pbtn_script', tinymce.plugins.MyButtons );

	pbtn.init = function () {
		if ( ! $('#pbtn-css' ).length ) {
			pbtn.linkDialog = $( '#wp-link-wrap, #wp-link-backdrop' );
			pbtn.linkDialogTitle = $( '#link-modal-title' );
			pbtn.linkTextField = $( '#wp-link-text' );
			pbtn.linkDialog.appendTo( 'body' );


			$( 'body' ).append( '<link rel="stylesheet" id="pbtn-css" href="' + pbtn.ass_url + 'admin.css">' );
			$( '#wp-link-update' ).prepend(
					'<input type="submit" value="Use this link for my button" class="button button-primary pbtn-item" id="pbtn-submit" name="pbtn-submit">'
			);
			$( '#pbtn-submit' ).click( function( e ) {
				e.preventDefault();
				var target = $( '#wp-link-target' ).prop( 'checked' ) ? '&target=_blank' : '';
				pbtn.editor.windowManager.open( {
					title: 'Insert Button',
					url : pbtn.ass_url + 'dialog.php?' +
					      'url=' + $( '#wp-link-url' ).val() +
					      target +
					      '&text=' + pbtn.linkTextField.val(),
					width : 500,
					height : 500
				}, { plugin_url : pbtn.ass_url, editor : pbtn.editor } );
				wpLink.close();
			} );
		}
	};
	$( document ).on( 'wplink-close', function() {
		pbtn.linkDialog.removeClass( 'pbtn-active' );
		pbtn.linkDialogTitle.html( pbtn.oldLinkTitle );
	} );

})(jQuery);