<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Subevento]].
 *
 * @see Subevento
 */
class SubeventoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Subevento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Subevento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
