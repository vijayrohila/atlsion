@extends('layouts.app')
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Question</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Question</li>
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
                        <h3 class="card-title">Add Question</h3>
                    </div>                    
                    <!-- form start -->
                        {!! Form::open(['route' => ['product.store'],'method'=>'post','id'=>'add-product','files' => true]) !!}
                    
                        <div class="card-body">                            
                            <div class="form-group">
                                <label for="oldpassword">Question</label>
                                {{Form::text('question','', ['class' => 'form-control','id'=>'question','required' => 'required','placeholder'=>"Question"])}}
                            </div>
                            <div class="form-group">
                                <label for="country">Image</label> 
                                {{Form::file('image', ['class' => 'form-control','id'=>'image','required' => 'required'])}}
                            </div>
                            <div class="form-group">
                                <label for="oldpassword">Option</label>
                                {{Form::text('option','', ['class' => 'form-control','id'=>'option','required' => 'required','placeholder'=>"Option"])}}
                                <button type="button" class="btn btn-primary" id="add-option">Add Option</button>
                            </div>
                            <div class="form-group" id="list-option">

                            </div>
                            <div class="form-group">
                                <label for="start">Start Date</label>
                                {{Form::text('start','', ['class' => 'form-control','id'=>'start','required' => 'required','placeholder'=>"Start Date"])}}
                            </div>
                            <div class="form-group">
                                <label for="end">End Date</label>
                                {{Form::text('end','', ['class' => 'form-control','id'=>'end','required' => 'required','placeholder'=>"End Date"])}}
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