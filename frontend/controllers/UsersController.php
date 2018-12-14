<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Users;
use frontend\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveControllers;
use yii\filters\AccessControl;
use frontend\models\Tbluserrides;
use frontend\models\Tblridesschedule;
use frontend\models\Tblrides;
use frontend\models\Tblridesdropoffs;
use yii\helpers\ArrayHelper;
/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['driver','create','update','view','index'],
                'rules' => [
                     [
                        'actions' => ['driver','view','create','update','index'],
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where("type='1'")->orderBy(['id'=>SORT_DESC])->all();/*Remove this if u want to show all users*/
       // $dataProvider->query->joinWith(['tbluserridess','tbluserridess.dropLocation','tbluserridess.schedule.tblriderelation']);
        return $this->render('driver', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionDriver()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where("type='1'")->orderBy(['updated_at'=>SORT_DESC , 'created_at'=>SORT_DESC])->all();
        //$dataProvider->query->joinWith(['tbluserridess','tbluserridess.dropLocation','tbluserridess.schedule.tblriderelation']);
        
        return $this->render('driver', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Users model.
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
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();
        $modelridesschedule = new Tblridesschedule();
        $modelrides = new Tblrides();
        
        $ridesArray = ArrayHelper::map(Tblrides::find()->all(),'id','r_name');

        $ridesSchedule = Tblridesschedule::find()->all();
        $schedulesArray = ArrayHelper::map($ridesSchedule,'id', function ($ridesSchedule, $defaultValue) {
            return $ridesSchedule->start_time. ' - ' .$ridesSchedule->end_time;
        });
        
        if ($model->load(Yii::$app->request->post()) &&  $model->validate() ){
            $resquest = Yii::$app->request->post();
            $model->pwd = md5($model->pwd);
            $model->type = 1;
            $model->created_at = strtotime(gmdate('Y-m-d H:i:s'));  
            $model->updated_at = strtotime(gmdate('Y-m-d H:i:s')); 
            $model->save(false);
            $user_id = $model['id'];
            if(isset($resquest['Tblrides']) && !empty($resquest['Tblrides']) && isset($resquest['Tblridesschedule']) && !empty($resquest['Tblridesschedule'])) {
                $scheduleId = $resquest['Tblridesschedule']['id'];
                $allDropOffsSchedule = Tblridesdropoffs::find()->where(['=','schedule_id',$scheduleId])->all();
                if(!empty($allDropOffsSchedule)) {
                    foreach($allDropOffsSchedule as $dropOff) {
                        $modeluserrides = new Tbluserrides();
                        $modeluserrides->user_id = $user_id;
                        $modeluserrides->schedule_id = $scheduleId;
                        $modeluserrides->drop_location_id = $dropOff['id'];
                        $modeluserrides->created_at = time();
                        $modeluserrides->updated_at = time();   
                        $modeluserrides->save();        
                    }
                }
               
            }
           return $this->redirect(['driver']);
        }

        return $this->render('create', [
            'model' => $model,
            'modelrides' => $modelrides,
            'modelridesschedule' => $modelridesschedule,
            'ridesArray' => $ridesArray,
            'schedulesArray' => $schedulesArray,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $selectedSchduleId = '';
        $model = users::find()
        ->joinWith(['tbluserridess'])
        ->where(['users.id' => $id])
        ->one();
        
        if(!empty($model)) {
            $old_password = $model->pwd;
        }

        $old_password = $model->pwd;
        $schedulesArray = array();
        $modeluserrides = Tbluserrides::find()->where(['user_id' => $id])->one();
        
        if(!empty($modeluserrides)) {
            $scheduleid = $modeluserrides->schedule_id;
            $modelschedule= Tblridesschedule::find()->where(['id' => $scheduleid])->one();

            $rideid = $modelschedule->ride_id;
            $modelrides = Tblrides::find()->where(['id' => $rideid])->one();
            $modelridesschedule = Tblridesschedule::find()->where(['ride_id' => $rideid])->one(); 
            if(!empty($modeluserrides)) {
                $selectedSchduleId = $modeluserrides->schedule_id;
            }
            
            $ridesSchedule = Tblridesschedule::find()->where(['ride_id' => $rideid])->all();
            $schedulesArray = ArrayHelper::map($ridesSchedule,'id', function ($ridesSchedule, $defaultValue) {
                return $ridesSchedule->start_time . ' - ' . $ridesSchedule->end_time;
            });   
        } else {
            $modelridesschedule = new Tblridesschedule();
            $modelrides = new Tblrides();
            $modelschedule = new Tblridesschedule();
        }

        $ridesArray = ArrayHelper::map(Tblrides::find()->all(),'id','r_name');
        
        if ($model->load(Yii::$app->request->post())) {
            $resquest = Yii::$app->request->post();
            
            if(!preg_match('/^[a-f0-9]{32}$/', $model->pwd) && $model->pwd != "") {
                $model->pwd = md5($model->pwd);    
            } 
            $model->type = 1;
            $model->updated_at = strtotime(gmdate('Y-m-d H:i:s'));
            $model->save(false);
            $user_id = $model['id'];
            Tbluserrides::deleteAll(['=', 
                'user_id',$modeluserrides['user_id']]
            );
            // all user rides dropoffs 
            $allTblUserData = Tbluserrides::find()->where(['user_id' => $id])->all();
            if(isset($resquest['Tblrides']) && !empty($resquest['Tblrides']) && isset($resquest['Tblridesschedule']) && !empty($resquest['Tblridesschedule'])) {
                $scheduleId = $resquest['Tblridesschedule']['id'];
                $allDropOffsSchedule = Tblridesdropoffs::find()->where(['=','schedule_id',$scheduleId])->all();
                if(!empty($allDropOffsSchedule)) {
                    foreach($allDropOffsSchedule as $dropOff) {
                       
                        $modelTbluserrides = new Tbluserrides();
                        $modelTbluserrides->user_id = $user_id;
                        $modelTbluserrides->schedule_id = $scheduleId;
                        $modelTbluserrides->drop_location_id = $dropOff['id'];
                        $modelTbluserrides->created_at = time();
                        $modelTbluserrides->updated_at = time();
                        $modelTbluserrides->save(false);        
                    }
                }
            }
            $searchModel = new UsersSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->where("type='1'")->orderBy(['updated_at'=>SORT_DESC , 'created_at'=>SORT_DESC])->all();
            //$dataProvider->query->joinWith(['tbluserridess','tbluserridess.dropLocation','tbluserridess.schedule.tblriderelation']);
            
            return $this->render('driver', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelridesschedule' => $modelridesschedule,
            'modelrides' => $modelrides,
            'ridesArray' => $ridesArray,
            'schedulesArray' => $schedulesArray,
            'modelschedule' => $modelschedule,
            'selectedSchduleId' => $selectedSchduleId 
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['driver']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
 