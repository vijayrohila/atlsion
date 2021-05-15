@extends('layouts.app')
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Subadmin</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> Dashboard</a></li>
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
                        <h3 class="card-title">Edit Subadmin</h3>
                    </div>         
                    {!! Form::open(['route' => ['sub-admin.update', $subadmin->id],'method'=>'post','id'=>'add-admin']) !!}  
                     {{ method_field('PATCH') }}         
                    <!-- form start -->                
                        <div class="card-body">                            
                            <div class="form-group">
                                <label for="oldpassword">Name</label>
                                {{Form::text('name',$subadmin->name, ['class' => 'form-control','required' => 'required','placeholder'=>"Name"])}}
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Email</label>
                                {{Form::text('email',$subadmin->email, ['class' => 'form-control','id'=>'email','required' => 'required','placeholder'=>"email"])}}
                            </div> 
                            <div class="form-group">
                                <label for="password_confirmation">Mobile</label>
                                {{Form::text('mobile',$subadmin->mobile, ['class' => 'form-control','id'=>'mobile','required' => 'required','placeholder'=>"Mobile"])}}
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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

