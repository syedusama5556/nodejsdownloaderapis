<!doctype html><script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Covid19 Tracker</title>
    <meta name="description" content="Covid19 Tracker">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    
                    <li class="active">
                        <a href="countries.php"> <i class="menu-icon fa fa-flag"></i>Countries </a>
                    </li>
 
                    <li class="active">
                        <a href="about-covid19.php"> <i class=" menu-icon fa fa-user-md"></i> About Covid-19 </a>
                    </li>

                    <li class="active">
                        <a href="about-us.php"> <i class=" menu-icon fa fa-exclamation-circle"></i> Precautions </a>
                    </li>


                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>


            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0" style="background-color:#ff5722">
                        <div class="dropdown float-right">
                            <img src="./images/coronavirus.png" alt="">
                        </div>
                        <h4 class="mb-0" id="count_cases">
                            <!-- <span class="count" >10468</span> -->
                        </h4>
                        <p class="text-light">Total Cases</p>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>

                    </div>

                </div>
            </div>
            <!--/.col-->
 


            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
                            <img src="./images/statistics.png" alt="">
                        </div>
                        <h4 class="mb-0" id="today_cases">
                            <!-- <span class="count">10468</span> -->
                        </h4>
                        <p class="text-light">Today Case</p>

                    </div>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart3"></canvas>
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3" style="background-color:#E74C3C">
                    <div class="card-body pb-0" >
                        <div class="dropdown float-right">
                            <img src="./images/skull.png" alt="">
                        </div>
                        <h4 class="mb-0" id="count_death">
                            <!-- <span class="count">10468</span> -->
                        </h4>
                        <p class="text-light">Total Death</p>

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
                        <div class="dropdown float-right">
                            <img src="./images/corpse.png" alt="">
                        </div>
                        <h4 class="mb-0" id="today_death">
                            <!-- <span class="count">10468</span> -->
                        </h4>
                        <p class="text-light">Today Death</p>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <h4 class="card-title mb-0">Covid-19 Cases</h4>
                                <!-- <div class="small text-muted">October 2017</div> -->
                            </div>
                            <!--/.col-->
                           
                            <!--/.col-->


                        </div>
                        <!--/.row-->
                        <div class="chart-wrapper mt-4">
                            <canvas id="trafficChart" style="height:200px;" height="200"></canvas>
                        </div>

                    </div>
                    <div class="card-footer">
                        <ul>

                            <li class="hidden-sm-down">
                                <div class="text-muted">Cases</div>
                              
                                <div class="progress progress-xs mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>


                            <li>
                                <div class="text-muted">Recovered</div>
                                
                                <div class="progress progress-xs mt-2" style="height: 5px;">
                           <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>



                            <li class="hidden-sm-down">
                                <div class="text-muted">Deaths</div>
                               
                                <div class="progress progress-xs mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><img src="./images/patient.png" alt=""></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Total Recover</div>
                                <div class="stat-digit" id="recover_count"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><img src="./images/recovered.png" alt=""></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Today Recover</div>
                                <div class="stat-digit" id="today_recover"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><img src="./images/testing.png" alt=""></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Total Tests </div>
                                <div class="stat-digit" id="tests"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4>World</h4>
                    </div>
                    <div class="Vector-map-js">
                        <div id="vmap" class="vmap" style="height: 265px;"></div>
                    </div>
                </div>
                <!-- /# card -->
            </div>


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);

        $.getJSON('https://corona.lmao.ninja/v2/all', function(data) {
            console.log(data.updated);


            var count = data.cases;
            var today_cases = data.todayCases;
            var deaths = data.deaths;
            var todayDeaths = data.todayDeaths;
            var recovered = data.recovered;
            var todayRecovered = data.todayRecovered;
            var tests = data.tests;



            $('#count_cases').append(' <span class="count" >'+ count+'</span>')
            $('#today_cases').append(' <span class="count" >'+ today_cases+'</span>')
            $('#count_death').append(' <span class="count" >'+ deaths+'</span>')
            $('#today_death').append(' <span class="count" >'+ todayDeaths+'</span>')


            $('#recover_count').append(' <span class="count" >'+ recovered+'</span>')
            $('#today_recover').append(' <span class="count" >'+ todayRecovered+'</span>')
            $('#tests').append(' <span class="count" >'+ tests+'</span>')
            
            
        })

        



       
                    
                    
    </script>

</body>

</html>
