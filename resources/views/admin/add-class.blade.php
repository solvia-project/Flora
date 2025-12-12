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
                      <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
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

                          @if(session('error'))
                          <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                          @endif
                          @if($errors->any())
                          <div class="alert alert-warning" role="alert">
                            <ul class="mb-0">
                              @foreach($errors->all() as $error)
                              <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                          </div>
                          @endif

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

                          </div>

                          <!-- GRID UNTUK DAY + START TIME + END TIME -->
                          <div class="row g-4 mt-2">

                            <!-- Select Days -->
                            <div class="col-md-4 position-relative">
                              <label class="form-label">Select Days</label>

                              @php $initialDays = array_map('strtolower', old('day', [])); @endphp
                              <div x-data='daySelector(@json($initialDays))' class="w-full">

                                <!-- Button -->
                                <button type="button"
                                  @click="open = !open"
                                  class="form-control text-left d-flex justify-content-between align-items-center">
                                  <span x-text="buttonText()">Select Days</span>
                                  <i class="fa fa-chevron-down text-muted"></i>
                                </button>

                                <!-- Dropdown -->
                                <div x-show="open"
                                  @click.outside="open = false"
                                  class="position-absolute bg-white border rounded shadow p-3 w-100 mt-1"
                                  style="display: none; z-index: 100; max-height: 200px; overflow-y: auto;">

                                  <template x-for="day in days" :key="day.value">
                                    <label class="d-flex align-items-center gap-2 mb-1">
                                      <input type="checkbox" :value="day.value" x-model="selectedDays" name="day[]">
                                      <span x-text="day.label"></span>
                                    </label>
                                  </template>

                                </div>
                              </div>
                            </div>

                            <!-- Time 1 -->
                            <div class="col-md-4">
                              <label for="time_1" class="form-label">Time 1</label>
                              <input
                                type="time"
                                id="time_1"
                                name="time_1"
                                class="form-control"
                                min="09:00"
                                max="18:00"
                                required />
                            </div>

                            <!-- Time 2 -->
                            <div class="col-md-4">
                              <label for="time_2" class="form-label">Time 2</label>
                              <input
                                type="time"
                                id="time_2"
                                name="time_2"
                                class="form-control"
                                min="09:00"
                                max="18:00"
                                required />
                            </div>

                          </div>


                          <!-- GRID 2 KOLOM -->
                          <div class="row g-4 mt-2">

                            <!-- Duration -->
                            <div class="col-md-6">
                              <label class="form-label">Duration (Hours)</label>
                              <input class="form-control" name="duration_minutes"
                                type="number" min="1" placeholder="Hours"
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


<script>
  function daySelector(initial = []) {
    return {
      open: false,
      selectedDays: initial,
      days: [{
          value: 'monday',
          label: 'Monday'
        },
        {
          value: 'tuesday',
          label: 'Tuesday'
        },
        {
          value: 'wednesday',
          label: 'Wednesday'
        },
        {
          value: 'thursday',
          label: 'Thursday'
        },
        {
          value: 'friday',
          label: 'Friday'
        },
        {
          value: 'saturday',
          label: 'Saturday'
        },
        {
          value: 'sunday',
          label: 'Sunday'
        },
      ],
      buttonText() {
        if (this.selectedDays.length === 0) {
          return 'Select Days';
        }
        let selectedLabels = this.days
          .filter(d => this.selectedDays.includes(d.value))
          .map(d => d.label);
        if (selectedLabels.length > 3) {
          return `${selectedLabels.length} days selected`;
        }
        return selectedLabels.join(', ');
      }
    };
  }
</script>
