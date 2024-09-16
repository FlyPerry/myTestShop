<?php

use yii\db\Migration;

/**
 * Class m240916_094740_add_static_user
 */
class m240916_094740_add_static_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'email' => 'admin@admin.com',
            'password_hash' => Yii::$app->security->generatePasswordHash('123456789'),
            'auth_key' => Yii::$app->security->generateRandomString(),
        ]);
    }

    public function safeDown()
    {
        $this->delete('user', ['email' => 'admin@admin.com']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240916_094740_add_static_user cannot be reverted.\n";

        return false;
    }
    */
}
