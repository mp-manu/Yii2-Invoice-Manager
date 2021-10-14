<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%receivers}}`.
 */
class m211013_052243_create_receivers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%receivers}}', [
            'id' => $this->primaryKey(),
            'fullname' => $this->string('255'),
            'is_active' => $this->integer(2)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%receivers}}');
    }
}
