<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

/**
 * This is the model class for table "marketingimage".
 *
 * @property string $id
 * @property string $marketingImagePath
 * @property string $marketingImageName
 * @property string $marketingImageCaptionTitle
 * @property string $marketingImageCaption
 * @property string $marketingThumbPath
 * @property integer $marketingImageIsFeatured
 * @property integer $marketingImageIsActive
 * @property integer $marketingImageWeight
 * @property integer $status_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Status $status
 */
class Marketingimage extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marketingimage';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marketingImagePath','marketingImageName','marketingThumbPath','marketingImageWeight'],'required'],
            ['marketingImageWeight', 'default', 'value' => 100 ],
            ['marketingImageIsFeatured', 'default', 'value' => 0 ],
            ['marketingImageIsActive', 'default', 'value' => 0 ],
            ['file', 'required', 'message' =>'{attribute} can\'t be blank', 'on'=>'create'],
            [['marketingImageName', 'marketingImagePath'], 'trim'],
            [['marketingImageIsFeatured','marketingImageIsActive', 'marketingImageWeight','status_id'], 'integer'],
            [['marketingImageIsFeatured'],'in','range'=>array_keys($this->getMarketingImageIsFeaturedList())],
            [['marketingImageIsActive'],'in','range'=>array_keys($this->getMarketingImageIsActiveList())],
            [['file'], 'file', 'extensions' => ['png', 'jpg', 'gif'],'maxSize' => 1024*1024],
            [['marketingImagePath', 'marketing_image_name'],'string', 'max' => 45],
            [['marketingImageCaption', 'marketingImageCaptionTitle'],'string', 'max' => 100],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['file','marketingImagePath',
            'marketingImageName', 'marketingThumbPath',
            'marketingImageIsFeatured', 'marketingImageIsActive',
            'marketingImageCaption', 'marketingImageCaptionTitle',
            'marketingImageWeight' ];
        return $scenarios;
    }

    public function beforeValidate()
    {
        $this->marketingImageName = preg_replace('/\s+/','',$this->marketingImageName);
        $this->marketingImagePath = preg_replace('/\s+/','',$this->marketingImagePath);

        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'marketingImagePath' => 'Ruta Imagen',
            'marketingImageName' => 'Nombre Imagen',
            'marketingImageCaption' => 'Caption',
            'marketingImageCaptionTitle' => 'Caption Title',
            'marketingThumbPath' => 'Marketing thumb Path',
            'marketingImageIsFeatured' => 'Destacada?',
            'marketingImageIsActive' => 'Activa?',
            'marketingImageWeight' => 'Importancia',
            'status_id' => 'ID Estado',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
            'file' => 'Archivo',
            'status_name' => Yii::t('app', 'Estado'),
        ];
    }

    public static function getMarketingImageIsFeaturedList()
    {
        return $dropciones = [0 => "No", 1 => "Si"];
    }

    public static function getMarketingImageIsActiveList()
    {
        return $dropciones = [0 => "No", 1 => "Si"];
    }

    public function getStatus()
    {
        return $this->hasOne(Status::className(),['id' => 'status_id']);
    }

    public function getStatusName()
    {
        return $this->status ? $this->status->status_name : '-no status-';
    }

    public static function getStatusList()
    {
        $dropciones = Status::find()->asArray()->all();
        return ArrayHelper::map($dropciones,'id','status_name');
    }

    public function getThumb()
    {
        $image = Html::img('/'.$this->marketingThumbPath);
        return Html::a($image, ['view','id' => $this->id]);
    }
}
