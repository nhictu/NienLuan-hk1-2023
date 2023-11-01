<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('storage/icon/STOREG4.png') }}" alt="Nhom 04" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ request()->is('/') ? 'active has-sub' : '' }}">
                    <a href="{{ URL::to('/phieu-ban-hang') }}">
                        <i class="fas fa-copy"></i> Quản lí bán hàng </a>
                </li>
                <li class="{{ request()->is('products') ? 'active has-sub' : '' }}">
                    <a href="{{ URL::to('/products') }}">
                        <i class="fas fa-chart-bar"></i>Quản lí sản phẩm</a>
                </li>
                <li>
                    <a href="{{ URL::to('/suppliers') }}">
                        <i class="fas fa-table"></i>Quản lí nhà cung cấp</a>
                </li>
                <li class="{{ request()->is('phieu-nhap-hang') ? 'active has-sub' : '' }}">
                    <a href="{{ URL::to('/phieu-nhap-hang') }}">
                        <i class="fas fa-copy"></i>Quản lí nhập hàng</a>
                </li>

                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-calendar-alt"></i>Quản lí báo cáo</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="{{ URL::to('/salereport') }}">
                                Báo cáo bán hàng</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/rp_inventory') }}">
                                Báo cáo hàng tồn</a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
