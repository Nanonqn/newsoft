<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "proveedores".
 *
 * @property string $id
 * @property string $razonSocial
 * @property string $direccion
 * @property double $telefono
 * @property string $email
 * @property string $web
 * @property string $creado
 * @property string $actualizado
 *
 * @property Equipos[] $equipos
 * @property Monitores[] $monitores
 */
class Proveedores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proveedores';
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
            [['razonSocial', 'telefono'], 'required'],
            [['telefono'], 'number'],
            [['creado', 'actualizado'], 'safe'],
            [['razonSocial', 'web'], 'string', 'max' => 100],
            [['direccion'], 'string', 'max' => 250],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            [['razonSocial'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'razonSocial' => 'Proveedor',
            'direccion' => 'Dirección',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'web' => 'Web',
            'creado' => 'Creado',
            'actualizado' => 'Actualizado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipos::className(), ['proveedores_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonitores()
    {
        return $this->hasMany(Monitores::className(), ['proveedores_id' => 'id']);
    }

    public function getAccesorios()
    {
        return $this->hasMany(Accesorios::className(), ['proveedores_id' => 'id']);
    }

    public function getConectividad()
    {
        return $this->hasMany(Conectividad::className(), ['proveedores_id' => 'id']);
    }
}
