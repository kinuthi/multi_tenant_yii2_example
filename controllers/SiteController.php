<?php

namespace app\controllers;

use app\models\DbCreate;
use app\models\Empresa;
use app\models\Modulo;
use app\models\Usuario;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionPlanes()
    {
        return $this->render('planes');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    private function trim_value($arreglo)
    {
        $aux = [];
        for ($i = 0; $i < count($arreglo); $i++)
        {
            $aux[] = preg_replace('/\s+/', '', $arreglo[$i]);
        }

        return $aux;
    }

    public function actionContratar($plan)
    {
        $modulos = Modulo::find()->all();
        $empresa = new Empresa();
        $usuario = new Usuario();

        if(Yii::$app->request->post())
        {
            //die();
            $post = Yii::$app->request->post();

            //Empresa
            $empresa->nombre = $post['nombre_empresa'];
            $empresa->rut = $post['rut_empresa'];
            $empresa->giro = $post['giro_empresa'];
            $empresa->razon_social = $post['rs_empresa'];
            $empresa->representante = $post['representante_empresa'];
            $empresa->correo = $post['correo_empresa'];
            $empresa->nro_contacto = $post['numero_empresa'];
            $empresa->db_name = preg_replace('/\s+/', '', $empresa->nombre);
            $empresa->db_password = '';
            $empresa->db_username = 'root';
            //Modulos contratados
            $modulos = $post['modulos_contratados'];
            $arreglo = array_keys(array_change_key_case($modulos, CASE_LOWER));
            $mods = $this->trim_value($arreglo);


            $usuario->nombres = $post['nombre_usuario'];
            $usuario->apellidos = $post['nombre_usuario'];
            $usuario->rut = $post['rut_usuario'];
            $usuario->correo = $post['correo_usuario'];
            $usuario->username = $post['nick_usuario'];
            $usuario->password = $post['password_usuario'];

            $usuario->direccion = "Calle falsa 123";
            $usuario->profesion = "hablar weas";


            //Crear la base de datos (?)
            DbCreate::crear_base_de_datos($empresa->nombre);
            //Crear las tablas - Setear los modulos contratados
            DbCreate::crear_tablas($empresa->nombre, $mods);
            //die($empresa->rut);
            //die(var_dump(Yii::$app->db_master->getSchema()->getTableNames()));
            Yii::$app->db_master->createCommand("USE db_master")->execute();
            Yii::$app->db_master->createCommand("INSERT INTO db_master.empresa(
                      `rut`,
                      `nombre`,
                      `giro`,
                      `razon_social`,
                      `representante`,
                      `correo`,
                      `nro_contacto`,
                      `db_name`,
                      `db_password`,
                      `db_username`
            ) VALUES (
                      '$empresa->rut', 
                      '$empresa->nombre',
                      '$empresa->giro',
                      '$empresa->razon_social',
                      '$empresa->representante',
                      '$empresa->correo',
                      '$empresa->nro_contacto',
                      '$empresa->db_name',
                      '$empresa->db_password',
                      '$empresa->db_username' );"
            )->execute();

            $usuario->id_empresa = Yii::$app->db_master->getLastInsertID();
            $usuario->save();


            return $this->render('detalles_contrato', ['empresa' => $empresa, 'usuario' => $usuario]);
        }

        return $this->render('contratar', ['plan'=>$plan, 'modulos'=>$modulos, 'empresa' => $empresa]);
    }

}
