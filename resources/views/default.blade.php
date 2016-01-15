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
            <a href="https://github.com/marcosrjjunior/c-helps" class="github-corner"><svg width="80" height="80" viewBox="0 0 250 250" style="position:absolute;top:0;border:0;right:0" fill="#ffffff" color="#111166"><path d="M0 0l115 115h15l12 27 108 108v-250z"/><path d="M128.3 109c-14.5-9.3-9.3-19.4-9.3-19.4 3-6.9 1.5-11 1.5-11-1.3-6.6 2.9-2.3 2.9-2.3 3.9 4.6 2.1 11 2.1 11-2.6 10.3 5.1 14.6 8.9 15.9" fill="#111166" style="transform-origin:130px 106px" class="octo-arm"/><path d="M115 115c-.1.1 3.7 1.5 4.8.4l13.9-13.8c3.2-2.4 6.2-3.2 8.5-3-8.4-10.6-14.7-24.2 1.6-40.6 4.7-4.6 10.2-6.8 15.9-7 .6-1.6 3.5-7.4 11.7-10.9 0 0 4.7 2.4 7.4 16.1 4.3 2.4 8.4 5.6 12.1 9.2 3.6 3.6 6.8 7.8 9.2 12.2 13.7 2.6 16.2 7.3 16.2 7.3-3.6 8.2-9.4 11.1-10.9 11.7-.3 5.8-2.4 11.2-7.1 15.9-16.4 16.4-30 10-40.6 1.6.2 2.8-1 6.8-5 10.8l-11.7 11.6c-1.2 1.2.6 5.4.8 5.3z" fill="#111166" class="octo-body"/></svg></a><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style>
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
                        @if (isset(auth()->user()->exists))
                        <li>
                            <a href="{{ route('auth.logout') }}">
                                <span>Logout</span>
                            </a>
                        </li>
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
            </div>
        </footer>
        <!-- script references -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        @yield('scripts')
    </body>
</html>