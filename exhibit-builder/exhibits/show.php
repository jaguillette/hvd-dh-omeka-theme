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
<script src="<?php echo(substr(PUBLIC_THEME_DIR,13)); ?>/dh-theme/javascripts/vendor/jquery.fancybox.js"></script>
<script type="text/javascript">
var thumbnails = jQuery.map(jQuery('img'), function(element) { return jQuery(element).attr('src'); });
var fancybox_gallery = jQuery.map(jQuery('img'), function(element) {
    jElement = jQuery(element);
    var href = jElement.attr('src');
    href = href.replace("square_thumbnails","fullsize");
    var title = jElement.attr('title');
    var linkOut = jElement.parent().attr('href');
    title = '<a href="'+linkOut+'">'+title+'</a>';
    fancybox_item = {"href":href,"title":title};
    return fancybox_item;
});
jQuery("img").parent().click(function(e) {
    e.preventDefault();
    var startIndex = thumbnails.indexOf(e.currentTarget.firstElementChild.getAttribute('src'));
    var imageTitle = e.currentTarget.firstElementChild.getAttribute('title');
    jQuery.fancybox(fancybox_gallery,{
        index:startIndex
    });
})
</script>
<?php echo foot(); ?>
