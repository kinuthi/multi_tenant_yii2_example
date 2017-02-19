<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ocupacion".
 *
 * @property integer $id_ocupacion
 * @property string $nombre
 */
class Ocupacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ocupacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ocupacion' => 'Id Ocupacion',
            'nombre' => 'Nombre',
        ];
    }
}
