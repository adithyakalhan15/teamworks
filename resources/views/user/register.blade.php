
@extends('template')
{{--
@php
    $title = $author->GetNameWithInitials();    
@endphp
--}}
@section('main_content')
    <center>
        <h3>Register</h3>
    </center>

    <form action="/user/register" method="post">
        @csrf

        <table width="100%" class="regiter-table">
            <tr>
                <td width="33%">
                    <h4>Select Account Type</h4>

                    <input type="radio" name="accountType" id="accountTypeUser" value="user" checked>
                    <label for="accountTypeUser">User Account</label> <br>
                    <small>With a user account you can access to our resources, read and download.</small>

                    <br>
                    <br>
                    <input type="radio" name="accountType" id="accountTypeAuthor" value="author">
                    <label for="accountTypeAuthor">Author Account</label> <br>
                    <small>With an author account you can publish your own research papers. (Need administrator approval)</small>

                </td>
                <td width="33%">
                    <h4>Basic Account Details</h4>
                    <table width="100%">
                        <tr>
                            <td>
                                <label for="firstName">First Name:</label><br>
                                <input type="text" id="firstName" name="firstName" placeholder="First Name"> <br>
                            </td>
                            <td>
                                <label for="lastName">Last Name:</label><br>
                                <input type="text" id="lastName" name="lastName" placeholder="Last Name"> <br>
                            </td>
                        </tr>
                    </table>
                    <br>

                    <!--email-->
                    <label for="email">Email:</label><br>
                    <input type="text" id="email" name="email" placeholder="Email"> <br>
                    <br>

                    <!--password-->
                    <label for="password">Password:</label><br>
                    <input type="password" id="password" name="password" placeholder="Password" autocomplete="new-password"> <br>
                    <br>

                    <!--confirm password-->
                    <label for="confirmPassword">Confirm Password:</label><br>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password"> <br>
                    <br>
                    
                </td>
                <td width="33%">
                    <h4>Author Account Details (Only for author accounts)</h4>
                    <!--University/school-->
                    <label for="university">University/School:</label><br>
                    <input type="text" id="university" name="university" placeholder="University/School"> <br>
                    <br>

                    <!--Department-->
                    <label for="department">Department:</label><br>
                    <input type="text" id="department" name="department" placeholder="Department"> <br>
                    <br>

                    <!-- educational status : undergraduate|postgraduate|PhD|... -->
                    <label for="educationalStatus">Educational Status:</label><br>
                    <select name="educationalStatus" id="educationalStatus">
                        <option value="undergraduate">Undergraduate</option>
                        <option value="postgraduate">Postgraduate</option>
                        <option value="PhD">PhD</option>
                        <option value="other">Other</option>
                    </select>
                    <br>


                </td>
            </tr>
        </table>

        <br>
        <br>
        <br>

        <center>
            <button type="submit">REGISTER</button>
        </center>
    </form>

    <style>
        .regiter-table tr td:not(.regiter-table table td){
            vertical-align: top;
            padding: 0 2rem;
        }
    </style>
@endsection
