var thumbnails = jQuery.map(
  jQuery('.download-file img'),
  function(element) { return jQuery(element).attr('src'); }
);
var fancybox_gallery = jQuery.map(jQuery('.download-file img'), function(element) {
    jElement = jQuery(element);
    var href = jElement.attr('original_filename');
    console.log(href);
    var title = jElement.attr('title');
    var linkOut = jElement.parent().attr('href');
    title = '<a href="'+linkOut+'">'+title+'</a>';
    fancybox_item = {
      "href":href,
      "title":title,
      "type":"image",
    };
    return fancybox_item;
});
jQuery(".download-file").click(function(e) {
    console.log("happened");
    e.preventDefault();
    var startIndex = thumbnails.indexOf(e.currentTarget.firstElementChild.getAttribute('src'));
    var imageTitle = e.currentTarget.firstElementChild.getAttribute('title');
    jQuery.fancybox(fancybox_gallery,{
        index:startIndex,
        afterLoad:function() {
          this.title = '<a href="'+this.href+'">Fullsize Image</a>  |  ' + this.title;
        }
    });
})
