<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MatrizSubevento]].
 *
 * @see MatrizSubevento
 */
class MatrizSubeventoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MatrizSubevento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MatrizSubevento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
