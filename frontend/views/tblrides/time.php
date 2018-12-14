<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Tblrides;
use frontend\models\Tblridesschedule;
/* @var $this yii\web\View */
/* @var $model frontend\models\Tblrides */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblrides-form">

    <?php $form = ActiveForm::begin(); ?>  

    <?= $form->field($model2, 'start_time')->widget(\janisto\timepicker\TimePicker::className(), [
      'mode' => 'time',
      'clientOptions' => [
          'timeFormat' => 'H:m:s',
          'showSecond' => true,
      ]
    ]); ?>

    <?= $form->field($model2, 'end_time')->widget(\janisto\timepicker\TimePicker::className(), [
      'mode' => 'time',
      'clientOptions' => [
          'timeFormat' => 'H:m:s',
          'showSecond' => true,
      ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php    ActiveForm::end(); ?>

</div>

