@extends('layout.master')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form-container input[type="text"],
        .form-container textarea,
        .form-container input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container button {
            padding: 10px 15px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>EDIT Post</h2>
        <div>
            @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                    <li> {{$error}}  </li>
                    @endforeach

                </ul>
            </div>
            @endif
        </div>

        <div>
            @if(session()->has('flash_message'))
            <div>
                <ul>
                    
                    <li> {{session()->get('flash_message')}}  </li>
                    

                </ul>
            </div>
            @endif
        </div>



        <form action="{{ route('update', $post->id) }}" method="post" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <label for="name">Post Name:</label>
            <input type="text" id="name" name="name" value="{{$post['name']}}" required>
            <input type="hidden"  name="id" value="{{$post->id}}" >

            
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="6" required>{{$post->content}}</textarea>
            
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" >
             <img src="{{asset('images/'.$post->image)}}" alt="post Image" style="max-width: 200px; max-height: 200px;">
            
            <button type="submit">Submit Post</button>
        </form>
    </div>
</body>
</html>





@endsection