/**
 * Buttons tmce plugin file
 * @package pootle buttons
 * @since 0.7
 * @developer http://wpdevelopment.me <shramee@wpdevelopment.me>
 */

(function($) {
	/* Register the buttons */
	tinymce.create('tinymce.plugins.MyButtons', {
		init : function(ed, url) {
			var ass_url = pbtn.ass_url = url + '/assets/';
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
				ed.windowManager.open( {
					title: 'Insert Button',
					url : pbtn.dialogUrl + '&assets_url=' + ass_url + '&text=' + selected_text,
					width : 500,
					height : 500
				}, { plugin_url : pbtn.ass_url, editor : ed } );
			});
			ed.on( "dblClick", function ( e ) {
				var btn = $( e.target );
				console.log( btn );
				console.log( btn.hasClass( "pbtn" ) );
				if ( btn.hasClass( "pbtn" ) ) {
					ed.selection.select( e.toElement );
					var icon = encodeURIComponent( btn.find('i').prop( 'outerHTML' ) );
					ed.windowManager.open( {
						title: 'Insert Button',
						url : pbtn.dialogUrl + '&edit_button=1&assets_url=' + ass_url + '&text=' + btn.text() +
						      '&icon=' + icon + '&url=' + btn.attr( 'href' ) + '&hoverClr=' + btn.data( 'hover-color' ),
						width : 500,
						height : 500
					}, { plugin_url : pbtn.ass_url, editor : ed, button : btn } );
				}
			} );
		},
		createControl : function(n, cm) {
			return null;
		}
	});
	/* Start the buttons */
	tinymce.PluginManager.add( 'pbtn_script', tinymce.plugins.MyButtons );

})(jQuery);