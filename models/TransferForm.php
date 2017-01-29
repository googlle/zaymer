<?php
namespace app\models;

use yii\base\Model;

class TransferForm extends Model
{
    public $email;
    public $amount;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'amount'], 'required'],
            [['email'], 'email'],
            [['email'], 'trim'],
            [['amount'], 'number', 'numberPattern' => '/^\d+(.\d{1,2})?$/']
        ];
    }
}
