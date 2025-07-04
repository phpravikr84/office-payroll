@extends('administrator.master')
@section('title', __('Dashboard'))

@section('main_content')
<script src="{{ asset('backend/chart.bundle.js') }}"></script>

@php
use Illuminate\Support\Facades\Auth;

$notics = \App\Models\Notice::all();
$holidays = \App\Models\Holiday::all();
$files = \App\Models\File::all();
$total_salary_paid = $salaries->sum('total');
$total_leaves = $leaves->sum('count');
@endphp

<div class="content-wrapper">
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>{{ __(' Home') }}</a></li>
      <li class="active">{{ __('Dashboard') }}</li>
    </ol>
  </section>

  @php($user = Auth::user())
  @if($user->access_label == 1)
  <section class="content">
    <div class="row">
      <div class="col-12 col-xl-6 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Dashboard</h3>
        <h6 class="font-weight-normal mb-0">
          All systems are running smoothly!
          <i class="mdi mdi-calendar"></i> Today ({{ date('d/m/Y') }})
        </h6>
      </div>
    </div>

    <div class="row">
      <!-- Employees -->
      <div class="col-lg-3 col-xs-6 mt-4">
        <div class="card card-tale">
          <div class="card-body">
            <p class="mb-4">{{ count($employees) }}</p>
            <p class="fs-30 mb-2">{{ __('Employees') }}</p>
            <p><a href="{{ url('/people/employees') }}" class="small-box-footer">{{ __('More info') }} <i class="fa fa-arrow-circle-right"></i></a></p>
          </div>
        </div>
      </div>

      <!-- Total Salary Paid -->
      <div class="col-lg-3 col-xs-6 mt-4">
        <div class="card card-success">
          <div class="card-body">
            <p class="mb-4">PGK {{ number_format($total_salary_paid, 2) }}</p>
            <p class="fs-30 mb-2">{{ __('Total Salary Paid') }}</p>
          </div>
        </div>
      </div>

      <!-- Total Leaves -->
      <div class="col-lg-3 col-xs-6 mt-4">
        <div class="card card-warning">
          <div class="card-body">
            <p class="mb-4">{{ $total_leaves }}</p>
            <p class="fs-30 mb-2">{{ __('Total Leaves') }}</p>
          </div>
        </div>
      </div>

      <!-- Files -->
      <div class="col-lg-3 col-xs-6 mt-4">
        <div class="card card-light-danger">
          <div class="card-body">
            <p class="mb-4">{{ count($files) }}</p>
            <p class="fs-30 mb-2">{{ __('Files') }}</p>
            <p><a href="{{ url('/folders') }}" class="small-box-footer">{{ __('More info') }} <i class="fa fa-arrow-circle-right"></i></a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Charts -->
    <div class="row">
      <div class="col-lg-6 mt-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <canvas id="myChart2"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mt-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Holidays & Notices -->
    <div class="row">
      <div class="col-lg-6 mt-4">
        <div class="card shadow-sm">
          <div class="card-header">
            <h2>{{ __('Holiday') }}</h2>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Holiday Name</th>
                    <th>Dated</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($holidays as $index => $holiday)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $holiday->holiday_name }}</td>
                      <td>{{ $holiday->date }}</td>
                      <td>{{ $holiday->description }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mt-4">
        <div class="card shadow-sm">
          <div class="card-header">
            <h2>{{ __('Notice') }}</h2>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($notics as $index => $notic)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $notic->notice_title }}</td>
                      <td>{{ $notic->description }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Events -->
    @if(count($personal_events) > 0)
    <div class="card shadow-sm mt-4">
      <div class="card-header">
        <h3 class="box-title">{{ __('Events') }}</h3>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>SL#</th>
              <th>Event Name</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Created By</th>
            </tr>
          </thead>
          <tbody>
            @foreach($personal_events as $index => $event)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td><span class="label label-primary">{{ $event->personal_event }}</span></td>
                <td><span class="label label-warning">{{ date("d F Y", strtotime($event->start_date)) }}</span></td>
                <td><span class="label label-warning">{{ date("d F Y", strtotime($event->end_date)) }}</span></td>
                <td>{{ $event->name }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif
  </section>
  @endif
</div>

<!-- Charts JS -->
<script>
const barCtx = document.getElementById('myChart2').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($salaries->pluck('month')->map(fn($m) => date('F', mktime(0, 0, 0, $m, 1)))) !!},
        datasets: [{
            label: 'Salary Paid',
            data: {!! json_encode($salaries->pluck('total')) !!},
            backgroundColor: '#17B6A4',
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

const pieCtx = document.getElementById('myChart').getContext('2d');
new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: {!! json_encode($attendance->pluck('status')) !!},
        datasets: [{
            label: 'Attendance',
            data: {!! json_encode($attendance->pluck('count')) !!},
            backgroundColor: ['#17B6A4', '#2184DA', '#c16275', '#3C454D']
        }]
    },
    options: {
        responsive: true
    }
});
</script>
@endsection
