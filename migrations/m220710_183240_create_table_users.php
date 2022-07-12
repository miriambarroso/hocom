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
        $this->createTable('users', [
            'id' =>  $this->primaryKey(),
            'username' => $this->bigInteger()->unique(),
            'role' => "ENUM('gestor', 'estudante')",
            'password' => $this->string(),
            'matriz_id' => $this->integer(),
            'auth_key' => $this->string(),
            'ativo' => $this->tinyInteger()->defaultValue(true),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);

        $this->addForeignKey(
            'fk_users_matriz_id',
            'users',
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
        $this->dropTable('users');
    }

}