var set_thumbnails = function() {
  var thumbnails = jQuery.map(
    jQuery('.download-file img'),
    function(element) { return jQuery(element).attr('src'); }
  );
  return thumbnails;
};

var set_gallery = function() {
  var fancybox_gallery = jQuery.map(jQuery('.download-file img'), function(element) {
    jElement = jQuery(element);
    // var href = jElement.attr('filename');
    var href = jElement.attr('src');
    href = href.replace(/%2F/g,'/');
    href = href.split('/');
    href.reverse();
    href[0] = jElement.attr('filename');
    href[1] = 'original';
    href.reverse();
    href = href.join('/');
    var title = jElement.attr('title');
    var linkOut = jElement.parent().attr('href');
    title = '<a href="'+linkOut+'">'+title+'</a>';
    var fancybox_item = {
      "href":href,
      "title":title,
      "type":"image",
    };
    return fancybox_item;
  });
  return fancybox_gallery;
};

var onImageClick = function(e,thumbnails,fancybox_gallery) {
  e.preventDefault();
  var startIndex = 0
  startIndex = thumbnails.indexOf(e.currentTarget.firstElementChild.getAttribute('src'));
  var imageTitle = e.currentTarget.firstElementChild.getAttribute('title');
  jQuery.fancybox(fancybox_gallery,{
    index:startIndex,
    afterLoad:function() {
      this.title = '<a href="'+this.href+'">Fullsize Image</a>  |  ' + this.title;
    }
  });
  jQuery.fancybox(fancybox_gallery,{
      index:startIndex,
      afterLoad:function() {
        console.log("afterload");
        this.title = '<a href="'+this.href+'">Fullsize Image</a>  |  ' + this.title;
      }
  });
};

var make_fancybox_gallery = function() {
  var thumbnails = set_thumbnails();
  var fancybox_gallery = set_gallery();
  jQuery(".download-file").click(function(e) { onImageClick(e,thumbnails,fancybox_gallery); });
};

make_fancybox_gallery();

if (typeof Neatline !== 'undefined' ) {
  Neatline.vent.on('select', function() {
    setTimeout(function() { make_fancybox_gallery(); }, 500);
  });
}
