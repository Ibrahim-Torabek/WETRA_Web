@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Upload a File
                    </div>
                    <div class="card-body">
                        <form action="{{ action([App\Http\Controllers\FileController::class, 'store']) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-3">
                                <!-- <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Choose File</span>
                                </div> -->
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file" require>
                                    <label class="custom-file-label" for="file">No file chosen</label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description" require></textarea>
                            </div>
                            <div class="input-group mb-3">

                                <label for="inputGroupSelect01">Share to:</label>

                                <select class=" user_select js-states" name="shared_to" id="shared_to" style="width:100%">
                                    <option value="0">All Users</option>
                                    <option value="admins">Admins</option>
                                    <option value="barn">Barn Staff</option>
                                    <option value="office">Office Staff</option>
                                    <option value="instructors">Instructors</option>
                                    <option value="volunteers">Volunteers</option>
                                    <optgroup label="Users">
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name}} {{ $user->last_name}}</option>
                                        @endforeach
                                    </optgroup>

                                </select>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Upload" />
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="car">
                    <div class="card-header">
                        Files
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>Ext</th>
                                    <th>Description</th>
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



@stop
@section('script')


@endsection