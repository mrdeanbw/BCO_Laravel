@extends('layouts.app')

@section('content')


    <div class="container">
        <h3>User Management</h3>


        <table class="table table-striped table-hover">
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>
                        @if(!$u->email_verified && !$u->is_admin)
                        <span class="label label-warning"><i class="fa fa-envelope" aria-hidden="true" tooltip="Email not verified" role="tooltip"></i> Unconfirmed</span>
                        @endif
                        @if(!$u->email_verified && !$u->is_admin)
                         <span class="label label-danger"><i class="fa fa-check-square-o" aria-hidden="true"></i> Unverified</span>
                        @endif
                        @if($u->is_admin) 
                        <span class="label label-info"><i class="fa fa-user-md" aria-hidden="true"></i> Admin</span>
                        @endif
                    </td>
                    <td>
                        {{ $u->name }}
                    </td>
                    <td>
                        {{ $u->email }}
                    </td>
                    <td>
                        {{ $u->organization }}
                    </td>
                    <td>
                        {{ $u->created_at->diffForHumans() }}
                    </td>
                    <td>
                        @if(!$u->email_verified && !$u->is_admin)
                        <a class="btn btn-success btn-sm" href="#">Verify</a>
                        @elseif(!$u->is_admin)
                        <a class="btn btn-danger btn-sm" href="#">Revoke Verification</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection