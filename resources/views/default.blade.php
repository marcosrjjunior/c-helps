<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>C-Helps</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{!! asset('css/styles.css') !!}">
        @yield('styles')
    </head>
    <body>
        <header class="navbar navbar-bright navbar-fixed-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="/" class="navbar-brand">Home</a>
                </div>
                <nav class="collapse navbar-collapse" role="navigation">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="/questions/ask">Ask Question</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-right navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-search"></i></a>
                            <ul class="dropdown-menu" style="padding:12px;">
                                <form class="form-inline">
                                    <button type="submit" class="btn btn-default pull-right"><i class="glyphicon glyphicon-search"></i></button><input type="text" class="form-control pull-left" placeholder="Search">
                                </form>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <div id="masthead">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>C-Helps
                            <p class="lead"></p>
                        </h1>
                    </div>
                    <div class="col-md-5">
                        <div class="well well-lg">
                            <div class="row">
                                <div class="col-sm-12">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /cont -->

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="top-spacer"> </div>
                    </div>
                </div>
            </div><!-- /cont -->

        </div>

        @yield('page')

        <hr>

        <div class="container" id="footer">
            <div class="row">
                <div class="col col-sm-12">

                    <h1>Follow Us</h1>
                    <div class="btn-group">
                        <a class="btn btn-twitter btn-lg" href="#"><i class="icon-twitter icon-large"></i> Twitter</a>
                        <a class="btn btn-facebook btn-lg" href="#"><i class="icon-facebook icon-large"></i> Facebook</a>
                        <a class="btn btn-google-plus btn-lg" href="#"><i class="icon-google-plus icon-large"></i> Google+</a>
                    </div>

                </div>
            </div>
        </div>

        <hr>

        <hr>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="list-inline">
                        <li><i class="icon-facebook icon-2x"></i></li>
                        <li><i class="icon-twitter icon-2x"></i></li>
                        <li><i class="icon-google-plus icon-2x"></i></li>
                        <li><i class="icon-pinterest icon-2x"></i></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <p class="pull-right">Built with <i class="icon-heart-empty"></i> at <a href="http://www.bootply.com">Bootply</a></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- script references -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        @yield('scripts')
    </body>
</html>