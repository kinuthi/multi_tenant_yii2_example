<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property integer $id_empresa
 * @property string $rut
 * @property string $nombre
 * @property string $giro
 * @property string $razon_social
 * @property string $representante
 * @property string $correo
 * @property string $nro_contacto
 * @property string $db_name
 * @property string $db_password
 * @property string $db_username
 *
 * @property Contrato[] $contratos
 * @property Paciente[] $pacientes
 * @property Usuario[] $usuarios
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rut', 'nombre', 'giro', 'razon_social', 'representante', 'correo', 'nro_contacto'], 'required'],
            [['rut'], 'string', 'max' => 16],
            [['nombre', 'giro', 'razon_social'], 'string', 'max' => 200],
            [['representante', 'correo', 'db_name', 'db_username'], 'string', 'max' => 100],
            [['nro_contacto'], 'string', 'max' => 20],
            [['db_password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_empresa' => 'Id Empresa',
            'rut' => 'Rut',
            'nombre' => 'Nombre',
            'giro' => 'Giro',
            'razon_social' => 'Razon Social',
            'representante' => 'Representante',
            'correo' => 'Correo',
            'nro_contacto' => 'Nro Contacto',
            'db_name' => 'Db Name',
            'db_password' => 'Db Password',
            'db_username' => 'Db Username',
        ];
    }

    public static function getDb(){
        return Yii::$app->get('db_master');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contrato::className(), ['id_empresa' => 'id_empresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacientes()
    {
        return $this->hasMany(Paciente::className(), ['id_empresa' => 'id_empresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['id_empresa' => 'id_empresa']);
    }
}
