<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $id
 * @property string $rut
 * @property string $nombres
 * @property string $apellidos
 * @property string $correo
 * @property string $username
 * @property string $password
 * @property string $profesion
 * @property string $direccion
 * @property string $telefono
 * @property string $imagen
 * @property integer $id_empresa
 * @property string $accessToken
 * @property string $authKey
 *
 * @property Empresa $idEmpresa
 * @property UsuarioPermiso[] $usuarioPermisos
 * @property Permiso[] $idPermisos
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_master');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rut', 'nombres', 'apellidos', 'correo', 'username', 'password', 'profesion', 'direccion', 'id_empresa'], 'required'],
            [['id_empresa'], 'integer'],
            [['rut'], 'string', 'max' => 16],
            [['nombres', 'apellidos'], 'string', 'max' => 200],
            [['correo', 'username', 'profesion', 'direccion'], 'string', 'max' => 100],
            [['password', 'imagen', 'accessToken', 'authKey'], 'string', 'max' => 255],
            [['telefono'], 'string', 'max' => 20],
            [['id_empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_empresa' => 'id_empresa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rut' => 'Rut',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'correo' => 'Correo',
            'username' => 'Username',
            'password' => 'Password',
            'profesion' => 'Profesion',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'imagen' => 'Imagen',
            'id_empresa' => 'Id Empresa',
            'accessToken' => 'Access Token',
            'authKey' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id_empresa' => 'id_empresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioPermisos()
    {
        return $this->hasMany(UsuarioPermiso::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPermisos()
    {
        return $this->hasMany(Permiso::className(), ['id_permiso' => 'id_permiso'])->viaTable('usuario_permiso', ['id_usuario' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {

        /*        $user = Usuario::find()->where(['nombre_usuario' => $username])->one();

                if($user){

                    $empresa = $user->getIdEmpresa()->one();

                    $usuario = new User();
                    $usuario->username = $user->nombre_usuario;
                    $usuario->id = ''.$user->id_usuario;
                    $usuario->password = $user->password;
                    $usuario->authKey = (isset($user->authKey)) ? $user->authKey : '';
                    $usuario->accessToken = (isset($user->accessToken)) ? $user->accessToken : '';
                    $usuario->db_name = (isset($empresa->db_name)) ? $empresa->db_name : '';
                    $usuario->db_username = (isset($empresa->db_username)) ? $empresa->db_username : '';
                    $usuario->db_password = (isset($empresa->db_password)) ? $empresa->db_password : '';

                    return new static($usuario);
                }*/

        /*foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }*/

        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function getDBName()
    {
        return $this->db_name;
    }

    public function getDBUsername()
    {
        return $this->db_username;
    }

    public function getDBPassword()
    {
        return $this->db_password;
    }
}
