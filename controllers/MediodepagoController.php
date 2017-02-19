<?php

namespace app\controllers;

use Yii;
use app\models\Mediodepago;
use app\models\MediodepagoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MediodepagoController implements the CRUD actions for Mediodepago model.
 */
class MediodepagoController extends Controller
{
    /**
     * @inheritdoc
     */
    /*public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/
    public function behaviors()
    {
        $modulo = Yii::$app->db->createCommand("SELECT * FROM config_modulos WHERE config_modulos.name='$this->id';")->query()->read();
        //ver si esta activado o desactivado el modulo
        if($modulo['state'] == 0){
            return [
                'access' => [
                    'class' => \yii\filters\AccessControl::className(),
                    'only' => ['*'],
                    'rules' => [
                        // deny all POST requests
                        [
                            'allow' => false,
                            'verbs' => ['GET', 'POST']
                        ],
                        // allow authenticated users
                        [
                            'allow' => false,
                            'roles' => ['@'],
                        ],
                        // everything else is denied
                    ],
                ],
            ];
        }else{
            return [];
        }
    }

    /**
     * Lists all Mediodepago models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MediodepagoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mediodepago model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mediodepago model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mediodepago();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Mediodepago model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mediodepago model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mediodepago model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mediodepago the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mediodepago::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
