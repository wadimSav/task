<?php

use yii\db\Migration;

/**
 * Class m201223_132305_alter_six_columns_from_resume_table
 */
class m201223_132305_alter_six_columns_from_resume_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('resume', 'gender', $this->tinyInteger(1)->unsigned());
        $this->alterColumn('resume', 'city', $this->smallInteger()->unsigned());
        $this->alterColumn('resume', 'specialization', $this->tinyInteger(5)->unsigned());
        $this->alterColumn('resume', 'employment', $this->tinyInteger(2)->unsigned());
        $this->alterColumn('resume', 'schedule', $this->tinyInteger(2)->unsigned());
        $this->alterColumn('resume', 'experience', $this->tinyInteger(1)->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m201223_132305_alter_six_columns_from_resume_table cannot be reverted.\n";

        return false;
    }

}
