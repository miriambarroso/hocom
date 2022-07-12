<?php

use yii\db\Migration;

/**
 * Class m220711_144134_create_table_matriz_evento
 */
class m220711_144134_create_table_matriz_evento extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('matriz_evento', [
            'id' =>  $this->primaryKey(),
            'evento_id' => $this->integer(),
            'matriz_id' => $this->integer(),
            'carga_horaria_max' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);

        $this->addForeignKey(
            'fk_matriz_evento_evento_id',
            'matriz_evento',
            'evento_id',
            'evento',
            'id'
        );

        $this->addForeignKey(
            'fk_matriz_evento_matriz_id',
            'matriz_evento',
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
        $this->dropTable('matriz_evento');
    }

}
