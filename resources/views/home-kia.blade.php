@extends('layouts.app')

@section('content-title', 'Home')
@section('content-subtitle', 'Dashboard')

@section('content')
<div class="row">
			<div class="col-md-12">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Summary Semuanya</h3>
					</div>
					    <div class="box-body">
                            <div class="col-md-4">
                                <div class="info-box bg-purple">
                                    <span class="info-box-icon"><i class="ion ion-ios-person-outline"></i></span>
                                    <div class="info-box-content">
                                    <span class="info-box-text">NOA</span>
                                    <span class="info-box-number">{{ array_sum(json_decode ($chartData)) }}</span>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 50%"></div>
                                    </div>
                                    </div>
                                </div>
					        </div>

                            <div class="col-md-4">
                                <!-- Info Boxes Style 2 -->
                            <div class="info-box bg-blue">
                                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                                <div class="info-box-content">
                                <span class="info-box-text">Jumlah Lancar Jaya</span>
                                <span class="info-box-number">{{ "Rp. ".array_sum(json_decode ($OSLancar)) }}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 0%"></div>
                                </div>
                                <span class="progress-description">
                                    </span>
                                </div>
                                </div>
					        </div>
					        <!-- /.box-body -->
				        </div>
				<!-- /.box -->
			    </div>
		    </div>
    <!-- end column md 12  -->
	    </div>
    <!-- end row -->
      <div class="row">
       @can('lihat-noa-unit')
        <div class="col-md-6">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Jumlah Pengunjung Berdasarkan Unit</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pie-chart" width="50%" height="40%"></canvas>
            </div>
          </div>
        </div>
        @endcan
@can('lihat-pendapatan-unit')
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Jumlah keuntungan Berdasarkan Unit</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="line-chart" width="50%" height="40%"></canvas>
            </div>
          </div>
        </div>
        </div>
@endcan
@can('lihat-nasabah-unit')
      <div class="row">
			<div class="col-md-12">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Jumlah Pertumbuhan pengunjung Berdasarkan Unitnya</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
						</div>
					</div>
                    <div class="box-body">
                     <canvas id="bar-chart" width="50%" height="10%"></canvas>
					</div>       
				</div>
				<!-- /.box -->

			    </div>
		</div>
@endcan
</div>
@endsection
 <script src=https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js charset=utf-8></script>
 <script src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js charset=utf-8></script>

        <script>
            $(document).ready(function () {
                        var dtLabel = <?php echo $chartLabel; ?>;
                        var dtDATA = <?php echo $chartData; ?>;
                        new Chart(document.getElementById("bar-chart"), {
                            type: 'bar',
                            data: {
                                labels: dtLabel,
                                datasets: [{
                                    data: dtDATA
                                }]
                            },
                            options: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: 'data pendapatan NOA tiap Unit'
                                },
                                scales: {
                                    xAxes: [{
                                        stacked: false,
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1,
                                            min: 0,
                                            autoSkip: false
                                        }
                                    }]
                                }
                            }
                        });
                    

                        var dtLabelPie = <?php echo $chartLabel; ?>;
                        var dtDATAPie = <?php echo $chartData; ?>;
                        var piechart = new Chart(document.getElementById("pie-chart"), {
                            type: 'pie',
                            data: {
                                labels: dtLabelPie,
                                datasets: [{
                                    label: "",
                                    data: dtDATAPie
                                }]
                            },
                            options: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: ''
                                }
                            }
                        });

                        var dtLabelLine = <?php echo $chartLabel; ?>;
                        var dtDATALine = <?php echo $OSData; ?>;
                        var Linechart = new Chart(document.getElementById('line-chart'), {
                            type: 'line',
                            data: {
                                labels: dtLabelLine,
                                datasets: [{
                                    label: "",
                                    data: dtDATALine
                                }]
                            },
                            options: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: ''
                                },
                                scales: {
                                    xAxes: [{
                                        stacked: false,
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1,
                                            min: 0,
                                            autoSkip: false
                                        }
                                    }]
                                }
                                
                            }
                        });
                        // console.log(dtLabelLine[10]);
                    $("#pie-chart").click(function (evt) {
                          var activePoints = piechart.getElementsAtEvent(evt);
                            var chartData = activePoints[0]['_chart'].config.data;
                            var idx = activePoints[0]['_index'];
                            var label = chartData.labels[idx];
                            var value = chartData.datasets[0].data[idx];
                            alert(label +  " dengan jumlah = " + value);
                          });
            });
        </script>