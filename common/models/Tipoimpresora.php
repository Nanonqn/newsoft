<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoimpresora".
 *
 * @property integer $idTipoImpresora
 * @property string $tipoImpresoraNombre
 *
 * @property Impresora[] $impresoras
 */
class Tipoimpresora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoimpresora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipoImpresoraNombre'], 'required'],
            [['tipoImpresoraNombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoImpresora' => 'ID',
            'tipoImpresoraNombre' => 'Tipo de Impresora',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImpresoras()
    {
        return $this->hasMany(Impresora::className(), ['tipoImpresora_id' => 'idTipoImpresora']);
    }
}
