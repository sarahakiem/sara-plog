@extends('layout.master')

@section('content')

<!DOCTYPE html>
<html lang="{{LaravelLocalization::getCurrentLocale()}}" dir="{{ 
    LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('posts.addHeading')}}</title>
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
        <a href="{{ LaravelLocalization::getLocalizedURL('en') }}">English</a>
        <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}">Arabic</a>

        <h2>{{__('posts.add_new')}}</h2>
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



        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="post_name">{{ __('posts.post_name') }}:</label>
        <input type="text" id="post_name" name="post_name" value="{{ old('post_name') }}" placeholder="{{ __('posts.post_name') }}:">
        @error('post_name')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="content">{{ __('posts.content') }}:</label>
        <textarea id="content" name="content" placeholder="{{ __('posts.content') }}:">{{ old('content') }}</textarea>
        @error('content')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="image">{{ __('posts.image') }}:</label>
        <input type="file" id="image" name="image" placeholder="{{ __('posts.image') }}:">
        @error('image')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">{{ __('posts.Add New Post') }}</button>
</form>

    </div>
</body>
</html>





@endsection