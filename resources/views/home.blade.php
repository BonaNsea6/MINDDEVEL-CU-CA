@extends('layouts.app1')

@section('content')
<div class="pagetitle">
      <h1>Dashboard/{{ $currentYear }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->   
       @can("commune")
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-person-fill"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Communes</h6>
                    </li>
                 
                    @foreach($communeArr as $commune)
                        <li><a class="dropdown-item" href="#">{{$commune->name}}</a></li>
                    @endforeach
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Mes communes <span>| Today</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$totalCommunesCub}}</h6>
                      <span class="text-success small pt-1 fw-bold"></span> 
                      <span class="text-success small pt-1 fw-bold"></span> 
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card revenue-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="ri-home-2-fill"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                  
                    <li><a class="dropdown-item" href="#"></a></li>
        
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Recettes </h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-home-2-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-3 col-xl-4">
              <div class="card info-card customers-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-hand-index-thumb"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Comptes administratifs  <span>| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-hand-index-thumb"></i>
                    </div>
                    <div class="ps-3">
                      <h6></h6>
                    </div>
                  </div>

                </div>
              </div>
            </div><!-- End Customers Card -->
        @endcan

        @can("admin")
        <!-- PARTIE ADIND-->
          <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-person-fill"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                 
                    @foreach($communeArr as $commune)
                        <li><a class="dropdown-item" href="#">{{$commune->name}}</a></li>
                    @endforeach
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Total Utilisateurs <span>| Today</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$totalUsers}}</h6>
                      <span class="text-success small pt-1 fw-bold"></span> 
                      <span class="text-success small pt-1 fw-bold"></span> 
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

         <!-- Revenue Card -->
         <div class="col-xxl-3 col-md-6">
              <div class="card info-card revenue-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="ri-home-2-fill"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      @foreach($userCommunautes as $communautes)
                      <h6>{{$communautes->name}}</h6>
                      @endforeach
                    </li>
                  
                    <li><a class="dropdown-item" href="#"></a></li>
        
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title"> Communautés Urbaines <span>|</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$totalCommunautes}}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->


               <!-- Revenue Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card revenue-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="ri-home-2-fill"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                       @foreach($userCommunes as $communes)
                        <h6>{{$communes->name}}</h6>
                      @endforeach
                    </li>
                    <li><a class="dropdown-item" href="#"></a></li>
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Communes d'arrondissements <span></span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-home-2-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$totalCommunes}}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->


            
            <!-- Revenue Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Recettes Communautés <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$totalRecetteCommunautes}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->


            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-4">
              <div class="card info-card sales-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-octagon-fill"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                   
                    <li><a class="dropdown-item" href="#"></a></li>
    
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Recettes Communes <span>| Today</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$totalRecetteCommunes}}</h6> 
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Sales Card -->

               <!-- Revenue Card -->
               <div class="col-xxl-3 col-md-6">
              <div class="card info-card revenue-card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="ri-donut-chart-fill"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Comptes administratifs </h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-donut-chart-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$totalFichiers}}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Revenue Card -->
           <!-- End Customers Card -->
          @endcan
            <!-- Reports -->
            <!-- End Reports -->


          </div>
        </div><!-- End Left side columns -->

     
        @can("admin")
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Recapitulatif des recettes des communes par années </h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Années</th>
                        <th scope="col">PIL</th>
                        <th scope="col">PEDS</th>
                        <th scope="col">PTC</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                        <tr>
                            <td></td>
                            <td>{{ $result->annee }}</td>
                            <td>{{number_format ($result->total_pil, 0, ',', '.') }} XAF</td>
                            <td>{{ number_format ($result->total_ptc , 0, ',', '.')}} XAF</td>
                            <td>{{ number_format ($result->total_peds, 0, ',', '.') }} XAF</td>
                        </tr>
                       @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->


             <!-- Recent Sales -->
             <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Recapitulatif des recettes des communautés urbaines par années</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Années</th>
                        <th scope="col">PIC</th>
                        <th scope="col">PCAC</th>
                        <th scope="col">PTC</th>
                        <th scope="col">RDP</th>
                        <th scope="col">RDPC</th>
                        <th scope="col">RTPS</th>
                        <th scope="col">Pour un total de </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($resultsCommunaute as $result)
                        <tr>
                            <td></td>
                            <td>{{ $result->annee }}</td>
                            <td>{{number_format ($result->total_pic, 0, ',', '.') }} XAF</td>
                            <td>{{ number_format ($result->total_pcac , 0, ',', '.')}} XAF</td>
                            <td>{{ number_format ($result->total_ptc, 0, ',', '.') }} XAF</td>
                            <td>{{ number_format ($result->total_rdp, 0, ',', '.') }} XAF</td>
                            <td>{{ number_format ($result->total_rdpc, 0, ',', '.') }} XAF</td>
                            <td>{{ number_format ($result->total_rtps, 0, ',', '.') }} XAF</td>
                            <td>{{ number_format ($result->total_Total, 0, ',', '.') }} XAF</td>
                        </tr>
                       @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->
        @endcan

        @can("commune")
                <!-- Recent Sales -->
                <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Recapitulatif de vos  recettes par années</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Années</th>
                        <th scope="col">PIC</th>
                        <th scope="col">PCAC</th>
                        <th scope="col">PTC</th>
                        <th scope="col">RDP</th>
                        <th scope="col">RDPC</th>
                        <th scope="col">RTPS</th>
                        <th scope="col">Pour un total de </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($resultsCommunauteCUB as $result)
                        <tr>
                            <td></td>
                            <td>{{ $result->annee }}</td>
                            <td>{{number_format ($result->total_pic, 0, ',', '.') }} XAF</td>
                            <td>{{ number_format ($result->total_pcac , 0, ',', '.')}} XAF</td>
                            <td>{{ number_format ($result->total_ptc, 0, ',', '.') }} XAF</td>
                            <td>{{ number_format ($result->total_rdp, 0, ',', '.') }} XAF</td>
                            <td>{{ number_format ($result->total_rdpc, 0, ',', '.') }} XAF</td>
                            <td>{{ number_format ($result->total_rtps, 0, ',', '.') }} XAF</td>
                            <td>{{ number_format ($result->total_Total, 0, ',', '.') }} XAF</td>
                        </tr>
                       @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->
            @endcan
      </div>
    </section>
@endsection
