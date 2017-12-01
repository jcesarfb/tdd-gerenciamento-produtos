<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PetTop</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

    <!-- VUE Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="../../font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../../device-mockups/device-mockups.min.css">

    <!-- Theme CSS -->
    <link href="../../css/new-age.min.css" rel="stylesheet">
    <link href="../../css/layout-cad.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet" /> 
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">
<div class="container">
     <nav id="mainNav" class="navbar">
        
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span><i class="fa fa-bars icone"></i>
                </button>
                <a class="navbar-brand page-scroll" href="{{ url('/base') }}"><strong>Sistema de Controle</strong></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            @if (Route::has('login'))
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="{{ url('/') }}"><strong>Buscar</strong></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ url('/base') }}"><strong>Logout</strong></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ url('/register') }}"><strong>Cadastro</strong></a>
                    </li>
                </ul>
            </div>
            @endif
            <!-- /.navbar-collapse -->
        <!-- /.container-fluid -->
    </nav>
</div>
<br>
<div class="container">
    <div class="col-md-12">
        @yield('content')
    </div>
</div>
</body>
    <div class="footer" align="center">
        &copy; 2017 Sistema de Controle. Todos os direitos reservados.
    </div>
</html>

    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/buscarCep.js') }}"></script>

