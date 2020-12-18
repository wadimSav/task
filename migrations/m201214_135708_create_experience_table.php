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
    public function up()
    {
        $this->createTable('{{%experience}}', [
            'id' => $this->primaryKey(),
            'month' => $this->string(),
            'year' => $this->integer(),
            'month_end_work' => $this->string(),
            'year_end_work' => $this->integer(),
            'until_now_work' => $this->string(),
            'organization' => $this->string(),
            'exp_spec' => $this->string(),
            'responsibility' => $this->text(),
            'resume_id' => $this->integer(),
        ]);

        

        $this->createIndex(
            'idx-experience-resume_id', 
            'experience', 
            'resume_id'
        );

        // add foreign key for table `experience`
        $this->addForeignKey(
            'fk-post-resume_id',
            'experience',
            'resume_id',
            'resume',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // drops foreign key for table `experience`
        $this->dropForeignKey(
            'fk-post-resume_id',
            'resume'
        );
        
        $this->dropIndex(
            'idx-experience-resume_id', 
            'experience'
        );

        $this->dropTable('{{%experience}}');
    }
}
