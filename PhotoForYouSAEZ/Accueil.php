<?php
    setcookie('last_visit', date("F j/Y à H:i:s", time())); //la création du cookie
?>
<!doctype html>
<html>
  <head>
    <title>PhotoForYou</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Liaison au fichier css de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  </head>

  <body>
  <header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="FormAjoutPompier.php" class="nav-link px-2 text-white">Photo</a></li>
          <li><a href="FormAjoutTypeEngin" class="nav-link px-2 text-white">Tarifs</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Recherche..." aria-label="Search">
        </form>

        <div class="text-end">
          <button type="button" class="btn btn-outline-light me-2">Se connecter</button>
          <button type="button" class="btn btn-warning">S'inscrire</button>
        </div>
      </div>
    </div>
  </header>
    <main role="main">
      <section class="jumbotron text-center">
        <div class="container">
        <div class="col-10 col-md-1">
        <img src="image/logo1.jpg" class="img-thumbnail" alt="LogoPhotoForYou">
			</div>
          <h1 class="jumbotron-heading">PhotoForYou</h1>
          <h2 class="jumbotron-heading">Accueil</h2>
          <p class="lead text-muted">Des pros au service des professionnels de la communication.</p>
        </div>
      </section>
    </main>



    <script>
     (function() {
        "use strict"
        window.addEventListener("load", function() {
          var form = document.getElementById("form")
          form.addEventListener("submit", function(event) {
            if (form.checkValidity() == false) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add("was-validated")
          }, false)
        }, false)

      }())

      function actuPhoto(element)
      {
        var image=document.getElementById("image");
        var fReader = new FileReader();
        fReader.readAsDataURL(image.files[0]);
        fReader.onloadend = function(event)
        {
          var img = document.getElementById("photo");
          img.src = event.target.result;
        }
      }
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
  </body>
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
          <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
            <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
          </a>
          <span class="mb-3 mb-md-0 text-muted">© 2022 Company, Inc</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
          <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
          <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
          <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
        </ul>
            <?php
            if(isset($_COOKIE["last_visit"]))
            {
                echo 'Derni&#232re visite : '; // &#232 = "è"
                echo $_COOKIE['last_visit'];
            }
            else
            {
                echo "C'est la première fois que vous visitez cette page";
            }
          ?>
      </footer>
</html>