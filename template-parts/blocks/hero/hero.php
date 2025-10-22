<?php

/**
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> hero  py-5 <?php if (!(get_field('fluid'))) echo 'container my-10'; ?>" style="
    background-color: <?php echo get_field('background_color'); ?>;
    --hero-min-height: <?php echo get_field('height'); ?>vw;
    --hero-text-color: <?php echo get_field('text_color'); ?>;
">
    <div class="hero__bg hero__bg--image <?php if (get_field('background_parallax')) echo 'hero__bg-image--parallax'; ?>">
        <?php if (get_field('background_image')): ?>
            <img src="<?php echo esc_url(get_field('background_image')); ?>" alt="hero background image"/>
        <?php endif; ?>
    </div>
    <div class="hero__bg hero__bg--video" style="
        --video_height: <?php echo get_field('video_height'); ?>%;
    ">
    <?php 
        $background_video = get_field('background_video');
        if ($background_video): ?>
            <iframe 
                class="hero__bg-video" 
                title="Hero background video" 
                src="https://player.vimeo.com/video/<?php echo esc_attr($background_video); ?>?autoplay=1&muted=1&background=1&fullscreen=1" 
                allow="autoplay; fullscreen" 
                allowfullscreen>
            </iframe>
        <?php endif; ?>
    </div>
    <div class="hero__backdrop" style="
        background-color: <?php echo get_field('background_color'); ?>;
        opacity: .<?php echo get_field('backdrop'); ?>;
    "></div>
    <div class="container px-5 py-4 py-lg-5 text-align-center">
        <div class="row hero__row justify-content-center">
            <div class="col-12">
                <?php 
                $tag = get_field('title_heading_tag');
                $title = get_field('title'); 
                if (!$tag) {
                    $tag = 'h1';
                }
                if ($title) {
                    echo '<' . esc_attr($tag) . ' class="hero__title mt-0 bold">' . esc_html($title) . '</' . esc_attr($tag) . '>';
                }
                ?>
                
                <?php if (get_field('text_content')): ?>
                    <p class="hero__sub-title h5 mt-3"><?php echo get_field('text_content'); ?></p>
                <?php endif; ?>
                <?php if ($button_link = get_field('button_text')) : ?>
                    <a href="<?php echo esc_url($button_link['url']); ?>" class="hero__btn btn mt-4 mt-md-5 px-5 py-4" style="
                        background-color: <?php echo get_field('button_background'); ?>; 
                        color: <?php echo get_field('button_text_color'); ?>;
                        --button-bg-hover: <?php echo get_field('button_background_hover'); ?>;
                        --button-text-hover: <?php echo get_field('button_text_hover'); ?>;
                        ">
                        <?php echo esc_html($button_link['title']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>