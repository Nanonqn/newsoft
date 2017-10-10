<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "insumos".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $fechaCompra
 * @property string $creado
 * @property string $actualizado
 * @property string $proveedores_id
 * @property string $marcas_id
 * @property string $tipoInsumo_id
 *
 * @property Marcas $marcas
 * @property Proveedores $proveedores
 * @property Tipoinsumo $tipoInsumo
 */
class Insumos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insumos';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['creado','actualizado'],
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
            [['descripcion', 'fechaCompra', 'proveedores_id', 'marcas_id', 'tipoInsumo_id'], 'required'],
            [['descripcion'], 'string'],
            [['fechaCompra', 'creado', 'actualizado'], 'safe'],
            [['proveedores_id', 'marcas_id', 'tipoInsumo_id'], 'integer'],
            [['marcas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Marcas::className(), 'targetAttribute' => ['marcas_id' => 'id']],
            [['proveedores_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedores::className(), 'targetAttribute' => ['proveedores_id' => 'id']],
            [['tipoInsumo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoinsumo::className(), 'targetAttribute' => ['tipoInsumo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripción',
            'fechaCompra' => 'Fecha de Compra',
            'creado' => 'Creado',
            'actualizado' => 'Actualizado',
            'proveedores_id' => 'Proveedore',
            'marcas_id' => 'Marca',
            'tipoInsumo_id' => 'Tipo de Insumo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarcas()
    {
        return $this->hasOne(Marcas::className(), ['id' => 'marcas_id']);
    }

    public function getMarcasNombre()
    {
        return $this->marcas ? $this->marcas->marca : '-ninguna';
    }

    public static function getMarcasLista()
    {
        $dropciones = Marcas::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'id','marca');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedores()
    {
        return $this->hasOne(Proveedores::className(), ['id' => 'proveedores_id']);
    }

    public function getProveedoresNombre()
    {
        return $this->proveedores ? $this->proveedores->razonSocial : '-ninguno.';
    }

    public static function getProveedoresLista()
    {
        $dropciones = Proveedores::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'id','razonSocial');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoInsumo()
    {
        return $this->hasOne(Tipoinsumo::className(), ['id' => 'tipoInsumo_id']);
    }

    public function getTipoInsumoNombre()
    {
        return $this->tipoInsumo ? $this->tipoInsumo->tipoInsumoNombre : '-ninguno.';
    }

    public static function getTipoInsumoLista()
    {
        $dropciones = Tipoinsumo::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'id','tipoInsumoNombre');
    }
}
