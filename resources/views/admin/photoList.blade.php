@extends('admin.partials.index')

@section('styles')
    @include('admin.partials.HDdatatables')
@endsection


@section('content')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18 text-white">Manage Role</h4>
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
                                <a class="btn btn-outline-success btn-block mx-2" data-bs-toggle="modal"data-bs-target=".addPhoto-detailModal">Tambah Photo</a>
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
                    <div class="table-responsive ">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive  nowrap w-100" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Photo</th>
                                    <th>Alter</th>
                                    <th>Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $photo as $p)
                                    <tr>
                                        <th scope="row">{{ $loop->index+1 }}</th>
                                        {{-- {{ dd(asset('storage/public/gallery/'.$p->photo_render)) }} --}}
                                        <td><img src="{{ asset('storage/gallery/'.$p->photo_render) }}" alt="{{ asset('storage/gallery'.$p->photo_render) }}" width="80"></td>
                                        <td>{{ $p->photo_alt }}</td>
                                        <td>{{ $p->photo_order }}</td>
                                        <td class="text-center"> 
                                            <button class="btn btn-primary bg-gradient" data-bs-toggle="modal" data-bs-target="#viewPhoto-{{ $p->id }}"><i class="bx bx-show"></i></button>
                                            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target=".editPhoto-{{ $p->id }}"><i class="bx bx-edit"></i></a>
                                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target=".deleteCon-{{ $p->id }}"><i class="bx bx-trash"></i></a>
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

@if (!$photo->isEmpty())
   @foreach ( $photo as $ps)
        {{-- edit modal --}}
        <div class="modal fade editPhoto-{{ $ps->id }}" tabindex="-1" role="dialog" aria-labelledby="editPhoto-{{ $ps->id }}" aria-hidden="true" id="editPhoto-{{ $ps->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Photo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update.photo', $ps->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="form-label">Category</label>
                                <div class="input-group">
                                    <input type="int" name="oldCategoryId" value="{{$ps->id_category }}" hidden>
                                    <select class="form-select" name="category_id">
                                        @foreach ( $cate as $c)
                                        <option value="{{ $c->id }}" {{ $c->id == $ps->id_category ? 'selected' : '' }}>{{ $c->category_code.' - '.$c->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">Photo Alter</label>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="text" name="photo_alt" value="{{ $ps->photo_alt }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">Photo Order</label>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="number" name="photo_order" value="{{ $ps->photo_order }}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">The Photo</label>
                                <div class="text-center mb-2">
                                   <img src="{{ asset('storage/gallery/'.$ps->photo_render) }}" alt="{{ $ps->photo_alt }}" width="300">
                                </div>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="file" name="photo_render" id="image" accept="image/*" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <div class="row float-end">
                            <div class="">
                                <button type="submit" class="btn btn-primary">Update Photo</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- view modal --}}
        <div class="modal fade viewPhoto-{{ $ps->id }}" tabindex="-1" role="dialog" aria-labelledby="viewPhoto-{{ $ps->id }}" aria-hidden="true" id="viewPhoto-{{ $ps->id }}">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">view Photo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div class="mb-3 row">
                                <label class="form-label">Category</label>
                                <div class="input-group">
                                    <input type="int" name="oldCategoryId" value="{{$ps->id_category }}" hidden>
                                    <select class="form-select" name="roles_id" disabled>
                                        @foreach ( $cate as $c)
                                        <option value="{{ $c->id }}" {{ $c->id == $ps->id_category ? 'selected' : '' }}>{{ $c->category_code.' - '.$c->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">Photo Alter</label>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="text" name="photo_alt" value="{{ $ps->photo_alt }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">Photo Order</label>
                                <div class="input-group ">
                                    <input class="form-control form-control-md" type="number" name="photo_order" value="{{ $ps->photo_order }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="NIM" class="form-label">The Photo</label>
                                <div class="text-center">
                                    <img src="{{ Storage::url('/gallery//'.$ps->photo_render) }}" alt="{{ $ps->photo_alt }}" height="200">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
    
                        </div>
                </div>
            </div>
        </div>

        <!-- COnfirmation Modal -->
        <div class="modal fade deleteCon-{{ $ps->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCon-{{ $ps->id }}"
            aria-hidden="true" id="deleteCon-{{ $ps->id }}">
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
                        <form action="{{ route('delete.photo', $ps->id) }}" method="POST">
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

<div class="modal fade addPhoto-detailModal" tabindex="-1" role="dialog" aria-labelledby="addPhoto-detailModal" aria-hidden="true" id="addPhoto-detailModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label class="form-label">Category</label>
                        <div class="input-group">
                            <select class="form-select" name="category_id" required>
                                @foreach ( $cate as $c)
                                <option value="{{ $c->id }}">{{ $c->category_code.' - '.$c->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="NIM" class="form-label">Photo Alter</label>
                        <div class="input-group ">
                            <input class="form-control form-control-md" type="text" name="photo_alt" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="NIM" class="form-label">Photo Order</label>
                        <div class="input-group ">
                            <input class="form-control form-control-md" type="number" name="photo_order" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="NIM" class="form-label">The Photo</label>
                        <div class="input-group ">
                            <input class="form-control form-control-md" type="file" name="photo_render" id="image" accept="image/*" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <div class="row float-end">
                    <div class="">
                        <button type="submit" class="btn btn-primary">Add Photo</button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('extras')
    @include('admin.partials.FTdatatables')
@endsection