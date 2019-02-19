<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->

    </head>
    <body>
     
      
  <h1 style="text-align: center;">Post List</h1>
<table border="1" cellpadding="3" width="100%" style="text-align: center;" cellspacing="0"> 
  <thead>
    <tr>
      <th>Serial</th>
      <th>Title</th>
      
      <th>Author Name</th>
      <th>Created at</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $key => $post)
      <tr>
        <td>{{$key + 1}}</td>
        <td>{{$post->title}}</td>
        
        <td>{{$post->user->name}}</td>
        <td>{{$post->created_at->toFormattedDateString()}}</td>
      </tr>
 @endforeach
     
   
  </tbody>
</table>
   
    </body>
</html>
