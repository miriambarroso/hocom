<?php

use yii\db\Migration;

/**
 * Class m220713_010502_delete_index_email_table_user
 */
class m220713_010502_delete_index_email_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropIndex('idx_user_email', 'user');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createIndex('idx_user_email', '{{%user}}', 'email', true);
    }

}
