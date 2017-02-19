<?php

namespace app\controllers;

use Yii;
use app\models\Ocupacion;
use app\models\OcupacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OcupacionController implements the CRUD actions for Ocupacion model.
 */
class OcupacionController extends Controller
{
    /**
     * @inheritdoc
     */
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
     * Lists all Ocupacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OcupacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ocupacion model.
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
     * Creates a new Ocupacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ocupacion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_ocupacion]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ocupacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_ocupacion]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ocupacion model.
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
     * Finds the Ocupacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ocupacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ocupacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
