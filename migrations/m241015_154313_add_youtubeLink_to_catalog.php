<?php

use yii\db\Migration;

/**
 * Class m241015_154313_add_youtubeLink_to_catalog
 */
class m241015_154313_add_youtubeLink_to_catalog extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%catalog}}', 'youtubeLink', $this->string(255)->null()->after('danger'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%catalog}}', 'youtubeLink');
    }
}
