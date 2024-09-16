<?php

use yii\db\Migration;

/**
 * Class m240916_110552_create_table_name
 */
class m240916_110652_create_table_name extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%catalog}}', [
            'id' => $this->primaryKey(), // Primary key, auto-increment
            'user_id' => $this->integer()->notNull(), // Foreign key to user table
            'type' => $this->string()->notNull(), // String field
            'name' => $this->string()->notNull(), // String field
            'description' => $this->text(), // Text field, optional
            'deleted' => $this->boolean()->defaultValue(false), // Boolean field, default false
            'date_create' => $this->datetime()->notNull(), // DateTime field
            'date_update' => $this->datetime()->notNull(), // DateTime field
            'verify' => $this->boolean()->defaultValue(false), // Boolean field, default false
            'danger' => $this->boolean()->defaultValue(false), // Boolean field, default false
        ]);

        // Optionally add an index or foreign key constraint
        // $this->addForeignKey(
        //     'fk-example-table-user_id',
        //     '{{%example_table}}',
        //     'user_id',
        //     '{{%user}}',
        //     'id',
        //     'CASCADE',
        //     'CASCADE'
        // );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Optionally drop foreign key constraints if added
        // $this->dropForeignKey('fk-example-table-user_id', '{{%example_table}}');

        $this->dropTable('{{%catalog}}');
    }
}
