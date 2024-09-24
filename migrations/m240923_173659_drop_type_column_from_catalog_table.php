<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%catalog}}`.
 */
class m240923_173659_drop_type_column_from_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Удаляем столбец type из таблицы catalog
        $this->dropColumn('{{%catalog}}', 'type');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Добавляем столбец type обратно в таблицу catalog
        $this->addColumn('{{%catalog}}', 'type', $this->string(255)->notNull());
    }
}
