<?php

namespace app\models;

use yii\db\Query;

/**
 * This is the model class for table "comments".
 *
 * @property string $id
 * @property string $user_id
 * @property string $text
 * @property string $created_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'text', 'created_at'], 'required'],
            [['user_id'], 'integer'],
            [['text'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'user_id'    => 'User ID',
            'text'       => 'Text',
            'created_at' => 'Created At',
        ];
    }

    public static function getRecentComments()
    {
        $models = \Yii::$app->db->createCommand('SELECT c.*, u.name
            FROM comments c
            INNER JOIN users u ON c.user_id = u.id
            WHERE c.id = (SELECT MAX(id)
                FROM comments c2
                WHERE c.user_id = c2.user_id)
            ORDER BY c.created_at DESC')
            ->queryAll();

        return $models;
    }
}
