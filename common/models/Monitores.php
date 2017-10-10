<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "monitores".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $fechaCompra
 * @property string $creado
 * @property string $actualizado
 * @property string $proveedores_id
 * @property string $marcas_id
 *
 * @property Marcas $marcas
 * @property Proveedores $proveedores
 */
class Monitores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'monitores';
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
            [['descripcion', 'fechaCompra', 'proveedores_id', 'marcas_id'], 'required'],
            [['descripcion'], 'string'],
            [['fechaCompra', 'creado', 'actualizado'], 'safe'],
            [['proveedores_id', 'marcas_id'], 'integer'],
            [['marcas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Marcas::className(), 'targetAttribute' => ['marcas_id' => 'id']],
            [['proveedores_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedores::className(), 'targetAttribute' => ['proveedores_id' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
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

    public function beforeValidate()
    {
        if ($this->fechaCompra != null) {
            $nuevo_formato_fecha = date('Y-m-d', strtotime($this->fechaCompra));
            $this->fechaCompra = $nuevo_formato_fecha;
        }
        return parent::beforeValidate();
    }
}
