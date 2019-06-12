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

    <?php $model->id = $product->ID ?>
    <?php $form = ActiveForm::begin([
        'id' => 'addToCart',
        'options' => ['class' => 'form-inline'],
    ]) ?>
    <div class="form-group">
        <?= Html::activeHiddenInput($model,'id',['class'=>'form-control']) ?>
        <?= Html::activeInput('number',$model,'quantity',['value'=>'1','min'=>'1','max'=>'20','class'=>'form-control']) ?>
    </div>
    <?= Html::submitButton('Dodaj do koszyka', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>

</div>
