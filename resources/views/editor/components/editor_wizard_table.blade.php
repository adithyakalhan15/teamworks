<table width="100%">
    <tr>
        <td width="20%"></td>
        <td width="60%">
            <center>
                <h3>Select the method.</h3>
            </center>
            <br>
            <br>
            <br>
            <form action="{{ url('/user/editor/wizard/') }}" method="post">
                @csrf
                <table width="100%">
                    <tr>
                        <td width="33%">
                            <center>
                                <input type="radio" name="creation_method" id="creation_method_from_editor" value="scratch" checked>
                            </center>
                            <label for="creation_method_from_editor">
                                <center>
                                    <h4>Use the Editor</h4>

                                    <p>Use or editor directly.</p>
                                </center>

                            </label>
                        </td>

                        <td width="33%">
                            <center>
                                <input type="radio" name="creation_method" id="creation_method_from_pdf" value="pdf">
                            </center>
                            <label for="creation_method_from_pdf">
                                <center>
                                    <h4>From PDF File</h4>

                                    <p>Upload a pdf file to <br> create a new publication.</p>
                                </center>

                            </label>
                        </td>
                        <td width="33%">
                            <center>
                                <input type="radio" name="creation_method" id="creation_method_from_docx" value="word">
                            </center>
                            <label for="creation_method_from_docx">
                                <center>
                                    <h4>From Word File</h4>

                                    <p>Upload a word file (.doc or .docx) to <br> create a new publication.</p>
                                </center>

                            </label>
                        </td>
                        
                    </tr>
                </table>
                <br>
                <br>
                <center>
                    <label for="file_upload">Upload the file here:</label> &nbsp; &nbsp; &nbsp;
                    <input type="file" name="file" id="file_upload"><br><br>
                    <button type="submit">NEXT</button>
                </center>
            </form>
        </td>
        <td width="20%"></td>
    </tr>
</table>