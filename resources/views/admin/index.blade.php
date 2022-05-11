@extends('admin.layout.master')
@section('title', __('Dashboard'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h1 class="h4">{{ __('Dashboard page') }}</h1>
                    </div>
                    <div class="content">
                        <h2 class="h4">{{ __('Statistic of articles number in :year', ['year' => $year]) }}</h2>
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div>
                                    <canvas id="chart" chart-data="{{ $chartData }}"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="{{ asset('js/statistic-chart.js') }}"></script>
@endsection
