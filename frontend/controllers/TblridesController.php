<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Tblrides;
use frontend\models\TblridesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Tblridesschedule;
use frontend\models\Tblridesdropoffs;
use frontend\models\Model;
use yii\helpers\ArrayHelper;

/**
 * TblridesController implements the CRUD actions for Tblrides model.
 */
 
class TblridesController extends Controller
{
    ///
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','update','view','index'],
                'rules' => [
                     [
                        'actions' => ['view','create','update','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tblrides models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblridesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['updated_at'=>SORT_DESC , 'created_at'=>SORT_DESC])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblrides model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tblrides model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tblrides();
        $model2 = [new Tblridesschedule];
        $model3 = [new Tblridesdropoffs];

        //echo "<pre>"; print_r(Yii::$app->request->post()); exit;
        if ($model->load(Yii::$app->request->post())) {
            //echo "<pre>"; print_r(Yii::$app->request->post()); exit;
            $request = Yii::$app->request->post();

            $model->created_at = strtotime(gmdate('Y-m-d H:i:s'));
            $model->updated_at = strtotime(gmdate('Y-m-d H:i:s'));


            $model2 = Model::createMultiple(Tblridesschedule::classname());
            Model::loadMultiple($model2, Yii::$app->request->post());
           
            $model3 = Model::createMultiple(Tblridesdropoffs::classname());
            Model::loadMultiple($model3, Yii::$app->request->post());
        
            // validate all models
            $valid1 = $model->validate();
            $valid = Model::validateMultiple($model2) && $valid1;
             /*foreach($request['Tblridesschedule'] as $_model){ 
                $start_time = strtotime($_model['start_time']) + (($request['Tblrides']['timeZoneOffset'])*60);
                $final_sdate = date("Y-m-d H:i:s", $start_time);
                $end_time = strtotime($_model['end_time']) + (($request['Tblrides']['timeZoneOffset'])*60);
                $final_edate = date("Y-m-d H:i:s", $end_time);
                
             } exit();*/
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    //$modelDropoffs->start_time = strtotime(gmdate('Y-m-d H:i:s'));
                    if ($flag=$model->save(false)) {

                        if(isset($request['Tblridesschedule']) && count($request['Tblridesschedule'])>0){

                            foreach($request['Tblridesschedule'] as $_model){

                                   $modelSchedule = new Tblridesschedule();

                                    $modelSchedule->created_at = time();
                                    $modelSchedule->updated_at = time();
                                    
                                    $start_time = strtotime($_model['start_time']) + (($request['Tblrides']['timeZoneOffset'])*60);
                                    $final_sdate = date("H:i:s", $start_time);
                                    $end_time = strtotime($_model['end_time']) + (($request['Tblrides']['timeZoneOffset'])*60);
                                    $final_edate = date("H:i:s", $end_time);

                                    $modelSchedule->start_time = $final_sdate;
                                    $modelSchedule->end_time = $final_edate;
                                    $modelSchedule->ride_id = $model->id;

                                    $modelSchedule->save(false);

                                    $scheduleId = $modelSchedule['id'];

                                        if(isset($request['Tblridesdropoffs']) && count($request['Tblridesdropoffs'])>0){                                            

                                            foreach ($request['Tblridesdropoffs'] as $_dropOffs) {

                                                $modelDropoffs = new Tblridesdropoffs();

                                                $modelDropoffs->schedule_id   = $scheduleId;
                                                $modelDropoffs->drop_location = $_dropOffs['drop_location'];
                                                $modelDropoffs->created_at = time();
                                                $modelDropoffs->updated_at = time();

                                                $modelDropoffs->save(false);
                                            }//foreach
                                        }//if

                            }//foreach

                        }

                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

        }

        return $this->render('create', [
            'model' => $model,
            'model2' => (empty($model2)) ? [new Tblridesschedule] : $model2,
            'model3' => (empty($model3)) ? [new Tblridesdropoffs] : $model3
        ]);
    }

    /**
     * Updates an existing Tblrides model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mailparse_determine_best_xfer_encoding(fp)
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = Tblrides::find()
        ->joinWith(['tblrideschedules'])
        ->where(['TBL_RIDES.id' => $id])
        ->one(); 

        $model2 = $model->tblrideschedules;
        if(empty($model2)) {
            $model2 = [new Tblridesschedule];    
        }
        
        if(!empty($model2)) {
            $arraySchedule = array();
            foreach ($model2 as $key => $value) {
                $arraySchedule[]=$value->id;
            }

            $model3 = Tblridesdropoffs::find()->where('schedule_id IN ('.implode(",", $arraySchedule).')')->all();

            //echo "<pre>";print_r($model3);exit();

            if(empty($model3)) {
                $model3 = [new Tblridesdropoffs];    
            }
        } else {
            $model3 = [new Tblridesdropoffs];
        }
        //echo "<pre>"; print_r($model3); exit();
        //echo "<pre>"; print_r($model); exit();
        if ($model->load(Yii::$app->request->post())) {
            
            $request = Yii::$app->request->post();
            $model->updated_at = strtotime(gmdate('Y-m-d H:i:s'));

            $oldIDs = ArrayHelper::map($model2, 'id', 'id');
            $model2 = Model::createMultiple(Tblridesschedule::classname(), $model2);
            Model::loadMultiple($model2, Yii::$app->request->post());
            //echo "<pre>"; print_r(Yii::$app->request->post()); exit;
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($model2, 'id', 'id')));

            // validate all models
            $valid1 = $model->validate();
            $valid = Model::validateMultiple($model2) && $valid1;
            
            if ($valid) {
                /*$transaction = \Yii::$app->db->beginTransaction();
                try {*/
                    if ($flag=$model->save(false)) {
                        foreach ($model2 as $models2) {
                            $scheduleId = ''; 
                            if(isset($models2['id']) && $models2['id'] != "") {
                                //echo $models2['id']."--------if-schedule_id<br>";
                                $modelSchedule = Tblridesschedule::findOne($models2['id']);
                                $modelSchedule->updated_at = time();
                                // code for convert selected date into UTC timezone again
                                $start_time = strtotime($models2['start_time']) + (($request['Tblrides']['timeZoneOffset'])*60);
                                $final_sdate = date("H:i:s", $start_time);
                                $end_time = strtotime($models2['end_time']) + (($request['Tblrides']['timeZoneOffset'])*60);
                                $final_edate = date("H:i:s", $end_time);

                                $modelSchedule->start_time = $final_sdate;
                                $modelSchedule->end_time = $final_edate;
                                $modelSchedule->ride_id = $model->id;

                                $modelSchedule->save(false);
                                //echo $modelSchedule['id']."-----after ---if-schedule_id<br>";
                                $scheduleId = $models2['id'];
                            } else {
                                $modelScheduleNew = new Tblridesschedule();

                                $modelScheduleNew->created_at = time();
                                $modelScheduleNew->updated_at = time();
                                $start_time = strtotime($models2['start_time']) + (($request['Tblrides']['timeZoneOffset'])*60);
                                $final_sdate = date("H:i:s", $start_time);
                                $end_time = strtotime($models2['end_time']) + (($request['Tblrides']['timeZoneOffset'])*60);
                                $final_edate = date("H:i:s", $end_time);
                                $modelScheduleNew->start_time = $final_sdate;
                                $modelScheduleNew->end_time = $final_edate;
                                $modelScheduleNew->ride_id = $model->id;

                                $modelScheduleNew->save(false);
                                $scheduleId = $modelScheduleNew['id']; 
                                //echo $scheduleId."--------else-schedule_id<br>";
                                $arraySchedule[] = $scheduleId;
                            }
                        }

                        
                            
                        if(isset($request['Tblridesdropoffs']) && count($request['Tblridesdropoffs'])>0){
                            foreach ($request['Tblridesdropoffs'] as $_dropOffs) {
                                if($_dropOffs['id'] != "") {
                                    $modelDropoffs = Tblridesdropoffs::findOne($_dropOffs['id']);
                                    $modelDropoffs->drop_location = $_dropOffs['drop_location'];
                                    $modelDropoffs->updated_at = time();
                                    $modelDropoffs->save(false);
                                } else {
                                    foreach ($arraySchedule as $thisSchedule) {
                                        $modelDropoffsNew = new Tblridesdropoffs();
                                        $modelDropoffsNew->schedule_id   = $thisSchedule;
                                        $modelDropoffsNew->drop_location = $_dropOffs['drop_location'];
                                        $modelDropoffsNew->created_at = time();    
                                        $modelDropoffsNew->updated_at = time();
                                        $modelDropoffsNew->save(false);
                                    }
                                }
                            }                                    
                        }

                        //exit();
                        if ($flag) {
                            //$transaction->commit();
                            return $this->redirect(['index', 'id' => $model->id]);
                        }
                    }
                /*} catch (Exception $e) {
                    echo "<pre>";print_r($transaction);exit();
                    $transaction->rollBack();
                }*/
            }
        }

        return $this->render('update', [
            'model' => $model,
            'model2' => $model2,
            'model3' => $model3
        ]);
    }

    /**
     * Deletes an existing Tblrides model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tblrides model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tblrides the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tblrides::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

        // public function actionLists($id){
        //     $countTblridesschedule = Tblridesschedule::find()
        //         ->where(['ride_id' => $id])
        //         ->count();

        //     $Ridesschedules = Tblridesschedule::find()
        //          ->where(['ride_id' => $id])
        //          ->all();

        //     if($countTblridesschedule>0){
        //         foreach($Ridesschedules  as $Ridesschedule){
        //             echo "<option value='".$Ridesschedule->id."'>".$Ridesschedule->start_time."</option>";            }
        //     }else{
        //         echo "<option>--</option>";
        //     }
        // }   
   
}
