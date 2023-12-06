@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-3 col-6">      
      <div class="small-box bg-info">
        <div class="inner">
          <h3>150</h3>
          <p>New Orders</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>53<sup style="font-size: 20px">%</sup></h3>
          <p>Bounce Rate</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>44</h3>
          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>65</h3>
          <p>Unique Visitors</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>Quantidade de Leads / Mês
          </h3>
          <!-- <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item">
                <a class="nav-link active" href="#revenue-chart" data-bs-toggle="tab">Area</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#sales-chart" data-bs-toggle="tab">Donut</a>
              </li>
            </ul>
          </div> -->
        </div>
        <div class="card-body">
          <div class="tab-content p-1" style="height: 24rem;">
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
          <h3 class="card-title">
            <i class="fas fa-chart-pie mr-1"></i>Etapas do Funil
          </h3>
          <!-- <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item">
                <a class="nav-link active" href="#revenue-chart" data-bs-toggle="tab">Area</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#sales-chart" data-bs-toggle="tab">Donut</a>
              </li>
            </ul>
          </div> -->
        </div>
        <div class="card-body">
          <div class="tab-content p-1" style="height: 24rem;">
            <canvas id="myChart2"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  
</div>
@endsection

@section('js')
<script>
  
  fetch("{{ route('dashboard.page_crm_dados') }}")
  .then(response => response.json())
  .then(json => {
    const ctx = document.getElementById('myChart');
    
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: json.labels,
        datasets: [{
          label: json.datasets.label,
          data: json.datasets.data,
          backgroundColor: json.datasets.backgroundColor,
        }]
      },
      options:
      {
        scales:
        {
          y:
          {
            beginAtZero: true
          }
        }
      },
    });
  })

  fetch("{{ route('dashboard.page_crm_dados_funnel') }}")
  .then(response => response.json())
  .then(json => {
    const ctx = document.getElementById('myChart2');
    
    new Chart(ctx, {
      type: 'funnel',
      data: {
        labels: json.labels,        
        datasets:
        [{
          data: [30, 60, 90, 34, 23, 77],
          label: json.datasets.label,
          data: json.datasets.data,
          backgroundColor: json.datasets.backgroundColor,
          hoverBackgroundColor: json.datasets.hoverBackgroundColor,
        }],
      },
      options:
      {
        sort: 'desc',
        gap: 10,             // distância entra etapas do funil
        legend:
        {
          display: false,
          position: 'bottom',
          reverse: true,
          align: 'center',
        },
        tooltips:
        {
          callbacks:
          {
            title: function (tooltipItem, data)
            {
              console.log(data)
              console.log(tooltipItem)
              return '';
            },
            label: function (tooltipItem, data)
            {
              console.log(tooltipItem)
              console.log(data)
              return data.labels[tooltipItem.index] + ': ' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
            }
          }
        },
      },
    })
  })

</script>
@stop
