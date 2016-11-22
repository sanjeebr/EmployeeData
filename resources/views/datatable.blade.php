@extends ('layout.employee')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Expense Forms</div>
        <div class="panel-body">

            <br/><br/>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="users-table">
                    <thead>
                        <tr>
                            <th>EmpId</th>
                            <th>Name</th>
                            <th>Last</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('bottom')
    <script src="{{ URL::asset('js/datatable.js?ver=4.31') }}"></script>
@endsection