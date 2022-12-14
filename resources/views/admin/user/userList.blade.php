@extends('layouts.admin')
@section('title','liste des utilisateurs')
@section('content')
    {{$users->links()}}

    @if (session('delete'))
        <div class="alert alert-success">
            {{session('delete')}}
        </div>  
    @endif

    @if (session('update'))
        <div class="alert alert-success">
            {{session('update')}}
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-success">
            {{session('error')}}
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    <form class="d-flex mb-3 w-50" role="search" action="{{route('users.search')}}" method="GET">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q" value="{{request()->q ?? ''}}">
        <button class="btn btn-outline-success" type="submit" >
          <i class="bi bi-search"></i>
        </button>
    </form>

    <table class="table table-bordered border-primary">
        <thead>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>email</th>
                <th>role</th>
                <th>contact</th>
                <th>creation date</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->contact}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        <a href="#" style="text-decoration: none">
                            <i class="bi bi-pencil-square px-1"></i>
                        </a>
                        <a href="#" onclick="if(confirm('??tes-vous s??r de vouloir supprimer cet utilisateur?')){document.getElementById('delete-{{$user->id}}').submit()}" style="text-decoration: none">
                            <i class="bi bi-trash px-1"></i>
                        </a>
                        <a href="{{route('users.view',['id'=>$user->id])}}" style="text-decoration: none">
                            <i class="bi bi-eye"></i>
                        </a>

                        <form id="delete-{{$user->id}}" action="{{route('users.destroy',['user'=>$user->id])}}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr> 
            @endforeach            
        </tbody>
    </table>
    {{$users->links()}}
@endsection