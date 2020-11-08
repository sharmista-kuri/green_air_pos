<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('sales.create')}}">
              <i class="mdi mdi-sale menu-icon"></i>
              <span class="menu-title">Sales</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('purchases.create')}}">
              <i class="mdi mdi-cart menu-icon"></i>
              <span class="menu-title">Purchase</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('transactions.create')}}">
              <i class="mdi mdi-cash menu-icon"></i>
              <span class="menu-title">Transaction</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-circle-outline menu-icon"></i>
              <span class="menu-title">Reports</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('sales.index')}}">All Sales Report</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('purchases.index')}}">All Purchase Report</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-circle-outline menu-icon"></i>
              <span class="menu-title">Settings</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('categories.create')}}">Add Category</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('brands.create')}}">Add Brand</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('products.create')}}">Add Product</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('customers.create')}}">Add Customer</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('suppliers.create')}}">Add Supplier</a></li>
              </ul>
            </div>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-circle-outline menu-icon"></i>
              <span class="menu-title">UI Elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/typography.html">Typography</a></li>
              </ul>
            </div>
          </li> -->
          
        </ul>
      </nav>