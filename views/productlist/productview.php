<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <ul class="list-group text-center">
        <li class="list-group-item"><b>Nazwa: </b> <?= $product->Name?></li>
        <li class="list-group-item"><b>Cena: </b>  <?= $product->Price?></li>
        <li class="list-group-item"><b>Dostępność: </b> <?php if($product->Count>0) echo 'Towar dostępny'; else echo 'Towar niedostępny'?></li>
        <li class="list-group-item"><b>Opis: </b> <?= $product->Description?></li>
        <li class="list-group-item"><?= Html::img(Url::to('@web/images/products/'.$product->Image),['alt'=>'Logo', 'width'=>'300','height'=>'240']) ?></li>
    </ul>

    <?=Html::a('Dodaj do koszyka',[Url::toRoute(['cart/add','id'=>$product->ID,''])]) ?>

</div>
