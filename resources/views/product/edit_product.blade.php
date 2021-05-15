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
                {!! Form::open(['route' => ['product.update', $product->id],'method'=>'post','id'=>'add-product','files' => true]) !!}
                    {{ method_field('PATCH') }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="oldpassword">Post ID</label>
                                {{Form::text('product_id',$product->product_id, ['class' => 'form-control','id'=>'product_id','required' => 'required','placeholder'=>"Post ID","readonly"])}}
                            </div>                           
                                                        
                            <div class="form-group">
                                <label for="oldpassword">Name</label>
                                {{Form::text('name',$product->name, ['class' => 'form-control','id'=>'name','required' => 'required','placeholder'=>"Product name"])}}
                            </div>

                            <div class="form-group">
                                <label for="oldpassword">Email</label>
                                {{Form::email('email',$product->email, ['class' => 'form-control','id'=>'email','required' => 'required','placeholder'=>"Email"])}}
                            </div>  

                            <div class="form-group">
                                <label for="oldpassword">Country</label>
                                <select name="country_id" required="" id="country_id" class="form-control">
                                    <option value="">Select Country</option>
                                    @foreach($country as $key => $corty)
                                        <option value="{{$corty->id}}" @if($product->country_id == $corty->id) {{"selected"}} @endif>{{$corty->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="oldpassword">Mobile Number</label>
                                {{Form::number('mobile',$product->mobile, ['class' => 'form-control','id'=>'mobile','placeholder'=>"Mobile Number"])}}
                            </div>                            

                            <div class="form-group">
                                <label for="oldpassword">Language</label>
                                <select name="language_id" required="" id="language_id" class="form-control">
                                    <option value="">Select Language</option>
                                    @foreach($language as $key => $lang)
                                        <option value="{{$lang->id}}" @if($product->language_id == $lang->id) {{"selected"}} @endif>{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>                        
                            
                            <div class="form-group">
                                <label for="oldpassword">Networks / Website</label>
                                <select name="network_id" required="" id="network_id" class="form-control">
                                    <option value="">Select Netowrk/Site</option>
                                    @foreach($network as $key => $net)
                                        <option value="{{$net->id}}" @if($product->network_id == $net->id) {{"selected"}} @endif>{{$net->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- <div class="form-group">
                                <label for="country">Image</label> 
                                {{Form::file('image', ['class' => 'form-control','id'=>'image'])}}
                            </div>

                            <div class="form-group">
                            <img src="{{url('/public/product/'.$product->image)}}" width="100px"> 
                            </div> -->                          
                            

                            <div class="form-group">
                                <label for="oldpassword">Promotional Link</label>
                                {{Form::text('promotional_link',$product->promotional_link, ['class' => 'form-control','id'=>'promotional_link','required' => 'required','placeholder'=>"Promotional Link"])}}
                            </div>

                            <div class="form-group">
                                <label for="oldpassword">Post/Content Display</label>
                                <select name="post_type" required="" id="network" class="form-control">
                                    <option value="">Select Post/Content</option>    
                                    <option value="1" @if($product->post_type == "1") {{"selected"}} @endif>Above 18</option>
                                    <option value="0" @if($product->post_type == "0") {{"selected"}} @endif>All</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="oldpassword">Captcha Entered</label>
                                {{Form::text('captcha',$product->company_name, ['class' => 'form-control','id'=>'captcha','placeholder'=>"Captcha"])}}
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Paid Amount</label>
                                {{Form::number('cost',$product->cost, ['class' => 'form-control','id'=>'cost','required' => 'required','placeholder'=>"Paid Amount"])}}
                            </div>

                             <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">UPDATE</button>
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

