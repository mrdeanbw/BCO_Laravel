@extends('layouts.app')

@section('content')
    <style>
        .table > thead > tr > th, .table > thead > tr > td, .table > tbody > tr > th, .table > tbody > tr > td, .table > tfoot > tr > th, .table > tfoot > tr > td {
            vertical-align: middle;
        }
    </style>

    <div class="container">
        <h3>User Management</h3>
        @if (Session::has('message'))
			<div class="panel-body">
				<div class="alert alert-info">{{ Session::get('message') }}</div>
			</div>
		@endif

        <table class="table table-striped table-hover">
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td rowspan="2" style="vertical-align: middle;">
                        @if(!$u->email_verified && !$u->is_admin)
                        <span class="label label-warning"><i class="fa fa-envelope" aria-hidden="true" tooltip="Email not verified" role="tooltip"></i> Unconfirmed</span>
                        @endif
                        @if(!$u->admin_verifier && !$u->is_admin)
                         <span class="label label-danger"><i class="fa fa-check-square-o" aria-hidden="true"></i> Unverified</span>
                        @endif
                        @if($u->is_admin) 
                        <span class="label label-info"><i class="fa fa-user-md" aria-hidden="true"></i> Admin</span>
                        @endif
                    </td>
                    <td rowspan="2" style="vertical-align: middle;">
                        <strong>{{ $u->name }}</strong>
                    </td>
                    <td>
                        {{ $u->email }}
                    </td>
                    <td>
                        {{ $u->organization }}
                    </td>
                    <td>
                    <select>
                    <option>Exporter</option>
                    <option value="importer">Importer</option>
                    </select>
                        
                    </td>
                    <td>
                        {{ $u->created_at->diffForHumans() }}
                    </td>
                    <td>
                        @if(!$u->admin_verifier && !$u->is_admin)
                        <a class="btn btn-success btn-sm" href="{{ url('/admincp/u/toggle/' . $u->id) }}">Verify</a>
                        @elseif(!$u->is_admin)
                        <a class="btn btn-danger btn-sm" href="{{ url('/admincp/u/toggle/' . $u->id) }}">Revoke Verification</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><strong>ExFreight:</strong> {{ $u->exfreight_status ?? 'Not Requested' }}</td>
                    <td></td>
                    <td></td>
                    <td>
                    </td>
                    <td>
                        @if($u->exfreight_status == 'Pending')
                            <a class="btn btn-info btn-sm" href="{{ url('/admincp/u/exfreight/' . $u->id) }}">Add ExFreight Creds</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <center>
            {{ $users->links() }}
        </center>
    </div>

@endsection