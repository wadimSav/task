<?php

use yii\db\Migration;

/**
 * Class m201223_135006_alter_five_columns_from_experience_table
 */
class m201223_135006_alter_five_columns_from_experience_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn('experience', 'month', $this->tinyInteger(2)->unsigned());
        $this->alterColumn('experience', 'year', $this->smallInteger(4)->unsigned());
        $this->alterColumn('experience', 'month_end_work', $this->tinyInteger(2)->unsigned());
        $this->alterColumn('experience', 'year_end_work', $this->smallInteger(4)->unsigned());
        $this->alterColumn('experience', 'until_now_work', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m201223_135006_alter_five_columns_from_experience_table cannot be reverted.\n";

        return false;
    }
}
