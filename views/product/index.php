<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Products</h1>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Category</th>
        <th scope="col">Count</th>
        <th scope="col">Description</th>
    </tr>
    </thead>
  <tbody>
  <?php foreach ($products as $product): ?>
      <tr>
          <td><?= Html::encode("{$product->Name}") ?></td>
          <td><?= Html::encode("({$product->Category})") ?></td>
          <td><?= Html::encode("{$product->Count}") ?></td>
          <td><?= Html::encode("{$product->Description}") ?></td>
      </tr>
  <?php endforeach; ?>
  </tbody>

</table>

<?= LinkPager::widget(['pagination' => $pagination]) ?>