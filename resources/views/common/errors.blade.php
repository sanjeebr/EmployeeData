@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <ul>
            @if(isset($error))
                <li>{{ $error }}</li>
            @endif
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (isset($error))
    <!-- Form Error List -->
    <div class="alert alert-danger">
        <ul>
            <li>{{ $error }}</li>
        </ul>
    </div>
@endif