<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Tblridesschedule;
use frontend\models\TblridesscheduleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TblridesscheduleController implements the CRUD actions for Tblridesschedule model.
 */
class TblridesscheduleController extends Controller
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
     * Lists all Tblridesschedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblridesscheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblridesschedule model.
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
     * Creates a new Tblridesschedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tblridesschedule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tblridesschedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tblridesschedule model.
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
     * Finds the Tblridesschedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tblridesschedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tblridesschedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLists($id){
        $countridesschedule = Tblridesschedule::find()
            ->where(['ride_id' => $id])
            ->count();

         $userridesschedule = Tblridesschedule::find()
            ->where(['ride_id' => $id])
            ->all();
        $html = '';    
        if($countridesschedule > 0){
            foreach($userridesschedule as $userrideschedule){
                $html .= "<option value='".$userrideschedule->id."'>".$userrideschedule->start_time." - ".$userrideschedule->end_time."</option>";
            }
        }else{
            $html .= "<option> -- </option>";
        }
        return $html;
    }
}
