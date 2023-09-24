<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Backend Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <style>
        .rounded-t-5 {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        @media (min-width: 992px) {
            .rounded-tr-lg-0 {
                border-top-right-radius: 0;
            }

            .rounded-bl-lg-5 {
                border-bottom-left-radius: 0.5rem;
            }
        }
    </style>

</head>

<body style="position: relative;">
    <!-- Section: Design Block -->
    <h3 class="m-0 text-center my-5">Welcome To Login Page</h3>
    <section class="text-center text-lg-start position-fixed w-100 d-flex align-items-center justify-content-center">
        <div class="card mb-3 w-50">
            <div class="row g-0 d-flex align-items-center">
                <div class="col-lg-5 d-none d-lg-flex justify-content-center align-items-center gap-2" style="flex-direction: column;margin-top:-85px;">
                    <div style="width: 180px;height:60px;">
                        <img style="width: 180px;height:60px;" src="{{asset($profile->logo != null ? $profile->logo: 'noImage.jpg')}}" alt="Water Market BD"/>
                    </div>
                    <div>
                        <a href="{{route('website')}}">
                            <h4 class="m-0">{{$profile->company_name}}</h4>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card-body py-5 px-md-5">

                        <form onsubmit="AdminLogin(event)">
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="username" id="form2Example1" class="form-control" autocomplete="off"/>
                                <label class="form-label error-username" for="form2Example1">Username or Email Address</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" name="password" id="form2Example2" class="form-control" autocomplete="off"/>
                                <label class="form-label error-password" for="form2Example2">Password</label>
                            </div>

                            <!-- 2 column grid layout for inline styling -->
                            <div class="row mb-4">
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
    </section>
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