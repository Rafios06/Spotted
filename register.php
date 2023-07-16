<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted - Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <style>
        .hero {
            background-color: #F2F2F2;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo {
            max-width: 300px;
            margin-bottom: 1.5rem;
        }

        .input {
            border-radius: 4px;
        }

        .button {
            border-radius: 4px;
        }

        .forgot-password {
            font-size: 0.8rem;
            color: #999;
            margin: 1em;
        }

        hr.solid {
            border-top: 0.1em solid #E6E6E6;
            margin: 1em;
        }
    </style>
</head>

<body>
    <section class="hero is-fullheight-with-navbar">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered is-vcentered">
                    <div class="column is-5">
                        <img class="logo" src="res/svg/icon.svg">
                    </div>
                    <div class="column is-4 has-text-centered">
                        <div class="card">
                            <div class="card-content">

                                <form action="adduser.php" method="POST">
                                    <div class="field">
                                        <label class="label">Username</label>
                                        <div class="control">
                                            <input class="input" type="text" style="text-align: center;" name="uusername" id="uusername" placeholder="Username" required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Password</label>
                                        <div class="control">
                                            <input class="input" type="password" style="text-align: center;" name="upassword" id="upassword" placeholder="Password" required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label">Email</label>
                                        <div class="control">
                                            <input class="input" type="text" style="text-align: center;" name="uemail" id="uemail" placeholder="Email" required>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="control">
                                            <button class="button" type="submit" style="margin: 0.5em; font-weight: bolder; background-color: #26ADBB; color: white;">
                                                Create !
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>