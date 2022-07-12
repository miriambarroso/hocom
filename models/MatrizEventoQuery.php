<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MatrizEvento]].
 *
 * @see MatrizEvento
 */
class MatrizEventoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MatrizEvento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MatrizEvento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
