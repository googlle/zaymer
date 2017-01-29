<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class RegisterForm extends Model
{
    public $name;
    public $email;
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email address has already been taken.'],
            ['email', 'trim'],
            ['email', 'string', 'max' => 150],
            ['name', 'trim'],
            ['password', 'string', 'min' => 6, 'max' => 255],
        ];
    }
}
