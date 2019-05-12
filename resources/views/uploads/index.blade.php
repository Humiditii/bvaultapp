@extends('layouts.app')

@section('content')


<div class="container">	

	<table class="table table-condensed table-responsive">
		<caption>
				<h3>
					{{$user->name}}
				</h3>
		</caption>
			<thead>
				<tr>
					<th>Description <span class="glyphicon glyphicon-pushpin"></th>
					<th>File name <span class="glyphicon glyphicon-file"></span></th>
					<th>Size <span class="glyphicon glyphicon-floppy-disk"></th>
					<th>Type <span class="glyphicon glyphicon glyphicon-th"></th>
					<th> <TIME></TIME> <span class="glyphicon glyphicon glyphicon-th"></th>
					<th>Action</th>
					
				</tr>
			</thead>
			<tbody class="table-responsive">
				@foreach($userUploads as $uploads )
					<tr>
							<td>{{ $uploads->description }}</td>
							<td><a href=" {{ route('uploads.show', $uploads->id) }} " >{{$uploads->path}}</a> </td>
							<td>{{ $uploads->size.$uploads->sizeType }}</td>
							<td>{{ $uploads->type }}</td>
							<td>{{ $uploads->created_at->diffForHumans() }}</td>
							<th>
								<form method="post" action="">
									{{csrf_field()}}
									<input type="hidden" name="_method" value="DELETE">
									<input class="btn btn-danger" type="submit" value="Delete">
								</form>
							</th>
						

					</tr>

				@endforeach
			
			</tbody>
	</table>
	<div class="row">
		<div class="col-sm-6 col-sm-offset-5">
			{{ $userUploads->render() }}
		</div>
	</div>
	<div class="col-md-6 col-md-offset-5 col-sm-offset-5">
            <div class="btn-group btn-group-md">
               <a class="btn btn-primary" href="{{ route('uploads.create') }}"><span class="glyphicon glyphicon-file"></span> Upload new files</a>  <a class="  btn btn-primary" href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span> Home</a>
            </div>    
        </div> 
      {{--   <div class="col-md-offset-5 col-sm-offset-5">
            <div class="btn-group btn-group-md">
               <a class="btn btn-primary" href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span> Home</a>
            </div>    
        </div> --}}
</div>


@endsection()

	

