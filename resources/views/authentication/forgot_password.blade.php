@extends('layouts.front.app')

@section('title') Tenjin - Forgot Password @endsection

@section('content')
    </section>

    <div class="container">
        <div class="forgot-wrapper">
            <h3>Forgot Password</h3>
            <form action="{{route('post_forgot_password')}}" method="post" enctype="multipart/form-data" >
                @csrf
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="inputemail3">Email address</label>
                    <input type="email" name="email" class="form-control" id="inputemail3" placeholder="Enter email" required>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn btn-primary ">Send Password Reset Code</button>
                </div>
            </form>
        </div>
    </div>

@endsection