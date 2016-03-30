<?php echo head(array('bodyid'=>'home')); ?>
<div id="primary">
    <?php if ($homepageText = get_theme_option('Homepage Text')): ?>
    <p><?php echo $homepageText; ?></p>
    <?php endif; ?>
    <?php if ((get_theme_option('Display Featured Exhibit')) && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
    <!-- Featured Exhibit -->
    <?php echo dh_display_random_featured_exhibits(20); ?>
    <?php endif; ?>
    <?php if (get_theme_option('Display Featured Item') == 1): ?>
    <!-- Featured Item -->
    <h2><?php echo __('Featured Items'); ?></h2>
    <div id="featured-item" class="grid js-masonry" data-masonry-options='{ "itemSelector": ".record", "columWidth": 296.666666667, "transitionDuration": "0.2s" }'>
        <?php echo random_featured_items(20); ?>
    </div><!--end featured-item-->	
    <?php endif; ?>
    <?php if (get_theme_option('Display Featured Collection')): ?>
    <!-- Featured Collection -->
    <h2><?php echo __('Featured Collections'); ?></h2>
    <div id="featured-collection" class="grid js-masonry" data-masonry-options='{ "itemSelector": ".record", "columWidth": 296.666666667, "transitionDuration": "0.2s" }'>
        <?php echo dh_random_featured_collections(5); ?>
    </div><!-- end featured collection -->
    <?php endif; ?>
</div><!-- end primary -->
<?php echo foot(); ?>
