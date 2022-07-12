<?php

use yii\db\Migration;

/**
 * Class m220710_183246_create_table_event
 */
class m220710_183246_create_table_event extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('evento', [
            'id' =>  $this->primaryKey(),
            'nome' => $this->string(),
            'ativo' => $this->tinyInteger()->defaultValue(true),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('event');
    }

}
