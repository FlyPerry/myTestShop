<?php

use yii\db\Migration;

/**
 * Class m240923_173516_insert_random_products_into_catalog
 */
class m240923_173516_insert_random_products_into_catalog extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%catalog}}',
            ['user_id', 'type', 'name', 'description', 'deleted', 'date_create', 'date_update', 'verify', 'danger'],
            [
                [1, 'man', 'Product 1', 'Description for product 1', 0, new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()'), 0, 0],
                [2, 'man', 'Product 2', 'Description for product 2', 0, new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()'), 1, 1],
                [1, 'women', 'Product 3', 'Description for product 3', 0, new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()'), 1, 0],
                [2, 'women', 'Product 4', 'Description for product 4', 0, new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()'), 0, 0],
                [1, 'work', 'Product 5', 'Description for product 5', 1, new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()'), 1, 1],
                [2, 'work', 'Product 6', 'Description for product 6', 0, new \yii\db\Expression('NOW()'), new \yii\db\Expression('NOW()'), 0, 0],
                // Добавьте еще записи по необходимости
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Здесь можно добавить логику для удаления добавленных записей, если потребуется откат миграции
        // Например, можно удалить записи с определенными именами
        $this->delete('{{%catalog}}', ['name' => ['Product 1', 'Product 2', 'Product 3', 'Product 4', 'Product 5', 'Product 6']]);
    }
}
