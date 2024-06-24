  <!-- header -->
  <header class="header">
      <!-- logo -->
      <div class="logo">
          <a href="{{ route('index') }}">
              <img src="theme1-assets/images/logo/dar-logo3.svg" alt="">
          </a>
      </div>
      <!-- ./logo -->

      <!-- heading -->
      <div class="heading">
          <!-- user -->
          <div class="user">
              Hello, <span>{{ auth()->user()->FullName }}</span>
          </div>
          <!-- ./user -->
          <!-- nav -->
          <ul class="breadcrumb">
              <li><a href="{{ route('index') }}">Home</a></li>
              <li><a href="{{ route('cart.index') }}">My Cart</a></li>
              <li>checkout</li>
          </ul>
          <!-- ./nav -->
      </div>
      <!-- ./heading -->
  </header>
  <!--,./header -->
