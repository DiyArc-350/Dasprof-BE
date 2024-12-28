@extends('admin.partials.index')

@section('styles')
    @include('admin.partials.HDdatatables')
@endsection


@section('content')

<div class="container-fluid">
    @if (session('success'))
       <div  class="alert alert-success fade show mt-1" data-timeout="5000" role="alert">
            {{  session('success') }}
        </div>
   @endif
   @if (session('error'))
       <div class="alert alert-danger fade show mt-1" data-timeout="5000" role="alert">
            {{  session('error') }}
        </div>
   @endif
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18 text-white">Manage Category</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 align-self-start">
                            <div class="text-lg-start mt-4 mt-lg-0">
                                <a class="btn btn-outline-success btn-block mx-2" data-bs-toggle="modal"data-bs-target=".addCategory-detailModal">Tambah Category</a>
                            </div>
                        </div>
    
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive  nowrap w-100">
    
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $c)
                                <tr>
                                    <th scope="row">{{ $loop->index+1}}</th>
                                    <td>{{ $c->category_code }}</td>
                                    <td>{{ $c->category_name }}</td>
                                    <td>{{ $c->category_desc }}</td>
                                    <td>
                                        <button class="btn btn-primary bg-gradient" data-bs-toggle="modal" data-bs-target="#viewCategory-{{ $c->id }}"><i class="bx bx-show"></i></button>
                                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target=".editCategory-{{ $c->id }}"><i class="bx bx-edit"></i></a>
                                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target=".deleteCon-{{ $c->id }}"><i class="bx bx-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    
                </div>
            </div>
        </div>
    </div> <!-- end row -->

</div> <!-- container-fluid -->


@if (!$category->isEmpty())
    @foreach ($category as $d)
        <div class="modal fade editCategory-{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategory-{{ $d->id }}"
        aria-hidden="true" id="editCategory-{{ $d->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategory-detailModal">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update.category', $d->id) }}" method="POST">
                            @csrf
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">Category Code</label>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="text" name="category_code" value="{{ $d->category_code }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">Category Name</label>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="text" name="category_name" value="{{ $d->category_name }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">Category Name</label>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="text" name="category_name" value="{{ $d->category_name }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="input-group form-label">Category Description</label>
                                <div class="col">
                                    <textarea class="form-control" rows="8" id="example-text-input" name="category_desc" required>{{ $d->category_desc }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <div class="row float-end">
                            <div class="">
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal -->
         <div class="modal fade viewCategory-{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="viewCategory-{{ $d->id }}"
        aria-hidden="true" id="viewCategory-{{ $d->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategory-detailModal">View Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">Category Code</label>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="text" name="category_code" value="{{ $d->category_code }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">Category Name</label>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="text" name="category_name" value="{{ $d->category_name }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">Category Name</label>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="text" name="category_name" value="{{ $d->category_name }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="input-group form-label">Category Description</label>
                                <div class="col">
                                    <textarea class="form-control" rows="8" id="example-text-input" name="category_desc" readonly>{{ $d->category_desc }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">Created</label>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="text" name="created_at" value="{{ $d->created_at }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">Updated</label>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="text" name="updated_at" value="{{ $d->updated_at }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                </div>
            </div>
        </div>

             <!-- COnfirmation Modal -->
        <div class="modal fade deleteCon-{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCon-{{ $d->id }}"
            aria-hidden="true" id="deleteCon-{{ $d->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning bg-gradient text-center">
                        <h4 class="modal-title text-bold text-white"  >WARNING!!</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="mb-2">
                            <p>Setelah di hapus, data yang sudah dihapus <br>
                                tidak dapat kembali. Seperti dia</p>
                        </div>
                        <form action="{{ route('delete.category', $d->id) }}" method="POST">
                            @csrf
                        </div>
                        <div class="modal-footer">
                        <div class="row float-end">
                            <div class="mr-2">
                                <button type="submit" class="btn btn-success bg-gradient">Yakin kok</button>
                                <button type="button" class="btn btn-danger bg-gradient" data-bs-dismiss="modal">Gajadi</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal -->
    @endforeach
@endif

<!-- Add Modal -->
 <div class="modal fade addCategory-detailModal" tabindex="-1" role="dialog" aria-labelledby="addCategory-detailModal"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="addCategory-detailModal">Tambah Category</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                <form action="{{ route('add.category') }}" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <label for="NIM" class="form-label">Category Code</label>
                        <div class="input-group ">
                            <input class="form-control form-control-md" type="text" name="category_code" value="{{ $d->category_code }}" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="NIM" class="form-label">Category Name</label>
                        <div class="input-group ">
                            <input class="form-control form-control-md" type="text" name="category_name" value="" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="input-group form-label">Category Description</label>
                        <div class="col">
                            <textarea class="form-control" rows="8" id="example-text-input" name="category_desc" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <div class="row float-end">
                    <div class="">
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </div>
                </div>
            </form>
         </div>
     </div>
 </div>
 <!-- end modal -->
@endsection


@section('extras')
    @include('admin.partials.FTdatatables')
@endsection