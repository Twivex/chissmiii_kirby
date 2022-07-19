<?php
Kirby::plugin('chissmiii/text-direction-class', [
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
      }
  ]
]);