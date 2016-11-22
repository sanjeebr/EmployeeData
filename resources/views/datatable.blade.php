@extends ('layout.employee')

@section('content1')
    <div class="panel panel-default">
        <div class="panel-heading">Employee</div>
        <div class="panel-body">

            <br/><br/>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="users-table">
                    <thead>
                        <tr>
                            <th>Emp Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Skills</th>
                            <th>Stack Id</th>
                            <th>Stack Nickname</th>
                            <th>Created By</th>
                            <th>Updated By</th>
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