<?php

use yii\db\Migration;

/**
 * Class m220710_183259_create_table_sub_event
 */
class m220710_183259_create_table_sub_event extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createTable('subevento', [
            'id' =>  $this->primaryKey(),
            'nome' => $this->text(),
            'evento_id' => $this->integer(),
            'ativo' => $this->tinyInteger()->defaultValue(true),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);

        $this->addForeignKey(
            'fk_sub_event_evento_id',
            'subevento',
            'evento_id',
            'evento',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('subevento');
    }
}
