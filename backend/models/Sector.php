<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "sector".
 *
 * @property string $id
 * @property string $nombre
 * @property string $direccion
 * @property string $creado
 * @property string $actualizado
 */
class Sector extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sector';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['creado', 'actualizado'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['actualizado'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'direccion'], 'required'],
            [['creado', 'actualizado'], 'safe'],
            [['nombre', 'direccion'], 'string', 'max' => 100],
            [['nombre'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Sector',
            'direccion' => 'Dirección',
            'creado' => 'Creado',
            'actualizado' => 'Actualizado',
        ];
    }
}
