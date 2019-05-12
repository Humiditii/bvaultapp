@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard <span class="glyphicon glyphicon-user"></span></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome  {{ $user->name }} to your achive! <span class="glyphicon glyphicon-briefcase">
                </div>
            </div>
            


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> Storage analysis <span class="glyphicon glyphicon-hdd"></h3>
        </div>
        <div class="panel-body">
            <ul class="list-group">
            <li class="list-group-item">
                <div class="progress"> 
                    <div class="progress-bar progress-bar-info" role="progressbar"
                    aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"
                    style="width: {{$percentageUsed}}%;">
                    <span class="sr-only">{{$percentageUsed}}% Complete (info)</span>
                    </div>
                </div></li>
            <li class="list-group-item">Size used: <span class="badge">{{$convertKbBackToMb.$sizeType}}</span> </li>
            <li class="list-group-item">Allocated size: <span class="badge">{{$defaultSizeAllocted}}Mb</span></li>
            <li class="list-group-item">Remaining size: <span class="badge">{{$remainingSize}}Mb</span></li>
            <li class="list-group-item">Percentage Used: <span class="badge">{{$percentageUsed}}%</span></li>
            <li class="list-group-item">Percentage Remaining: <span class="badge">{{$percentageRemaining}}%</span></li>

        </div>
    </div>
   <div class="">
            <div class="col-md-offset-5 col-sm-offset-5">
                <div class="btn-group btn-group-md">
               <a class="btn btn-primary" href="{{ route('uploads.index') }}"> <span class="glyphicon glyphicon-briefcase"></span> GO TO FILES</a>
            </div>    
        </div>
   </div>


        </div>
    </div>
</div>
@endsection
