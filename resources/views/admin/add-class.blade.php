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
                  <h3>Add Class</h3>
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
              <div class="col-md-9 col-lg-10">
                <div class="edit-profile">
                  <div class="row">
                    <div class="col-xl-12">
                      <form class="card" method="POST"
      action="{{ isset($class) ? route('admin.class.update', $class->id) : route('admin.class.store') }}"
      enctype="multipart/form-data">

    @csrf
    @if(isset($class))
        @method('PUT')
    @endif

    <div class="card-header pb-0">
        <h4 class="card-title mb-0">Add Class</h4>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>

    <div class="card-body">

        <!-- GRID 4 KOLOM -->
        <div class="row g-4">

            <!-- Class Name -->
            <div class="col-md-3">
                <label class="form-label">Class Name</label>
                <input class="form-control" name="name" type="text" placeholder="Class"
                       value="{{ old('name', $class->name ?? '') }}">
            </div>

            <!-- Max Person -->
            <div class="col-md-3">
                <label class="form-label">Max Person</label>
                <input class="form-control" name="max" type="number" step="1" placeholder="Max Person"
                       value="{{ old('max', $class->max ?? '') }}">
            </div>

            <!-- Price -->
            <div class="col-md-3">
                <label class="form-label">Price (Rupiah)</label>
                <input class="form-control" name="price" type="number" step="0.01"
                       placeholder="Rupiah" value="{{ old('price', $class->price ?? '') }}">
            </div>

            <!-- Location -->
            <div class="col-md-3">
                <label class="form-label">Location</label>
                <input class="form-control" name="location" type="text" placeholder="Location"
                       value="{{ old('location', $class->location ?? '') }}">
            </div>

            <!-- Starts At -->
            <div class="col-md-3">
                <label class="form-label">Starts At</label>
                <input class="form-control" name="starts_at" type="datetime-local" placeholder="Start Date & Time"
                       value="{{ old('starts_at') }}">
            </div>

        </div>

        <!-- GRID UNTUK DAY + START TIME + END TIME -->
        <div class="row g-4 mt-2">

            <!-- Select Day -->
            <div class="col-md-4">
                <label class="form-label d-block">Select Day</label>

                <button id="dropdownRadioBgHoverButton" data-dropdown-toggle="dropdownRadioBgHover"
                    class="inline-flex items-center justify-center text-white bg-brand border border-transparent
                           hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium
                           rounded-md text-sm px-4 py-2.5 w-100" type="button">
                    {{ old('day', $class->day ?? 'Select Day') }}
                    <svg class="w-4 h-4 ms-1.5 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" fill="none" width="24" height="24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="m19 9-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="dropdownRadioBgHover"
                     class="z-10 hidden bg-white border rounded-md shadow-lg w-44 mt-1">

                    <ul class="p-2 text-sm">

                        @foreach(['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)
                        <li>
                            <label class="inline-flex items-center w-full p-2 hover:bg-gray-100 rounded cursor-pointer">
                                <input type="radio" name="day" value="{{ $day }}"
                                       {{ old('day', $class->day ?? '') == $day ? 'checked' : '' }}
                                       class="w-4 h-4 rounded-full border-gray-400">
                                <span class="ms-2">{{ $day }}</span>
                            </label>
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>


<!-- Time 1 -->
<div class="col-md-4 relative">
    <label for="time_1" class="block mb-1 text-sm font-medium text-heading">Time 1</label>
    <input
        type="time"
        id="time_1"
        name="time_1"
        class="block w-full p-2.5 pr-10 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-md focus:ring-brand focus:border-brand shadow-xs"
        min="09:00"
        max="18:00"
        required
    />
</div>

<!-- Time 2 -->
<div class="col-md-4 relative">
    <label for="time_2" class="block mb-1 text-sm font-medium text-heading">Time 2</label>
    <input
        type="time"
        id="time_2"
        name="time_2"
        class="block w-full p-2.5 pr-10 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-md focus:ring-brand focus:border-brand shadow-xs"
        min="09:00"
        max="18:00"
        required
    />
</div>

        </div>

        <!-- GRID 2 KOLOM -->
        <div class="row g-4 mt-2">

            <!-- Duration -->
            <div class="col-md-6">
                <label class="form-label">Duration (Minutes)</label>
                <input class="form-control" name="duration_minutes"
                       type="number" min="1" placeholder="Minutes"
                       value="{{ old('duration_minutes', $class->duration_minutes ?? '') }}">
            </div>

            <!-- Image -->
            <div class="col-md-6">
                <label class="form-label">Image Product</label>
                <input class="form-control" name="image" type="file" accept="image/*">

                @if(isset($class) && $class->image_path)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$class->image_path) }}" class="img-thumbnail"
                             style="width:160px;height:160px;object-fit:cover;">
                        <small class="text-muted">Current image preview</small>
                    </div>
                @endif
            </div>

        </div>

        <!-- DESCRIPTION FULL WIDTH -->
        <div class="mt-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="5"
                      placeholder="Enter description">{{ old('description', $class->description ?? '') }}</textarea>
        </div>

    </div>

    <div class="card-footer text-end">
        <button class="btn btn-primary px-4" type="submit">Save</button>
    </div>
</form>
                    </div>
                  </div>
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
