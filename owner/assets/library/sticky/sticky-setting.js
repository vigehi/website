/*
 * Settings of the sticky menu
 */

jQuery(document).ready(function(){
	var wWidth = jQuery( window ).width();
	if( wWidth <= '767' ) {
		return false;
	}
   	var wpAdminBar = jQuery('#wpadminbar');
   	if (wpAdminBar.length) {
    	jQuery("#masthead").sticky({topSpacing:wpAdminBar.height()});
   	} else {
     	jQuery("#masthead").sticky({topSpacing:0});
   	}
});