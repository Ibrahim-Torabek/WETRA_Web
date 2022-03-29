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
                            <thead>
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
@endif


@stop