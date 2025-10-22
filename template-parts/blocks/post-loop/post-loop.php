<?php
/**
 * Block template for Post Loop (ACF Block)
 */

// Get custom ACF fields
$number = get_field('number_of_posts') ?: 6;
$section_title = get_field('section_title');
$section_subtitle = get_field('section_sub-title');

// Use URL parameter for pagination instead of pretty permalinks
$paged = isset($_GET['pg']) ? absint($_GET['pg']) : 1;

$args = [
    'post_type'      => 'post',
    'posts_per_page' => $number,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'paged'          => $paged,
];

$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <section class="post-loop-block py-5">
        <div class="container py-lg-5">
            <?php if ($section_title || $section_subtitle): ?>
            <div class="row mb-4">
                <div class="col-12 col-lg-6">
                    <?php if ($section_title): ?>
                        <h2><?php echo esc_html($section_title); ?></h2>
                    <?php endif; ?>
                    <?php if ($section_subtitle): ?>
                        <p class="h6 mt-2"><?php echo esc_html($section_subtitle); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="row align-items-stretch">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="col-sm-6 col-lg-4 d-flex py-3">
                    <article class="post-card p-4 flex-fill">
                        
                        <a href="<?php the_permalink(); ?>" class="post-card__thumb-link mb-3 d-block" aria-label="<?php echo esc_attr(sprintf(__('Read: %s', 'your-textdomain'), get_the_title())); ?>">
                            <div class="post-card__thumb">
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid', 'alt' => '']); ?>
                            </div>
                        </a>
                        
                        <h3 class="h5 mb-3">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        
                        <p class="mb-3"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        
                        <a href="<?php the_permalink(); ?>" class="btn btn-link mt-auto p-0" aria-label="<?php echo esc_attr(sprintf(__('Read more about: %s', 'your-textdomain'), get_the_title())); ?>">
                            <?php _e('Read More', 'your-textdomain'); ?> <span aria-hidden="true">→</span>
                        </a>
                    </article>
                </div>
                <?php endwhile; ?>
            </div>

            <?php if ($query->max_num_pages > 1): ?>
            <div class="row mt-4">
                <div class="col-12">
                    <nav aria-label="<?php esc_attr_e('Posts navigation', 'your-textdomain'); ?>" class="pagination-wrapper">
                        <?php
                        // Get the current page URL (not the post permalink)
                        global $wp;
                        $current_url = home_url(add_query_arg(array(), $wp->request));
                        $current_url = remove_query_arg('pg', $current_url);
                        
                        echo paginate_links([
                            'base'      => add_query_arg('pg', '%#%', $current_url),
                            'format'    => '',
                            'total'     => $query->max_num_pages,
                            'current'   => max(1, $paged),
                            'prev_text' => __('&laquo; Previous', 'your-textdomain'),
                            'next_text' => __('Next &raquo;', 'your-textdomain'),
                            'type'      => 'list',
                        ]);
                        ?>
                    </nav>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
<?php
    wp_reset_postdata();
else : ?>
    <section class="post-loop-block py-5">
        <div class="container py-lg-5">
            <div class="row">
                <div class="col-12">
                    <p><?php esc_html_e('No posts found.', 'your-textdomain'); ?></p>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>