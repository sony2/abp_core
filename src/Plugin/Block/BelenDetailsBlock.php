<?php

namespace Drupal\abp_core\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\file\Entity\File;

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

    if ($node != null && $node->getType() != 'belen') {
      return;
    }

    $artesanos_figuras = "";
    $terms = $node->get('field_artesanos_figuras')->referencedEntities();
    foreach ($terms as $term) {
      $name = $term->getName();
      $artesanos_figuras = $artesanos_figuras . $name . ', ';
    }
    if (str_ends_with($artesanos_figuras, ', ')) {
      $artesanos_figuras = substr($artesanos_figuras, 0, -2);
    }

    $ano_belen = "";
    $terms = $node->get('field_ano_belen')->referencedEntities();
    foreach ($terms as $term) {
      $name = $term->getName();
      $ano_belen = $ano_belen . $name . ', ';
    }
    if (str_ends_with($ano_belen, ', ')) {
      $ano_belen = substr($ano_belen, 0, -2);
    }

    $escena = "";
    $terms = $node->get('field_escena')->referencedEntities();
    foreach ($terms as $term) {
      $name = $term->getName();
      $escena = $escena . $name . ', ';
    }
    if (str_ends_with($escena, ', ')) {
      $escena = substr($escena, 0, -2);
    }

    $localizacion_belen = "";
    $terms = $node->get('field_localizacion_belen')->referencedEntities();
    foreach ($terms as $term) {
      $name = $term->getName();
      $localizacion_belen = $localizacion_belen . $name . ', ';
    }
    if (str_ends_with($localizacion_belen, ', ')) {
      $localizacion_belen = substr($localizacion_belen, 0, -2);
    }

    $tamano_belen = "";
    $terms = $node->get('field_tamano_belen')->referencedEntities();
    foreach ($terms as $term) {
      $name = $term->getName();
      $tamano_belen = $tamano_belen . $name . ', ';
    }
    if (str_ends_with($tamano_belen, ', ')) {
      $tamano_belen = substr($tamano_belen, 0, -2);
    }

    $tamano_figuras_belen = "";
    $terms = $node->get('field_tamano_figuras_belen')->referencedEntities();
    foreach ($terms as $term) {
      $name = $term->getName();
      $tamano_figuras_belen = $tamano_figuras_belen . $name . ', ';
    }
    if (str_ends_with($tamano_figuras_belen, ', ')) {
      $tamano_figuras_belen = substr($tamano_figuras_belen, 0, -2);
    }

    $tipo_belen = "";
    $terms = $node->get('field_tipo_belen')->referencedEntities();
    foreach ($terms as $term) {
      $name = $term->getName();
      $tipo_belen = $tipo_belen . $name . ', ';
    }
    if (str_ends_with($tipo_belen, ', ')) {
      $tipo_belen = substr($tipo_belen, 0, -2);
    }

    $galeria = array();
    $fotos = $node->get('field_galeria')->referencedEntities();
    foreach ($fotos as $foto) {
      $item = [];
      $fid = $foto->field_media_image->target_id;
      $file = File::load($fid);
      $item['imagen'] = $file->createFileUrl();
      array_push($galeria, $item);
    }

    $build = [
      '#theme' => 'abp_core_belen_details',
      '#artesanos_figuras' => $artesanos_figuras,
      '#ano_belen' => $ano_belen,
      '#escena' => $escena,
      '#localizacion_belen' => $localizacion_belen,
      '#tamano_belen' => $tamano_belen,
      '#tamano_figuras_belen' => $tamano_figuras_belen,
      '#tipo_belen' => $tipo_belen,
      '#galeria' => $galeria,
    ];

    $build['#cache']['max-age'] = 0;

    return $build;
  }
}
