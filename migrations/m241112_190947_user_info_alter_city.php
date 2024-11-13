<?php

use yii\db\Migration;

/**
 * Class m241112_190947_user_info_alter_city
 */
class m241112_190947_user_info_alter_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Добавление столбца district
        $this->addColumn('{{%user_info}}', 'district', $this->string()->notNull()->comment('Район'));

        // Добавление столбца region
        $this->addColumn('{{%user_info}}', 'region', $this->string()->notNull()->comment('Область'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаление столбцов (откат изменений)
        $this->dropColumn('{{%user_info}}', 'district');
        $this->dropColumn('{{%user_info}}', 'region');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241112_190947_user_info_alter_city cannot be reverted.\n";

        return false;
    }
    */
}
