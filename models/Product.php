<?php

namespace app\models;

use devanych\cart\Cart;
use Psr\Cache\CacheException;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\ItemInterface;
use Yii;
use yii\db\ActiveRecord;

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
class Product extends ActiveRecord
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

    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Adds a tag to a cache item.
     *
     * Tags are strings that follow the same validation rules as keys.
     *
     * @param string|string[] $tags A tag or array of tags
     *
     * @return $this
     *
     * @throws InvalidArgumentException When $tag is not valid
     * @throws CacheException           When the item comes from a pool that is not tag-aware
     */
}
