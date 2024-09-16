$(document).ready(function() {

    // Обработчик нажатия кнопки "Выбрать"
    $('.changeCityBtn').on('click', function() {
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
            success: function(response) {
                if (response.success) {
                    // Закрыть модальное окно
                    $('#locationModal').modal('hide');
                    // Можно добавить действия после успешного сохранения данных
                    location.reload(); // Перезагрузка страницы
                } else {
                    alert('Произошла ошибка при сохранении данных.');
                }
            },
            error: function() {
                alert('Не удалось отправить данные.');
            }
        });
    });
});