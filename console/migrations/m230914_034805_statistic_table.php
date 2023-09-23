<?php

use yii\db\Migration;

/**
 * Class m230914_034805_statistic_table
 */
class m230914_034805_statistic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230914_034805_statistic_table cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('statistic', [
            'id' => $this->primaryKey(),
            'access_time' => $this->dateTime(),
            'user_ip' => $this->string(20),
            'user_host' => $this->string(50),
            'path_info' => $this->string(50),
            'query_string' => $this->string(50),
        ]);
    }

    public function down()
    {
        echo "m230914_034805_statistic_table cannot be reverted.\n";

        return false;
    }
}
