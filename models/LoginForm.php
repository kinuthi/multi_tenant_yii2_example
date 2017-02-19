<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Connection;
use yii\web\Application;


/**
 * LoginForm is the model behind the login form.
 *
 * @property Usuario|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
           // die(var_dump($user));
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {


            //Credenciales de acceso a la base de datos
            $user = $this->getUser();
            Yii::$app->session->set('login', true);
            Yii::$app->session->set('client_connection.dsn', 'mysql:host=127.0.0.1;dbname='.$user->getIdEmpresa()->one()->db_name);
            Yii::$app->session->set('client_connection.username', $user->getIdEmpresa()->one()->db_username);
            Yii::$app->session->set('client_connection.password', $user->getIdEmpresa()->one()->db_password);

            //Yii::$app->db->isActive = false;

          /*  if (Yii::$app->getSession()) {
                if (Yii::$app->session->get('login', false)) {

                        Yii::$app->set('db_client', [
                            'class' => 'yii\db\Connection',
                            'dsn' => Yii::$app->session->get('client_connection.dsn'),
                            'username' => Yii::$app->session->get('client_connection.username'),
                            'password' => Yii::$app->session->get('client_connection.password'),
                            'charset' => 'utf8',
                        ]);
                        //die('<pre>'.print_r($_SESSION['app_config']).'</pre>');
    /*                    $_SESSION['app_config']['components']['db_client']  = [
                            'class' => 'yii\db\Connection',
                            'dsn' => Yii::$app->session->get('client_connection.dsn'),
                            'username' => Yii::$app->session->get('client_connection.username'),
                            'password' => Yii::$app->session->get('client_connection.password'),
                            'charset' => 'utf8',
                        ];*/


                    /*    ini_set('memory_limit', '-1');
                        $_SESSION['app'] =  (new Application($_SESSION['app_config']))->run();

                }
            }*/


            //Yii::$app->db->isActive = true;
            $login = Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);

            return $login;

        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Usuario|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuario::findByUsername($this->username);
        }
        //die(var_dump($this->_user));
        return $this->_user;
    }
}
