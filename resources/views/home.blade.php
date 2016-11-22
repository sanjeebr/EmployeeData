@extends ('layout.employee')

@section('content')
    <div class="header-info">
        <h1>Sanjeeb's Website</h1>

        {{ Form::open(array('url' => '/upload', 'method' => 'post', 'enctype' => 'multipart/form-data')) }}
        <div class="center">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <span class="btn btn-default btn-file">{{ Form::file('files') }}</span>
                <span class="fileinput-filename"></span><span>{!! Form::submit('upload',array('class' => 'btn btn-primary')) !!}</span>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection