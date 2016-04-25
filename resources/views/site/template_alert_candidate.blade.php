<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>New Job alert from ODI Asia</title>
	</head>
	<body>
	<p style="font-family: Cambria, Georgia, serif; font-size: 16px color: #333;">Dear Prospect candidate,</p>
	<p style="font-family: Cambria, Georgia, serif; font-size: 14px color: #333;">Are you looking to advance your career? Many new jobs are waiting for you.</p>

	<table style="border-collapse: collapse; width:100%">
		<tr>
			<th colspan="4" style="background: #00ADEF; border: 1px solid #00ADEF; border-bottom: 1px solid #dddddd; color: #FFF; padding: 7px 0; text-align:center; width:100%;">Job Announcement</th>
		</tr>
		<tr>
			<td style="border: 1px solid #dddddd; text-align:center; padding: 10px 0;"><strong>No</strong></td>
			<td style="border: 1px solid #dddddd; text-align:center; padding: 10px 0;"><strong>Position</strong></td>
			<td style="border: 1px solid #dddddd; text-align:center; padding: 10px 0;"><strong>Closing Date</strong></td>
			<td style="border: 1px solid #dddddd; text-align:center; padding: 10px 0;"><strong>Location</strong></td>
		</tr>
	@foreach($result as $row)
		<tr>
			<td style="border: 1px solid #dddddd; text-align:center;">{{ ++$ind }}</td>
			<td style="border: 1px solid #dddddd; padding: 7px 5px;"><a href="{{ url('job-detail-'.$row->job_id .'-'. Helper::encode_title($row->job_title)) }}" target="_blank">{{ $row->job_title }}</a> <sup style="color: #00ADEF">New</sup></td>
			<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">{{ date('d F, Y', strtotime($row->close_date)) }}</td>
			<td style="border: 1px solid #dddddd; text-align:center; padding: 7px 5px;">{{ $row->loc_name }}</td>					
		</tr>
	@endforeach
	</table>

	<p>Click to view the detail of the job.<br/>
	Our recruitment is happy to welcome all your questions and assist you to find your dream employer.</p>
	</p>
	<br/><br/>
	<p>Best Regards,<br/>Recruitment Team</p>
	<br/><br/>
	<img src="{{ url('public/_images/logo-odi.png') }}" />
	<p style="color: #00ADEF;">
		<strong>Ms. CHEN Rany</strong><br/>
		Recruitment Department<br/>
		Office : +855 23 722 431<br/>
		Mobile : +855 77 333 423 / +855 77 333 524<br/>
		Email : <a href="mailto:recruitment@odi-asia.com">recruitment@odi-asia.com</a><br/>
		Website : <a href="http://www.odi-asia.com" target="_blank" style="color: #00ADEF;">www.odi-asia.com</a><br/>
		Address : Bayon Building, 4th Floor, No. 33-34, Sangkat Monorom,
		Khan 7 Makara, Phnom Penh, Cambodia.
	</p>
	</body>
</html>