@extends('backend.master')
@section('content')
    <style>
        th.dt-center, td.dt-center { text-align: center; }
        small{
            font-size: 60%;
            font-weight: 400;
            color: #6e6b6b;
        }
    </style>


            <h1 class="page-header mt-2">Users
                <small>List</small>
            </h1>
            <hr>
        <table id="example" class="table display cell-border mt-2" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Level</th>
                <th>CMT</th>
                <th>Modifly</th>

            </tr>
            </thead>
        </table>

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                paging: true,
                processing:false,

                ajax:'{{asset('admin/user/data')}}',
                columns:[

                    {data:'id',"width": "5%"},
                    {data:'name'},
                    {data:'email'},
                    {data:'level',"render": function (data, type, row) {

                            if (row.level === 1) {
                                return 'Admin';
                            }else if(row.level === 0){
                                return 'User';
                            }else if(row.level === 2){
                                return 'Quản lý';
                            };

                        }},
                    {data:'CMT'},
                    {data:'Modifly',
                        "searchable": false,
                        "orderable":false,
                        "render": function (data, type, row) {
                            return '<a href="" class="btn btn-outline-info info"><i class="fas fa-info-circle"></i></a>&nbsp;<a href="" class="btn btn-outline-primary edit"><i class="fas fa-edit"></i></a>&nbsp;<a href="admin/user/delete/'+row.id+'" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>'

                        }}

                ]
            });
            $(document).on('click','.info',function (e) {
                e.preventDefault();
                alert('123')
            })
        } );
    </script>
@stop
