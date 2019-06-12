<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TransactionID')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Price')->textInput() ?>

    <?= $form->field($model, 'FirstName')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'LastName')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'City')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Date')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
