<?php

  // false: shade, true: tint
  if ($source->shade_tint_variant()->toBool()) {

    $hoverVariants = [
      'hover-bg' => [
        'color' => '#FFFFFF',
        'weight' => 0.15
      ],
      'hover-border' => [
        'color' => '#FFFFFF',
        'weight' => 0.1
      ],
      'hover-color' => [
        'color' => '#FFFFFF',
        'weight' => 0.3
      ]
    ];

  } else {

    $hoverVariants = [
      'hover-bg' => [
        'color' => '#000000',
        'weight' => 0.15
      ],
      'hover-border' => [
        'color' => '#000000',
        'weight' => 0.2
      ],
      'hover-color' => [
        'color' => '#000000',
        'weight' => 0.3
      ]
    ];

  }

?>


<style>

  :root {
    <?php

      $colorKeys = array_filter($source->content()->keys(), function ($key) {
        return strpos($key, 'color') === 0 || strpos($key, 'gradient_color') === 0;
      });

      $selectColorsKeys = array_filter($source->content()->keys(), function ($key) {
        return strpos($key, 'select') === 0;
      });


      $variableKeys = array_filter($source->content()->keys(), function ($key) {
        return strpos($key, 'variable') === 0;
      });

      foreach($colorKeys as $colorKey) {
        $colorField = $source->content()->get($colorKey);
        if ($colorField->isNotEmpty()) {
          $variantKey = str_replace('color_', 'variant_', $colorKey);
          if ($source->content()->get($variantKey)->value() === 'true') {
            echo $colorField->cssColorVar(true, $hoverVariants);
          } else {
            echo $colorField->cssColorVar(true);
          }
        }
      }


      foreach($selectColorsKeys as $selectColorKey) {
        $selectColorField = $source->content()->get($selectColorKey);
        if ($selectColorField->isEmpty()) {
          $selectColorField = $selectColorField->value('color_bs_primary');
        }
        $colorKey = $selectColorField->value();
        $variantKey = str_replace('color_', 'variant_', $colorKey);
        if ($source->content()->get($variantKey)->value() === 'true') {
          echo $selectColorField->cssColorVar(false, $hoverVariants);
        } else {
          echo $selectColorField->cssColorVar(false);
        }

      }


      foreach($variableKeys as $variableKey) {
        $variableField = $source->content()->get($variableKey);
        if ($variableField->isNotEmpty()) {
          $variableName = str_replace('variable_', '', $variableKey);
          $variableName = str_replace('_', '-', $variableName);
          $variableValue = $variableField->value();
          echo "--$variableName: $variableValue;";
        }
      }

    ?>

  }

</style>
