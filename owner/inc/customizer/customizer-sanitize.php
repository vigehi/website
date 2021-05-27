<?php
/**
 * File to sanitize customizer field
 *
 * @package Mystery Themes
 * @subpackage Owner
 * @since 1.0.0
 */

/**
 * Sanitize email
 *
 * @since 1.0.0
 */
function owner_sanitize_email( $input ) {
    return sanitize_email( $input );
}

/**
 * Sanitize checkbox
 *
 * @since 1.0.0
 */
function owner_sanitize_checkbox( $input ) {
    return ( ( isset( $input ) && true == $input ) ? true : false );
}

/**
 * Sanitize number
 *
 * @since 1.0.0
 */
function owner_sanitize_number( $input ) {
    $output = intval( $input );
    return $output;
}

/**
 * Sanitize site layout
 *
 * @since 1.0.0
 */
function owner_sanitize_site_layout( $input ) {
    $valid_keys = array(
        'wide_layout'   => __( 'Wide Layout', 'owner' ),
        'boxed_layout'  => __( 'Boxed Layout', 'owner' )
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sanitize archive page layout
 *
 * @since 1.0.0
 */
function owner_sanitize_archive_layout_option( $input ) {
    $valid_keys = array(
        'classic' => __( 'Classic Layout', 'owner' ),
        'grid' => __( 'Grid Layout', 'owner' )
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sanitize switch button
 *
 * @since 1.0.0
 */
function owner_sanitize_switch_option( $input ) {
    $valid_keys = array(
        'show'  => esc_html__( 'Show', 'owner' ),
        'hide'  => esc_html__( 'Hide', 'owner' )
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}