<div class="news-post">

    <h6><?php the_title(); ?></h6>
    <?php
    $field = get_field_object('color');
    $value = $field['value'];
    $label = $field['choices'][$value];
    ?>
    <p>Color: <span><?php echo esc_html($label); ?></span></p>
    <?php echo get_the_date(); ?>

    <?php
    $terms = get_the_terms(get_the_ID(), 'news-category');
    foreach ($terms as $term) : ?>
        <p><?php echo $term->name . ' '; ?></p>
    <?php endforeach; ?>

</div>