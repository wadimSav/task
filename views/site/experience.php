<div class="link-delete">
    <!-- начало работы -->
    <div class="row mb24">
    <div class="col-lg-2 col-md-3 dflex-acenter">
        <div class="paragraph">Начало работы</div>
    </div>
    <div class="col-lg-3 col-md-4 col-11">
        <div class="d-flex justify-content-between">
            <div class="citizenship-select w100 mr16">

            <?= $form->field($model_exp, 'month', ['enableLabel' => false])
                ->dropDownList([
                    '0' => 'Январь',
                    '1' => 'Февраль',
                    '2' => 'Март',
                    '3' => 'Апрель',

                ], ['class' => 'nselect-1']) ?>
    
                <!-- <select name="month[]" class="nselect-exp" data-title="Январь" required>
                    <option value="0">Январь</option>
                    <option value="1">Февраль</option>
                    <option value="2">Март</option>
                    <option value="3">Апрель</option>
                    <option value="4">Май</option>
                    <option value="5">Июнь</option>
                    <option value="6">Июль</option>
                    <option value="7">Август</option>
                    <option value="8">Сентябрь</option>
                    <option value="9">Октябрь</option>
                    <option value="10">Ноябрь</option>
                    <option value="11">Декабрь</option>
                </select> -->
    
            </div>
            <div class="citizenship-select w100">
                <input name="year" placeholder="2006" type="text" class="dor-input w100" required>
            </div>
        </div>
    </div>
    </div>
    <!-- окончание работы -->
    <div class="row mb8">
    <div class="col-lg-2 col-md-3 dflex-acenter">
        <div class="paragraph">Окончание работы</div>
    </div>
    <div class="col-lg-3 col-md-4 col-11">
        <div class="d-flex justify-content-between">
            <div class="citizenship-select w100 mr16">
                
                <select name="month_end_work[]" class="nselect-exp" data-title="Январь" required>
                    <option value="0">Январь</option>
                    <option value="1">Февраль</option>
                    <option value="2">Март</option>
                    <option value="3">Апрель</option>
                    <option value="4">Май</option>
                    <option value="5">Июнь</option>
                    <option value="6">Июль</option>
                    <option value="7">Август</option>
                    <option value="8">Сентябрь</option>
                    <option value="9">Октябрь</option>
                    <option value="10">Ноябрь</option>
                    <option value="11">Декабрь</option>
                </select>
    
            </div>
            <div class="citizenship-select w100">
                <input name="year_end_work" placeholder="2006" type="text" class="dor-input w100"
                     required>
            </div>
        </div>
    </div>
    </div>
    <div class="row mb32">
    <div class="col-lg-2 col-md-3">
    </div>
    <div class="col-lg-3 col-md-4 col-11">
        <div class="profile-info">
            <div class="form-check d-flex">
                <input name="until_now_work" type="checkbox" class="form-check-input" id="exampleCheck111">
                <label class="form-check-label" for="exampleCheck111"></label>
                <label for="exampleCheck111"
                        class="profile-info__check-text job-resolution-checkbox">По настоящее
                    время</label>
            </div>
        </div>
    </div>
    </div>
    <div class="row mb16">
    <div class="col-lg-2 col-md-3 dflex-acenter">
        <div class="paragraph">Организация</div>
    </div>
    <div class="col-lg-3 col-md-4 col-11">
        <input name="organization" type="text" class="dor-input w100">
    </div>
    </div>
    <div class="row mb16">
    <div class="col-lg-2 col-md-3 dflex-acenter">
        <div class="paragraph">Должность</div>
    </div>
    <div class="col-lg-3 col-md-4 col-11">
        <input name="exp_spec" type="text" class="dor-input w100">
    </div>
    </div>
    <div class="row mb16">
    <div class="col-lg-2 col-md-3">
        <div class="paragraph">Обязанности, функции, достижения</div>
    </div>
    <div class="col-lg-4 col-md-6 col-12">
        <textarea name="responsibility" class="dor-input w100 h96 mb8"
                    placeholder="Расскажите о своих обязанностях, функциях и достижениях"></textarea>
        <div class="mb24"><a class="delete-work" href="#">Удалить место работы</a></div>
    </div>
    </div>
    <div class="row mb24">
        <div class="col-lg-2 col-md-3">
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="devide-border"></div>
        </div>
    </div>
</div>