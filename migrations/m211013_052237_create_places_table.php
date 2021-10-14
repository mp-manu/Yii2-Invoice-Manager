<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%places}}`.
 */
class m211013_052237_create_places_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%places}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255'),
            'description' => $this->string('255'),
            'is_active' => $this->integer(2),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%places}}');
    }
}
