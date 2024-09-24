<?php

use yii\db\Migration;

/**
 * Class m240924_183600_update_deleted_column_in_catalog_to_bool
 */
class m240924_183600_update_deleted_column_in_catalog_to_bool extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Приведение существующего поля deleted к типу boolean
        $this->alterColumn('{{%catalog}}', 'deleted', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Откат изменений — приведение deleted к предыдущему типу int
        $this->alterColumn('{{%catalog}}', 'deleted', $this->tinyInteger(1)->defaultValue(0));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240924_183600_update_deleted_column_in_catalog_to_bool cannot be reverted.\n";

        return false;
    }
    */
}
