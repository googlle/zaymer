<?php
namespace app\models;

use yii\base\Model;

class CommentForm extends Model
{
    public $text;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
            [['text'], 'safe'],
        ];
    }
}
