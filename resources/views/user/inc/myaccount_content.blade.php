{{-- Used by user.myaccount.blade.php --}}
<table width="100%">
    <tbody>
        <tr>
            <td width="30%" style="border-right:1px solid #dcdcdc; padding:0 1.5rem;">
                <h4>Auther Details</h4>
                <table width="100%" style="text-align: left;">
                    <tr>
                        <th>First Name</th>
                        <td>{{ auth()->user()->first_name }}</td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>{{ auth()->user()->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Account Type</th>
                        <td><strong>{{ auth()->user()->GetAccountType() }} Account</strong></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ auth()->user()->email }} {{ (auth()->user()->is_email_verified)?'(verified)':'' }}</td>
                    </tr>
                    <tr>
                        <th>Bio</th>
                        <td>{{ auth()->user()->bio }}</td>
                    </tr>
                    <tr>
                        <th>Bio</th>
                        <td>{{ auth()->user()->occupation }}</td>
                    </tr>
                    <tr>
                        <th>Total publications</th>
                        <td>{{ count($publications) }}</td>
                    </tr>
                </table>
                
            </td>
            <td style="vertical-align:top; padding:0 1.5rem;" >
                @if ( auth()->user()->hasPermissions(auth()->user()::TASK_EDIT_PUBLICATIONS))
                <div style="display: flex; gap:3rem; align-items:center;">
                    <h3>Publications</h3>
                    <div><a href="{{url('/user/editor')}}">Add Publication</a></div>
                </div>

                <table width="100%" style="text-align: left;" class="result-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Uploaded Date</th>
                            <th width="15%"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($publications as $publication)
                        <tr>
                            <td><a href="{{url('/publication/' . $publication->slug)}}">{{ $publication->title }}</a></td>
                            <td>{{ $publication->created_at }}</td>
                            <td>
                                <center>
                                    <a href="{{url('/user/editor/' . $publication->slug)}}">EDIT</a>
                                </center>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>

                
                <style>
                    .result-table th{
                        border-left: 1px solid #dcdcdc;
                        background-color: #f2f2f2;
                        border-bottom: 1px solid #dcdcdc;
                    }
                    .result-table th:last-child{
                        border-right: 1px solid #dcdcdc;
                    }
                    .result-table td, .result-table th{
                        padding: 16px 8px;
                    }

                    .result-table tbody tr:nth-child(even){
                        background-color: #f2f2f2;
                    }
                    /*Dark mode*/
                    @media (prefers-color-scheme: dark) {
                        .result-table th{
                            background-color: #292929;
                        }
                        .result-table tbody tr:nth-child(even){
                            background-color: #292929;
                        }
                    }

                </style>
                @endif
            </td>
        </tr>
    </tbody>
</table>