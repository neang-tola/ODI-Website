<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>New Training Course alert from ODI Asia</title>
	</head>
	<body>
	<p style="font-family: Cambria, Georgia, serif; font-size: 16px color: #333;"><strong>Dear {{ $receiver_name }}</strong></p>
	<p style="font-family: Cambria, Georgia, serif; font-size: 14px color: #333;">Warmest greeting from ODI Asia!</p>
				 
	<p style="font-family: Cambria, Georgia, serif; font-size: 14px color: #333;">Are you looking for practical training courses on business and leadership skills?<br/>
	We are pleased to share with you our upcoming training courses in <strong>{{ $training_date }}</strong>.</p>
				 
	<p style="font-family: Cambria, Georgia, serif; font-size: 14px color: #333;">Feel free to contact us if you are interested in any course, our training team is looking 
	forward to answer your inquiry and help you to understand how you will benefit from the courses.</p>
	<h2 style="text-align:center; color:#00ADEF; ont-family: Cambria, Georgia, serif; font-size: 22px;">
		Public Training Schedule in {{ $training_date }}
	</h2>
	<table style="border-collapse: collapse; width:100%">
		<tr>
			<th style="background: #00ADEF; border: 1px solid #dddddd; color: #FFF; padding: 10px 0; text-align:center; width:5%;">No</th>
			<th style="background: #00ADEF; border: 1px solid #dddddd; color: #FFF; padding: 10px 0; text-align:center; width:50%;">Course Title</th>
			<th style="background: #00ADEF; border: 1px solid #dddddd; color: #FFF; padding: 10px 0; text-align:center; width:15%;">Dates</th>
			<th style="background: #00ADEF; border: 1px solid #dddddd; color: #FFF; padding: 10px 0; text-align:center; width:10%;">Duration</th>
			<th style="background: #00ADEF; border: 1px solid #dddddd; color: #FFF; padding: 10px 0; text-align:center; width:10%;">Language</th>
			<th style="background: #00ADEF; border: 1px solid #dddddd; color: #FFF; padding: 10px 0; text-align:center; width:10%;">Fee</th>
		</tr>
	@foreach($result as $row)
		<tr>
			<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">{{ ++$ind }}</td>
			<td style="border: 1px solid #dddddd; padding: 5px"><a href="{{ url('training-course-detail-'. $row->trc_id .'-'. Helper::encode_title($row->trc_title)) }}" target="_blank">{{ $row->trc_title }}</a></td>
			<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">{{ Helper::training_date($row->started_from, $row->started_to) }}</td>
			<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">{{ $row->trc_duration }}</td>
			<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">{{ $row->trc_language }}</td>
			<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">$ {{ $row->trc_price }}</td>
		</tr>
	@endforeach
	</table>

	<p style="font-family: Cambria, Georgia, serif; font-size: 14px color: #333;">
	<strong>Please click on the course title to view detail course outline.</strong>
	</p>
	<br/><br/>
	<p>Best Regards,<br/>Nisay</p>
	<br/><br/>
	<img src="{{ url('public/_images/logo-odi.png') }}" />
	<p style="color: #00ADEF;"><strong>Ms. KONG Sennisay</strong><br/>
		Training Department<br/>
		Office : +855 23 722 431<br/>
		Mobile : +855 77 333 534<br/>
		Email : <a href="mailto:training2@odi-asia.com">training2@odi-asia.com</a><br/>
		Website : <a href="http://www.odi-asia.com" target="_blank" style="color: #00ADEF;">www.odi-asia.com</a><br/>
		Address : Bayon Building, 4th Floor, No. 33-34, Sangkat Monorom,
		Khan 7 Makara, Phnom Penh, Cambodia.
	</p>
	</body>
</html>