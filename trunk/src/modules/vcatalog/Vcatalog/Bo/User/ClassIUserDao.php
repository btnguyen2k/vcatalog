<?php
interface Vcatalog_Bo_User_IUserDao extends Ddth_Dao_IDao {
    
    /**
     * Gets all user.
     *     
     * @return Array
     */
    public function getUsers();
    /**
     * Gets a user account by user id.
     *
     * @param int $id
     * @return Array
     */
    public function getUserById($id);
    
    /**
     * Gets a user account by username.
     *
     * @param string $username
     * @return Array
     */
    public function getUserByUsername($username);
    
    /**
     * Gets a user account by email address.
     *
     * @param string $email
     * @return Array
     */
    public function getUserByEmail($email);
    
    /**
     * Creates a new user account.
     *
     * @param Vcatalog_Bo_User_BoUser $user
     */
    public function createUser($user);
    
    /**
     * Updates an existing user account.
     *
     * @param Vcatalog_Bo_User_BoUser $user
     */
    public function updateUser($user);
    
    /**
     * Delete an existing user account.
     *
     * @param Vcatalog_Bo_User_BoUser $user
     */
    public function deleteUser($user);

}
