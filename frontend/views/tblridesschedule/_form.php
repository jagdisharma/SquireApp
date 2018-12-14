<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tblridesschedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblridesschedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ride_id')->textInput() ?>

    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
