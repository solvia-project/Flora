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
                <button class="btn btn-primary-light" type="button"><a href="login_two.html"><i data-feather="log-out"></i>Log out</a></button>
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
                  <h3>Class</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                    <li class="breadcrumb-item">Class</li>
                  </ol>
                </div>

              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- HTML (DOM) sourced data  Starts-->
              <div class="col-sm-12">
                <div class="card">

                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="data-source-1" style="width:100%">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Image Product</th>
                            <th>Class Name</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Date & Time</th>
                            <th>Duration</th>
                            <th>Description</th>
                            <th>Update at</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach(($classes ?? []) as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>
                                    @if($c->image_path)
                                        <img src="{{ asset('storage/'.$c->image_path) }}" alt="image" style="width:40px;height:40px;object-fit:cover;">
                                    @else
                                        <div class="w-10 h-10 bg-gray-300"></div>
                                    @endif
                                </td>
                                <td>{{ $c->name }}</td>
                                <td>Rp{{ number_format($c->price, 0, ',', '.') }}</td>
                                <td>{{ $c->location }}</td>
                                <td>{{ optional($c->starts_at)->format('d-m-Y H:i') }}</td>
                                <td>{{ $c->duration_minutes }} Minutes</td>
                                <td>{{ Str::limit($c->description, 120) }}</td>
                                <td>{{ $c->updated_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    <a class="bg-yellow-600 p-2 rounded-2xl text-white" href="{{ route('admin.class.edit', ['id' => $c->id]) }}">edit</a>
                                </td>
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
