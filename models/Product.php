<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Product".
 *
 * @property string $Name
 * @property string $Category
 * @property int $Count
 * @property string $Description
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name', 'Category', 'Description'], 'string'],
            [['Count'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Name' => 'Name',
            'Category' => 'Category',
            'Count' => 'Count',
            'Description' => 'Description',
        ];
    }
}
