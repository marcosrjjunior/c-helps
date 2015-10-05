@extends('default')

@section('styles')
<style>
    .question h3 {
        margin: 0px;
    }
    .question .info {
        margin-top: 20px;
    }

    .question .answered {
        /*padding: 7px;*/
        /*background-color: #3C3C77;*/
        color: #3C3C77;
    }
    .question .info .count {
        display: block;
    }
</style>
@stop

@section('page')

<div class="container">
    <div class="row">

        <div class="col-md-12">

            <div class="panel">
                <div class="panel-body">

                    @if (session('company_error'))
                        <div class="alert alert-danger clearfix">
                            <button type="button" class="btn-link pull-right" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                            {!! session('company_error') !!}
                        </div>
                    @endif

                    <a href="{!! route('auth.github') !!}" class="btn btn-default text-center">
                        <i class="fa fa-github"> Sign in with <strong>GitHub</strong></i>
                    </a>

                    <hr>

                </div>
            </div>

        </div><!--/col-12-->
    </div>
</div>
@stop