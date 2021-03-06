<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>YUMdeals - List</title>
    <link href="https://fonts.googleapis.com/css?family=Rammetto+One|Yanone+Kaffeesatz:700" rel="stylesheet">
    <link rel="stylesheet" href="css/foundation.css">
    
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/list.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/loginmenu.css">
      <!-- Font Awesome Icons --> 
    <script src="https://use.fontawesome.com/5512aa1683.js"></script>
        <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- JQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/index.js"></script>
      <script src="js/list.js"></script>
      <script src="js/style.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  </head>
<header class="header">
        <div>
            <a href="index.html"><h1 id='heading1'>YUM</h1><h1 id='heading2'>deal</h1></a>
       </div>
         <ul class="topnav" id ="myTopnav">
            <li class='head'><a>|</a><a href="http://www.twitter.com" target="_blank" id="socialGap" title='Twitter'><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="http://www.facebook.com" target="_blank" id="socialGap" title='Facebook'><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="http://www.instagram.com" id="socialGap" title='Instagram'><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </li>
            <li class='head'>
                <nav>
                  <ul>
                    <li id="login">
                      <a id="login-trigger" href="#">
                        Log in
                      </a>
                      <div id="login-content">
                        <form action="login.php" method="post">
                          <fieldset id="inputs">
                            <input id="user_name" type="text" name="user_name" placeholder="Your username" required>
                            <input id="password" type="password" name="password" placeholder="Password" required>
                          </fieldset>
                          <fieldset id="actions">
                            <input type="submit" id="submit" class='button' value="Submit">
                          </fieldset>
                        </form>
                      </div>                     
                    </li>
                  </ul>
                </nav>
             </li>            
             <li class='head'><a href="about.html" id="colorChange">About Us</a></li>  
        </ul>
    </header>
  <body>
<div class="maptop row">
    <div class="small-12 large-8 small-centered columns search">
        <span>
      <input class='mainsearch' id="address" type="textbox" style="width:400px;"/>
      <input id="searchAddress" type="button" value="Search for address"/>
        </span>
      <div class="columns"><p id="searchHideShow">Show advanced search</p></div>

            <section class="sectionBorder" id="advancedSearch">
            <div>
            <label class='advanced' for="radius">Radius:
            <select id="radius" name="radius" form="search">
                <option value="5" selected>5 km</option>
                <option value="25">25 km</option>
                <option value="50">50 km</option>
            </select>
            </label>
            </div>
            <div>
            <label class='advanced' for="restaurant-type">Establishment type:
            <input id='bar' type="checkbox" name='bar'> Bar
            <input id='restaurant' type="checkbox" name='restaurant'> Restaurant
            <input id='cafe' type="checkbox" name='cafe'> Cafe
            </label>
            </div>
            <div>
            <label class='advanced' for="date">Date<input type="date" name="date" id="date"/></label>
            </div>
            </section>
      </div>
      </div>

    <table class = "list-table"onload="getParams()">
      <thead>
        <tr>
          <th width="200">Place</th>
          <th>Deal</th>
          <th width="150">Location</th>
          <th width="150">Type</th>
        </tr>
      </thead>
      <tbody id="list"></tbody>
    </table>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRRY9GzkL0XCgOBE09OoXDLAoog1MDAa8&callback=initialise">
    </script>
  </body>


<script lang="javascript">
function getParams() {
    var idx = document.URL.indexOf('?');
    var params = new Array();
    if (idx != -1) {
        var pairs = document.URL.substring(idx + 1, document.URL.length).split('&');
        for (var i = 0; i < pairs.length; i++) {
            nameVal = pairs[i].split('=');
            params[nameVal[0]] = nameVal[1];
        }
    }
    return params;
}
params = getParams();
address = unescape(params["address"]);
radius = unescape(params["radius"]);
document.getElementById('address').value = address.replace(/\+/g,' ');
//document.getElementById('radius').value = radius;
</script>
</html>