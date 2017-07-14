/**
 * Created by xuantruong on 3/23/16.
 */
'use strict';
( function() {
    var rs_open_editor = false, select_content = '', text_color = '', bg_color = '', border_color = '';

    if( typeof( tinymce ) !== 'undefined' ) {
        tinymce.PluginManager.add( 'box_shortcode', function( editor, url ) {
            editor.addButton( 'box_shortcode', {
                text: 'Box shortcode',
                title: 'Box shortcode',
                icon: false,
                onclick: function() {
                    select_content = tinyMCE.activeEditor.selection.getContent();
                    editor.windowManager.open( {
                            id       : 'box-shortcode-tiny-mce-dialog',
                            title	 : 'Box Shortcode',
                            width    : 400,
                            height   : 250,
                            resizable: false,
                            wpDialog : true
                        },
                        {
                            plugin_url : url // Plugin absolute URL
                        } );

                }
            });
            rs_open_editor = editor;
        });
    }


    jQuery( 'body' ).on('click', '#box-shortcode-apply', function( event)  {
        event.preventDefault();
        rs_add_shortcode();
        return false;
    });


    function rs_add_shortcode() {
            text_color = jQuery( '#text-color' ).val();
            bg_color = jQuery( '#background-color').val();
            border_color = jQuery( '#border-color').val();
            var info_box_filter = '';
            jQuery( '#check-color').prop( 'checked' ) && ( info_box_filter += 'tcolor="' + text_color + '" ');
            jQuery( '#check-bgcolor').prop( 'checked' ) && ( info_box_filter += 'bgcolor="' + text_color + '" ');
            jQuery( '#check-bordercolor').prop( 'checked' ) && ( info_box_filter += 'bordercolor="' + border_color + '" ');
            var content = '[info_box ' + info_box_filter + ' ] '+ select_content + '[/info_box]';
            tinyMCE.activeEditor.selection.setContent( content );
            if( rs_open_editor !== false ) {
                rs_open_editor.windowManager.close();
                tinyMCE.activeEditor.windowManager.close();
            }

    }
} )();