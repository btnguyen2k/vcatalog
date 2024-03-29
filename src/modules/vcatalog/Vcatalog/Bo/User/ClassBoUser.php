<?php
class Vcatalog_Bo_User_BoUser extends Quack_Bo_BaseBo {

    /* Database table columns: virtual columns */
    const COL_ID = 'user_id';
    const COL_USERNAME = 'user_username';
    const COL_EMAIL = 'user_email';
    const COL_PASSWORD = 'user_password';
    const COL_GROUP_ID = 'user_group_id';
    const COL_TITLE = 'user_title';
    const COL_FULLNAME = 'user_fullname';
    const COL_LOCATION = 'user_location';

    private $id, $username, $email, $password, $groupId, $title, $fullname, $location;

    /*
     * (non-PHPdoc) @see Quack_Bo_BaseBo::getFieldMap()
     */
    protected function getFieldMap() {
        return Array(self::COL_ID => Array('id', self::TYPE_INT),
                self::COL_USERNAME => Array('username'),
                self::COL_EMAIL => Array('email'),
                self::COL_PASSWORD => Array('password'),
                self::COL_GROUP_ID => Array('groupId', self::TYPE_INT),
                self::COL_TITLE => Array('title'),
                self::COL_FULLNAME => Array('fullname'),
                self::COL_LOCATION => Array('location'));
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getGroupId() {
        return $this->groupId;
    }

    public function setGroupId($groupId) {
        $this->groupId = $groupId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    public function getLocation() {
        return $this->location;
    }

    public function setLocation($location) {
        $this->location = $location;
    }
}
