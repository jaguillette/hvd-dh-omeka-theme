<?php echo head(array('bodyid'=>'home')); ?>
<div id="primary">
    <?php if ($homepageText = get_theme_option('Homepage Text')): ?>
    <p><?php echo $homepageText; ?></p>
    <?php endif; ?>
    <?php if ((get_theme_option('Display Featured Exhibit')) && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
    <!-- Featured Exhibit -->
    <?php echo dh_display_random_featured_exhibits(20); ?>
    <?php endif; ?>
</div><!-- end primary -->
<?php echo foot(); ?>
