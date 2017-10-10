<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "estado".
 *
 * @property integer $id
 * @property string $nombreEstado
 * @property integer $valorEstado
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombreEstado', 'valorEstado'], 'required'],
            [['valorEstado'], 'integer'],
            [['nombreEstado'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombreEstado' => 'Nombre Estado',
            'valorEstado' => 'Valor Estado',
        ];
    }
    
    public function getUsers()
    {
    	return $this->hasMany(User::className(), ['estado_id' =>'id' ]);
    }
}
