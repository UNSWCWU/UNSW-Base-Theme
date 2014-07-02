<?php
/**
 * @file
 * Returns the HTML for the footer region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728140
 */
?>
<?php if ($content): ?>
  <div id="footer" class="<?php print $classes; ?>">
    <?php print $content; ?>
    <p id="back-to-top"><a href="#top">Back to top</a></p>
  </div>
<?php endif; ?>