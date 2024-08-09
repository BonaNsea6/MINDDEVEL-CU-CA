@extends('layouts.app1')

@section('content')
<div class="pagetitle">
      <h1>Dashboard</h1>
      <h1>L'année en cours est {{ $currentYear }}</h1>
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
                  <h5 class="card-title">Mes communes <span>| Today</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$totalCommunes}}</h6>
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
                  <h5 class="card-title">Recettes <span>| This Month</span></h5>
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


           <!-- End Customers Card -->

            <!-- Reports -->
            <!-- End Reports -->


          </div>
        </div><!-- End Left side columns -->

     

      </div>
    </section>
@endsection
