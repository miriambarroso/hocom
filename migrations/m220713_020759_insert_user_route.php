<?php

use yii\db\Migration;

/**
 * Class m220713_020759_insert_user_route
 */
class m220713_020759_insert_user_route extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $now = new DateTime();
        $now = $now->getTimestamp();

        $this->insert('matriz',[
            'id' => 1,
            'nome' => 'Matriz',
            'ano' => 2000,
            'semestre' => 1,
            'carga_horaria' => 6,
        ]);
        $this->insert( 'user', [
            'id' => 1,
            'username' => '11111111111111',
            'auth_key' => '',
            'updated_at' => $now,
            'created_at' => $now,
            'confirmed_at' => $now,
            'email' => 'ifg@estudantes.ifg.edu.br',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('secret'),
            'matriz_id'=> 1,
            'role' => 'gestor'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user', ['id' => 1]);
        $this->delete('matriz', ['id' => 1]);

    }

}
