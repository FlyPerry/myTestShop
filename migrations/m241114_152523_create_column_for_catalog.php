<?php

use yii\db\Migration;

/**
 * Class m241114_152523_create_column_for_catalog
 */
class m241114_152523_create_column_for_catalog extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%catalog}}','district',$this->integer()->comment('Район где опубликован')->defaultValue(0));
        $this->addColumn('{{%catalog}}','region',$this->integer()->comment('Область где опубликован')->defaultValue(0));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%catalog}}', 'district');
        $this->dropColumn('{{%catalog}}', 'region');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241114_152523_create_column_for_catalog cannot be reverted.\n";

        return false;
    }
    */
}
