<?php
	require_once("action/DAO/Connection.php");

	class UserDAO {

		public static function authenticate($username, $password) {
			$user = null;

			$connection = Connection::getConnection();

			$statement = $connection->prepare("SELECT * from users where username = ?");
			$statement->bindParam(1, $username);
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$statement->execute();

			if ($row = $statement->fetch()) {
	
				if (password_verify($password, $row["pwd"])) {
					$user = [];
					$user["USERNAME"] = $row["username"];
					$user["VISIBILITY"] = $row["visibility"];
				}
			}

			return $user;
		}

		public static function updatePassword($username, $newPassword) {
			$connection = Connection::getConnection();
			$options = [ 'cost' => 12 ];
			$hash = password_hash($newPassword, PASSWORD_BCRYPT, $options);

			$statement = $connection->prepare("UPDATE users SET pwd = ? where username = ?");
			$statement->bindParam(1, $hash);
			$statement->bindParam(2, $username);
			$statement->execute();
		}

		public static function addUser($username, $password, $visibility) {
			$connection = Connection::getConnection();
			$options = [ 'cost' => 12 ];
			$hash = password_hash($password, PASSWORD_BCRYPT, $options);

			$statement = $connection->prepare("INSERT INTO users(username, pwd, visibility) VALUES (?, ?, ?)");
			$statement->bindParam(1, $username);
			$statement->bindParam(2, $hash);
			$statement->bindParam(3, $visibility);
			$statement->execute();
		}

		public static function deleteUser($username){
			if($username != "dkadmin"){
				$connection = Connection::getConnection();
				$statement = $connection->prepare("DELETE FROM users WHERE username = ?");
				$statement->bindParam(1, $username);
				$statement->execute();

			}
		}

		public static function getUsers($username){
			$connection = Connection::getConnection();
			$sql = "SELECT username FROM users WHERE username <> 'dkadmin'";
			$users = [];
			foreach($connection->query($sql) as $row){
				array_push($users, $row["username"]);
			}

			return $users;
		}

		public static function setPageContent($page, $content){
			$connection = Connection::getConnection();

			$statement = $connection->prepare("UPDATE pages SET content = ? where title = ?");
			$statement->bindParam(1, $content);
			$statement->bindParam(2, $page);
			$statement->execute();
		}

		public static function getPageContent($page){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("SELECT content FROM pages WHERE title = ?");
			$statement->bindParam(1, $page);
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$statement->execute();

			$result = "ERROR";

			if($row = $statement->fetch()){
				$result = $row["content"];
			}

			return $result;
		}

		public static function getTeam(){
			$connection = Connection::getConnection();
			$sql = "SELECT team.id, team.fullname, jobs.title, team.bio, team.image_url FROM team JOIN jobs ON team.id_job = jobs.id ORDER BY team.pos";
			$team = [];
			foreach($connection->query($sql) as $row){
				$team[$row["id"]] = [ $row["fullname"], $row["title"], $row["bio"], $row["image_url"] ];
			}

			return $team;

		}

		public static function getJobs(){
			$connection = Connection::getConnection();
			$sql = "SELECT title FROM jobs";
			$jobs = [];
			foreach($connection->query($sql) as $row){
				array_push($jobs, $row["title"]);
			}

			return $jobs;
		}

		public static function getTeamMembers(){
			$connection = Connection::getConnection();
			$sql = "SELECT fullname FROM team";
			$members = [];
			foreach($connection->query($sql) as $row){
				array_push($members, $row["fullname"]);
			}
			
			return $members;
		}

		public static function getBio($fullname){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("SELECT bio FROM team WHERE fullname = ?");
			$statement->bindParam(1, $fullname);
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$statement->execute();

			$bio = "";
			if($row = $statement->fetch()){
				$bio = $row["bio"];
			}

			return $bio;

		}

		public static function getPos($fullname){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("SELECT pos FROM team WHERE fullname = ?");
			$statement->bindParam(1, $fullname);
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$statement->execute();

			$pos = "";
			if($row = $statement->fetch()){
				$pos = $row["pos"];
			}

			return $pos;

		}

		public static function getAllPos($selectedpos){
			$connection = Connection::getConnection();
			$sql = "SELECT pos FROM team WHERE pos <>" . $selectedpos;
			$positions = [];
			foreach($connection->query($sql) as $row){
				array_push($positions, $row["pos"]);
			}
			
			return $positions;
		}

		public static function newTeamMember($fullname, $job, $bio, $image_url){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("INSERT INTO team(fullname, id_job, bio, image_url, pos) VALUES(?, (SELECT id FROM jobs WHERE title = ?), ?, ?, ?)");
			$statement->bindParam(1, $fullname);
			$statement->bindParam(2, $job);
			$statement->bindParam(3, $bio);
			$statement->bindParam(4, $image_url);
			$statement->bindParam(5, UserDAO::getMaxPos());
			$statement->execute();
		}

		public static function editMemberName($fullname, $newfullname){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("UPDATE team SET fullname = ? WHERE fullname = ?");
			$statement->bindParam(1, $newfullname);
			$statement->bindParam(2, $fullname);
			$statement->execute();
		}

		public static function editMemberJob($fullname, $newjob){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("UPDATE team SET id_job = (SELECT id FROM jobs WHERE title = ?) WHERE fullname = ?");
			$statement->bindParam(1, $newjob);
			$statement->bindParam(2, $fullname);
			$statement->execute();
		}

		public static function editMemberBio($fullname, $newbio){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("UPDATE team SET bio = ? WHERE fullname = ?");
			$statement->bindParam(1, $newbio);
			$statement->bindParam(2, $fullname);
			$statement->execute();
		}

		public static function editMemberPhoto($fullname, $newimage){
			UserDAO::deletePhoto($fullname);
			$connection = Connection::getConnection();
			$statement = $connection->prepare("UPDATE team SET image_url = ? WHERE fullname = ?");
			$statement->bindParam(1, $newimage);
			$statement->bindParam(2, $fullname);
			$statement->execute();
		}

		public static function editMemberPos($fullname, $newpos){
			$connection = Connection::getConnection();
			
			$statement1 = $connection->prepare("SELECT pos FROM team WHERE fullname = ?");
			$statement1->bindParam(1, $fullname);
			$statement1->setFetchMode(PDO::FETCH_ASSOC);
			$statement1->execute();

			$oldpos = 0;
			if($row = $statement1->fetch()){
				$oldpos = $row["pos"];
			}

			$statement2 = $connection->prepare("UPDATE team SET pos = ? WHERE pos = ?");
			$statement2->bindParam(1, $oldpos);
			$statement2->bindParam(2, $newpos);
			$statement2->execute();

			$statement3 = $connection->prepare("UPDATE team SET pos = ? WHERE fullname = ?");
			$statement3->bindParam(1, $newpos);
			$statement3->bindParam(2, $fullname);
			$statement3->execute();
		}

		public static function deleteTeamMember($fullname){
			UserDAO::deletePhoto($fullname);
			$connection = Connection::getConnection();

			$statement_delete = $connection->prepare("DELETE FROM team WHERE fullname = ?");
			$statement_delete->bindParam(1, $fullname);
			$statement_delete->execute();
		}

		private static function deletePhoto($fullname){
			$connection = Connection::getConnection();
			$statement_file = $connection->prepare("SELECT image_url FROM team WHERE fullname = ?");
			$statement_file->bindParam(1, $fullname);
			$statement_file->setFetchMode(PDO::FETCH_ASSOC);
			$statement_file->execute();

			$target_file = "";
			if($row = $statement_file->fetch()){
				$target_file = $row["image_url"];
			}

			if($target_file !== ""){
				unlink($target_file);
			}
		}

		private static function getMaxPos(){
			$connection = Connection::getConnection();
			$statement = $connection->prepare("SELECT MAX(pos) FROM team");
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$statement->execute();

			$maxpos = 0;
			
			if($row = $statement->fetch()){
				$maxpos = $row["MAX(pos)"] + 1;
			}

			return $maxpos;
		}

		private static function addJob($jobtitle){
			$connection = Connection::getConnection();
			$statement = $connection->preapre("INSERT INTO jobs(title) VALUES (?)");
			$statement->bindParam(1, $jobtitle);
			$statement->execute();
		}

		private static function getOffers(){
			$connection = Connection::getConnection();
			$sql = "SELECT offers.id, jobs.title, offers.salary, offers.description FROM offers JOIN jobs ON offers.id_jobs = jobs.id";

			$offers = [];
			foreach($connection->query($sql) as $row){
				$offers[$row["id"]] = [ $row["title"], $row["salary"], $row["description"] ];
			}

			return $offers;


		}
	}