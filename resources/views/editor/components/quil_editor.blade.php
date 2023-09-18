<!-- Main Quill library -->
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script src="/res/js/image-resize.min.js"></script>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">


<table width="100%" class="table-editor">
    <tr>
        <td>
            <div id="main-editor">
                {!! $publication->content !!}
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id soluta odio consequuntur nihil ex, laboriosam porro ab accusantium ullam incidunt error eos quia illum a nesciunt iste reprehenderit. Ducimus, labore?</p>
            </div>
        </td>

        <td width="30%">
            <label for="textTitle">Title:</label> <br>
            <input type="text" id="textTitle" name="textTitle" placeholder="Title" value="{{ $publication->title }}"> <br>
            <br>

            <label for="textSlug">Slug: (auto-generated)</label> <br>
            <input type="text" id="textSlug" name="textSlug" placeholder="Slug" value="{{ $publication->slug }}" readonly> <br>
            <br>

            <label for="textYear">Year:</label><br>
            <input type="text" id="textYear" name="textYear" placeholder="Year" value="{{ $publication->year }}"> <br>
            <br>

            <label for="textAuthors">Authors:</label><br>
            <input type="text" id="textAuthors" name="textAuthors" placeholder="Authors" value="{{ $publication->author_id[0] }}"> <br>
            <br>

            
            <label for="textDOI">DOI:</label><br>
            <input type="text" id="textDOI" name="textDOI" placeholder="DOI" value="{{ $publication->doi }}"> <br>
            <br>

            <label for="textTags">Tags:</label> <br>
            <textarea id="textTags" name="textTags" placeholder="Tags" rows="3" style="background: transparent;" value="{{ $publication->tags }}"></textarea> <br>
            <br>

            <label for="textDescription">Downloadable Resources: (.pdf, .doc, .docx)</label> <br>
            <input type="file" id="fileResources" name="fileResources" placeholder="Resources" multiple> <br>
            <br>

            <br>
            <button onclick="save()">Save</button>
        </td>
    </tr>
</table>

<script>
    var editor;

    document.addEventListener("DOMContentLoaded", function(){

        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons

            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent

            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'align': [] }],
            ['image'],

            ['clean']                                         // remove formatting button
        ];
        
        Quill.register("modules/ImageResize", ImageResize.default);

        editor = new Quill('#main-editor', {
            theme: 'snow',
            debug: 'log',
            modules:{
                toolbar: toolbarOptions,
                ImageResize: {
                    DisplaySize: true
                }
            }
        });
    });
</script>

<style>
    .table-editor td{
        padding: 0 1rem;
        vertical-align: top;
    }
    .ql-editor{
        min-height: 640px;
        font-family: 'Times New Roman', Times, serif;
    }
</style>