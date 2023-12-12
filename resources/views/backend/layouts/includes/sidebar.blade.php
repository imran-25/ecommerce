<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Product Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

        @can('category-list')
            <li>
                <a href="{{ route('categories.index')}}">
                <i class="bi bi-circle"></i><span>Categories</span>
                </a>
            </li>
        @endcan

        @can('product-list')
         <li>
            <a href="{{ route('products.index')}}">
              <i class="bi bi-circle"></i><span>Products</span>
            </a>
          </li>
        @endcan
        
        </ul>
      </li><!-- End Components Nav -->

    </ul>

  </aside>
