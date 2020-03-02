@extends('layouts.admin')

  @section('title','Dashboard')
  @section('page-title','Selamat Datang Admin FIKSIONER')
  @section('navbar')
  <nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
      <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
      </ul>
      <div class="search-element">
        <input class="form-control" type="search" placeholder="Cari" aria-label="Search" data-width="250">
        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        
      </div>
    </form>
    <ul class="navbar-nav navbar-right">
      
      <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="{{asset('stisla/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
        <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::user()->name}}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
          
          <div class="dropdown-divider"></div>
          

          <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                     <i class="fas fa-sign-out-alt"></i> Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                   </form>
        </div>
      </li>
    </ul>
  </nav>
  @endsection
  @section('head')
  <div class="section-header">
    <h1>@yield('page-title')</h1>
  </div>
  @endsection
  @section('content')
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-boxes"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Bidang Usaha</h4>
          </div>
          <div class="card-body">
            111
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="fas fa-cart-plus"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Produk</h4>
          </div>
          <div class="card-body">
            111
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Event</h4>
          </div>
          <div class="card-body">
            111
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-book-open"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>E-Learning</h4>
          </div>
          <div class="card-body">
            111
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection