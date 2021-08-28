<?php

namespace Base;

use \ShipmentsQuery as ChildShipmentsQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\ShipmentsTableMap;
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
 * Base class that represents a row from the 'shipments' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Shipments implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ShipmentsTableMap';


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
     * The value for the id_product_type field.
     * @var        int
     */
    protected $id_product_type;

    /**
     * The value for the id_shipment_type field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $id_shipment_type;

    /**
     * The value for the id_status field.
     * @var        int
     */
    protected $id_status;

    /**
     * The value for the pin field.
     * @var        string
     */
    protected $pin;

    /**
     * The value for the start_address field.
     * @var        string
     */
    protected $start_address;

    /**
     * The value for the start_address_place_id field.
     * @var        string
     */
    protected $start_address_place_id;

    /**
     * The value for the start_address_lat field.
     * @var        string
     */
    protected $start_address_lat;

    /**
     * The value for the start_address_lon field.
     * @var        string
     */
    protected $start_address_lon;

    /**
     * The value for the start_address_locality field.
     * @var        string
     */
    protected $start_address_locality;

    /**
     * The value for the start_address_region field.
     * @var        string
     */
    protected $start_address_region;

    /**
     * The value for the start_address_country field.
     * @var        string
     */
    protected $start_address_country;

    /**
     * The value for the waypoint_address field.
     * @var        string
     */
    protected $waypoint_address;

    /**
     * The value for the waypoint_address_place_id field.
     * @var        string
     */
    protected $waypoint_address_place_id;

    /**
     * The value for the waypoint_address_lat field.
     * @var        string
     */
    protected $waypoint_address_lat;

    /**
     * The value for the waypoint_address_lon field.
     * @var        string
     */
    protected $waypoint_address_lon;

    /**
     * The value for the waypoint_address_locality field.
     * @var        string
     */
    protected $waypoint_address_locality;

    /**
     * The value for the waypoint_address_region field.
     * @var        string
     */
    protected $waypoint_address_region;

    /**
     * The value for the waypoint_address_country field.
     * @var        string
     */
    protected $waypoint_address_country;

    /**
     * The value for the end_address field.
     * @var        string
     */
    protected $end_address;

    /**
     * The value for the end_address_place_id field.
     * @var        string
     */
    protected $end_address_place_id;

    /**
     * The value for the end_address_lat field.
     * @var        string
     */
    protected $end_address_lat;

    /**
     * The value for the end_address_lon field.
     * @var        string
     */
    protected $end_address_lon;

    /**
     * The value for the end_address_locality field.
     * @var        string
     */
    protected $end_address_locality;

    /**
     * The value for the end_address_region field.
     * @var        string
     */
    protected $end_address_region;

    /**
     * The value for the end_address_country field.
     * @var        string
     */
    protected $end_address_country;

    /**
     * The value for the receiver_name field.
     * @var        string
     */
    protected $receiver_name;

    /**
     * The value for the receiver_phone field.
     * @var        string
     */
    protected $receiver_phone;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the measurements_width field.
     * @var        double
     */
    protected $measurements_width;

    /**
     * The value for the measurements_width_unit field.
     * @var        string
     */
    protected $measurements_width_unit;

    /**
     * The value for the measurements_height field.
     * @var        double
     */
    protected $measurements_height;

    /**
     * The value for the measurements_height_unit field.
     * @var        string
     */
    protected $measurements_height_unit;

    /**
     * The value for the measurements_depth field.
     * @var        double
     */
    protected $measurements_depth;

    /**
     * The value for the measurements_depth_unit field.
     * @var        string
     */
    protected $measurements_depth_unit;

    /**
     * The value for the measurements_weight field.
     * @var        double
     */
    protected $measurements_weight;

    /**
     * The value for the measurements_weight_unit field.
     * @var        string
     */
    protected $measurements_weight_unit;

    /**
     * The value for the out_now field.
     * @var        boolean
     */
    protected $out_now;

    /**
     * The value for the max_arrival_date field.
     * @var        \DateTime
     */
    protected $max_arrival_date;

    /**
     * The value for the receive_offers field.
     * @var        boolean
     */
    protected $receive_offers;

    /**
     * The value for the amount_payable field.
     * @var        double
     */
    protected $amount_payable;

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
     * The value for the address_dist_1_dis_value field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $address_dist_1_dis_value;

    /**
     * The value for the address_dist_1_dis_desc field.
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $address_dist_1_dis_desc;

    /**
     * The value for the address_dist_1_dur_value field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $address_dist_1_dur_value;

    /**
     * The value for the address_dist_1_dur_desc field.
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $address_dist_1_dur_desc;

    /**
     * The value for the address_dist_2_dis_value field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $address_dist_2_dis_value;

    /**
     * The value for the address_dist_2_dis_desc field.
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $address_dist_2_dis_desc;

    /**
     * The value for the address_dist_2_dur_value field.
     * @var        int
     */
    protected $address_dist_2_dur_value;

    /**
     * The value for the address_dist_2_dur_desc field.
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $address_dist_2_dur_desc;

    /**
     * The value for the delivered_at field.
     * @var        \DateTime
     */
    protected $delivered_at;

    /**
     * The value for the declared_value field.
     * @var        double
     */
    protected $declared_value;

    /**
     * The value for the additional_address_information field.
     * @var        string
     */
    protected $additional_address_information;

    /**
     * The value for the must_arrive field.
     * @var        \DateTime
     */
    protected $must_arrive;

    /**
     * The value for the max_offers field.
     * @var        int
     */
    protected $max_offers;

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
        $this->id_shipment_type = 0;
        $this->address_dist_1_dis_value = 0;
        $this->address_dist_1_dis_desc = '';
        $this->address_dist_1_dur_value = 0;
        $this->address_dist_1_dur_desc = '';
        $this->address_dist_2_dis_value = 0;
        $this->address_dist_2_dis_desc = '';
        $this->address_dist_2_dur_desc = '';
    }

    /**
     * Initializes internal state of Base\Shipments object.
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
     * Compares this with another <code>Shipments</code> instance.  If
     * <code>obj</code> is an instance of <code>Shipments</code>, delegates to
     * <code>equals(Shipments)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Shipments The current object, for fluid interface
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
     * Get the [id_product_type] column value.
     *
     * @return int
     */
    public function getIdProductType()
    {
        return $this->id_product_type;
    }

    /**
     * Get the [id_shipment_type] column value.
     *
     * @return int
     */
    public function getIdShipmentType()
    {
        return $this->id_shipment_type;
    }

    /**
     * Get the [id_status] column value.
     *
     * @return int
     */
    public function getIdStatus()
    {
        return $this->id_status;
    }

    /**
     * Get the [pin] column value.
     *
     * @return string
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * Get the [start_address] column value.
     *
     * @return string
     */
    public function getStartAddress()
    {
        return $this->start_address;
    }

    /**
     * Get the [start_address_place_id] column value.
     *
     * @return string
     */
    public function getStartAddressPlaceId()
    {
        return $this->start_address_place_id;
    }

    /**
     * Get the [start_address_lat] column value.
     *
     * @return string
     */
    public function getStartAddressLat()
    {
        return $this->start_address_lat;
    }

    /**
     * Get the [start_address_lon] column value.
     *
     * @return string
     */
    public function getStartAddressLon()
    {
        return $this->start_address_lon;
    }

    /**
     * Get the [start_address_locality] column value.
     *
     * @return string
     */
    public function getStartAddressLocality()
    {
        return $this->start_address_locality;
    }

    /**
     * Get the [start_address_region] column value.
     *
     * @return string
     */
    public function getStartAddressRegion()
    {
        return $this->start_address_region;
    }

    /**
     * Get the [start_address_country] column value.
     *
     * @return string
     */
    public function getStartAddressCountry()
    {
        return $this->start_address_country;
    }

    /**
     * Get the [waypoint_address] column value.
     *
     * @return string
     */
    public function getWaypointAddress()
    {
        return $this->waypoint_address;
    }

    /**
     * Get the [waypoint_address_place_id] column value.
     *
     * @return string
     */
    public function getWaypointAddressPlaceId()
    {
        return $this->waypoint_address_place_id;
    }

    /**
     * Get the [waypoint_address_lat] column value.
     *
     * @return string
     */
    public function getWaypointAddressLat()
    {
        return $this->waypoint_address_lat;
    }

    /**
     * Get the [waypoint_address_lon] column value.
     *
     * @return string
     */
    public function getWaypointAddressLon()
    {
        return $this->waypoint_address_lon;
    }

    /**
     * Get the [waypoint_address_locality] column value.
     *
     * @return string
     */
    public function getWaypointAddressLocality()
    {
        return $this->waypoint_address_locality;
    }

    /**
     * Get the [waypoint_address_region] column value.
     *
     * @return string
     */
    public function getWaypointAddressRegion()
    {
        return $this->waypoint_address_region;
    }

    /**
     * Get the [waypoint_address_country] column value.
     *
     * @return string
     */
    public function getWaypointAddressCountry()
    {
        return $this->waypoint_address_country;
    }

    /**
     * Get the [end_address] column value.
     *
     * @return string
     */
    public function getEndAddress()
    {
        return $this->end_address;
    }

    /**
     * Get the [end_address_place_id] column value.
     *
     * @return string
     */
    public function getEndAddressPlaceId()
    {
        return $this->end_address_place_id;
    }

    /**
     * Get the [end_address_lat] column value.
     *
     * @return string
     */
    public function getEndAddressLat()
    {
        return $this->end_address_lat;
    }

    /**
     * Get the [end_address_lon] column value.
     *
     * @return string
     */
    public function getEndAddressLon()
    {
        return $this->end_address_lon;
    }

    /**
     * Get the [end_address_locality] column value.
     *
     * @return string
     */
    public function getEndAddressLocality()
    {
        return $this->end_address_locality;
    }

    /**
     * Get the [end_address_region] column value.
     *
     * @return string
     */
    public function getEndAddressRegion()
    {
        return $this->end_address_region;
    }

    /**
     * Get the [end_address_country] column value.
     *
     * @return string
     */
    public function getEndAddressCountry()
    {
        return $this->end_address_country;
    }

    /**
     * Get the [receiver_name] column value.
     *
     * @return string
     */
    public function getReceiverName()
    {
        return $this->receiver_name;
    }

    /**
     * Get the [receiver_phone] column value.
     *
     * @return string
     */
    public function getReceiverPhone()
    {
        return $this->receiver_phone;
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
     * Get the [measurements_width] column value.
     *
     * @return double
     */
    public function getMeasurementsWidth()
    {
        return $this->measurements_width;
    }

    /**
     * Get the [measurements_width_unit] column value.
     *
     * @return string
     */
    public function getMeasurementsWidthUnit()
    {
        return $this->measurements_width_unit;
    }

    /**
     * Get the [measurements_height] column value.
     *
     * @return double
     */
    public function getMeasurementsHeight()
    {
        return $this->measurements_height;
    }

    /**
     * Get the [measurements_height_unit] column value.
     *
     * @return string
     */
    public function getMeasurementsHeightUnit()
    {
        return $this->measurements_height_unit;
    }

    /**
     * Get the [measurements_depth] column value.
     *
     * @return double
     */
    public function getMeasurementsDepth()
    {
        return $this->measurements_depth;
    }

    /**
     * Get the [measurements_depth_unit] column value.
     *
     * @return string
     */
    public function getMeasurementsDepthUnit()
    {
        return $this->measurements_depth_unit;
    }

    /**
     * Get the [measurements_weight] column value.
     *
     * @return double
     */
    public function getMeasurementsWeight()
    {
        return $this->measurements_weight;
    }

    /**
     * Get the [measurements_weight_unit] column value.
     *
     * @return string
     */
    public function getMeasurementsWeightUnit()
    {
        return $this->measurements_weight_unit;
    }

    /**
     * Get the [out_now] column value.
     *
     * @return boolean
     */
    public function getOutNow()
    {
        return $this->out_now;
    }

    /**
     * Get the [out_now] column value.
     *
     * @return boolean
     */
    public function isOutNow()
    {
        return $this->getOutNow();
    }

    /**
     * Get the [optionally formatted] temporal [max_arrival_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getMaxArrivalDate($format = NULL)
    {
        if ($format === null) {
            return $this->max_arrival_date;
        } else {
            return $this->max_arrival_date instanceof \DateTime ? $this->max_arrival_date->format($format) : null;
        }
    }

    /**
     * Get the [receive_offers] column value.
     *
     * @return boolean
     */
    public function getReceiveOffers()
    {
        return $this->receive_offers;
    }

    /**
     * Get the [receive_offers] column value.
     *
     * @return boolean
     */
    public function isReceiveOffers()
    {
        return $this->getReceiveOffers();
    }

    /**
     * Get the [amount_payable] column value.
     *
     * @return double
     */
    public function getAmountPayable()
    {
        return $this->amount_payable;
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
     * Get the [address_dist_1_dis_value] column value.
     *
     * @return int
     */
    public function getAddressDist1DisValue()
    {
        return $this->address_dist_1_dis_value;
    }

    /**
     * Get the [address_dist_1_dis_desc] column value.
     *
     * @return string
     */
    public function getAddressDist1DisDesc()
    {
        return $this->address_dist_1_dis_desc;
    }

    /**
     * Get the [address_dist_1_dur_value] column value.
     *
     * @return int
     */
    public function getAddressDist1DurValue()
    {
        return $this->address_dist_1_dur_value;
    }

    /**
     * Get the [address_dist_1_dur_desc] column value.
     *
     * @return string
     */
    public function getAddressDist1DurDesc()
    {
        return $this->address_dist_1_dur_desc;
    }

    /**
     * Get the [address_dist_2_dis_value] column value.
     *
     * @return int
     */
    public function getAddressDist2DisValue()
    {
        return $this->address_dist_2_dis_value;
    }

    /**
     * Get the [address_dist_2_dis_desc] column value.
     *
     * @return string
     */
    public function getAddressDist2DisDesc()
    {
        return $this->address_dist_2_dis_desc;
    }

    /**
     * Get the [address_dist_2_dur_value] column value.
     *
     * @return int
     */
    public function getAddressDist2DurValue()
    {
        return $this->address_dist_2_dur_value;
    }

    /**
     * Get the [address_dist_2_dur_desc] column value.
     *
     * @return string
     */
    public function getAddressDist2DurDesc()
    {
        return $this->address_dist_2_dur_desc;
    }

    /**
     * Get the [optionally formatted] temporal [delivered_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDeliveredAt($format = NULL)
    {
        if ($format === null) {
            return $this->delivered_at;
        } else {
            return $this->delivered_at instanceof \DateTime ? $this->delivered_at->format($format) : null;
        }
    }

    /**
     * Get the [declared_value] column value.
     *
     * @return double
     */
    public function getDeclaredValue()
    {
        return $this->declared_value;
    }

    /**
     * Get the [additional_address_information] column value.
     *
     * @return string
     */
    public function getAdditionalAddressInformation()
    {
        return $this->additional_address_information;
    }

    /**
     * Get the [optionally formatted] temporal [must_arrive] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getMustArrive($format = NULL)
    {
        if ($format === null) {
            return $this->must_arrive;
        } else {
            return $this->must_arrive instanceof \DateTime ? $this->must_arrive->format($format) : null;
        }
    }

    /**
     * Get the [max_offers] column value.
     *
     * @return int
     */
    public function getMaxOffers()
    {
        return $this->max_offers;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_user] column.
     *
     * @param int $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setIdUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_user !== $v) {
            $this->id_user = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ID_USER] = true;
        }

        return $this;
    } // setIdUser()

    /**
     * Set the value of [id_product_type] column.
     *
     * @param int $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setIdProductType($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_product_type !== $v) {
            $this->id_product_type = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ID_PRODUCT_TYPE] = true;
        }

        return $this;
    } // setIdProductType()

    /**
     * Set the value of [id_shipment_type] column.
     *
     * @param int $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setIdShipmentType($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_shipment_type !== $v) {
            $this->id_shipment_type = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ID_SHIPMENT_TYPE] = true;
        }

        return $this;
    } // setIdShipmentType()

    /**
     * Set the value of [id_status] column.
     *
     * @param int $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setIdStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_status !== $v) {
            $this->id_status = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ID_STATUS] = true;
        }

        return $this;
    } // setIdStatus()

    /**
     * Set the value of [pin] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setPin($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pin !== $v) {
            $this->pin = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_PIN] = true;
        }

        return $this;
    } // setPin()

    /**
     * Set the value of [start_address] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setStartAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_address !== $v) {
            $this->start_address = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_START_ADDRESS] = true;
        }

        return $this;
    } // setStartAddress()

    /**
     * Set the value of [start_address_place_id] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setStartAddressPlaceId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_address_place_id !== $v) {
            $this->start_address_place_id = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_START_ADDRESS_PLACE_ID] = true;
        }

        return $this;
    } // setStartAddressPlaceId()

    /**
     * Set the value of [start_address_lat] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setStartAddressLat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_address_lat !== $v) {
            $this->start_address_lat = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_START_ADDRESS_LAT] = true;
        }

        return $this;
    } // setStartAddressLat()

    /**
     * Set the value of [start_address_lon] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setStartAddressLon($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_address_lon !== $v) {
            $this->start_address_lon = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_START_ADDRESS_LON] = true;
        }

        return $this;
    } // setStartAddressLon()

    /**
     * Set the value of [start_address_locality] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setStartAddressLocality($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_address_locality !== $v) {
            $this->start_address_locality = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_START_ADDRESS_LOCALITY] = true;
        }

        return $this;
    } // setStartAddressLocality()

    /**
     * Set the value of [start_address_region] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setStartAddressRegion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_address_region !== $v) {
            $this->start_address_region = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_START_ADDRESS_REGION] = true;
        }

        return $this;
    } // setStartAddressRegion()

    /**
     * Set the value of [start_address_country] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setStartAddressCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_address_country !== $v) {
            $this->start_address_country = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_START_ADDRESS_COUNTRY] = true;
        }

        return $this;
    } // setStartAddressCountry()

    /**
     * Set the value of [waypoint_address] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setWaypointAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->waypoint_address !== $v) {
            $this->waypoint_address = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_WAYPOINT_ADDRESS] = true;
        }

        return $this;
    } // setWaypointAddress()

    /**
     * Set the value of [waypoint_address_place_id] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setWaypointAddressPlaceId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->waypoint_address_place_id !== $v) {
            $this->waypoint_address_place_id = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_WAYPOINT_ADDRESS_PLACE_ID] = true;
        }

        return $this;
    } // setWaypointAddressPlaceId()

    /**
     * Set the value of [waypoint_address_lat] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setWaypointAddressLat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->waypoint_address_lat !== $v) {
            $this->waypoint_address_lat = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LAT] = true;
        }

        return $this;
    } // setWaypointAddressLat()

    /**
     * Set the value of [waypoint_address_lon] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setWaypointAddressLon($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->waypoint_address_lon !== $v) {
            $this->waypoint_address_lon = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LON] = true;
        }

        return $this;
    } // setWaypointAddressLon()

    /**
     * Set the value of [waypoint_address_locality] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setWaypointAddressLocality($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->waypoint_address_locality !== $v) {
            $this->waypoint_address_locality = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LOCALITY] = true;
        }

        return $this;
    } // setWaypointAddressLocality()

    /**
     * Set the value of [waypoint_address_region] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setWaypointAddressRegion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->waypoint_address_region !== $v) {
            $this->waypoint_address_region = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_WAYPOINT_ADDRESS_REGION] = true;
        }

        return $this;
    } // setWaypointAddressRegion()

    /**
     * Set the value of [waypoint_address_country] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setWaypointAddressCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->waypoint_address_country !== $v) {
            $this->waypoint_address_country = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_WAYPOINT_ADDRESS_COUNTRY] = true;
        }

        return $this;
    } // setWaypointAddressCountry()

    /**
     * Set the value of [end_address] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setEndAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_address !== $v) {
            $this->end_address = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_END_ADDRESS] = true;
        }

        return $this;
    } // setEndAddress()

    /**
     * Set the value of [end_address_place_id] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setEndAddressPlaceId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_address_place_id !== $v) {
            $this->end_address_place_id = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_END_ADDRESS_PLACE_ID] = true;
        }

        return $this;
    } // setEndAddressPlaceId()

    /**
     * Set the value of [end_address_lat] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setEndAddressLat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_address_lat !== $v) {
            $this->end_address_lat = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_END_ADDRESS_LAT] = true;
        }

        return $this;
    } // setEndAddressLat()

    /**
     * Set the value of [end_address_lon] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setEndAddressLon($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_address_lon !== $v) {
            $this->end_address_lon = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_END_ADDRESS_LON] = true;
        }

        return $this;
    } // setEndAddressLon()

    /**
     * Set the value of [end_address_locality] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setEndAddressLocality($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_address_locality !== $v) {
            $this->end_address_locality = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_END_ADDRESS_LOCALITY] = true;
        }

        return $this;
    } // setEndAddressLocality()

    /**
     * Set the value of [end_address_region] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setEndAddressRegion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_address_region !== $v) {
            $this->end_address_region = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_END_ADDRESS_REGION] = true;
        }

        return $this;
    } // setEndAddressRegion()

    /**
     * Set the value of [end_address_country] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setEndAddressCountry($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_address_country !== $v) {
            $this->end_address_country = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_END_ADDRESS_COUNTRY] = true;
        }

        return $this;
    } // setEndAddressCountry()

    /**
     * Set the value of [receiver_name] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setReceiverName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->receiver_name !== $v) {
            $this->receiver_name = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_RECEIVER_NAME] = true;
        }

        return $this;
    } // setReceiverName()

    /**
     * Set the value of [receiver_phone] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setReceiverPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->receiver_phone !== $v) {
            $this->receiver_phone = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_RECEIVER_PHONE] = true;
        }

        return $this;
    } // setReceiverPhone()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [measurements_width] column.
     *
     * @param double $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setMeasurementsWidth($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->measurements_width !== $v) {
            $this->measurements_width = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_MEASUREMENTS_WIDTH] = true;
        }

        return $this;
    } // setMeasurementsWidth()

    /**
     * Set the value of [measurements_width_unit] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setMeasurementsWidthUnit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->measurements_width_unit !== $v) {
            $this->measurements_width_unit = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_MEASUREMENTS_WIDTH_UNIT] = true;
        }

        return $this;
    } // setMeasurementsWidthUnit()

    /**
     * Set the value of [measurements_height] column.
     *
     * @param double $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setMeasurementsHeight($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->measurements_height !== $v) {
            $this->measurements_height = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT] = true;
        }

        return $this;
    } // setMeasurementsHeight()

    /**
     * Set the value of [measurements_height_unit] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setMeasurementsHeightUnit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->measurements_height_unit !== $v) {
            $this->measurements_height_unit = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT_UNIT] = true;
        }

        return $this;
    } // setMeasurementsHeightUnit()

    /**
     * Set the value of [measurements_depth] column.
     *
     * @param double $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setMeasurementsDepth($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->measurements_depth !== $v) {
            $this->measurements_depth = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_MEASUREMENTS_DEPTH] = true;
        }

        return $this;
    } // setMeasurementsDepth()

    /**
     * Set the value of [measurements_depth_unit] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setMeasurementsDepthUnit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->measurements_depth_unit !== $v) {
            $this->measurements_depth_unit = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_MEASUREMENTS_DEPTH_UNIT] = true;
        }

        return $this;
    } // setMeasurementsDepthUnit()

    /**
     * Set the value of [measurements_weight] column.
     *
     * @param double $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setMeasurementsWeight($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->measurements_weight !== $v) {
            $this->measurements_weight = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT] = true;
        }

        return $this;
    } // setMeasurementsWeight()

    /**
     * Set the value of [measurements_weight_unit] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setMeasurementsWeightUnit($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->measurements_weight_unit !== $v) {
            $this->measurements_weight_unit = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT_UNIT] = true;
        }

        return $this;
    } // setMeasurementsWeightUnit()

    /**
     * Sets the value of the [out_now] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setOutNow($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->out_now !== $v) {
            $this->out_now = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_OUT_NOW] = true;
        }

        return $this;
    } // setOutNow()

    /**
     * Sets the value of [max_arrival_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setMaxArrivalDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->max_arrival_date !== null || $dt !== null) {
            if ($this->max_arrival_date === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->max_arrival_date->format("Y-m-d H:i:s")) {
                $this->max_arrival_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ShipmentsTableMap::COL_MAX_ARRIVAL_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setMaxArrivalDate()

    /**
     * Sets the value of the [receive_offers] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setReceiveOffers($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->receive_offers !== $v) {
            $this->receive_offers = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_RECEIVE_OFFERS] = true;
        }

        return $this;
    } // setReceiveOffers()

    /**
     * Set the value of [amount_payable] column.
     *
     * @param double $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setAmountPayable($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->amount_payable !== $v) {
            $this->amount_payable = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_AMOUNT_PAYABLE] = true;
        }

        return $this;
    } // setAmountPayable()

    /**
     * Sets the value of [registered_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setRegisteredAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->registered_at !== null || $dt !== null) {
            if ($this->registered_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->registered_at->format("Y-m-d H:i:s")) {
                $this->registered_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ShipmentsTableMap::COL_REGISTERED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setRegisteredAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ShipmentsTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Set the value of [address_dist_1_dis_value] column.
     *
     * @param int $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setAddressDist1DisValue($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->address_dist_1_dis_value !== $v) {
            $this->address_dist_1_dis_value = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_VALUE] = true;
        }

        return $this;
    } // setAddressDist1DisValue()

    /**
     * Set the value of [address_dist_1_dis_desc] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setAddressDist1DisDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_dist_1_dis_desc !== $v) {
            $this->address_dist_1_dis_desc = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_DESC] = true;
        }

        return $this;
    } // setAddressDist1DisDesc()

    /**
     * Set the value of [address_dist_1_dur_value] column.
     *
     * @param int $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setAddressDist1DurValue($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->address_dist_1_dur_value !== $v) {
            $this->address_dist_1_dur_value = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_VALUE] = true;
        }

        return $this;
    } // setAddressDist1DurValue()

    /**
     * Set the value of [address_dist_1_dur_desc] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setAddressDist1DurDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_dist_1_dur_desc !== $v) {
            $this->address_dist_1_dur_desc = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_DESC] = true;
        }

        return $this;
    } // setAddressDist1DurDesc()

    /**
     * Set the value of [address_dist_2_dis_value] column.
     *
     * @param int $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setAddressDist2DisValue($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->address_dist_2_dis_value !== $v) {
            $this->address_dist_2_dis_value = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_VALUE] = true;
        }

        return $this;
    } // setAddressDist2DisValue()

    /**
     * Set the value of [address_dist_2_dis_desc] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setAddressDist2DisDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_dist_2_dis_desc !== $v) {
            $this->address_dist_2_dis_desc = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_DESC] = true;
        }

        return $this;
    } // setAddressDist2DisDesc()

    /**
     * Set the value of [address_dist_2_dur_value] column.
     *
     * @param int $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setAddressDist2DurValue($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->address_dist_2_dur_value !== $v) {
            $this->address_dist_2_dur_value = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_VALUE] = true;
        }

        return $this;
    } // setAddressDist2DurValue()

    /**
     * Set the value of [address_dist_2_dur_desc] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setAddressDist2DurDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_dist_2_dur_desc !== $v) {
            $this->address_dist_2_dur_desc = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_DESC] = true;
        }

        return $this;
    } // setAddressDist2DurDesc()

    /**
     * Sets the value of [delivered_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setDeliveredAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->delivered_at !== null || $dt !== null) {
            if ($this->delivered_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->delivered_at->format("Y-m-d H:i:s")) {
                $this->delivered_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ShipmentsTableMap::COL_DELIVERED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setDeliveredAt()

    /**
     * Set the value of [declared_value] column.
     *
     * @param double $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setDeclaredValue($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->declared_value !== $v) {
            $this->declared_value = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_DECLARED_VALUE] = true;
        }

        return $this;
    } // setDeclaredValue()

    /**
     * Set the value of [additional_address_information] column.
     *
     * @param string $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setAdditionalAddressInformation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->additional_address_information !== $v) {
            $this->additional_address_information = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_ADDITIONAL_ADDRESS_INFORMATION] = true;
        }

        return $this;
    } // setAdditionalAddressInformation()

    /**
     * Sets the value of [must_arrive] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setMustArrive($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->must_arrive !== null || $dt !== null) {
            if ($this->must_arrive === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->must_arrive->format("Y-m-d H:i:s")) {
                $this->must_arrive = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ShipmentsTableMap::COL_MUST_ARRIVE] = true;
            }
        } // if either are not null

        return $this;
    } // setMustArrive()

    /**
     * Set the value of [max_offers] column.
     *
     * @param int $v new value
     * @return $this|\Shipments The current object (for fluent API support)
     */
    public function setMaxOffers($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->max_offers !== $v) {
            $this->max_offers = $v;
            $this->modifiedColumns[ShipmentsTableMap::COL_MAX_OFFERS] = true;
        }

        return $this;
    } // setMaxOffers()

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
            if ($this->id_shipment_type !== 0) {
                return false;
            }

            if ($this->address_dist_1_dis_value !== 0) {
                return false;
            }

            if ($this->address_dist_1_dis_desc !== '') {
                return false;
            }

            if ($this->address_dist_1_dur_value !== 0) {
                return false;
            }

            if ($this->address_dist_1_dur_desc !== '') {
                return false;
            }

            if ($this->address_dist_2_dis_value !== 0) {
                return false;
            }

            if ($this->address_dist_2_dis_desc !== '') {
                return false;
            }

            if ($this->address_dist_2_dur_desc !== '') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ShipmentsTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ShipmentsTableMap::translateFieldName('IdUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ShipmentsTableMap::translateFieldName('IdProductType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ShipmentsTableMap::translateFieldName('IdShipmentType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_shipment_type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ShipmentsTableMap::translateFieldName('IdStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ShipmentsTableMap::translateFieldName('Pin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pin = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ShipmentsTableMap::translateFieldName('StartAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ShipmentsTableMap::translateFieldName('StartAddressPlaceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_address_place_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ShipmentsTableMap::translateFieldName('StartAddressLat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_address_lat = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ShipmentsTableMap::translateFieldName('StartAddressLon', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_address_lon = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ShipmentsTableMap::translateFieldName('StartAddressLocality', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_address_locality = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ShipmentsTableMap::translateFieldName('StartAddressRegion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_address_region = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ShipmentsTableMap::translateFieldName('StartAddressCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->start_address_country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ShipmentsTableMap::translateFieldName('WaypointAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->waypoint_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ShipmentsTableMap::translateFieldName('WaypointAddressPlaceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->waypoint_address_place_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ShipmentsTableMap::translateFieldName('WaypointAddressLat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->waypoint_address_lat = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ShipmentsTableMap::translateFieldName('WaypointAddressLon', TableMap::TYPE_PHPNAME, $indexType)];
            $this->waypoint_address_lon = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ShipmentsTableMap::translateFieldName('WaypointAddressLocality', TableMap::TYPE_PHPNAME, $indexType)];
            $this->waypoint_address_locality = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ShipmentsTableMap::translateFieldName('WaypointAddressRegion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->waypoint_address_region = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ShipmentsTableMap::translateFieldName('WaypointAddressCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->waypoint_address_country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ShipmentsTableMap::translateFieldName('EndAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ShipmentsTableMap::translateFieldName('EndAddressPlaceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_address_place_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ShipmentsTableMap::translateFieldName('EndAddressLat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_address_lat = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ShipmentsTableMap::translateFieldName('EndAddressLon', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_address_lon = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : ShipmentsTableMap::translateFieldName('EndAddressLocality', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_address_locality = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : ShipmentsTableMap::translateFieldName('EndAddressRegion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_address_region = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : ShipmentsTableMap::translateFieldName('EndAddressCountry', TableMap::TYPE_PHPNAME, $indexType)];
            $this->end_address_country = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : ShipmentsTableMap::translateFieldName('ReceiverName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->receiver_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : ShipmentsTableMap::translateFieldName('ReceiverPhone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->receiver_phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : ShipmentsTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : ShipmentsTableMap::translateFieldName('MeasurementsWidth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->measurements_width = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : ShipmentsTableMap::translateFieldName('MeasurementsWidthUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->measurements_width_unit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : ShipmentsTableMap::translateFieldName('MeasurementsHeight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->measurements_height = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : ShipmentsTableMap::translateFieldName('MeasurementsHeightUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->measurements_height_unit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : ShipmentsTableMap::translateFieldName('MeasurementsDepth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->measurements_depth = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : ShipmentsTableMap::translateFieldName('MeasurementsDepthUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->measurements_depth_unit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : ShipmentsTableMap::translateFieldName('MeasurementsWeight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->measurements_weight = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : ShipmentsTableMap::translateFieldName('MeasurementsWeightUnit', TableMap::TYPE_PHPNAME, $indexType)];
            $this->measurements_weight_unit = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : ShipmentsTableMap::translateFieldName('OutNow', TableMap::TYPE_PHPNAME, $indexType)];
            $this->out_now = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 39 + $startcol : ShipmentsTableMap::translateFieldName('MaxArrivalDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->max_arrival_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 40 + $startcol : ShipmentsTableMap::translateFieldName('ReceiveOffers', TableMap::TYPE_PHPNAME, $indexType)];
            $this->receive_offers = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 41 + $startcol : ShipmentsTableMap::translateFieldName('AmountPayable', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount_payable = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 42 + $startcol : ShipmentsTableMap::translateFieldName('RegisteredAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->registered_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 43 + $startcol : ShipmentsTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 44 + $startcol : ShipmentsTableMap::translateFieldName('AddressDist1DisValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_dist_1_dis_value = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 45 + $startcol : ShipmentsTableMap::translateFieldName('AddressDist1DisDesc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_dist_1_dis_desc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 46 + $startcol : ShipmentsTableMap::translateFieldName('AddressDist1DurValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_dist_1_dur_value = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 47 + $startcol : ShipmentsTableMap::translateFieldName('AddressDist1DurDesc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_dist_1_dur_desc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 48 + $startcol : ShipmentsTableMap::translateFieldName('AddressDist2DisValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_dist_2_dis_value = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 49 + $startcol : ShipmentsTableMap::translateFieldName('AddressDist2DisDesc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_dist_2_dis_desc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 50 + $startcol : ShipmentsTableMap::translateFieldName('AddressDist2DurValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_dist_2_dur_value = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 51 + $startcol : ShipmentsTableMap::translateFieldName('AddressDist2DurDesc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address_dist_2_dur_desc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 52 + $startcol : ShipmentsTableMap::translateFieldName('DeliveredAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->delivered_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 53 + $startcol : ShipmentsTableMap::translateFieldName('DeclaredValue', TableMap::TYPE_PHPNAME, $indexType)];
            $this->declared_value = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 54 + $startcol : ShipmentsTableMap::translateFieldName('AdditionalAddressInformation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->additional_address_information = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 55 + $startcol : ShipmentsTableMap::translateFieldName('MustArrive', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->must_arrive = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 56 + $startcol : ShipmentsTableMap::translateFieldName('MaxOffers', TableMap::TYPE_PHPNAME, $indexType)];
            $this->max_offers = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 57; // 57 = ShipmentsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Shipments'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(ShipmentsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildShipmentsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see Shipments::setDeleted()
     * @see Shipments::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildShipmentsQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsTableMap::DATABASE_NAME);
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
                ShipmentsTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[ShipmentsTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ShipmentsTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ShipmentsTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ID_USER)) {
            $modifiedColumns[':p' . $index++]  = '`id_user`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ID_PRODUCT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`id_product_type`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ID_SHIPMENT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`id_shipment_type`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ID_STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`id_status`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_PIN)) {
            $modifiedColumns[':p' . $index++]  = '`pin`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`start_address`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS_PLACE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`start_address_place_id`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS_LAT)) {
            $modifiedColumns[':p' . $index++]  = '`start_address_lat`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS_LON)) {
            $modifiedColumns[':p' . $index++]  = '`start_address_lon`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS_LOCALITY)) {
            $modifiedColumns[':p' . $index++]  = '`start_address_locality`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS_REGION)) {
            $modifiedColumns[':p' . $index++]  = '`start_address_region`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`start_address_country`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`waypoint_address`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_PLACE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`waypoint_address_place_id`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LAT)) {
            $modifiedColumns[':p' . $index++]  = '`waypoint_address_lat`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LON)) {
            $modifiedColumns[':p' . $index++]  = '`waypoint_address_lon`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LOCALITY)) {
            $modifiedColumns[':p' . $index++]  = '`waypoint_address_locality`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_REGION)) {
            $modifiedColumns[':p' . $index++]  = '`waypoint_address_region`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`waypoint_address_country`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`end_address`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS_PLACE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`end_address_place_id`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS_LAT)) {
            $modifiedColumns[':p' . $index++]  = '`end_address_lat`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS_LON)) {
            $modifiedColumns[':p' . $index++]  = '`end_address_lon`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS_LOCALITY)) {
            $modifiedColumns[':p' . $index++]  = '`end_address_locality`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS_REGION)) {
            $modifiedColumns[':p' . $index++]  = '`end_address_region`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`end_address_country`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_RECEIVER_NAME)) {
            $modifiedColumns[':p' . $index++]  = '`receiver_name`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_RECEIVER_PHONE)) {
            $modifiedColumns[':p' . $index++]  = '`receiver_phone`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_WIDTH)) {
            $modifiedColumns[':p' . $index++]  = '`measurements_width`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_WIDTH_UNIT)) {
            $modifiedColumns[':p' . $index++]  = '`measurements_width_unit`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT)) {
            $modifiedColumns[':p' . $index++]  = '`measurements_height`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT_UNIT)) {
            $modifiedColumns[':p' . $index++]  = '`measurements_height_unit`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_DEPTH)) {
            $modifiedColumns[':p' . $index++]  = '`measurements_depth`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_DEPTH_UNIT)) {
            $modifiedColumns[':p' . $index++]  = '`measurements_depth_unit`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT)) {
            $modifiedColumns[':p' . $index++]  = '`measurements_weight`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT_UNIT)) {
            $modifiedColumns[':p' . $index++]  = '`measurements_weight_unit`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_OUT_NOW)) {
            $modifiedColumns[':p' . $index++]  = '`out_now`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MAX_ARRIVAL_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`max_arrival_date`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_RECEIVE_OFFERS)) {
            $modifiedColumns[':p' . $index++]  = '`receive_offers`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_AMOUNT_PAYABLE)) {
            $modifiedColumns[':p' . $index++]  = '`amount_payable`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_REGISTERED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`registered_at`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_VALUE)) {
            $modifiedColumns[':p' . $index++]  = '`address_dist_1_dis_value`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_DESC)) {
            $modifiedColumns[':p' . $index++]  = '`address_dist_1_dis_desc`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_VALUE)) {
            $modifiedColumns[':p' . $index++]  = '`address_dist_1_dur_value`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_DESC)) {
            $modifiedColumns[':p' . $index++]  = '`address_dist_1_dur_desc`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_VALUE)) {
            $modifiedColumns[':p' . $index++]  = '`address_dist_2_dis_value`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_DESC)) {
            $modifiedColumns[':p' . $index++]  = '`address_dist_2_dis_desc`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_VALUE)) {
            $modifiedColumns[':p' . $index++]  = '`address_dist_2_dur_value`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_DESC)) {
            $modifiedColumns[':p' . $index++]  = '`address_dist_2_dur_desc`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_DELIVERED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`delivered_at`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_DECLARED_VALUE)) {
            $modifiedColumns[':p' . $index++]  = '`declared_value`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDITIONAL_ADDRESS_INFORMATION)) {
            $modifiedColumns[':p' . $index++]  = '`additional_address_information`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MUST_ARRIVE)) {
            $modifiedColumns[':p' . $index++]  = '`must_arrive`';
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MAX_OFFERS)) {
            $modifiedColumns[':p' . $index++]  = '`max_offers`';
        }

        $sql = sprintf(
            'INSERT INTO `shipments` (%s) VALUES (%s)',
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
                    case '`id_product_type`':
                        $stmt->bindValue($identifier, $this->id_product_type, PDO::PARAM_INT);
                        break;
                    case '`id_shipment_type`':
                        $stmt->bindValue($identifier, $this->id_shipment_type, PDO::PARAM_INT);
                        break;
                    case '`id_status`':
                        $stmt->bindValue($identifier, $this->id_status, PDO::PARAM_INT);
                        break;
                    case '`pin`':
                        $stmt->bindValue($identifier, $this->pin, PDO::PARAM_STR);
                        break;
                    case '`start_address`':
                        $stmt->bindValue($identifier, $this->start_address, PDO::PARAM_STR);
                        break;
                    case '`start_address_place_id`':
                        $stmt->bindValue($identifier, $this->start_address_place_id, PDO::PARAM_STR);
                        break;
                    case '`start_address_lat`':
                        $stmt->bindValue($identifier, $this->start_address_lat, PDO::PARAM_STR);
                        break;
                    case '`start_address_lon`':
                        $stmt->bindValue($identifier, $this->start_address_lon, PDO::PARAM_STR);
                        break;
                    case '`start_address_locality`':
                        $stmt->bindValue($identifier, $this->start_address_locality, PDO::PARAM_STR);
                        break;
                    case '`start_address_region`':
                        $stmt->bindValue($identifier, $this->start_address_region, PDO::PARAM_STR);
                        break;
                    case '`start_address_country`':
                        $stmt->bindValue($identifier, $this->start_address_country, PDO::PARAM_STR);
                        break;
                    case '`waypoint_address`':
                        $stmt->bindValue($identifier, $this->waypoint_address, PDO::PARAM_STR);
                        break;
                    case '`waypoint_address_place_id`':
                        $stmt->bindValue($identifier, $this->waypoint_address_place_id, PDO::PARAM_STR);
                        break;
                    case '`waypoint_address_lat`':
                        $stmt->bindValue($identifier, $this->waypoint_address_lat, PDO::PARAM_STR);
                        break;
                    case '`waypoint_address_lon`':
                        $stmt->bindValue($identifier, $this->waypoint_address_lon, PDO::PARAM_STR);
                        break;
                    case '`waypoint_address_locality`':
                        $stmt->bindValue($identifier, $this->waypoint_address_locality, PDO::PARAM_STR);
                        break;
                    case '`waypoint_address_region`':
                        $stmt->bindValue($identifier, $this->waypoint_address_region, PDO::PARAM_STR);
                        break;
                    case '`waypoint_address_country`':
                        $stmt->bindValue($identifier, $this->waypoint_address_country, PDO::PARAM_STR);
                        break;
                    case '`end_address`':
                        $stmt->bindValue($identifier, $this->end_address, PDO::PARAM_STR);
                        break;
                    case '`end_address_place_id`':
                        $stmt->bindValue($identifier, $this->end_address_place_id, PDO::PARAM_STR);
                        break;
                    case '`end_address_lat`':
                        $stmt->bindValue($identifier, $this->end_address_lat, PDO::PARAM_STR);
                        break;
                    case '`end_address_lon`':
                        $stmt->bindValue($identifier, $this->end_address_lon, PDO::PARAM_STR);
                        break;
                    case '`end_address_locality`':
                        $stmt->bindValue($identifier, $this->end_address_locality, PDO::PARAM_STR);
                        break;
                    case '`end_address_region`':
                        $stmt->bindValue($identifier, $this->end_address_region, PDO::PARAM_STR);
                        break;
                    case '`end_address_country`':
                        $stmt->bindValue($identifier, $this->end_address_country, PDO::PARAM_STR);
                        break;
                    case '`receiver_name`':
                        $stmt->bindValue($identifier, $this->receiver_name, PDO::PARAM_STR);
                        break;
                    case '`receiver_phone`':
                        $stmt->bindValue($identifier, $this->receiver_phone, PDO::PARAM_STR);
                        break;
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case '`measurements_width`':
                        $stmt->bindValue($identifier, $this->measurements_width, PDO::PARAM_STR);
                        break;
                    case '`measurements_width_unit`':
                        $stmt->bindValue($identifier, $this->measurements_width_unit, PDO::PARAM_STR);
                        break;
                    case '`measurements_height`':
                        $stmt->bindValue($identifier, $this->measurements_height, PDO::PARAM_STR);
                        break;
                    case '`measurements_height_unit`':
                        $stmt->bindValue($identifier, $this->measurements_height_unit, PDO::PARAM_STR);
                        break;
                    case '`measurements_depth`':
                        $stmt->bindValue($identifier, $this->measurements_depth, PDO::PARAM_STR);
                        break;
                    case '`measurements_depth_unit`':
                        $stmt->bindValue($identifier, $this->measurements_depth_unit, PDO::PARAM_STR);
                        break;
                    case '`measurements_weight`':
                        $stmt->bindValue($identifier, $this->measurements_weight, PDO::PARAM_STR);
                        break;
                    case '`measurements_weight_unit`':
                        $stmt->bindValue($identifier, $this->measurements_weight_unit, PDO::PARAM_STR);
                        break;
                    case '`out_now`':
                        $stmt->bindValue($identifier, (int) $this->out_now, PDO::PARAM_INT);
                        break;
                    case '`max_arrival_date`':
                        $stmt->bindValue($identifier, $this->max_arrival_date ? $this->max_arrival_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`receive_offers`':
                        $stmt->bindValue($identifier, (int) $this->receive_offers, PDO::PARAM_INT);
                        break;
                    case '`amount_payable`':
                        $stmt->bindValue($identifier, $this->amount_payable, PDO::PARAM_STR);
                        break;
                    case '`registered_at`':
                        $stmt->bindValue($identifier, $this->registered_at ? $this->registered_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`address_dist_1_dis_value`':
                        $stmt->bindValue($identifier, $this->address_dist_1_dis_value, PDO::PARAM_INT);
                        break;
                    case '`address_dist_1_dis_desc`':
                        $stmt->bindValue($identifier, $this->address_dist_1_dis_desc, PDO::PARAM_STR);
                        break;
                    case '`address_dist_1_dur_value`':
                        $stmt->bindValue($identifier, $this->address_dist_1_dur_value, PDO::PARAM_INT);
                        break;
                    case '`address_dist_1_dur_desc`':
                        $stmt->bindValue($identifier, $this->address_dist_1_dur_desc, PDO::PARAM_STR);
                        break;
                    case '`address_dist_2_dis_value`':
                        $stmt->bindValue($identifier, $this->address_dist_2_dis_value, PDO::PARAM_INT);
                        break;
                    case '`address_dist_2_dis_desc`':
                        $stmt->bindValue($identifier, $this->address_dist_2_dis_desc, PDO::PARAM_STR);
                        break;
                    case '`address_dist_2_dur_value`':
                        $stmt->bindValue($identifier, $this->address_dist_2_dur_value, PDO::PARAM_INT);
                        break;
                    case '`address_dist_2_dur_desc`':
                        $stmt->bindValue($identifier, $this->address_dist_2_dur_desc, PDO::PARAM_STR);
                        break;
                    case '`delivered_at`':
                        $stmt->bindValue($identifier, $this->delivered_at ? $this->delivered_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`declared_value`':
                        $stmt->bindValue($identifier, $this->declared_value, PDO::PARAM_STR);
                        break;
                    case '`additional_address_information`':
                        $stmt->bindValue($identifier, $this->additional_address_information, PDO::PARAM_STR);
                        break;
                    case '`must_arrive`':
                        $stmt->bindValue($identifier, $this->must_arrive ? $this->must_arrive->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case '`max_offers`':
                        $stmt->bindValue($identifier, $this->max_offers, PDO::PARAM_INT);
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
        $pos = ShipmentsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdProductType();
                break;
            case 3:
                return $this->getIdShipmentType();
                break;
            case 4:
                return $this->getIdStatus();
                break;
            case 5:
                return $this->getPin();
                break;
            case 6:
                return $this->getStartAddress();
                break;
            case 7:
                return $this->getStartAddressPlaceId();
                break;
            case 8:
                return $this->getStartAddressLat();
                break;
            case 9:
                return $this->getStartAddressLon();
                break;
            case 10:
                return $this->getStartAddressLocality();
                break;
            case 11:
                return $this->getStartAddressRegion();
                break;
            case 12:
                return $this->getStartAddressCountry();
                break;
            case 13:
                return $this->getWaypointAddress();
                break;
            case 14:
                return $this->getWaypointAddressPlaceId();
                break;
            case 15:
                return $this->getWaypointAddressLat();
                break;
            case 16:
                return $this->getWaypointAddressLon();
                break;
            case 17:
                return $this->getWaypointAddressLocality();
                break;
            case 18:
                return $this->getWaypointAddressRegion();
                break;
            case 19:
                return $this->getWaypointAddressCountry();
                break;
            case 20:
                return $this->getEndAddress();
                break;
            case 21:
                return $this->getEndAddressPlaceId();
                break;
            case 22:
                return $this->getEndAddressLat();
                break;
            case 23:
                return $this->getEndAddressLon();
                break;
            case 24:
                return $this->getEndAddressLocality();
                break;
            case 25:
                return $this->getEndAddressRegion();
                break;
            case 26:
                return $this->getEndAddressCountry();
                break;
            case 27:
                return $this->getReceiverName();
                break;
            case 28:
                return $this->getReceiverPhone();
                break;
            case 29:
                return $this->getDescription();
                break;
            case 30:
                return $this->getMeasurementsWidth();
                break;
            case 31:
                return $this->getMeasurementsWidthUnit();
                break;
            case 32:
                return $this->getMeasurementsHeight();
                break;
            case 33:
                return $this->getMeasurementsHeightUnit();
                break;
            case 34:
                return $this->getMeasurementsDepth();
                break;
            case 35:
                return $this->getMeasurementsDepthUnit();
                break;
            case 36:
                return $this->getMeasurementsWeight();
                break;
            case 37:
                return $this->getMeasurementsWeightUnit();
                break;
            case 38:
                return $this->getOutNow();
                break;
            case 39:
                return $this->getMaxArrivalDate();
                break;
            case 40:
                return $this->getReceiveOffers();
                break;
            case 41:
                return $this->getAmountPayable();
                break;
            case 42:
                return $this->getRegisteredAt();
                break;
            case 43:
                return $this->getUpdatedAt();
                break;
            case 44:
                return $this->getAddressDist1DisValue();
                break;
            case 45:
                return $this->getAddressDist1DisDesc();
                break;
            case 46:
                return $this->getAddressDist1DurValue();
                break;
            case 47:
                return $this->getAddressDist1DurDesc();
                break;
            case 48:
                return $this->getAddressDist2DisValue();
                break;
            case 49:
                return $this->getAddressDist2DisDesc();
                break;
            case 50:
                return $this->getAddressDist2DurValue();
                break;
            case 51:
                return $this->getAddressDist2DurDesc();
                break;
            case 52:
                return $this->getDeliveredAt();
                break;
            case 53:
                return $this->getDeclaredValue();
                break;
            case 54:
                return $this->getAdditionalAddressInformation();
                break;
            case 55:
                return $this->getMustArrive();
                break;
            case 56:
                return $this->getMaxOffers();
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

        if (isset($alreadyDumpedObjects['Shipments'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Shipments'][$this->hashCode()] = true;
        $keys = ShipmentsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdUser(),
            $keys[2] => $this->getIdProductType(),
            $keys[3] => $this->getIdShipmentType(),
            $keys[4] => $this->getIdStatus(),
            $keys[5] => $this->getPin(),
            $keys[6] => $this->getStartAddress(),
            $keys[7] => $this->getStartAddressPlaceId(),
            $keys[8] => $this->getStartAddressLat(),
            $keys[9] => $this->getStartAddressLon(),
            $keys[10] => $this->getStartAddressLocality(),
            $keys[11] => $this->getStartAddressRegion(),
            $keys[12] => $this->getStartAddressCountry(),
            $keys[13] => $this->getWaypointAddress(),
            $keys[14] => $this->getWaypointAddressPlaceId(),
            $keys[15] => $this->getWaypointAddressLat(),
            $keys[16] => $this->getWaypointAddressLon(),
            $keys[17] => $this->getWaypointAddressLocality(),
            $keys[18] => $this->getWaypointAddressRegion(),
            $keys[19] => $this->getWaypointAddressCountry(),
            $keys[20] => $this->getEndAddress(),
            $keys[21] => $this->getEndAddressPlaceId(),
            $keys[22] => $this->getEndAddressLat(),
            $keys[23] => $this->getEndAddressLon(),
            $keys[24] => $this->getEndAddressLocality(),
            $keys[25] => $this->getEndAddressRegion(),
            $keys[26] => $this->getEndAddressCountry(),
            $keys[27] => $this->getReceiverName(),
            $keys[28] => $this->getReceiverPhone(),
            $keys[29] => $this->getDescription(),
            $keys[30] => $this->getMeasurementsWidth(),
            $keys[31] => $this->getMeasurementsWidthUnit(),
            $keys[32] => $this->getMeasurementsHeight(),
            $keys[33] => $this->getMeasurementsHeightUnit(),
            $keys[34] => $this->getMeasurementsDepth(),
            $keys[35] => $this->getMeasurementsDepthUnit(),
            $keys[36] => $this->getMeasurementsWeight(),
            $keys[37] => $this->getMeasurementsWeightUnit(),
            $keys[38] => $this->getOutNow(),
            $keys[39] => $this->getMaxArrivalDate(),
            $keys[40] => $this->getReceiveOffers(),
            $keys[41] => $this->getAmountPayable(),
            $keys[42] => $this->getRegisteredAt(),
            $keys[43] => $this->getUpdatedAt(),
            $keys[44] => $this->getAddressDist1DisValue(),
            $keys[45] => $this->getAddressDist1DisDesc(),
            $keys[46] => $this->getAddressDist1DurValue(),
            $keys[47] => $this->getAddressDist1DurDesc(),
            $keys[48] => $this->getAddressDist2DisValue(),
            $keys[49] => $this->getAddressDist2DisDesc(),
            $keys[50] => $this->getAddressDist2DurValue(),
            $keys[51] => $this->getAddressDist2DurDesc(),
            $keys[52] => $this->getDeliveredAt(),
            $keys[53] => $this->getDeclaredValue(),
            $keys[54] => $this->getAdditionalAddressInformation(),
            $keys[55] => $this->getMustArrive(),
            $keys[56] => $this->getMaxOffers(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[39]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[39]];
            $result[$keys[39]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[42]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[42]];
            $result[$keys[42]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[43]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[43]];
            $result[$keys[43]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[52]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[52]];
            $result[$keys[52]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        if ($result[$keys[55]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[55]];
            $result[$keys[55]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
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
     * @return $this|\Shipments
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ShipmentsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Shipments
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
                $this->setIdProductType($value);
                break;
            case 3:
                $this->setIdShipmentType($value);
                break;
            case 4:
                $this->setIdStatus($value);
                break;
            case 5:
                $this->setPin($value);
                break;
            case 6:
                $this->setStartAddress($value);
                break;
            case 7:
                $this->setStartAddressPlaceId($value);
                break;
            case 8:
                $this->setStartAddressLat($value);
                break;
            case 9:
                $this->setStartAddressLon($value);
                break;
            case 10:
                $this->setStartAddressLocality($value);
                break;
            case 11:
                $this->setStartAddressRegion($value);
                break;
            case 12:
                $this->setStartAddressCountry($value);
                break;
            case 13:
                $this->setWaypointAddress($value);
                break;
            case 14:
                $this->setWaypointAddressPlaceId($value);
                break;
            case 15:
                $this->setWaypointAddressLat($value);
                break;
            case 16:
                $this->setWaypointAddressLon($value);
                break;
            case 17:
                $this->setWaypointAddressLocality($value);
                break;
            case 18:
                $this->setWaypointAddressRegion($value);
                break;
            case 19:
                $this->setWaypointAddressCountry($value);
                break;
            case 20:
                $this->setEndAddress($value);
                break;
            case 21:
                $this->setEndAddressPlaceId($value);
                break;
            case 22:
                $this->setEndAddressLat($value);
                break;
            case 23:
                $this->setEndAddressLon($value);
                break;
            case 24:
                $this->setEndAddressLocality($value);
                break;
            case 25:
                $this->setEndAddressRegion($value);
                break;
            case 26:
                $this->setEndAddressCountry($value);
                break;
            case 27:
                $this->setReceiverName($value);
                break;
            case 28:
                $this->setReceiverPhone($value);
                break;
            case 29:
                $this->setDescription($value);
                break;
            case 30:
                $this->setMeasurementsWidth($value);
                break;
            case 31:
                $this->setMeasurementsWidthUnit($value);
                break;
            case 32:
                $this->setMeasurementsHeight($value);
                break;
            case 33:
                $this->setMeasurementsHeightUnit($value);
                break;
            case 34:
                $this->setMeasurementsDepth($value);
                break;
            case 35:
                $this->setMeasurementsDepthUnit($value);
                break;
            case 36:
                $this->setMeasurementsWeight($value);
                break;
            case 37:
                $this->setMeasurementsWeightUnit($value);
                break;
            case 38:
                $this->setOutNow($value);
                break;
            case 39:
                $this->setMaxArrivalDate($value);
                break;
            case 40:
                $this->setReceiveOffers($value);
                break;
            case 41:
                $this->setAmountPayable($value);
                break;
            case 42:
                $this->setRegisteredAt($value);
                break;
            case 43:
                $this->setUpdatedAt($value);
                break;
            case 44:
                $this->setAddressDist1DisValue($value);
                break;
            case 45:
                $this->setAddressDist1DisDesc($value);
                break;
            case 46:
                $this->setAddressDist1DurValue($value);
                break;
            case 47:
                $this->setAddressDist1DurDesc($value);
                break;
            case 48:
                $this->setAddressDist2DisValue($value);
                break;
            case 49:
                $this->setAddressDist2DisDesc($value);
                break;
            case 50:
                $this->setAddressDist2DurValue($value);
                break;
            case 51:
                $this->setAddressDist2DurDesc($value);
                break;
            case 52:
                $this->setDeliveredAt($value);
                break;
            case 53:
                $this->setDeclaredValue($value);
                break;
            case 54:
                $this->setAdditionalAddressInformation($value);
                break;
            case 55:
                $this->setMustArrive($value);
                break;
            case 56:
                $this->setMaxOffers($value);
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
        $keys = ShipmentsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdUser($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdProductType($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIdShipmentType($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIdStatus($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPin($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setStartAddress($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setStartAddressPlaceId($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setStartAddressLat($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setStartAddressLon($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setStartAddressLocality($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setStartAddressRegion($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setStartAddressCountry($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setWaypointAddress($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setWaypointAddressPlaceId($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setWaypointAddressLat($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setWaypointAddressLon($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setWaypointAddressLocality($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setWaypointAddressRegion($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setWaypointAddressCountry($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setEndAddress($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setEndAddressPlaceId($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setEndAddressLat($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setEndAddressLon($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setEndAddressLocality($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setEndAddressRegion($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setEndAddressCountry($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setReceiverName($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setReceiverPhone($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setDescription($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setMeasurementsWidth($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setMeasurementsWidthUnit($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setMeasurementsHeight($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setMeasurementsHeightUnit($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setMeasurementsDepth($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setMeasurementsDepthUnit($arr[$keys[35]]);
        }
        if (array_key_exists($keys[36], $arr)) {
            $this->setMeasurementsWeight($arr[$keys[36]]);
        }
        if (array_key_exists($keys[37], $arr)) {
            $this->setMeasurementsWeightUnit($arr[$keys[37]]);
        }
        if (array_key_exists($keys[38], $arr)) {
            $this->setOutNow($arr[$keys[38]]);
        }
        if (array_key_exists($keys[39], $arr)) {
            $this->setMaxArrivalDate($arr[$keys[39]]);
        }
        if (array_key_exists($keys[40], $arr)) {
            $this->setReceiveOffers($arr[$keys[40]]);
        }
        if (array_key_exists($keys[41], $arr)) {
            $this->setAmountPayable($arr[$keys[41]]);
        }
        if (array_key_exists($keys[42], $arr)) {
            $this->setRegisteredAt($arr[$keys[42]]);
        }
        if (array_key_exists($keys[43], $arr)) {
            $this->setUpdatedAt($arr[$keys[43]]);
        }
        if (array_key_exists($keys[44], $arr)) {
            $this->setAddressDist1DisValue($arr[$keys[44]]);
        }
        if (array_key_exists($keys[45], $arr)) {
            $this->setAddressDist1DisDesc($arr[$keys[45]]);
        }
        if (array_key_exists($keys[46], $arr)) {
            $this->setAddressDist1DurValue($arr[$keys[46]]);
        }
        if (array_key_exists($keys[47], $arr)) {
            $this->setAddressDist1DurDesc($arr[$keys[47]]);
        }
        if (array_key_exists($keys[48], $arr)) {
            $this->setAddressDist2DisValue($arr[$keys[48]]);
        }
        if (array_key_exists($keys[49], $arr)) {
            $this->setAddressDist2DisDesc($arr[$keys[49]]);
        }
        if (array_key_exists($keys[50], $arr)) {
            $this->setAddressDist2DurValue($arr[$keys[50]]);
        }
        if (array_key_exists($keys[51], $arr)) {
            $this->setAddressDist2DurDesc($arr[$keys[51]]);
        }
        if (array_key_exists($keys[52], $arr)) {
            $this->setDeliveredAt($arr[$keys[52]]);
        }
        if (array_key_exists($keys[53], $arr)) {
            $this->setDeclaredValue($arr[$keys[53]]);
        }
        if (array_key_exists($keys[54], $arr)) {
            $this->setAdditionalAddressInformation($arr[$keys[54]]);
        }
        if (array_key_exists($keys[55], $arr)) {
            $this->setMustArrive($arr[$keys[55]]);
        }
        if (array_key_exists($keys[56], $arr)) {
            $this->setMaxOffers($arr[$keys[56]]);
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
     * @return $this|\Shipments The current object, for fluid interface
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
        $criteria = new Criteria(ShipmentsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ShipmentsTableMap::COL_ID)) {
            $criteria->add(ShipmentsTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ID_USER)) {
            $criteria->add(ShipmentsTableMap::COL_ID_USER, $this->id_user);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ID_PRODUCT_TYPE)) {
            $criteria->add(ShipmentsTableMap::COL_ID_PRODUCT_TYPE, $this->id_product_type);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ID_SHIPMENT_TYPE)) {
            $criteria->add(ShipmentsTableMap::COL_ID_SHIPMENT_TYPE, $this->id_shipment_type);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ID_STATUS)) {
            $criteria->add(ShipmentsTableMap::COL_ID_STATUS, $this->id_status);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_PIN)) {
            $criteria->add(ShipmentsTableMap::COL_PIN, $this->pin);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS)) {
            $criteria->add(ShipmentsTableMap::COL_START_ADDRESS, $this->start_address);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS_PLACE_ID)) {
            $criteria->add(ShipmentsTableMap::COL_START_ADDRESS_PLACE_ID, $this->start_address_place_id);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS_LAT)) {
            $criteria->add(ShipmentsTableMap::COL_START_ADDRESS_LAT, $this->start_address_lat);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS_LON)) {
            $criteria->add(ShipmentsTableMap::COL_START_ADDRESS_LON, $this->start_address_lon);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS_LOCALITY)) {
            $criteria->add(ShipmentsTableMap::COL_START_ADDRESS_LOCALITY, $this->start_address_locality);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS_REGION)) {
            $criteria->add(ShipmentsTableMap::COL_START_ADDRESS_REGION, $this->start_address_region);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_START_ADDRESS_COUNTRY)) {
            $criteria->add(ShipmentsTableMap::COL_START_ADDRESS_COUNTRY, $this->start_address_country);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS)) {
            $criteria->add(ShipmentsTableMap::COL_WAYPOINT_ADDRESS, $this->waypoint_address);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_PLACE_ID)) {
            $criteria->add(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_PLACE_ID, $this->waypoint_address_place_id);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LAT)) {
            $criteria->add(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LAT, $this->waypoint_address_lat);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LON)) {
            $criteria->add(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LON, $this->waypoint_address_lon);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LOCALITY)) {
            $criteria->add(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LOCALITY, $this->waypoint_address_locality);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_REGION)) {
            $criteria->add(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_REGION, $this->waypoint_address_region);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_COUNTRY)) {
            $criteria->add(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_COUNTRY, $this->waypoint_address_country);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS)) {
            $criteria->add(ShipmentsTableMap::COL_END_ADDRESS, $this->end_address);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS_PLACE_ID)) {
            $criteria->add(ShipmentsTableMap::COL_END_ADDRESS_PLACE_ID, $this->end_address_place_id);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS_LAT)) {
            $criteria->add(ShipmentsTableMap::COL_END_ADDRESS_LAT, $this->end_address_lat);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS_LON)) {
            $criteria->add(ShipmentsTableMap::COL_END_ADDRESS_LON, $this->end_address_lon);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS_LOCALITY)) {
            $criteria->add(ShipmentsTableMap::COL_END_ADDRESS_LOCALITY, $this->end_address_locality);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS_REGION)) {
            $criteria->add(ShipmentsTableMap::COL_END_ADDRESS_REGION, $this->end_address_region);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_END_ADDRESS_COUNTRY)) {
            $criteria->add(ShipmentsTableMap::COL_END_ADDRESS_COUNTRY, $this->end_address_country);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_RECEIVER_NAME)) {
            $criteria->add(ShipmentsTableMap::COL_RECEIVER_NAME, $this->receiver_name);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_RECEIVER_PHONE)) {
            $criteria->add(ShipmentsTableMap::COL_RECEIVER_PHONE, $this->receiver_phone);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_DESCRIPTION)) {
            $criteria->add(ShipmentsTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_WIDTH)) {
            $criteria->add(ShipmentsTableMap::COL_MEASUREMENTS_WIDTH, $this->measurements_width);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_WIDTH_UNIT)) {
            $criteria->add(ShipmentsTableMap::COL_MEASUREMENTS_WIDTH_UNIT, $this->measurements_width_unit);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT)) {
            $criteria->add(ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT, $this->measurements_height);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT_UNIT)) {
            $criteria->add(ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT_UNIT, $this->measurements_height_unit);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_DEPTH)) {
            $criteria->add(ShipmentsTableMap::COL_MEASUREMENTS_DEPTH, $this->measurements_depth);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_DEPTH_UNIT)) {
            $criteria->add(ShipmentsTableMap::COL_MEASUREMENTS_DEPTH_UNIT, $this->measurements_depth_unit);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT)) {
            $criteria->add(ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT, $this->measurements_weight);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT_UNIT)) {
            $criteria->add(ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT_UNIT, $this->measurements_weight_unit);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_OUT_NOW)) {
            $criteria->add(ShipmentsTableMap::COL_OUT_NOW, $this->out_now);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MAX_ARRIVAL_DATE)) {
            $criteria->add(ShipmentsTableMap::COL_MAX_ARRIVAL_DATE, $this->max_arrival_date);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_RECEIVE_OFFERS)) {
            $criteria->add(ShipmentsTableMap::COL_RECEIVE_OFFERS, $this->receive_offers);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_AMOUNT_PAYABLE)) {
            $criteria->add(ShipmentsTableMap::COL_AMOUNT_PAYABLE, $this->amount_payable);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_REGISTERED_AT)) {
            $criteria->add(ShipmentsTableMap::COL_REGISTERED_AT, $this->registered_at);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_UPDATED_AT)) {
            $criteria->add(ShipmentsTableMap::COL_UPDATED_AT, $this->updated_at);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_VALUE)) {
            $criteria->add(ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_VALUE, $this->address_dist_1_dis_value);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_DESC)) {
            $criteria->add(ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_DESC, $this->address_dist_1_dis_desc);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_VALUE)) {
            $criteria->add(ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_VALUE, $this->address_dist_1_dur_value);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_DESC)) {
            $criteria->add(ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_DESC, $this->address_dist_1_dur_desc);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_VALUE)) {
            $criteria->add(ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_VALUE, $this->address_dist_2_dis_value);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_DESC)) {
            $criteria->add(ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_DESC, $this->address_dist_2_dis_desc);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_VALUE)) {
            $criteria->add(ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_VALUE, $this->address_dist_2_dur_value);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_DESC)) {
            $criteria->add(ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_DESC, $this->address_dist_2_dur_desc);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_DELIVERED_AT)) {
            $criteria->add(ShipmentsTableMap::COL_DELIVERED_AT, $this->delivered_at);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_DECLARED_VALUE)) {
            $criteria->add(ShipmentsTableMap::COL_DECLARED_VALUE, $this->declared_value);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_ADDITIONAL_ADDRESS_INFORMATION)) {
            $criteria->add(ShipmentsTableMap::COL_ADDITIONAL_ADDRESS_INFORMATION, $this->additional_address_information);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MUST_ARRIVE)) {
            $criteria->add(ShipmentsTableMap::COL_MUST_ARRIVE, $this->must_arrive);
        }
        if ($this->isColumnModified(ShipmentsTableMap::COL_MAX_OFFERS)) {
            $criteria->add(ShipmentsTableMap::COL_MAX_OFFERS, $this->max_offers);
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
        $criteria = ChildShipmentsQuery::create();
        $criteria->add(ShipmentsTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Shipments (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdUser($this->getIdUser());
        $copyObj->setIdProductType($this->getIdProductType());
        $copyObj->setIdShipmentType($this->getIdShipmentType());
        $copyObj->setIdStatus($this->getIdStatus());
        $copyObj->setPin($this->getPin());
        $copyObj->setStartAddress($this->getStartAddress());
        $copyObj->setStartAddressPlaceId($this->getStartAddressPlaceId());
        $copyObj->setStartAddressLat($this->getStartAddressLat());
        $copyObj->setStartAddressLon($this->getStartAddressLon());
        $copyObj->setStartAddressLocality($this->getStartAddressLocality());
        $copyObj->setStartAddressRegion($this->getStartAddressRegion());
        $copyObj->setStartAddressCountry($this->getStartAddressCountry());
        $copyObj->setWaypointAddress($this->getWaypointAddress());
        $copyObj->setWaypointAddressPlaceId($this->getWaypointAddressPlaceId());
        $copyObj->setWaypointAddressLat($this->getWaypointAddressLat());
        $copyObj->setWaypointAddressLon($this->getWaypointAddressLon());
        $copyObj->setWaypointAddressLocality($this->getWaypointAddressLocality());
        $copyObj->setWaypointAddressRegion($this->getWaypointAddressRegion());
        $copyObj->setWaypointAddressCountry($this->getWaypointAddressCountry());
        $copyObj->setEndAddress($this->getEndAddress());
        $copyObj->setEndAddressPlaceId($this->getEndAddressPlaceId());
        $copyObj->setEndAddressLat($this->getEndAddressLat());
        $copyObj->setEndAddressLon($this->getEndAddressLon());
        $copyObj->setEndAddressLocality($this->getEndAddressLocality());
        $copyObj->setEndAddressRegion($this->getEndAddressRegion());
        $copyObj->setEndAddressCountry($this->getEndAddressCountry());
        $copyObj->setReceiverName($this->getReceiverName());
        $copyObj->setReceiverPhone($this->getReceiverPhone());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setMeasurementsWidth($this->getMeasurementsWidth());
        $copyObj->setMeasurementsWidthUnit($this->getMeasurementsWidthUnit());
        $copyObj->setMeasurementsHeight($this->getMeasurementsHeight());
        $copyObj->setMeasurementsHeightUnit($this->getMeasurementsHeightUnit());
        $copyObj->setMeasurementsDepth($this->getMeasurementsDepth());
        $copyObj->setMeasurementsDepthUnit($this->getMeasurementsDepthUnit());
        $copyObj->setMeasurementsWeight($this->getMeasurementsWeight());
        $copyObj->setMeasurementsWeightUnit($this->getMeasurementsWeightUnit());
        $copyObj->setOutNow($this->getOutNow());
        $copyObj->setMaxArrivalDate($this->getMaxArrivalDate());
        $copyObj->setReceiveOffers($this->getReceiveOffers());
        $copyObj->setAmountPayable($this->getAmountPayable());
        $copyObj->setRegisteredAt($this->getRegisteredAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setAddressDist1DisValue($this->getAddressDist1DisValue());
        $copyObj->setAddressDist1DisDesc($this->getAddressDist1DisDesc());
        $copyObj->setAddressDist1DurValue($this->getAddressDist1DurValue());
        $copyObj->setAddressDist1DurDesc($this->getAddressDist1DurDesc());
        $copyObj->setAddressDist2DisValue($this->getAddressDist2DisValue());
        $copyObj->setAddressDist2DisDesc($this->getAddressDist2DisDesc());
        $copyObj->setAddressDist2DurValue($this->getAddressDist2DurValue());
        $copyObj->setAddressDist2DurDesc($this->getAddressDist2DurDesc());
        $copyObj->setDeliveredAt($this->getDeliveredAt());
        $copyObj->setDeclaredValue($this->getDeclaredValue());
        $copyObj->setAdditionalAddressInformation($this->getAdditionalAddressInformation());
        $copyObj->setMustArrive($this->getMustArrive());
        $copyObj->setMaxOffers($this->getMaxOffers());
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
     * @return \Shipments Clone of current object.
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
        $this->id_user = null;
        $this->id_product_type = null;
        $this->id_shipment_type = null;
        $this->id_status = null;
        $this->pin = null;
        $this->start_address = null;
        $this->start_address_place_id = null;
        $this->start_address_lat = null;
        $this->start_address_lon = null;
        $this->start_address_locality = null;
        $this->start_address_region = null;
        $this->start_address_country = null;
        $this->waypoint_address = null;
        $this->waypoint_address_place_id = null;
        $this->waypoint_address_lat = null;
        $this->waypoint_address_lon = null;
        $this->waypoint_address_locality = null;
        $this->waypoint_address_region = null;
        $this->waypoint_address_country = null;
        $this->end_address = null;
        $this->end_address_place_id = null;
        $this->end_address_lat = null;
        $this->end_address_lon = null;
        $this->end_address_locality = null;
        $this->end_address_region = null;
        $this->end_address_country = null;
        $this->receiver_name = null;
        $this->receiver_phone = null;
        $this->description = null;
        $this->measurements_width = null;
        $this->measurements_width_unit = null;
        $this->measurements_height = null;
        $this->measurements_height_unit = null;
        $this->measurements_depth = null;
        $this->measurements_depth_unit = null;
        $this->measurements_weight = null;
        $this->measurements_weight_unit = null;
        $this->out_now = null;
        $this->max_arrival_date = null;
        $this->receive_offers = null;
        $this->amount_payable = null;
        $this->registered_at = null;
        $this->updated_at = null;
        $this->address_dist_1_dis_value = null;
        $this->address_dist_1_dis_desc = null;
        $this->address_dist_1_dur_value = null;
        $this->address_dist_1_dur_desc = null;
        $this->address_dist_2_dis_value = null;
        $this->address_dist_2_dis_desc = null;
        $this->address_dist_2_dur_value = null;
        $this->address_dist_2_dur_desc = null;
        $this->delivered_at = null;
        $this->declared_value = null;
        $this->additional_address_information = null;
        $this->must_arrive = null;
        $this->max_offers = null;
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
        return (string) $this->exportTo(ShipmentsTableMap::DEFAULT_STRING_FORMAT);
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
