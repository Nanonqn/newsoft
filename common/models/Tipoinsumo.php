<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoinsumo".
 *
 * @property string $id
 * @property string $tipoInsumoNombre
 *
 * @property Insumos[] $insumos
 */
class Tipoinsumo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoinsumo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipoInsumoNombre'], 'required'],
            [['tipoInsumoNombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipoInsumoNombre' => 'Tipo de Insumo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsumos()
    {
        return $this->hasMany(Insumos::className(), ['tipoInsumo_id' => 'id']);
    }
}
