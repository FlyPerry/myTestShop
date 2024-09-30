
$(document).ready(function () {

    // Обработчик нажатия кнопки "Выбрать"
    $('.changeCityBtn').on('click', function () {
        // Получаем выбранные данные
        var selectedCity = $('#city-select').val();
        var selectedDistrict = $('#district-select').val();
        var selectedNeighborhood = $('#neighborhood-select').val();

        // Отправляем данные через AJAX
        $.ajax({
            url: '/site/submit-changed-city', // Указываем путь к экшену
            type: 'POST',
            data: {
                city: selectedCity,
                district: selectedDistrict,
                neighborhood: selectedNeighborhood,
                _csrf: yii.getCsrfToken() // Для защиты от CSRF-атак
            },
            success: function (response) {
                if (response.success) {
                    // Закрыть модальное окно
                    $('#locationModal').modal('hide');
                    // Можно добавить действия после успешного сохранения данных
                    location.reload(); // Перезагрузка страницы
                } else {
                    alert('Произошла ошибка при сохранении данных.');
                }
            },
            error: function () {
                alert('Не удалось отправить данные.');
            }
        });
    });
    $('#search-addon').on('input', function () {
        var query = $(this).val().toLowerCase();
        $('ul.list-unstyled li').each(function () {
            var text = $(this).text().toLowerCase();
            $(this).toggle(text.indexOf(query) !== -1);
        });
    });
    $(document).on('click', '.toggle-status-btn', function (e) {
        e.preventDefault();

        var button = $(this);
        var productId = button.data('id');
        var currentStatus = button.data('status');

        var newStatus = currentStatus ? 'Отключить' : 'Включить';
        var newClass = currentStatus ? 'btn-danger' : 'btn-success';
        var newIcon = currentStatus ? 'toggle-off' : 'toggle-on';

        $.ajax({
            url: '/user/change-active-order', // Маршрут до экшна
            type: 'POST',
            data: {
                id: productId,
                status: currentStatus,
                _csrf: yii.getCsrfToken() // Защита от CSRF атак
            },
            success: function (response) {
                if (response.success) {
                    // Изменяем текст и цвет кнопки на противоположное


                    button.data('status', response.deleted);
                    button.removeClass('btn-danger btn-success').addClass(newClass);
                    button.find('i').removeClass('fa-toggle-off fa-toggle-on').addClass('fa-' + newIcon);
                    button.find('.status-text').text(newStatus);
                } else {
                    alert('Произошла ошибка при изменении статуса.');
                }
            },
            error: function () {
                alert('Ошибка на сервере. Попробуйте позже.');
            }
        });
    });
});
