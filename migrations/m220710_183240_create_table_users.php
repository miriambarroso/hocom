<?php

use yii\db\Migration;

/**
 * Class m220710_183240_create_table_users
 */
class m220710_183240_create_table_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'matriz_id', $this->integer());
        $this->addColumn('user', 'role', "ENUM('gestor', 'estudante')");
        $this->alterColumn('user', 'username', $this->bigInteger());
        $this->createIndex('index_user_username', 'user', 'username', true);
        $this->addForeignKey(
            'fk_user_matriz_id',
            'user',
            'matriz_id',
            'matriz',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_matriz_id', 'user');
        $this->alterColumn('user', 'username', $this->string());
        $this->dropColumn('user', 'matriz_id');
        $this->dropColumn('user', 'role');
        $this->dropIndex('index_user_username', 'user');
    }

}