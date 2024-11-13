<?php
/**
 * @var $regions \app\components\modal\selectCity\models\Region;
 * @var $jsonData \yii\helpers\Json;
 */
?>
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
                            <?php foreach ($regions as $region) {
                                echo "<option value='{$region->id}'>{$region->name}</option>";
                            } ?>
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
    const data = <?=$jsonData;?>
    // Данные районов и микрорайонов по областям
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