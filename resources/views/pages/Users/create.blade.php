@extends('layouts.app')

@section('styles')

@endsection

@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <div>
        <h1 class="page-title">Agregar Usuario</h1>
    </div>
    <div class="ms-auto pageheader-btn">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Agregar Usuario</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!--ROW OPENED-->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div  class="card">
            <div class="card-header border-bottom">
                <h4 class="mb-0">Información del Usuario</h4>
            </div>
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body p-0 task-edit-main">
                <div class="row p-5">
                        <div class="col-sm-12 col-md-12 col-xl-3">
                            <div class="form-group">
                                <label class="form-label text-muted" for="name">Avatar:</label>
                                <input id="avatar" name="avatar" type="file" class="dropify" data-height="200"
                                accept="image/jpeg, image/png"  />
                            </div>
                        </div>
                    </div>
                    <div class="row p-5 border-bottom">
                        <div class="col-sm-12 col-md-12 col-xl-3">
                            <div class="form-group">
                                <label class="form-label text-muted" for="name">Nombre:</label>
                                <div class="input-group" id="user-name">
                                    <input type="text" class="form-control text-dark @error('name') is-invalid @enderror" 
                                    id="name" name="name" placeholder="Ingrese el nombre" value="{{old('name')}}">
                                </div>
                                @error('name')
                                <span class="help-block text-red">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xl-3">
                            <div class="form-group">
                                <label class="form-label text-muted" for="email">Correo:</label>
                                <div class="input-group" id="user-email">
                                    <input type="email" class="form-control text-dark @error('email') is-invalid @enderror" id="email" name="email" placeholder="Ingrese el correo"
                                    value="{{old('email')}}">
                                </div>
                                @error('email')
                                <span class="help-block text-red">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xl-3">
                            <div class="form-group">
                                <label class="form-label text-muted" for="password">Contraseña:</label>
                                <div class="input-group" id="user-password">
                                    <input type="password" class="form-control text-dark input-password @error('password') is-invalid @enderror" id="password" name="password" placeholder="Ingrese la contraseña">
                                    <span class="input-group-text btn btn-primary text-white show-password">
                                        <i class="fe fe-eye eye-open"></i>
                                        <i class="fe fe-eye-off eye-close d-none"></i>
                                    </span>
                                </div>
                                @error('password')
                                <span class="help-block text-red">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xl-3">
                            <div class="form-group">
                                <label class="form-label text-muted" for="role">Rol:</label>                           
                                <select id="role" name="role" class="form-control form-select @error('role') is-invalid @enderror" data-placeholder="rol">
                                    <option label="Selecciona una opción"></option>
                                    @foreach ($roles as $rol)
                                        <option value="{{$rol->name}}">{{ $rol->name }}</option>
                                    @endforeach
                                </select>   
                                @error('role')
                                <span class="help-block text-red">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>                             
                        </div>
                    </div>                   
                    
                    <div class="row p-5">
                        <div class="btn-list text-end">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-danger"> <i class="fe fe-x-circle"></i> Cancelar</a>
                            <button type="submit" class="btn btn-primary"> <i class="fe fe-check-circle"></i> Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ROW CLOSED-->

@endsection

@section('scripts')

<!-- SELECT2 JS -->
<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>

<!-- bootstrap-datepicker js -->
<script src="{{asset('assets/plugins/bootstrap-datepicker/js/datepicker.js')}}"></script>

<!-- FORMEDITOR JS -->
<script src="{{asset('assets/plugins/quill/quill.min.js')}}"></script>

<!-- FILE UPLOAD JS -->
<script src="{{asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>

<!-- TASK EDIT JS-->
<script src="{{asset('assets/js/client-create.js')}}"></script>

@endsection
