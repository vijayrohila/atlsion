@extends('layouts.app')
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Subadmin Change Password</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Subadmin</li>
                </ol>
            </div>
            <div class="col-sm-6">    
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8 m-auto">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Subadmin Change Password</h3>
                    </div>                    
                    <!-- form start -->
                        {!! Form::open(['route' => ['sub.admin.cp.update',$id],'method'=>'post','id'=>'add-admin']) !!}
                        <div class="card-body">                            
                            <div class="form-group">
                                <label for="password_confirmation">Password</label>
                                {{Form::password('password', ['class' => 'form-control','id'=>'password','required' => 'required','placeholder'=>"Password"])}}
                            </div> 
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                {{Form::password('password_confirmation', ['class' => 'form-control','id'=>'password_confirmation','required' => 'required','placeholder'=>"Confirm Password"])}}
                            </div>                                                                            
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>                        
                        </div> 
                    {!! Form::close() !!}
                </div>                          
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

</div>



@endsection

@section('js')

<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDqP1TdIK9QoKX6Ym5DVgrtfTV7PNxMGKw"></script>

 <script src="{{asset('public/js/jquery.geocomplete.js')}}"></script>     

   
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop

@section('css')

<link rel="stylesheet" href="{{asset('public/css/jquery.geocomplete.min.css')}}"> 
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">      

@stop