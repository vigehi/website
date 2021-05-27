/**
 * Image uploader functions
 */
var selector;
function upload_media_image(selector){
// ADD IMAGE LINK
    jQuery('body').on( 'click', selector , function( event ){
    event.preventDefault();

    var imgContainer = jQuery(this).closest('.attachment-media-view').find( '.thumbnail-image'),
    placeholder = jQuery(this).closest('.attachment-media-view').find( '.placeholder'),
    imgIdInput = jQuery(this).siblings('.upload-id');

    // Create a new media frame
    frame = wp.media({
        title: 'Select or Upload Image',
        button: {
        text: 'Use Image'
        },
        multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected in the media frame...
    frame.on( 'select', function() {

    // Get media attachment details from the frame state
    var attachment = frame.state().get('selection').first().toJSON();

    // Send the attachment URL to our custom image input field.
    imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
    placeholder.addClass('hidden');
    imgIdInput.val( attachment.url ).trigger('change');
    });

    // Finally, open the modal on click
    frame.open();
    
    });
}

function delete_media_image(selector){
    // DELETE IMAGE LINK
    jQuery('body').on( 'click', selector, function( event ){

    event.preventDefault();
    var imgContainer = jQuery(this).closest('.attachment-media-view').find( '.thumbnail-image'),
    placeholder = jQuery(this).closest('.attachment-media-view').find( '.placeholder'),
    imgIdInput = jQuery(this).siblings('.upload-id');

    // Clear out the preview image
    imgContainer.find('img').remove();
    placeholder.removeClass('hidden');

    // Delete the image id from the hidden input
    imgIdInput.val( '' ).trigger('change');

    });
}

jQuery(document).ready(function($){
	"use strict";
    
    /**
     * Radio Image control in customizer
     */
    // Use buttonset() for radio images.
    $( '.mt-meta-options-wrap .buttonset' ).buttonset();


    /**
     * Meta tabs and its content
     */
    var curTab = $('.mt-meta-menu-wrapper li.active').data('tab');
    $('.mt-metabox-content-wrapper').find('#'+curTab).show();

    /*$('.mt-meta-menu-wrapper li').click(function() {
        var tabIdRaw = $(this).attr('id');
        var tabId = tabIdRaw.split('-');
        $('.mt-single-meta').hide();
        $('#mt-'+tabId[1]+'-content').fadeIn();
    });*/
    $('ul.mt-meta-menu-wrapper li').click(function (){
        var id = $(this).data('tab');
        
        $('ul.mt-meta-menu-wrapper li').removeClass('active');
        $(this).addClass('active')
        
        $('.mt-metabox-content-wrapper .mt-single-meta').hide();
        $('#'+id).fadeIn();
        $('#post-meta-selected').val(id);
    });

    /**
     * Image uploader
     */
    upload_media_image('.mt-upload-button');
    delete_media_image('.mt-delete-button');
	
});