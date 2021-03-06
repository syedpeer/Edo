<html>
<head>
	<title>Đang học khóa: </title>
	<?php $this->load->view('header');?>

	<link rel="stylesheet" href=<?php echo base_url("assets/css/studying.css")?>
	type="text/css" />


</head>
<body>
	<div class="sideBar">
		<div class="logoBar">
			<a href="<?php echo site_url('my_classroom') ?>">
				<img  src='<?php echo base_url('assets/images/logo-icon.png') ?>'>
			</a>
		</div>
		<div class="logoItem">
			<p class="w1"><a href="<?php echo site_url('my_classroom') ?>">
				<span class="glyphicon glyphicon-home"></span>

			</a></p>
		</div>
		<div class="logoItem">
			<p class="w1"><a href="<?php echo site_url("course_controller")?>">
				<span class="glyphicon glyphicon-th-list"></span>

			</a></p>
		</div>
		<div class="logoItem">
			<p class="w1"><a href=<?php echo site_url('my_classroom/setting')?>>
				<span class="glyphicon glyphicon-cog"></span>
			</a></p>
		</div>

		<div class="logoItem bottom">
			<p class="w1"><a href=<?php echo site_url('logout')?>>
				<span class="glyphicon glyphicon-log-out"></span>
			</a></p>
		</div>
	</div>

	<div class="lessonBar">

		<div style="height: 70px; border-bottom:1px solid">
			<p id="courseTitle"><?php echo $course->course_name ?></p>
		</div>
		<div class="col-md-12">
			<p style="padding-top: 15px; font-size: 16px; color:lightgreen">
				CHỦ ĐIỂM
			</p>
		</div>

		<?php 
		foreach ($topics as $i => $topic){
			echo '
			<div onClick="toggle(',$i,')" class="col-md-12 topicCard">
				<p>
					CĐ',$i+1,': ',$topic->topic_name,'
					<span id="toggleButton',$i,'" class="glyphicon glyphicon-menu-up" style="float:right"></span>
				</p>
			</div>';
			echo '<div id="list',$i,'" class="col-md-12 lessonList">';
			foreach ($topic->lessons as $j => $lesson) {
				echo '
				<p><a ';
				if($lesson->lesson_id == $active_lesson->lesson_id){
					echo 'style="color:lightgreen"';
				}
				echo' href=',site_url('my_classroom/load_lesson/'.$course->course_id.'/'.$lesson->lesson_id),'>
					Bài ',$j+1,': ',$lesson->lesson_name,'
				</a></p>';
			}
			echo '</div>';

		}
		?>

	</div>
	<div class="topBar">
		<div class="container" style="width:100%">
			<h4 style="margin: 0; padding-top: 30px;"><?php echo $course->course_name?></h4>	
		</div>
	</div> 
	<div class="lessonContent" >
		<div class="container" id="videoContainer" style="width:100%; text-align: center; margin-top:70px">
		</div>

		<div class="container" style="width:100%;padding:0;">
			<div class="lessonDesc">
				<?php
				if($active_lesson->lesson_type == 1){
					echo "
					<p class=\"title\">Video: $active_lesson->lesson_name</p>
					<p class=\"title\">Tài liệu bài học:
						";
						if($active_lesson->lesson_mate){
							echo "
							<a href=\"$active_lesson->lesson_mate\">Download
							</a>
							";
						} else echo "Không có.";
						echo "</p>";
					} else if($active_lesson->lesson_type == 2){
						echo "<style type=\"text/css\">#videoContainer {display:none}</style>";
						echo $active_lesson->lesson_desc;
					}

					?>
				</div>
			</div>
		</div>
	</body>


	<script type="text/javascript">
	function toggle(index){
		var query = 'list'.concat(index);
		var list = document.getElementById(query);
		list.style.display = list.style.display === 'none' ? '' : 'none';

		updateButtonState(index);
	}

	function updateButtonState(index){
		var query = 'toggleButton'.concat(index);
		var button = document.getElementById(query);
		var buttonState = button.classList[1];
		if(buttonState == "glyphicon-menu-up"){
			button.classList.remove("glyphicon-menu-up");
			button.classList.add("glyphicon-menu-down");
		}
		else{
			button.classList.add("glyphicon-menu-up");
			button.classList.remove("glyphicon-menu-down");
		
		}
	}

	// function resizeVideo(){
	// 	console.log("sdfsdf");
	// 	var lessonVideo = document.getElementById("lessonVideo");
	// 	var width = parseInt(lessonVideo.style.width.split("p")[0]);
	// 	var height = width/2;
	// 	lessonVideo.style.height = height.toString().concat("px");
	// 	console.log(lessonVideo.style);
	// }

	function getId(url) {
		var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
		var match = url.match(regExp);

		if (match && match[2].length == 11) {
			return match[2];
		} else {
			return 'error';
		}
	}

	var link = "<?php echo $active_lesson->lesson_video?>";
	if(link){
		var myId = getId(link);

		$('#videoContainer').html('<iframe height="400" class="col-lg-offset-1 col-sm-12 col-lg-10" src="//www.youtube.com/embed/' + myId + '" frameborder="0" allowfullscreen></iframe>');
	}
	

</script>

</html>
