<?php
?>
<style>
    /* Заглушка для фона Hero-секции */
    .hero-section {
        background-image: url('https://placeholder.pics/svg/1920x1080');
        height: 100vh;
        background-size: cover;
        background-position: center;
    }
</style>
<section class="hero-section text-center d-flex align-items-center">
    <div class="container">
        <h1 class="display-4">Добро пожаловать</h1>
        <p>Для начала работы с сайтом, выберите ваш город</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#locationModal">
            Выбрать город
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-centered" style="max-width: 80%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Select Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Поиск по городу, району, микрорайону">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <div class="row">
                        <!-- City Selection -->
                        <div class="col-4">
                            <select class="form-select" size="10" id="city-select">
                                <option value="1">Весь Казахстан</option>
                                <option value="2" selected="">Алматы</option>
                                <option value="3">Астана</option>
                                <option value="4">Шымкент</option>
                                <option value="5">Абай обл.</option>
                                <option value="6">Акмолинская обл.</option>
                                <option value="7">Актюбинская обл.</option>
                                <option value="8">Алматинская обл.</option>
                                <option value="9">Атырауская обл.</option>
                                <option value="10">Восточно-Казахстанская обл.</option>
                                <option value="11">Жамбылская обл.</option>
                            </select>
                        </div>
                        <!-- District Selection (initially hidden) -->
                        <div class="col-4 d-none" id="district-container">
                            <select class="form-select" size="10" id="district-select">
                                <option value="1">Все районы</option>
                                <option value="2">Алатауский р-н</option>
                                <option value="3">Алмалинский р-н</option>
                                <option value="4">Ауэзовский р-н</option>
                                <option value="5">Бостандыкский р-н</option>
                                <option value="6">Жетысуский р-н</option>
                                <option value="7">Медеуский р-н</option>
                                <option value="8">Наурызбайский р-н</option>
                                <option value="9">Турксибский р-н</option>
                            </select>
                        </div>
                        <!-- Neighborhood Selection (initially hidden) -->
                        <div class="col-4 d-none" id="neighborhood-container">
                            <select class="form-select" size="10" id="neighborhood-select">
                                <option value="1">Все микрорайоны</option>
                                <option value="2">мкр Аккайын</option>
                                <option value="3" selected="">мкр Алатау (ИЯФ)</option>
                                <option value="4">мкр Аксарай</option>
                                <option value="5">мкр Каменское плато</option>
                                <option value="6">мкр Кольсай</option>
                                <option value="7">мкр Сулусай</option>
                                <option value="8">мкр Юбилейный</option>
                                <option value="9">мкр Атырау</option>
                                <option value="10">мкр Бутакаова</option>
                                <option value="11">мкр Горный Гигант</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 text-end">
                        <button class="btn btn-primary changeCityBtn">Выбрать</button>
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
