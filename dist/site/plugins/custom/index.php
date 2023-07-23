<?php
function digit2hex(int $digit) {
  $hex = dechex($digit);
  return strlen($hex) < 2 ? '0' . $hex : $hex;
}

function hex2digit(string $hex) {
  return hexdec($hex);
}


function sass_mix($color_1, $color_2, $weight = null) {
  $color_1 = str_replace('#', '', $color_1);
  $color_2 = str_replace('#', '', $color_2);
  $weight = $weight ?? 0.5; // set the $weight to 50%, if that argument is omitted

  $color = "#";

  for ($i = 0; $i <= 5; $i += 2) { // loop through each of the 3 hex pairs—red, green, and blue
    $v1 = hex2digit(substr($color_1, $i, 2)); // extract the current pairs
    $v2 = hex2digit(substr($color_2, $i, 2));

    // combine the current pairs from each source color, according to the specified $weight
    $val = digit2hex(round($v2 + ($v1 - $v2) * (1 - $weight)));

    $color .= $val; // concatenate val to new color string
  }

  return $color;
};

Kirby::plugin('chissmiii/custom', [

  'pageMethods' => [


    'isTopLevel' => function () {
      return
        $this->parents()->count() === 0 ||
        ($this->parents()->count() === 1 && $this->parents()->first()->blueprint()->name() === 'pages/virtual-page');

    },


    'getSecuredTopLevelPage' => function(): Kirby\Cms\Page | null {

      $pagesToTcheck = $this->parents()->prepend($this)->flip();
      $securedPages = $pagesToTcheck->filter(function(Kirby\Cms\Page $p) {
        return $p->secured()->toBool() && $p->pwo_user()->isNotEmpty();
      });

      return $securedPages->first();

    },


    'isSecured' => function () {

      $securedTopLevelPage = $this->getSecuredTopLevelPage();
      return !is_null($securedTopLevelPage);

    },


    'getAccessUser' => function () {

      $securedTopLevelPage = $this->getSecuredTopLevelPage();

      if (!is_null($securedTopLevelPage)) {
        return $securedTopLevelPage->pwo_user()->toUser();
      }

      return null;

    },


    'userHasAccess' => function () {

      $loggedInUser = kirby()->user();
      $accessUser = $this->getAccessUser();

      return
        !is_null($loggedInUser) && !is_null($accessUser) &&
        ($loggedInUser->id() === $accessUser->id() || $loggedInUser->isAdmin());

    },


    'parentBlueprint' => function () {

      if ($this->isTopLevel()) {
        return null;
      }

      return $this->parent()->blueprint()->name();

    },


    'showTitle' => function () {

      if ($this->blueprint()->field('show_title') !== null) {
        return $this->show_title()->toBool();
      }

      if ($this->isTopLevel()) {
        return true;
      }

      if (
        !is_null($this->parentBlueprint()) &&
        $this->parentBlueprint() !== 'pages/composition._'
      ) {
        return true;
      }

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

      if ($this->cols_count()->isNotEmpty()) {
        return $this->cols_count()->optionKey();
      }

      return null;

    },


    'columnsClass' => function ($size = 'lg') {

      if (!empty($cols = $this->columns())) {
        return "col-$size-$cols";
      }

      return '';

    },


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

    },


    'cssColorVar' => function ($field, $addRgb = false, $variants = []) {
      $fieldKey = $field->key();
      $isSelectVar = strpos($fieldKey, 'select') !== false;
      $isColorVar = strpos($fieldKey, 'color') !== false;

      if ($isSelectVar || $isColorVar) {

        $fieldValue = $field->value();

        // abort if field value is empty
        if (empty($fieldValue)) {
          return '';
        }

        $colorVarsOuput = [];

        if ($isSelectVar) {
          // variable is a color select, so get the selected color variable
          $colorVarName = '--' . str_replace('select_', '', $fieldKey);
          $colorVarName = str_replace('_', '-', $colorVarName);
          $selectedColorVar = '--' . str_replace('color_', '', $fieldValue);
          $selectedColorVar = str_replace('_', '-', $selectedColorVar);

          array_push($colorVarsOuput, "$colorVarName: var($selectedColorVar);");

          // if rgb variant is requested, add the rgb variant of the selected variable to the list
          if ($addRgb) {
            array_push($colorVarsOuput, "$colorVarName-rgb: var($selectedColorVar-rgb);");
          }

          // if variants are requests, add variants of the selected variable to the list
          if (!empty($variants)) {
            foreach (array_keys($variants) as $variantName) {
              array_push(
                $colorVarsOuput,
                "$colorVarName-$variantName: var($selectedColorVar-$variantName);"
              );
            }
          }

        } elseif ($isColorVar) {
          $color = $fieldValue;

          // use field key as var name, stripping out 'color_' prefix and replacing underscores with dashes
          $colorVarName = '--' . str_replace('color_', '', $fieldKey);
          $colorVarName = str_replace('_', '-', $colorVarName);

          // add color var to the list
          array_push($colorVarsOuput, "$colorVarName: $color;");

          // if rgb variant is requested, add it to the list
          if ($addRgb) {
            $colorHex = str_replace('#', '', $color);
            $rgbColors = [
              hex2digit(substr($colorHex, 0, 2)),
              hex2digit(substr($colorHex, 2, 2)),
              hex2digit(substr($colorHex, 4, 2)),
            ];
            $rgbColorsString = implode(', ', $rgbColors);
            array_push($colorVarsOuput, "$colorVarName-rgb: $rgbColorsString;");
          }

          // if variants are requested, add them to the list
          if (!empty($variants)) {
            foreach ($variants as $variantName => $variant) {
              $variantColor = sass_mix($color, $variant['color'], $variant['weight']);
              array_push($colorVarsOuput, "$colorVarName-$variantName: $variantColor;");
            }
          }

        }
        // return the list of color vars, separated by newlines
        return implode("\n", $colorVarsOuput) . "\n";

      }

    },


    'replacePathVars' => function ($field) {

      if (strpos($field->key(), 'path') !== false) {

        $path = $field->value();
        $path = str_replace('$cloud', option('cloud_path'), $path);
        $matches = [];
        $regex = '/\{([a-zA-Z0-9_]+)\}/';
        $result = preg_match_all($regex, $path, $matches);

        if ($result) {

          foreach ($matches[1] as $match) {
            $replaceAttr = $field->model()->$match();
            $replaceValue = !empty($replaceAttr) ? $replaceAttr : '';
            $path = str_replace('{' . $match . '}', $replaceValue, $path);
          }

        }

        return $path;

      }

    },


  ],

]);
