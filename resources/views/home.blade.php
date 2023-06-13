@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header">{{ __('Upload Image') }}</div>
                
                <div class="card-body">
                   <form method="POST" action="/store" enctype="multipart/form-data">
                
                   @csrf
                   
                   <input type ="file" class="form-control" name="image"/>
                  
                    <button type="submit" class="btn btn-info ">
                        Upload
                    </button>
            
                   </from>
                </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
        

                       
@endsection
