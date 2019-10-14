<div class="col-md-3 clearfix">
                <div class="header-ctn">
                    <!-- Wishlist -->
                    <div>
                        <a href="#">
                            <i class="fa fa-heart-o"></i>
                            <span>Lista de deseos</span>
                            <div class="qty">2</div>
                        </a>
                    </div>
                    <!-- /Wishlist -->

                    <!-- Cart -->
                    <div class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Tu carrito</span>
                            @if(\Session::get('carrito') != null)
                            <div class="qty">{{ count(\Session::get('carrito')) }}</div>
                            @endif
                        </a>

                        @if(\Session::get('carrito') != null)
                        <div class="cart-dropdown">
                            <div class="cart-list">
                                
                                @foreach( \Session::get('carrito') as $item)                                
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{ asset( $item->imagenes()->where('default','=','1')->first()->url ) }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><a href="#">{{ $item->nombre }}</a></h3>
                                        <h4 class="product-price"><span class="qty">{{ $item->cantidad }}x</span>$ {{ number_format($item->precio,0) }}</h4>
                                    </div>
                                    <!-- <button class="delete"><i class="fa fa-close"></i></button> -->
                                </div>
                                @endforeach

                            </div>
                            <div class="cart-summary">
                                <small>{{ count(\Session::get('carrito')) }} Item(s) seleccionados</small>
                                <h5>SUB TOTAL: {{ number_format(\Session::get('subTotal'),0) }} </h5>
                            </div>
                            <div class="cart-btns">
                                <a href="/carrito">Ver carrito</a>
                                <a href="/vaciarCarrito">Vaciar  carrito <i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- /Cart -->

                    <!-- Menu Toogle -->
                    <div class="menu-toggle">
                        <a href="#">
                            <i class="fa fa-bars"></i>
                            <span>Menu</span>
                        </a>
                    </div>
                    <!-- /Menu Toogle -->
                </div>
            </div>