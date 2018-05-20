<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <title></title>
  </head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/home-footer.css">
  <body>
    <footer>
      <div class="footer-left">
        <h3>KONTAK KAMI</h3>
        <img class="icon-footer-left" src="<?php echo base_url(); ?>assets/icons/utilities icons/map-pin-marked.png">
        <p class="p-left">Alamat : Jl. Cendana No.40, Semaki, Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55166</p>


        <img class="icon-footer-left" src="<?php echo base_url(); ?>assets/icons/utilities icons/phone-symbol-of-an-auricular-inside-a-circle.png">
        <p class="p-left">Phone : +62 </p>

        <img class="icon-footer-left" src="<?php echo base_url(); ?>assets/icons/utilities icons/mail.png">
        <p class="p-left">Email : inspektorat@jogjaprov.go.id</p>
      </div>
      <div id="googleMap"></div>
      <!-- <span class="footer_detail"></span> -->
      <div class="footer-right">
        <h3>SOSIAL MEDIA</h3>
        <a href="https://www.facebook.com" target="_blank"><img class="sm-icon-link" src="<?php echo base_url(); ?>assets/icons/social media/facebook-logo-circle.png" alt=""></a>
        <a href="https://www.twitter.com" target="_blank"><img class="sm-icon-link" src="<?php echo base_url(); ?>assets/icons/social media/twitter-logo-circle.png" alt=""></a>
      </div>

      <div class="footer-bottom">
          <p>Copyrights &copy; 2018 Inspektorat Daerah Istimewa Yogyakarta</p>
      </div>
    </footer>
    <script>
    function myMap() {
    var uluru = {lat: -7.798848, lng: 110.384798};
    var mapProp= {
        center:new google.maps.LatLng(-7.798848, 110.384798),
        zoom:18,

    };
    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
    }
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzLHQdNNOD661opWjOOXBVVw4Nk9_Qt64&callback=myMap"></script>
  </body>
</html>
