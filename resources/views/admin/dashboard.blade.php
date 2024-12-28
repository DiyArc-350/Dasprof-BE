@extends('admin.partials.index')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18 text-white">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="d-flex">
                                <div class="flex-grow-1 align-self-center">
                                    <div class="text-muted">
                                        <p class="mb-2">Welcome Back!!</p>
                                        <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 align-self-center">
                            <div class="text-lg-center mt-4 mt-lg-0">
                                <div class="row">
                                    <div class="col-6">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Categories</p>
                                            <h5 class="mb-0">{{ auth()->user()->category() }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Photos</p>
                                            <h5 class="mb-0">{{ auth()->user()->photo() }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Cat. Code</th>
                                    <th>Cat. Name</th>
                                    <th>Photo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $c)
                                <tr>
                                    <th scope="row">{{ $loop->index +1 }}</th>
                                    <td>{{ $c->category_name }}</td>
                                    <td>{{ $c->category_code }}</td>
                                    <td>
                                       @foreach ( $photo as $p)
                                           @if ($p->id_category == $c->id)
                                            <div class="my-2">
                                                <img src="{{ asset('storage/gallery/'.$p->photo_render) }}" height="100" alt="{{ $p->photo_alt }}"/>
                                            </div>
                                           @endif
                                       @endforeach
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- end row -->

</div> <!-- container-fluid -->
@endsection