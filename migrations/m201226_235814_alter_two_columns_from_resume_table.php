<?php

use yii\db\Migration;

/**
 * Class m201226_235814_alter_two_columns_from_resume_table
 */
class m201226_235814_alter_two_columns_from_resume_table extends Migration
{

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('resume', 'employment', $this->tinyInteger(5)->unsigned());
        $this->alterColumn('resume', 'schedule', $this->tinyInteger(5)->unsigned());
    }

    public function down()
    {
        echo "m201226_235814_alter_two_columns_from_resume_table cannot be reverted.\n";

        return false;
    }
    
}
