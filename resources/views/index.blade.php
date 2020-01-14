@extends('layouts.apps')

@section('content')

    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image:url(img/home1.png);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate mb-md-5">
          	<span class="subheading">Welcome to </span>
            <h1 class="mb-4">The Best Place To Manage Your Documents</h1>
            <p><a href="{{url('/document')}}" class="btn btn-primary px-4 py-3 mt-3">Get Started</a></p>
          </div>
        </div>
        </div>
      </div> 

      <div class="slider-item" style="background-image:url(img/home2.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate mb-md-5">
          	<span class="subheading">DMS PROJECT</span>
            <h1 class="mb-4">We Help to Grow Your Documents Management</h1>
            <p><a href="{{url('documentation')}}" class="btn btn-primary px-4 py-3 mt-3">Documentation</a></p>
          </div>
        </div>
        </div>
      </div>
    </section><br><br>

    <section class="ftco-intro ftco-no-pb img" >
    	<div class="container">
    		<div class="row justify-content-center">
          <div class="col-lg-9 col-md-8 d-flex align-items-center heading-section heading-section-white ftco-animate">
            <h2 class="mb-3 mb-md-0" align="center">You Always Get the Best Management Of Your Documents</h2>
          </div>
        </div>	
    	</div>
    </section>

   

@endsection

