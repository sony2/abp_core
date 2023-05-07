<?php

namespace Drupal\abp_core\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;

/**
 * Provides an evbelenent details block.
 *
 * @Block(
 *   id = "abp_core_event_details",
 *   admin_label = @Translation("Belen Details"),
 *   category = @Translation("ABP")
 * )
 */
class BelenDetailsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = \Drupal::routeMatch()->getParameter('node');

    if ($node->getType() != 'belen') {
      return;
    }

    $time = $formatted_date = $link = '';

    // Format the date and time.
    if (!empty($node->get('field_date')->value)) {
      $date_value = $node->get('field_date')->value;
      $date = date_create($date_value);
      $formatted_date = date_format($date, "d F Y");
      $time = date_format($date, "h:i A");
    }

    if (!empty($node->get('field_link')->uri)) {
      $uri = $node->get('field_link')->uri;
      $link = Url::fromUri($uri)->toString();
    }

    $build = [
      '#theme' => 'abp_core_belen_details',
      '#date' => $formatted_date,
      '#time' => $time,
      '#location' => $node->get('field_location')->value,
      '#link' => $link,
    ];

    $build['#cache']['max-age'] = 0;

    return $build;
  }

}
