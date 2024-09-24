<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>

<!-- Category Section (Woman / Man) -->
<section class="categories py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="category category-woman bg-danger text-white align-middle text-center p-5">
                    <h2>Товары для девушек</h2>
                    <p>Woman</p>
                    <a href="/catalog/women" class="btn btn-light">Shop</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="category category-man bg-primary text-white align-middle text-center p-5">
                    <h2>Товары для мужчин</h2>
                    <p>Man</p>
                    <a href="/catalog/man" class="btn btn-light">Shop</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Work Section -->
<section class="work py-5">
    <div class="container text-center">
        <h2>Прочие услуги</h2>
        <div class="row mt-3 mb-2">
            <!-- Блоки с анимацией при наведении -->
            <div class="col-md-2">
                <div class="position-relative service-block">
                    <img src="https://placeholder.pics/svg/100x100" class="img-fluid rounded-circle" alt="Placeholder">
                    <div class="overlay">
                        <div class="text">Услуга 1</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative service-block">
                    <img src="https://placeholder.pics/svg/100x100" class="img-fluid rounded-circle" alt="Placeholder">
                    <div class="overlay">
                        <div class="text">Услуга 2</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative service-block">
                    <img src="https://placeholder.pics/svg/100x100" class="img-fluid rounded-circle" alt="Placeholder">
                    <div class="overlay">
                        <div class="text">Услуга 3</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative service-block">
                    <img src="https://placeholder.pics/svg/100x100" class="img-fluid rounded-circle" alt="Placeholder">
                    <div class="overlay">
                        <div class="text">Услуга 4</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative service-block">
                    <img src="https://placeholder.pics/svg/100x100" class="img-fluid rounded-circle" alt="Placeholder">
                    <div class="overlay">
                        <div class="text">Услуга 5</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative service-block">
                    <img src="https://placeholder.pics/svg/100x100" class="img-fluid rounded-circle" alt="Placeholder">
                    <div class="overlay">
                        <div class="text">Услуга 6</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <!-- Блоки с анимацией при наведении -->
            <div class="col-md-2">
                <div class="position-relative service-block">
                    <img src="https://placeholder.pics/svg/100x100" class="img-fluid rounded-circle" alt="Placeholder">
                    <div class="overlay">
                        <div class="text">Услуга 7</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative service-block">
                    <img src="https://placeholder.pics/svg/100x100" class="img-fluid rounded-circle" alt="Placeholder">
                    <div class="overlay">
                        <div class="text">Услуга 8</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative service-block">
                    <img src="https://placeholder.pics/svg/100x100" class="img-fluid rounded-circle" alt="Placeholder">
                    <div class="overlay">
                        <div class="text">Услуга 9</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative service-block">
                    <img src="https://placeholder.pics/svg/100x100" class="img-fluid rounded-circle" alt="Placeholder">
                    <div class="overlay">
                        <div class="text">Услуга 10</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative service-block">
                    <img src="https://placeholder.pics/svg/100x100" class="img-fluid rounded-circle" alt="Placeholder">
                    <div class="overlay">
                        <div class="text">Услуга 11</div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative service-block">
                    <img src="https://placeholder.pics/svg/100x100" class="img-fluid rounded-circle" alt="Placeholder">
                    <div class="overlay">
                        <div class="text">Услуга 12</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Promo Section with Slider -->
<section class="promo py-5">
    <div class="container">
        <div id="promoCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#promoCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#promoCarousel" data-slide-to="1"></li>
                <li data-target="#promoCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Carousel Inner -->
            <div class="bg-dark carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://placeholder.pics/svg/500x500" class="img-fluid" alt="Promo 1">
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <h2>Экономия до 100 000тг</h2>
                            <p>На выбранны.</p>
                            <a href="#" class="btn btn-primary w-50">Shop</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://placeholder.pics/svg/500x500" class="img-fluid" alt="Promo 2">
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <h2>Exclusive Offer</h2>
                            <p>Get 20% off on select smartphones.</p>
                            <a href="#" class="btn btn-primary w-50">Shop</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://placeholder.pics/svg/500x500" class="img-fluid" alt="Promo 3">
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <h2>New Arrivals</h2>
                            <p>Check out the latest gadgets in stock.</p>
                            <a href="#" class="btn btn-primary w-50">Shop</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#promoCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#promoCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>

<!-- On Sale Section -->
<section class="on-sale py-5">
    <div class="container">
        <h2 class="text-center">Популярные товары</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0">

                    <img src="https://placeholder.pics/svg/200x200" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">Цена: $70.00</p>
                        <a href="#" class="btn btn-primary">Купить</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0">

                    <img src="https://placeholder.pics/svg/200x200" class="card-img-top" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">Цена: $70.00</p>
                        <a href="#" class="btn btn-primary">Купить</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0">

                    <img src="https://placeholder.pics/svg/200x200" class="card-img-top" alt="Product 3">
                    <div class="card-body">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">Цена: $70.00</p>
                        <a href="#" class="btn btn-primary">Купить</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0">

                    <img src="https://placeholder.pics/svg/200x200" class="card-img-top" alt="Product 4">
                    <div class="card-body">
                        <h5 class="card-title">Product 4</h5>
                        <p class="card-text">Цена: $70.00</p>
                        <a href="#" class="btn btn-primary">Купить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
