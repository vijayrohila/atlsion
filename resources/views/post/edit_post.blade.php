@extends('layouts.app')
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Post</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> Dashboard</a></li>
                    <li class="breadcrumb-item active">Post</li>
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
                        <h3 class="card-title">Edit Post</h3>
                    </div>                    
                    <!-- form start -->
                {!! Form::open(['route' => ['post.update', $post->id],'method'=>'post','id'=>'add-post','files' => true]) !!}
                    {{ method_field('PATCH') }}
                        <div class="card-body">  
                            <div class="form-group">
                                <label for="country">Image</label> 
                                {{Form::file('image', ['class' => 'form-control','id'=>'image','accept'=>"image/*"])}}
                            </div>  
                            <div class="form-group">
                                <img src="{{url('/').'/public/post/'.$post->image}}" style="width: 100%;">
                            </div>                        
                            <div class="form-group">
                                <label for="oldpassword">URL</label>
                                {{Form::url('url',$post->url, ['class' => 'form-control','id'=>'url','required' => 'required','placeholder'=>"URL"])}}
                            </div>                            
                               
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">ADD</button>
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

