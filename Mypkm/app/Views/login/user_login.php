<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
        <div class="container mt-5 col-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    LOGIN TO MYPKM
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="inputUsername" class="form-label">
                            Username
                        </label>
                        <input type="text" name="user_name"
                        class="form-control" id="inputusername"
                        placeholder="Masukan Username">
                    </div>
                    <div class="mb-3">
                        <label for="inputuPassword" class="form-label">
                            Password
                        </label>
                        <input type="text" name="user_password"
                        class="form-control" id="inputPassword"
                        placeholder="Masukan Password">
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="login"
                         class="btn btn-primary" value="LOGIN" />
                    </div>
                </div>
            </div>
        </div>
</body>
</html>