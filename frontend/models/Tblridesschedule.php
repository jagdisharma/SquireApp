<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_RIDES_SCHEDULE".
 *
 * @property int $id
 * @property int $ride_id
 * @property string $start_time
 * @property string $end_time
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLRIDESDROPOFFS[] $tBLRIDESDROPOFFSs
 * @property TBLRIDES $ride
 * @property TBLUSERRIDES[] $tBLUSERRIDESs
 */
class Tblridesschedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_RIDES_SCHEDULE';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_time', 'end_time'], 'required'],
            [['end_time'], 'validateTimeField'],
            [['ride_id', 'created_at', 'updated_at'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['ride_id'], 'exist', 'skipOnError' => true, 'targetClass' => TBLRIDES::className(), 'targetAttribute' => ['ride_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Schedule',
            'ride_id' => 'Ride ID',
            'start_time' => 'Depart',
            'end_time' => 'Arrival',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function validateTimeField($attribute,$params)
    {
        if($this->start_time == '' || $this->end_time == '')
        {
            $this->addError($attribute, $this->getAttributeLabel('Depart Time and Arrival Time need to be fill.'));       
        }
        //This is just an example, you will have to do some proper check if times are correct
        if($this->start_time < $this->end_time == '')
        {
            $this->addError($attribute, $this->getAttributeLabel('Arrival time should be greater than depart time.')); 
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblridesdropoffs()
    {
        return $this->hasMany(Tblridesdropoffs::className(), ['schedule_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblriderelation()
    {
        return $this->hasOne(Tblrides::className(), ['id' => 'ride_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLUSERRIDESs()
    {
        return $this->hasMany(Tbluserrides::className(), ['schedule_id' => 'id']);
    }
}
