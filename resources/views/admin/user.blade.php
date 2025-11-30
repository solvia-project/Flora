<x-admin-app>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right row m-0">

          <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
              <li class="onhover-dropdown p-0">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="btn btn-primary-light" type="submit"><i data-feather="log-out"></i>Log out</button>
                </form>
              </li>
            </ul>
          </div>
          <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper horizontal-menu">

        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Booking</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                    <li class="breadcrumb-item">Booking</li>
                  </ol>
                </div>

              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3 col-lg-2 mb-3">
                <div class="card">
                  <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                      <a href="{{ route('admin.booking.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.booking.index') ? 'active' : '' }}">Booking</a>
                      <a href="{{ route('admin.user.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.user.index') ? 'active' : '' }}">Users</a>
                      <a href="{{ route('admin.class.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.class.index') ? 'active' : '' }}">Classes</a>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- HTML (DOM) sourced data  Starts-->
              <div class="col-md-9 col-lg-10">
                <div class="card">

                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="data-source-1" style="width:100%">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created at</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach(($users ?? []) as $u)
                                <tr>
                                    <td>{{ ($users->firstItem() ?? 1) + $loop->index }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->phone ?? '-' }}</td>
                                    <td>{{ $u->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
      </div>
    </div>
  </body>
</x-admin-app>
