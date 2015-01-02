<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>                
        <meta charset="utf-8">        
        <title> Php AJAX | Formulario de Contacto</title>
        <meta name="description" content="Formulario de ejemplo con Ajax jQuery y PHP">
        <meta name="keywords" content="desarrollo, programacion, web, app, santiago ">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- favicon -->  
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <!-- Google fonts -->
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900%7CMerriweather:400,400italic,300,300italic,700,700italic' rel='stylesheet' type='text/css'>
        <!-- Font icons -->
        <link rel="stylesheet" href="css/vendor/elegant-font-icon.css">

        <!-- stylesheet -->
        <link rel="stylesheet" href="css/vendor/bootstrap.css">        
        <link rel="stylesheet" href="css/style.css">

        <script type="text/javascript" src="js/vendor/jquery-1.11.0.min.js"></script>
    </head>    
  <body>
       <!-- <div id="main-wrapper">--> 
       <div>

        <div class="navmenu-open">
          <a href="javascript:void(0);" id="trigger-navbar">
            <span class="icon_menu"></span>
          </a>        
        </div>
        <!-- contact -->
        <section id="contact" class="row section">
          <div class="container">

            <div class="row">            
              <fieldset id="contact_form" class="bounce">                
                <div id="form_result" class="row"></div>
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <input name="name" type="text" id="name" class="form-control" placeholder="Nombre">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <input name="email" type="text" id="email" class="form-control" value="" placeholder="Correo Electrónico">
                  </div>                
                </div>
                <div class="row">         
                  <div class="col-md-6 col-md-offset-3">
                    <textarea name="message" cols="40" rows="5" id="comments" class="form-control" placeholder="Tu Mensaje o Consulta"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-center">                    
                      <button type="submit" class="btn btn-black btn-lg" id="submit">ENVIAR</button>

                  </div>
                </div>
              </fieldset>
              <!-- </form> -->
            </div>
          </div>
        </section>
        <!-- /contact -->
        <!-- list -->
        <section id="list" class="row section">
          <div class="container">

            <div class="row">
              <div class="col-md-6 col-md-offset-3">      
                <table class="table table-condensed" id="list-table">
                  <input type="text" id="search" placeholder="Busca un mensaje" style="color:black">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Mensaje</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        </tr>
                      </tbody>
                    </table>
                <!-- </form> -->
                </div>
            </div>
          </div>
        </section>

        <!-- google map -->
        <section id="google-map" class="row section">
          <div id="map"></div>
        </section> 
        <!-- /google-map -->

        <!-- footer -->
        <footer id="footer">
          <div class="container">
            <div class="row">
              <div class="move-up"><a class="arrow_carrot-2up" target="_blank" href="http://www.zetabyte.cl"></a></div>
              <div class="footer-logo"><h3>ZetaByte Chile</h3></div>
              <div class="footer-text">Copyright © 2014 <a>Desarrollado y Diseñado por Sebastián Schuchhardt</a>. <span class="icon_heart_alt"></span></div>
            </div>
          </div>
        </footer>
        <!-- /footer -->
    <section id="navbar" class="navbar navbar-hugeinc">      
      <header>        
        <a href="javascript:void(0);" id="navbar-close" class="navbar-close">
        <span class="icon_close"></span></a>   
        <div class="nav-logo">          
          <h1 class="logo"><img src="images/ashoka-logo-med.png" alt="logo"/></h1>          
        </div>
      </header>
      <nav>
        <ul>          
          <li>
            <a id="go-contact">
              <span class="primary">Contacto</span>
              <span class="secondary">Mándanos un mensaje</span>
              <div class="heading-sep"></div>
            </a>
          </li>          
          <li>
            <a id="go-list">
              <span class="primary">Lista</span>
              <span class="secondary">Ver la Lista de Mensajes</span>              
            </a>
          </li>
        </ul>
      </nav>


  </div>
  <!-- /wrapper -->

      <!-- Scripts -->
      <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>

      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc"></script>
      <script type="text/javascript" src="js/script.js"></script>
      
      
    </body>
</html>