<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%resume}}`.
 */
class m201222_145713_drop_user_id_column_from_resume_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropColumn('resume', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->addColumn('resume', 'user_id', $this->tinyInteger()->unsigned());
    }
}
