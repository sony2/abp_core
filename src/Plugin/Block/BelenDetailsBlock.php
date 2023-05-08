<?php

namespace Drupal\abp_core\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;

/**
 * Provides an evbelenent details block.
 *
 * @Block(
 *   id = "abp_core_belen_details",
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

    $build = [
      '#theme' => 'abp_core_belen_details',
      '#artesanos_figuras' => $node->get('field_artesanos_figuras')->value,
      '#ano_belen' => $node->get('field_ano_belen')->value,
      '#escena' => $node->get('field_escena')->value,
      '#localizacion_belen' => $node->get('field_localizacion_belen')->value,
      '#tamano_belen' => $node->get('field_tamano_belen')->value,
      '#tamano_figuras_belen' => $node->get('field_tamano_figuras_belen')->value,
      '#tipo_belen' => $node->get('field_tipo_belen')->value,
    ];

    $build['#cache']['max-age'] = 0;

    return $build;
  }
}
