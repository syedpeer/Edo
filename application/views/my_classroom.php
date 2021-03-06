<html>
<head>
<title>Khoá học của tôi</title>
	<?php $this->load->view('header');?>
<link rel="stylesheet" href=<?php echo base_url("assets/css/myClassroom.css")?>
	type="text/css" />

</head>
<body>
	<div class="sideBar">
		<div class="logoBar">
			<img style="padding-left: 20px" src="<?php echo base_url("assets/images/logo.png") ?>">
		</div>
		<div class="logoItem">
			<a class="w1" style="text-decoration: none" href="<?php echo site_url('my_classroom') ?>">
			<span class="glyphicon glyphicon-home"> </span>
			Trang chủ
			</a></p>
		</div>
		<div class="logoItem">
			<a class="w1" style="text-decoration: none" href=<?php echo site_url("course_controller")?>>
			<span class="glyphicon glyphicon-th-list"> </span>
			Chợ khóa học
			</a></p>
		</div>
		<div class="logoItem">
			<a class="w1" style="text-decoration: none" href=<?php echo site_url("my_classroom/setting")?>>
			<span class="glyphicon glyphicon-cog"></span>
			Cài đặt
			</a></p>
		</div>
		<div class="logoItem bottom">
			<a class="w1" style="text-decoration: none" href=<?php echo site_url('logout');?>>
			<span class="glyphicon glyphicon-log-out"></span>
			Đăng xuất
			</a>
		</div>
	</div>

	<div style="margin-left: 260px;" >
		<div style="width: 100%; position:fixed; top:0; left:260; background-color: white; z-index:10; height: 70px; box-shadow: 0px 0.5px 10px #c1c1c1;">
			<div class="container" style="width: 100%">
				<h4 style="margin: 0; padding-top: 30px">Trang chủ</h4>	
			</div>
		</div> 

		<div class="container" style="width:100%; margin-top:70px">		
			<?php
				if($this->session->userdata("active_lesson"))
				{
					$active_lesson = $this->session->userdata("active_lesson");
					$active_course = $this->session->userdata("active_course");


					//print_r($active_course);

					echo '
					<div class="col-md-12 marTop30" >
					<p>KHÓA HỌC GẦN ĐÂY</p>	
					<div class ="courseCard" style="margin-top: 0;">	
						<p>
						<b class="courseName">Đang học <i>',$active_course->course_name,'</i> ?</b><br><br>
						Bạn đang học dở bài: <i>',$active_lesson->lesson_name,'</i>
						</p>

						<form action="',site_url('my_classroom/load_lesson/'.$active_course->course_id.'/'.$active_lesson->lesson_id),'">
						<input type="submit" value="Học tiếp luôn !!"
						 style="width:200px;" class="btn button-primary">
						</form>
					</div>
					</div>';
				}
			?>
			
			

			<?php 
			foreach ($courses as $index => $course) {
				echo '
				<div class="col-md-12 marTop30" >';
				if($index==0) echo '<p>KHÓA ĐÃ ĐĂNG KÝ</p>';
				echo '
				<div class ="courseCard" style="margin-top: 0px">
						<p>
						KHÓA NGẮN<br>
						<b class="courseName">',$course->course_name,'</b><br><br>
						',$course->course_shortDesc,'
						</p>
						<br>
						<form action="',site_url('my_classroom/load_lesson/'.$course->course_id.'/'),'">
						<input type="submit" value="Vào học"
						 style="width:150px;" class="btn button-primary">
						</form>
				</div>
				</div>';
			}
			?>

		</div>
	</div>

</body>

<script type="text/javascript">
	
</script>

</html>
