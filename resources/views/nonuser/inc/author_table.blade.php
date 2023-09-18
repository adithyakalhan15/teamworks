{{-- Used by nonuser.author.blade.php --}}
<table width="100%">
    <tbody>
        <tr>
            <td width="30%" style="border-right:1px solid #dcdcdc; padding:0 1.5rem;">
                <h4>Auther Details</h4>
                <table width="100%" style="text-align: left;">
                    <tr>
                        <th>Name</th>
                        <td>{{ $author->GetFullName() }}</td>
                    </tr>
                    <tr>
                        <th>Bio</th>
                        <td>{{ $author->bio }}</td>
                    </tr>
                    <tr>
                        <th>Total publications</th>
                        <td>{{ count($publications) }}</td>
                    </tr>
                </table>
                
            </td>
            <td style="vertical-align:top; padding:0 1.5rem;" >
                <h4>Publications</h4>
                <ul>
                    @foreach ($publications as $publication)
                        <li>
                            <a href="{{url('/publication/' . $publication->slug)}}">{{ $publication->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </td>
        </tr>
    </tbody>
</table>