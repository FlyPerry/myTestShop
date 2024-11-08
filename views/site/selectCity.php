<?php
?>
<style>
    /* Заглушка для фона Hero-секции */
    .hero-section {
        background-image: url('/img/startimage.jpg');
        height: 100vh;
        background-size: cover;
        background-position: center;
    }

    .transparent-bg {
        background-color: rgba(255, 255, 255, 0.8); /* Полупрозрачный белый фон */
        padding: 20px; /* Добавьте отступы, если необходимо */
        border-radius: 8px; /* Закругленные углы */
        width: 50vw;
    }

    /* Общие настройки для мобильных устройств */
    @media (max-width: 768px) {
        /* Hero-секция */
        .hero-section {
            min-height: 70vh; /* Минимальная высота для более компактного отображения */
            padding: 20px; /* Внутренние отступы */
        }

        .transparent-bg {
            width: 90vw; /* На мобильных ширина блока увеличивается */
            padding: 10px; /* Сокращенные отступы для мобильных */
        }

        /* Адаптивные заголовки */
        h1.display-4 {
            font-size: 1.8rem; /* Уменьшаем размер шрифта */
        }

        p {
            font-size: 1rem;
        }

        /* Кнопка выбора города */
        .btn {
            font-size: 0.9rem;
            padding: 10px 15px;
        }

        /* Модальное окно */
        .modal-dialog {
            width: 95%; /* Максимальная ширина на мобильных */
            max-width: 100%; /* Заполнение по ширине экрана */
        }

        /* Настройки для списка выбора */
        .form-select {
            font-size: 0.9rem; /* Уменьшаем шрифт в селектах */
        }

        /* Скрываем лишние элементы для удобства */
        .d-none {
            display: none !important;
        }
    }


</style>
<section class="hero-section text-center d-flex align-items-center">
    <div class="container transparent-bg">
        <h1 class="display-4"><?= Yii::t('app', 'welcome') ?></h1>
        <p><?= Yii::t('app', 'start-text-select-city') ?></p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#locationModal">
            <?= Yii::t('app', 'change-city-text') ?>
        </button>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-centered" style="max-width: 100vw; justify-self: center;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel"><?= Yii::t('app', 'select-location') ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- City Selection -->
                        <div class="col-12 col-md-4 mb-3 mb-md-0">
                            <select class="form-select" id="city-select" size="6">
                                <option value="0">Весь Казахстан</option>
                                <option value="1">Алматинская область</option>
                                <option value="2">Акмолинская область</option>
                                <option value="3">Актюбинская область</option>
                                <option value="4">Атырауская область</option>
                                <option value="5">Восточно-Казахстанская область</option>
                                <option value="6">Жамбылская область</option>
                                <option value="7">Западно-Казахстанская область</option>
                                <option value="8">Карагандинская область</option>
                                <option value="9">Костанайская область</option>
                                <option value="10">Кызылординская область</option>
                                <option value="11">Мангистауская область</option>
                                <option value="12">Павлодарская область</option>
                                <option value="13">Северо-Казахстанская область</option>
                                <option value="14">Туркестанская область</option>
                                <option value="15">Жетысуская область</option>
                            </select>
                        </div>
                        <!-- District Selection (initially hidden) -->
                        <div class="col-12 col-md-4 mb-3 mb-md-0 d-none" id="district-container">
                            <select class="form-select" id="district-select" size="6">
                                <option value="0">Все районы</option>
                                <!-- Динамически добавляемые районы -->
                            </select>
                        </div>
                        <!-- Neighborhood Selection (initially hidden) -->
                        <div class="col-12 col-md-4 d-none" id="neighborhood-container">
                            <select class="form-select" id="neighborhood-select" size="6">
                                <option value="0">Все микрорайоны</option>
                                <!-- Динамически добавляемые микрорайоны -->
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 text-end">
                        <button class="btn btn-primary w-100 w-md-auto changeCityBtn"><?= Yii::t('app', 'select') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('city-select').addEventListener('change', function () {
            document.getElementById('district-container').classList.remove('d-none');
            document.getElementById('neighborhood-container').classList.add('d-none');

        });

        document.getElementById('district-select').addEventListener('change', function () {
            document.getElementById('neighborhood-container').classList.remove('d-none');
        });
    </script>
</section>
<script>
    // Данные районов и микрорайонов по областям
    const data = {
        "1": { // Алматинская область
            districts: [
                {id: "1", name: "Алатауский район"},
                {id: "2", name: "Алмалинский район"},
                {id: "3", name: "Ауэзовский район"},
                {id: "4", name: "Бостандыкский район"},
                {id: "5", name: "Жетысуский район"},
                {id: "6", name: "Медеуский район"},
                {id: "7", name: "Наурызбайский район"},
                {id: "8", name: "Турксибский район"},
                {id: "8", name: "Талдыкорган"},
                {id: "8", name: "Капшагай"},
                {id: "8", name: "Текели"},
            ]
        },
        "2": { // Акмолинская область
            districts: [
                {id: "1", name: "Аккольский район"},
                {id: "2", name: "Аршалынский район"},
                {id: "3", name: "Астраханский район"},
                {id: "4", name: "Атбасарский район"},
                {id: "5", name: "Буландынский район"},
                {id: "6", name: "Бурабайский район"},
                {id: "7", name: "Егиндыкольский район"},
                {id: "8", name: "Ерейментауский район"},
                {id: "9", name: "Есильский район"},
                {id: "10", name: "Жаксынский район"},
                {id: "11", name: "Коргалжынский район"},
                {id: "12", name: "Сандыктауский район"},
                {id: "13", name: "Целиноградский район"},
                {id: "14", name: "Шортандинский район"},
                {id: "15", name: "Кокшетау"},
                {id: "16", name: "Степногорск"},
            ]
        },
        "3": { // Актюбинская область
            districts: [
                {id: "1", name: "Айтекебийский район"},
                {id: "2", name: "Алгинский район"},
                {id: "3", name: "Байганинский район"},
                {id: "4", name: "Иргизский район"},
                {id: "5", name: "Каргалинский район"},
                {id: "6", name: "Кобдинский район"},
                {id: "7", name: "Мартукский район"},
                {id: "8", name: "Мугалжарский район"},
                {id: "9", name: "Темирский район"},
                {id: "10", name: "Уилский район"},
                {id: "11", name: "Хромтауский район"},
                {id: "12", name: "Сандыктауский район"},
                {id: "13", name: "Целиноградский район"},
                {id: "14", name: "Шортандинский район"},
                {id: "15", name: "Актобе"},
                {id: "16", name: "Кандыагаш"},
            ]
        },
        "4": { // Атырауская область
            districts: [
                {id: "1", name: "Индерский район"},
                {id: "2", name: "Исатайский район"},
                {id: "3", name: "Курмангазинский район"},
                {id: "4", name: "Макатский район"},
                {id: "5", name: "Махамбетский район"},
                {id: "6", name: "Атырау"},
                {id: "7", name: "Кульсары"},
            ]
        },
        "5": { // Восточно-Казахстанская область
            districts: [
                {id: "1", name: "Абайский район"},
                {id: "2", name: "Аягозский район"},
                {id: "3", name: "Бескарагайский район"},
                {id: "4", name: "Бородулихинский район"},
                {id: "5", name: "Глубоковский район"},
                {id: "6", name: "Жарминский район"},
                {id: "7", name: "Зайсанский район"},
                {id: "8", name: "Зыряновский район"},
                {id: "9", name: "Катон-Карагайский район"},
                {id: "10", name: "Кокпектинский район"},
                {id: "11", name: "Тарбагатайский район"},
                {id: "12", name: "Уланский район"},
                {id: "13", name: "Усть-Каменогорск"},
                {id: "14", name: "Семей"},
                {id: "15", name: "Риддер"},
            ]
        },
        "6": { // Жамбылская область
            districts: [
                {id: "1", name: "Байзакский район"},
                {id: "2", name: "Жамбылский район"},
                {id: "3", name: "Жуалынский район"},
                {id: "4", name: "Кордайский район"},
                {id: "5", name: "Меркенский район"},
                {id: "6", name: "Мойынкумский район"},
                {id: "7", name: "Рыскуловский район"},
                {id: "8", name: "Сарысуский район"},
                {id: "9", name: "Таласский район"},
                {id: "10", name: "Тараз "},
                {id: "11", name: "Жанатас"},
                {id: "12", name: "Каратау"},
            ]
        },
        "7": { // Западно-Казахстанская область
            districts: [
                {id: "1", name: "Акжаикский район"},
                {id: "2", name: "Бокейординский район"},
                {id: "3", name: "Жангалинский район"},
                {id: "4", name: "Каратобинский район"},
                {id: "5", name: "Сырымский район"},
                {id: "6", name: "Таскалинский район"},
                {id: "7", name: "Теректинский район"},
                {id: "8", name: "Шынгырлауский район"},
                {id: "9", name: "Уральск"},
                {id: "10", name: "Аксай"},
            ]
        },
        "8": { // Карагандинская область
            districts: [
                {id: "1", name: "Абайский район"},
                {id: "2", name: "Актогайский район"},
                {id: "3", name: "Бухар-Жырауский район"},
                {id: "4", name: "Каркаралинский район"},
                {id: "5", name: "Нуринский район"},
                {id: "6", name: "Осакаровский район"},
                {id: "7", name: "Улытауский район"},
                {id: "8", name: "Караганда"},
                {id: "9", name: "Темиртау"},
                {id: "10", name: "Балхаш"},
                {id: "11", name: "Жезказган"},
                {id: "12", name: "Сатпаев"},
            ]
        },
        "9": { // Костанайская область
            districts: [
                {id: "1", name: "Алтынсаринский район"},
                {id: "2", name: "Аулиекольский район"},
                {id: "3", name: "Денисовский район"},
                {id: "4", name: "Житикаринский район"},
                {id: "5", name: "Карабалыкский район"},
                {id: "6", name: "Карасуский район"},
                {id: "7", name: "Костанайский район"},
                {id: "8", name: "Мендыкаринский район"},
                {id: "9", name: "Наурзумский район"},
                {id: "10", name: "Сарыкольский район"},
                {id: "11", name: "Тарановский район"},
                {id: "12", name: "Узункольский район"},
                {id: "13", name: "Костанай "},
                {id: "14", name: "Рудный"},
                {id: "15", name: "Лисаковск"},
            ]
        },
        "10": { // Кызылординская область
            districts: [
                {id: "1", name: "Аральский район"},
                {id: "2", name: "Жалагашский район"},
                {id: "3", name: "Казалинский район"},
                {id: "4", name: "Кармакшинский район"},
                {id: "5", name: "Сырдарьинский район"},
                {id: "6", name: "Шиелийский район"},
                {id: "7", name: "Жанакорганский район"},
                {id: "8", name: "Кызылорда"},
            ]
        },
        "11": { // Мангистауская область
            districts: [
                {id: "1", name: "Бейнеуский район"},
                {id: "2", name: "Каракиянский район"},
                {id: "3", name: "Мангыстауский район"},
                {id: "4", name: "Мунайлынский район"},
                {id: "5", name: "Тупкараганский район"},
                {id: "6", name: "Актау"},
                {id: "7", name: "Жанаозен"},
            ]
        },
        "12": { // Павлодарская область
            districts: [
                {id: "1", name: "Алтынсаринский район"},
                {id: "2", name: "Баянаульский район"},
                {id: "3", name: "Железинский район"},
                {id: "4", name: "Иртышский район"},
                {id: "5", name: "Качирский район"},
                {id: "6", name: "Павлодарский район"},
                {id: "7", name: "Успенский район"},
                {id: "8", name: "Павлодар"},
                {id: "9", name: "Экибастуз"},
                {id: "10", name: "Аксу"},
            ]
        },
        "13": { // Северо-Казахстанская область
            districts: [
                {id: "1", name: "Акжарский район"},
                {id: "2", name: "Айыртауский район"},
                {id: "3", name: "Аккайынский район"},
                {id: "4", name: "Есильский район"},
                {id: "5", name: "Жамбылский район"},
                {id: "6", name: "Кызылжарский район"},
                {id: "7", name: "Мамлютский район"},
                {id: "8", name: "Тайыншинский район"},
                {id: "9", name: "Тимирязевский район"},
                {id: "10", name: "Уалихановский район"},
                {id: "11", name: "Петропавловск"},
            ]
        },
        "14": { // Туркестанская область
            districts: [
                {id: "1", name: "Байдибекский район"},
                {id: "2", name: "Жетысайский район"},
                {id: "3", name: "Казыгуртский район"},
                {id: "4", name: "Махтааральский район"},
                {id: "5", name: "Отырарский район"},
                {id: "6", name: "Сарыагашский район"},
                {id: "7", name: "Сайрамский район"},
                {id: "8", name: "Тюлькубасский район"},
                {id: "9", name: "Туркестан"},
                {id: "10", name: "Кентау"},
                {id: "11", name: "Арысь"},
            ]
        },
        "15": { // Жетысуская область
            districts: [
                {id: "1", name: "Аксуский район"},
                {id: "2", name: "Алакольский район"},
                {id: "3", name: "Каратальский район"},
                {id: "4", name: "Кегенский район"},
                {id: "5", name: "Коксуйский район"},
                {id: "6", name: "Панфиловский район"},
                {id: "7", name: "Талдыкорган "},
            ]
        },
    };

    $(document).ready(function () {
        // При изменении выбора области
        $('#city-select').on('change', function () {
            const cityId = $(this).val();
            const districtSelect = $('#district-select');
            districtSelect.empty().append('<option value="0">Все районы</option>');
            $('#district-container').toggleClass('d-none', cityId === "0");
            $('#neighborhood-container').addClass('d-none');

            if (cityId === "0") {
                // Если выбрана опция "Весь Казахстан", подгружаем все районы всех областей
                Object.values(data).forEach(region => {
                    region.districts.forEach(district => {
                        districtSelect.append(new Option(district.name, district.id));
                    });
                });
            } else if (data[cityId]) {
                // В противном случае подгружаем только районы выбранной области
                data[cityId].districts.forEach(district => {
                    districtSelect.append(new Option(district.name, district.id));
                });
            }
        });

        // При изменении выбора района
        $('#district-select').on('change', function () {
            const cityId = $('#city-select').val();
            const districtId = $(this).val();
            const neighborhoodSelect = $('#neighborhood-select');
            neighborhoodSelect.empty().append('<option value="0">Все микрорайоны</option>');
            $('#neighborhood-container').toggleClass('d-none', districtId === "0");

            if (districtId === "0") {
                // Если выбрана опция "Все районы", подгружаем все микрорайоны всех районов выбранной области
                if (data[cityId]) {
                    data[cityId].districts.forEach(district => {
                        district.neighborhoods.forEach(neighborhood => {
                            neighborhoodSelect.append(new Option(neighborhood, neighborhood));
                        });
                    });
                }
            } else if (data[cityId]) {
                // В противном случае подгружаем только микрорайоны выбранного района
                const district = data[cityId].districts.find(d => d.id === districtId);
                if (district) {
                    district.neighborhoods.forEach(neighborhood => {
                        neighborhoodSelect.append(new Option(neighborhood, neighborhood));
                    });
                }
            }
        });
    });
</script>