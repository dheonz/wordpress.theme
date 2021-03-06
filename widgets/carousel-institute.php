<?php

/**
 * Show the carousel for the posts returned by the global $wp_query object.
 *
 * If there is currently no query, set up a default one.
 */

namespace EPFL\STI\Theme\Widgets;

if (! class_exists('WP_Widget')) {
    die( 'Access denied.' );
}

require_once(dirname(__DIR__) . "/inc/i18n.php");
use function \EPFL\STI\Theme\___;

require_once(__DIR__ . "/category-chooser.inc");

class CarouselInstitute extends \WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'EPFL_STI_Theme_Widget_Carousel_Institute', // unique id
            'EPFL STI Institute News Carousel',         // widget title
            // additional parameters
            array(
                'description' => ___( 'Rotates a selection of news with a big picture' )
            )
        );
    }

    function render_carousel_items ()
    {
        $has_carousel_custom_template = locate_template("loop-templates/carousel-institute");
        while($this->carousel_query->have_posts()) {
            $this->carousel_query->the_post();
            if ($has_carousel_custom_template) {
                get_template("loop-templates/carousel-institute");
            } else {
                $link = get_the_permalink();
                global $post;
                $subtitle = function_exists("get_the_subtitle") ? get_the_subtitle($post, "", "", false) : null;
            ?>
                <div class="carousel-item">
                    <div>
                    <?php the_post_thumbnail("full"); ?>
                        <div class="legend carousel-institute-headline">
                            <a href="<?php echo $link; ?>"><?php the_title(); ?></a>
                            <?php if ($subtitle) : ?>
                                <a href="<?php echo $link; ?>"><?php echo $subtitle; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
            }
        }
        wp_reset_postdata();
    }

    public function widget ($args, $config)
    {
        $this->carousel_query = new \WP_Query(array(
            'post_type' => 'any',
            'cat'       => intval($config['category'])));
        if (! $this->carousel_query->have_posts()) {
            return;
        }
        echo $args['before_widget'];
        ?>
        <div id="container-carousel">
            <div id="carousel" class="carousel slide carousel-institute" data-ride="carousel">
                <?php $this->render_carousel_items(); ?>
            </div>
            <a class="sti-carousel-button prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="sti-carousel-button next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form ($config)
    {
        render_category_chooser($this->get_field_id('category'),
                                $this->get_field_name('category'),
                                $config["category"]);
    }

    public function update( $new_config, $old_config ) {
        $config = $old_config;
        $config["category"] = $new_config["category"];
        return $config;
    }
}

register_widget(CarouselInstitute::class);
