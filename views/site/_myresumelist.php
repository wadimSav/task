<div class="row">
    <div class="my-resume-dropdown dropdown show mb8">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="/images/dots.svg" alt="dots">
        </a>
        <div class="dropdown-menu dropdown-menu-right"
                aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item mod-resume" href="/myresume/edit/<?= $model->id ?>">Редактировать</a>
            <a class="dropdown-item delete-resume" href="/myresume/delete/<?= $model->id ?>">Удалить</a>
        </div>
    </div>
    <div class="col-xl-12 my-vacancies-block__left-col mb16">
        <h2 class="mini-title mb8"><?= $model->specialization ?></h2>
        <div class="d-flex align-items-center flex-wrap mb8 ">
            <span class="mr16 paragraph"><?= $model->desired_salary ?> ₽</span>
            <span class="mr16 paragraph">Опыт работы <?= $model->exp[0]->year_end_work - $model->exp[0]->year . ' ' . $model->num2word($model->exp[0]->year_end_work - $model->exp[0]->year, ['год', 'года', 'лет']) ?> </span>
            <span class="mr16 paragraph"><?= $model->city ?></span>
        </div>
        <div class="d-flex flex-wrap">
            <div class="paragraph mr16">
                <?php if($model->viewed !== NULL) { ?>
                    <strong>Просмотров</strong>
                    <span class="grey">
                        <?= $model->viewed ?>
                    </span>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-xl-12 d-flex justify-content-between align-items-center flex-wrap">
        <div class="d-flex flex-wrap mobile-mb12">
            <a class="mr16" href="myresume/detail/<?= $model->id ?>">Открыть</a>
        </div>
        <span class="mini-paragraph cadet-blue">
            Опубликовано 
            <?= Yii::$app->formatter->asDate($model->published_at, 'php:d F Y') . ' в
             ' . Yii::$app->formatter->asTime($model->published_at, 'php:H:m') ?>
        </span>
    </div>
</div>