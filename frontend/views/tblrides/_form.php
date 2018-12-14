<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Tblrides;
use frontend\models\Tblridesschedule;
use frontend\models\Tblridesdropoffs;
use kartik\datetime\DateTimePicker;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tblrides */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblrides-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
<!-- <pre>
    // <?php //print_r($model2);exit();?>
</pre> -->
    
    <?= $form->field($model, 'r_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_location')->textInput(['maxlength' => true,'id'=>'start_location','onFocus'=>'initializeAutocomplete()']) ?>

    <?= $form->field($model, 'start_latitute')->hiddenInput(['id'=>'start_latitute','readonly'=> true,])->label(false); ?>

    <?= $form->field($model, 'start_longitude')->hiddenInput(['id'=>'start_longitude','readonly'=> true])->label(false); ?>

    <?= $form->field($model, 'd_location')->textInput(['maxlength' => true,'id'=>'destination_location','onFocus'=>'initializeAutocomplete2()']) ?>

    <?= $form->field($model, 'end_latitude')->hiddenInput(['id'=>'end_latitude','readonly'=> true])->label(false); ?>

    <?= $form->field($model, 'end_longitude')->hiddenInput(['id'=>'end_longitude','readonly'=> true])->label(false); ?>

    <div >
        <div class="panel panel-default">
        <!--div class="panel-heading"><h4>Schedule</h4></div-->
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 20, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $model2[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'start_time',
                    'end_time',
                ],
            ]); ?>
              <h4>Schedule</h4>
              <div class="pull-right">
                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>        
              </div>
              <table class="table"><tr><td>
                <div class="panel-heading"><h4>Depart</h4></div></td>
                <td><div class="panel-heading"><h4>Arrival</h4></div></td></tr>
              </table>
            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($model2 as $i => $models2): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $models2->isNewRecord) {
                                echo Html::activeHiddenInput($models2, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                           
                            <div class="col-sm-6">
                                <?= $form->field($models2, "[{$i}]start_time")->widget(
                                    TimePicker::classname(),[
                                        'name' => 't1',
                                        'pluginOptions' => [
                                            'showSeconds' => true,
                                            'showMeridian' => false,
                                            'defaultTime' => '00:00:00',
                                            'minuteStep' => 1,
                                            'secondStep' => 5,
                                        ],
                                        'options'=>[
                                          //'format'=>strtotime(gmdate('H:i:s')),
                                          'readonly'=>true,
                                        ]
                                ])->label(false) ?>
                            </div>

                            <div class="col-sm-6">
                                <?= $form->field($models2, "[{$i}]end_time")->widget(
                                   TimePicker::classname(),[
                                        'name' => 't1',
                                        //'value' => strtotime(gmdate('H:i')),
                                        'pluginOptions' => [
                                           'showSeconds' => true,
                                            'showMeridian' => false,
                                            'defaultTime' => '00:00:00',
                                             'minuteStep' => 1,
                                           // 'secondStep' => 5,
                                        ],
                                        'options'=>[
                                          //'format'=>strtotime(gmdate('H:i')),
                                          'readonly'=>true,
                                        ]
                                  ])->label(false)  ?>
                            </div>
                            

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    </div>
  

    <div class="panel panel-default">
        <!--div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Drop_Offs</h4></div-->
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 20, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add1-item', // css class
                'deleteButton' => '.remove1-item', // css class
                'model' => $model3[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'full_name',
                    'address_line1',
                    'address_line2',
                    'city',
                    'state',
                    'postal_code',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
              <div class="panel-heading">
                  <h3 class="panel-title pull-left">Drop Offs</h3>
                  <div class="pull-right">
                      <button type="button" class="add1-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                  </div>
                  <div class="clearfix"></div>
              </div>
            <?php foreach ($model3 as $i => $models3): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $models3->isNewRecord) {
                                echo Html::activeHiddenInput($models3, "[{$i}]id");
                            }
                        ?>
                      
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($models3, "[{$i}]drop_location")->textInput(['maxlength' => true,'required'])->label(false) ?>
                            </div>
                            
                        </div><!-- .row -->
                   
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    
    <!--?= $form->field($model3, 'drop_location')->textInput(['maxlength' => true]) ?-->
    <?= $form->field($model, 'timeZone')->hiddenInput(['value'=> date_default_timezone_get(),'id'=>'timeZone'])->label(false); ?>
    <?= $form->field($model, 'timeZoneOffset')->hiddenInput(['value'=> date_default_timezone_get(),'id'=>'timeZoneOffset'])->label(false); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success center-block']) ?>
    </div>

<?php    ActiveForm::end(); ?>

</div>





<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_96VY2BqsXAy-m0hbNk0GHiygAKvjouM&libraries=places"></script>


<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">


<script type="text/javascript">
function initializeAutocomplete(){
    var startlocation = document.getElementById('start_location');
    var options = {}
    var autocomplete = new google.maps.places.Autocomplete(startlocation, options);

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      var place = autocomplete.getPlace();
      var start_lat = place.geometry.location.lat();
      var start_lng = place.geometry.location.lng();

      document.getElementById("start_latitute").value = start_lat;
      document.getElementById("start_longitude").value = start_lng;
    });
}

function initializeAutocomplete2(){
    var endlocation = document.getElementById('destination_location');
    var options = {}
    var autocomplete = new google.maps.places.Autocomplete(endlocation, options);

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      var place = autocomplete.getPlace();
      var end_lat = place.geometry.location.lat();
      var end_lng = place.geometry.location.lng();
      $("#end_latitude").val(end_lat);
      $("#end_longitude").val(end_lng);
      
    });
}

</script>
<?php 
$this->registerJs('
    jQuery(document).ready(function() {
        var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        jQuery("#timeZone").val(timeZone);
        var d = new Date();
        var n = d.getTimezoneOffset();
        jQuery("#timeZoneOffset").val(n);
    });
')
?>