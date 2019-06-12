<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Order".
 *
 * @property int $ID
 * @property string $TransactionID
 * @property int $Price
 * @property string $FirstName
 * @property string $LastName
 * @property string $Email
 * @property string $City
 * @property string $Address
 * @property string $Date
 *
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TransactionID', 'Price', 'FirstName', 'LastName', 'Email', 'City', 'Address'], 'required'],
            [['TransactionID', 'FirstName', 'LastName', 'Email', 'City', 'Address', 'Date'], 'string'],
            [['Price'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'TransactionID' => 'Transaction ID',
            'Price' => 'Price',
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'Email' => 'Email',
            'City' => 'City',
            'Address' => 'Address',
            'Date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['OrderID' => 'ID']);
    }
}
