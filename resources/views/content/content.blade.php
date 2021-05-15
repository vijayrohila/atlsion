@extends('layouts.app')
@section('content')
<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Content Management</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Content Management</li>
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
                        <h3 class="card-title">Content Management</h3>
                    </div>                    
                    <!-- form start -->
                        {!! Form::open(['route' => ['content.store'],'method'=>'post','id'=>'add-content','files' => true]) !!}
                    
                        <div class="card-body">                            
                            <div class="form-group">
                                <label for="oldpassword">Draws Count (1-25)</label>
                                {{Form::number('drow_count',empty($settings)?'':$settings['drow_count'], ['class' => 'form-control','id'=>'drow_count','required' => 'required','placeholder'=>"Draws Count",'min'=>0,"max"=>25] )}}
                            </div>

                            <div class="form-group">
                                <label for="oldpassword">Prize Money Per 1 Draw</label>
                                {{Form::number('drow_price',empty($settings)?'':$settings['drow_price'], ['class' => 'form-control','id'=>'drow_price','required' => 'required','placeholder'=>"Prize Money Per 1 Draw"])}}
                            </div>

                            <div class="form-group">
                                <label for="country">Banner 1</label> 
                                {{Form::file('image1', ['class' => 'form-control','id'=>'image1'])}}

                                @php
                                    $banner1 = !empty($settings)?$settings['banner1']:"";
                                    $banner2 = !empty($settings)?$settings['banner2']:"";
                                    $banner3 = !empty($settings)?$settings['banner3']:"";
                                @endphp

                                <p><img src="{{url('/public/banner/'.$banner1)}}" style="width: 100px;"></p>
                            </div>

                            <div class="form-group">
                                <label for="country">Banner 2</label> 
                                {{Form::file('image2', ['class' => 'form-control','id'=>'image2'])}}
                                <p><img src="{{url('/public/banner/'.$banner2)}}" style="width: 100px;"></p>
                            </div>

                            <div class="form-group">
                                <label for="country">Banner 3</label> 
                                {{Form::file('image3', ['class' => 'form-control','id'=>'image3'])}}
                                <p><img src="{{url('/public/banner/'.$banner3)}}" style="width: 100px;"></p>
                            </div>

                            <div class="form-group">
                                <label for="about_us">About Us</label>
                                <textarea id="about_us" name="about_us" rows="10" cols="80" required="">{{empty($settings)?'':$settings['about_us']}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="term_condition">Term and Conditions</label>
                                <textarea id="term_condition" name="term_condition" rows="10" cols="80" required="">{{empty($settings)?'':$settings['term_condition']}}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="privacy_policy">Privacy Policy</label>
                                <textarea id="privacy_policy" name="privacy_policy" rows="10" cols="80" required="">{{empty($settings)?'':$settings['privacy_policy']}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="contact_us">Contact Us</label> 
                                <textarea id="contact_us" name="contact_us" rows="10" cols="80" required="">{{empty($settings)?'':$settings['contact_us']}}</textarea>
                            </div>                          
                            

                             <!-- /.card-body -->
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