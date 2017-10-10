<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoaccesorios".
 *
 * @property string $id
 * @property string $accesorio
 */
class Tipoaccesorios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoaccesorios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['accesorio'], 'required'],
            [['accesorio'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'accesorio' => 'Tipo de Accesorio',
        ];
    }

    public function getAccesorios()
    {
        return $this->hasMany(Accesorios::className(),['id' => 'id']);
    }
}
