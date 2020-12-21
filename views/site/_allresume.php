<?php 


?>

<div class="company-list-search__block-left">
    <div class="resume-list__block-img mb8">
        <img src="<?= Yii::getAlias('@web/images/faker-images/') . $model->image ?>" alt="profile">
    </div>
</div>
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

    <h3 class="mini-title mobile-off"><?= $model->specialization ?></h3>
    <div class="d-flex align-items-center flex-wrap mb8 ">
        <span class="mr16 paragraph"><?= $model->desired_salary ?> ₽</span>
        <span class="mr16 paragraph">Опыт работы <?= $model->exp[0]->year_end_work - $model->exp[0]->year . ' ' . $model->num2word($model->exp[0]->year_end_work - $model->exp[0]->year, ['год', 'года', 'лет']) ?></span>
        <span class="mr16 paragraph">
            <?php 
                $age = Yii::$app->formatter->asDate('now', 'php:Y') - Yii::$app->formatter->asDate($model->birthday, 'php:Y');
                echo $age . $model->num2word($age, [' год', ' года', ' лет']);
             ?>
        </span>
        <span class="mr16 paragraph"><?= $model->city ?></span>
    </div>
    <p class="paragraph tbold mobile-off">Последнее место работы</p>
</div>
<div class="company-list-search__block-middle">
    <h3 class="mini-title desktop-off"><?= $model->exp[0]->organization ?></h3>
    <p class="paragraph mb16 mobile-mb32">
        <?= $model->exp[0]->exp_spec ?>
    </p>
    <p class="paragraph mb16 mobile-mb32">
        <?= $model->exp[0]->month . ' ' . $model->exp[0]->year ?> — 
        <?php if($model->exp[0]->until_now_work !== NULL) {
            echo 'по настоящее время';
        } else {
            echo $model->exp[0]->month_end_work . ' ' . $model->exp[0]->year_end_work;
        } ?>
    </p>
</div>
