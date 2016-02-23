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
				var return_text,
					selected_text = ed.selection.getContent();
				ed.windowManager.open( {
					title: 'Insert Button',
					url : url + '/assets/dialog.php?ajaxurl=' + ajaxurl + '&text=' + selected_text,
					width : 500,
					height : 500
				}, { plugin_url : url, editor : ed } );
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	/* Start the buttons */
	tinymce.PluginManager.add( 'pbtn_script', tinymce.plugins.MyButtons );
})();