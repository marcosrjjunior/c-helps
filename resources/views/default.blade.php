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
        <link rel="stylesheet" href="{{ asset('css/default-styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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
                </div>
                <nav class="collapse navbar-collapse" role="navigation">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ route('questions.ask') }}">Ask Question</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-right navbar-nav">
                        @if(isset(auth()->user()->exists))
                        <li>
                            <div class="nav-avatar">
                                <a href="{{ route('users', auth()->user()->id) }}">
                                    <img src="{{ auth()->user()->avatar}}">
                                </a>
                                <label>{{ auth()->user()->points }}</label>
                            </div>
                        </li>
                        @endif
                        <li>
                            <form method="get" action="{{ route('search') }}" class="navbar-form" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="q">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <div id="masthead">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <a href="/">
                            <h1>C-Helps
                                <p class="lead"></p>
                            </h1>
                        </a>
                    </div>
                    <div class="col-md-5">
                        <div class="well text-center">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h2>{{ env('C-HELPS_COMPANY') ? ucwords(env('C-HELPS_COMPANY')) : 'Your Company' }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="top-spacer"></div>
                    </div>
                </div>
            </div>

        </div>

        @yield('page')

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
                        <p class="pull-right">Created by <a href="https://github.com/marcosrjjunior">@marcosrjjunior</a></p>
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