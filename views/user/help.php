<?php
/**
 * @var $user \app\models\User
 * @var $userInfo \app\models\UserInfo
 * @var $active integer
 */
$show = ($active == 1) ? 'show active' : '';
?>
<div class="tab-pane fade <?= $show ?>" id="help-tab">
    <h2 class="mb-4"><i class="fas fa-question-circle"></i> Часто задаваемые вопросы (ЧАВО)</h2>
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1"
                        aria-expanded="true" aria-controls="faqCollapse1">
                    Что это за сайт?
                </button>
            </h2>
            <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body bg-secondary-subtle">
                    Данный сайт предназначен для публикаций своих объявлений, как доска, газета, считать можно как
                    угодно
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                    Как я могу выложить свой товар/услугу?
                </button>
            </h2>
            <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body bg-secondary-subtle">
                    Всё просто! Вкладка "Мои товары" ... *а дальше программист устал печатать инструкцию, как-нибудь
                    потом напишет*
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                    Что такое CDN?
                </button>
            </h2>
            <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body bg-secondary-subtle">
                    Сеть доставки контента (CDN) — это система распределенных серверов, которые доставляют веб-контент
                    пользователю в зависимости от его географического местоположения, происхождения веб-страницы и
                    сервера доставки контента. Использование CDN может помочь сократить время загрузки веб-страниц.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                    Как связаться со службой поддержки сайта?
                </button>
            </h2>
            <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body bg-secondary-subtle">
                    Связаться можно через вкладку сообщения, служба поддержки всегда закреплена вверху чата
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading5">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                    Могу ли я внести пожертвования на сайт?
                </button>
            </h2>
            <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body bg-secondary-subtle">
                    Да, вы можете помочь развитию проекта внеся пожертвования как банковской картой, так и банковским
                    переводом. Реквизиты можно запросить у службы поддержки, либо перейти по <a href="https://donationalerts.com/">ссылке для пожертвования</a>
                </div>
            </div>
        </div>
    </div>
</div>
