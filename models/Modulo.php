<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modulo".
 *
 * @property integer $id_modulo
 * @property string $nombre
 * @property string $descripcion
 * @property integer $precio_unitario
 * @property integer $id_config_mod
 *
 * @property ContratoModulo[] $contratoModulos
 * @property ConfigMod $idConfigMod
 */
class Modulo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modulo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'id_config_mod'], 'required'],
            [['descripcion'], 'string'],
            [['precio_unitario', 'id_config_mod'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['id_config_mod'], 'exist', 'skipOnError' => true, 'targetClass' => ConfigMod::className(), 'targetAttribute' => ['id_config_mod' => 'id_config_mod']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_modulo' => 'Id Modulo',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'precio_unitario' => 'Precio Unitario',
            'id_config_mod' => 'Id Config Mod',
        ];
    }

    public static function getDb(){
        return Yii::$app->db_master;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratoModulos()
    {
        return $this->hasMany(ContratoModulo::className(), ['id_modulo' => 'id_modulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdConfigMod()
    {
        return $this->hasOne(ConfigMod::className(), ['id_config_mod' => 'id_config_mod']);
    }
}
