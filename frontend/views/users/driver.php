<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Drivers';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="users-index">

       
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Driver', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           //'id',
            'email:email',
            'fname',
            'lname',
            'username',
            [
                'attribute'=>'UserRide',
                'format' => 'raw',
                'value'=>function ($model, $key, $index, $column) {
                    /*if($model->id == 53) {
                        echo "<pre>"; print_r($model['tbluserridess']); exit();    
                    }*/
                    if(!empty($model['tbluserridess'])) {
                        $html = '';
                        $rHtml = '';
                        $dropHtmlArray = array();
                        $scheduleStartTimeArray = '';
                        $scheduleEndTimeArray = '';
                        $dataMain = $model['tbluserridess'];
                        foreach($dataMain as $key => $data){

                            if(!empty($data['schedule']) && !empty($data['schedule']['tblriderelation']) && $key == 0) {
                                $rHtml ='<p class="routeDetailsUser">Route: '.$data['schedule']['tblriderelation']['r_name'].'</p>';
                            }
                            if(!empty($data['dropLocation']) && !empty($data['dropLocation']) ) {
                                $dropHtmlArray[$key] = $data['dropLocation']['drop_location'];
                            } 
                            if(!empty($data['schedule']) && !empty($data['schedule']) && $key == 0) {
                                $scheduleStartTimeArray  = date('h:i a',strtotime($data['schedule']['start_time']));
                            }
                            if(!empty($data['schedule']) && !empty($data['schedule']) && $key == 0) {
                                $scheduleEndTimeArray = date('h:i a',strtotime($data['schedule']['end_time']));
                            }    
                        }
                        $finalHtml ='<div class="mainSchedules">';
                               $finalHtml .= $rHtml;
                               $finalHtml .='<p class="dropoffs"><span>Drop-Offs: </span>'.implode(', ',$dropHtmlArray).'</p>';
                               $finalHtml .='<p class="scheduleStart"><span>AM Arrivals: </span>'.$scheduleStartTimeArray.'</p>';
                               $finalHtml .='<p class="scheduleEnd"><span>PM Pick-Ups: </span>'.$scheduleEndTimeArray.'</p>';
                        $finalHtml .='</div>';
                        return $finalHtml;
                    } else {
                        return '';
                    }
                },
            ],
            //'pwd',
           // 'phone',
            //'address',
            //'type',
            //'status',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>