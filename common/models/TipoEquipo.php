<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoequipo".
 *
 * @property string $id
 * @property string $tipoEquipoNombre
 *
 * @property Equipos[] $equipos
 */
class TipoEquipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoequipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipoEquipoNombre'], 'required'],
            [['tipoEquipoNombre'], 'string', 'max' => 100],
            [['tipoEquipoNombre'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipoEquipoNombre' => 'Tipo de Equipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipos::className(), ['tipoEquipo_id' => 'id']);
    }
}
