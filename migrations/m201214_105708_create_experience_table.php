<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%experience}}`.
 */
class m201214_105708_create_experience_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%experience}}', [
            'id' => $this->primaryKey(),
            'month' => $this->string()->notNull(),
            'year' => $this->string()->notNull(),
            'month_end_work' => $this->string(),
            'year_end_work' => $this->string(),
            'until_now_work' => $this->string(),
            'organization' => $this->string(),
            'exp_spec' => $this->string()->notNull(),
            'responsibility' => $this->string(),
            'resume_id' => $this->integer(),
        ]);

        

        $this->createIndex(
            'idx-experience-resume_id', 
            'experience', 
            'resume_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-experience-resume_id', 
            'experience'
        );

        $this->dropTable('{{%experience}}');
    }
}
