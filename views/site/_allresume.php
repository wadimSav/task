<?php 

use app\models\enums\Specialist;
use app\models\enums\Cities;
use app\models\enums\Gender;
use app\models\enums\Monts;

?>

<div class="company-list-search__block-left">
    <div class="resume-list__block-img mb8">
        <img src="<?= Yii::getAlias('@web/images/faker-images/') . $model->image ?>" alt="profile">
    </div>
</div>
<a href="myresume/detail/<?= $model->id ?>">
<div class="company-list-search__block-right">

    <?php if($model->updated_at === NULL) { ?>
        <div class="mini-paragraph cadet-blue mobile-mb12">
            Опубликовано 
            <?= Yii::$app->formatter->asDate($model->published_at, 'php:d F Y') . ' в
             ' . Yii::$app->formatter->asTime($model->published_at, 'php:H:m') ?>
        </div>
    <?php } else { ?>
        <div class="mini-paragraph cadet-blue mobile-mb12">
            Обновлено 
            <?= Yii::$app->formatter->asDate($model->published_at, 'php:d F Y') . ' в
             ' . Yii::$app->formatter->asTime($model->published_at, 'php:H:m') ?>
        </div>
    <?php } ?>

    <h3 class="mini-title mobile-off"><?= Specialist::getLabel($model->specialization) ?></h3>
    <div class="d-flex align-items-center flex-wrap mb8 ">
        <span class="mr16 paragraph"><?= $model->desired_salary ?> ₽</span>
        <?php if($model->exp){ ?> 
        <span class="mr16 paragraph">
            Опыт работы 
            <?= $model->exp[0]->year_end_work - $model->exp[0]->year . ' ' . 
                $model->num2word($model->exp[0]->year_end_work - $model->exp[0]->year, 
                ['год', 'года', 'лет']) ?>
        </span>
        <?php } ?>
        <span class="mr16 paragraph">
            <?php 
                $age = Yii::$app->formatter->asDate('now', 'php:Y') - 
                       Yii::$app->formatter->asDate($model->birthday, 'php:Y');
                echo $age . $model->num2word($age, [' год', ' года', ' лет']);
             ?>
        </span>
        <span class="mr16 paragraph"><?= Cities::getLabel($model->city) ?></span>
        <span class="mr16 paragraph"><?= Gender::getLabel($model->gender) ?></span>
    </div>
    <?php if($model->exp){ ?>
        <p class="paragraph tbold mobile-off">Последнее место работы</p>
        <div class="company-list-search__block-middle">
            <h3 class="mini-title desktop-off"><?= $model->exp[0]->organization ?></h3>
            <p class="paragraph mb16 mobile-mb32">
                <?= Specialist::getLabel($model->exp[0]->exp_spec) ?>
            </p>
            <p class="paragraph mb16 mobile-mb32">
                <?= Monts::getLabel($model->exp[0]->month) . ' ' . $model->exp[0]->year ?> — 
                <?php if($model->exp[0]->until_now_work === true) {
                    echo 'по настоящее время';
                } else {
                    echo Monts::getLabel($model->exp[0]->month_end_work) . ' ' . $model->exp[0]->year_end_work;
                } ?>
            </p>
        </div>
    <?php } ?>
</div>
</a>

