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

    <?= $form->field($model, 'pwd')->passwordInput(['maxlength' => true,'id'=>'user-password']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?> 

    <?= $form->field($modelrides, 'id')->dropDownList($ridesArray,
        [
            'prompt' => 'Select Routes',
            'onchange'=>'console.log("$(this).val()-------->", $(this).val());
                         $.post("index.php?r=tblridesschedule/lists&id='.'"+$(this).val(), function( data ){
                             console.log("data-------", data);
                             $("select#tblridesschedule-id").html( data );
                         });'
        ]
        
    )->label('Route'); ?>

    <?= $form->field($modelridesschedule, 'id')->dropDownList($schedulesArray,
        [
            'prompt' => 'Select Schedule',
        ]
    )->label('Schedule'); ?>


    <?= $form->field($model, 'status')->dropDownList([ '0' => 'Active', '1' => 'Inactive'], ['prompt' => 'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success center-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
      $this->registerJs(
        'jQuery(document).ready(function() {
            var selectedSchduleId = "'.$selectedSchduleId.'";
            if(selectedSchduleId != "") {
                console.log("selectedSchduleId------", selectedSchduleId);
                $(\'#tblridesschedule-id option[value="\'+selectedSchduleId+\'"]\').attr("selected",true);
            }
        });
        var count = 0;
        jQuery(document).on("keydown","#user-password", function() {
            if(count == 0) {
                $(this).val("");   
            } count++;
        });'
      );
 ?>
