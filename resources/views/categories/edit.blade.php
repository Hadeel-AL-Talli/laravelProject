@extends('layouts.dashboard')
@section('page-title' , 'Edit Category')
@section('content')
    

        <form action="/categories/ {{ $category->id }}" method="post">
            {{-- <input type="hidden" name="_method" value="put"> --}}
            @csrf
            @method('put')

     @include('categories._form')
        
    </form>
   @endsection