<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%catalog}}`.
 */
class m240923_171114_add_category_column_to_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Добавляем поле category в таблицу catalog
        $this->addColumn('{{%catalog}}', 'category', $this->integer(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаляем поле category из таблицы catalog
        $this->dropColumn('{{%catalog}}', 'category');
    }
}
