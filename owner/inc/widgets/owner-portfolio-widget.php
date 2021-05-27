<?php
/**
 * Widget for Portfolios section.
 *
 * @package Mystery Themes
 * @subpackage Owner
 * @since 1.0.0
 */

class Owner_Portfolio extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname'     => 'owner_portfolio',
            'description'   => __( 'Display posts from selected category show in fullwidth', 'owner' )
        );
        parent::__construct( 'owner_portfolio', __( 'Owner : Portfolio', 'owner' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $owner_category_dropdown = owner_category_dropdown();
        
        $fields = array(

            'section_title' => array(
                'owner_widgets_name'         => 'section_title',
                'owner_widgets_title'        => __( 'Section Title', 'owner' ),
                'owner_widgets_field_type'   => 'text'
            ),

            'section_info' => array(
                'owner_widgets_name'         => 'section_info',
                'owner_widgets_title'        => __( 'Section Info', 'owner' ),
                'owner_widgets_row'          => 5,
                'owner_widgets_field_type'   => 'textarea'
            ),

            'section_cat_id' => array(
                'owner_widgets_name'         => 'section_cat_id',
                'owner_widgets_title'        => __( 'Section Category', 'owner' ),
                'owner_widgets_field_type'   => 'select',
                'owner_widgets_default'      => 0,
                'owner_widgets_field_options'=> $owner_category_dropdown
            ),

            'section_post_count' => array(
                'owner_widgets_name'         => 'section_post_count',
                'owner_widgets_title'        => __( 'Section Post Count', 'owner' ),
                'owner_widgets_default'      => 8,
                'owner_widgets_field_type'   => 'number'
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

        $owner_section_title      = empty( $instance['section_title'] ) ? '' : $instance['section_title'];
        $owner_section_info       = empty( $instance['section_info'] ) ? '' : $instance['section_info'];
        $owner_section_cat_id     = empty( $instance['section_cat_id'] ) ? 0 : $instance['section_cat_id'];
        $owner_section_post_count = empty( $instance['section_post_count'] ) ? 3 : $instance['section_post_count'];

        if( empty( $owner_section_cat_id ) ) {
            return ;
        }

        if( !empty( $owner_section_title ) || !empty( $owner_section_info ) ) {
            $sec_title_class = 'has-title';
        } else {
            $sec_title_class = 'no-title';
        }

        $grid_args = array(
            'post_type' => 'post',
            'category__in' => $owner_section_cat_id,
            'posts_per_page' => $owner_section_post_count
        );
        $grid_query = new WP_Query( $grid_args );
        echo $before_widget;
    ?>
            <div class="section-wrapper owner-widget-wrapper clearfix">
                <div class="mt-container">
                    <div class="section-title-wrapper <?php echo esc_attr( $sec_title_class ); ?> clearfix">
                        <?php
                            if( !empty( $owner_section_title ) ) {
                                echo $before_title . esc_html( $owner_section_title ) . $after_title;
                            }

                            if( !empty( $owner_section_info ) ) {
                                echo '<span class="section-info">'. wp_kses_post( $owner_section_info ) .'</span>';
                            }
                        ?>
                    </div><!-- .section-title-wrapper -->
                </div><!-- .mt-container -->
                <div class="items-wrapper">
                    <?php
                        if( $grid_query->have_posts() ) {
                            while( $grid_query->have_posts() ) {
                                $grid_query->the_post();
                    ?>
                                <div class="single-post-wrapper">
                                    <?php if( has_post_thumbnail() ) { ?>
                                        <div class="img-holder">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail( 'owner-portfolio-medium' ); ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <div class="portfolio-title-wrapper">
                                        <a class="portfolio-link" href="<?php the_permalink(); ?>"> <i class="fa fa-plus"> </i></a>
                                        <h3 class="post-title"> <?php the_title(); ?> </h3>
                                    </div>
                                </div><!-- .single-post-wrapper -->
                    <?php
                            }
                        }
                        wp_reset_postdata();
                    ?>
                </div><!-- .grid-items-wrapper -->
            </div><!-- .section-wrapper -->
    <?php
        echo $after_widget;
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