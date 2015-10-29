<?php queue_css_file('jquery.fancybox'); ?>
<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits show'));
?>

<h1><span class="exhibit-page"><?php echo metadata('exhibit_page', 'title'); ?></h1>

<div id="exhibit-blocks">
<?php exhibit_builder_render_exhibit_page(); ?>
</div>

<!--<div id="exhibit-page-navigation">
    <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
    <div id="exhibit-nav-prev">
    <?php echo $prevLink; ?>
    </div>
    <?php endif; ?>
    <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
    <div id="exhibit-nav-next">
    <?php echo $nextLink; ?>
    </div>
    <?php endif; ?>
    <div id="exhibit-nav-up">
    <?php echo exhibit_builder_page_trail(); ?>
    </div>
</div>-->

<nav id="exhibit-pages">
    <h4><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h4>
    <?php echo exhibit_builder_page_tree($exhibit, $exhibit_page); ?>
</nav>
<script src="/dh-omeka-site/themes/dh-theme/javascripts/vendor/fancybox/jquery.fancybox.js"></script>
<script type="text/javascript">
var thumbnails = jQuery.map(jQuery('img'), function(element) { return jQuery(element).attr('src'); });
var fullsize_images = jQuery.map(thumbnails, function(item) { return item.replace("square_thumbnails","fullsize"); });
jQuery(".exhibit-item-link").click(function(e) {
    e.preventDefault();
    var startIndex = thumbnails.indexOf(e.currentTarget.firstElementChild.getAttribute('src'));
    var imageTitle = e.currentTarget.firstElementChild.getAttribute('title');
    console.log(startIndex);
    jQuery.fancybox(fullsize_images,{
        index:startIndex
    });
})
</script>
<?php echo foot(); ?>
