
@extends('layouts.app')

@section('styles')

@endsection

@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <div>
        <h1 class="page-title">Lista de Usuarios</h1>
    </div>
    <div class="ms-auto pageheader-btn">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- ROW OPEN -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-xl col-lg-6 col-md-12">
                        @can('users.create')                        
                        <div class="btn-list">
                            <a href="{{ route('users.create') }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-inner-icn text-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M16,11.5h-3.5V8c0-0.276123-0.223877-0.5-0.5-0.5S11.5,7.723877,11.5,8v3.5H8c-0.276123,0-0.5,0.223877-0.5,0.5s0.223877,0.5,0.5,0.5h3.5v3.5005493C11.5001831,16.2765503,11.723999,16.5001831,12,16.5h0.0006104C12.2765503,16.4998169,12.5001831,16.276001,12.5,16v-3.5H16c0.276123,0,0.5-0.223877,0.5-0.5S16.276123,11.5,16,11.5z M12,2C6.4771729,2,2,6.4771729,2,12s4.4771729,10,10,10c5.5202026-0.0062866,9.9937134-4.4797974,10-10C22,6.4771729,17.5228271,2,12,2z M12,21c-4.9705811,0-9-4.0294189-9-9s4.0294189-9,9-9c4.9682617,0.0056152,8.9943848,4.0317383,9,9C21,16.9705811,16.9705811,21,12,21z"/></svg>
                                Agregar Usuario
                            </a>
                        </div>
                        @endcan
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12 mt-1 mt-lg-0">
                        
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    @include('components.alert-messages')
                    <table id="user-datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="wd-2"></th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Fecha Alta</th>
                                <th>Ultima Actualización</th>                                
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="text-center">
                                        <div class="avatar avatar-md rounded-circle">
                                            @if ($user->avatar)
                                            <img alt="avatar" class="rounded-circle" src="{{ asset('storage/' . $user->avatar) }}"
                                            alt="{{$user->avatar}}">
                                            @else
                                            <img alt="avatar" class="rounded-circle" src="{{asset('assets/images/default.png')}}">
                                            @endif
                                        </div>
                                    </td>
                                    <td><p class="tx-14 font-weight-semibold text-dark mb-1">{{ $user->name }}</p></td>
                                    <td><span class="text-muted tx-13">{{ $user->email }}</span></td>
                                    <td>{{ $user->roles[0]->name}}</td>
                                    <td><span class="text-muted tx-13">{{ $user->created_at }}</span></td>
                                    <td><span class="badge bg-light text-muted tx-13">{{ $user->updated_at }}</span></td>
                                    <td>
                                        @if (!$user->deleted_at)
                                            <span class="badge font-weight-semibold bg-success-transparent text-success tx-11">Activo</span>
                                        @else
                                            <span class="badge font-weight-semibold bg-danger-transparent text-danger tx-11">Inactivo</span>
                                        @endif                                        
                                    </td>
                                    <td class="btn-list">
                                        <!-- Edit -->
                                        @can('users.edit')    
                                        @if (!$user->deleted_at)
                                            <a href="{{ route('users.edit', $user->id)}}" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Editar">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                        @endif                                            
                                        @endcan

                                        <!-- Delete -->
                                        @can('users.destroy')
                                        @if ($user->id !== 1 && !$user->deleted_at)
                                            <x-delete-modal class="modal-effect btn btn-icon me-2 btn-danger" action="{{ route('users.destroy', $user->id) }}" :model="$user->id" />
                                        @endif                                            
                                        @endcan

                                        <!-- Restore -->
                                        @can('users.restore')
                                        @if ($user->deleted_at)
                                        <x-restore-modal class="modal-effect btn btn-icon me-2 btn-success" action="{{ route('users.restore', $user->id) }}" :model="$user->id" />
                                        @endif
                                        @endcan
                                    </td>
                                </tr>                                
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No hay usuarios registrados</td>
                                </tr>
                            @endforelse

                            <!-- <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md rounded-circle">
                                        <img alt="avatar" class="rounded-circle" src="{{asset('assets/images/faces/4.jpg')}}">
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Ajanto</p>
                                    <p class="tx-13 text-muted mb-0">ajanto.aja445@hotmail.in</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Architect</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">20 days ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">France</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-success-transparent text-success tx-11">Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">23-7-2021</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md bg-success text-white rounded-circle">
                                        W
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Winters</p>
                                    <p class="tx-13 text-muted mb-0">winters.w345@gmail.org</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Front end Designer</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">20 hrs ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Greece</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-secondary-transparent text-secondary tx-11">Not Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">11-2-2021</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md bg-secondary text-white rounded-circle">
                                        CX
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Cox</p>
                                    <p class="tx-13 text-muted mb-0">morenocox.g111@gmail.in</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Junior Technical Author</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">1 month ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Texas</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-success-transparent text-success tx-11">Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">25-5-2021</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md rounded-circle">
                                        <img alt="avatar" class="rounded-circle" src="{{asset('assets/images/faces/7.jpg')}}">
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Kelly</p>
                                    <p class="tx-13 text-muted mb-0">kellybelly357@webmail.org</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Senior Javascript Developer</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">36 mins ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Columbia</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-secondary-transparent text-secondary tx-11">Not Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">13-3-2021</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md rounded-circle">
                                        <img alt="avatar" class="rounded-circle" src="{{asset('assets/images/faces/8.jpg')}}">
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Satou</p>
                                    <p class="tx-13 text-muted mb-0">satousatti3345@gmail.org</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Accountant</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">11 hrs ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Spain</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-success-transparent text-success tx-11">Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">12-6-2020</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md rounded-circle">
                                        <img alt="avatar" class="rounded-circle" src="{{asset('assets/images/faces/9.jpg')}}">
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Williamson</p>
                                    <p class="tx-13 text-muted mb-0">Williamson.wilson123@gmail.in</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Integration Specialist</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">21 hrs ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Bermuda</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-success-transparent text-success tx-11">Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">29-1-2021</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md bg-info text-white rounded-circle">
                                        CH
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Chandler</p>
                                    <p class="tx-13 text-muted mb-0">Chandler.k@mobimail.in</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Sales Assistant</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">28 days ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">China</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-secondary-transparent text-secondary tx-11">Not Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">3-4-2021</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md rounded-circle">
                                        <img alt="avatar" class="rounded-circle" src="{{asset('assets/images/faces/11.jpg')}}">
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Davidson</p>
                                    <p class="tx-12 font-weight-semibold text-muted mb-0">davidson.david@hotmail.com</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Integration Specialist</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">14 mins ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Portugal</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-success-transparent text-success tx-11">Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">19-8-2021</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md bg-warning text-white rounded-circle">
                                        H
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Hurst</p>
                                    <p class="tx-13 text-muted mb-0">Hurst.h@webmail.org.in</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Javascript Developer</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">17 days ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Iceland</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-success-transparent text-success tx-11">Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">16-4-2021</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md rounded-circle">
                                        <img alt="avatar" class="rounded-circle" src="{{asset('assets/images/faces/13.jpg')}}">
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Frost</p>
                                    <p class="tx-13 text-muted mb-0">Frostpup143@gmail.org</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Software Engineer</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">19 hrs ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">India</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-success-transparent text-success tx-11">Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">31-1-2021</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md rounded-circle">
                                        <img alt="avatar" class="rounded-circle" src="{{asset('assets/images/faces/14.jpg')}}">
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Gaines</p>
                                    <p class="tx-13 text-muted mb-0">Gaines.j@hotmail.in</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Office Manager</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">15 days ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Romania</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-secondary-transparent text-secondary tx-11">Not Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">27-3-2021</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md rounded-circle">
                                        <img alt="avatar" class="rounded-circle" src="{{asset('assets/images/faces/15.jpg')}}">
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Flynn</p>
                                    <p class="tx-13 text-muted mb-0">flynn.gov@gmail.in</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Support Lead</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">1 month ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Japan</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-success-transparent text-success tx-11">Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">23-5-2021</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md rounded-circle">
                                        <img alt="avatar" class="rounded-circle" src="{{asset('assets/images/faces/16.jpg')}}">
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Marshall</p>
                                    <p class="tx-13 text-muted mb-0">Marshall@maim.com</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Regional Director</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">2 days ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Mexico</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-success-transparent text-success tx-11">Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">11-7-2020</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <div class="avatar avatar-md rounded-circle">
                                        <img alt="avatar" class="rounded-circle" src="{{asset('assets/images/faces/17.jpg')}}">
                                    </div>
                                </td>
                                <td>
                                    <p class="tx-14 font-weight-semibold text-dark mb-1">Kail</p>
                                    <p class="tx-13 text-muted mb-0">kail@123.org.in</p>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Senior Marketing Designer</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted tx-13">12 mins ago</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">Italy</span>
                                </td>
                                <td>
                                    <span class="badge font-weight-semibold bg-success-transparent text-success tx-11">Verified</span>
                                </td>
                                <td>
                                    <span class="text-muted tx-13">26-4-2021</span>
                                </td>
                                <td><a href="#" class="btn btn-icon btn-primary-light me-2" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a></td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ROW CLOSED -->

@endsection

@section('scripts')

<!-- INTERNAL Data tables js-->
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>

<!-- USERLIST JS-->
<script src="{{asset('assets/js/userlist.js')}}"></script>

@endsection
