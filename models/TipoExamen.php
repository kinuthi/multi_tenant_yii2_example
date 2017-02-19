<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_examen".
 *
 * @property integer $id_tipo_examen
 * @property string $nombre
 * @property string $descripcion
 */
class TipoExamen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_examen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_examen' => 'Id Tipo Examen',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }
}
