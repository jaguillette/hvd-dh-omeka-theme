var make_fancybox_gallery = function() {
  var thumbnails = jQuery.map(
    jQuery('.download-file img'),
    function(element) { return jQuery(element).attr('src'); }
  );
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
      fancybox_item = {
        "href":href,
        "title":title,
        "type":"image",
      };
      return fancybox_item;
  });
  setTimeout(function() {
    jQuery(".download-file").click(function(e) {
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
  },300)
};

make_fancybox_gallery();

if (typeof Neatline !== 'undefined' ) {
  Neatline.vent.on('select', function() {
    setTimeout(make_fancybox_gallery(), 300);
  });
}
