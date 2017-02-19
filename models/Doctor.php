<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doctor".
 *
 * @property integer $id
 * @property string $nombres
 * @property string $apellidoP
 * @property string $apellidoM
 * @property string $fechaNac
 * @property string $especialidad
 * @property string $correo
 */
class Doctor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidoP', 'apellidoM', 'fechaNac', 'especialidad', 'correo'], 'required'],
            [['fechaNac'], 'safe'],
            [['nombres'], 'string', 'max' => 50],
            [['apellidoP', 'apellidoM'], 'string', 'max' => 30],
            [['especialidad'], 'string', 'max' => 70],
            [['correo'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombres' => 'Nombres',
            'apellidoP' => 'Apellido P',
            'apellidoM' => 'Apellido M',
            'fechaNac' => 'Fecha Nac',
            'especialidad' => 'Especialidad',
            'correo' => 'Correo',
        ];
    }
}
