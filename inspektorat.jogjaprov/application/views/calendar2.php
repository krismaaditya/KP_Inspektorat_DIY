<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>DN Calendar</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/dncalendar-skin.css">
	</head>
	<body>

		<div id="dncalendar-container">

		</div>

		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/dncalendar.min.js"></script>

		<script type="text/javascript">
		$(document).ready(function() {
			var my_calendar = $("#dncalendar-container").dnCalendar({
				minDate: "2016-01-01",
				maxDate: "2020-12-02",
				monthNames: [ "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ],
				monthNamesShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des' ],
				dayNames: [ 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        dayNamesShort: [ 'Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab' ],

				dataTitles: { defaultDate: 'default', today : '' },
                // notes: [
                // 		{ "date": "2016-05-25", "note": ["Natal"] },
                // 		{ "date": "2016-05-12", "note": ["Tahun Baru"] },
								// 		{ "date": "2018-05-14", "note": ["Perobohan gedung inspektorat"] },
								// 		{ "date": "2018-05-15", "note": ["Pembongkaran septitank wc inspektorat"] },
								// 		{ "date": "2018-05-16", "note": ["Bagi bagi duit"] }
                // 		],

								notes: [
									<?php if (count($agenda)): ?>
										<?php foreach($agenda as $row):?>
										{
											"date": "<?php echo $row->tanggal ?>", "note": ["<?php echo $row->judul_agenda ?>"]
										},
										<?php endforeach; ?>
									<?php endif ?>
                		],

                showNotes: true,
                startWeek: 'monday',
                dayClick: function(date, view) {
                	alert(date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear());
                }
			});

			// init calendar
			my_calendar.build();

			// update calendar
			// my_calendar.update({
			// 	minDate: "2016-01-05",
			// 	defaultDate: "2016-05-04"
			// });
		});
		</script>
	</body>
</html>
