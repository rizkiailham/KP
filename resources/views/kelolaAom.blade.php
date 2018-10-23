@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Kelola AOM</h2>
        </div>
        @hasrole('admin')
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Kirim Email Ke Semua</a>
        </div>
        @endhasrole
    </div>
</div>


<table class="table table-bordered">
 <tr>
   <th>No</th> 
   <th>ID AOM</th>
   <th>Jumlah NOA</th>
   <th>Jumlah Plafond</th>
   @hasrole('admin')
   <th width="280px">Action</th>
   @endhasrole
 </tr>
 
 @foreach ($data as $key => $user)
  <tr>

    <td>{{ ++$i }}</td>
    <td>{{ $user->aom }}</td>
    <td>{{ $user->noa }}</td>
    <td>{{ number_format($user->jumlah, 2) }}</td>
    @hasrole('admin')
    <td>
       <a class="btn btn-info" href="{{ route('users.show',$user->aom) }}">Kirim Email</a>
    </td>
    @endhasrole
  </tr>
 @endforeach
</table>
{{ $data->links() }}



@endsection
