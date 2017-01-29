@extends('layouts.app')

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Visualast - Dashboard</title>

@section('content')

    <div style="overflow-y:hidden;margin-left:5%" id="dashboard">
        <div style="margin-top:10%;color: #ededed">
            @if($role=='member')
                <div class="form-group">
                    <input style="margin-right:2%;vertical-align:bottom;display:inline-block;width: 2%;" type="checkbox" class="form-control" id="lead">
                    <label for="lead">&nbsp &nbsp Send your information to us. <br> Our recruiters will help you with job placement! </label>
                </div>

                <div style="margin-right: 5%" class="panel panel-info">
                    <div class="panel-heading">Notification Centre</div>
                    <div class="panel-body">
                        <p style="color: darkred">* new messages marked in red</p>
                        <table class="table">
                            <thead class="alert-info">
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Sent At</th>
                            <th>From</th>
                            </thead>
                            <tbody>
                            @foreach($messages as $message)
                                @if($message->is_read == false)<tr style="color: darkred"> @endif
                                @if($message->is_read == true)<tr> @endif
                                    <td>{{$message->subject}}</td>
                                    <td>{{$message->message}}</td>
                                    <td>{{$message->updated_at}}</td>
                                    <td>Admin</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if($role=='admin')
                <a class="btn btn-default" href="/dashboard/viewLeads">View All users who want job placement</a><br><br>

                <div class="form-group">
                    <label style="vertical-align: top;" for="subject">Subject:&nbsp&nbsp&nbsp</label>
                    <textarea id="subject" style="color:black;resize:none;"  id="lead" cols="50" rows="1" placeholder="Enter subject here..."></textarea>
                </div>
                <div class="form-group">
                    <label style="vertical-align: top;" for="subject">Message:</label>
                    <textarea id="message" style="display:inline-block;color:black;resize:none;" id="lead" cols="50" rows="8" placeholder="Enter message here..."></textarea>
                </div>
                <!-- <div class="form-group">
                     <label style="vertical-align: top;" for="subject">E-mail:&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                     <input placeholder="Enter email to send to one user..." style="width: 33%" type="text">
                 </div> -->
                <button id="sendMessage" type="submit" class="btn btn-default">Send Message to All</button>
                <!-- <button id="sendMessage" type="submit" class="btn btn-default">Send Message Chosen</button> -->
            @endif
        </div>
    </div>


    <div class="modal fade" id="status" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="text-center modal-body">
                    @if($role=='member')
                        <p>Status successfully changed!</p>
                    @endif
                    @if($role=='admin')
                        <p>Message Sent</p>
                    @endif
                </div>

            </div>
        </div>
    </div>


    @if($role=='member')
        <script type="text/javascript">
            $( "#lead" ).click(function() {
                var paramaters = "value=" + $('#lead').is(':checked');
                $.ajax({
                    url: "DAL/setInfoFlag?" + paramaters,
                    type: 'GET',
                    success: function(data) {
                        $("#status").modal("show");
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            });


            $.ajax({//sets unread messages as read on page load
                url: "DAL/setMessagesRead",
                type: 'GET',
                success: function(data) {
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        </script>
    @endif

    @if($role=='admin')
        <script type="text/javascript">
            $( "#sendMessage" ).click(function() {
                var paramaters = "message=" + $('#message').val() + "&subject=" + $('#subject').val();
                $.ajax({
                    url: "DAL/sendMessageAll?" + paramaters,
                    type: 'GET',
                    success: function(data) {
                        $("#status").modal("show");
                        $('#message').val("");
                        $('#subject').val("");
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            });
        </script>
    @endif

    <!-- Footer -->
    <footer style="width:100%;margin: 0 auto;padding:0;position: absolute;bottom: 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#about">Terms</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#services">Privacy</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#contact">Contact</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; Visualast 2017. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
@endsection
