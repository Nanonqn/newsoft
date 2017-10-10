<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Insumos;

/**
 * InsumosSearch represents the model behind the search form about `common\models\Insumos`.
 */
class InsumosSearch extends Insumos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'proveedores_id', 'marcas_id', 'tipoInsumo_id'], 'integer'],
            [['descripcion', 'fechaCompra', 'creado', 'actualizado'], 'safe'],
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
        $query = Insumos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fechaCompra' => $this->fechaCompra,
            'creado' => $this->creado,
            'actualizado' => $this->actualizado,
            'proveedores_id' => $this->proveedores_id,
            'marcas_id' => $this->marcas_id,
            'tipoInsumo_id' => $this->tipoInsumo_id,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
