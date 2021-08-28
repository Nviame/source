<?php

namespace Base;

use \UsersSettingsQuery as ChildUsersSettingsQuery;
use \Exception;
use \PDO;
use Map\UsersSettingsTableMap;
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

/**
 * Base class that represents a row from the 'users_settings' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class UsersSettings implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\UsersSettingsTableMap';


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
     * The value for the user_id field.
     * @var        int
     */
    protected $user_id;

    /**
     * The value for the push_new_shipments field.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $push_new_shipments;

    /**
     * The value for the push_offers field.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $push_offers;

    /**
     * The value for the push_chats field.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $push_chats;

    /**
     * The value for the online field.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $online;

    /**
     * The value for the rate_base_price field.
     * @var        double
     */
    protected $rate_base_price;

    /**
     * The value for the rate_base_price_enabled field.
     * @var        boolean
     */
    protected $rate_base_price_enabled;

    /**
     * The value for the rate_price_km field.
     * @var        double
     */
    protected $rate_price_km;

    /**
     * The value for the rate_price_km_enabled field.
     * @var        boolean
     */
    protected $rate_price_km_enabled;

    /**
     * The value for the rate_percent_night_schedule field.
     * @var        double
     */
    protected $rate_percent_night_schedule;

    /**
     * The value for the rate_percent_night_schedule_enabled field.
     * @var        boolean
     */
    protected $rate_percent_night_schedule_enabled;

    /**
     * The value for the rate_percent_non_business_day field.
     * @var        double
     */
    protected $rate_percent_non_business_day;

    /**
     * The value for the rate_percent_non_business_day_enabled field.
     * @var        boolean
     */
    protected $rate_percent_non_business_day_enabled;

    /**
     * The value for the shipments_max_offers field.
     * @var        int
     */
    protected $shipments_max_offers;

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
        $this->push_new_shipments = true;
        $this->push_offers = true;
        $this->push_chats = true;
        $this->online = true;
    }

    /**
     * Initializes internal state of Base\UsersSettings object.
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
     * Compares this with another <code>UsersSettings</code> instance.  If
     * <code>obj</code> is an instance of <code>UsersSettings</code>, delegates to
     * <code>equals(UsersSettings)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|UsersSettings The current object, for fluid interface
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
     * Get the [user_id] column value.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the [push_new_shipments] column value.
     *
     * @return boolean
     */
    public function getPushNewShipments()
    {
        return $this->push_new_shipments;
    }

    /**
     * Get the [push_new_shipments] column value.
     *
     * @return boolean
     */
    public function isPushNewShipments()
    {
        return $this->getPushNewShipments();
    }

    /**
     * Get the [push_offers] column value.
     *
     * @return boolean
     */
    public function getPushOffers()
    {
        return $this->push_offers;
    }

    /**
     * Get the [push_offers] column value.
     *
     * @return boolean
     */
    public function isPushOffers()
    {
        return $this->getPushOffers();
    }

    /**
     * Get the [push_chats] column value.
     *
     * @return boolean
     */
    public function getPushChats()
    {
        return $this->push_chats;
    }

    /**
     * Get the [push_chats] column value.
     *
     * @return boolean
     */
    public function isPushChats()
    {
        return $this->getPushChats();
    }

    /**
     * Get the [online] column value.
     *
     * @return boolean
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Get the [online] column value.
     *
     * @return boolean
     */
    public function isOnline()
    {
        return $this->getOnline();
    }

    /**
     * Get the [rate_base_price] column value.
     *
     * @return double
     */
    public function getRateBasePrice()
    {
        return $this->rate_base_price;
    }

    /**
     * Get the [rate_base_price_enabled] column value.
     *
     * @return boolean
     */
    public function getRateBasePriceEnabled()
    {
        return $this->rate_base_price_enabled;
    }

    /**
     * Get the [rate_base_price_enabled] column value.
     *
     * @return boolean
     */
    public function isRateBasePriceEnabled()
    {
        return $this->getRateBasePriceEnabled();
    }

    /**
     * Get the [rate_price_km] column value.
     *
     * @return double
     */
    public function getRatePriceKm()
    {
        return $this->rate_price_km;
    }

    /**
     * Get the [rate_price_km_enabled] column value.
     *
     * @return boolean
     */
    public function getRatePriceKmEnabled()
    {
        return $this->rate_price_km_enabled;
    }

    /**
     * Get the [rate_price_km_enabled] column value.
     *
     * @return boolean
     */
    public function isRatePriceKmEnabled()
    {
        return $this->getRatePriceKmEnabled();
    }

    /**
     * Get the [rate_percent_night_schedule] column value.
     *
     * @return double
     */
    public function getRatePercentNightSchedule()
    {
        return $this->rate_percent_night_schedule;
    }

    /**
     * Get the [rate_percent_night_schedule_enabled] column value.
     *
     * @return boolean
     */
    public function getRatePercentNightScheduleEnabled()
    {
        return $this->rate_percent_night_schedule_enabled;
    }

    /**
     * Get the [rate_percent_night_schedule_enabled] column value.
     *
     * @return boolean
     */
    public function isRatePercentNightScheduleEnabled()
    {
        return $this->getRatePercentNightScheduleEnabled();
    }

    /**
     * Get the [rate_percent_non_business_day] column value.
     *
     * @return double
     */
    public function getRatePercentNonBusinessDay()
    {
        return $this->rate_percent_non_business_day;
    }

    /**
     * Get the [rate_percent_non_business_day_enabled] column value.
     *
     * @return boolean
     */
    public function getRatePercentNonBusinessDayEnabled()
    {
        return $this->rate_percent_non_business_day_enabled;
    }

    /**
     * Get the [rate_percent_non_business_day_enabled] column value.
     *
     * @return boolean
     */
    public function isRatePercentNonBusinessDayEnabled()
    {
        return $this->getRatePercentNonBusinessDayEnabled();
    }

    /**
     * Get the [shipments_max_offers] column value.
     *
     * @return int
     */
    public function getShipmentsMaxOffers()
    {
        return $this->shipments_max_offers;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [user_id] column.
     *
     * @param int $v new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_USER_ID] = true;
        }

        return $this;
    } // setUserId()

    /**
     * Sets the value of the [push_new_shipments] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setPushNewShipments($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->push_new_shipments !== $v) {
            $this->push_new_shipments = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_PUSH_NEW_SHIPMENTS] = true;
        }

        return $this;
    } // setPushNewShipments()

    /**
     * Sets the value of the [push_offers] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setPushOffers($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->push_offers !== $v) {
            $this->push_offers = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_PUSH_OFFERS] = true;
        }

        return $this;
    } // setPushOffers()

    /**
     * Sets the value of the [push_chats] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setPushChats($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->push_chats !== $v) {
            $this->push_chats = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_PUSH_CHATS] = true;
        }

        return $this;
    } // setPushChats()

    /**
     * Sets the value of the [online] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setOnline($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->online !== $v) {
            $this->online = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_ONLINE] = true;
        }

        return $this;
    } // setOnline()

    /**
     * Set the value of [rate_base_price] column.
     *
     * @param double $v new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setRateBasePrice($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->rate_base_price !== $v) {
            $this->rate_base_price = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_RATE_BASE_PRICE] = true;
        }

        return $this;
    } // setRateBasePrice()

    /**
     * Sets the value of the [rate_base_price_enabled] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setRateBasePriceEnabled($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->rate_base_price_enabled !== $v) {
            $this->rate_base_price_enabled = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_RATE_BASE_PRICE_ENABLED] = true;
        }

        return $this;
    } // setRateBasePriceEnabled()

    /**
     * Set the value of [rate_price_km] column.
     *
     * @param double $v new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setRatePriceKm($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->rate_price_km !== $v) {
            $this->rate_price_km = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_RATE_PRICE_KM] = true;
        }

        return $this;
    } // setRatePriceKm()

    /**
     * Sets the value of the [rate_price_km_enabled] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setRatePriceKmEnabled($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->rate_price_km_enabled !== $v) {
            $this->rate_price_km_enabled = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_RATE_PRICE_KM_ENABLED] = true;
        }

        return $this;
    } // setRatePriceKmEnabled()

    /**
     * Set the value of [rate_percent_night_schedule] column.
     *
     * @param double $v new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setRatePercentNightSchedule($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->rate_percent_night_schedule !== $v) {
            $this->rate_percent_night_schedule = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE] = true;
        }

        return $this;
    } // setRatePercentNightSchedule()

    /**
     * Sets the value of the [rate_percent_night_schedule_enabled] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setRatePercentNightScheduleEnabled($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->rate_percent_night_schedule_enabled !== $v) {
            $this->rate_percent_night_schedule_enabled = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE_ENABLED] = true;
        }

        return $this;
    } // setRatePercentNightScheduleEnabled()

    /**
     * Set the value of [rate_percent_non_business_day] column.
     *
     * @param double $v new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setRatePercentNonBusinessDay($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->rate_percent_non_business_day !== $v) {
            $this->rate_percent_non_business_day = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY] = true;
        }

        return $this;
    } // setRatePercentNonBusinessDay()

    /**
     * Sets the value of the [rate_percent_non_business_day_enabled] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setRatePercentNonBusinessDayEnabled($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->rate_percent_non_business_day_enabled !== $v) {
            $this->rate_percent_non_business_day_enabled = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY_ENABLED] = true;
        }

        return $this;
    } // setRatePercentNonBusinessDayEnabled()

    /**
     * Set the value of [shipments_max_offers] column.
     *
     * @param int $v new value
     * @return $this|\UsersSettings The current object (for fluent API support)
     */
    public function setShipmentsMaxOffers($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->shipments_max_offers !== $v) {
            $this->shipments_max_offers = $v;
            $this->modifiedColumns[UsersSettingsTableMap::COL_SHIPMENTS_MAX_OFFERS] = true;
        }

        return $this;
    } // setShipmentsMaxOffers()

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
            if ($this->push_new_shipments !== true) {
                return false;
            }

            if ($this->push_offers !== true) {
                return false;
            }

            if ($this->push_chats !== true) {
                return false;
            }

            if ($this->online !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsersSettingsTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsersSettingsTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsersSettingsTableMap::translateFieldName('PushNewShipments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->push_new_shipments = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsersSettingsTableMap::translateFieldName('PushOffers', TableMap::TYPE_PHPNAME, $indexType)];
            $this->push_offers = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsersSettingsTableMap::translateFieldName('PushChats', TableMap::TYPE_PHPNAME, $indexType)];
            $this->push_chats = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsersSettingsTableMap::translateFieldName('Online', TableMap::TYPE_PHPNAME, $indexType)];
            $this->online = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsersSettingsTableMap::translateFieldName('RateBasePrice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate_base_price = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsersSettingsTableMap::translateFieldName('RateBasePriceEnabled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate_base_price_enabled = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UsersSettingsTableMap::translateFieldName('RatePriceKm', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate_price_km = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UsersSettingsTableMap::translateFieldName('RatePriceKmEnabled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate_price_km_enabled = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UsersSettingsTableMap::translateFieldName('RatePercentNightSchedule', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate_percent_night_schedule = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UsersSettingsTableMap::translateFieldName('RatePercentNightScheduleEnabled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate_percent_night_schedule_enabled = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UsersSettingsTableMap::translateFieldName('RatePercentNonBusinessDay', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate_percent_non_business_day = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UsersSettingsTableMap::translateFieldName('RatePercentNonBusinessDayEnabled', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate_percent_non_business_day_enabled = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : UsersSettingsTableMap::translateFieldName('ShipmentsMaxOffers', TableMap::TYPE_PHPNAME, $indexType)];
            $this->shipments_max_offers = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = UsersSettingsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\UsersSettings'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(UsersSettingsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsersSettingsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see UsersSettings::setDeleted()
     * @see UsersSettings::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersSettingsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsersSettingsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersSettingsTableMap::DATABASE_NAME);
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
                UsersSettingsTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[UsersSettingsTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsersSettingsTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsersSettingsTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`user_id`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_PUSH_NEW_SHIPMENTS)) {
            $modifiedColumns[':p' . $index++]  = '`push_new_shipments`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_PUSH_OFFERS)) {
            $modifiedColumns[':p' . $index++]  = '`push_offers`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_PUSH_CHATS)) {
            $modifiedColumns[':p' . $index++]  = '`push_chats`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_ONLINE)) {
            $modifiedColumns[':p' . $index++]  = '`online`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_BASE_PRICE)) {
            $modifiedColumns[':p' . $index++]  = '`rate_base_price`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_BASE_PRICE_ENABLED)) {
            $modifiedColumns[':p' . $index++]  = '`rate_base_price_enabled`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_PRICE_KM)) {
            $modifiedColumns[':p' . $index++]  = '`rate_price_km`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_PRICE_KM_ENABLED)) {
            $modifiedColumns[':p' . $index++]  = '`rate_price_km_enabled`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE)) {
            $modifiedColumns[':p' . $index++]  = '`rate_percent_night_schedule`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE_ENABLED)) {
            $modifiedColumns[':p' . $index++]  = '`rate_percent_night_schedule_enabled`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY)) {
            $modifiedColumns[':p' . $index++]  = '`rate_percent_non_business_day`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY_ENABLED)) {
            $modifiedColumns[':p' . $index++]  = '`rate_percent_non_business_day_enabled`';
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_SHIPMENTS_MAX_OFFERS)) {
            $modifiedColumns[':p' . $index++]  = '`shipments_max_offers`';
        }

        $sql = sprintf(
            'INSERT INTO `users_settings` (%s) VALUES (%s)',
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
                    case '`user_id`':
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case '`push_new_shipments`':
                        $stmt->bindValue($identifier, (int) $this->push_new_shipments, PDO::PARAM_INT);
                        break;
                    case '`push_offers`':
                        $stmt->bindValue($identifier, (int) $this->push_offers, PDO::PARAM_INT);
                        break;
                    case '`push_chats`':
                        $stmt->bindValue($identifier, (int) $this->push_chats, PDO::PARAM_INT);
                        break;
                    case '`online`':
                        $stmt->bindValue($identifier, (int) $this->online, PDO::PARAM_INT);
                        break;
                    case '`rate_base_price`':
                        $stmt->bindValue($identifier, $this->rate_base_price, PDO::PARAM_STR);
                        break;
                    case '`rate_base_price_enabled`':
                        $stmt->bindValue($identifier, (int) $this->rate_base_price_enabled, PDO::PARAM_INT);
                        break;
                    case '`rate_price_km`':
                        $stmt->bindValue($identifier, $this->rate_price_km, PDO::PARAM_STR);
                        break;
                    case '`rate_price_km_enabled`':
                        $stmt->bindValue($identifier, (int) $this->rate_price_km_enabled, PDO::PARAM_INT);
                        break;
                    case '`rate_percent_night_schedule`':
                        $stmt->bindValue($identifier, $this->rate_percent_night_schedule, PDO::PARAM_STR);
                        break;
                    case '`rate_percent_night_schedule_enabled`':
                        $stmt->bindValue($identifier, (int) $this->rate_percent_night_schedule_enabled, PDO::PARAM_INT);
                        break;
                    case '`rate_percent_non_business_day`':
                        $stmt->bindValue($identifier, $this->rate_percent_non_business_day, PDO::PARAM_STR);
                        break;
                    case '`rate_percent_non_business_day_enabled`':
                        $stmt->bindValue($identifier, (int) $this->rate_percent_non_business_day_enabled, PDO::PARAM_INT);
                        break;
                    case '`shipments_max_offers`':
                        $stmt->bindValue($identifier, $this->shipments_max_offers, PDO::PARAM_INT);
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
        $pos = UsersSettingsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUserId();
                break;
            case 2:
                return $this->getPushNewShipments();
                break;
            case 3:
                return $this->getPushOffers();
                break;
            case 4:
                return $this->getPushChats();
                break;
            case 5:
                return $this->getOnline();
                break;
            case 6:
                return $this->getRateBasePrice();
                break;
            case 7:
                return $this->getRateBasePriceEnabled();
                break;
            case 8:
                return $this->getRatePriceKm();
                break;
            case 9:
                return $this->getRatePriceKmEnabled();
                break;
            case 10:
                return $this->getRatePercentNightSchedule();
                break;
            case 11:
                return $this->getRatePercentNightScheduleEnabled();
                break;
            case 12:
                return $this->getRatePercentNonBusinessDay();
                break;
            case 13:
                return $this->getRatePercentNonBusinessDayEnabled();
                break;
            case 14:
                return $this->getShipmentsMaxOffers();
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

        if (isset($alreadyDumpedObjects['UsersSettings'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['UsersSettings'][$this->hashCode()] = true;
        $keys = UsersSettingsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUserId(),
            $keys[2] => $this->getPushNewShipments(),
            $keys[3] => $this->getPushOffers(),
            $keys[4] => $this->getPushChats(),
            $keys[5] => $this->getOnline(),
            $keys[6] => $this->getRateBasePrice(),
            $keys[7] => $this->getRateBasePriceEnabled(),
            $keys[8] => $this->getRatePriceKm(),
            $keys[9] => $this->getRatePriceKmEnabled(),
            $keys[10] => $this->getRatePercentNightSchedule(),
            $keys[11] => $this->getRatePercentNightScheduleEnabled(),
            $keys[12] => $this->getRatePercentNonBusinessDay(),
            $keys[13] => $this->getRatePercentNonBusinessDayEnabled(),
            $keys[14] => $this->getShipmentsMaxOffers(),
        );
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
     * @return $this|\UsersSettings
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsersSettingsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\UsersSettings
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUserId($value);
                break;
            case 2:
                $this->setPushNewShipments($value);
                break;
            case 3:
                $this->setPushOffers($value);
                break;
            case 4:
                $this->setPushChats($value);
                break;
            case 5:
                $this->setOnline($value);
                break;
            case 6:
                $this->setRateBasePrice($value);
                break;
            case 7:
                $this->setRateBasePriceEnabled($value);
                break;
            case 8:
                $this->setRatePriceKm($value);
                break;
            case 9:
                $this->setRatePriceKmEnabled($value);
                break;
            case 10:
                $this->setRatePercentNightSchedule($value);
                break;
            case 11:
                $this->setRatePercentNightScheduleEnabled($value);
                break;
            case 12:
                $this->setRatePercentNonBusinessDay($value);
                break;
            case 13:
                $this->setRatePercentNonBusinessDayEnabled($value);
                break;
            case 14:
                $this->setShipmentsMaxOffers($value);
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
        $keys = UsersSettingsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUserId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPushNewShipments($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPushOffers($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPushChats($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setOnline($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setRateBasePrice($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setRateBasePriceEnabled($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setRatePriceKm($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setRatePriceKmEnabled($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setRatePercentNightSchedule($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setRatePercentNightScheduleEnabled($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setRatePercentNonBusinessDay($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setRatePercentNonBusinessDayEnabled($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setShipmentsMaxOffers($arr[$keys[14]]);
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
     * @return $this|\UsersSettings The current object, for fluid interface
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
        $criteria = new Criteria(UsersSettingsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsersSettingsTableMap::COL_ID)) {
            $criteria->add(UsersSettingsTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_USER_ID)) {
            $criteria->add(UsersSettingsTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_PUSH_NEW_SHIPMENTS)) {
            $criteria->add(UsersSettingsTableMap::COL_PUSH_NEW_SHIPMENTS, $this->push_new_shipments);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_PUSH_OFFERS)) {
            $criteria->add(UsersSettingsTableMap::COL_PUSH_OFFERS, $this->push_offers);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_PUSH_CHATS)) {
            $criteria->add(UsersSettingsTableMap::COL_PUSH_CHATS, $this->push_chats);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_ONLINE)) {
            $criteria->add(UsersSettingsTableMap::COL_ONLINE, $this->online);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_BASE_PRICE)) {
            $criteria->add(UsersSettingsTableMap::COL_RATE_BASE_PRICE, $this->rate_base_price);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_BASE_PRICE_ENABLED)) {
            $criteria->add(UsersSettingsTableMap::COL_RATE_BASE_PRICE_ENABLED, $this->rate_base_price_enabled);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_PRICE_KM)) {
            $criteria->add(UsersSettingsTableMap::COL_RATE_PRICE_KM, $this->rate_price_km);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_PRICE_KM_ENABLED)) {
            $criteria->add(UsersSettingsTableMap::COL_RATE_PRICE_KM_ENABLED, $this->rate_price_km_enabled);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE)) {
            $criteria->add(UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE, $this->rate_percent_night_schedule);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE_ENABLED)) {
            $criteria->add(UsersSettingsTableMap::COL_RATE_PERCENT_NIGHT_SCHEDULE_ENABLED, $this->rate_percent_night_schedule_enabled);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY)) {
            $criteria->add(UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY, $this->rate_percent_non_business_day);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY_ENABLED)) {
            $criteria->add(UsersSettingsTableMap::COL_RATE_PERCENT_NON_BUSINESS_DAY_ENABLED, $this->rate_percent_non_business_day_enabled);
        }
        if ($this->isColumnModified(UsersSettingsTableMap::COL_SHIPMENTS_MAX_OFFERS)) {
            $criteria->add(UsersSettingsTableMap::COL_SHIPMENTS_MAX_OFFERS, $this->shipments_max_offers);
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
        $criteria = ChildUsersSettingsQuery::create();
        $criteria->add(UsersSettingsTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \UsersSettings (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUserId($this->getUserId());
        $copyObj->setPushNewShipments($this->getPushNewShipments());
        $copyObj->setPushOffers($this->getPushOffers());
        $copyObj->setPushChats($this->getPushChats());
        $copyObj->setOnline($this->getOnline());
        $copyObj->setRateBasePrice($this->getRateBasePrice());
        $copyObj->setRateBasePriceEnabled($this->getRateBasePriceEnabled());
        $copyObj->setRatePriceKm($this->getRatePriceKm());
        $copyObj->setRatePriceKmEnabled($this->getRatePriceKmEnabled());
        $copyObj->setRatePercentNightSchedule($this->getRatePercentNightSchedule());
        $copyObj->setRatePercentNightScheduleEnabled($this->getRatePercentNightScheduleEnabled());
        $copyObj->setRatePercentNonBusinessDay($this->getRatePercentNonBusinessDay());
        $copyObj->setRatePercentNonBusinessDayEnabled($this->getRatePercentNonBusinessDayEnabled());
        $copyObj->setShipmentsMaxOffers($this->getShipmentsMaxOffers());
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
     * @return \UsersSettings Clone of current object.
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
        $this->user_id = null;
        $this->push_new_shipments = null;
        $this->push_offers = null;
        $this->push_chats = null;
        $this->online = null;
        $this->rate_base_price = null;
        $this->rate_base_price_enabled = null;
        $this->rate_price_km = null;
        $this->rate_price_km_enabled = null;
        $this->rate_percent_night_schedule = null;
        $this->rate_percent_night_schedule_enabled = null;
        $this->rate_percent_non_business_day = null;
        $this->rate_percent_non_business_day_enabled = null;
        $this->shipments_max_offers = null;
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
        return (string) $this->exportTo(UsersSettingsTableMap::DEFAULT_STRING_FORMAT);
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
