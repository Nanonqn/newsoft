<?php

namespace backend\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "estadomensaje".
 *
 * @property integer $id
 * @property string $controladorNombre
 * @property string $accionNombre
 * @property string $estadoMensajeNombre
 * @property string $asunto
 * @property string $cuerpo
 * @property string $estadoMensajeDescripcion
 * @property string $created_at
 * @property string $updated_at
 */
class Estadomensaje extends \yii\db\ActiveRecord
{
	
	public function behaviors()
	{
		return [
				'timestamp' => [
						'class' => 'yii\behaviors\TimestampBehavior',
						'attributes' => [
								ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
								ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
						],
						'value' => new Expression('NOW()'),
				],
		];
	}
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estadomensaje';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['controladorNombre', 'accionNombre', 'estadoMensajeNombre', 'asunto', 'cuerpo', 'estadoMensajeDescripcion'], 'required'],
            [['cuerpo'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['controladorNombre', 'accionNombre', 'estadoMensajeNombre', 'estadoMensajeDescripcion'], 'string', 'max' => 100],
            [['asunto'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'controladorNombre' => 'Controlador Nombre',
            'accionNombre' => 'Accion Nombre',
            'estadoMensajeNombre' => 'Estado Mensaje Nombre',
            'asunto' => 'Asunto',
            'cuerpo' => 'Cuerpo',
            'estadoMensajeDescripcion' => 'Estado Mensaje Descripcion',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
