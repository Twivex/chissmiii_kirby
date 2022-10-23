<?php

  // falsse: shade, true: tint
  if ($site->shade_tint_variant()->toBool()) {

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

      $colorKeys = array_filter($site->content()->keys(), function ($key) {
        return strpos($key, 'color') === 0;
      });

      foreach($colorKeys as $colorKey) {
        $colorField = $site->content()->get($colorKey);
        if ($colorField->isNotEmpty()) {
          $variantKey = str_replace('color_', 'variant_', $colorKey);
          $useVariant = $site->content()->get($variantKey)->value();
          if ($site->content()->get($variantKey)->value() === 'true') {
            echo $colorField->cssColorVar(true, $hoverVariants);
          } else {
            echo $colorField->cssColorVar(true);
          }
        }
      }


      $variableKeys = array_filter($site->content()->keys(), function ($key) {
        return strpos($key, 'variable') === 0;
      });

      foreach($variableKeys as $variableKey) {
        $variableField = $site->content()->get($variableKey);
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