@extends('layouts.app')

@section('content')



<div class="container pt-5">
    @if(Auth::user()->is_admin == 1)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header" data-toggle="collapse" href="#card-body" role="button">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#car-body" aria-expanded="true" aria-controls="cad-body">
                                Upload a File
                            </button>
                        </h2>
                    </div>
                    <div class="card-body collapse show" id="card-body">
                        <form action="{{ action([App\Http\Controllers\FileController::class, 'store']) }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                            @csrf
                            <div class="input-group mb-3">
                                <!-- <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Choose File</span>
                                </div> -->
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file" accept="image/*,.pdf"> require>
                                    <label class="custom-file-label" for="file">No file chosen</label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description" require></textarea>
                            </div>
                            <div class="input-group mb-3">

                                <label for="inputGroupSelect01">Share to:</label>

                                <input type="hidden" id="is_group" name="is_group" >
                                <select class=" user_select js-states" name="shared_to" id="shared_to" style="width:100%">
                                    
                                    <option value="0">All Users</option>
                                    @foreach(App\Http\Controllers\GroupController::all() as $group)
                                    <option value="{{ $group->id }}" is_group="1"> {{ $group->name }}</option>
                                    @endforeach
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
    @endif
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="car">
                    <div class="card-header">
                        Files
                    </div>
                    <div class="card-body border">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>Ext</th>
                                    <th>Description</th>
                                    @if(Auth::user()->is_admin == 1)
                                        <th width="100px">Action</th>
                                    @endif
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
    var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('files.index') }}",
                columns: [{
                        data: 'file_name',
                        name: 'file_name',
                        render: function(data,type,row){
                            return "<a href='" +  row.file_url.replace('storage/upload', 'storage/files') + "'>" + row.file_name + "</a>";
                        }
                        
                    },
                    {
                        data: 'file_extention',
                        name: 'file_extention'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    @if(Auth::user()->is_admin == 1)
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    @endif
                ]
            });
</script>

@stop