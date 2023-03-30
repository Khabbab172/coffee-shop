<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Details</title>
</head>
<body>
    <h1>
        Congratulations you are now our customer!
    </h1>

    <table>
        <thead>
            <tr>
                <th>email</th>
                <th>password</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$data['email']}}</td>
                <td>{{$data['password']}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>