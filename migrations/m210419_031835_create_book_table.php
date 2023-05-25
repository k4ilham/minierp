<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m210419_031835_create_book_table extends Migration
{

    public function up()
    {        
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
 
        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
            'author' => $this->string(50)->notNull(),
            'publisher' => $this->string(50)->notNull(),
            'price' => $this->decimal(10,2)->notNull(),
            'stock' => $this->integer(5)->notNull(),
        ],$tableOptions);
 
    }



    public function down()
    {
        $this->dropTable('book');
    }

}
