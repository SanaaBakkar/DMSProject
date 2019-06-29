@extends('layouts.admin')

@section('content')


<div class="col-sm-12">
				<div class="alert alert-dark" role="alert">
                   <b> Welcome  {{Auth::user()->name}}  </b>
                </div>
</div>

    
	  <div class="col-sm-6 col-lg-3" >
                <div class="card text-black bg-flat-color-1">
                    <div class="card-body pb-0">
                        <p class="text-light"><a href="{{url('/users')}}" style="color: black"><b>List of users</b></a></p>
                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>

                    </div>

                </div>
            </div>
            <!--/.col-->

        <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <p class="text-light"><a href="{{url('/groups')}}" style="color: black"><b>List of groups</b></a></p>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">                   

                        <p class="text-light"><a href="{{url('/alldocuments')}}" style="color: black"><b>All documents</b></a></p>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        <p class="text-light"><a href="{{url('/doctypes')}}" style="color: black"><b>Document types</b></a></p>

                    </div>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart3"></canvas>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                        <p class="text-light"><a href="{{url('/SingleWF')}}" style="color: black"><b>Single Review and Approve</b></a></p>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-5">
                    <div class="card-body pb-0">
                        <p class="text-light"><a href="{{url('/GroupWF')}}" style="color: black"><b>Group Review and Approve</b></a></p>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>

             <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <p class="text-light"><a href="{{url('/ParallelWF')}}" style="color: black"><b>Parallel Review and Approve</b></a></p>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>

 

    
@endsection