<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\db\Expression;
/**
 * This is the model class for table "puesto".
 *
 * @property string $id
 * @property string $nombre
 * @property string $creado
 * @property string $actualizado
 * @property string $sector_id
 */
class Puesto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'puesto';
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
            [['nombre', 'sector_id'], 'required'],
            [['creado', 'actualizado'], 'safe'],
            [['sector_id'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Puesto',
            'creado' => 'Creado',
            'actualizado' => 'Actualizado',
            'sector_id' => 'Sector',
        ];
    }

    public function getSector()
    {
        return $this->hasOne(Sector::className(),['id' => 'sector_id']);
    }

    /*
     * get nombre sector
     */
    public function getSectorNombre()
    {
        return $this->sector ? $this->sector->nombre : 'ninguno';
    }

    /*
     * get lista de sectores
     */
    public static function getSectorLista()
    {
        $dropciones = Sector::find()->asArray()->all();
        return ArrayHelper::map($dropciones, 'id', 'nombre');
    }
}
