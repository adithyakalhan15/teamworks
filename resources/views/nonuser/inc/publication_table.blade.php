{{-- Used by nonuser.publication.blade.php --}}
<table width="100%">
    <tbody>
        <tr>
            <td style="border-right:1px solid #dcdcdc; padding:0 1.5rem;">{!! $publication->content  !!}</td>
            <td width="30%" style="vertical-align:top; padding:0 1.5rem;">
                <h4>Auther Details</h4>
                <div style="padding-left: 2rem">
                    <table width="100%">
                        <tr>
                            <td>Published By</td>
                            <td>{{ $publication->owner->first_name . " " . $publication->owner->last_name[0] . "."  }}</td>
                        </tr>
                        <tr>
                            <td>Authors</td>
                            
                            <td>
                            @foreach ($publication->Getauthors() as $author)
                                <a href="{{url('/author/' . $author->_id)}}">{{ $author->GetNameWithInitials() }}</a>
                                
                                @if (!$loop->last)
                                    ,&nbsp;&nbsp;
                                @endif
                            @endforeach
                            </td>
                            
                        </tr>

                        <tr>
                            <td>Published Date</td>
                            <td>{{ explode(' ', $publication->created_at)[0] }}</td>
                        </tr>

                    </table>
                </div>

                <br>
                <br>
                <br>

                @if (count($publication->download_resources) > 0)
                    @foreach ($publication->download_resources as $download)
                        <div>
                            <a href="{{ asset("/storage/downloadables/$download") }}" target="_blank">Download {{$loop->index + 1}}</a>
                        </div>
                    @endforeach
                @endif
            </td>
        </tr>
    </tbody>
</table>