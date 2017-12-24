<?php
namespace SerialsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="SerialsBundle\Repository\UserRepository")
 * @UniqueEntity(fields={"email"})
 * @UniqueEntity(fields={"username"})
 * @ORM\HasLifecycleCallbacks
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=20, unique=true)
     *
     * @Assert\NotBlank
     *
     * @Assert\Length(
     *     min=5,
     *     max=20,
     *     groups= {"Register","Login"}
     *     )
     */
    private $username;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\NotBlank(groups = {"SetData"} )
     * @Assert\Length(
     *     min=2,
     *     max=20,
     *     groups = {"SetData"}
     * )
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;
    /**
     * @Assert\NotBlank(groups = {"Register", "Login"})
     *
     * @Assert\Length(min=6,max=4096,groups = {"Register", "Login"})
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="datetime")
     */
    private $joinDate;
    /**
     * @ORM\Column(name="account_non_expired", type="boolean")
     */
    private $accountNonExpired = true;
    /**
     * @ORM\Column(name="account_non_locked", type="boolean")
     */
    private $accountNonLocked = true;
    /**
     * @ORM\Column(name="credentials_non_expired", type="boolean")
     */
    private $credentialsNonExpired = true;
    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled = false;
    /**
     * @ORM\Column(type="array")
     */
    private $roles;
    /**
     * @ORM\Column(name="action_token", type="string", length=20, nullable=true)
     */
    private $actionToken;

    public function __construct()
    {
        return $this->joinDate = new \DateTime();
    }
    public function isAccountNonExpired(){
        return $this->accountNonExpired;
    }
    public function isAccountNonLocked(){
        return $this->accountNonLocked;
    }
    public function isCredentialsNonExpired(){
        return $this->credentialsNonExpired;
    }
    public function isEnabled(){
        return $this->enabled;
    }
    public function getRoles() {
        if(empty($this->roles)){
            return array('ROLE_USER');
        }
        return $this->roles;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getSalt(){
        return null;
    }
    public function getUsername(){
        return $this->username;
    }
    public function eraseCredentials(){
        $this->plainPassword = null;
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Set accountNonExpired
     *
     * @param boolean $accountNonExpired
     *
     * @return User
     */
    public function setAccountNonExpired($accountNonExpired)
    {
        $this->accountNonExpired = $accountNonExpired;
        return $this;
    }
    /**
     * Get accountNonExpired
     *
     * @return boolean
     */
    public function getAccountNonExpired()
    {
        return $this->accountNonExpired;
    }
    /**
     * Set accountNonLocked
     *
     * @param boolean $accountNonLocked
     *
     * @return User
     */
    public function setAccountNonLocked($accountNonLocked)
    {
        $this->accountNonLocked = $accountNonLocked;
        return $this;
    }
    /**
     * Get accountNonLocked
     *
     * @return boolean
     */
    public function getAccountNonLocked()
    {
        return $this->accountNonLocked;
    }
    /**
     * Set credentialsNonExpired
     *
     * @param boolean $credentialsNonExpired
     *
     * @return User
     */
    public function setCredentialsNonExpired($credentialsNonExpired)
    {
        $this->credentialsNonExpired = $credentialsNonExpired;
        return $this;
    }
    /**
     * Get credentialsNonExpired
     *
     * @return boolean
     */
    public function getCredentialsNonExpired()
    {
        return $this->credentialsNonExpired;
    }
    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return User
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }
    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }
    /**
     * Set actionToken
     *
     * @param string $actionToken
     *
     * @return User
     */
    public function setActionToken($actionToken)
    {
        $this->actionToken = $actionToken;
        return $this;
    }
    /**
     * Get actionToken
     *
     * @return string
     */
    public function getActionToken()
    {
        return $this->actionToken;
    }
    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->email,
            $this->password
        ));
    }
    public function unserialize($serialized) {
        list(
            $this->id,
            $this->username,
            $this->email,
            $this->password
            ) = unserialize($serialized);
    }
}