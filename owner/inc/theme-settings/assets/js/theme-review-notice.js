jQuery(document).ready(function($) {
    "use strict";

    var WpAjaxurl = mtaboutObject.ajax_url;
    var _wpnonce = mtaboutObject._wpnonce;
    var action = mtaboutObject.action;
    
    switch( action ) {
        case 'activate' :
            $( '#mt-theme-message .mt-get-started' ).on( 'click', function() {
                var _this = $( this );
                owner_do_plugin( 'activate_demo_importer_plugin', _this );
            });
            break;
        case 'install' :
            $( '#mt-theme-message .mt-get-started' ).on( 'click', function() {
                var _this = $( this );
                owner_do_plugin( 'install_demo_importer_plugin', _this );
            });
            break;
        case 'redirect' :
            $( '#mt-theme-message .mt-get-started' ).on( 'click', function() {
                var _this = $( this );
                location.href = _this.data( 'redirect' );
            });
            break;
    }
    
    function owner_do_plugin( ajax_action, _this ) {
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
                location.href = _this.data( 'redirect' );
            }
        })
    }
})