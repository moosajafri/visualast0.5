@extends('layouts.app')

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Visualast - Dashboard</title>

@section('content')
    <div style="margin-left:5%;margin-top: 6%" id="viewLeads">
        @if($role=='admin')
            <div style="margin-right: 5%" class="panel panel-info">
                <div class=" text-capitalize text-center panel-heading">People with Information available</div>
                <div class="panel-body">
                    <table class="table">
                        <thead class="alert-info">
                        <th>Serial #</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Registered at</th>
                        <th>Profile Link</th>
                        </thead>
                        <tbody>
                        @foreach($leads as $lead)

                            <tr>
                                <td>{{$count}}</td>
                                <td>{{$lead->name}}</td>
                                <td>{{$lead->email}}</td>
                                <td>{{$lead->created_at}}</td>
                                <td><a href="/dashboard/showLead/{{$lead->id}}">View complete Profile</a></td>
                                <?php $count++; ?>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if($role!='admin')
            {{abort(404)}}
        @endif
    </div>

@endsection