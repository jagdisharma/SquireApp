<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Tbluserrides;
use frontend\models\Tblrides;
use frontend\models\Tblridesschedule;


/* @var $this yii\web\View */
/* @var $model frontend\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pwd')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?> 

    <?= $form->field($modelrides, 'id')->dropDownList($ridesArray,
        [
            'prompt' => 'Select Routes',
            'onchange'=>'
                         $.post("index.php?r=tblridesschedule/lists&id='.'"+$(this).val(), function( data ){
                             $("select#tblridesschedule-id").html( data );
                         });',
            'required'=>'required',
        ]
        
    )->label('Route'); ?>

    <?= $form->field($modelridesschedule, 'id')->dropDownList($schedulesArray,
        [
            'prompt' => 'Select Schedule',
            'required'=>'required',
        ]
    )->label('Schedule'); ?>


    <?= $form->field($model, 'status')->dropDownList([ '0' => 'Active', '1' => 'Inactive'], ['prompt' => 'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success center-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
