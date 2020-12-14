<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resume}}`.
 */
class m201214_121000_create_resume_table extends Migration
{
     /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resume}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'patronymic' => $this->string()->notNull(),
            'date_of_bird' => $this->date()->notNull(),
            'gender' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'specialization' => $this->string()->notNull(),
            'desired_salary' => $this->integer()->notNull(),
            'employment' => $this->string()->notNull(),
            'schedule' => $this->string()->notNull(),
            'experience' => $this->string()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-resume-id', 
            'resume', 
            'id', 
            'experience', 
            'resume_id', 
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-resume-id',
            'resume'
        );

        $this->dropTable('{{%resume}}');
    }
}
