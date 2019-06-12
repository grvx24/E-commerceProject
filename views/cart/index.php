<?php
/* @var $this yii\web\View */
/* @var $cart \devanych\cart\Cart */
/* @var $item \devanych\cart\CartItem */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

?>
<?php if(!empty($cartItems = $cart->getItems())): ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="active">
                <th>Zdjęcie</th>
                <th>Nazwa</th>
                <th>Ilość</th>
                <th>Cena [zł]</th>
                <th>Wartość [zł]</th>
                <th><i aria-hidden="true">&times;</i></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($cartItems as $item): ?>
                <tr>
                    <td><?=Html::img(Url::to('@web/images/products/'.$item->getProduct()->Image),
                            ['alt'=>'Tea logo', 'width'=>'100','height'=>'80'])?></td>
                    <td><?=$item->getProduct()->Name?></td>
                    <td><?=$item->getQuantity()?></td>
                    <td><?=$item->getPrice()?></td>
                    <td><?=$item->getCost()?></td>
                    <td><a href="<?=Url::to(['remove', 'id' => $item->getId()])?>">Usuń</a></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr class="active">
                <td colspan="1">Całkowita ilość:</td>
                <td colspan="5"><?= $cart->getTotalCount()?></td>
            </tr>
            <tr class="active">
                <td colspan="1">Łączna kwota:</td>
                <td colspan="5"><?=$cart->getTotalCost() ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <p>
        <a href="<?= Url::toRoute(['cart/paymentinfo',]) ?>" class="btn btn-primary">Zakończ i zapłać</a>
    </p>
<?php else:?>
    <h3>Koszyk</h3>
    <p>Koszyk jest pusty</p>
<?php endif;?>