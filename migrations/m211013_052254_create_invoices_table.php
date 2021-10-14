<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invoices}}`.
 */
class m211013_052254_create_invoices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoices}}', [
            'id' => $this->primaryKey(),
            'from_id' => $this->integer(11),
            'to_id' => $this->integer(11),
            'receiver_id' => $this->integer(11),
            'status_id' => $this->integer(2)
        ]);

        $this->addForeignKey(
            'fk-invoices-from_id',
            'invoices',
            'from_id',
            'places',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-invoices-to_id',
            'invoices',
            'to_id',
            'places',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-invoices-receiver_id',
            'invoices',
            'receiver_id',
            'receivers',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-invoices-status_id',
            'invoices',
            'status_id',
            'status',
            'id',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%invoices}}');
    }
}
