<?php

use yii\db\Migration;

/**
 * Class m220711_144208_create_table_matriz_subevento
 */
class m220711_144208_create_table_matriz_subevento extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('matriz_subevento', [
            'id' =>  $this->primaryKey(),
            'evento_id' => $this->integer(),
            'subevento_id' => $this->integer(),
            'matriz_evento_id' => $this->integer(),
            'carga_horaria_max' => $this->smallInteger(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);

        $this->addForeignKey(
            'fk_matriz_subevento_evento_id',
            'matriz_subevento',
            'evento_id',
            'evento',
            'id'
        );

        $this->addForeignKey(
            'fk_matriz_subevento_subevento_id',
            'matriz_subevento',
            'subevento_id',
            'subevento',
            'id'
        );

        $this->addForeignKey(
            'fk_matriz_subevento_matriz_evento_id',
            'matriz_subevento',
            'matriz_evento_id',
            'matriz_evento',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('matriz_subevento');
    }
}
