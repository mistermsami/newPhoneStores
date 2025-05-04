<!DOCTYPE html>
<html>

<head>
    <title>How to Send SMS Using Laravel 9 - webjourny.dev</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container text-center mt-5">
        <h2>How to Send SMS Using Laravel 9</h2>
        <hr style="color:#ff0000;height:5px;">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{ route('send.sms') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="number" placeholder="Recipient's Phone Number"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-dark" type="submit">Send SMS</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
