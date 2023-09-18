<form action="/search" method="get">
    <label for="textSearch">Search:</label> <br>
    <input type="text" name="s" id="textSearch" value="{{ request()->has('s')?request()->get('s'):'' }}" placeholder="Search" required> 
    <button type="submit">Search</button>

    <span>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <input type="checkbox" name="advanced_search" value="yes" id="advanced_search" {{ (request()->has('advanced_search') && request()->get('advanced_search') == 'yes')?'checked':'' }}>
        <label for="advanced_search">Advanced Search</label>
    </span>

    <span style="border:1px solid #dcdcdc; padding:0.75rem 2.5rem; margin-left:2rem;">
        <span>Search By: </span>
        &nbsp;
        <input type="radio" name="search_by" value="default" id="search_by_default" {{ ((!request()->has('search_by') || request()->get('search_by') == 'default')?'checked':'')}}>
        <label for="search_by_default">Default</label>
        &nbsp;
        &nbsp;
        <input type="radio" name="search_by" value="author" id="search_by_author" {{ ((request()->has('search_by') && request()->get('search_by') == 'author')?'checked':'')}}>
        <label for="search_by_author">Author</label>
        &nbsp;
        &nbsp;

        <input type="radio" name="search_by" id="search_by_doi" value="doi" {{ ((request()->has('search_by') && request()->get('search_by') == 'doi')?'checked':'')}}>
        <label for="search_by_doi">DOI</label>
        &nbsp;
        &nbsp;

    </span>
</form>
<br>

<hr>

<br>
<br>