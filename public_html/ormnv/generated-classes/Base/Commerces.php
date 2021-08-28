<?php

namespace Base;

use \Commerces as ChildCommerces;
use \CommercesBranchOffices as ChildCommercesBranchOffices;
use \CommercesBranchOfficesQuery as ChildCommercesBranchOfficesQuery;
use \CommercesPreferences as ChildCommercesPreferences;
use \CommercesPreferencesQuery as ChildCommercesPreferencesQuery;
use \CommercesQuery as ChildCommercesQuery;
use \CommercesRates as ChildCommercesRates;
use \CommercesRatesQuery as ChildCommercesRatesQuery;
use \CommercesReminders as ChildCommercesReminders;
use \CommercesRemindersQuery as ChildCommercesRemindersQuery;
use \HeadingsCommerce as ChildHeadingsCommerce;
use \HeadingsCommerceQuery as ChildHeadingsCommerceQuery;
use \PositionsCommerce as ChildPositionsCommerce;
use \PositionsCommerceQuery as ChildPositionsCommerceQuery;
use \Provinces as ChildProvinces;
use \ProvincesLocalities as ChildProvincesLocalities;
use \ProvincesLocalitiesQuery as ChildProvincesLocalitiesQuery;
use \ProvincesQuery as ChildProvincesQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\CommercesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'commerces' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Commerces implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\CommercesTableMap';


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
     * The value for the id_user field.
     * @var        int
     */
    protected $id_user;

    /**
     * The value for the id_position_commerce field.
     * @var        int
     */
    protected $id_position_commerce;

    /**
     * The value for the id_heading_commerce field.
     * @var        int
     */
    protected $id_heading_commerce;

    /**
     * The value for the id_province field.
     * @var        int
     */
    protected $id_province;

    /**
     * The value for the id_locality field.
     * @var        int
     */
    protected $id_locality;

    /**
     * The value for the token field.
     * @var        string
     */
    protected $token;

    /**
     * The value for the logo field.
     * @var        string
     */
    protected $logo;

    /**
     * The value for the business_name field.
     * @var        string
     */
    protected $business_name;

    /**
     * The value for the cuit_cuil field.
     * @var        string
     */
    protected $cuit_cuil;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the phone field.
     * @var        string
     */
    protected $phone;

    /**
     * The value for the phone_personal field.
     * @var        string
     */
    protected $phone_personal;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the password field.
     * @var        string
     */
    protected $password;

    /**
     * The value for the address field.
     * @var        string
     */
    protected $address;

    /**
     * The value for the address_lat field.
     * @var        string
     */
    protected $address_lat;

    /**
     * The value for the address_lng field.
     * @var        string
     */
    protected $address_lng;

    /**
     * The value for the address_locality field.
     * @var        string
     */
    protected $address_locality;

    /**
     * The value for the address_region field.
     * @var        string
     */
    protected $address_region;

    /**
     * The value for the address_country field.
     * @var        string
     */
    protected $address_country;

    /**
     * The value for the updated_at field.
     * @var        \DateTime
     */
    protected $updated_at;

    /**
     * @var        ChildPositionsCommerce
     */
    protected $aPositionsCommerce;

    /**
     * @var        ChildHeadingsCommerce
     */
    protected $aHeadingsCommerce;

    /**
     * @var        ChildProvinces
     */
    protected $aProvinces;

    /**
     * @var        ChildProvincesLocalities
     */
    protected $aProvincesLocalities;

    /**
     * @var        ObjectCollection|ChildCommercesBranchOffices[] Collection to store aggregation of ChildCommercesBranchOffices objects.
     */
    protected $collCommercesBranchOfficess;
    protected $collCommercesBranchOfficessPartial;

    /**
     * @var        ObjectCollection|ChildCommercesPreferences[] Collection to store aggregation of ChildCommercesPreferences objects.
     */
    protected $collCommercesPreferencess;
    protected $collCommercesPreferencessPartial;

    /**
     * @var        ObjectCollection|ChildCommercesRates[] Collection to store aggregation of ChildCommercesRates objects.
     */
    protected $collCommercesRatess;
    protected $collCommercesRatessPartial;

    /**
     * @var        ObjectCollection|ChildCommercesReminders[] Collection to store aggregation of ChildCommercesReminders objects.
     */
    protected $collCommercesReminderss;
    protected $collCommercesReminderssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCommercesBranchOffices[]
     */
    protected $commercesBranchOfficessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCommercesPreferences[]
     */
    protected $commercesPreferencessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCommercesRates[]
     */
    protected $commercesRatessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCommercesReminders[]
     */
    protected $commercesReminderssScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Commerces object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>Commerces</code> instance.  If
     * <code>obj</code> is an instance of <code>Commerces</code>, delegates to
     * <code>equals(Commerces)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Commerces The current object, for fluid interface
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
     * Get the [id_user] column value.
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Get the [id_position_commerce] column value.
     *
     * @return int
     */
    public function getIdPositionCommerce()
    {
        return $this->id_position_commerce;
    }

    /**
     * Get the [id_heading_commerce] column value.
     *
     * @return int
     */
    public function getIdHeadingCommerce()
    {
        return $this->id_heading_commerce;
    }

    /**
     * Get the [id_province] column value.
     *
     * @return int
     */
    public function getIdProvince()
    {
        return $this->id_province;
    }

    /**
     * Get the [id_locality] column value.
     *
     * @return int
     */
    public function getIdLocality()
    {
        return $this->id_locality;
    }

    /**
     * Get the [token] column value.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Get the [logo] column value.
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Get the [business_name] column value.
     *
     * @return string
     */
    public function getBusinessName()
    {
        return $this->business_name;
    }

    /**
     * Get the [cuit_cuil] column value.
     *
     * @return string
     */
    public function getCuitCuil()
    {
        return $this->cuit_cuil;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Get the [phone_personal] column value.
     *
     * @return string
     */
    public function getPhonePersonal()
    {
        return $this->phone_personal;
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
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [address] column value.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [address_lat] column value.
     *
     * @return string
     */
    public function getAddressLat()
    {
        return $this->address_lat;
    }

    /**
     * Get the [address_lng] column value.
     *
     * @return string
     */
    public function getAddressLng()
    {
        return $this->address_lng;
    }

    /**
     * Get the [address_locality] column value.
     *
     * @return string
     */
    public function getAddressLocality()
    {
        return $this->address_locality;
    }

    /**
     * Get the [address_region] column value.
     *
     * @return string
     */
    public function getAddressRegion()
    {
        return $this->address_region;
    }

    /**
     * Get the [address_country] column value.
     *
     * @return string
     */
    public function getAddressCountry()
    {
        return $this->address_country;
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
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[CommercesTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_user] column.
     *
     * @param int $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setIdUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_user !== $v) {
            $this->id_user = $v;
            $this->modifiedColumns[CommercesTableMap::COL_ID_USER] = true;
        }

        return $this;
    } // setIdUser()

    /**
     * Set the value of [id_position_commerce] column.
     *
     * @param int $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setIdPositionCommerce($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_position_commerce !== $v) {
            $this->id_position_commerce = $v;
            $this->modifiedColumns[CommercesTableMap::COL_ID_POSITION_COMMERCE] = true;
        }

        if ($this->aPositionsCommerce !== null && $this->aPositionsCommerce->getId() !== $v) {
            $this->aPositionsCommerce = null;
        }

        return $this;
    } // setIdPositionCommerce()

    /**
     * Set the value of [id_heading_commerce] column.
     *
     * @param int $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setIdHeadingCommerce($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_heading_commerce !== $v) {
            $this->id_heading_commerce = $v;
            $this->modifiedColumns[CommercesTableMap::COL_ID_HEADING_COMMERCE] = true;
        }

        if ($this->aHeadingsCommerce !== null && $this->aHeadingsCommerce->getId() !== $v) {
            $this->aHeadingsCommerce = null;
        }

        return $this;
    } // setIdHeadingCommerce()

    /**
     * Set the value of [id_province] column.
     *
     * @param int $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setIdProvince($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_province !== $v) {
            $this->id_province = $v;
            $this->modifiedColumns[CommercesTableMap::COL_ID_PROVINCE] = true;
        }

        if ($this->aProvinces !== null && $this->aProvinces->getId() !== $v) {
            $this->aProvinces = null;
        }

        return $this;
    } // setIdProvince()

    /**
     * Set the value of [id_locality] column.
     *
     * @param int $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setIdLocality($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_locality !== $v) {
            $this->id_locality = $v;
            $this->modifiedColumns[CommercesTableMap::COL_ID_LOCALITY] = true;
        }

        if ($this->aProvincesLocalities !== null && $this->aProvincesLocalities->getId() !== $v) {
            $this->aProvincesLocalities = null;
        }

        return $this;
    } // setIdLocality()

    /**
     * Set the value of [token] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setToken($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->token !== $v) {
            $this->token = $v;
            $this->modifiedColumns[CommercesTableMap::COL_TOKEN] = true;
        }

        return $this;
    } // setToken()

    /**
     * Set the value of [logo] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setLogo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->logo !== $v) {
            $this->logo = $v;
            $this->modifiedColumns[CommercesTableMap::COL_LOGO] = true;
        }

        return $this;
    } // setLogo()

    /**
     * Set the value of [business_name] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setBusinessName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->business_name !== $v) {
            $this->business_name = $v;
            $this->modifiedColumns[CommercesTableMap::COL_BUSINESS_NAME] = true;
        }

        return $this;
    } // setBusinessName()

    /**
     * Set the value of [cuit_cuil] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setCuitCuil($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cuit_cuil !== $v) {
            $this->cuit_cuil = $v;
            $this->modifiedColumns[CommercesTableMap::COL_CUIT_CUIL] = true;
        }

        return $this;
    } // setCuitCuil()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[CommercesTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [phone] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[CommercesTableMap::COL_PHONE] = true;
        }

        return $this;
    } // setPhone()

    /**
     * Set the value of [phone_personal] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setPhonePersonal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone_personal !== $v) {
            $this->phone_personal = $v;
            $this->modifiedColumns[CommercesTableMap::COL_PHONE_PERSONAL] = true;
        }

        return $this;
    } // setPhonePersonal()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[CommercesTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [password] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[CommercesTableMap::COL_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[CommercesTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Set the value of [address_lat] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setAddressLat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_lat !== $v) {
            $this->address_lat = $v;
            $this->modifiedColumns[CommercesTableMap::COL_ADDRESS_LAT] = true;
        }

        return $this;
    } // setAddressLat()

    /**
     * Set the value of [address_lng] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setAddressLng($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_lng !== $v) {
            $this->address_lng = $v;
            $this->modifiedColumns[CommercesTableMap::COL_ADDRESS_LNG] = true;
        }

        return $this;
    } // setAddressLng()

    /**
     * Set the value of [address_locality] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setAddressLocality($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_locality !== $v) {
            $this->address_locality = $v;
            $this->modifiedColumns[CommercesTableMap::COL_ADDRESS_LOCALITY] = true;
        }

        return $this;
    } // setAddressLocality()

    /**
     * Set the value of [address_region] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setAddressRegion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_region !== $v) {
            $this->address_region = $v;
            $this->modifiedColumns[CommercesTableMap::COL_ADDRESS_REGION] = true;
        }

        return $this;
    } // setAddressRegion()

    /**
     * Set the value of [address_country] column.
     *
     * @param string $v new value
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setAddressCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_country !== $v) {
            $this->address_country = $v;
            $this->modifiedColumns[CommercesTableMap::COL_ADDRESS_COUNTRY] = true;
        }

        return $this;
    } // setAddressCountry()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CommercesTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CommercesTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CommercesTableMap::translateFieldName('IdUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CommercesTableMap::translateFieldName('IdPositionCommerce', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_position_commerce = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CommercesTableMap::translateFieldName('IdHeadingCommerce', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_heading_commerce = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CommercesTableMap::translateFieldName('IdProvince', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_province = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CommercesTableMap::translateFieldName('IdLocality', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_locality = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CommercesTableMap::translateFieldName('Token', TableMap::TYPE_PHPNAME, $indexType)];
            $this->token = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CommercesTableMap::translateFieldName('Logo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->logo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CommercesTableMap::translateFieldName('BusinessName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->business_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CommercesTableMap::translateFieldName('CuitCuil', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cuit_cuil = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CommercesTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CommercesTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CommercesTableMap::translateFieldName('PhonePersonal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone_personal = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : CommercesTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : CommercesTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : CommercesTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : CommercesTableMap::translateFieldName('AddressLat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_lat = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : CommercesTableMap::translateFieldName('AddressLng', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_lng = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : CommercesTableMap::translateFieldName('AddressLocality', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_locality = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : CommercesTableMap::translateFieldName('AddressRegion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_region = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : CommercesTableMap::translateFieldName('AddressCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : CommercesTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 22; // 22 = CommercesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Commerces'), 0, $e);
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
        if ($this->aPositionsCommerce !== null && $this->id_position_commerce !== $this->aPositionsCommerce->getId()) {
            $this->aPositionsCommerce = null;
        }
        if ($this->aHeadingsCommerce !== null && $this->id_heading_commerce !== $this->aHeadingsCommerce->getId()) {
            $this->aHeadingsCommerce = null;
        }
        if ($this->aProvinces !== null && $this->id_province !== $this->aProvinces->getId()) {
            $this->aProvinces = null;
        }
        if ($this->aProvincesLocalities !== null && $this->id_locality !== $this->aProvincesLocalities->getId()) {
            $this->aProvincesLocalities = null;
        }
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
            $con = Propel::getServiceContainer()->getReadConnection(CommercesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCommercesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPositionsCommerce = null;
            $this->aHeadingsCommerce = null;
            $this->aProvinces = null;
            $this->aProvincesLocalities = null;
            $this->collCommercesBranchOfficess = null;

            $this->collCommercesPreferencess = null;

            $this->collCommercesRatess = null;

            $this->collCommercesReminderss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Commerces::setDeleted()
     * @see Commerces::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCommercesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesTableMap::DATABASE_NAME);
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
                CommercesTableMap::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aPositionsCommerce !== null) {
                if ($this->aPositionsCommerce->isModified() || $this->aPositionsCommerce->isNew()) {
                    $affectedRows += $this->aPositionsCommerce->save($con);
                }
                $this->setPositionsCommerce($this->aPositionsCommerce);
            }

            if ($this->aHeadingsCommerce !== null) {
                if ($this->aHeadingsCommerce->isModified() || $this->aHeadingsCommerce->isNew()) {
                    $affectedRows += $this->aHeadingsCommerce->save($con);
                }
                $this->setHeadingsCommerce($this->aHeadingsCommerce);
            }

            if ($this->aProvinces !== null) {
                if ($this->aProvinces->isModified() || $this->aProvinces->isNew()) {
                    $affectedRows += $this->aProvinces->save($con);
                }
                $this->setProvinces($this->aProvinces);
            }

            if ($this->aProvincesLocalities !== null) {
                if ($this->aProvincesLocalities->isModified() || $this->aProvincesLocalities->isNew()) {
                    $affectedRows += $this->aProvincesLocalities->save($con);
                }
                $this->setProvincesLocalities($this->aProvincesLocalities);
            }

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

            if ($this->commercesBranchOfficessScheduledForDeletion !== null) {
                if (!$this->commercesBranchOfficessScheduledForDeletion->isEmpty()) {
                    foreach ($this->commercesBranchOfficessScheduledForDeletion as $commercesBranchOffices) {
                        // need to save related object because we set the relation to null
                        $commercesBranchOffices->save($con);
                    }
                    $this->commercesBranchOfficessScheduledForDeletion = null;
                }
            }

            if ($this->collCommercesBranchOfficess !== null) {
                foreach ($this->collCommercesBranchOfficess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->commercesPreferencessScheduledForDeletion !== null) {
                if (!$this->commercesPreferencessScheduledForDeletion->isEmpty()) {
                    foreach ($this->commercesPreferencessScheduledForDeletion as $commercesPreferences) {
                        // need to save related object because we set the relation to null
                        $commercesPreferences->save($con);
                    }
                    $this->commercesPreferencessScheduledForDeletion = null;
                }
            }

            if ($this->collCommercesPreferencess !== null) {
                foreach ($this->collCommercesPreferencess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->commercesRatessScheduledForDeletion !== null) {
                if (!$this->commercesRatessScheduledForDeletion->isEmpty()) {
                    foreach ($this->commercesRatessScheduledForDeletion as $commercesRates) {
                        // need to save related object because we set the relation to null
                        $commercesRates->save($con);
                    }
                    $this->commercesRatessScheduledForDeletion = null;
                }
            }

            if ($this->collCommercesRatess !== null) {
                foreach ($this->collCommercesRatess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->commercesReminderssScheduledForDeletion !== null) {
                if (!$this->commercesReminderssScheduledForDeletion->isEmpty()) {
                    foreach ($this->commercesReminderssScheduledForDeletion as $commercesReminders) {
                        // need to save related object because we set the relation to null
                        $commercesReminders->save($con);
                    }
                    $this->commercesReminderssScheduledForDeletion = null;
                }
            }

            if ($this->collCommercesReminderss !== null) {
                foreach ($this->collCommercesReminderss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[CommercesTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CommercesTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CommercesTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ID_USER)) {
            $modifiedColumns[':p' . $index++]  = '`id_user`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ID_POSITION_COMMERCE)) {
            $modifiedColumns[':p' . $index++]  = '`id_position_commerce`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ID_HEADING_COMMERCE)) {
            $modifiedColumns[':p' . $index++]  = '`id_heading_commerce`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ID_PROVINCE)) {
            $modifiedColumns[':p' . $index++]  = '`id_province`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ID_LOCALITY)) {
            $modifiedColumns[':p' . $index++]  = '`id_locality`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_TOKEN)) {
            $modifiedColumns[':p' . $index++]  = '`token`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_LOGO)) {
            $modifiedColumns[':p' . $index++]  = '`logo`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_BUSINESS_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`business_name`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_CUIT_CUIL)) {
            $modifiedColumns[':p' . $index++]  = '`cuit_cuil`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = '`phone`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_PHONE_PERSONAL)) {
            $modifiedColumns[':p' . $index++]  = '`phone_personal`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = '`password`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`address`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ADDRESS_LAT)) {
            $modifiedColumns[':p' . $index++]  = '`address_lat`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ADDRESS_LNG)) {
            $modifiedColumns[':p' . $index++]  = '`address_lng`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ADDRESS_LOCALITY)) {
            $modifiedColumns[':p' . $index++]  = '`address_locality`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ADDRESS_REGION)) {
            $modifiedColumns[':p' . $index++]  = '`address_region`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ADDRESS_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`address_country`';
        }
        if ($this->isColumnModified(CommercesTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `commerces` (%s) VALUES (%s)',
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
                    case '`id_user`':
                        $stmt->bindValue($identifier, $this->id_user, PDO::PARAM_INT);
                        break;
                    case '`id_position_commerce`':
                        $stmt->bindValue($identifier, $this->id_position_commerce, PDO::PARAM_INT);
                        break;
                    case '`id_heading_commerce`':
                        $stmt->bindValue($identifier, $this->id_heading_commerce, PDO::PARAM_INT);
                        break;
                    case '`id_province`':
                        $stmt->bindValue($identifier, $this->id_province, PDO::PARAM_INT);
                        break;
                    case '`id_locality`':
                        $stmt->bindValue($identifier, $this->id_locality, PDO::PARAM_INT);
                        break;
                    case '`token`':
                        $stmt->bindValue($identifier, $this->token, PDO::PARAM_STR);
                        break;
                    case '`logo`':
                        $stmt->bindValue($identifier, $this->logo, PDO::PARAM_STR);
                        break;
                    case '`business_name`':
                        $stmt->bindValue($identifier, $this->business_name, PDO::PARAM_STR);
                        break;
                    case '`cuit_cuil`':
                        $stmt->bindValue($identifier, $this->cuit_cuil, PDO::PARAM_STR);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`phone`':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case '`phone_personal`':
                        $stmt->bindValue($identifier, $this->phone_personal, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`password`':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case '`address`':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case '`address_lat`':
                        $stmt->bindValue($identifier, $this->address_lat, PDO::PARAM_STR);
                        break;
                    case '`address_lng`':
                        $stmt->bindValue($identifier, $this->address_lng, PDO::PARAM_STR);
                        break;
                    case '`address_locality`':
                        $stmt->bindValue($identifier, $this->address_locality, PDO::PARAM_STR);
                        break;
                    case '`address_region`':
                        $stmt->bindValue($identifier, $this->address_region, PDO::PARAM_STR);
                        break;
                    case '`address_country`':
                        $stmt->bindValue($identifier, $this->address_country, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
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
        $pos = CommercesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdUser();
                break;
            case 2:
                return $this->getIdPositionCommerce();
                break;
            case 3:
                return $this->getIdHeadingCommerce();
                break;
            case 4:
                return $this->getIdProvince();
                break;
            case 5:
                return $this->getIdLocality();
                break;
            case 6:
                return $this->getToken();
                break;
            case 7:
                return $this->getLogo();
                break;
            case 8:
                return $this->getBusinessName();
                break;
            case 9:
                return $this->getCuitCuil();
                break;
            case 10:
                return $this->getName();
                break;
            case 11:
                return $this->getPhone();
                break;
            case 12:
                return $this->getPhonePersonal();
                break;
            case 13:
                return $this->getEmail();
                break;
            case 14:
                return $this->getPassword();
                break;
            case 15:
                return $this->getAddress();
                break;
            case 16:
                return $this->getAddressLat();
                break;
            case 17:
                return $this->getAddressLng();
                break;
            case 18:
                return $this->getAddressLocality();
                break;
            case 19:
                return $this->getAddressRegion();
                break;
            case 20:
                return $this->getAddressCountry();
                break;
            case 21:
                return $this->getUpdatedAt();
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
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Commerces'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Commerces'][$this->hashCode()] = true;
        $keys = CommercesTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdUser(),
            $keys[2] => $this->getIdPositionCommerce(),
            $keys[3] => $this->getIdHeadingCommerce(),
            $keys[4] => $this->getIdProvince(),
            $keys[5] => $this->getIdLocality(),
            $keys[6] => $this->getToken(),
            $keys[7] => $this->getLogo(),
            $keys[8] => $this->getBusinessName(),
            $keys[9] => $this->getCuitCuil(),
            $keys[10] => $this->getName(),
            $keys[11] => $this->getPhone(),
            $keys[12] => $this->getPhonePersonal(),
            $keys[13] => $this->getEmail(),
            $keys[14] => $this->getPassword(),
            $keys[15] => $this->getAddress(),
            $keys[16] => $this->getAddressLat(),
            $keys[17] => $this->getAddressLng(),
            $keys[18] => $this->getAddressLocality(),
            $keys[19] => $this->getAddressRegion(),
            $keys[20] => $this->getAddressCountry(),
            $keys[21] => $this->getUpdatedAt(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[21]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[21]];
            $result[$keys[21]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aPositionsCommerce) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'positionsCommerce';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'positions_commerce';
                        break;
                    default:
                        $key = 'PositionsCommerce';
                }

                $result[$key] = $this->aPositionsCommerce->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aHeadingsCommerce) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'headingsCommerce';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'headings_commerce';
                        break;
                    default:
                        $key = 'HeadingsCommerce';
                }

                $result[$key] = $this->aHeadingsCommerce->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProvinces) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'provinces';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'provinces';
                        break;
                    default:
                        $key = 'Provinces';
                }

                $result[$key] = $this->aProvinces->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProvincesLocalities) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'provincesLocalities';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'provinces_localities';
                        break;
                    default:
                        $key = 'ProvincesLocalities';
                }

                $result[$key] = $this->aProvincesLocalities->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collCommercesBranchOfficess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'commercesBranchOfficess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'commerces_branch_officess';
                        break;
                    default:
                        $key = 'CommercesBranchOfficess';
                }

                $result[$key] = $this->collCommercesBranchOfficess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCommercesPreferencess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'commercesPreferencess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'commerces_preferencess';
                        break;
                    default:
                        $key = 'CommercesPreferencess';
                }

                $result[$key] = $this->collCommercesPreferencess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCommercesRatess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'commercesRatess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'commerces_ratess';
                        break;
                    default:
                        $key = 'CommercesRatess';
                }

                $result[$key] = $this->collCommercesRatess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCommercesReminderss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'commercesReminderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'commerces_reminderss';
                        break;
                    default:
                        $key = 'CommercesReminderss';
                }

                $result[$key] = $this->collCommercesReminderss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
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
     * @return $this|\Commerces
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CommercesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Commerces
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdUser($value);
                break;
            case 2:
                $this->setIdPositionCommerce($value);
                break;
            case 3:
                $this->setIdHeadingCommerce($value);
                break;
            case 4:
                $this->setIdProvince($value);
                break;
            case 5:
                $this->setIdLocality($value);
                break;
            case 6:
                $this->setToken($value);
                break;
            case 7:
                $this->setLogo($value);
                break;
            case 8:
                $this->setBusinessName($value);
                break;
            case 9:
                $this->setCuitCuil($value);
                break;
            case 10:
                $this->setName($value);
                break;
            case 11:
                $this->setPhone($value);
                break;
            case 12:
                $this->setPhonePersonal($value);
                break;
            case 13:
                $this->setEmail($value);
                break;
            case 14:
                $this->setPassword($value);
                break;
            case 15:
                $this->setAddress($value);
                break;
            case 16:
                $this->setAddressLat($value);
                break;
            case 17:
                $this->setAddressLng($value);
                break;
            case 18:
                $this->setAddressLocality($value);
                break;
            case 19:
                $this->setAddressRegion($value);
                break;
            case 20:
                $this->setAddressCountry($value);
                break;
            case 21:
                $this->setUpdatedAt($value);
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
        $keys = CommercesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdUser($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdPositionCommerce($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIdHeadingCommerce($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIdProvince($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIdLocality($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setToken($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLogo($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setBusinessName($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCuitCuil($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setName($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setPhone($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setPhonePersonal($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setEmail($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setPassword($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setAddress($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setAddressLat($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setAddressLng($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setAddressLocality($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setAddressRegion($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setAddressCountry($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setUpdatedAt($arr[$keys[21]]);
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
     * @return $this|\Commerces The current object, for fluid interface
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
        $criteria = new Criteria(CommercesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CommercesTableMap::COL_ID)) {
            $criteria->add(CommercesTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ID_USER)) {
            $criteria->add(CommercesTableMap::COL_ID_USER, $this->id_user);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ID_POSITION_COMMERCE)) {
            $criteria->add(CommercesTableMap::COL_ID_POSITION_COMMERCE, $this->id_position_commerce);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ID_HEADING_COMMERCE)) {
            $criteria->add(CommercesTableMap::COL_ID_HEADING_COMMERCE, $this->id_heading_commerce);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ID_PROVINCE)) {
            $criteria->add(CommercesTableMap::COL_ID_PROVINCE, $this->id_province);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ID_LOCALITY)) {
            $criteria->add(CommercesTableMap::COL_ID_LOCALITY, $this->id_locality);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_TOKEN)) {
            $criteria->add(CommercesTableMap::COL_TOKEN, $this->token);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_LOGO)) {
            $criteria->add(CommercesTableMap::COL_LOGO, $this->logo);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_BUSINESS_NAME)) {
            $criteria->add(CommercesTableMap::COL_BUSINESS_NAME, $this->business_name);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_CUIT_CUIL)) {
            $criteria->add(CommercesTableMap::COL_CUIT_CUIL, $this->cuit_cuil);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_NAME)) {
            $criteria->add(CommercesTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_PHONE)) {
            $criteria->add(CommercesTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_PHONE_PERSONAL)) {
            $criteria->add(CommercesTableMap::COL_PHONE_PERSONAL, $this->phone_personal);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_EMAIL)) {
            $criteria->add(CommercesTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_PASSWORD)) {
            $criteria->add(CommercesTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ADDRESS)) {
            $criteria->add(CommercesTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ADDRESS_LAT)) {
            $criteria->add(CommercesTableMap::COL_ADDRESS_LAT, $this->address_lat);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ADDRESS_LNG)) {
            $criteria->add(CommercesTableMap::COL_ADDRESS_LNG, $this->address_lng);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ADDRESS_LOCALITY)) {
            $criteria->add(CommercesTableMap::COL_ADDRESS_LOCALITY, $this->address_locality);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ADDRESS_REGION)) {
            $criteria->add(CommercesTableMap::COL_ADDRESS_REGION, $this->address_region);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_ADDRESS_COUNTRY)) {
            $criteria->add(CommercesTableMap::COL_ADDRESS_COUNTRY, $this->address_country);
        }
        if ($this->isColumnModified(CommercesTableMap::COL_UPDATED_AT)) {
            $criteria->add(CommercesTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildCommercesQuery::create();
        $criteria->add(CommercesTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Commerces (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdUser($this->getIdUser());
        $copyObj->setIdPositionCommerce($this->getIdPositionCommerce());
        $copyObj->setIdHeadingCommerce($this->getIdHeadingCommerce());
        $copyObj->setIdProvince($this->getIdProvince());
        $copyObj->setIdLocality($this->getIdLocality());
        $copyObj->setToken($this->getToken());
        $copyObj->setLogo($this->getLogo());
        $copyObj->setBusinessName($this->getBusinessName());
        $copyObj->setCuitCuil($this->getCuitCuil());
        $copyObj->setName($this->getName());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setPhonePersonal($this->getPhonePersonal());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setAddressLat($this->getAddressLat());
        $copyObj->setAddressLng($this->getAddressLng());
        $copyObj->setAddressLocality($this->getAddressLocality());
        $copyObj->setAddressRegion($this->getAddressRegion());
        $copyObj->setAddressCountry($this->getAddressCountry());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCommercesBranchOfficess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCommercesBranchOffices($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCommercesPreferencess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCommercesPreferences($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCommercesRatess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCommercesRates($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCommercesReminderss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCommercesReminders($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

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
     * @return \Commerces Clone of current object.
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
     * Declares an association between this object and a ChildPositionsCommerce object.
     *
     * @param  ChildPositionsCommerce $v
     * @return $this|\Commerces The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPositionsCommerce(ChildPositionsCommerce $v = null)
    {
        if ($v === null) {
            $this->setIdPositionCommerce(NULL);
        } else {
            $this->setIdPositionCommerce($v->getId());
        }

        $this->aPositionsCommerce = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPositionsCommerce object, it will not be re-added.
        if ($v !== null) {
            $v->addCommerces($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPositionsCommerce object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPositionsCommerce The associated ChildPositionsCommerce object.
     * @throws PropelException
     */
    public function getPositionsCommerce(ConnectionInterface $con = null)
    {
        if ($this->aPositionsCommerce === null && ($this->id_position_commerce !== null)) {
            $this->aPositionsCommerce = ChildPositionsCommerceQuery::create()->findPk($this->id_position_commerce, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPositionsCommerce->addCommercess($this);
             */
        }

        return $this->aPositionsCommerce;
    }

    /**
     * Declares an association between this object and a ChildHeadingsCommerce object.
     *
     * @param  ChildHeadingsCommerce $v
     * @return $this|\Commerces The current object (for fluent API support)
     * @throws PropelException
     */
    public function setHeadingsCommerce(ChildHeadingsCommerce $v = null)
    {
        if ($v === null) {
            $this->setIdHeadingCommerce(NULL);
        } else {
            $this->setIdHeadingCommerce($v->getId());
        }

        $this->aHeadingsCommerce = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildHeadingsCommerce object, it will not be re-added.
        if ($v !== null) {
            $v->addCommerces($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildHeadingsCommerce object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildHeadingsCommerce The associated ChildHeadingsCommerce object.
     * @throws PropelException
     */
    public function getHeadingsCommerce(ConnectionInterface $con = null)
    {
        if ($this->aHeadingsCommerce === null && ($this->id_heading_commerce !== null)) {
            $this->aHeadingsCommerce = ChildHeadingsCommerceQuery::create()->findPk($this->id_heading_commerce, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aHeadingsCommerce->addCommercess($this);
             */
        }

        return $this->aHeadingsCommerce;
    }

    /**
     * Declares an association between this object and a ChildProvinces object.
     *
     * @param  ChildProvinces $v
     * @return $this|\Commerces The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProvinces(ChildProvinces $v = null)
    {
        if ($v === null) {
            $this->setIdProvince(NULL);
        } else {
            $this->setIdProvince($v->getId());
        }

        $this->aProvinces = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildProvinces object, it will not be re-added.
        if ($v !== null) {
            $v->addCommerces($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildProvinces object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildProvinces The associated ChildProvinces object.
     * @throws PropelException
     */
    public function getProvinces(ConnectionInterface $con = null)
    {
        if ($this->aProvinces === null && ($this->id_province !== null)) {
            $this->aProvinces = ChildProvincesQuery::create()->findPk($this->id_province, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProvinces->addCommercess($this);
             */
        }

        return $this->aProvinces;
    }

    /**
     * Declares an association between this object and a ChildProvincesLocalities object.
     *
     * @param  ChildProvincesLocalities $v
     * @return $this|\Commerces The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProvincesLocalities(ChildProvincesLocalities $v = null)
    {
        if ($v === null) {
            $this->setIdLocality(NULL);
        } else {
            $this->setIdLocality($v->getId());
        }

        $this->aProvincesLocalities = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildProvincesLocalities object, it will not be re-added.
        if ($v !== null) {
            $v->addCommerces($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildProvincesLocalities object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildProvincesLocalities The associated ChildProvincesLocalities object.
     * @throws PropelException
     */
    public function getProvincesLocalities(ConnectionInterface $con = null)
    {
        if ($this->aProvincesLocalities === null && ($this->id_locality !== null)) {
            $this->aProvincesLocalities = ChildProvincesLocalitiesQuery::create()->findPk($this->id_locality, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProvincesLocalities->addCommercess($this);
             */
        }

        return $this->aProvincesLocalities;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('CommercesBranchOffices' == $relationName) {
            return $this->initCommercesBranchOfficess();
        }
        if ('CommercesPreferences' == $relationName) {
            return $this->initCommercesPreferencess();
        }
        if ('CommercesRates' == $relationName) {
            return $this->initCommercesRatess();
        }
        if ('CommercesReminders' == $relationName) {
            return $this->initCommercesReminderss();
        }
    }

    /**
     * Clears out the collCommercesBranchOfficess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCommercesBranchOfficess()
     */
    public function clearCommercesBranchOfficess()
    {
        $this->collCommercesBranchOfficess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCommercesBranchOfficess collection loaded partially.
     */
    public function resetPartialCommercesBranchOfficess($v = true)
    {
        $this->collCommercesBranchOfficessPartial = $v;
    }

    /**
     * Initializes the collCommercesBranchOfficess collection.
     *
     * By default this just sets the collCommercesBranchOfficess collection to an empty array (like clearcollCommercesBranchOfficess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCommercesBranchOfficess($overrideExisting = true)
    {
        if (null !== $this->collCommercesBranchOfficess && !$overrideExisting) {
            return;
        }
        $this->collCommercesBranchOfficess = new ObjectCollection();
        $this->collCommercesBranchOfficess->setModel('\CommercesBranchOffices');
    }

    /**
     * Gets an array of ChildCommercesBranchOffices objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCommerces is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCommercesBranchOffices[] List of ChildCommercesBranchOffices objects
     * @throws PropelException
     */
    public function getCommercesBranchOfficess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCommercesBranchOfficessPartial && !$this->isNew();
        if (null === $this->collCommercesBranchOfficess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCommercesBranchOfficess) {
                // return empty collection
                $this->initCommercesBranchOfficess();
            } else {
                $collCommercesBranchOfficess = ChildCommercesBranchOfficesQuery::create(null, $criteria)
                    ->filterByCommerces($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCommercesBranchOfficessPartial && count($collCommercesBranchOfficess)) {
                        $this->initCommercesBranchOfficess(false);

                        foreach ($collCommercesBranchOfficess as $obj) {
                            if (false == $this->collCommercesBranchOfficess->contains($obj)) {
                                $this->collCommercesBranchOfficess->append($obj);
                            }
                        }

                        $this->collCommercesBranchOfficessPartial = true;
                    }

                    return $collCommercesBranchOfficess;
                }

                if ($partial && $this->collCommercesBranchOfficess) {
                    foreach ($this->collCommercesBranchOfficess as $obj) {
                        if ($obj->isNew()) {
                            $collCommercesBranchOfficess[] = $obj;
                        }
                    }
                }

                $this->collCommercesBranchOfficess = $collCommercesBranchOfficess;
                $this->collCommercesBranchOfficessPartial = false;
            }
        }

        return $this->collCommercesBranchOfficess;
    }

    /**
     * Sets a collection of ChildCommercesBranchOffices objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $commercesBranchOfficess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCommerces The current object (for fluent API support)
     */
    public function setCommercesBranchOfficess(Collection $commercesBranchOfficess, ConnectionInterface $con = null)
    {
        /** @var ChildCommercesBranchOffices[] $commercesBranchOfficessToDelete */
        $commercesBranchOfficessToDelete = $this->getCommercesBranchOfficess(new Criteria(), $con)->diff($commercesBranchOfficess);


        $this->commercesBranchOfficessScheduledForDeletion = $commercesBranchOfficessToDelete;

        foreach ($commercesBranchOfficessToDelete as $commercesBranchOfficesRemoved) {
            $commercesBranchOfficesRemoved->setCommerces(null);
        }

        $this->collCommercesBranchOfficess = null;
        foreach ($commercesBranchOfficess as $commercesBranchOffices) {
            $this->addCommercesBranchOffices($commercesBranchOffices);
        }

        $this->collCommercesBranchOfficess = $commercesBranchOfficess;
        $this->collCommercesBranchOfficessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CommercesBranchOffices objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CommercesBranchOffices objects.
     * @throws PropelException
     */
    public function countCommercesBranchOfficess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCommercesBranchOfficessPartial && !$this->isNew();
        if (null === $this->collCommercesBranchOfficess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCommercesBranchOfficess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCommercesBranchOfficess());
            }

            $query = ChildCommercesBranchOfficesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCommerces($this)
                ->count($con);
        }

        return count($this->collCommercesBranchOfficess);
    }

    /**
     * Method called to associate a ChildCommercesBranchOffices object to this object
     * through the ChildCommercesBranchOffices foreign key attribute.
     *
     * @param  ChildCommercesBranchOffices $l ChildCommercesBranchOffices
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function addCommercesBranchOffices(ChildCommercesBranchOffices $l)
    {
        if ($this->collCommercesBranchOfficess === null) {
            $this->initCommercesBranchOfficess();
            $this->collCommercesBranchOfficessPartial = true;
        }

        if (!$this->collCommercesBranchOfficess->contains($l)) {
            $this->doAddCommercesBranchOffices($l);
        }

        return $this;
    }

    /**
     * @param ChildCommercesBranchOffices $commercesBranchOffices The ChildCommercesBranchOffices object to add.
     */
    protected function doAddCommercesBranchOffices(ChildCommercesBranchOffices $commercesBranchOffices)
    {
        $this->collCommercesBranchOfficess[]= $commercesBranchOffices;
        $commercesBranchOffices->setCommerces($this);
    }

    /**
     * @param  ChildCommercesBranchOffices $commercesBranchOffices The ChildCommercesBranchOffices object to remove.
     * @return $this|ChildCommerces The current object (for fluent API support)
     */
    public function removeCommercesBranchOffices(ChildCommercesBranchOffices $commercesBranchOffices)
    {
        if ($this->getCommercesBranchOfficess()->contains($commercesBranchOffices)) {
            $pos = $this->collCommercesBranchOfficess->search($commercesBranchOffices);
            $this->collCommercesBranchOfficess->remove($pos);
            if (null === $this->commercesBranchOfficessScheduledForDeletion) {
                $this->commercesBranchOfficessScheduledForDeletion = clone $this->collCommercesBranchOfficess;
                $this->commercesBranchOfficessScheduledForDeletion->clear();
            }
            $this->commercesBranchOfficessScheduledForDeletion[]= $commercesBranchOffices;
            $commercesBranchOffices->setCommerces(null);
        }

        return $this;
    }

    /**
     * Clears out the collCommercesPreferencess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCommercesPreferencess()
     */
    public function clearCommercesPreferencess()
    {
        $this->collCommercesPreferencess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCommercesPreferencess collection loaded partially.
     */
    public function resetPartialCommercesPreferencess($v = true)
    {
        $this->collCommercesPreferencessPartial = $v;
    }

    /**
     * Initializes the collCommercesPreferencess collection.
     *
     * By default this just sets the collCommercesPreferencess collection to an empty array (like clearcollCommercesPreferencess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCommercesPreferencess($overrideExisting = true)
    {
        if (null !== $this->collCommercesPreferencess && !$overrideExisting) {
            return;
        }
        $this->collCommercesPreferencess = new ObjectCollection();
        $this->collCommercesPreferencess->setModel('\CommercesPreferences');
    }

    /**
     * Gets an array of ChildCommercesPreferences objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCommerces is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCommercesPreferences[] List of ChildCommercesPreferences objects
     * @throws PropelException
     */
    public function getCommercesPreferencess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCommercesPreferencessPartial && !$this->isNew();
        if (null === $this->collCommercesPreferencess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCommercesPreferencess) {
                // return empty collection
                $this->initCommercesPreferencess();
            } else {
                $collCommercesPreferencess = ChildCommercesPreferencesQuery::create(null, $criteria)
                    ->filterByCommerces($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCommercesPreferencessPartial && count($collCommercesPreferencess)) {
                        $this->initCommercesPreferencess(false);

                        foreach ($collCommercesPreferencess as $obj) {
                            if (false == $this->collCommercesPreferencess->contains($obj)) {
                                $this->collCommercesPreferencess->append($obj);
                            }
                        }

                        $this->collCommercesPreferencessPartial = true;
                    }

                    return $collCommercesPreferencess;
                }

                if ($partial && $this->collCommercesPreferencess) {
                    foreach ($this->collCommercesPreferencess as $obj) {
                        if ($obj->isNew()) {
                            $collCommercesPreferencess[] = $obj;
                        }
                    }
                }

                $this->collCommercesPreferencess = $collCommercesPreferencess;
                $this->collCommercesPreferencessPartial = false;
            }
        }

        return $this->collCommercesPreferencess;
    }

    /**
     * Sets a collection of ChildCommercesPreferences objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $commercesPreferencess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCommerces The current object (for fluent API support)
     */
    public function setCommercesPreferencess(Collection $commercesPreferencess, ConnectionInterface $con = null)
    {
        /** @var ChildCommercesPreferences[] $commercesPreferencessToDelete */
        $commercesPreferencessToDelete = $this->getCommercesPreferencess(new Criteria(), $con)->diff($commercesPreferencess);


        $this->commercesPreferencessScheduledForDeletion = $commercesPreferencessToDelete;

        foreach ($commercesPreferencessToDelete as $commercesPreferencesRemoved) {
            $commercesPreferencesRemoved->setCommerces(null);
        }

        $this->collCommercesPreferencess = null;
        foreach ($commercesPreferencess as $commercesPreferences) {
            $this->addCommercesPreferences($commercesPreferences);
        }

        $this->collCommercesPreferencess = $commercesPreferencess;
        $this->collCommercesPreferencessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CommercesPreferences objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CommercesPreferences objects.
     * @throws PropelException
     */
    public function countCommercesPreferencess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCommercesPreferencessPartial && !$this->isNew();
        if (null === $this->collCommercesPreferencess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCommercesPreferencess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCommercesPreferencess());
            }

            $query = ChildCommercesPreferencesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCommerces($this)
                ->count($con);
        }

        return count($this->collCommercesPreferencess);
    }

    /**
     * Method called to associate a ChildCommercesPreferences object to this object
     * through the ChildCommercesPreferences foreign key attribute.
     *
     * @param  ChildCommercesPreferences $l ChildCommercesPreferences
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function addCommercesPreferences(ChildCommercesPreferences $l)
    {
        if ($this->collCommercesPreferencess === null) {
            $this->initCommercesPreferencess();
            $this->collCommercesPreferencessPartial = true;
        }

        if (!$this->collCommercesPreferencess->contains($l)) {
            $this->doAddCommercesPreferences($l);
        }

        return $this;
    }

    /**
     * @param ChildCommercesPreferences $commercesPreferences The ChildCommercesPreferences object to add.
     */
    protected function doAddCommercesPreferences(ChildCommercesPreferences $commercesPreferences)
    {
        $this->collCommercesPreferencess[]= $commercesPreferences;
        $commercesPreferences->setCommerces($this);
    }

    /**
     * @param  ChildCommercesPreferences $commercesPreferences The ChildCommercesPreferences object to remove.
     * @return $this|ChildCommerces The current object (for fluent API support)
     */
    public function removeCommercesPreferences(ChildCommercesPreferences $commercesPreferences)
    {
        if ($this->getCommercesPreferencess()->contains($commercesPreferences)) {
            $pos = $this->collCommercesPreferencess->search($commercesPreferences);
            $this->collCommercesPreferencess->remove($pos);
            if (null === $this->commercesPreferencessScheduledForDeletion) {
                $this->commercesPreferencessScheduledForDeletion = clone $this->collCommercesPreferencess;
                $this->commercesPreferencessScheduledForDeletion->clear();
            }
            $this->commercesPreferencessScheduledForDeletion[]= $commercesPreferences;
            $commercesPreferences->setCommerces(null);
        }

        return $this;
    }

    /**
     * Clears out the collCommercesRatess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCommercesRatess()
     */
    public function clearCommercesRatess()
    {
        $this->collCommercesRatess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCommercesRatess collection loaded partially.
     */
    public function resetPartialCommercesRatess($v = true)
    {
        $this->collCommercesRatessPartial = $v;
    }

    /**
     * Initializes the collCommercesRatess collection.
     *
     * By default this just sets the collCommercesRatess collection to an empty array (like clearcollCommercesRatess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCommercesRatess($overrideExisting = true)
    {
        if (null !== $this->collCommercesRatess && !$overrideExisting) {
            return;
        }
        $this->collCommercesRatess = new ObjectCollection();
        $this->collCommercesRatess->setModel('\CommercesRates');
    }

    /**
     * Gets an array of ChildCommercesRates objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCommerces is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCommercesRates[] List of ChildCommercesRates objects
     * @throws PropelException
     */
    public function getCommercesRatess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCommercesRatessPartial && !$this->isNew();
        if (null === $this->collCommercesRatess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCommercesRatess) {
                // return empty collection
                $this->initCommercesRatess();
            } else {
                $collCommercesRatess = ChildCommercesRatesQuery::create(null, $criteria)
                    ->filterByCommerces($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCommercesRatessPartial && count($collCommercesRatess)) {
                        $this->initCommercesRatess(false);

                        foreach ($collCommercesRatess as $obj) {
                            if (false == $this->collCommercesRatess->contains($obj)) {
                                $this->collCommercesRatess->append($obj);
                            }
                        }

                        $this->collCommercesRatessPartial = true;
                    }

                    return $collCommercesRatess;
                }

                if ($partial && $this->collCommercesRatess) {
                    foreach ($this->collCommercesRatess as $obj) {
                        if ($obj->isNew()) {
                            $collCommercesRatess[] = $obj;
                        }
                    }
                }

                $this->collCommercesRatess = $collCommercesRatess;
                $this->collCommercesRatessPartial = false;
            }
        }

        return $this->collCommercesRatess;
    }

    /**
     * Sets a collection of ChildCommercesRates objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $commercesRatess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCommerces The current object (for fluent API support)
     */
    public function setCommercesRatess(Collection $commercesRatess, ConnectionInterface $con = null)
    {
        /** @var ChildCommercesRates[] $commercesRatessToDelete */
        $commercesRatessToDelete = $this->getCommercesRatess(new Criteria(), $con)->diff($commercesRatess);


        $this->commercesRatessScheduledForDeletion = $commercesRatessToDelete;

        foreach ($commercesRatessToDelete as $commercesRatesRemoved) {
            $commercesRatesRemoved->setCommerces(null);
        }

        $this->collCommercesRatess = null;
        foreach ($commercesRatess as $commercesRates) {
            $this->addCommercesRates($commercesRates);
        }

        $this->collCommercesRatess = $commercesRatess;
        $this->collCommercesRatessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CommercesRates objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CommercesRates objects.
     * @throws PropelException
     */
    public function countCommercesRatess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCommercesRatessPartial && !$this->isNew();
        if (null === $this->collCommercesRatess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCommercesRatess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCommercesRatess());
            }

            $query = ChildCommercesRatesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCommerces($this)
                ->count($con);
        }

        return count($this->collCommercesRatess);
    }

    /**
     * Method called to associate a ChildCommercesRates object to this object
     * through the ChildCommercesRates foreign key attribute.
     *
     * @param  ChildCommercesRates $l ChildCommercesRates
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function addCommercesRates(ChildCommercesRates $l)
    {
        if ($this->collCommercesRatess === null) {
            $this->initCommercesRatess();
            $this->collCommercesRatessPartial = true;
        }

        if (!$this->collCommercesRatess->contains($l)) {
            $this->doAddCommercesRates($l);
        }

        return $this;
    }

    /**
     * @param ChildCommercesRates $commercesRates The ChildCommercesRates object to add.
     */
    protected function doAddCommercesRates(ChildCommercesRates $commercesRates)
    {
        $this->collCommercesRatess[]= $commercesRates;
        $commercesRates->setCommerces($this);
    }

    /**
     * @param  ChildCommercesRates $commercesRates The ChildCommercesRates object to remove.
     * @return $this|ChildCommerces The current object (for fluent API support)
     */
    public function removeCommercesRates(ChildCommercesRates $commercesRates)
    {
        if ($this->getCommercesRatess()->contains($commercesRates)) {
            $pos = $this->collCommercesRatess->search($commercesRates);
            $this->collCommercesRatess->remove($pos);
            if (null === $this->commercesRatessScheduledForDeletion) {
                $this->commercesRatessScheduledForDeletion = clone $this->collCommercesRatess;
                $this->commercesRatessScheduledForDeletion->clear();
            }
            $this->commercesRatessScheduledForDeletion[]= $commercesRates;
            $commercesRates->setCommerces(null);
        }

        return $this;
    }

    /**
     * Clears out the collCommercesReminderss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCommercesReminderss()
     */
    public function clearCommercesReminderss()
    {
        $this->collCommercesReminderss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCommercesReminderss collection loaded partially.
     */
    public function resetPartialCommercesReminderss($v = true)
    {
        $this->collCommercesReminderssPartial = $v;
    }

    /**
     * Initializes the collCommercesReminderss collection.
     *
     * By default this just sets the collCommercesReminderss collection to an empty array (like clearcollCommercesReminderss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCommercesReminderss($overrideExisting = true)
    {
        if (null !== $this->collCommercesReminderss && !$overrideExisting) {
            return;
        }
        $this->collCommercesReminderss = new ObjectCollection();
        $this->collCommercesReminderss->setModel('\CommercesReminders');
    }

    /**
     * Gets an array of ChildCommercesReminders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCommerces is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCommercesReminders[] List of ChildCommercesReminders objects
     * @throws PropelException
     */
    public function getCommercesReminderss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCommercesReminderssPartial && !$this->isNew();
        if (null === $this->collCommercesReminderss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCommercesReminderss) {
                // return empty collection
                $this->initCommercesReminderss();
            } else {
                $collCommercesReminderss = ChildCommercesRemindersQuery::create(null, $criteria)
                    ->filterByCommerces($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCommercesReminderssPartial && count($collCommercesReminderss)) {
                        $this->initCommercesReminderss(false);

                        foreach ($collCommercesReminderss as $obj) {
                            if (false == $this->collCommercesReminderss->contains($obj)) {
                                $this->collCommercesReminderss->append($obj);
                            }
                        }

                        $this->collCommercesReminderssPartial = true;
                    }

                    return $collCommercesReminderss;
                }

                if ($partial && $this->collCommercesReminderss) {
                    foreach ($this->collCommercesReminderss as $obj) {
                        if ($obj->isNew()) {
                            $collCommercesReminderss[] = $obj;
                        }
                    }
                }

                $this->collCommercesReminderss = $collCommercesReminderss;
                $this->collCommercesReminderssPartial = false;
            }
        }

        return $this->collCommercesReminderss;
    }

    /**
     * Sets a collection of ChildCommercesReminders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $commercesReminderss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCommerces The current object (for fluent API support)
     */
    public function setCommercesReminderss(Collection $commercesReminderss, ConnectionInterface $con = null)
    {
        /** @var ChildCommercesReminders[] $commercesReminderssToDelete */
        $commercesReminderssToDelete = $this->getCommercesReminderss(new Criteria(), $con)->diff($commercesReminderss);


        $this->commercesReminderssScheduledForDeletion = $commercesReminderssToDelete;

        foreach ($commercesReminderssToDelete as $commercesRemindersRemoved) {
            $commercesRemindersRemoved->setCommerces(null);
        }

        $this->collCommercesReminderss = null;
        foreach ($commercesReminderss as $commercesReminders) {
            $this->addCommercesReminders($commercesReminders);
        }

        $this->collCommercesReminderss = $commercesReminderss;
        $this->collCommercesReminderssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CommercesReminders objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CommercesReminders objects.
     * @throws PropelException
     */
    public function countCommercesReminderss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCommercesReminderssPartial && !$this->isNew();
        if (null === $this->collCommercesReminderss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCommercesReminderss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCommercesReminderss());
            }

            $query = ChildCommercesRemindersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCommerces($this)
                ->count($con);
        }

        return count($this->collCommercesReminderss);
    }

    /**
     * Method called to associate a ChildCommercesReminders object to this object
     * through the ChildCommercesReminders foreign key attribute.
     *
     * @param  ChildCommercesReminders $l ChildCommercesReminders
     * @return $this|\Commerces The current object (for fluent API support)
     */
    public function addCommercesReminders(ChildCommercesReminders $l)
    {
        if ($this->collCommercesReminderss === null) {
            $this->initCommercesReminderss();
            $this->collCommercesReminderssPartial = true;
        }

        if (!$this->collCommercesReminderss->contains($l)) {
            $this->doAddCommercesReminders($l);
        }

        return $this;
    }

    /**
     * @param ChildCommercesReminders $commercesReminders The ChildCommercesReminders object to add.
     */
    protected function doAddCommercesReminders(ChildCommercesReminders $commercesReminders)
    {
        $this->collCommercesReminderss[]= $commercesReminders;
        $commercesReminders->setCommerces($this);
    }

    /**
     * @param  ChildCommercesReminders $commercesReminders The ChildCommercesReminders object to remove.
     * @return $this|ChildCommerces The current object (for fluent API support)
     */
    public function removeCommercesReminders(ChildCommercesReminders $commercesReminders)
    {
        if ($this->getCommercesReminderss()->contains($commercesReminders)) {
            $pos = $this->collCommercesReminderss->search($commercesReminders);
            $this->collCommercesReminderss->remove($pos);
            if (null === $this->commercesReminderssScheduledForDeletion) {
                $this->commercesReminderssScheduledForDeletion = clone $this->collCommercesReminderss;
                $this->commercesReminderssScheduledForDeletion->clear();
            }
            $this->commercesReminderssScheduledForDeletion[]= $commercesReminders;
            $commercesReminders->setCommerces(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aPositionsCommerce) {
            $this->aPositionsCommerce->removeCommerces($this);
        }
        if (null !== $this->aHeadingsCommerce) {
            $this->aHeadingsCommerce->removeCommerces($this);
        }
        if (null !== $this->aProvinces) {
            $this->aProvinces->removeCommerces($this);
        }
        if (null !== $this->aProvincesLocalities) {
            $this->aProvincesLocalities->removeCommerces($this);
        }
        $this->id = null;
        $this->id_user = null;
        $this->id_position_commerce = null;
        $this->id_heading_commerce = null;
        $this->id_province = null;
        $this->id_locality = null;
        $this->token = null;
        $this->logo = null;
        $this->business_name = null;
        $this->cuit_cuil = null;
        $this->name = null;
        $this->phone = null;
        $this->phone_personal = null;
        $this->email = null;
        $this->password = null;
        $this->address = null;
        $this->address_lat = null;
        $this->address_lng = null;
        $this->address_locality = null;
        $this->address_region = null;
        $this->address_country = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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
            if ($this->collCommercesBranchOfficess) {
                foreach ($this->collCommercesBranchOfficess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCommercesPreferencess) {
                foreach ($this->collCommercesPreferencess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCommercesRatess) {
                foreach ($this->collCommercesRatess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCommercesReminderss) {
                foreach ($this->collCommercesReminderss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCommercesBranchOfficess = null;
        $this->collCommercesPreferencess = null;
        $this->collCommercesRatess = null;
        $this->collCommercesReminderss = null;
        $this->aPositionsCommerce = null;
        $this->aHeadingsCommerce = null;
        $this->aProvinces = null;
        $this->aProvincesLocalities = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CommercesTableMap::DEFAULT_STRING_FORMAT);
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
