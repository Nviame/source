<?php

namespace Base;

use \UsersQuery as ChildUsersQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\UsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'users' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Users implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\UsersTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the id_company field.
     * @var        int
     */
    protected $id_company;

    /**
     * The value for the avatar field.
     * @var        string
     */
    protected $avatar;

    /**
     * The value for the fullname field.
     * @var        string
     */
    protected $fullname;

    /**
     * The value for the first_name field.
     * @var        string
     */
    protected $first_name;

    /**
     * The value for the last_name field.
     * @var        string
     */
    protected $last_name;

    /**
     * The value for the password field.
     * @var        string
     */
    protected $password;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the country field.
     * @var        string
     */
    protected $country;

    /**
     * The value for the country_code field.
     * @var        string
     */
    protected $country_code;

    /**
     * The value for the home_address field.
     * @var        string
     */
    protected $home_address;

    /**
     * The value for the providence_code field.
     * @var        string
     */
    protected $providence_code;

    /**
     * The value for the providence field.
     * @var        string
     */
    protected $providence;

    /**
     * The value for the locality_code field.
     * @var        string
     */
    protected $locality_code;

    /**
     * The value for the locality field.
     * @var        string
     */
    protected $locality;

    /**
     * The value for the postal_code field.
     * @var        string
     */
    protected $postal_code;

    /**
     * The value for the dni field.
     * @var        string
     */
    protected $dni;

    /**
     * The value for the dni_front field.
     * @var        string
     */
    protected $dni_front;

    /**
     * The value for the dni_back field.
     * @var        string
     */
    protected $dni_back;

    /**
     * The value for the phone field.
     * @var        string
     */
    protected $phone;

    /**
     * The value for the drivers_license field.
     * @var        string
     */
    protected $drivers_license;

    /**
     * The value for the overall_rating field.
     * Note: this column has a database default value of: 0.0
     * @var        double
     */
    protected $overall_rating;

    /**
     * The value for the last_login field.
     * @var        \DateTime
     */
    protected $last_login;

    /**
     * The value for the registered_at field.
     * @var        \DateTime
     */
    protected $registered_at;

    /**
     * The value for the updated_at field.
     * @var        \DateTime
     */
    protected $updated_at;

    /**
     * The value for the last_location_lat field.
     * @var        string
     */
    protected $last_location_lat;

    /**
     * The value for the last_location_lng field.
     * @var        string
     */
    protected $last_location_lng;

    /**
     * The value for the last_location_datetime field.
     * @var        \DateTime
     */
    protected $last_location_datetime;

    /**
     * The value for the last_location_locality field.
     * @var        string
     */
    protected $last_location_locality;

    /**
     * The value for the last_location_region field.
     * @var        string
     */
    protected $last_location_region;

    /**
     * The value for the last_location_country field.
     * @var        string
     */
    protected $last_location_country;

    /**
     * The value for the timezone field.
     * @var        string
     */
    protected $timezone;

    /**
     * The value for the traveling field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $traveling;

    /**
     * The value for the verified field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $verified;

    /**
     * The value for the pwd_reset_code field.
     * @var        string
     */
    protected $pwd_reset_code;

    /**
     * The value for the commission field.
     * @var        int
     */
    protected $commission;

    /**
     * The value for the disabled field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $disabled;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->overall_rating = 0.0;
        $this->traveling = false;
        $this->verified = false;
        $this->disabled = false;
    }

    /**
     * Initializes internal state of Base\Users object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Users</code> instance.  If
     * <code>obj</code> is an instance of <code>Users</code>, delegates to
     * <code>equals(Users)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Users The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [id_company] column value.
     *
     * @return int
     */
    public function getIdCompany()
    {
        return $this->id_company;
    }

    /**
     * Get the [avatar] column value.
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Get the [fullname] column value.
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Get the [first_name] column value.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the [last_name] column value.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [country] column value.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the [country_code] column value.
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Get the [home_address] column value.
     *
     * @return string
     */
    public function getHomeAddress()
    {
        return $this->home_address;
    }

    /**
     * Get the [providence_code] column value.
     *
     * @return string
     */
    public function getProvidenceCode()
    {
        return $this->providence_code;
    }

    /**
     * Get the [providence] column value.
     *
     * @return string
     */
    public function getProvidence()
    {
        return $this->providence;
    }

    /**
     * Get the [locality_code] column value.
     *
     * @return string
     */
    public function getLocalityCode()
    {
        return $this->locality_code;
    }

    /**
     * Get the [locality] column value.
     *
     * @return string
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Get the [postal_code] column value.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Get the [dni] column value.
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Get the [dni_front] column value.
     *
     * @return string
     */
    public function getDniFront()
    {
        return $this->dni_front;
    }

    /**
     * Get the [dni_back] column value.
     *
     * @return string
     */
    public function getDniBack()
    {
        return $this->dni_back;
    }

    /**
     * Get the [phone] column value.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [drivers_license] column value.
     *
     * @return string
     */
    public function getDriversLicense()
    {
        return $this->drivers_license;
    }

    /**
     * Get the [overall_rating] column value.
     *
     * @return double
     */
    public function getOverallRating()
    {
        return $this->overall_rating;
    }

    /**
     * Get the [optionally formatted] temporal [last_login] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLastLogin($format = NULL)
    {
        if ($format === null) {
            return $this->last_login;
        } else {
            return $this->last_login instanceof \DateTime ? $this->last_login->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [registered_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getRegisteredAt($format = NULL)
    {
        if ($format === null) {
            return $this->registered_at;
        } else {
            return $this->registered_at instanceof \DateTime ? $this->registered_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTime ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Get the [last_location_lat] column value.
     *
     * @return string
     */
    public function getLastLocationLat()
    {
        return $this->last_location_lat;
    }

    /**
     * Get the [last_location_lng] column value.
     *
     * @return string
     */
    public function getLastLocationLng()
    {
        return $this->last_location_lng;
    }

    /**
     * Get the [optionally formatted] temporal [last_location_datetime] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLastLocationDatetime($format = NULL)
    {
        if ($format === null) {
            return $this->last_location_datetime;
        } else {
            return $this->last_location_datetime instanceof \DateTime ? $this->last_location_datetime->format($format) : null;
        }
    }

    /**
     * Get the [last_location_locality] column value.
     *
     * @return string
     */
    public function getLastLocationLocality()
    {
        return $this->last_location_locality;
    }

    /**
     * Get the [last_location_region] column value.
     *
     * @return string
     */
    public function getLastLocationRegion()
    {
        return $this->last_location_region;
    }

    /**
     * Get the [last_location_country] column value.
     *
     * @return string
     */
    public function getLastLocationCountry()
    {
        return $this->last_location_country;
    }

    /**
     * Get the [timezone] column value.
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Get the [traveling] column value.
     *
     * @return boolean
     */
    public function getTraveling()
    {
        return $this->traveling;
    }

    /**
     * Get the [traveling] column value.
     *
     * @return boolean
     */
    public function isTraveling()
    {
        return $this->getTraveling();
    }

    /**
     * Get the [verified] column value.
     *
     * @return boolean
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Get the [verified] column value.
     *
     * @return boolean
     */
    public function isVerified()
    {
        return $this->getVerified();
    }

    /**
     * Get the [pwd_reset_code] column value.
     *
     * @return string
     */
    public function getPwdResetCode()
    {
        return $this->pwd_reset_code;
    }

    /**
     * Get the [commission] column value.
     *
     * @return int
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * Get the [disabled] column value.
     *
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Get the [disabled] column value.
     *
     * @return boolean
     */
    public function isDisabled()
    {
        return $this->getDisabled();
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[UsersTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_company] column.
     *
     * @param int $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setIdCompany($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_company !== $v) {
            $this->id_company = $v;
            $this->modifiedColumns[UsersTableMap::COL_ID_COMPANY] = true;
        }

        return $this;
    } // setIdCompany()

    /**
     * Set the value of [avatar] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setAvatar($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->avatar !== $v) {
            $this->avatar = $v;
            $this->modifiedColumns[UsersTableMap::COL_AVATAR] = true;
        }

        return $this;
    } // setAvatar()

    /**
     * Set the value of [fullname] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setFullname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fullname !== $v) {
            $this->fullname = $v;
            $this->modifiedColumns[UsersTableMap::COL_FULLNAME] = true;
        }

        return $this;
    } // setFullname()

    /**
     * Set the value of [first_name] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setFirstName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->first_name !== $v) {
            $this->first_name = $v;
            $this->modifiedColumns[UsersTableMap::COL_FIRST_NAME] = true;
        }

        return $this;
    } // setFirstName()

    /**
     * Set the value of [last_name] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setLastName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_name !== $v) {
            $this->last_name = $v;
            $this->modifiedColumns[UsersTableMap::COL_LAST_NAME] = true;
        }

        return $this;
    } // setLastName()

    /**
     * Set the value of [password] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[UsersTableMap::COL_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UsersTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [country] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country !== $v) {
            $this->country = $v;
            $this->modifiedColumns[UsersTableMap::COL_COUNTRY] = true;
        }

        return $this;
    } // setCountry()

    /**
     * Set the value of [country_code] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setCountryCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->country_code !== $v) {
            $this->country_code = $v;
            $this->modifiedColumns[UsersTableMap::COL_COUNTRY_CODE] = true;
        }

        return $this;
    } // setCountryCode()

    /**
     * Set the value of [home_address] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setHomeAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->home_address !== $v) {
            $this->home_address = $v;
            $this->modifiedColumns[UsersTableMap::COL_HOME_ADDRESS] = true;
        }

        return $this;
    } // setHomeAddress()

    /**
     * Set the value of [providence_code] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setProvidenceCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->providence_code !== $v) {
            $this->providence_code = $v;
            $this->modifiedColumns[UsersTableMap::COL_PROVIDENCE_CODE] = true;
        }

        return $this;
    } // setProvidenceCode()

    /**
     * Set the value of [providence] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setProvidence($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->providence !== $v) {
            $this->providence = $v;
            $this->modifiedColumns[UsersTableMap::COL_PROVIDENCE] = true;
        }

        return $this;
    } // setProvidence()

    /**
     * Set the value of [locality_code] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setLocalityCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->locality_code !== $v) {
            $this->locality_code = $v;
            $this->modifiedColumns[UsersTableMap::COL_LOCALITY_CODE] = true;
        }

        return $this;
    } // setLocalityCode()

    /**
     * Set the value of [locality] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setLocality($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->locality !== $v) {
            $this->locality = $v;
            $this->modifiedColumns[UsersTableMap::COL_LOCALITY] = true;
        }

        return $this;
    } // setLocality()

    /**
     * Set the value of [postal_code] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setPostalCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->postal_code !== $v) {
            $this->postal_code = $v;
            $this->modifiedColumns[UsersTableMap::COL_POSTAL_CODE] = true;
        }

        return $this;
    } // setPostalCode()

    /**
     * Set the value of [dni] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setDni($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dni !== $v) {
            $this->dni = $v;
            $this->modifiedColumns[UsersTableMap::COL_DNI] = true;
        }

        return $this;
    } // setDni()

    /**
     * Set the value of [dni_front] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setDniFront($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dni_front !== $v) {
            $this->dni_front = $v;
            $this->modifiedColumns[UsersTableMap::COL_DNI_FRONT] = true;
        }

        return $this;
    } // setDniFront()

    /**
     * Set the value of [dni_back] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setDniBack($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dni_back !== $v) {
            $this->dni_back = $v;
            $this->modifiedColumns[UsersTableMap::COL_DNI_BACK] = true;
        }

        return $this;
    } // setDniBack()

    /**
     * Set the value of [phone] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[UsersTableMap::COL_PHONE] = true;
        }

        return $this;
    } // setPhone()

    /**
     * Set the value of [drivers_license] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setDriversLicense($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->drivers_license !== $v) {
            $this->drivers_license = $v;
            $this->modifiedColumns[UsersTableMap::COL_DRIVERS_LICENSE] = true;
        }

        return $this;
    } // setDriversLicense()

    /**
     * Set the value of [overall_rating] column.
     *
     * @param double $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setOverallRating($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->overall_rating !== $v) {
            $this->overall_rating = $v;
            $this->modifiedColumns[UsersTableMap::COL_OVERALL_RATING] = true;
        }

        return $this;
    } // setOverallRating()

    /**
     * Sets the value of [last_login] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setLastLogin($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_login !== null || $dt !== null) {
            if ($this->last_login === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->last_login->format("Y-m-d H:i:s")) {
                $this->last_login = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersTableMap::COL_LAST_LOGIN] = true;
            }
        } // if either are not null

        return $this;
    } // setLastLogin()

    /**
     * Sets the value of [registered_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setRegisteredAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->registered_at !== null || $dt !== null) {
            if ($this->registered_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->registered_at->format("Y-m-d H:i:s")) {
                $this->registered_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersTableMap::COL_REGISTERED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setRegisteredAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Set the value of [last_location_lat] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setLastLocationLat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_location_lat !== $v) {
            $this->last_location_lat = $v;
            $this->modifiedColumns[UsersTableMap::COL_LAST_LOCATION_LAT] = true;
        }

        return $this;
    } // setLastLocationLat()

    /**
     * Set the value of [last_location_lng] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setLastLocationLng($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_location_lng !== $v) {
            $this->last_location_lng = $v;
            $this->modifiedColumns[UsersTableMap::COL_LAST_LOCATION_LNG] = true;
        }

        return $this;
    } // setLastLocationLng()

    /**
     * Sets the value of [last_location_datetime] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setLastLocationDatetime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_location_datetime !== null || $dt !== null) {
            if ($this->last_location_datetime === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->last_location_datetime->format("Y-m-d H:i:s")) {
                $this->last_location_datetime = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersTableMap::COL_LAST_LOCATION_DATETIME] = true;
            }
        } // if either are not null

        return $this;
    } // setLastLocationDatetime()

    /**
     * Set the value of [last_location_locality] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setLastLocationLocality($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_location_locality !== $v) {
            $this->last_location_locality = $v;
            $this->modifiedColumns[UsersTableMap::COL_LAST_LOCATION_LOCALITY] = true;
        }

        return $this;
    } // setLastLocationLocality()

    /**
     * Set the value of [last_location_region] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setLastLocationRegion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_location_region !== $v) {
            $this->last_location_region = $v;
            $this->modifiedColumns[UsersTableMap::COL_LAST_LOCATION_REGION] = true;
        }

        return $this;
    } // setLastLocationRegion()

    /**
     * Set the value of [last_location_country] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setLastLocationCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->last_location_country !== $v) {
            $this->last_location_country = $v;
            $this->modifiedColumns[UsersTableMap::COL_LAST_LOCATION_COUNTRY] = true;
        }

        return $this;
    } // setLastLocationCountry()

    /**
     * Set the value of [timezone] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setTimezone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->timezone !== $v) {
            $this->timezone = $v;
            $this->modifiedColumns[UsersTableMap::COL_TIMEZONE] = true;
        }

        return $this;
    } // setTimezone()

    /**
     * Sets the value of the [traveling] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setTraveling($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->traveling !== $v) {
            $this->traveling = $v;
            $this->modifiedColumns[UsersTableMap::COL_TRAVELING] = true;
        }

        return $this;
    } // setTraveling()

    /**
     * Sets the value of the [verified] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setVerified($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->verified !== $v) {
            $this->verified = $v;
            $this->modifiedColumns[UsersTableMap::COL_VERIFIED] = true;
        }

        return $this;
    } // setVerified()

    /**
     * Set the value of [pwd_reset_code] column.
     *
     * @param string $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setPwdResetCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pwd_reset_code !== $v) {
            $this->pwd_reset_code = $v;
            $this->modifiedColumns[UsersTableMap::COL_PWD_RESET_CODE] = true;
        }

        return $this;
    } // setPwdResetCode()

    /**
     * Set the value of [commission] column.
     *
     * @param int $v new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setCommission($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->commission !== $v) {
            $this->commission = $v;
            $this->modifiedColumns[UsersTableMap::COL_COMMISSION] = true;
        }

        return $this;
    } // setCommission()

    /**
     * Sets the value of the [disabled] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setDisabled($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->disabled !== $v) {
            $this->disabled = $v;
            $this->modifiedColumns[UsersTableMap::COL_DISABLED] = true;
        }

        return $this;
    } // setDisabled()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->overall_rating !== 0.0) {
                return false;
            }

            if ($this->traveling !== false) {
                return false;
            }

            if ($this->verified !== false) {
                return false;
            }

            if ($this->disabled !== false) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsersTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsersTableMap::translateFieldName('IdCompany', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_company = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsersTableMap::translateFieldName('Avatar', TableMap::TYPE_PHPNAME, $indexType)];
            $this->avatar = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsersTableMap::translateFieldName('Fullname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fullname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsersTableMap::translateFieldName('FirstName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->first_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsersTableMap::translateFieldName('LastName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsersTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsersTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UsersTableMap::translateFieldName('Country', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UsersTableMap::translateFieldName('CountryCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UsersTableMap::translateFieldName('HomeAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->home_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UsersTableMap::translateFieldName('ProvidenceCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->providence_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UsersTableMap::translateFieldName('Providence', TableMap::TYPE_PHPNAME, $indexType)];
            $this->providence = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UsersTableMap::translateFieldName('LocalityCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->locality_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : UsersTableMap::translateFieldName('Locality', TableMap::TYPE_PHPNAME, $indexType)];
            $this->locality = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : UsersTableMap::translateFieldName('PostalCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->postal_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : UsersTableMap::translateFieldName('Dni', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dni = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : UsersTableMap::translateFieldName('DniFront', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dni_front = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : UsersTableMap::translateFieldName('DniBack', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dni_back = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : UsersTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : UsersTableMap::translateFieldName('DriversLicense', TableMap::TYPE_PHPNAME, $indexType)];
            $this->drivers_license = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : UsersTableMap::translateFieldName('OverallRating', TableMap::TYPE_PHPNAME, $indexType)];
            $this->overall_rating = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : UsersTableMap::translateFieldName('LastLogin', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->last_login = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : UsersTableMap::translateFieldName('RegisteredAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->registered_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : UsersTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : UsersTableMap::translateFieldName('LastLocationLat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_location_lat = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : UsersTableMap::translateFieldName('LastLocationLng', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_location_lng = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : UsersTableMap::translateFieldName('LastLocationDatetime', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->last_location_datetime = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : UsersTableMap::translateFieldName('LastLocationLocality', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_location_locality = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : UsersTableMap::translateFieldName('LastLocationRegion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_location_region = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : UsersTableMap::translateFieldName('LastLocationCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->last_location_country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : UsersTableMap::translateFieldName('Timezone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->timezone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : UsersTableMap::translateFieldName('Traveling', TableMap::TYPE_PHPNAME, $indexType)];
            $this->traveling = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : UsersTableMap::translateFieldName('Verified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->verified = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : UsersTableMap::translateFieldName('PwdResetCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pwd_reset_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : UsersTableMap::translateFieldName('Commission', TableMap::TYPE_PHPNAME, $indexType)];
            $this->commission = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : UsersTableMap::translateFieldName('Disabled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->disabled = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 37; // 37 = UsersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Users'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Users::setDeleted()
     * @see Users::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsersQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UsersTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[UsersTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsersTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsersTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_ID_COMPANY)) {
            $modifiedColumns[':p' . $index++]  = '`id_company`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_AVATAR)) {
            $modifiedColumns[':p' . $index++]  = '`avatar`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_FULLNAME)) {
            $modifiedColumns[':p' . $index++]  = '`fullname`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`first_name`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`last_name`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = '`password`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`country`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_COUNTRY_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`country_code`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_HOME_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`home_address`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PROVIDENCE_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`providence_code`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PROVIDENCE)) {
            $modifiedColumns[':p' . $index++]  = '`providence`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LOCALITY_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`locality_code`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LOCALITY)) {
            $modifiedColumns[':p' . $index++]  = '`locality`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_POSTAL_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`postal_code`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_DNI)) {
            $modifiedColumns[':p' . $index++]  = '`dni`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_DNI_FRONT)) {
            $modifiedColumns[':p' . $index++]  = '`dni_front`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_DNI_BACK)) {
            $modifiedColumns[':p' . $index++]  = '`dni_back`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = '`phone`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_DRIVERS_LICENSE)) {
            $modifiedColumns[':p' . $index++]  = '`drivers_license`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_OVERALL_RATING)) {
            $modifiedColumns[':p' . $index++]  = '`overall_rating`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = '`last_login`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_REGISTERED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`registered_at`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOCATION_LAT)) {
            $modifiedColumns[':p' . $index++]  = '`last_location_lat`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOCATION_LNG)) {
            $modifiedColumns[':p' . $index++]  = '`last_location_lng`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOCATION_DATETIME)) {
            $modifiedColumns[':p' . $index++]  = '`last_location_datetime`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOCATION_LOCALITY)) {
            $modifiedColumns[':p' . $index++]  = '`last_location_locality`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOCATION_REGION)) {
            $modifiedColumns[':p' . $index++]  = '`last_location_region`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOCATION_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`last_location_country`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_TIMEZONE)) {
            $modifiedColumns[':p' . $index++]  = '`timezone`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_TRAVELING)) {
            $modifiedColumns[':p' . $index++]  = '`traveling`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_VERIFIED)) {
            $modifiedColumns[':p' . $index++]  = '`verified`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PWD_RESET_CODE)) {
            $modifiedColumns[':p' . $index++]  = '`pwd_reset_code`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_COMMISSION)) {
            $modifiedColumns[':p' . $index++]  = '`commission`';
        }
        if ($this->isColumnModified(UsersTableMap::COL_DISABLED)) {
            $modifiedColumns[':p' . $index++]  = '`disabled`';
        }

        $sql = sprintf(
            'INSERT INTO `users` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`id_company`':
                        $stmt->bindValue($identifier, $this->id_company, PDO::PARAM_INT);
                        break;
                    case '`avatar`':
                        $stmt->bindValue($identifier, $this->avatar, PDO::PARAM_STR);
                        break;
                    case '`fullname`':
                        $stmt->bindValue($identifier, $this->fullname, PDO::PARAM_STR);
                        break;
                    case '`first_name`':
                        $stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);
                        break;
                    case '`last_name`':
                        $stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);
                        break;
                    case '`password`':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`country`':
                        $stmt->bindValue($identifier, $this->country, PDO::PARAM_STR);
                        break;
                    case '`country_code`':
                        $stmt->bindValue($identifier, $this->country_code, PDO::PARAM_STR);
                        break;
                    case '`home_address`':
                        $stmt->bindValue($identifier, $this->home_address, PDO::PARAM_STR);
                        break;
                    case '`providence_code`':
                        $stmt->bindValue($identifier, $this->providence_code, PDO::PARAM_STR);
                        break;
                    case '`providence`':
                        $stmt->bindValue($identifier, $this->providence, PDO::PARAM_STR);
                        break;
                    case '`locality_code`':
                        $stmt->bindValue($identifier, $this->locality_code, PDO::PARAM_STR);
                        break;
                    case '`locality`':
                        $stmt->bindValue($identifier, $this->locality, PDO::PARAM_STR);
                        break;
                    case '`postal_code`':
                        $stmt->bindValue($identifier, $this->postal_code, PDO::PARAM_STR);
                        break;
                    case '`dni`':
                        $stmt->bindValue($identifier, $this->dni, PDO::PARAM_STR);
                        break;
                    case '`dni_front`':
                        $stmt->bindValue($identifier, $this->dni_front, PDO::PARAM_STR);
                        break;
                    case '`dni_back`':
                        $stmt->bindValue($identifier, $this->dni_back, PDO::PARAM_STR);
                        break;
                    case '`phone`':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case '`drivers_license`':
                        $stmt->bindValue($identifier, $this->drivers_license, PDO::PARAM_STR);
                        break;
                    case '`overall_rating`':
                        $stmt->bindValue($identifier, $this->overall_rating, PDO::PARAM_STR);
                        break;
                    case '`last_login`':
                        $stmt->bindValue($identifier, $this->last_login ? $this->last_login->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`registered_at`':
                        $stmt->bindValue($identifier, $this->registered_at ? $this->registered_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`last_location_lat`':
                        $stmt->bindValue($identifier, $this->last_location_lat, PDO::PARAM_STR);
                        break;
                    case '`last_location_lng`':
                        $stmt->bindValue($identifier, $this->last_location_lng, PDO::PARAM_STR);
                        break;
                    case '`last_location_datetime`':
                        $stmt->bindValue($identifier, $this->last_location_datetime ? $this->last_location_datetime->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`last_location_locality`':
                        $stmt->bindValue($identifier, $this->last_location_locality, PDO::PARAM_STR);
                        break;
                    case '`last_location_region`':
                        $stmt->bindValue($identifier, $this->last_location_region, PDO::PARAM_STR);
                        break;
                    case '`last_location_country`':
                        $stmt->bindValue($identifier, $this->last_location_country, PDO::PARAM_STR);
                        break;
                    case '`timezone`':
                        $stmt->bindValue($identifier, $this->timezone, PDO::PARAM_STR);
                        break;
                    case '`traveling`':
                        $stmt->bindValue($identifier, (int) $this->traveling, PDO::PARAM_INT);
                        break;
                    case '`verified`':
                        $stmt->bindValue($identifier, (int) $this->verified, PDO::PARAM_INT);
                        break;
                    case '`pwd_reset_code`':
                        $stmt->bindValue($identifier, $this->pwd_reset_code, PDO::PARAM_STR);
                        break;
                    case '`commission`':
                        $stmt->bindValue($identifier, $this->commission, PDO::PARAM_INT);
                        break;
                    case '`disabled`':
                        $stmt->bindValue($identifier, (int) $this->disabled, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getIdCompany();
                break;
            case 2:
                return $this->getAvatar();
                break;
            case 3:
                return $this->getFullname();
                break;
            case 4:
                return $this->getFirstName();
                break;
            case 5:
                return $this->getLastName();
                break;
            case 6:
                return $this->getPassword();
                break;
            case 7:
                return $this->getEmail();
                break;
            case 8:
                return $this->getCountry();
                break;
            case 9:
                return $this->getCountryCode();
                break;
            case 10:
                return $this->getHomeAddress();
                break;
            case 11:
                return $this->getProvidenceCode();
                break;
            case 12:
                return $this->getProvidence();
                break;
            case 13:
                return $this->getLocalityCode();
                break;
            case 14:
                return $this->getLocality();
                break;
            case 15:
                return $this->getPostalCode();
                break;
            case 16:
                return $this->getDni();
                break;
            case 17:
                return $this->getDniFront();
                break;
            case 18:
                return $this->getDniBack();
                break;
            case 19:
                return $this->getPhone();
                break;
            case 20:
                return $this->getDriversLicense();
                break;
            case 21:
                return $this->getOverallRating();
                break;
            case 22:
                return $this->getLastLogin();
                break;
            case 23:
                return $this->getRegisteredAt();
                break;
            case 24:
                return $this->getUpdatedAt();
                break;
            case 25:
                return $this->getLastLocationLat();
                break;
            case 26:
                return $this->getLastLocationLng();
                break;
            case 27:
                return $this->getLastLocationDatetime();
                break;
            case 28:
                return $this->getLastLocationLocality();
                break;
            case 29:
                return $this->getLastLocationRegion();
                break;
            case 30:
                return $this->getLastLocationCountry();
                break;
            case 31:
                return $this->getTimezone();
                break;
            case 32:
                return $this->getTraveling();
                break;
            case 33:
                return $this->getVerified();
                break;
            case 34:
                return $this->getPwdResetCode();
                break;
            case 35:
                return $this->getCommission();
                break;
            case 36:
                return $this->getDisabled();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['Users'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Users'][$this->hashCode()] = true;
        $keys = UsersTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdCompany(),
            $keys[2] => $this->getAvatar(),
            $keys[3] => $this->getFullname(),
            $keys[4] => $this->getFirstName(),
            $keys[5] => $this->getLastName(),
            $keys[6] => $this->getPassword(),
            $keys[7] => $this->getEmail(),
            $keys[8] => $this->getCountry(),
            $keys[9] => $this->getCountryCode(),
            $keys[10] => $this->getHomeAddress(),
            $keys[11] => $this->getProvidenceCode(),
            $keys[12] => $this->getProvidence(),
            $keys[13] => $this->getLocalityCode(),
            $keys[14] => $this->getLocality(),
            $keys[15] => $this->getPostalCode(),
            $keys[16] => $this->getDni(),
            $keys[17] => $this->getDniFront(),
            $keys[18] => $this->getDniBack(),
            $keys[19] => $this->getPhone(),
            $keys[20] => $this->getDriversLicense(),
            $keys[21] => $this->getOverallRating(),
            $keys[22] => $this->getLastLogin(),
            $keys[23] => $this->getRegisteredAt(),
            $keys[24] => $this->getUpdatedAt(),
            $keys[25] => $this->getLastLocationLat(),
            $keys[26] => $this->getLastLocationLng(),
            $keys[27] => $this->getLastLocationDatetime(),
            $keys[28] => $this->getLastLocationLocality(),
            $keys[29] => $this->getLastLocationRegion(),
            $keys[30] => $this->getLastLocationCountry(),
            $keys[31] => $this->getTimezone(),
            $keys[32] => $this->getTraveling(),
            $keys[33] => $this->getVerified(),
            $keys[34] => $this->getPwdResetCode(),
            $keys[35] => $this->getCommission(),
            $keys[36] => $this->getDisabled(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[22]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[22]];
            $result[$keys[22]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[23]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[23]];
            $result[$keys[23]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[24]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[24]];
            $result[$keys[24]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[27]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[27]];
            $result[$keys[27]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Users
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Users
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdCompany($value);
                break;
            case 2:
                $this->setAvatar($value);
                break;
            case 3:
                $this->setFullname($value);
                break;
            case 4:
                $this->setFirstName($value);
                break;
            case 5:
                $this->setLastName($value);
                break;
            case 6:
                $this->setPassword($value);
                break;
            case 7:
                $this->setEmail($value);
                break;
            case 8:
                $this->setCountry($value);
                break;
            case 9:
                $this->setCountryCode($value);
                break;
            case 10:
                $this->setHomeAddress($value);
                break;
            case 11:
                $this->setProvidenceCode($value);
                break;
            case 12:
                $this->setProvidence($value);
                break;
            case 13:
                $this->setLocalityCode($value);
                break;
            case 14:
                $this->setLocality($value);
                break;
            case 15:
                $this->setPostalCode($value);
                break;
            case 16:
                $this->setDni($value);
                break;
            case 17:
                $this->setDniFront($value);
                break;
            case 18:
                $this->setDniBack($value);
                break;
            case 19:
                $this->setPhone($value);
                break;
            case 20:
                $this->setDriversLicense($value);
                break;
            case 21:
                $this->setOverallRating($value);
                break;
            case 22:
                $this->setLastLogin($value);
                break;
            case 23:
                $this->setRegisteredAt($value);
                break;
            case 24:
                $this->setUpdatedAt($value);
                break;
            case 25:
                $this->setLastLocationLat($value);
                break;
            case 26:
                $this->setLastLocationLng($value);
                break;
            case 27:
                $this->setLastLocationDatetime($value);
                break;
            case 28:
                $this->setLastLocationLocality($value);
                break;
            case 29:
                $this->setLastLocationRegion($value);
                break;
            case 30:
                $this->setLastLocationCountry($value);
                break;
            case 31:
                $this->setTimezone($value);
                break;
            case 32:
                $this->setTraveling($value);
                break;
            case 33:
                $this->setVerified($value);
                break;
            case 34:
                $this->setPwdResetCode($value);
                break;
            case 35:
                $this->setCommission($value);
                break;
            case 36:
                $this->setDisabled($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = UsersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdCompany($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAvatar($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setFullname($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFirstName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setLastName($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPassword($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setEmail($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCountry($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCountryCode($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setHomeAddress($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setProvidenceCode($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setProvidence($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setLocalityCode($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setLocality($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setPostalCode($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setDni($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setDniFront($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setDniBack($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setPhone($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setDriversLicense($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setOverallRating($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setLastLogin($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setRegisteredAt($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setUpdatedAt($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setLastLocationLat($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setLastLocationLng($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setLastLocationDatetime($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setLastLocationLocality($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setLastLocationRegion($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setLastLocationCountry($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setTimezone($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setTraveling($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setVerified($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setPwdResetCode($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setCommission($arr[$keys[35]]);
        }
        if (array_key_exists($keys[36], $arr)) {
            $this->setDisabled($arr[$keys[36]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Users The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UsersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsersTableMap::COL_ID)) {
            $criteria->add(UsersTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UsersTableMap::COL_ID_COMPANY)) {
            $criteria->add(UsersTableMap::COL_ID_COMPANY, $this->id_company);
        }
        if ($this->isColumnModified(UsersTableMap::COL_AVATAR)) {
            $criteria->add(UsersTableMap::COL_AVATAR, $this->avatar);
        }
        if ($this->isColumnModified(UsersTableMap::COL_FULLNAME)) {
            $criteria->add(UsersTableMap::COL_FULLNAME, $this->fullname);
        }
        if ($this->isColumnModified(UsersTableMap::COL_FIRST_NAME)) {
            $criteria->add(UsersTableMap::COL_FIRST_NAME, $this->first_name);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_NAME)) {
            $criteria->add(UsersTableMap::COL_LAST_NAME, $this->last_name);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $criteria->add(UsersTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(UsersTableMap::COL_EMAIL)) {
            $criteria->add(UsersTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UsersTableMap::COL_COUNTRY)) {
            $criteria->add(UsersTableMap::COL_COUNTRY, $this->country);
        }
        if ($this->isColumnModified(UsersTableMap::COL_COUNTRY_CODE)) {
            $criteria->add(UsersTableMap::COL_COUNTRY_CODE, $this->country_code);
        }
        if ($this->isColumnModified(UsersTableMap::COL_HOME_ADDRESS)) {
            $criteria->add(UsersTableMap::COL_HOME_ADDRESS, $this->home_address);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PROVIDENCE_CODE)) {
            $criteria->add(UsersTableMap::COL_PROVIDENCE_CODE, $this->providence_code);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PROVIDENCE)) {
            $criteria->add(UsersTableMap::COL_PROVIDENCE, $this->providence);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LOCALITY_CODE)) {
            $criteria->add(UsersTableMap::COL_LOCALITY_CODE, $this->locality_code);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LOCALITY)) {
            $criteria->add(UsersTableMap::COL_LOCALITY, $this->locality);
        }
        if ($this->isColumnModified(UsersTableMap::COL_POSTAL_CODE)) {
            $criteria->add(UsersTableMap::COL_POSTAL_CODE, $this->postal_code);
        }
        if ($this->isColumnModified(UsersTableMap::COL_DNI)) {
            $criteria->add(UsersTableMap::COL_DNI, $this->dni);
        }
        if ($this->isColumnModified(UsersTableMap::COL_DNI_FRONT)) {
            $criteria->add(UsersTableMap::COL_DNI_FRONT, $this->dni_front);
        }
        if ($this->isColumnModified(UsersTableMap::COL_DNI_BACK)) {
            $criteria->add(UsersTableMap::COL_DNI_BACK, $this->dni_back);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PHONE)) {
            $criteria->add(UsersTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(UsersTableMap::COL_DRIVERS_LICENSE)) {
            $criteria->add(UsersTableMap::COL_DRIVERS_LICENSE, $this->drivers_license);
        }
        if ($this->isColumnModified(UsersTableMap::COL_OVERALL_RATING)) {
            $criteria->add(UsersTableMap::COL_OVERALL_RATING, $this->overall_rating);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOGIN)) {
            $criteria->add(UsersTableMap::COL_LAST_LOGIN, $this->last_login);
        }
        if ($this->isColumnModified(UsersTableMap::COL_REGISTERED_AT)) {
            $criteria->add(UsersTableMap::COL_REGISTERED_AT, $this->registered_at);
        }
        if ($this->isColumnModified(UsersTableMap::COL_UPDATED_AT)) {
            $criteria->add(UsersTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOCATION_LAT)) {
            $criteria->add(UsersTableMap::COL_LAST_LOCATION_LAT, $this->last_location_lat);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOCATION_LNG)) {
            $criteria->add(UsersTableMap::COL_LAST_LOCATION_LNG, $this->last_location_lng);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOCATION_DATETIME)) {
            $criteria->add(UsersTableMap::COL_LAST_LOCATION_DATETIME, $this->last_location_datetime);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOCATION_LOCALITY)) {
            $criteria->add(UsersTableMap::COL_LAST_LOCATION_LOCALITY, $this->last_location_locality);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOCATION_REGION)) {
            $criteria->add(UsersTableMap::COL_LAST_LOCATION_REGION, $this->last_location_region);
        }
        if ($this->isColumnModified(UsersTableMap::COL_LAST_LOCATION_COUNTRY)) {
            $criteria->add(UsersTableMap::COL_LAST_LOCATION_COUNTRY, $this->last_location_country);
        }
        if ($this->isColumnModified(UsersTableMap::COL_TIMEZONE)) {
            $criteria->add(UsersTableMap::COL_TIMEZONE, $this->timezone);
        }
        if ($this->isColumnModified(UsersTableMap::COL_TRAVELING)) {
            $criteria->add(UsersTableMap::COL_TRAVELING, $this->traveling);
        }
        if ($this->isColumnModified(UsersTableMap::COL_VERIFIED)) {
            $criteria->add(UsersTableMap::COL_VERIFIED, $this->verified);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PWD_RESET_CODE)) {
            $criteria->add(UsersTableMap::COL_PWD_RESET_CODE, $this->pwd_reset_code);
        }
        if ($this->isColumnModified(UsersTableMap::COL_COMMISSION)) {
            $criteria->add(UsersTableMap::COL_COMMISSION, $this->commission);
        }
        if ($this->isColumnModified(UsersTableMap::COL_DISABLED)) {
            $criteria->add(UsersTableMap::COL_DISABLED, $this->disabled);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildUsersQuery::create();
        $criteria->add(UsersTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Users (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdCompany($this->getIdCompany());
        $copyObj->setAvatar($this->getAvatar());
        $copyObj->setFullname($this->getFullname());
        $copyObj->setFirstName($this->getFirstName());
        $copyObj->setLastName($this->getLastName());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setCountry($this->getCountry());
        $copyObj->setCountryCode($this->getCountryCode());
        $copyObj->setHomeAddress($this->getHomeAddress());
        $copyObj->setProvidenceCode($this->getProvidenceCode());
        $copyObj->setProvidence($this->getProvidence());
        $copyObj->setLocalityCode($this->getLocalityCode());
        $copyObj->setLocality($this->getLocality());
        $copyObj->setPostalCode($this->getPostalCode());
        $copyObj->setDni($this->getDni());
        $copyObj->setDniFront($this->getDniFront());
        $copyObj->setDniBack($this->getDniBack());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setDriversLicense($this->getDriversLicense());
        $copyObj->setOverallRating($this->getOverallRating());
        $copyObj->setLastLogin($this->getLastLogin());
        $copyObj->setRegisteredAt($this->getRegisteredAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setLastLocationLat($this->getLastLocationLat());
        $copyObj->setLastLocationLng($this->getLastLocationLng());
        $copyObj->setLastLocationDatetime($this->getLastLocationDatetime());
        $copyObj->setLastLocationLocality($this->getLastLocationLocality());
        $copyObj->setLastLocationRegion($this->getLastLocationRegion());
        $copyObj->setLastLocationCountry($this->getLastLocationCountry());
        $copyObj->setTimezone($this->getTimezone());
        $copyObj->setTraveling($this->getTraveling());
        $copyObj->setVerified($this->getVerified());
        $copyObj->setPwdResetCode($this->getPwdResetCode());
        $copyObj->setCommission($this->getCommission());
        $copyObj->setDisabled($this->getDisabled());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Users Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->id_company = null;
        $this->avatar = null;
        $this->fullname = null;
        $this->first_name = null;
        $this->last_name = null;
        $this->password = null;
        $this->email = null;
        $this->country = null;
        $this->country_code = null;
        $this->home_address = null;
        $this->providence_code = null;
        $this->providence = null;
        $this->locality_code = null;
        $this->locality = null;
        $this->postal_code = null;
        $this->dni = null;
        $this->dni_front = null;
        $this->dni_back = null;
        $this->phone = null;
        $this->drivers_license = null;
        $this->overall_rating = null;
        $this->last_login = null;
        $this->registered_at = null;
        $this->updated_at = null;
        $this->last_location_lat = null;
        $this->last_location_lng = null;
        $this->last_location_datetime = null;
        $this->last_location_locality = null;
        $this->last_location_region = null;
        $this->last_location_country = null;
        $this->timezone = null;
        $this->traveling = null;
        $this->verified = null;
        $this->pwd_reset_code = null;
        $this->commission = null;
        $this->disabled = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsersTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
