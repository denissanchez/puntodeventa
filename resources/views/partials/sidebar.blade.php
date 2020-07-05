<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            CALI<span>DAD</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Inicio</li>
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Lista de ventas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#product" role="button" aria-expanded="false" aria-controls="product">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">Productos</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="product">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('productos.index') }}" class="nav-link">Lista de productos</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('productos.create') }}" class="nav-link">Registrar</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#purchase" role="button" aria-expanded="false" aria-controls="purchase">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">Compras</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="purchase">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('compras.index') }}" class="nav-link">Lista de compras</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('compras.create') }}" class="nav-link">Registrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('proveedores.index') }}" class="nav-link">Proveedores</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('proveedores.create') }}" class="nav-link">Registrar proveedor</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">Administración</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="users">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('usuarios.index') }}" class="nav-link">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('usuarios.index') }}" class="nav-link">Registrar usuario</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
