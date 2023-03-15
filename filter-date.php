<?php

function filter_date_projects(){

    $args = [
        'post_type' => 'news',
        'posts_per_page' => -1,
        'inclusive' => true,
    ];

    $start = $_POST['start'];
    $end = $_POST['end'];
    $type = $_POST['cat'];
    $type_acf = $_POST['acf'];

    if (!empty($type_acf)) {
        $args_acf['meta_query'][] = [
            'key' => 'color',
            'value' => $type_acf,
            'compare' => '=',
        ];
        $args = array_merge($args, $args_acf);
    }

    if (!empty($type)) {
        $args_type['tax_query'][] = [
            'taxonomy' => 'news-category',
            'field' => 'slug',
            'terms' => $type,
        ];
        $args = array_merge($args, $args_type);
    }

    if (!empty($start) && !empty($end)) {
        $time_stamp_start = strtotime($start);
        $time_stamp_end = strtotime($end);

        if ($time_stamp_start === false && $time_stamp_end === false) {
        } else {
            $args_date['date_query'][] = [
                'after' => date('Y-m-d', $time_stamp_start),
                'before' => date('Y-m-d', $time_stamp_end),
            ];
            $args = array_merge($args, $args_date);
        }
    }

//    print_r($args);

    $movies = new WP_Query($args);
    if ($movies->have_posts()):
        while ($movies->have_posts()): $movies->the_post();
            get_template_part('single-templates/single_news');;
        endwhile;
        wp_reset_postdata();
    else:
        echo "Not Found";
    endif;
    wp_die();

}

add_action('wp_ajax_filter_date_projects', 'filter_date_projects');
add_action('wp_ajax_nopriv_filter_date_projects', 'filter_date_projects');