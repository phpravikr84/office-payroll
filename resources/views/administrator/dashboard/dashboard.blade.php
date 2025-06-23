@extends('administrator.master')
@section('title', __('Dashboard'))

@section('main_content')
<script src="{{ asset('backend/chart.bundle.js') }}"></script>

@php
$notics= \App\Models\Notice::all();
$holidays= \App\Models\Holiday::all();
$files= \App\Models\File::all();

$personalevents= \App\Models\PersonalEvent::all();
@endphp

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>{{ __(' Home') }}</a></li>
      <li class="active">{{ __('Dashboard') }}</li>
    </ol>
  </section>

  @php($user = Auth::user())
  @if($user->access_label == 1)

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12 col-xl-6 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Dashboard</h3>
        <h6 class="font-weight-normal mb-0">All systems are running smoothly!  <i class="mdi mdi-calendar"></i> Today (<?= date('d/m/Y'); ?>)</span></h6>
      </div>
    </div>
    <!-- Row of cards -->
    <div class="row">
      <div class="col-lg-3 col-xs-6 mt-4">
        <!-- Card -->
        <div class="card card-tale">
          <div class="card-body">
            <p class="mb-4">{{ count($employees) }}</p>
              <p class="fs-30 mb-2">{{ __('Employees') }}</p>
              <p> <a href="{{ url('/people/employees') }}" class="small-box-footer">{{ __('More info') }} <i class="fa fa-arrow-circle-right"></i></a></p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6 mt-4">
        <!-- Card -->
        <div class="card card-dark-blue">
          <div class="card-body">
            <p class="mb-4">{{ count($references) }}</p>
              <p class="fs-30 mb-2">{{ __('References') }}</p>
              <p> <a href="{{ url('/people/references') }}" class="small-box-footer">{{ __('More info') }} <i class="fa fa-arrow-circle-right"></i></a></p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6 mt-4">
        <!-- Card -->
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">{{ count($clients) }}</p>
            <p class="fs-30 mb-2">{{ __('Clients') }}</p>
            <p> <a href="{{ url('/people/clients') }}" class="small-box-footer">{{ __('More info') }} <i class="fa fa-arrow-circle-right"></i></a></p>
            </div>
          </div>
      </div>

      <div class="col-lg-3 col-xs-6 mt-4">
        <!-- Card -->
        <div class="card card-light-danger">
          <div class="card-body">
          <p class="mb-4">{{ count($files) }}</p>
            <p class="fs-30 mb-2">{{ __('Files') }}</p>
            <p> <a href="{{ url('/folders') }}" class="small-box-footer">{{ __('More info') }} <i class="fa fa-arrow-circle-right"></i></a></p>
          </div>
      </div>
    </div>
    </div>

    <!-- Statistics -->
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

    <!-- Holidays and Notices -->
    <div class="row">
      <div class="col-lg-6 mt-4">
        <div class="card shadow-sm">
          <div class="card-header">
            <h2>{{ __('Holiday') }}</h2>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="display expandable-table" style="width:100%">
                <thead>
                  <tr>
                    <th>{{ __('SL') }}</th>
                    <th>{{ __('Holiday Name') }}</th>
                    <th>{{ __('Dated') }}</th>
                    <th>{{ __('Description') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sl=1; ?>
                  @foreach($holidays as $holiday)
                  <tr>
                    <td>{{ $sl++ }}</td>
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
              <table id="example" class="display expandable-table" style="width:100%">
                <thead>
                  <tr>
                    <th>{{ __('SL') }}</th>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Description') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sl=1; ?>
                  @foreach($notics as $notic)
                  <tr>
                    <td>{{ $sl++ }}</td>
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

    @if(count($personal_events) > 0)
    <!-- Events -->
    <div class="card shadow-sm">
      <div class="card-header">
        <h3 class="box-title">{{ __('Events') }}</h3>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>{{ __('SL#') }}</th>
              <th>{{ __('Event Name') }}</th>
              <th>{{ __('Start Date') }}</th>
              <th>{{ __('End Date') }}</th>
              <th>{{ __('Created By') }}</th>
            </tr>
          </thead>
          <tbody>
            @php($sl = 1)
            @foreach($personal_events as $personal_event)
            <tr>
              <td>{{ $sl++ }}</td>
              <td><span class="label label-primary">{{ $personal_event->personal_event }}</span></td>
              <td><span class="label label-warning">{{ date("d F Y", strtotime($personal_event->start_date)) }}</span></td>
              <td><span class="label label-warning">{{ date("d F Y", strtotime($personal_event->end_date)) }}</span></td>
              <td>{{ $personal_event->name }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif

  </section>
  <!-- /.content -->
  @endif
</div>

<script type="text/javascript">
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
type: 'pie',
data: {
labels: ['Employees', 'Notices', 'Holidays', 'Files'],
datasets: [{
label: 'Evaluation report by pie chart',
data: [{{ count($employees) }}, {{ count($notics) }}, {{ count($holidays) }} , {{ count($files) }} ],
backgroundColor: [
'#17B6A4',
'#2184DA',
'#c16275',
'#3C454D',
],
borderColor: [
'#c16275',
'#2184DA',
'#17B6A4',
'#3C454D'
],
borderWidth: 0
}]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero: true
}
}]
}
}
});
</script>
<script type="text/javascript">
var ctx = document.getElementById('myChart2');
var myChart2 = new Chart(ctx, {
type: 'bar',
data: {
labels: ['Employees', 'Notices', 'Holidays', 'Files'],
datasets: [{
label: 'Evaluation Report By Bar Chart',
data: [{{ count($employees) }}, {{ count($notics) }}, {{ count($holidays) }} , {{ count($files) }} ],
backgroundColor: [
'#17B6A4',
'#2184DA',
'#c16275',
'#3C454D',
'#8A8F94'
],
borderColor: [
'#c16275',
'#2184DA',
'#17B6A4',
'#3C454D',
'#8A8F94'
],
borderWidth: 0
}]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero: true
}
}]
}
}
});
</script>




<!-- =================Statistics end ========================-->

@endsection
