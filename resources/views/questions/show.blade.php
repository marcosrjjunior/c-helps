@extends('default')

@section('scripts')
<script type="text/javascript" src="{!! asset('assets/vuejs/js/vue.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('assets/marked/js/marked.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/editor.js') !!}"></script>
<script>
    $(function() {
        $('.point').on('click', function(e) {
            e.preventDefault();

            var $this   = $(this);
                $answer = $this.closest('[data-id]'),
                $point   = $this.data('point');

            $.ajax({
                headers: {'X-CSRF-TOKEN' : '{!! csrf_token() !!}'},
                method: 'POST',
                url: '/answers/'+$answer.data('id')+'/points/submit',
                data: { point: $point },
                success : function(data)
                {
                    $answer.find('.points').text(data.points);
                },
                error: function(data)
                {
                    alert('Try vote for another answer or you already voted for this answer');
                }
            });
        });

        $('.delete-answer').on('click', function(e) {
            e.preventDefault();

            if (!confirm('Are you sure?')) return;

            var $this = $(this),
                $id   = $this.data('item');

            $.ajax({
                headers: {'X-CSRF-TOKEN' : '{!! csrf_token() !!}'},
                method: 'DELETE',
                url: '/answers/'+$id+'/delete',
                success : function(data)
                {
                    $this.closest('[data-id]').remove();
                }
            });
        });

    });
</script>
@stop

@section('page')

<div class="container">
    <div class="row">

        <div class="col-md-12">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <h3>{!! $question->title !!}</h3>
                    </h3>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9">
                            @can('update', $question)
                            <div class="actions pull-right">
                                <a href="{!! route('questions.edit', $question->id) !!}">
                                    <span class="label label-default">edit</span>
                                </a>

                                <span data-item="{!! $question->id !!}" class="label label-default delete-question">delete</span>
                            </div>
                            @endcan
                            @if ($errors->has())
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif

                            <p>{!! \Michelf\MarkdownExtra::defaultTransform($question->text) !!}</p>

                            <h4>
                                @foreach($question->tags as $tag)
                                    <span class="label label-default">{!! $tag->name !!}</span>
                                @endforeach
                            </h4>
                            <div class="user-info pull-right">
                                <p>asked {!! $question->created_at->diffForHumans() !!}</p>
                                @include('users.info', ['item' => $question])
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            @include('answers.answers')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <form method="post" action="{!! route('answers.submit') !!}">
                                {!! csrf_field() !!}

                                <h4>Your Answer</h4>

                                <input type="hidden" name="question_id" value="{!! $question->id !!}">
                                <div class="form-group @if($errors->has('text')) has-error @endif">
                                    <div id="editor">
                                        <textarea rows="8" v-model="text" debounce="100" name="text"></textarea>
                                        <div v-html="text | marked"></div>
                                    </div>
                                    {!! $errors->first('text', '<span class="help-block">:message</span>') !!}
                                </div>

                                <button type="submit" class="btn btn-primary">Post Your Answer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@stop