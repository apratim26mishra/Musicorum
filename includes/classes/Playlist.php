<?php
	class Playlist {

		private $con;
		private $name;
		private $owner;

		public function __construct($con, $data) {
			if(!is_array($data)){
				$query = mysqli_query($con, "SELECT * FROM playlists WHERE name='$data'");
				$data = mysqli_fetch_array($query);
			}
			$this->con = $con;
			$this->name = $data['name'];
			$this->owner = $data['owner'];
		}

		public function getId() {
			return $this->name;
		}

		public function getName() {
			return $this->name;
		}

		public function getOwner() {
			return $this->owner;
		}

    public function getNumberOfSongs(){
			$query = mysqli_query($this->con,"SELECT songId FROM playlistSongs WHERE
				 playlistId ='$this->name'");
				 return mysqli_num_rows($query);
		}

		public function getSongIds() {

			$query = mysqli_query($this->con, "SELECT songId FROM playlistSongs WHERE
				playlistId='$this->name' ORDER BY playlistOrder ASC");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['songId']);
			}

			return $array;

		}
		public static function getPlaylistsDropdown($con,$username){
			$dropdown = '<select class="item playlist">
			           <option value=""> Add to playlist</option>';
      $query = mysqli_query($con,"SELECT name FROM playlists WHERE owner ='$username'");
    while($row = mysqli_fetch_array($query)){
			$id = $row['name'];
			$name = $row['name'];
			$dropdown = $dropdown . "<option value='$id'>$name</option>";
		}
								 return $dropdown ."</select>";
		}
	}
?>
