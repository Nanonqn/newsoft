<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "marcas".
 *
 * @property string $id
 * @property string $marca
 * @property string $modelo
 * @property string $creado
 * @property string $actualizado
 *
 * @property Equipos[] $equipos
 * @property Monitores[] $monitores
 */
class Marcas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marcas';
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
            [['marca', 'modelo'], 'required'],
            [['creado', 'actualizado'], 'safe'],
            [['marca', 'modelo'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'creado' => 'Creado',
            'actualizado' => 'Actualizado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipos::className(), ['marcas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonitores()
    {
        return $this->hasMany(Monitores::className(), ['marcas_id' => 'id']);
    }

    public function getAccesorios()
    {
        return $this->hasMany(Accesorios::className(), ['proveedores_id' => 'id']);
    }
}
