<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>edit
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
</head>

<body>
    <div class="container">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">Todolist</h1>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light" method="post"
                    action="/todolist/{{ $todo->id }}/edit">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="todo" placeholder="todo"
                            value="{{ $todo->todo }}">
                        <label for="todo">Apa yang ingin anda kerjakan?</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>