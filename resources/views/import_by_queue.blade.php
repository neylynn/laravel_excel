<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
    <div class="container mx-auto border mt-4">
        <h1 class="text-2xl text-center"> Test Import With Queue</h1>
        <form action="{{route('importWithQueue.save')}}" method="post" enctype="multipart/form-data">
            @csrf 
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="flex flex-row">               

                
                    <div class="basis-1/2 border mx-auto my-4 flex flex-col "> 
                        <div class=" border m-2">
                            <label> Import file : </label> <br/>
                            <input name="importingFile"  type="file" class="file:border file:border-solid ..." />
                        </div>
                        <div class="border m-2 flex justify-center">
                            <button type="submit" class="rounded bg-blue-400 p-2"> Import </button>
                        </div>
                    </div>
                
            </div>
        </form>
    </div>
</body>
</html>
@vite('resources/js/app.js')