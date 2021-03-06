<?php
class course_model extends MY_Model{
	public $table = 'tblCourse';
	public $table_id = 'course_id';

	public function filter_course($input = array()){
		if($input['course_cate'] == 0){
			$cate = "> 0";
		}
		else{
			$cate = "= ".$input['course_cate'];
		}

		$query = "SELECT * FROM ".$this->table." WHERE course_cate ?";

		$result = $this->db->query($query, array($cate))->result();
		return $result;
	}

	public function search($name){
		$query = "SELECT * FROM ".$this->table." WHERE course_name LIKE '%".$name."%'";
		$result = $this->db->query($query)->result();
		return $result;
	}

	public function get_course_detail($course_id) {
		$sql = "SELECT `course_id`, `course_name`, `course_desc`, `course_shortDesc`, `course_why`, `course_require`, `course_totalTime`, `course_teacher`, `course_level`, `course_createAt`, `course_startAt`, `course_video`, `course_fee`, `course_forum`, `course_cate`, `course_rate`, `teacher_fname`, `teacher_lname`, `teacher_desc`, `teacher_job` FROM `tblCourse` AS c, `tblTeacher` as t WHERE c.`course_id` = ? AND c.`course_teacher` = t.`teacher_id`";
		$query = $this->db->query($sql, array($course_id));
		return $query->result();
	}

	public function get_course_lesson_list($course_id){
		$sql = "SELECT `topic_id`, `topic_name`, `lesson_id`, `lesson_topicId`, `lesson_name` FROM `tblTopic`, `tblLesson` WHERE `topic_courseId` = ? and `topic_id` = `lesson_topicId`";
		$query = $this->db->query($sql, array($course_id));
		return $query->result_array();
	}
}
?>