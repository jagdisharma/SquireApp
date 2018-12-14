<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_USER_RIDES".
 *
 * @property int $id
 * @property int $user_id
 * @property int $schedule_id
 * @property int $drop_location_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Users $user
 * @property TBLRIDESSCHEDULE $schedule
 * @property TBLRIDESDROPOFFS $dropLocation
 */
class Tbluserrides extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_USER_RIDES';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'schedule_id', 'drop_location_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'schedule_id', 'drop_location_id', 'created_at', 'updated_at'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['schedule_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tblridesschedule::className(), 'targetAttribute' => ['schedule_id' => 'id']],
            [['drop_location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tblridesdropoffs::className(), 'targetAttribute' => ['drop_location_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'schedule_id' => 'Schedule ID',
            'drop_location_id' => 'Drop Location ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedule()
    {
        return $this->hasOne(Tblridesschedule::className(), ['id' => 'schedule_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDropLocation()
    {
        return $this->hasOne(Tblridesdropoffs::className(), ['id' => 'drop_location_id']);
    }
}
