<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Spotted.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .hero {
            background-color: #fff;
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
        }
    </style>
</head>

<body>
    <section class="hero is-fullheight-with-navbar">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered is-vcentered">
                    <div class="column is-5">
                        <img class="logo" src="res/svg/logo_a.svg">
                    </div>
                    <div class="column is-4 has-text-centered">
                        <div class="card">
                            <div class="card-content">
                                <div class="field">
                                    <label class="label">Username</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Username">
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Password</label>
                                    <div class="control">
                                        <input class="input" type="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="field is-grouped is-flex">
                                    <div class="control is-justify-content-center">
                                        <button class="button is-primary" type="submit">
                                            Connexion
                                        </button>
                                    </div>
                                </div>
                                <p class="has-text-centered">
                                    <a class="forgot-password" href="#">Mot de passe oublié ?</a>
                                </p>
                                <div class="field is-grouped is-flex">
                                    <div class="control is-justify-content-center">
                                        <button class="button is-link" type="button">
                                            S'inscrire
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
