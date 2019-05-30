<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Product".
 *
 * @property int $ID
 * @property string $Name
 * @property string $CategoryName
 * @property int $Price
 * @property int $Count
 * @property string $Description
 * @property resource $Image
 *
 * @property Category $categoryName
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
            [['Name', 'CategoryName', 'Description', 'Image'], 'string'],
            [['Price', 'Count'], 'integer'],
            [['CategoryName'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryName' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Name' => 'Name',
            'CategoryName' => 'Category Name',
            'Price' => 'Price',
            'Count' => 'Count',
            'Description' => 'Description',
            'Image' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryName()
    {
        return $this->hasOne(Category::className(), ['ID' => 'CategoryName']);
    }
}
