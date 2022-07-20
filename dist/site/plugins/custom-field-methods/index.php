<?php
Kirby::plugin('chissmiii/custom-field-methods', [
  'fieldMethods' => [
    'directionClass' => function ($field) {
      $directionClass = '';
      if (strpos($field->key(), 'text_direction') !== false) {
        if (!empty($direction = $field->value())) {
          if ($direction === 'left') {
            $directionClass = 'text-start';
          } elseif ($direction === 'right') {
            $directionClass = 'text-end';
          } elseif ($direction === 'center') {
            $directionClass = 'text-center';
          } elseif ($direction === 'block') {
            $directionClass = 'text-justify';
          }
        }
      }
      return $directionClass;
    },
    'optionKey' => function ($field) {
      $blueprintField = $field->model()->blueprint()->field($field->key());
      if ($blueprintField['type'] === 'select') {
        $options = $blueprintField['options'];
        $optionKey = array_search($field->value(), $options);
        if ($optionKey !== false) {
          return $optionKey;
        }
      }
      return $field->value();
    }
  ]
]);