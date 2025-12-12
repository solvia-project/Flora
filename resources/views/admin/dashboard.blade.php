<x-admin-app>

  <body>
    <div class="loader-wrapper">
      <div class="theme-loader">
        <div class="loader-p"></div>
      </div>
    </div>
    <div class="page-wrapper" id="pageWrapper">
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
      <div class="page-body-wrapper horizontal-menu">
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Dashboard</h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
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
                <div class="row">
                  <div class="col-12 mb-4">
                    <div class="card">
                      <div class="card-header">
                        <h5>Total Revenue</h5>
                      </div>
                      <div class="card-body">
                        <div id="revenue-chart" style="width:100%;height:360px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mb-4">
                    <div class="card">
                      <div class="card-header">
                        <h5>Top Classes by Transactions</h5>
                      </div>
                      <div class="card-body">
                        <div id="top-classes-chart" style="width:100%;height:360px"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var revenueOptions = {
          chart: {
            type: 'line',
            height: 360,
            toolbar: {
              show: false
            }
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            curve: 'smooth',
            width: 3
          },
          series: [{
            name: 'Revenue',
            data: @json($revenueValues)
          }],
          xaxis: {
            categories: @json($revenueLabels)
          },
          colors: [vihoAdminConfig.primary]
        };
        new ApexCharts(document.querySelector('#revenue-chart'), revenueOptions).render();

        var topOptions = {
          chart: {
            type: 'bar',
            height: 360,
            toolbar: {
              show: false
            }
          },
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: '45%',
              endingShape: 'rounded'
            }
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
          },
          series: [{
            name: 'Transactions',
            data: @json($topClassCounts)
          }],
          xaxis: {
            categories: @json($topClassLabels)
          },
          colors: [vihoAdminConfig.secondary]
        };
        new ApexCharts(document.querySelector('#top-classes-chart'), topOptions).render();
      });
    </script>
  </body>
</x-admin-app>