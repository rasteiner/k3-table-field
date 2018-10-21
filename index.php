<?php 

Kirby::plugin('rasteiner/k3-table-field', [
  'fields' => [
    'table' => [
      'props' => [
      ],
      'computed' => [
        'value' => function() {
          return Yaml::decode($this->props['value']) ?? [];
        }
      ]
    ]
  ]
]);