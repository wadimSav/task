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
    public function up()
    {
        $this->createTable('{{%resume}}', [
            'id' => $this->primaryKey()->unique(),
            'image' => $this->string(),
            'user_id' => $this->integer(),
            'surname' => $this->string(),
            'name' => $this->string(),
            'patronymic' => $this->string(),
            'birthday' => $this->string(),
            'gender' => $this->string(),
            'city' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'specialization' => $this->string(),
            'desired_salary' => $this->integer(),
            'employment' => $this->string(),
            'schedule' => $this->string(),
            'experience' => $this->string(),
            'about' => $this->text(),
            'viewed' => $this->integer(),
            'published_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%resume}}');
    }
}
