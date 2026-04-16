<?php

use App\Entity\Elder;

$elders = [
  [
    'name' => 'Bill Dusza',
    'image' => '/assets/paper_theme_v2/img/bill.webp',
    'bio' => 'A description about a human. They like to drink piña colada and walk in the rain.',
    'office' => 'Elder',
  ],

  [
    'name' => 'Kerron Martin',
    'image' => '/assets/paper_theme_v2/img/kerron.webp',
    'bio' => 'A description about a human. They like to drink piña colada and walk in the rain.',
    'office' => 'Elder',
  ],
];

foreach ($elders as $index => $data) {
  $elders[$index] = new Elder($data);
}
return $elders;
