/**
 * Buttons tmce plugin file
 * @package pootle buttons
 * @since 0.7
 * @developer http://wpdevelopment.me <shramee@wpdevelopment.me>
 */

(function() {
	/* Register the buttons */
	tinymce.create('tinymce.plugins.MyButtons', {
		init : function(ed, url) {
			/**
			 * Adds HTML tag to selected content
			 */
			ed.addButton( 'pbtn_add_btn', {
				title : 'Add span',
				image : '../wp-includes/images/spinner.gif',
				cmd: 'pbtn_add_btn_cmd'
			});
			ed.addCommand( 'pbtn_add_btn_cmd', function() {
				var selected_text = ed.selection.getContent();
				var return_text = '';
				return_text = '<button>' + selected_text + '</button>';
				ed.execCommand('mceInsertContent', 0, return_text);
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	/* Start the buttons */
	tinymce.PluginManager.add( 'my_button_script', tinymce.plugins.MyButtons );
})();