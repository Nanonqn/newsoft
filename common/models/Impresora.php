<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "impresora".
 *
 * @property integer $idImpresora
 * @property string $descripcion
 * @property string $fechaCompra
 * @property string $creado
 * @property string $actualizado
 * @property string $marcas_id
 * @property string $proveedores_id
 * @property integer $tipoImpresora_id
 *
 * @property Marcas $marcas
 * @property Proveedores $proveedores
 * @property Tipoimpresora $tipoImpresora
 */
class Impresora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'impresora';
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
            [['descripcion', 'fechaCompra', 'marcas_id', 'proveedores_id', 'tipoImpresora_id'], 'required'],
            [['descripcion'], 'string'],
            [['fechaCompra', 'creado', 'actualizado'], 'safe'],
            [['marcas_id', 'proveedores_id', 'tipoImpresora_id'], 'integer'],
            [['marcas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Marcas::className(), 'targetAttribute' => ['marcas_id' => 'id']],
            [['proveedores_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedores::className(), 'targetAttribute' => ['proveedores_id' => 'id']],
            [['tipoImpresora_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoimpresora::className(), 'targetAttribute' => ['tipoImpresora_id' => 'idTipoImpresora']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idImpresora' => 'ID',
            'descripcion' => 'Descripción',
            'fechaCompra' => 'Fecha de Compra',
            'creado' => 'Creado',
            'actualizado' => 'Actualizado',
            'marcas_id' => 'Marca',
            'proveedores_id' => 'Proveedor',
            'tipoImpresora_id' => 'Tipo de Impresora',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarcas()
    {
        return $this->hasOne(Marcas::className(), ['id' => 'marcas_id']);
    }

    public function getMarcaNombre()
    {
        return $this->marcas ? $this->marcas->marca : '-ninguna marca.';
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
        return $this->proveedores ? $this->proveedores->razonSocial : '-ningun proveedor.';
    }

    public static function getProveedoresLista()
    {
        $dropciones = Proveedores::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'id','razonSocial');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoImpresora()
    {
        return $this->hasOne(Tipoimpresora::className(), ['idTipoImpresora' => 'tipoImpresora_id']);
    }

    public function getTipoImpresoraNombre()
    {
        return $this->tipoImpresora ? $this->tipoImpresora->tipoImpresoraNombre : '-ningun tipo.';
    }

    public static function getTipoImpresoraLista()
    {
        $dropciones = Tipoimpresora::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'idTipoImpresora','tipoImpresoraNombre');
    }
}
