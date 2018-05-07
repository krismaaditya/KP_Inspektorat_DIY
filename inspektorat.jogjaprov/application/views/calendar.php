<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/calendar.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url(); ?>js/ui/1.12.1/jquery-ui.js"></script>

  <body>
      <button id="prevM" type="button" name="prevMonth">Prev</button>
      <button id="nextM" type="button" name="nextMonth">Next</button>

    <div id="resultN">

    </div>
    <?php
      // Generate calendar
      echo $this->calendar->generate($year, $month);
    ?>
    <script>
        // $('#calendar').datepicker({
        //     inline: true,
        //     firstDay: 1,
        //     showOtherMonths: true,
        //     dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
        // });
        var baseurl = 'http://localhost/inspektorat.jogjaprov/calendar/index';

        $(document).ready(function(){
          $("#nextM").click(function(){
            $.get(baseurl, function(data, status){
              $('#resultN').html(<?php echo $this->calendar->generate($year, $month);?>)

          });
        });
      });

    </script>
  </body>
</html>
