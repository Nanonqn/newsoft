<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoconectividad".
 *
 * @property string $id
 * @property string $conectividad
 */
class Tipoconectividad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoconectividad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['conectividad'], 'required'],
            [['conectividad'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'conectividad' => 'Conectividad',
        ];
    }

    public function getConectividad()
    {
        return $this->hasMany(Conectividad::className(),['id' => 'tipoConectividad_id']);
    }
}
