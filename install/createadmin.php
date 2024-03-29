<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome Spotted - Add user</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>

<body>
  <section class="section">
    <div class="container">
      <h1 class="title">
        Welcome to Spotted.
      </h1>
      <p class="subtitle">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      </p>

      <div class="card">
        <div class="card-content">
          <div class="content">
            Create Admin user
            <form action="addadmin.php" method="POST">
              <div class="field"><br>
                <label class="label">Username</label>
                <div class="control">
                  <input class="input" type="text" name="user" id="user" placeholder="">
                </div>
              </div>
              <div class="field">
                <label class="label">Password</label>
                <div class="control">
                  <input class="input" type="password" name="password" id="password" placeholder="">
                </div>
              </div>
              <div class="field">
                <label class="label">Email</label>
                <div class="control">
                  <input class="input" type="text" name="email" id="email" placeholder="">
                </div>
              </div>
              <div class="control">
                <button class="button is-link">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>

  </section>

</body>

</html>