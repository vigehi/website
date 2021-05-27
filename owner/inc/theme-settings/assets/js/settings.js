/**
 * Handles event for theme about page.  
 */

jQuery(document).ready(function($) {
    var WpAjaxurl   = mtaboutObject.ajax_url;
    var _wpnonce    = mtaboutObject._wpnonce;
    var action      = mtaboutObject.action;

    /**
     * Popup on click demo import if mysterythemes demo importer plugin is not activated.
     */
    $( '.mtdi-demo-import' ).addClass( 'disabled' );

    switch( action ) {
        case 'activate' : $( '.mt-activate-demo-import-plugin' ).on( 'click', function() {
                var _this = $( this );
                owner_do_plugin( 'activate_demo_importer_plugin', _this );
            });
            break;
        case 'install' : $( '.mt-install-demo-import-plugin' ).on( 'click', function() {
                var _this = $( this );
                owner_do_plugin( 'install_demo_importer_plugin', _this );
            });
            break;
    }
    
    owner_do_plugin = function ( ajax_action, _this ) {
        $.ajax({
            method : "POST",
            url : WpAjaxurl,
            data : ({
                'action' : ajax_action,
                '_wpnonce' : _wpnonce
            }),
            beforeSend: function() {
                var loadingTxt = _this.data( 'process' );
                _this.addClass( 'updating-message' ).text( loadingTxt );
            },
            success: function( response ) {
                if( response.success ) {
                    var loadedTxt = _this.data( 'done' );
                    _this.removeClass( 'updating-message' ).text( loadedTxt );
                    console.log( response.data.message );
                } else {
                    console.log( response.data.message );
                }
                location.reload();
            }
        });
    }

});