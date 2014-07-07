<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function unsw_breadcrumb($breadcrumb) {
  $breadcrumb = $breadcrumb['breadcrumb'];
  
  // modify for search page
  $b = implode('/', $breadcrumb);
  if (strip_tags($b) == 'Home/Search/Content') {
    $breadcrumb = array(l(t('Home'), '<front>'));
  }
  
  // Rename Home
  if(!empty($breadcrumb)){
    array_shift($breadcrumb);
    array_unshift($breadcrumb, l(t('Home'), '<front>'));
  }

  if(!count($breadcrumb)){
    return;
  }
  
  $title = drupal_get_title();
  $breadcrumb[] = truncate_utf8($title, 30, TRUE, TRUE, 1) ;
  $num_of_breadcrumbs = count($breadcrumb);
  $breadcrumb_items = '';
  
  for ($i = 0; $i < $num_of_breadcrumbs; $i++) {
    if (substr($breadcrumb[$i], 0, 2) != '<a') {
      $breadcrumb[$i] = '<span>' . $breadcrumb[$i] . '</span>';
    }
    
    if (strpos($breadcrumb[$i], 'nolink') !== FALSE ) {
      $breadcrumb[$i] = '<span>' . strip_tags($breadcrumb[$i]) . '</span>';
    }

    $name = $breadcrumb[$i];
    $class = array();
    if ($i == 0) {
      $class[] = 'first';
    }elseif ($i == $num_of_breadcrumbs - 2) {
      $class[] = '2last';
    }elseif ($i == $num_of_breadcrumbs - 1 ) {
      $class[] = 'last';
      $name = '<span>'.strip_tags($name).'</span>';
    }

    if(!empty($class)){
      $class = 'class="'.implode(" ", $class).'"';
    } else {
      $class= '';
    }

    $breadcrumb_items .= '<li '.$class.'>' . $name . '</li>';
  }

  if($breadcrumb_items != ''){
    $breadcrumb_items = '<ul class="breadcrumbs">'.$breadcrumb_items.'</ul><div style="clear:both;"></div>';
  }

  return $breadcrumb_items;
}

/**
* Implements theme_image_formatter().
*/
function unsw_image_formatter($variables) {
  /* alt and title support for file entities is only in a premature state at the moment 
   * (see: http://drupal.org/node/1553094#comment-6277394)
   * to support image fields with image formatter, we override the theme function and override the
   * alt and title values with the field values
   */
  //print_r (array_keys($variables['item']));
  if ($variables['item']['alt'] == "") {
    $variables['item']['alt'] = str_replace(".jpg","",$variables['item']['filename']);
    $variables['item']['alt'] = str_replace(".gif","",$variables['item']['alt']);
    $variables['item']['alt'] = str_replace(".png","",$variables['item']['alt']);
  }
  
  if ($variables['item']['title'] == "") {
    $variables['item']['title'] = str_replace(".jpg","",$variables['item']['filename']);
    $variables['item']['title'] = str_replace(".gif","",$variables['item']['title']);
    $variables['item']['title'] = str_replace(".png","",$variables['item']['title']);
  }
  /*
  if (!empty($variables['item']['field_file_image_title_text'])) {
    $variables['item']['title'] = $variables['item']['field_file_image_title_text'][LANGUAGE_NONE][0]['value'];
  }*/
  return theme_image_formatter($variables);
}

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function unsw_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  unsw_preprocess_html($variables, $hook);
  unsw_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function unsw_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function unsw_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function unsw_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // unsw_preprocess_node_page() or unsw_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function unsw_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function unsw_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function unsw_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */
