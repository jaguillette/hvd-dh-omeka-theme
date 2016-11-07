<?php
$showcasePosition = isset($options['showcase-position'])
    ? html_escape($options['showcase-position'])
    : 'none';
$showcaseFile = $showcasePosition !== 'none' && !empty($attachments);
$galleryPosition = isset($options['gallery-position'])
    ? html_escape($options['gallery-position'])
    : 'left';
$galleryFileSize = isset($options['gallery-file-size'])
    ? html_escape($options['gallery-file-size'])
    : 'square_thumbnail';
$captionPosition = isset($options['captions-position'])
    ? html_escape($options['captions-position'])
    : 'center';
?>
<?php if ($showcaseFile): ?>
<div class="gallery-showcase <?php echo $showcasePosition; ?> with-<?php echo $galleryPosition; ?> captions-<?php echo $captionPosition; ?>">
    <?php
        $attachment = array_shift($attachments);
        $filename = $attachment->getFile()['filename'];
        echo $this->exhibitAttachment($attachment, array('imageSize' => 'fullsize','imgAttributes' => array('filename' => $filename)));
    ?>
</div>
<?php endif; ?>
<div class="gallery <?php if ($showcaseFile || !empty($text)) echo "with-showcase $galleryPosition"; ?> captions-<?php echo $captionPosition; ?>">
    <?php
      if (!isset($fileOptions['imageSize'])) {
          $fileOptions['imageSize'] = 'square_thumbnail';
      }
      $html = '';
      foreach ($attachments as $attachment) {
        $filename = $attachment->getFile()['filename'];
        $html .= '<div class="exhibit-item exhibit-gallery-item">';
        $html .= $this->exhibitAttachment($attachment, array('imageSize' => $galleryFileSize,'imgAttributes' => array('filename' => $filename)));
        $html .= '</div>';
      }
      echo(apply_filters('exhibit_attachment_gallery_markup', $html,
          compact('attachments', 'fileOptions', 'linkProps')));
      // echo $this->exhibitAttachmentGallery($attachments, array('imageSize' => $galleryFileSize));
    ?>
</div>
<?php echo $text; ?>
