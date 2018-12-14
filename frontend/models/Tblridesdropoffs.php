<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_RIDES_DROP_OFFS".
 *
 * @property int $id
 * @property int $schedule_id
 * @property string $drop_location
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLRIDESSCHEDULE $schedule
 * @property TBLUSERRIDES[] $tBLUSERRIDESs
 */
class Tblridesdropoffs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_RIDES_DROP_OFFS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['drop_location'], 'required'],
            [['schedule_id', 'created_at', 'updated_at'], 'integer'],
            [['drop_location'], 'string', 'max' => 255],
            [['schedule_id'], 'exist', 'skipOnError' => true, 'targetClass' => TBLRIDESSCHEDULE::className(), 'targetAttribute' => ['schedule_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'schedule_id' => 'Schedule ID',
            'drop_location' => 'Drop Location',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public function getTBLUSERRIDESs()
    {
        return $this->hasMany(Tbluserrides::className(), ['drop_location_id' => 'id']);
    }
}
