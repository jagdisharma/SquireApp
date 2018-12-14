<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reset_password".
 *
 * @property int $rpwd_id
 * @property string $password_token
 * @property int $created_at
 * @property string $status
 * @property int $user_id
 */
class Resetpassword extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reset_password';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password_token', 'created_at', 'status', 'user_id'], 'required'],
            [['created_at', 'user_id'], 'integer'],
            [['status'], 'string'],
            [['password_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rpwd_id' => 'Rpwd ID',
            'password_token' => 'Password Token',
            'created_at' => 'Created At',
            'status' => 'Status',
            'user_id' => 'User ID',
        ];
    }
}
