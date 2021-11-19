<!-- ########## START: LEFT PANEL ########## -->
<div class="sl-logo"><a href="/"><i class="icon ion-android-star-outline"></i> starlight</a></div>
<div class="sl-sideleft">
    <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
    </div><!-- input-group -->

    <label class="sidebar-label">Navigation</label>
    <div class="sl-sideleft-menu">
        <a href="{{ route('admin.dashboard') }}" class="sl-menu-link active">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                <span class="menu-item-label">Categories</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link">Categories</a></li>
            <li class="nav-item"><a href="{{ route('brands.index') }}" class="nav-link">Brands</a></li>
        </ul>
        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-cart-arrow-down"></i>
                <span class="menu-item-label">Products</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link">All products</a></li>
            <li class="nav-item"><a href="{{ route('products.create') }}" class="nav-link">Add product</a></li>
        </ul>
        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-shopping-basket"></i>
                <span class="menu-item-label">Orders</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.orders.pending') }}" class="nav-link">Pending orders</a></li>
            <li class="nav-item"><a href="{{ route('admin.orders.accepted') }}" class="nav-link">Payment accept</a></li>
            <li class="nav-item"><a href="{{ route('admin.orders.process') }}" class="nav-link">Process delivery</a></li>
            <li class="nav-item"><a href="{{ route('admin.orders.delivered') }}" class="nav-link">Delivery done</a></li>
            <li class="nav-item"><a href="{{ route('admin.orders.canceled') }}" class="nav-link">Canceled orders</a></li>
        </ul>
        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon fa fa-money"></i>
                <span class="menu-item-label">Coupons</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('coupons.index') }}" class="nav-link">Coupons</a></li>
        </ul>
        <a href="#" class="sl-menu-link">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Others</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('newsletters.index') }}" class="nav-link">Newsletters</a></li>
        </ul>
    </div><!-- sl-sideleft-menu -->
    <br>
</div><!-- sl-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->
