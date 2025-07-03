<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield(section: 'title')</title>
  @yield('style')
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
      <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">Textile ERP</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                          Suppliers
                      </a>
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ route('suppliers.index') }}">All Suppliers</a></li>
                          <li><a class="dropdown-item" href="{{ route('suppliers.create') }}">Add New Supplier</a></li>
                      </ul>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                          Yarn Management
                      </a>
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ route('yarn.purchase.index') }}">Purchase Orders</a></li>
                          <li><a class="dropdown-item" href="{{ route('yarn.purchase.create') }}">New Purchase Order</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="{{ route('yarn.inventory.index') }}">Inventory</a></li>
                      </ul>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                          Dyeing Department
                      </a>
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ route('dyeing.index') }}">All Batches</a></li>
                          <li><a class="dropdown-item" href="{{ route('dyeing.create') }}">New Batch</a></li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Reports</a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
  .
    @yield('content')
    @stack('scripts')
    
  </div>

</body>

</html>