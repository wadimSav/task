<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'image' => $faker->file(Yii::getAlias('@app/web/images/'), Yii::getAlias('@app/web/images/faker-images/'), false),
    'surname' => (($faker->randomDigit % 2) == 0) ? $faker->lastName('male') : $faker->lastName('female'),
    'name' => (($faker->randomDigit % 2) == 0) ? $faker->firstName('male') : $faker->firstName('female'),
    'patronymic' => (($faker->randomDigit % 2) == 0) ? $faker->middleName('male') : $faker->middleName('female'),
    'birthday' => Yii::$app->formatter->asDatetime($faker->dateTime('now'), 'php:Y-m-d H:i:s'),
    'gender' => (($faker->randomDigit % 2) == 0) ? 1 : 2,
    'city' => rand(1, 7),
    'email' => $faker->freeEmail,
    'phone' => $faker->regexify('^\+[0-9]{1} [0-9]{3} [0-9]{3}-[0-9]{2}-[0-9]{2}$'),
    'specialization' => rand(1, 26),
    'desired_salary' => rand(5000, 200000),
    'employment' => rand(1, 5),
    'schedule' => rand(1, 5),
    'experience' => (($faker->randomDigit % 2) == 0) ? 0 : 1,
    'about' => $faker->text(rand(1500, 2500)),
    'viewed' => rand(10, 150),
    'published_at' => Yii::$app->formatter->asDatetime($faker->dateTime('now'), 'php:Y-m-d H:i:s'),
    'updated_at' => Yii::$app->formatter->asDatetime($faker->dateTime('now'), 'php:Y-m-d H:i:s'),
];