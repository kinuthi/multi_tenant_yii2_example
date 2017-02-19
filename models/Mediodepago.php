<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mediodepago".
 *
 * @property integer $id
 * @property string $nombreMP
 * @property integer $valorOPorcentaje
 */
class Mediodepago extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mediodepago';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombreMP', 'valorOPorcentaje'], 'required'],
            [['valorOPorcentaje'], 'integer'],
            [['nombreMP'], 'string', 'max' => 75],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombreMP' => 'Nombre Mp',
            'valorOPorcentaje' => 'Valor Oporcentaje',
        ];
    }
}
