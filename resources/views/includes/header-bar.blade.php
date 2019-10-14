<!-- MAIN HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class="col-md-3">
                <div class="header-logo">
                    <a href="#" class="logo">
                        <img src="./img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <!-- /LOGO -->

            <!-- SEARCH BAR -->
            <div class="col-md-6">
                <div class="header-search">
                    <form>
                        <select class="input-select">
                            <option value="0">Todas</option>
                            <option value="1">Categoría 01</option>
                            <option value="1">Categoría 02</option>
                        </select>
                        <input class="input" placeholder="Buscar aquí">
                        <button class="search-btn">Buscar</button>
                    </form>
                </div>
            </div>
            <!-- /SEARCH BAR -->

            <!-- ACCOUNT -->
            @include('includes.cart-header')
            <!-- /ACCOUNT -->
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</div>
<!-- /MAIN HEADER -->