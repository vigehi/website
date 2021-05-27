<?php
/**
 * Widget for Latest News Section
 *
 * @package Mystery Themes
 * @subpackage Owner
 * @since 1.0.0
 */

class Owner_Latest_Blog extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname'     => 'owner_latest_blog',
            'description'   => __( 'Display latest posts except from selected categories.', 'owner' )
        );
        parent::__construct( 'owner_latest_blog', __( 'Owner: Latest Blog', 'owner' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $owner_categories_lists = owner_categories_lists();
        
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

            'section_cat_ids' => array(
                'owner_widgets_name'          => 'section_cat_ids',
                'owner_widgets_title'         => __( 'Section Categories', 'owner' ),
                'owner_widgets_field_type'    => 'multicheckboxes',
                'owner_widgets_field_options' => $owner_categories_lists
            ),

            'section_post_count' => array(
                'owner_widgets_name'         => 'section_post_count',
                'owner_widgets_title'        => __( 'Section Post Count', 'owner' ),
                'owner_widgets_default'      => 3,
                'owner_widgets_field_type'   => 'number'
            ),

            'section_btn_text' => array(
                'owner_widgets_name'         => 'section_btn_text',
                'owner_widgets_title'        => __( 'Section button text', 'owner' ),
                'owner_widgets_field_type'   => 'text'
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

        $owner_section_title        = empty( $instance['section_title'] ) ? '' : $instance['section_title'];
        $owner_section_info         = empty( $instance['section_info'] ) ? '' : $instance['section_info'];
        $owner_section_cat_ids      = empty( $instance['section_cat_ids'] ) ? '' : $instance['section_cat_ids'];
        $owner_section_post_count   = empty( $instance['section_post_count'] ) ? 3 : $instance['section_post_count'];
        $owner_section_btn_text     = empty( $instance['section_btn_text'] ) ? __( 'Read More', 'owner' ) : $instance['section_btn_text'];


        if( !empty( $owner_section_title ) || !empty( $owner_section_info ) ) {
            $sec_title_class = 'has-title';
        } else {
            $sec_title_class = 'no-title';
        }

        echo $before_widget;
    ?>
        <div class="section-wrapper owner-widget-wrapper">
            <div class="mt-container">
                <div class="section-title-wrapper <?php echo esc_attr( $sec_title_class ); ?>">
                    <?php
                        if( !empty( $owner_section_title ) ) {
                            echo $before_title . esc_html( $owner_section_title ) . $after_title;
                        }

                        if( !empty( $owner_section_info ) ) {
                            echo '<span class="section-info">'. wp_kses_post( $owner_section_info ) .'</span>';
                        }
                    ?>
                </div><!-- .section-title-wrapper -->
                <?php
                    if( !empty( $owner_section_cat_ids ) ) {
                        $checked_cats = array();
                        foreach( $owner_section_cat_ids as $cat_key => $cat_value ){
                            $checked_cats[] = $cat_key;
                        }
                        $get_checked_cat_ids = implode( ",", $checked_cats );

                        $latest_blog_args = array(
                            'post_type' => 'post',
                            'cat' => $get_checked_cat_ids,
                            'posts_per_page' => $owner_section_post_count
                        );
                        $latest_blog_query = new WP_Query( $latest_blog_args );
                ?>
                    <div class="latest-posts-wrapper mt-column-wrapper">
                    <?php
                        if( $latest_blog_query->have_posts() ) {
                            while( $latest_blog_query->have_posts() ) {
                                $latest_blog_query->the_post();
                    ?>
                            <div class="single-post-wrapper mt-column-3">
                                <div class="post-thumb">
                                <?php if( has_post_thumbnail() ) { ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail( 'owner-blog-medium' ); ?>
                                    </a>
                                <?php } ?>
                                </div>

                                <div class="blog-content-wrapper">
                                    <h3 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="post-meta">
                                        <?php owner_posted_on(); ?>
                                     </div>
                                    <div class="post-excerpt">
                                        <?php 
                                            $post_content = get_the_content();
                                            echo owner_get_excerpt( $post_content, 150 ); 
                                        ?>
                                    </div>
                                    <a class="news-more" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php echo esc_html( $owner_section_btn_text ); ?></a>
                                </div>
                            </div><!-- .single-post-wrapper -->
                    <?php
                            }
                        }
                        wp_reset_postdata();
                    ?>
                        </div><!-- .latest-posts-wrapper -->
                <?php
                    }
                ?>
            </div><!-- .owner-container -->
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
            $owner_widgets_field_value = !empty( $instance[$owner_widgets_name] ) ?  $instance[$owner_widgets_name] : '';
            owner_widgets_show_widget_field( $this, $widget_field, $owner_widgets_field_value );
        }
    }
}