<table width="100%" class="result-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Authors</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($publications as $pub)
        <tr>
            <td><a href="{{ url("/publication/$pub->slug")}}" >{{ $pub->title }}</a></td>
            <td>{{ $pub->owner->first_name. " " . $pub->owner->last_name }}</td>
            <td>{{ $pub->created_at }}</td>
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