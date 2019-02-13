@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Send mail using Mailgun</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" id="mail-form" role="form" action="{{ route('send') }}" >
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" autofocus required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="message" class="col-sm-2 col-form-label">Message</label>

                                <div class="col-sm-10">
                                    <textarea name="message" id="message" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    Send
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection