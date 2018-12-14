<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "TBL_RIDES".
 *
 * @property int $id
 * @property string $r_name
 * @property string $s_location
 * @property double $start_latitute
 * @property double $start_longitude
 * @property string $d_location
 * @property double $end_latitude
 * @property double $end_longitude
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TBLRIDESSCHEDULE[] $tBLRIDESSCHEDULEs
 */
class Tblrides extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_RIDES';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['r_name', 's_location', 'd_location'], 'required'],
            [['start_latitute', 'start_longitude', 'end_latitude', 'end_longitude'], 'number'],
            [['start_latitute', 'start_longitude', 'end_latitude', 'end_longitude'], 'default', 'value' => 0],
            //[['created_at','updated_at', 'start_latitute', 'start_longitude', 'end_latitude', 'end_longitude'],'required'],
            //[['start_latitute', 'start_longitude', 'end_latitude', 'end_longitude'],'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['r_name', 's_location', 'd_location'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Route',
            'r_name' => 'Route Name',
            's_location' => 'Start Location',
            'start_latitute' => 'Start Latitute',
            'start_longitude' => 'Start Longitude',
            'd_location' => 'Destination Location',
            'end_latitude' => 'End Latitude',
            'end_longitude' => 'End Longitude',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblrideschedules()
    {
        return $this->hasMany(Tblridesschedule::className(), ['ride_id' => 'id']);
    }
}
