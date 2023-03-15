<section class="section-filter-date">
    <div class="container">

        <div class="acf-filed-wrap">
            <span>Color:</span>
            <?php
            $field = get_field_object('color');
            $value = $field['value'];
            $choices = $field['choices']; ?>

            <select id="acf-cat" name="acf-cat">
                <option value="">All</option>
                <?php foreach ($choices as $choice): ?>
                    <option value="<?php echo $choice; ?>"><?php echo $choice; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <hr>
        <!--Data atribute-->
        <div class="js-filter wrap-filters">
            <?php $terms = get_terms(['taxonomy' => 'news-category']);
            if ($terms):?>
                <ul id="cat" name="cat">
                    <li class="cat-list_item active" data-slug="">All</li>
                    <?php foreach ($terms as $term): ?>
                        <li class="cat-list_item" data-slug="<?php echo $term->slug; ?>"><?php echo $term->name; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <hr>

        <!--    date picker   -->
        <p class="js-filter-date">Date start: <input id="start-date" name="start_date" type="text"></p>
        <p class="js-filter-date">Date end: <input id="end-date" name="end_date" type="text"></p>

        <button id="send">send</button>

        <hr>
        <?php
        $args = [
            'post_type' => 'news',
            'posts_per_page' => -1,
        ];

        $movies = new WP_Query($args); ?>

        <?php if ($movies->have_posts()): ?>
            <div class="js-date wrap-posts">
                <?php while ($movies->have_posts()): $movies->the_post();
                    get_template_part('single-templates/single_news');;
                endwhile;
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>