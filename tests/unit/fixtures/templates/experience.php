<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

 return [
    'month' => rand(0, 11),
    'year' => $faker->date('Y', 2010),
    'month_end_work' => rand(0, 11),
    'year_end_work' => $faker->date('Y', 'now'),
    'until_now_work' => (($faker->randomDigit % 2) == 0) ? false : true,
    'organization' => $faker->word(),
    'exp_spec' => rand(1, 26),
    'responsibility' => $faker->text(rand(300, 500)),
    'resume_id' => 1,
 ];