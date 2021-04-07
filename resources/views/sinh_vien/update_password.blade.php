@extends('layout/layout_sv')
@section('content')
<form id="registerFormValidation" action="{{ route('quan_ly_sinh_vien.process_update_password')}}" method="post" novalidate="">
  {{csrf_field()}}
  @if (Session::has('success'))
  <h4 style="color: red;">
    {{Session::get('success')}}
  </h4>
  @elseif(Session::has('error'))
  <h4 style="color: red;">
    {{Session::get('error')}}
  </h4>
  @endif
  <div class="header">Update password</div>
  <div class="content">
    <div class="form-group">
      <label class="control-label">Old password <star>*</star></label>
      <input class="form-control"
      name="mat_khau_cu"
      type="password"
      required="true"
      />
    </div>

    <div class="form-group">
      <label class="control-label">Password <star>*</star></label>
      <input class="form-control"
      name="mat_khau_moi_1"
      id="registerPassword"
      type="password"
      required="true"
      />
    </div>

    <div class="form-group">
      <label class="control-label">Confirm Password <star>*</star></label>
      <input class="form-control"
      name="mat_khau_moi_2"
      id="registerPasswordConfirmation"
      type="password"
      required="true"
      equalTo="#registerPassword"
      />
    </div>

    <div class="category"><star>*</star> Required fields</div>
  </div>

  <div class="footer">
    <button type="submit" class="btn btn-info btn-fill pull-right">Register</button>
    <div class="form-group pull-left"></div>
    <div class="clearfix"></div>
  </div>
</form>
@endsection