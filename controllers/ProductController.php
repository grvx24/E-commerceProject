<?php
/**
 * Created by PhpStorm.
 * User: Kamil
 * Date: 4/17/2019
 * Time: 10:41 PM
 */

namespace app\controllers;


use app\models\Product;
use yii\data\Pagination;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $query = Product::find();

        $pagination = new Pagination([
            'defaultPageSize'=>5,
            'totalCount'=>$query->count()
        ]);

        $products = $query->orderBy('Name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index',[
                'products'=>$products,
                'pagination'=>$pagination,
            ]);
    }

}