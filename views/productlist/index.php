<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>
<h1>Produkty</h1>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Nazwa</th>
        <th scope="col">Cena</th>
        <th scope="col">Dostępność</th>
        <th scope="col">Opis</th>
        <th scope="col">Zdjęcie</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($products as $product): ?>
        <tr>
            <th scope="row"><?= $product->Name?><a href="<?= Url::toRoute(['productlist/productview','id'=>$product->ID]) ?>">asd</a></th>
            <td><?= $product->Price?></td>
            <td><?php if($product->Count>0) echo 'Towar dostępny'; else echo 'Towar niedostępny'?></td>
            <td><?= $product->Description?></td>
            <td><?= Html::img(Url::to('@web/images/products/'.$product->Image),['alt'=>'Logo', 'width'=>'100','height'=>'80']) ?></td>
            <td>
                <?php $model->id = $product->ID ?>
                <?php $form = ActiveForm::begin([
                'id' => 'addToCart',
                'options' => ['class' => 'form-inline'],
                ]) ?>
                <div class="form-group">
                    <?= Html::activeHiddenInput($model,'id',['class'=>'form-control']) ?>
                    <?= Html::activeInput('number',$model,'quantity',['value'=>'1','min'=>'1','max'=>'20','class'=>'form-control']) ?>
                </div>
            </td>
            <td>
                <?= Html::submitButton('Dodaj do koszyka', ['class' => 'btn btn-primary']) ?>
            </td>
            <?php ActiveForm::end() ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
