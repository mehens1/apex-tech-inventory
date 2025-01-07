<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">
                <li class="menu-title"><span>Main</span></li>
                <li>
                    <a href="{{ route('dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>

                <!-- Inventory -->
                <li class="menu-title"><span>Inventory</span></li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-package"></i> <span> Products</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('products') }}">Product List</a></li>
                        <li><a href="#">Category</a></li>

                        <li><a href="#">Units</a></li>
                    </ul>
                </li>

                <!-- Settings -->
                <li class="menu-title"><span>Settings</span></li>
                <li>
                    <a href="#"><i class="fe fe-settings"></i> <span>Profile</span></a>
                </li>
                <li>
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fe fe-power"></i> <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>
    </div>
</div>
