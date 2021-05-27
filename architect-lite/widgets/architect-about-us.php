<?php
/**
 * Widget to show the content of About Us
 *
 * @package Mystery Themes
 * @subpackage Architect Lite
 * @since 1.0.0
 */
add_action( 'widgets_init', 'architect_lite_register_about_us_widget' );

function architect_lite_register_about_us_widget() {
    register_widget( 'Architect_lite_About_Us' );
}

class Architect_lite_About_Us extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'architect_lite_about_us',
            'description' => __( 'Display content for about us.', 'architect-lite' )
        );
        parent::__construct( 'architect_lite_about_us', __( 'Owner : About Us', 'architect-lite' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $owner_pages = owner_pages_dropdown();
        $fields = array(

            'section_page' => array(
                'owner_widgets_name'         => 'section_page',
                'owner_widgets_title'        => __( 'Section Page', 'architect-lite' ),
                'owner_widgets_field_type'   => 'select',
                'owner_widgets_field_options' => $owner_pages
            ),
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $section_page = empty( $instance['section_page'] ) ? '' : $instance['section_page'];
        if(!empty($section_page)):
            $section_page_detail = get_post($section_page);
            echo $before_widget;
            ?>
            <div class="section-wrapper owner-widget-wrapper clearfix">
                <div class="mt-container">

                    <div class="section-content-wrapper">
                        <?php echo $before_title . esc_html( $section_page_detail->post_title ) . $after_title; ?>
                        <div class="section-content"><?php echo apply_filters( 'the_content', $section_page_detail->post_content );; ?></div>                    
                    </div><!-- .section-content-wrapper -->

                    <div class="section-image-holder">
                        <?php if ( has_post_thumbnail( $section_page ) ) { ?>
                        <figure><?php echo get_the_post_thumbnail( $section_page_detail->ID, 'full' );?></figure>
                        <?php } ?>
                    </div><!-- .section-content -->

                </div><!-- .mt-container -->
            </div><!-- .section-wrapper -->
            <?php
            echo $after_widget;
        endif;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    owner_widgets_updated_field_value()      defined in owner-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$owner_widgets_name] = owner_widgets_updated_field_value( $widget_field, $new_instance[$owner_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    owner_widgets_show_widget_field()        defined in owner-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $owner_widgets_field_value = !empty( $instance[$owner_widgets_name] ) ? wp_kses_post( $instance[$owner_widgets_name] ) : '';
            owner_widgets_show_widget_field( $this, $widget_field, $owner_widgets_field_value );
        }
    }

}