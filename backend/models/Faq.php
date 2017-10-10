<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\User;

/**
 * This is the model class for table "faq".
 *
 * @property integer $id
 * @property string $faqQuestion
 * @property string $faqAnswer
 * @property integer $faqIsFeatured
 * @property integer $faqCategory_id
 * @property integer $faqWeight
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Faqcategory $faqCategory
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faqQuestion', 'faqAnswer', 'faqCategory_id'], 'required'],
            [['faqIsFeatured', 'faqCategory_id', 'faqWeight', 'created_by', 'updated_by'], 'integer'],
            [['faqWeight'],'in','range'=>range(1,100)],
        	['faqWeight','default','value'=>100],
        	[['created_at', 'updated_at'], 'safe'],
            [['faqQuestion'], 'string', 'max' => 255],
        	['faqQuestion','unique'],
            [['faqAnswer'], 'string', 'max' => 1055],
            [['faqCategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faqcategory::className(), 'targetAttribute' => ['faqCategory_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faqQuestion' => 'Pregunta',
            'faqAnswer' => 'Respuesta',
            'faqIsFeatured' => 'Destacada',
            'faqCategory_id' => 'Categoria',
            'faqWeight' => 'Importancia',
            'created_by' => 'Creada Por',
            'updated_by' => 'Actualizada Por',
            'created_at' => 'Creada',
            'updated_at' => 'Actualizada',
        	'faqCategoryName' => Yii::t('app','Categpria'),
        	'faqCategoryList' => Yii::t('app', 'Categoria'),
        	'faqIsFeaturedName' => Yii::t('app', 'Destacada'),
        	'createdByUserName' => Yii::t('app', 'Creada Por'),
        	'updatedByUserName' => Yii::t('app', 'Actualizada Por'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaqCategory()
    {
        return $this->hasOne(Faqcategory::className(), ['id' => 'faqCategory_id']);
    }
    
    public function getFaqCategoryName()
    {
    	return $this->faqCategory->faqCategoryName;
    }
    
    public static function getFaqCategoryList()
    {
    	$dropciones = FaqCategory::find()->asArray()->all();
    	return ArrayHelper::map($dropciones,'id','faqCategoryName');
    }
    
    public static function getFaqIsFeaturedList()
    {
    	return $dropciones = [0 => "No", 1 => "Si"];
    }
    
    public function getFaqIsFeaturedName()
    {
    	return $this->faqIsFeatured == 0 ? "No" : "Si";
    }
    
    public function getCreatedByUser()
    {
    	return $this->hasOne(User::className(), ['id'=>'created_by']);
    }
    
    public function getCreatedByUsername()
    {
    	return $this->createdByUser ? $this->createdByUser->username : '-no es usuario-';
    }
    
    public function getUpdatedByUser()
    {
    	return $this->hasOne(User::className(), ['id'=>'updated_by']);
    }
    
    public function getUpdatedByUsername()
    {
    	return $this->updatedByUser ? $this->updatedByUser->username : '-no es usuario-';
    }

    public static function getFaqRatings($id)
    {
        $rating = new FaqRating;
        return $rating->getAverageRating($id) ?
            $rating->getAverageRating($id) : 'Not Rated' ;
    }
}