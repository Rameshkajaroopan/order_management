<!-- need to remove -->
<li class="nav-item">
  <a href="{{ route('home') }}" class="nav-link active">
    <i class="nav-icon fas fa-home"></i>
    <p>Home</p>
  </a>
</li>
</br>
<!-- Sidebar Menu -->

<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-edit"></i>
    <p>
      Orders
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/pendingOrder" class="nav-link">
        <i class="fa fa-battery-empty nav-icon"></i>
        <p>Notstart Orders</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/pendingInProgressOrder" class="nav-link">
        <i class="fa fa-battery-half nav-icon"></i>
        <p>Inprogress Orders</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/completedOrder" class="nav-link">
        <i class="fa fa-battery-full nav-icon"></i>
        <p>Completed Orders</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/exceptionalOrder" class="nav-link">
        <i class="fa fa-window-close nav-icon"></i>
        <p>Stoped Orders</p>
      </a>
    </li>
  </ul>
</li>
</br>
<li class="nav-item">
  <a href="{{route('user.index')}}" class="nav-link">
    <i class="nav-icon fas fa-user"></i>
    <p>
      Users
      <i class="fas fa-angle-right right"></i>
      <span class="badge badge-info right"></span>
    </p>
  </a>
</li>


</br>
<li class="nav-item">
  <a href="{{route('branch.index')}}" class="nav-link">
    <i class="nav-icon fas fa-bookmark"></i>
    <p>
      Branches
      <i class="fas fa-angle-right right"></i>
      <span class="badge badge-info right"></span>
    </p>
  </a>
</li></br>

<li class="nav-item">
  <a href="{{route('location.index')}}" class="nav-link">
    <i class="nav-icon fas fa-map-marker"></i>
    <p>
      Locations
      <i class="fas fa-angle-right right"></i>
      <span class="badge badge-info right"></span>
    </p>
  </a>
</li>

</br>