<?php

use yii\db\Migration;

/**
 * Class m220710_183300_create_table_certificate
 */
class m220710_183300_create_table_certificate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('certificado', [
            'id' =>  $this->primaryKey(),
            'nome' => $this->string(),
            'quantidade_de_horas' => $this->smallInteger(),
            'validado' => $this->boolean(),
            'data' => $this->date(),
            'username' => $this->bigInteger(),
            'imagem' => $this->binary(),
            'subevento_id' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);

        $this->addForeignKey(
            'fk_certificado_username',
            'certificado',
            'username',
            'user',
            'username'
        );

        $this->addForeignKey(
            'fk_certificado_subevento_id',
            'certificado',
            'subevento_id',
            'subevento',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('certificado');
    }

}