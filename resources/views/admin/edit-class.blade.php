<x-admin-app>
  <body>
    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right row m-0">
          <div class="left-menu-header col">
          </div>
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

      <!-- Page Body Start-->
      <div class="page-body-wrapper horizontal-menu">
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Edit Class</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                    <li class="breadcrumb-item">Class</li>
                    <li class="breadcrumb-item active">Edit</li>
                  </ol>
                </div>

              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="edit-profile">
              <div class="row">
                <div class="col-xl-8">
                  <form class="card" method="POST" action="{{ isset($class) ? route('admin.class.update', $class->id) : route('admin.class.store') }}" enctype="multipart/form-data">
                    <div class="card-header pb-0">
                      <h4 class="card-title mb-0">Edit Profile</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Class Name</label>
                            @csrf
                            @if(isset($class))
                                @method('PUT')
                            @endif
                            <input class="form-control" name="name" type="text" placeholder="Class" value="{{ old('name', $class->name ?? '') }}">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Price (Rupiah)</label>
                            <input class="form-control" name="price" type="number" step="0.01" placeholder="Rupiah" value="{{ old('price', $class->price ?? '') }}">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input class="form-control" name="location" type="text" placeholder="Location" value="{{ old('location', $class->location ?? '') }}">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Date & Time</label>
                            <input class="form-control" name="starts_at" type="datetime-local" value="{{ old('starts_at', isset($class) && $class->starts_at ? $class->starts_at->format('Y-m-d\TH:i') : '') }}" placeholder="Date & Time">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Duration (Hours)</label>
                            <input class="form-control" name="duration_minutes" type="number" min="1" placeholder="Minutes" value="{{ old('duration_minutes', $class->duration_minutes ?? '') }}">
                          </div>
                        <div class="mb-3">
                            <label class="form-label">Image Product</label>
                            <input class="form-control" name="image" type="file" accept="image/*" placeholder="Drag & Drop File / Browse">
                          </div>
                        </div>
                        <div class="col-md-9">
                          <div>
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="5" placeholder="Enter About your description">{{ old('description', $class->description ?? '') }}</textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-end">
                      <button class="bg-pink-300 px-4 py-2 rounded-2xl" type="submit">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->

      </div>
    </div>
</x-admin-app>
