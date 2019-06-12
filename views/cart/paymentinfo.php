<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$cartItems = $cart->getItems();
?>

<div class="col-lg-6">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstname')->label('Imię') ?>

    <?= $form->field($model, 'lastname')->label('Nazwisko') ?>
    <?= $form->field($model, 'email')->label('Email') ?>
    <?= $form->field($model, 'phone')->label('Telefon') ?>
    <?= $form->field($model, 'city')->label('Miasto') ?>
    <?= $form->field($model, 'address')->label('Adres') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<div class="col-lg-6">
    <p><b>Zamówienie:</b></p>
    <ul class="list-group">
        <?php foreach ($cartItems as $item):?>
            <li class="list-group-item">
                <?php echo '<b>'.$item->getProduct()->Name.'</b>'.' - Liczba sztuk: '.$item->getQuantity() ?>
                <br>
                <?php echo 'Cena łącznie: '.($item->getCost()/10).' zł' ?>
            </li>
        <?php endforeach; ?>

    </ul>
</div>
