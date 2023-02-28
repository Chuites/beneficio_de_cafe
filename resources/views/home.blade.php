@extends('layouts.app')

@section('content')
<style>
    body{
        background-image: url('https://thumbs.dreamstime.com/b/granos-de-caf%C3%A9-asados-fondo-vertical-32486740.jpg');
        background-repeat: repeat;
        background-attachment: fixed;
    }
    #titulo{
        font-family: sans-serif;
        font-size: 30px;
        color: #772626;
        margin: auto;
        text-align: center;
    }
    #test{
        background-color: #5f361a;
        padding: 2%;
        border-radius: 15px;
        color: #ffffff;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card" id="titulo">
                Beneficio de cafe: CAFETITO
            </div>
        </div>
    </div>
    <br>
        <form id="test">
            <div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect2">Example multiple select</label>
                <select multiple class="form-control" id="exampleFormControlSelect2">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
        </form>
</div>
@endsection
