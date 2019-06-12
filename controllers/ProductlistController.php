<?php


namespace app\controllers;

use app\models\ProductToCart;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Product;

use OpenPayU_Order;
use OpenPayU_Configuration;

class ProductlistController extends Controller
{
    private $cart;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cart = Yii::$app->cart;
    }

    public function actionIndex()
    {
        $model = new ProductToCart();

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $productId = $_POST['ProductToCart']['id'];
            $quantity = $_POST['ProductToCart']['quantity'];
            return $this->redirect(['cart/add','id'=>$productId,'qty'=>$quantity]);
        }else
        {
            $query = Product::find();
            $addToCartModel = new ProductToCart();
            $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $query->count(),
            ]);

            $products = $query->orderBy('name')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return $this->render('index', [
                'products' => $products,
                'pagination' => $pagination,
                'model' => $addToCartModel,
            ]);
        }
    }

    public function actionProductview($id)
    {
        $product =  Product::findOne($id);

        return $this->render('productview', [
            'product' => $product,
        ]);
    }

}