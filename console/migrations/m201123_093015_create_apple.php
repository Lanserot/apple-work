<?php

use yii\db\Migration;

/**
 * Class m201123_093015_create_apple
 */
class m201123_093015_create_apple extends Migration
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
        echo "m201123_093015_create_apple cannot be reverted.\n";

        return false;
    }
    public function up()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'status'=>$this->char(255)->notNull(),
            'color'=>$this->char(255)->notNull(),
            'appearance_date'=>$this->integer(),
            'fall_date'=>$this->integer(),
            'eat'=>$this->integer()->notNull(),
            'size'=>$this->integer()->notNull(),
        ]);
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201123_093015_create_apple cannot be reverted.\n";

        return false;
    }
    */
}
