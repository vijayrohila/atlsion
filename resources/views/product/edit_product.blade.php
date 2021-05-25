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
                {!! Form::open(['route' => ['product.update', $product->id],'method'=>'post','id'=>'update-product','files' => true]) !!}
                    {{ method_field('PATCH') }}
                        <div class="card-body">  
                            <div class="form-group">
                                <label for="country">Image</label> 
                                {{Form::file('image', ['class' => 'form-control','id'=>'image','accept'=>"image/*"])}}
                            </div>  
                            <div class="form-group">
                                <img src="{{url('/').'/public/product/'.$product->image}}" style="width: 100%;">
                            </div>                        
                            <div class="form-group">
                                <label for="oldpassword">Question</label>
                                {{Form::text('question',$product->question, ['class' => 'form-control','id'=>'question','required' => 'required','placeholder'=>"Question"])}}
                            </div>                            
                            <div class="form-group row">
                                <div class="col-md-10">
                                    <label for="oldpassword">Option</label>
                                    {{Form::text('options','', ['class' => 'form-control','id'=>'option','placeholder'=>"Option"])}}
                                </div>    
                                <div class="col-md-2 btn-hover">
                                    <button type="button" class="btn btn-primary" id="add-option">Add Option</button>
                                </div>
                            </div>

                            <div class="form-group" id="list-option">
                                @foreach($product->option as $key=>$option)
                                <p id="remove{{$key}}">
                                    <input type="radio" id="option{{$key}}" name="option" value="{{$option->option}}" data-id="{{$key}}" class="get-answer" @if($option->answer == 1) {{"checked"}} @endif>
                                    <label for="option{{$key}}">{{$option->option}}</label>
                                    <button type="button" class="remove btn btn-danger" style="float:right" id="{{$key}}">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </p>
                                @endforeach
                            </div>

                            <div class="form-group" id="list-answer">
                                @foreach($product->option as $key=>$option)
                                    <p id="hide{{$key}}">
                                        <input type="hidden" name="select[{{$key}}][option]" value="{{$option->option}}">
                                        <input type="hidden" name="select[{{$key}}][answer]" value="{{$option->answer}}" class="option-answer">                    
                                    </p>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label for="start">Start Date</label>
                                {{Form::text('start',$product->start_date, ['class' => 'form-control','id'=>'start','required' => 'required','placeholder'=>"Start Date"])}}
                            </div>
                            <div class="form-group">
                                <label for="end">End Date</label>
                                {{Form::text('end',$product->end_date, ['class' => 'form-control','id'=>'end','required' => 'required','placeholder'=>"End Date"])}}
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

