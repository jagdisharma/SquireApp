<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TblridesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblrides-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'r_name') ?>

    <?= $form->field($model, 's_location') ?>

    <?= $form->field($model, 'd_location') ?>

    <?= //$form->field($model, 'start_latitute') ?>

    <?php // echo $form->field($model, 'start_longitude') ?>

    <?php // echo $form->field($model, 'end_latitude') ?>

    <?php // echo $form->field($model, 'end_longitude') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
