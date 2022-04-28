<nav class="navbar navbar-expand-lg navbar-dark bg-primary-light w-100 py-0 border-bottom">
  <div class="container">
      <? /* <a class="navbar-brand" href="#"><img class="logo" src="<?= $this->frontThemePath ?>/images/logo.png"
                                          title="ddp.kz - абсолютно всё и только для Вас!"></a> */ ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop"
            aria-controls="navbarTop" aria-expanded="false" aria-label="Меню">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTop">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle"
                                         data-toggle="dropdown"><i class="fa fa-fw fa-map-marker"></i>Нур-Султан</a>
          <ul class="dropdown-menu bg-primary-light text-white">
            <li><a class="dropdown-item" href="#">Алматы</a></li>
            <li><a class="dropdown-item" href="#">Астана</a></li>
            <li class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Выбрать на карте</a></li>
          </ul>
        </li>
      </ul>

      <ul class="navbar-nav mx-auto">
        <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Продавцы</a>
          <ul class="dropdown-menu bg-primary-light">
            <li><a class="dropdown-item" href="#">ТОП-100 продавцов</a></li>
            <li><a class="dropdown-item" href="#">Все продавцы</a></li>
            <li class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Стать продавцом</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle"
                                         data-toggle="dropdown">Сервисцентр</a>
          <ul class="dropdown-menu bg-primary-light">
            <li><a class="dropdown-item" href="#">ТОП-100 сервисцентров</a></li>
            <li><a class="dropdown-item" href="#">Авторизованные сервисцентры</a></li>
            <li><a class="dropdown-item" href="#">Все сервисцентры</a></li>
            <li><a class="dropdown-item" href="#">Стать сервисцентром</a></li>

          </ul>
        </li>
        <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Помощь</a>
          <ul class="dropdown-menu bg-primary-light">
            <li><a class="dropdown-item" href="#">Онлайн поддержка</a></li>
            <li><a class="dropdown-item" href="#">Документация</a></li>
            <li><a class="dropdown-item" href="#">Для разработчиков</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item text-white"><a href="tei:223322223322" target="_blank" class="nav-link"><i
                class="fa fa-fw fa-phone"
                aria-hidden="true"></i> 223-322-223-322</a></li>
        <li class="nav-item text-white"><a href="tel:2128506" target="_blank" class="nav-link"><i class="fa fa-fw
        fa-mobile" aria-hidden="true"></i> 2-21-85-06</a></li>

      </ul> <!-- navbar-nav.// -->
    </div> <!-- collapse.// -->
  </div>
</nav>

<section class="header-main border-bottom shadow-sm">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-2 col-4">
        <div class="brand-wrap">
          <img class="logo" src="<?= $this->frontThemePath ?>/images/logo.png">
        </div> <!-- brand-wrap.// -->
      </div>
      <div class="col-lg-6 col-sm-12">
          <? // Блок поискового запроса ?>
          <?php $this->widget('application.components.widgets.SearchQueryBlock'); ?>
        <!-- search-wrap .end// -->
      </div> <!-- col.// -->
      <div class="col-lg-4 col-sm-6 col-8">
        <div class="widgets-wrap d-flex flex-row mx-3 justify-content-end">
          <div class="widget-header px-auto">
            <div class="icontext">
              <a href="#" class="icon icon-sm" title="">
                <i class="text-secondary icon-sm fa fa-chart-bar"></i>
                <span class="fa-caption text-dark">Сравнение</span>
              </a>
              <span class="badge badge-pill badge-danger notify">0</span>
            </div>
          </div>

          <div class="widget-header px-auto">
            <div class="icontext">
              <a href="#" class="icon icon-sm" title="">
                <i class="text-secondary icon-sm fa fa-heart"></i>
                <span class="fa-caption text-dark">Избранное</span>
              </a>
              <span class="badge badge-pill badge-info notify">5</span>
            </div>
          </div>

          <div class="widget-header px-auto">
            <div class="icontext">
              <a href="<?= Yii::app()->createUrl('/cart/index') ?>"
                 class="icon icon-sm" title="">
                <i class="text-secondary icon-sm fa fa-shopping-cart"></i>
                <span class="fa-caption text-dark">Корзина</span>
              </a>
              <span class="badge badge-pill badge-success notify">12</span>
            </div>
          </div>

          <div class="widget-header px-auto dropdown">
            <div class="icontext">
              <a href="#" class="icon icon-sm" title=""
                 data-toggle="dropdown"
                 data-hover="dropdown"
                 href="<?= Yii::app()->createUrl('/cabinet') ?>"> <?/* data-offset="20,10" */?>
                <i class="text-secondary icon-sm fa fa-user"></i>
                <span class="fa-caption text-dark">Кабинет</span>
              </a>
              <span><i class="fa fa-caret-down"></i></span>
              <ul class="dropdown-menu dropdown-menu-right cabinet">
                  <? // Блок логина, входа в кабинет?>
                  <? $this->widget('application.components.widgets.userBlock'); ?>
              </ul>
            </div>  <!-- widget-header .// -->
          </div> <!-- widgets-wrap.// row.// -->
        </div>
        <!-- ================== -->
      </div> <!-- col.// -->
    </div> <!-- row.// -->
  </div> <!-- container.// -->
</section> <!-- header-main .// -->

<nav class="navbar navbar-main navbar-expand-lg navbar-light border-bottom">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav"
            aria-expanded="false" aria-label="Навигация">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main_nav">

      <div class="category-wrap menu-heading dropdown py-0">
        <a href="/category/list" role="button" class="btn btn-link dropdown-toggle text-secondary"
          data-toggle="dropdown"
           data-hover="dropdown" aria-pressed="false"><i class="fa fa-list"></i>
          Каталог товаров</a>
        <div class="dropdown-menu">
         <?/* <!-- Mega Menu -->
          <div class="menu3dmega vertical menuMegasub menuOther" id="menuMega">
              <? if (!Yii::app()->request->isAjaxRequest && !(isset($this->preLoading) && $this->preLoading)) { ?>
                <script>
                    setTimeout(function () {
                        loadCatalogMenu(lang, 1000);
                    }, 100);
                </script>
              <? } ?>
          </div>
          <!-- end: Mega Menu -->
            */?>
            <?/*
          <!-- Mega Menu -->
          <div class="menu3dmega vertical" id="menuMega">
            <div class="bgr hidden-xs hidden-sm"></div>
            <script>
                loadCatalogMenu(lang, 7);
            </script>
          </div>
          <!-- end: Mega Menu -->
           */?>
          <?/*
          <a class="dropdown-item" href="#">Machinery / Mechanical Parts / Tools </a>
          <a class="dropdown-item" href="#">Consumer Electronics / Home Appliances </a>
          <a class="dropdown-item" href="#">Auto / Transportation</a>
          <a class="dropdown-item" href="#">Apparel / Textiles / Timepieces </a>
          <a class="dropdown-item" href="#">Home & Garden / Construction / Lights </a>
          <a class="dropdown-item" href="#">Beauty & Personal Care / Health </a>
          */?>
        </div>
      </div>

      <div class="navbar-divider py-0 pl-3">|</div>

      <ul class="navbar-nav py-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"> Покупателям</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Foods and Drink</a>
            <a class="dropdown-item" href="#">Home interior</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Category 1</a>
            <a class="dropdown-item" href="#">Category 2</a>
            <a class="dropdown-item" href="#">Category 3</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"> Помощь</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Foods and Drink</a>
            <a class="dropdown-item" href="#">Home interior</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Category 1</a>
            <a class="dropdown-item" href="#">Category 2</a>
            <a class="dropdown-item" href="#">Category 3</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"> Продавать</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Foods and Drink</a>
            <a class="dropdown-item" href="#">Home interior</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Category 1</a>
            <a class="dropdown-item" href="#">Category 2</a>
            <a class="dropdown-item" href="#">Category 3</a>
          </div>
        </li>
      <?/* <li class="nav-item">
          <a class="nav-link" href="#">Furnitures</a>
        </li> */?>
      </ul>
    </div> <!-- collapse .// -->
  </div> <!-- container .// -->
</nav>

