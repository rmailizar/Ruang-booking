<nav class="sidebar sidebar-offcanvas " id="sidebar">
    <ul class="nav">

      <li class="nav-item">
        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
          <i class="menu-icon mdi mdi-grid-large"></i>
          <span class="menu-title">Dashboard</span>
        </x-nav-link>
      </li>

      <li class="nav-item nav-category">Data Website</li>

      <li class="nav-item">
        <x-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')">
          <i class="menu-icon mdi mdi-city"></i>
          <span class="menu-title">Data Ruangan</span>
        </x-nav-link>
      </li>

      <li class="nav-item">
        <x-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.index')">
          <i class="menu-icon mdi mdi-clipboard-text"></i>
          <span class="menu-title">Data Peminjaman</span>
        </x-nav-link>
      </li>

      <li class="nav-item">
        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
          <i class="menu-icon mdi mdi-account-circle-outline"></i>
          <span class="menu-title">Data Pengguna</span>
        </x-nav-link>
      </li>

      <li class="nav-item nav-category">Peminjaman</li>

      <li class="nav-item">
        <x-nav-link :href="route('bookings.roomList')" :active="request()->routeIs('bookings.roomList')">
          <i class="menu-icon mdi mdi-folder-move"></i>
          <span class="menu-title">Pinjam Ruangan</span>
        </x-nav-link>
      </li>

      <li class="nav-item">
        <x-nav-link :href="route('bookings.myBookings')" :active="request()->routeIs('bookings.myBookings')">
            <i class="menu-icon mdi mdi-calendar-check"></i>
            <span class="menu-title">Peminjaman Saya</span>
        </x-nav-link>
      </li>

      <li class="nav-item">
        <x-nav-link :href="route('calendar.index')" :active="request()->routeIs('calendar.index')">
          <i class="menu-icon mdi mdi-calendar-clock "></i>
          <span class="menu-title">Jadwal Peminjaman</span>
        </x-nav-link>
      </li>

      <li class="nav-item nav-category">Lainnya</li>

      <li class="nav-item">
        <x-nav-link :href="route('biodata')" :active="request()->routeIs('biodata')">
          <i class="menu-icon mdi mdi-account-box-outline"></i>
          <span class="menu-title">Biodata</span>
        </x-nav-link>
      </li>

      <li class="nav-item">
        <x-nav-link :href="route('logout')" :active="false">
          <i class="menu-icon mdi mdi-exit-to-app"></i>
          <span class="menu-title">Log out</span>
        </x-nav-link>
      </li>
    </ul>
  </nav>

  