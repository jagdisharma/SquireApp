<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $fname
 * @property string $lname
 * @property string $username
 * @property string $pwd
 * @property string $phone
 * @property string $address
 * @property string $type
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLUSERRIDES[] $tBLUSERRIDESs
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'fname', 'lname', 'username', 'pwd', 'phone', 'address','status'], 'required'],
            ['email','email'],
            ['username','unique','message'=>'Username already exists!'],
            ['email','unique','message'=>'Email already exists!'],
            [['type', 'status'], 'string'],
            ['type','default','value'=>1],
            ['status','default','value'=>1],
            [['created_at', 'updated_at'], 'integer'],
            [['email', 'username'], 'string', 'max' => 50],
            [['fname', 'lname'], 'string', 'max' => 20],
            [['pwd', 'address'], 'string', 'max' => 100,'min'=>6],
            [['phone'], 'string', 'max' => 15],
            ['phone','number']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'username' => 'Username',
            'pwd' => 'Pwd',
            'phone' => 'Phone',
            'address' => 'Address',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbluserridess()
    {
        return $this->hasMany(Tbluserrides::className(), ['user_id' => 'id']);
    }
}
