@extends('admin.layout')

@section('main')
<section id="basic-input">
  <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div><h4 class="card-title">VIew Staff</h4></div>
                <div class="float-right">
                  <a href="{{route('admin.staffs.index')}}" class="btn btn-sm btn-primary">Back</a>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Departments</h6>
                        <fieldset class="form-group">
                          <select disabled class="form-control" id="department_id" name="department_id">
                            <option value=""> Select Any Option </option>
                            @if($departments)
                              @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ ( $department->id == $staff->department_id ) ? 'selected' : '' }} >{{ $department->name }}</option>
                              @endforeach
                            @endif
                          </select>
                        </fieldset>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="avatar mr-1 avatar-xl">
                              <img id="user_profile_preview" src="{{ asset('frest/images/portrait/small/avatar-s-20.jpg')}}" alt="avtar img holder">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="first_name">First Name</label>
                                <input disabled type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="{{ ($staff) ? $staff->first_name : '' }}">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="last_name">Last Name</label>
                                <input disabled type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{ ($staff) ? $staff->last_name : '' }}">
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="email">Email</label>
                                <input disabled type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ ($staff) ? $staff->email : '' }}">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="mobile">Mobile</label>
                                <input disabled type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" value="{{ ($staff) ? $staff->mobile : '' }}">
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset class="form-group">
                                <label for="address">Address</label>
                                <textarea disabled class="form-control" id="address" name="address" rows="3" placeholder="Type Address" style="margin-top: 0px; margin-bottom: 0px; height: 92px;">{{ ($staff) ? $staff->address : '' }}</textarea>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Status</h6>
                        <fieldset class="form-group">
                          <select disabled class="form-control" id="status" name="status">
                            <option value="1" value="{{ ($staff->status == 1) ? 'selected' : '' }}" > Active </option>
                            <option value="0" value="{{ ($staff->status == 0) ? 'selected' : '' }}" > Inactive </option>
                          </select>
                        </fieldset>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
@endsection