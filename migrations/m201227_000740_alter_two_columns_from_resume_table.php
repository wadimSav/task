<?php

use yii\db\Migration;

/**
 * Class m201227_000740_alter_two_columns_from_resume_table
 */
class m201227_000740_alter_two_columns_from_resume_table extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('resume', 'employment', $this->smallInteger()->unsigned());
        $this->alterColumn('resume', 'schedule', $this->smallInteger()->unsigned());
    }

    public function down()
    {
        echo "m201227_000740_alter_two_columns_from_resume_table cannot be reverted.\n";

        return false;
    }

}
