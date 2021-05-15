<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        
        <span class="brand-text font-weight-light " style="margin: 17%;">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item has-treeview @if(\Request::route()->getName() == 'change-password') {{'menu-open'}} @endif" >
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-key"></i>
                        <p>
                          Change Password
                            <i class="fas fa-angle-left right"></i>                            
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('change-password') }}" class="nav-link @if(\Request::route()->getName() == 'change-password') {{'active'}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>                        
                    </ul>                    
                </li> 

                @can('isAdmin')
                <li class="nav-item has-treeview @if(\Request::route()->getName() == 'content') {{'menu-open'}} @endif" >
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-chart-bar"></i>
                        <p>
                          Content Management
                            <i class="fas fa-angle-left right"></i>                            
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('content') }}" class="nav-link @if(\Request::route()->getName() == 'content') {{'active'}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Content Management</p>
                            </a>
                        </li>                        
                    </ul>                    
                </li>
                @endcan                

                <li class="nav-item has-treeview @if(\Request::route()->getName() == 'player.index' ) {{'menu-open'}} @endif" >
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-donate"></i>
                        <p>
                          Data Management
                            <i class="fas fa-angle-left right"></i>                            
                        </p>
                    </a>                    
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('player.index') }}" class="nav-link @if(\Request::route()->getName() == 'player.index') {{'active'}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Management</p>
                            </a>
                        </li>                        
                    </ul>                    
                </li> 

                @can('isAdmin')
                <li class="nav-item has-treeview @if(\Request::route()->getName() == 'product.index' || \Request::route()->getName() == 'product.store') {{'menu-open'}} @endif" >
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-ad"></i>                        
                        <p>
                          Upload Data
                            <i class="fas fa-angle-left right"></i>                            
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link @if(\Request::route()->getName() == 'product.index') {{'active'}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Question List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add-product') }}" class="nav-link @if(\Request::route()->getName() == 'add-product') {{'active'}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Question</p>
                            </a>
                        </li>                        
                    </ul>                                        
                </li>    

                <li class="nav-item has-treeview @if(\Request::route()->getName() == 'winner' ) {{'menu-open'}} @endif" >
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-ad"></i>                        
                        <p>
                          Winner List
                            <i class="fas fa-angle-left right"></i>                            
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('winner') }}" class="nav-link @if(\Request::route()->getName() == 'winner') {{'active'}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Winner List</p>
                            </a>
                        </li>                                                
                    </ul>                                        
                </li>                    
                 
                <li class="nav-item has-treeview @if(\Request::route()->getName() == 'sub-admin.index' || \Request::route()->getName() == 'sub-admin.add') {{'menu-open'}} @endif" >
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                          Sub Admin
                            <i class="fas fa-angle-left right"></i>                            
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sub-admin.index') }}" class="nav-link @if(\Request::route()->getName() == 'sub-admin.index') {{'active'}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Admin List</p>
                            </a>
                        </li>                        
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sub-admin.add') }}" class="nav-link @if(\Request::route()->getName() == 'sub-admin.add') {{'active'}} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Sub Admin</p>
                            </a>
                        </li>                        
                    </ul>                    
                </li> 
                @endcan                          
              </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>