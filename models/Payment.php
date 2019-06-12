<?php


namespace app\models;


use yii\base\Model;

class Payment extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $city;
    public $address;

    public function rules()
    {
        return [
            [['firstname','lastname','email','city','address'],'required'],
            ['email','email'],
            ['phone','default', 'value' => '']
        ];
    }
}