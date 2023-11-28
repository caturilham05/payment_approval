<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{$title}}</title>
  </head>
  <body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="#">{{$title}}</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		      <div class="navbar-nav" style="display: flex; align-items: center;">
		      	<span>Hallo, Admin</b> </span>
		      	&nbsp;
						<form action="/logout" method="post">
						  @csrf
						  <button type="submit" class="btn btn-outline-primary btn-sm bt mt-1 mb-1 ml-3"><i class="fas fa-arrow-right"></i> Logout</button>
						</form>
		      </div>
		    </div>
		  </div>
		</nav>


    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span>{{ session('success') }}</span>
        </div>
    @endif

	  <section class="section mt-5 container-fluid">
	    <div class="row">
	      <div class="col-md-12">
	        <div class="card">
	          <div class="card-header">
	            <h3 class="card-title">{{$title}}</h3>
	          </div>
	          <div class="card-body">
	            @if (!$payments)
	              <center>
	                <h3>Data tidak ditemukan</h3>
	              </center>
	            @else
	              <table class="table table-bordered">
	                <thead>
	                  <tr>
	                    <th>Nama</th>
	                    <th>Nominal Pembayaran</th>
	                    <th>Status</th>
	                    <th>Tanggal Dibuat</th>
	                    <th>Action</th>
	                  </tr>
	                </thead>
	                <tbody>
	                  @foreach ($payments as $item)
	                      <tr>
	                        <td>{{$item->name}}</td>
	                        <td>{{$item->amount}}</td>
	                        <td>
	                        	@if (empty($item->status))
											        <div class="alert alert-danger alert-dismissible fade show" role="alert">
											            <span>Belum diapprove</span>
											        </div>	                        		
	                        	@else
											        <div class="alert alert-success alert-dismissible fade show" role="alert">
											            <span>Sudah diapprove</span>
											        </div>
	                        	@endif
	                        </td>
	                        <td>{{date('d F Y H:i:s', strtotime($item->created_at))}}</td>
	                        <td>
                            <div style="display: flex; align-items: center; flex-wrap: wrap;">
                            	@if (empty($item->status))
	                              <form action="{{route('admin.approve', $item->id)}}" method="POST">
	                                  @csrf
	                                  <button type="submit" class="btn btn-primary btn-sm" style="cursor: pointer">Approve</button>
	                              </form>
                            	@endif
                              {{-- <a href="{{route('admin.dashboard.content_detail', $item->id)}}" class="btn btn-sm btn-info" style="cursor: pointer; margin-left: 0.5rem;">Detail</a> --}}
                              {{-- <a href="{{route('admin.payment_approve', $item->id)}}" class="btn btn-sm btn-warning" style="cursor: pointer; margin-left: 0.5rem;">Edit</a> --}}
                            </div>
	                        </td>
	                      </tr>
	                  @endforeach
	                </tbody>
	              </table>
	            @endif
	          </div>
	          @if (!empty($contents))
	            <div class="card-footer clearfix">
	            {!! $contents->withQueryString()->links('pagination::bootstrap-5') !!}
	            </div>
	          @endif
	        </div>
	      </div>
	    </div>
	  </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>