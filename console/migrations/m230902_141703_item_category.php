<?php

use yii\db\Migration;

/**
 * Class m230902_141703_item_category
 */
class m230902_141703_item_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('item_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'parent_category' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230902_141703_item_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230902_141703_item_category cannot be reverted.\n";

        return false;
    }
    */
}
