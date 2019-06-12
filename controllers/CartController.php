<?php


namespace app\controllers;


use app\models\Order;
use app\models\OrderItem;
use app\models\Payment;
use app\models\Product;
use OpenPayU_Configuration;
use OpenPayU_Exception;
use OpenPayU_Order;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;


class CartController extends Controller
{
    private $cart;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cart = Yii::$app->cart;
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'cart' => $this->cart,
        ]);
    }

    public function actionAdd($id, $qty = 1)
    {
        try {
            $product = $this->getProduct($id);
            if($product->Count<=0)
            {
                throw new \DomainException('Towar nie jest dostępny');
            }
            $quantity = $this->getQuantity($qty, $product->Count);
            if ($item = $this->cart->getItem($product->ID)) {
                $this->cart->plus($item->getId(), $quantity);
            } else {
                $this->cart->add($product, $quantity);
            }
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['productlist/index']);
        }
        return $this->redirect(['index']);
    }

    public function actionChange($id, $qty = 1)
    {
        try {
            $product = $this->getProduct($id);
            $quantity = $this->getQuantity($qty, $product->quantity);
            if ($item = $this->cart->getItem($product->ID)) {
                $this->cart->change($item->getId(), $quantity);
            }
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['cart']);
    }

    public function actionRemove($id)
    {
        try {
            $product = $this->getProduct($id);
            $this->cart->remove($product->ID);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionClear()
    {
        $this->cart->clear();
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return Product the loaded model
     * @throws \DomainException if the product cannot be found
     */
    private function getProduct($id)
    {
        if (($product = Product::findOne((int)$id)) !== null) {
            return $product;
        }
        throw new \DomainException('Przedmiot nie został znaleziony');
    }

    /**
     * @param integer $qty
     * @param integer $maxQty
     * @return integer
     * @throws \DomainException if the product cannot be found
     */
    private function getQuantity($qty, $maxQty)
    {
        $quantity = (int)$qty > 0 ? (int)$qty : 1;
        if ($quantity > $maxQty) {
            throw new \DomainException('Towar w magazynie: ' . Html::encode($maxQty) . ' sztuk.');
        }
        return $quantity;
    }

    private function Pay($model)
    {
        try
        {
            $order = [];
            $order['notifyUrl'] = 'http://localhost:8080/index.php?r=cart%2Ffinishpayment';
            $order['continueUrl'] = 'http://localhost:8080/index.php?r=cart%2Ffinishpayment';
            $order['customerIp'] = '127.0.0.1';
            $order['merchantPosId'] = OpenPayU_Configuration::getOauthClientId() ? OpenPayU_Configuration::getOauthClientId() : OpenPayU_Configuration::getMerchantPosId();
            $order['description'] = 'New order';
            $order['currencyCode'] = 'PLN';
            $order['extOrderId'] = uniqid('', true);

            $orderDB = new Order();
            $orderDB->TransactionID = $order['extOrderId'];

            $cartItems = $this->cart->getItems();
            $i=0;
            $totalAmount=0;
            foreach ($cartItems as $item) {
                $price = $item ->getPrice();
                $quantity = $item ->getQuantity();
                $order['products'][$i]['name'] = $item ->getProduct()->Name;
                $order['products'][$i]['unitPrice'] = $price;
                $order['products'][$i]['quantity'] = $quantity;
                $i++;
                $totalAmount +=$price*$quantity;
            }
            $order['totalAmount'] = $totalAmount;
            $order['buyer']['email'] = $model->email;
            $order['buyer']['phone'] = $model->phone;
            $order['buyer']['firstName'] = $model->firstname;
            $order['buyer']['lastName'] = $model->lastname;
            $order['buyer']['language'] = 'en';


            $orderDB->FirstName = $model->firstname;
            $orderDB->LastName = $model->lastname;
            $orderDB->Email = $model->email;
            $orderDB->Address = $model->address;
            $orderDB->City = $model->city;
            $orderDB->Price = $totalAmount;
            $orderDB->Date = date("Y-m-d H:i:s");

            $orderDB->save();
            $_SESSION['orderid']=$order['extOrderId'];
            $response = OpenPayU_Order::create($order);

            $this->redirect($response->getResponse()->redirectUri);
            header('Location:'.$response->getResponse()->redirectUri);
            //You must redirect your client to PayU payment summary page.
        }catch (\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function actionFinishpayment()
    {
        $orderID = '';
        if(isset($_SESSION['orderid']))
        {
            $orderID=$_SESSION['orderid'];
        }

        $this->cart->clear();
        return $this->render('finishpayment',
            ['orderID' =>$orderID]);
    }

    public function actionPaymentinfo()
    {
        $model = new Payment();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $this->Pay($model);
        } else {
            return $this->render('paymentinfo', [
                'cart' => $this->cart,
                'model'=>$model,
            ]);
        }
    }

    public function sendPayU($orderModel)
    {
        return $this->render('cart', [
            'cart' => $this->cart,
        ]);
    }
}