@extends('layouts.app')

@section('content')


@if(Auth::user()->is_admin ==1)
<div class="container pt-5">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="car">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body border">
                        <table class="table table-bordered user-table">
                            <thead style="width: 100%">
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Group</th>
                                    <th>Status</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var table = $('.user-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [{
                data: 'first_name',
                name: 'first_name',
                render: function(data, type, row) {
                    //var url = action([App/Http/Controllers/UserController::class, 'show']);
                    return "<a href=users/" + row.id + ">" + row.first_name + "</a>";
                    //return "<a href={{ URL::route('users.show', 23) }}>" + row.first_name + "</a>";
                }

            },
            {
                data: 'last_name',
                name: 'last_name'
            },
            {
                data: 'group',
                name: 'group',

            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });
</script>
@endif


@stop