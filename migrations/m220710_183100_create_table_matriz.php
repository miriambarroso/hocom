<?php

use yii\db\Migration;

/**
 * Class m220710_183100_create_table_matriz
 */
class m220710_183100_create_table_matriz extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('matriz', [
            'id' =>  $this->primaryKey(),
            'nome' => $this->string(),
            'ano' => $this->smallInteger(),
            'semestre' => $this->smallInteger(),
            'carga_horaria' => $this->smallInteger(),
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
        $this->dropTable('matriz');
    }

}