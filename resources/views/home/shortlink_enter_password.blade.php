@extends('layouts.layoutmain')
@section('content')
<style>
    input{
        height: 40px; 
        padding: 0 10px;
        border-radius: 5px;
        border: 1px solid var(--bs-dark);            
    }
    .error{
        color: red;
    }
    button{
        height: 40px; 
        margin-top: -5px; 
    }
    .thank-you{
        margin-top:30px; 
    }
</style>
<div class="container">
    <div style="margin-top:30px ">
        <center><h2>Enter password</h2></center><br>
        <center>
            <form method="post">
                @csrf
                <input type="password" name="password" class="w-50">
                <button type="submit" class="btn btn-warning">Confirm</button>
            </form>
            <p class="error">{{$error ?? ""}}</p>
        </center>

        <center id="thank-you">Thank you for using our service!!!</center>
    </div>
</div>
@endsection