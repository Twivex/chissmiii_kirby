<?php
Kirby::plugin('chissmiii/custom', [

  'pageMethods' => [

    'isTopLevel' => function () {
      return $this->parents()->count() === 0;
    },

    'showTitle' => function () {
      if ($this->blueprint()->field('show_title') !== null) return $this->show_title()->toBool();
      if ($this->isTopLevel()) return true;
      return false;
    },

    'headingLevel' => function () {
      $headingLevel = $this->isTopLevel() ? '1' : '2';
      return $headingLevel;
    },

    'headingTextDirectionClass' => function () {
      if ($this->title_text_direction()->isNotEmpty()) {
        return $this->title_text_direction()->directionClass();
      }
      return '';
    },

    'columns' => function () {
      if ($this->cols_count()->isNotEmpty()) return $this->cols_count()->optionKey();
      return null;
    },

    'columnsClass' => function ($size = 'lg') {
      if (!empty($cols = $this->columns())) {
        return "col-$size-$cols";
      }
      return '';
    }

  ],


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
      if (isset($blueprintField['type']) && $blueprintField['type'] === 'select') {
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