<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$profile->company_name}}-Admin Login Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <style>
        body {
            position: relative;
            background: url(/backend/loginbg.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            width: 100%;
            height: 100vh;
        }

        .card {
            width: 600px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .card h3{
            font-weight: 800;
        }

        .card-body .col-md-5 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: -75px;
        }

        @media (min-width: 300px) and (max-width: 600px) {
            .card{
                width: 80% !important;
            }
            .card-body{
                padding-top: 0 !important;
            }
            .card-body .col-md-5 {
                margin-top: 0;
                margin-bottom: 5px !important;
            }

            .card h3 {
                font-size: 15px !important;
            }
            .card h4 {
                font-size: 15px !important;
            }

            .card img {
                width: 60px !important;
                height: 40px !important;
            }
        }
    </style>

</head>

<body>
    <div class="card">
        <div class="card-header">
            <h3 class="m-0 text-center">Admin Login Page</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <img style="width: 180px;height:60px;" src="{{asset($profile->logo != null ? $profile->logo: 'noImage.jpg')}}" alt="Water Market BD" />
                    <a href="{{route('website')}}">
                        <h4 class="m-0">{{$profile->company_name}}</h4>
                    </a>
                </div>
                <div class="col-md-7 pe-4">
                    <form onsubmit="AdminLogin(event)">
                        <!-- Email input -->
                        <div class="form-outline mb-md-4 mb-3">
                            <input type="text" name="username" id="form2Example1" class="form-control" autocomplete="off" />
                            <label class="form-label error-username" for="form2Example1">Username or Email Address</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-md-4 mb-3">
                            <input type="password" name="password" id="form2Example2" class="form-control" autocomplete="off" />
                            <label class="form-label error-password" for="form2Example2">Password</label>
                        </div>

                        <!-- 2 column grid layout for inline styling -->
                        <div class="row mb-md-4 mb-3">
                            <div class="col d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="form2Example31" />
                                    <label class="form-check-label" for="form2Example31"> Remember me </label>
                                </div>
                            </div>
                        </div>
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Section: Design Block -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function AdminLogin(event) {
            event.preventDefault();
            let formdata = new FormData(event.target)
            $.ajax({
                url: location.origin + "/admin",
                method: "POST",
                data: formdata,
                dataType: "JSON",
                processData: false,
                contentType: false,
                beforeSend: () => {
                    $(".error-username").text("Username or Email Address").removeClass("text-danger");
                    $(".error-password").text("Password").removeClass("text-danger");
                },
                success: res => {
                    if (!res.error) {
                        if (res.errors) {
                            $(".error-username").text(res.errors).addClass("text-danger");
                        } else {
                            location.href = "/admin/dashboard";
                        }
                    } else {
                        $.each(res.error, (index, value) => {
                            $(".error-" + index).text(value).addClass("text-danger");
                        })
                    }
                }
            })
        }
    </script>

</body>

</html>