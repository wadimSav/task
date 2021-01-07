<?php

use yii\db\Migration;

/**
 * Class m201225_205152_alter_birthday_column_from_resume_table
 */
class m201225_205152_alter_birthday_column_from_resume_table extends Migration
{
    

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('resume', 'birthday', $this->dateTime());
    }

    public function down()
    {
        echo "m201225_205152_alter_birthday_column_from_resume_table cannot be reverted.\n";

        return false;
    }
    
}
