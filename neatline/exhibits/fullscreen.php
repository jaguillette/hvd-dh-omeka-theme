<?php

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2014 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<?php

    $header = head(array(
      'title' => nl_getExhibitField('title'),
      'bodyclass' => 'neatline fullscreen'
      ));

    preg_match('/.*<body.*>/simU', $header, $matches);
    echo $matches[0];
?>

<?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>

<?php echo nl_getExhibitMarkup(); ?>

<span id="embed-code"><label>Embed code: </label><input onClick="this.select();" type="text" value='&lt;iframe src="<?php echo absolute_url(); ?>" height="500" width="100%"&gt;&lt;/iframe&gt;'></input></span>

<script type="text/javascript">
function inIframe () {
    try {
        return window.self !== window.top;
    } catch (e) {
        return true;
    }
}
if (inIframe()) {
  jQuery("#embed-code").attr("style","display:none;");
  jQuery("#static-bubble").attr("style","max-width:45%;");
}
</script>

</body>
</html>
