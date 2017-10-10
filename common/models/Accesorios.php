<?php

namespace common\models;


use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "accesorios".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $fechaCompra
 * @property string $creado
 * @property string $actualizado
 * @property string $proveedores_id
 * @property string $marcas_id
 * @property integer $tipoAccesorio_id
 */
class Accesorios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accesorios';
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
            [['descripcion', 'fechaCompra', 'proveedores_id', 'marcas_id', 'tipoAccesorio_id'], 'required'],
            [['descripcion'], 'string'],
            [['fechaCompra', 'creado', 'actualizado'], 'safe'],
            [['proveedores_id', 'marcas_id', 'tipoAccesorio_id'], 'integer'],
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
            'proveedores_id' => 'Proveedor',
            'marcas_id' => 'Marca',
            'tipoAccesorio_id' => 'Tipo de Accesorio',
        ];
    }

    public function getMarcas()
    {
        return $this->hasOne(Marcas::className(), ['id' => 'marcas_id']);
    }

    /*
     * get Nombre de Marcas
     */
    public function getMarcasNombre()
    {
        return $this->marcas ? $this->marcas->marca : '-ninguna-';
    }

    /*
     * get Lista de Marcas
     */
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

    /*
     * get Nombre Proveedores
     */
    public function getProveedoresNombre()
    {
        return $this->proveedores ? $this->proveedores->razonSocial : '-ninguno-';
    }

    /*
     * get Lista de Proveedores
     */
    public static function getProveedoresLista()
    {
        $dropciones = Proveedores::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'id','razonSocial');
    }

    public function getTipoAccesorios()
    {
        return $this->hasOne(Tipoaccesorios::className(), ['id' => 'tipoAccesorio_id']);
    }

    public function getTipoAccesoriosNombre()
    {
        return $this->tipoAccesorios ? $this->tipoAccesorio->accesorio : '-sin tipo-';
    }

    public static function getTipoAccesoriosLista()
    {
        $dropciones = Tipoaccesorios::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'id','accesorio');
    }

    /*public function beforeValidate()
    {
        if ($this->fechaCompra != null) {
            $nuevo_formato_fecha = date('Y-m-d', strtotime($this->fechaCompra));
            $this->fechaCompra= $nuevo_formato_fecha;
        }
        return parent::beforeValidate();
    }*/
}
