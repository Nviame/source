<?php

namespace Base;

use \CommercesRates as ChildCommercesRates;
use \CommercesRatesQuery as ChildCommercesRatesQuery;
use \CommercesShipmentsQuery as ChildCommercesShipmentsQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\CommercesShipmentsTableMap;
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
 * Base class that represents a row from the 'commerces_shipments' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class CommercesShipments implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\CommercesShipmentsTableMap';


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
     * The value for the id_commerce field.
     * @var        int
     */
    protected $id_commerce;

    /**
     * The value for the id_rate field.
     * @var        int
     */
    protected $id_rate;

    /**
     * The value for the id_shipment field.
     * @var        int
     */
    protected $id_shipment;

    /**
     * The value for the uuid field.
     * @var        string
     */
    protected $uuid;

    /**
     * The value for the pickup_at_name field.
     * @var        string
     */
    protected $pickup_at_name;

    /**
     * The value for the pickup_at_lat field.
     * @var        string
     */
    protected $pickup_at_lat;

    /**
     * The value for the pickup_at_lng field.
     * @var        string
     */
    protected $pickup_at_lng;

    /**
     * The value for the pickup_at_locality field.
     * @var        string
     */
    protected $pickup_at_locality;

    /**
     * The value for the pickup_at_region field.
     * @var        string
     */
    protected $pickup_at_region;

    /**
     * The value for the pickup_at_country field.
     * @var        string
     */
    protected $pickup_at_country;

    /**
     * The value for the size field.
     * @var        string
     */
    protected $size;

    /**
     * The value for the priority field.
     * @var        int
     */
    protected $priority;

    /**
     * The value for the type field.
     * @var        int
     */
    protected $type;

    /**
     * The value for the type_rate field.
     * @var        int
     */
    protected $type_rate;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the delivery_date field.
     * @var        \DateTime
     */
    protected $delivery_date;

    /**
     * The value for the delivery_address_lat field.
     * @var        string
     */
    protected $delivery_address_lat;

    /**
     * The value for the delivery_address_lng field.
     * @var        string
     */
    protected $delivery_address_lng;

    /**
     * The value for the delivery_address_locality field.
     * @var        string
     */
    protected $delivery_address_locality;

    /**
     * The value for the delivery_address_region field.
     * @var        string
     */
    protected $delivery_address_region;

    /**
     * The value for the delivery_address_country field.
     * @var        string
     */
    protected $delivery_address_country;

    /**
     * The value for the addressee_name field.
     * @var        string
     */
    protected $addressee_name;

    /**
     * The value for the addressee_phone field.
     * @var        string
     */
    protected $addressee_phone;

    /**
     * The value for the delivery_address field.
     * @var        string
     */
    protected $delivery_address;

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
     * @var        ChildCommercesRates
     */
    protected $aCommercesRates;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\CommercesShipments object.
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
     * Compares this with another <code>CommercesShipments</code> instance.  If
     * <code>obj</code> is an instance of <code>CommercesShipments</code>, delegates to
     * <code>equals(CommercesShipments)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|CommercesShipments The current object, for fluid interface
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
     * Get the [id_commerce] column value.
     *
     * @return int
     */
    public function getIdCommerce()
    {
        return $this->id_commerce;
    }

    /**
     * Get the [id_rate] column value.
     *
     * @return int
     */
    public function getIdRate()
    {
        return $this->id_rate;
    }

    /**
     * Get the [id_shipment] column value.
     *
     * @return int
     */
    public function getIdShipment()
    {
        return $this->id_shipment;
    }

    /**
     * Get the [uuid] column value.
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Get the [pickup_at_name] column value.
     *
     * @return string
     */
    public function getPickupAtName()
    {
        return $this->pickup_at_name;
    }

    /**
     * Get the [pickup_at_lat] column value.
     *
     * @return string
     */
    public function getPickupAtLat()
    {
        return $this->pickup_at_lat;
    }

    /**
     * Get the [pickup_at_lng] column value.
     *
     * @return string
     */
    public function getPickupAtLng()
    {
        return $this->pickup_at_lng;
    }

    /**
     * Get the [pickup_at_locality] column value.
     *
     * @return string
     */
    public function getPickupAtLocality()
    {
        return $this->pickup_at_locality;
    }

    /**
     * Get the [pickup_at_region] column value.
     *
     * @return string
     */
    public function getPickupAtRegion()
    {
        return $this->pickup_at_region;
    }

    /**
     * Get the [pickup_at_country] column value.
     *
     * @return string
     */
    public function getPickupAtCountry()
    {
        return $this->pickup_at_country;
    }

    /**
     * Get the [size] column value.
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get the [priority] column value.
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Get the [type] column value.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the [type_rate] column value.
     *
     * @return int
     */
    public function getTypeRate()
    {
        return $this->type_rate;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [optionally formatted] temporal [delivery_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDeliveryDate($format = NULL)
    {
        if ($format === null) {
            return $this->delivery_date;
        } else {
            return $this->delivery_date instanceof \DateTime ? $this->delivery_date->format($format) : null;
        }
    }

    /**
     * Get the [delivery_address_lat] column value.
     *
     * @return string
     */
    public function getDeliveryAddressLat()
    {
        return $this->delivery_address_lat;
    }

    /**
     * Get the [delivery_address_lng] column value.
     *
     * @return string
     */
    public function getDeliveryAddressLng()
    {
        return $this->delivery_address_lng;
    }

    /**
     * Get the [delivery_address_locality] column value.
     *
     * @return string
     */
    public function getDeliveryAddressLocality()
    {
        return $this->delivery_address_locality;
    }

    /**
     * Get the [delivery_address_region] column value.
     *
     * @return string
     */
    public function getDeliveryAddressRegion()
    {
        return $this->delivery_address_region;
    }

    /**
     * Get the [delivery_address_country] column value.
     *
     * @return string
     */
    public function getDeliveryAddressCountry()
    {
        return $this->delivery_address_country;
    }

    /**
     * Get the [addressee_name] column value.
     *
     * @return string
     */
    public function getAddresseeName()
    {
        return $this->addressee_name;
    }

    /**
     * Get the [addressee_phone] column value.
     *
     * @return string
     */
    public function getAddresseePhone()
    {
        return $this->addressee_phone;
    }

    /**
     * Get the [delivery_address] column value.
     *
     * @return string
     */
    public function getDeliveryAddress()
    {
        return $this->delivery_address;
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
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_commerce] column.
     *
     * @param int $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setIdCommerce($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_commerce !== $v) {
            $this->id_commerce = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_ID_COMMERCE] = true;
        }

        return $this;
    } // setIdCommerce()

    /**
     * Set the value of [id_rate] column.
     *
     * @param int $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setIdRate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_rate !== $v) {
            $this->id_rate = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_ID_RATE] = true;
        }

        if ($this->aCommercesRates !== null && $this->aCommercesRates->getId() !== $v) {
            $this->aCommercesRates = null;
        }

        return $this;
    } // setIdRate()

    /**
     * Set the value of [id_shipment] column.
     *
     * @param int $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setIdShipment($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_shipment !== $v) {
            $this->id_shipment = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_ID_SHIPMENT] = true;
        }

        return $this;
    } // setIdShipment()

    /**
     * Set the value of [uuid] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setUuid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uuid !== $v) {
            $this->uuid = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_UUID] = true;
        }

        return $this;
    } // setUuid()

    /**
     * Set the value of [pickup_at_name] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setPickupAtName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pickup_at_name !== $v) {
            $this->pickup_at_name = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_PICKUP_AT_NAME] = true;
        }

        return $this;
    } // setPickupAtName()

    /**
     * Set the value of [pickup_at_lat] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setPickupAtLat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pickup_at_lat !== $v) {
            $this->pickup_at_lat = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_PICKUP_AT_LAT] = true;
        }

        return $this;
    } // setPickupAtLat()

    /**
     * Set the value of [pickup_at_lng] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setPickupAtLng($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pickup_at_lng !== $v) {
            $this->pickup_at_lng = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_PICKUP_AT_LNG] = true;
        }

        return $this;
    } // setPickupAtLng()

    /**
     * Set the value of [pickup_at_locality] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setPickupAtLocality($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pickup_at_locality !== $v) {
            $this->pickup_at_locality = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_PICKUP_AT_LOCALITY] = true;
        }

        return $this;
    } // setPickupAtLocality()

    /**
     * Set the value of [pickup_at_region] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setPickupAtRegion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pickup_at_region !== $v) {
            $this->pickup_at_region = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_PICKUP_AT_REGION] = true;
        }

        return $this;
    } // setPickupAtRegion()

    /**
     * Set the value of [pickup_at_country] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setPickupAtCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pickup_at_country !== $v) {
            $this->pickup_at_country = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_PICKUP_AT_COUNTRY] = true;
        }

        return $this;
    } // setPickupAtCountry()

    /**
     * Set the value of [size] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setSize($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->size !== $v) {
            $this->size = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_SIZE] = true;
        }

        return $this;
    } // setSize()

    /**
     * Set the value of [priority] column.
     *
     * @param int $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setPriority($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->priority !== $v) {
            $this->priority = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_PRIORITY] = true;
        }

        return $this;
    } // setPriority()

    /**
     * Set the value of [type] column.
     *
     * @param int $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [type_rate] column.
     *
     * @param int $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setTypeRate($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->type_rate !== $v) {
            $this->type_rate = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_TYPE_RATE] = true;
        }

        return $this;
    } // setTypeRate()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Sets the value of [delivery_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setDeliveryDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->delivery_date !== null || $dt !== null) {
            if ($this->delivery_date === null || $dt === null || $dt->format("Y-m-d") !== $this->delivery_date->format("Y-m-d")) {
                $this->delivery_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CommercesShipmentsTableMap::COL_DELIVERY_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setDeliveryDate()

    /**
     * Set the value of [delivery_address_lat] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setDeliveryAddressLat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_address_lat !== $v) {
            $this->delivery_address_lat = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LAT] = true;
        }

        return $this;
    } // setDeliveryAddressLat()

    /**
     * Set the value of [delivery_address_lng] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setDeliveryAddressLng($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_address_lng !== $v) {
            $this->delivery_address_lng = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LNG] = true;
        }

        return $this;
    } // setDeliveryAddressLng()

    /**
     * Set the value of [delivery_address_locality] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setDeliveryAddressLocality($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_address_locality !== $v) {
            $this->delivery_address_locality = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LOCALITY] = true;
        }

        return $this;
    } // setDeliveryAddressLocality()

    /**
     * Set the value of [delivery_address_region] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setDeliveryAddressRegion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_address_region !== $v) {
            $this->delivery_address_region = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_REGION] = true;
        }

        return $this;
    } // setDeliveryAddressRegion()

    /**
     * Set the value of [delivery_address_country] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setDeliveryAddressCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_address_country !== $v) {
            $this->delivery_address_country = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_COUNTRY] = true;
        }

        return $this;
    } // setDeliveryAddressCountry()

    /**
     * Set the value of [addressee_name] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setAddresseeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->addressee_name !== $v) {
            $this->addressee_name = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_ADDRESSEE_NAME] = true;
        }

        return $this;
    } // setAddresseeName()

    /**
     * Set the value of [addressee_phone] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setAddresseePhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->addressee_phone !== $v) {
            $this->addressee_phone = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_ADDRESSEE_PHONE] = true;
        }

        return $this;
    } // setAddresseePhone()

    /**
     * Set the value of [delivery_address] column.
     *
     * @param string $v new value
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setDeliveryAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_address !== $v) {
            $this->delivery_address = $v;
            $this->modifiedColumns[CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS] = true;
        }

        return $this;
    } // setDeliveryAddress()

    /**
     * Sets the value of [registered_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setRegisteredAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->registered_at !== null || $dt !== null) {
            if ($this->registered_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->registered_at->format("Y-m-d H:i:s")) {
                $this->registered_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CommercesShipmentsTableMap::COL_REGISTERED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setRegisteredAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\CommercesShipments The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CommercesShipmentsTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CommercesShipmentsTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CommercesShipmentsTableMap::translateFieldName('IdCommerce', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_commerce = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CommercesShipmentsTableMap::translateFieldName('IdRate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_rate = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CommercesShipmentsTableMap::translateFieldName('IdShipment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_shipment = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CommercesShipmentsTableMap::translateFieldName('Uuid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uuid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CommercesShipmentsTableMap::translateFieldName('PickupAtName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pickup_at_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CommercesShipmentsTableMap::translateFieldName('PickupAtLat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pickup_at_lat = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CommercesShipmentsTableMap::translateFieldName('PickupAtLng', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pickup_at_lng = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CommercesShipmentsTableMap::translateFieldName('PickupAtLocality', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pickup_at_locality = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CommercesShipmentsTableMap::translateFieldName('PickupAtRegion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pickup_at_region = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CommercesShipmentsTableMap::translateFieldName('PickupAtCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pickup_at_country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CommercesShipmentsTableMap::translateFieldName('Size', TableMap::TYPE_PHPNAME, $indexType)];
            $this->size = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CommercesShipmentsTableMap::translateFieldName('Priority', TableMap::TYPE_PHPNAME, $indexType)];
            $this->priority = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : CommercesShipmentsTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : CommercesShipmentsTableMap::translateFieldName('TypeRate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type_rate = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : CommercesShipmentsTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : CommercesShipmentsTableMap::translateFieldName('DeliveryDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->delivery_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : CommercesShipmentsTableMap::translateFieldName('DeliveryAddressLat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_address_lat = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : CommercesShipmentsTableMap::translateFieldName('DeliveryAddressLng', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_address_lng = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : CommercesShipmentsTableMap::translateFieldName('DeliveryAddressLocality', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_address_locality = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : CommercesShipmentsTableMap::translateFieldName('DeliveryAddressRegion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_address_region = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : CommercesShipmentsTableMap::translateFieldName('DeliveryAddressCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_address_country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : CommercesShipmentsTableMap::translateFieldName('AddresseeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->addressee_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : CommercesShipmentsTableMap::translateFieldName('AddresseePhone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->addressee_phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : CommercesShipmentsTableMap::translateFieldName('DeliveryAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : CommercesShipmentsTableMap::translateFieldName('RegisteredAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->registered_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : CommercesShipmentsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 27; // 27 = CommercesShipmentsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\CommercesShipments'), 0, $e);
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
        if ($this->aCommercesRates !== null && $this->id_rate !== $this->aCommercesRates->getId()) {
            $this->aCommercesRates = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(CommercesShipmentsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCommercesShipmentsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCommercesRates = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see CommercesShipments::setDeleted()
     * @see CommercesShipments::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesShipmentsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCommercesShipmentsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CommercesShipmentsTableMap::DATABASE_NAME);
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
                CommercesShipmentsTableMap::addInstanceToPool($this);
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

            if ($this->aCommercesRates !== null) {
                if ($this->aCommercesRates->isModified() || $this->aCommercesRates->isNew()) {
                    $affectedRows += $this->aCommercesRates->save($con);
                }
                $this->setCommercesRates($this->aCommercesRates);
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

        $this->modifiedColumns[CommercesShipmentsTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CommercesShipmentsTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_ID_COMMERCE)) {
            $modifiedColumns[':p' . $index++]  = '`id_commerce`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_ID_RATE)) {
            $modifiedColumns[':p' . $index++]  = '`id_rate`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_ID_SHIPMENT)) {
            $modifiedColumns[':p' . $index++]  = '`id_shipment`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_UUID)) {
            $modifiedColumns[':p' . $index++]  = '`uuid`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PICKUP_AT_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`pickup_at_name`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PICKUP_AT_LAT)) {
            $modifiedColumns[':p' . $index++]  = '`pickup_at_lat`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PICKUP_AT_LNG)) {
            $modifiedColumns[':p' . $index++]  = '`pickup_at_lng`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PICKUP_AT_LOCALITY)) {
            $modifiedColumns[':p' . $index++]  = '`pickup_at_locality`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PICKUP_AT_REGION)) {
            $modifiedColumns[':p' . $index++]  = '`pickup_at_region`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PICKUP_AT_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`pickup_at_country`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_SIZE)) {
            $modifiedColumns[':p' . $index++]  = '`size`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PRIORITY)) {
            $modifiedColumns[':p' . $index++]  = '`priority`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`type`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_TYPE_RATE)) {
            $modifiedColumns[':p' . $index++]  = '`type_rate`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`delivery_date`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LAT)) {
            $modifiedColumns[':p' . $index++]  = '`delivery_address_lat`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LNG)) {
            $modifiedColumns[':p' . $index++]  = '`delivery_address_lng`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LOCALITY)) {
            $modifiedColumns[':p' . $index++]  = '`delivery_address_locality`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_REGION)) {
            $modifiedColumns[':p' . $index++]  = '`delivery_address_region`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`delivery_address_country`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_ADDRESSEE_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`addressee_name`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_ADDRESSEE_PHONE)) {
            $modifiedColumns[':p' . $index++]  = '`addressee_phone`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`delivery_address`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_REGISTERED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`registered_at`';
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `commerces_shipments` (%s) VALUES (%s)',
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
                    case '`id_commerce`':
                        $stmt->bindValue($identifier, $this->id_commerce, PDO::PARAM_INT);
                        break;
                    case '`id_rate`':
                        $stmt->bindValue($identifier, $this->id_rate, PDO::PARAM_INT);
                        break;
                    case '`id_shipment`':
                        $stmt->bindValue($identifier, $this->id_shipment, PDO::PARAM_INT);
                        break;
                    case '`uuid`':
                        $stmt->bindValue($identifier, $this->uuid, PDO::PARAM_STR);
                        break;
                    case '`pickup_at_name`':
                        $stmt->bindValue($identifier, $this->pickup_at_name, PDO::PARAM_STR);
                        break;
                    case '`pickup_at_lat`':
                        $stmt->bindValue($identifier, $this->pickup_at_lat, PDO::PARAM_STR);
                        break;
                    case '`pickup_at_lng`':
                        $stmt->bindValue($identifier, $this->pickup_at_lng, PDO::PARAM_STR);
                        break;
                    case '`pickup_at_locality`':
                        $stmt->bindValue($identifier, $this->pickup_at_locality, PDO::PARAM_STR);
                        break;
                    case '`pickup_at_region`':
                        $stmt->bindValue($identifier, $this->pickup_at_region, PDO::PARAM_STR);
                        break;
                    case '`pickup_at_country`':
                        $stmt->bindValue($identifier, $this->pickup_at_country, PDO::PARAM_STR);
                        break;
                    case '`size`':
                        $stmt->bindValue($identifier, $this->size, PDO::PARAM_STR);
                        break;
                    case '`priority`':
                        $stmt->bindValue($identifier, $this->priority, PDO::PARAM_INT);
                        break;
                    case '`type`':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_INT);
                        break;
                    case '`type_rate`':
                        $stmt->bindValue($identifier, $this->type_rate, PDO::PARAM_INT);
                        break;
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case '`delivery_date`':
                        $stmt->bindValue($identifier, $this->delivery_date ? $this->delivery_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`delivery_address_lat`':
                        $stmt->bindValue($identifier, $this->delivery_address_lat, PDO::PARAM_STR);
                        break;
                    case '`delivery_address_lng`':
                        $stmt->bindValue($identifier, $this->delivery_address_lng, PDO::PARAM_STR);
                        break;
                    case '`delivery_address_locality`':
                        $stmt->bindValue($identifier, $this->delivery_address_locality, PDO::PARAM_STR);
                        break;
                    case '`delivery_address_region`':
                        $stmt->bindValue($identifier, $this->delivery_address_region, PDO::PARAM_STR);
                        break;
                    case '`delivery_address_country`':
                        $stmt->bindValue($identifier, $this->delivery_address_country, PDO::PARAM_STR);
                        break;
                    case '`addressee_name`':
                        $stmt->bindValue($identifier, $this->addressee_name, PDO::PARAM_STR);
                        break;
                    case '`addressee_phone`':
                        $stmt->bindValue($identifier, $this->addressee_phone, PDO::PARAM_STR);
                        break;
                    case '`delivery_address`':
                        $stmt->bindValue($identifier, $this->delivery_address, PDO::PARAM_STR);
                        break;
                    case '`registered_at`':
                        $stmt->bindValue($identifier, $this->registered_at ? $this->registered_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
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
        $pos = CommercesShipmentsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdCommerce();
                break;
            case 2:
                return $this->getIdRate();
                break;
            case 3:
                return $this->getIdShipment();
                break;
            case 4:
                return $this->getUuid();
                break;
            case 5:
                return $this->getPickupAtName();
                break;
            case 6:
                return $this->getPickupAtLat();
                break;
            case 7:
                return $this->getPickupAtLng();
                break;
            case 8:
                return $this->getPickupAtLocality();
                break;
            case 9:
                return $this->getPickupAtRegion();
                break;
            case 10:
                return $this->getPickupAtCountry();
                break;
            case 11:
                return $this->getSize();
                break;
            case 12:
                return $this->getPriority();
                break;
            case 13:
                return $this->getType();
                break;
            case 14:
                return $this->getTypeRate();
                break;
            case 15:
                return $this->getDescription();
                break;
            case 16:
                return $this->getDeliveryDate();
                break;
            case 17:
                return $this->getDeliveryAddressLat();
                break;
            case 18:
                return $this->getDeliveryAddressLng();
                break;
            case 19:
                return $this->getDeliveryAddressLocality();
                break;
            case 20:
                return $this->getDeliveryAddressRegion();
                break;
            case 21:
                return $this->getDeliveryAddressCountry();
                break;
            case 22:
                return $this->getAddresseeName();
                break;
            case 23:
                return $this->getAddresseePhone();
                break;
            case 24:
                return $this->getDeliveryAddress();
                break;
            case 25:
                return $this->getRegisteredAt();
                break;
            case 26:
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

        if (isset($alreadyDumpedObjects['CommercesShipments'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['CommercesShipments'][$this->hashCode()] = true;
        $keys = CommercesShipmentsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdCommerce(),
            $keys[2] => $this->getIdRate(),
            $keys[3] => $this->getIdShipment(),
            $keys[4] => $this->getUuid(),
            $keys[5] => $this->getPickupAtName(),
            $keys[6] => $this->getPickupAtLat(),
            $keys[7] => $this->getPickupAtLng(),
            $keys[8] => $this->getPickupAtLocality(),
            $keys[9] => $this->getPickupAtRegion(),
            $keys[10] => $this->getPickupAtCountry(),
            $keys[11] => $this->getSize(),
            $keys[12] => $this->getPriority(),
            $keys[13] => $this->getType(),
            $keys[14] => $this->getTypeRate(),
            $keys[15] => $this->getDescription(),
            $keys[16] => $this->getDeliveryDate(),
            $keys[17] => $this->getDeliveryAddressLat(),
            $keys[18] => $this->getDeliveryAddressLng(),
            $keys[19] => $this->getDeliveryAddressLocality(),
            $keys[20] => $this->getDeliveryAddressRegion(),
            $keys[21] => $this->getDeliveryAddressCountry(),
            $keys[22] => $this->getAddresseeName(),
            $keys[23] => $this->getAddresseePhone(),
            $keys[24] => $this->getDeliveryAddress(),
            $keys[25] => $this->getRegisteredAt(),
            $keys[26] => $this->getUpdatedAt(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[16]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[16]];
            $result[$keys[16]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[25]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[25]];
            $result[$keys[25]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[26]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[26]];
            $result[$keys[26]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCommercesRates) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'commercesRates';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'commerces_rates';
                        break;
                    default:
                        $key = 'CommercesRates';
                }

                $result[$key] = $this->aCommercesRates->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\CommercesShipments
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CommercesShipmentsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\CommercesShipments
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdCommerce($value);
                break;
            case 2:
                $this->setIdRate($value);
                break;
            case 3:
                $this->setIdShipment($value);
                break;
            case 4:
                $this->setUuid($value);
                break;
            case 5:
                $this->setPickupAtName($value);
                break;
            case 6:
                $this->setPickupAtLat($value);
                break;
            case 7:
                $this->setPickupAtLng($value);
                break;
            case 8:
                $this->setPickupAtLocality($value);
                break;
            case 9:
                $this->setPickupAtRegion($value);
                break;
            case 10:
                $this->setPickupAtCountry($value);
                break;
            case 11:
                $this->setSize($value);
                break;
            case 12:
                $this->setPriority($value);
                break;
            case 13:
                $this->setType($value);
                break;
            case 14:
                $this->setTypeRate($value);
                break;
            case 15:
                $this->setDescription($value);
                break;
            case 16:
                $this->setDeliveryDate($value);
                break;
            case 17:
                $this->setDeliveryAddressLat($value);
                break;
            case 18:
                $this->setDeliveryAddressLng($value);
                break;
            case 19:
                $this->setDeliveryAddressLocality($value);
                break;
            case 20:
                $this->setDeliveryAddressRegion($value);
                break;
            case 21:
                $this->setDeliveryAddressCountry($value);
                break;
            case 22:
                $this->setAddresseeName($value);
                break;
            case 23:
                $this->setAddresseePhone($value);
                break;
            case 24:
                $this->setDeliveryAddress($value);
                break;
            case 25:
                $this->setRegisteredAt($value);
                break;
            case 26:
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
        $keys = CommercesShipmentsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdCommerce($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdRate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIdShipment($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setUuid($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPickupAtName($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPickupAtLat($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPickupAtLng($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPickupAtLocality($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPickupAtRegion($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPickupAtCountry($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setSize($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setPriority($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setType($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setTypeRate($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setDescription($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setDeliveryDate($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setDeliveryAddressLat($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setDeliveryAddressLng($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setDeliveryAddressLocality($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setDeliveryAddressRegion($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setDeliveryAddressCountry($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setAddresseeName($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setAddresseePhone($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setDeliveryAddress($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setRegisteredAt($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setUpdatedAt($arr[$keys[26]]);
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
     * @return $this|\CommercesShipments The current object, for fluid interface
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
        $criteria = new Criteria(CommercesShipmentsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_ID)) {
            $criteria->add(CommercesShipmentsTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_ID_COMMERCE)) {
            $criteria->add(CommercesShipmentsTableMap::COL_ID_COMMERCE, $this->id_commerce);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_ID_RATE)) {
            $criteria->add(CommercesShipmentsTableMap::COL_ID_RATE, $this->id_rate);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_ID_SHIPMENT)) {
            $criteria->add(CommercesShipmentsTableMap::COL_ID_SHIPMENT, $this->id_shipment);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_UUID)) {
            $criteria->add(CommercesShipmentsTableMap::COL_UUID, $this->uuid);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PICKUP_AT_NAME)) {
            $criteria->add(CommercesShipmentsTableMap::COL_PICKUP_AT_NAME, $this->pickup_at_name);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PICKUP_AT_LAT)) {
            $criteria->add(CommercesShipmentsTableMap::COL_PICKUP_AT_LAT, $this->pickup_at_lat);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PICKUP_AT_LNG)) {
            $criteria->add(CommercesShipmentsTableMap::COL_PICKUP_AT_LNG, $this->pickup_at_lng);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PICKUP_AT_LOCALITY)) {
            $criteria->add(CommercesShipmentsTableMap::COL_PICKUP_AT_LOCALITY, $this->pickup_at_locality);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PICKUP_AT_REGION)) {
            $criteria->add(CommercesShipmentsTableMap::COL_PICKUP_AT_REGION, $this->pickup_at_region);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PICKUP_AT_COUNTRY)) {
            $criteria->add(CommercesShipmentsTableMap::COL_PICKUP_AT_COUNTRY, $this->pickup_at_country);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_SIZE)) {
            $criteria->add(CommercesShipmentsTableMap::COL_SIZE, $this->size);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_PRIORITY)) {
            $criteria->add(CommercesShipmentsTableMap::COL_PRIORITY, $this->priority);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_TYPE)) {
            $criteria->add(CommercesShipmentsTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_TYPE_RATE)) {
            $criteria->add(CommercesShipmentsTableMap::COL_TYPE_RATE, $this->type_rate);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DESCRIPTION)) {
            $criteria->add(CommercesShipmentsTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_DATE)) {
            $criteria->add(CommercesShipmentsTableMap::COL_DELIVERY_DATE, $this->delivery_date);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LAT)) {
            $criteria->add(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LAT, $this->delivery_address_lat);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LNG)) {
            $criteria->add(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LNG, $this->delivery_address_lng);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LOCALITY)) {
            $criteria->add(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_LOCALITY, $this->delivery_address_locality);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_REGION)) {
            $criteria->add(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_REGION, $this->delivery_address_region);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_COUNTRY)) {
            $criteria->add(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS_COUNTRY, $this->delivery_address_country);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_ADDRESSEE_NAME)) {
            $criteria->add(CommercesShipmentsTableMap::COL_ADDRESSEE_NAME, $this->addressee_name);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_ADDRESSEE_PHONE)) {
            $criteria->add(CommercesShipmentsTableMap::COL_ADDRESSEE_PHONE, $this->addressee_phone);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS)) {
            $criteria->add(CommercesShipmentsTableMap::COL_DELIVERY_ADDRESS, $this->delivery_address);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_REGISTERED_AT)) {
            $criteria->add(CommercesShipmentsTableMap::COL_REGISTERED_AT, $this->registered_at);
        }
        if ($this->isColumnModified(CommercesShipmentsTableMap::COL_UPDATED_AT)) {
            $criteria->add(CommercesShipmentsTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildCommercesShipmentsQuery::create();
        $criteria->add(CommercesShipmentsTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \CommercesShipments (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdCommerce($this->getIdCommerce());
        $copyObj->setIdRate($this->getIdRate());
        $copyObj->setIdShipment($this->getIdShipment());
        $copyObj->setUuid($this->getUuid());
        $copyObj->setPickupAtName($this->getPickupAtName());
        $copyObj->setPickupAtLat($this->getPickupAtLat());
        $copyObj->setPickupAtLng($this->getPickupAtLng());
        $copyObj->setPickupAtLocality($this->getPickupAtLocality());
        $copyObj->setPickupAtRegion($this->getPickupAtRegion());
        $copyObj->setPickupAtCountry($this->getPickupAtCountry());
        $copyObj->setSize($this->getSize());
        $copyObj->setPriority($this->getPriority());
        $copyObj->setType($this->getType());
        $copyObj->setTypeRate($this->getTypeRate());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setDeliveryDate($this->getDeliveryDate());
        $copyObj->setDeliveryAddressLat($this->getDeliveryAddressLat());
        $copyObj->setDeliveryAddressLng($this->getDeliveryAddressLng());
        $copyObj->setDeliveryAddressLocality($this->getDeliveryAddressLocality());
        $copyObj->setDeliveryAddressRegion($this->getDeliveryAddressRegion());
        $copyObj->setDeliveryAddressCountry($this->getDeliveryAddressCountry());
        $copyObj->setAddresseeName($this->getAddresseeName());
        $copyObj->setAddresseePhone($this->getAddresseePhone());
        $copyObj->setDeliveryAddress($this->getDeliveryAddress());
        $copyObj->setRegisteredAt($this->getRegisteredAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
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
     * @return \CommercesShipments Clone of current object.
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
     * Declares an association between this object and a ChildCommercesRates object.
     *
     * @param  ChildCommercesRates $v
     * @return $this|\CommercesShipments The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCommercesRates(ChildCommercesRates $v = null)
    {
        if ($v === null) {
            $this->setIdRate(NULL);
        } else {
            $this->setIdRate($v->getId());
        }

        $this->aCommercesRates = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCommercesRates object, it will not be re-added.
        if ($v !== null) {
            $v->addCommercesShipments($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCommercesRates object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCommercesRates The associated ChildCommercesRates object.
     * @throws PropelException
     */
    public function getCommercesRates(ConnectionInterface $con = null)
    {
        if ($this->aCommercesRates === null && ($this->id_rate !== null)) {
            $this->aCommercesRates = ChildCommercesRatesQuery::create()->findPk($this->id_rate, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCommercesRates->addCommercesShipmentss($this);
             */
        }

        return $this->aCommercesRates;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCommercesRates) {
            $this->aCommercesRates->removeCommercesShipments($this);
        }
        $this->id = null;
        $this->id_commerce = null;
        $this->id_rate = null;
        $this->id_shipment = null;
        $this->uuid = null;
        $this->pickup_at_name = null;
        $this->pickup_at_lat = null;
        $this->pickup_at_lng = null;
        $this->pickup_at_locality = null;
        $this->pickup_at_region = null;
        $this->pickup_at_country = null;
        $this->size = null;
        $this->priority = null;
        $this->type = null;
        $this->type_rate = null;
        $this->description = null;
        $this->delivery_date = null;
        $this->delivery_address_lat = null;
        $this->delivery_address_lng = null;
        $this->delivery_address_locality = null;
        $this->delivery_address_region = null;
        $this->delivery_address_country = null;
        $this->addressee_name = null;
        $this->addressee_phone = null;
        $this->delivery_address = null;
        $this->registered_at = null;
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
        } // if ($deep)

        $this->aCommercesRates = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CommercesShipmentsTableMap::DEFAULT_STRING_FORMAT);
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
