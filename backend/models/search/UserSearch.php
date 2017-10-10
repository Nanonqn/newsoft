<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
	/**
	 *attributes 
	 */
	
	public $rolNombre;
	public $tipoUsuarioNombre;
	public $tipo_usuario_nombre;
	public $tipo_usuario_id;
	public $estadoNombre;
	public $perfilId;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rol_id', 'estado_id', 'tipoUsuario_id'], 'integer'],
        	[['username', 'email', 'created_at', 'updated_at','rolNombre','estadoNombre','tipoUsuarioNombre','perfilId',
        		'tipoUsuarioNombre'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
    	$query = User::find();
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    	]);
    	/**
    	 * Setup your sorting attributes
    	 * Note: This is setup before the $this->load($params)
    	 * statement below
    	 */
    	$dataProvider->setSort([
    			'attributes' => [
    					'id',
    					'userIdLink' => [
    							'asc' => ['user.id' => SORT_ASC],
    							'desc' => ['user.id' => SORT_DESC],
    							'label' => 'User'
    					],
    					'userLink' => [
    							'asc' => ['user.username' => SORT_ASC],
    							'desc' => ['user.username' => SORT_DESC],
    							'label' => 'User'
    					],
    					'perfilLink' => [
    							'asc' => ['perfil.id' => SORT_ASC],
    							'desc' => ['perfil.id' => SORT_DESC],
    							'label' => 'Perfil'
    					],
    					'rolNombre' => [
    							'asc' => ['rol.nombreRol' => SORT_ASC],
    							'desc' => ['rol.nombreRol' => SORT_DESC],
    							'label' => 'Rol'
    					],
    					'estadoNombre' => [
    							'asc' => ['estado.nombreEstado' => SORT_ASC],
    							'desc' => ['estado.nombreEstado' => SORT_DESC],
    							'label' => 'Estado'
    					],
    					'tipoUsuarioNombre' => [
    							'asc' => ['tipoUsuario.nombreTipoUsuario' => SORT_ASC],
    							'desc' => ['tipoUsuario.nombreTipoUsuario' => SORT_DESC],
    							'label' => 'Tipo Usuario'
    					],
    					'created_at' => [
    							'asc' => ['created_at' => SORT_ASC],
    							'desc' => ['created_at' => SORT_DESC],
    							'label' => 'Created At'
    					],
    					'email' => [
    							'asc' => ['email' => SORT_ASC],
    							'desc' => ['email' => SORT_DESC],
    							'label' => 'Email'
    					],
    			]
    	]);
    	if (!($this->load($params) && $this->validate())) {
    		$query->joinWith(['rol'])
    		->joinWith(['estado'])
    		->joinWith(['perfil'])
    		->joinWith(['tipoUsuario']);
    		return $dataProvider;
    	}
    	$this->addSearchParameter($query, 'id');
    	$this->addSearchParameter($query, 'username', true);
    	$this->addSearchParameter($query, 'email', true);
    	$this->addSearchParameter($query, 'rol_id');
    	$this->addSearchParameter($query, 'estado_id');
    	$this->addSearchParameter($query, 'tipo_usuario_id');
    	$this->addSearchParameter($query, 'created_at');
    	$this->addSearchParameter($query, 'updated_at');
    	// filtrar por rol
    	$query->joinWith(['rol' => function ($q) {
    		$q->andFilterWhere(['=', 'rol.nombreRol', $this->rolNombre]);
    	}])
    	// filtrar por estado
    		->joinWith(['estado' => function ($q) {
    			$q->andFilterWhere(['=', 'estado.nombreEstado', $this->estadoNombre]);
    		}])
    		// filtrar por tipo usuario
    			->joinWith(['tipoUsuario' => function ($q) {
    				$q->andFilterWhere(['=', 'tipoUsuario.nombreTipoUsuario',
    						$this->tipoUsuarioNombre]);
    			}])
    			// filtrar por perfil
    				->joinWith(['perfil' => function ($q) {
    					$q->andFilterWhere(['=', 'perfil.id', $this->perfilId]);
    				}]);
    					return $dataProvider;
    }
    protected function addSearchParameter($query, $attribute, $partialMatch = false)
    {
    	if (($pos = strrpos($attribute, '.')) !== false) {
    		$modelAttribute = substr($attribute, $pos + 1);
    	} else {
    		$modelAttribute = $attribute;
    	}
    	$value = $this->$modelAttribute;
    	if (trim($value) === '') {
    		return;
    	}
    	/*
    	 * The following line is additionally added for right aliasing
    	 * of columns so filtering happen correctly in the self join
    	 */
    	$attribute = "user.$attribute";
    	if ($partialMatch) {
    		$query->andWhere(['like', $attribute, $value]);
    	} else {
    		$query->andWhere([$attribute => $value]);
    	}
    }
}
