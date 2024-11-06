<?php
/**
 * @var $user \app\models\User
 * @var $userInfo \app\models\UserInfo
 * @var $active integer
 */
?>
<div class="tab-pane fade show active" id="help-tab">
    <h2 class="mb-4"><i class="fas fa-question-circle"></i> Часто задаваемые вопросы (ЧАВО)</h2>

    <div class="accordion" id="faqAccordion">
        <!-- Вопрос 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1"
                        aria-expanded="true" aria-controls="faqCollapse1">
                    Как разместить вещь, которую я хочу отдать?
                </button>
            </h2>
            <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Чтобы разместить вещь, зарегистрируйтесь или войдите в свой аккаунт. На главной странице нажмите
                    «Добавить объявление», выберите категорию, загрузите фото, укажите описание и условия передачи вещи.
                    После этого ваше объявление появится на сайте.
                </div>
            </div>
        </div>

        <!-- Вопрос 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                    Могу ли я указать, кому именно хочу отдать вещь?
                </button>
            </h2>
            <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Да, вы можете выбирать, кому передать вещь, и задать определенные условия. Например, отдать
                    нуждающейся семье или семье с детьми. Вы также можете отдать вещь первому откликнувшемуся
                    пользователю
                </div>
            </div>
        </div>

        <!-- Вопрос 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                    Могу ли я найти на сайте конкретные детские товары?
                </button>
            </h2>
            <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Конечно! На сайте есть категории для детских товаров, одежды, игрушек и многого другого.
                    Воспользуйтесь фильтрами для удобного поиска.
                </div>
            </div>
        </div>

        <!-- Вопрос 4 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                    Можно ли обмениваться вещами без встречи?
                </button>
            </h2>
            <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Да, это возможно, если обе стороны согласны. Вы можете договориться об отправке через почту или
                    курьера, но при этом расходы обычно оплачиваются получателем, если не договорено иначе
                </div>
            </div>
        </div>

        <!-- Вопрос 5 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading5">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                    Как быстро обновляются объявления?
                </button>
            </h2>
            <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Объявления обновляются мгновенно после публикации. Чтобы ваше объявление не затерялось, периодически
                    проверяйте его актуальность и обновляйте при необходимости.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading6">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
                    Безопасно ли размещать свои контакты?
                </button>
            </h2>
            <div id="faqCollapse6" class="accordion-collapse collapse" aria-labelledby="faqHeading6"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Мы советуем не указывать личные данные в объявлении, а общаться с потенциальными получателями через
                    личные сообщения на платформе. Так ваши контакты будут в безопасности.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading7">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse7" aria-expanded="false" aria-controls="faqCollapse7">
                    Что делать, если вещь не подошла или имеет дефекты?
                </button>
            </h2>
            <div id="faqCollapse7" class="accordion-collapse collapse" aria-labelledby="faqHeading7"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Пожалуйста, проверяйте вещи при передаче, чтобы убедиться в их состоянии. Если вещь не подошла, вы
                    можете предложить ее кому-то еще через сайт.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading8">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse8" aria-expanded="false" aria-controls="faqCollapse8">
                    Как разместить объявление о том, что мне что-то нужно?
                </button>
            </h2>
            <div id="faqCollapse8" class="accordion-collapse collapse" aria-labelledby="faqHeading8"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Зарегистрируйтесь, войдите в свой аккаунт, нажмите «Добавить объявление» и выберите категорию
                    «Нуждаюсь». Опишите, что вам нужно, и разместите объявление.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading9">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse9" aria-expanded="false" aria-controls="faqCollapse9">
                    Можно ли отдать сразу несколько вещей?
                </button>
            </h2>
            <div id="faqCollapse9" class="accordion-collapse collapse" aria-labelledby="faqHeading9"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Да, вы можете создать отдельные объявления для каждой вещи или разместить одно объявление с
                    несколькими предметами. Укажите в описании, что готовы отдать их все вместе или по отдельности.
                </div>
            </div>
        </div>
    </div>
</div>

