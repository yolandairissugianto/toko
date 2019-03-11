@extends('layouts.app')

@section('title')
	Dashboard
@endsection

@section('breadcrumb')
	@parent
	<li>Dashboard</li>
@endsection

@section('content')
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>{{ $kategori }}</h3>
					<p>Total Kategori</p>
			</div>
			<div class="icon">
				<i class="fa fa-cube"></i>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-green">
			<div class="inner">
				<h3>{{ $produk }}</h3>
					<p>Total Produk</p>
			</div>
			<div class="icon">
				<i class="fa fa-cube"></i>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>{{ $supplier }}</h3>
					<p>Total Supplier</p>
			</div>
			<div class="icon">
				<i class="fa fa-truck"></i>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-red">
			<div class="inner">
				<h3>{{ $member }}</h3>
					<p>Total Member</p>
			</div>
			<div class="icon">
				<i class="fa fa-credit-card"></i>
			</div>
		</div>
	</div>
</div>
<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Grafik Pendapatan {{ tanggal_indonesia($awal) }} s/d {{ tanggal_indonesia($akhir) }}</h3>
				</div>
				<div class="box-body">
					<div class="chart">
						<canvas id="salesChart" style="height: 250px"></canvas>
					</div>
				</div>
			</div>
		</div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/Chart.bundle.js') }}"></script>
		<script>
            var ctx = document.getElementById("salesChart").getContext('2d');
            var salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {{ json_encode($data_tanggal) }},
                    datasets: [{
                            label: 'Grafik Pendapatan',
                            data: {{ json_encode($data_pendapatan) }},
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
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
@endsection