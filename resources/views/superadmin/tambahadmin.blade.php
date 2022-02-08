@extends('layout.layout')
@section('content')
<div class="row">
      <div class="col-lg-12">
      <div class="card shadow mb-8">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
        </div>
        <div class="card-body">
          <form class="user" method="post" action="{{route('tambahadmin')}}">
            @csrf
            <div class="card-body">
                    @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Something it's wrong:
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
              <div class="form-group row">
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="name" placeholder="Username">
                </div>
              </div>
              <div class="form-group row">
                  <div class="col-lg-12">
                      <input type="email" class="form-control" name="email" placeholder="Email">
                  </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <select class="custom-select" name="role">
                    <option hidden>Pilih Role</option>
                    <option value="2">Admin</option>
                    <option value="1">Super Admin</option>
                  </select>
                </div>
            </div>
              <button class="btn btn-primary btn-user btn-block">
                Simpan
              </button>
          </form>
          </div>
      </div></div></div>

@endsection