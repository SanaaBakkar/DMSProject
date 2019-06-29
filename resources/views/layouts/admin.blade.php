<!doctype html>

<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">




        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/bootstrap.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/font-awesome.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/flag-icon.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/cs-skin-elastic.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/jqvmap.min.css') }}"/>


         <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

   <!-- font awesome-->
   <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- DataTables JS and CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src=" https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/admin">DMS Project</a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{url('/admin')}}"> <i class="menu-icon fa fa-tachometer-alt"></i>Dashboard </a>
                    </li>
                    <li class="active">
                        <a href="{{url('/')}}"> <i class="menu-icon fa fa-hand-pointer-o"></i>User Interface </a>
                    </li>


                    <h3 class="menu-title">UI elements</h3><!-- /.menu-title -->
                    <li>
                        <a href="{{url('/users')}}"> <i class=" menu-icon fa fa-user"></i>Users</a>
                    </li>
                    <li>
                        <a href="{{url('/groups')}}"> <i class=" menu-icon fa fa-group"></i>Groups</a>
                    </li>
                    <h3 class="menu-title">Documents</h3><!-- /.menu-title -->
                     <li >
                        <a href="{{url('/alldocuments')}}"> <i class="menu-icon fa fa-list"></i>All Documents</a>
                    </li>  
                    <li>
                        <a href="{{url('/doctypes')}}"> <i class="menu-icon fa fa-file"></i>Document type </a>
                    </li> 

                   
                    <h3 class="menu-title">Workflows</h3><!-- /.menu-title -->
                     <li>
                       <a href="{{url('/SingleWF')}}"><i class="menu-icon fa fa-cog"></i>Single Review & Approve</a>
                    </li> 

                    <li>
                        <a href="{{url('/GroupWF')}}"> <i class="menu-icon fa fa-cogs"></i>Group Review & Approve</a>
                    </li> 
                    <li>
                        <a href="{{url('/ParallelWF')}}"> <i class="menu-icon fas fa-arrows-alt-h" ></i>Parallel Review & Approve</a>
                    </li>               
                 </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

 
        <!-- Header-->

 
        <div class="content mt-3">
                @yield('content')
        </div> <!-- .content -->

    </div><!-- /#right-panel -->

  

</body>

</html>
