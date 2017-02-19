<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "examen".
 *
 * @property integer $id_examen
 * @property integer $id_tipo_examen
 * @property string $descripcion
 */
class Examen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'examen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_examen'], 'integer'],
            [['descripcion'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_examen' => 'Id Examen',
            'id_tipo_examen' => 'Id Tipo Examen',
            'descripcion' => 'Descripcion',
        ];
    }
}
