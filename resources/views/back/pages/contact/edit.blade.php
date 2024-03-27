@extends('back.layout.app')
@section('content')
    <div class="content-wrapper">
    <div class="row">
<div class="col-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Basic form elements</h4>
            @if(session('success'))
                <div class="alert alert-success mt-3" id="success-div">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger mt-3" id="error-div">
                    {{ session('error') }}
                </div>
            @endif

            <form  action="{{route('admin.contact.update', $contact->id) }}" class="forms-sample" method="post" enctype="multipart/form-data">
                @csrf
                    @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" readonly value="{{$contact->c_name ?? ''}}" placeholder="Name">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <textarea class="form-control" id="email" name="email" placeholder="Email" readonly>{!! $contact->c_email ?? '' !!}</textarea>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" readonly value="{{$contact->c_subject ?? ''}}" placeholder="Subject">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <input type="text" class="form-control" id="message" name="message" readonly value="{{$contact->c_message ?? ''}}" placeholder="Message">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    @php
                      $status= $contact->status ?? '1';
                    @endphp
                    <select name="status" id="status" class="form-control">
                        <option value="0" {{$status=='0' ? 'selected' : ''}}>Passive</option>
                        <option value="1" {{$status=='1' ? 'selected' : ''}}>Active</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
    </div>
    </div>
@endsection
