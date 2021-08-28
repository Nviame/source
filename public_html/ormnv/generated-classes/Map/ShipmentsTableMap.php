<?php

namespace Map;

use \Shipments;
use \ShipmentsQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'shipments' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ShipmentsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ShipmentsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'shipments';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Shipments';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Shipments';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 57;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 57;

    /**
     * the column name for the id field
     */
    const COL_ID = 'shipments.id';

    /**
     * the column name for the id_user field
     */
    const COL_ID_USER = 'shipments.id_user';

    /**
     * the column name for the id_product_type field
     */
    const COL_ID_PRODUCT_TYPE = 'shipments.id_product_type';

    /**
     * the column name for the id_shipment_type field
     */
    const COL_ID_SHIPMENT_TYPE = 'shipments.id_shipment_type';

    /**
     * the column name for the id_status field
     */
    const COL_ID_STATUS = 'shipments.id_status';

    /**
     * the column name for the pin field
     */
    const COL_PIN = 'shipments.pin';

    /**
     * the column name for the start_address field
     */
    const COL_START_ADDRESS = 'shipments.start_address';

    /**
     * the column name for the start_address_place_id field
     */
    const COL_START_ADDRESS_PLACE_ID = 'shipments.start_address_place_id';

    /**
     * the column name for the start_address_lat field
     */
    const COL_START_ADDRESS_LAT = 'shipments.start_address_lat';

    /**
     * the column name for the start_address_lon field
     */
    const COL_START_ADDRESS_LON = 'shipments.start_address_lon';

    /**
     * the column name for the start_address_locality field
     */
    const COL_START_ADDRESS_LOCALITY = 'shipments.start_address_locality';

    /**
     * the column name for the start_address_region field
     */
    const COL_START_ADDRESS_REGION = 'shipments.start_address_region';

    /**
     * the column name for the start_address_country field
     */
    const COL_START_ADDRESS_COUNTRY = 'shipments.start_address_country';

    /**
     * the column name for the waypoint_address field
     */
    const COL_WAYPOINT_ADDRESS = 'shipments.waypoint_address';

    /**
     * the column name for the waypoint_address_place_id field
     */
    const COL_WAYPOINT_ADDRESS_PLACE_ID = 'shipments.waypoint_address_place_id';

    /**
     * the column name for the waypoint_address_lat field
     */
    const COL_WAYPOINT_ADDRESS_LAT = 'shipments.waypoint_address_lat';

    /**
     * the column name for the waypoint_address_lon field
     */
    const COL_WAYPOINT_ADDRESS_LON = 'shipments.waypoint_address_lon';

    /**
     * the column name for the waypoint_address_locality field
     */
    const COL_WAYPOINT_ADDRESS_LOCALITY = 'shipments.waypoint_address_locality';

    /**
     * the column name for the waypoint_address_region field
     */
    const COL_WAYPOINT_ADDRESS_REGION = 'shipments.waypoint_address_region';

    /**
     * the column name for the waypoint_address_country field
     */
    const COL_WAYPOINT_ADDRESS_COUNTRY = 'shipments.waypoint_address_country';

    /**
     * the column name for the end_address field
     */
    const COL_END_ADDRESS = 'shipments.end_address';

    /**
     * the column name for the end_address_place_id field
     */
    const COL_END_ADDRESS_PLACE_ID = 'shipments.end_address_place_id';

    /**
     * the column name for the end_address_lat field
     */
    const COL_END_ADDRESS_LAT = 'shipments.end_address_lat';

    /**
     * the column name for the end_address_lon field
     */
    const COL_END_ADDRESS_LON = 'shipments.end_address_lon';

    /**
     * the column name for the end_address_locality field
     */
    const COL_END_ADDRESS_LOCALITY = 'shipments.end_address_locality';

    /**
     * the column name for the end_address_region field
     */
    const COL_END_ADDRESS_REGION = 'shipments.end_address_region';

    /**
     * the column name for the end_address_country field
     */
    const COL_END_ADDRESS_COUNTRY = 'shipments.end_address_country';

    /**
     * the column name for the receiver_name field
     */
    const COL_RECEIVER_NAME = 'shipments.receiver_name';

    /**
     * the column name for the receiver_phone field
     */
    const COL_RECEIVER_PHONE = 'shipments.receiver_phone';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'shipments.description';

    /**
     * the column name for the measurements_width field
     */
    const COL_MEASUREMENTS_WIDTH = 'shipments.measurements_width';

    /**
     * the column name for the measurements_width_unit field
     */
    const COL_MEASUREMENTS_WIDTH_UNIT = 'shipments.measurements_width_unit';

    /**
     * the column name for the measurements_height field
     */
    const COL_MEASUREMENTS_HEIGHT = 'shipments.measurements_height';

    /**
     * the column name for the measurements_height_unit field
     */
    const COL_MEASUREMENTS_HEIGHT_UNIT = 'shipments.measurements_height_unit';

    /**
     * the column name for the measurements_depth field
     */
    const COL_MEASUREMENTS_DEPTH = 'shipments.measurements_depth';

    /**
     * the column name for the measurements_depth_unit field
     */
    const COL_MEASUREMENTS_DEPTH_UNIT = 'shipments.measurements_depth_unit';

    /**
     * the column name for the measurements_weight field
     */
    const COL_MEASUREMENTS_WEIGHT = 'shipments.measurements_weight';

    /**
     * the column name for the measurements_weight_unit field
     */
    const COL_MEASUREMENTS_WEIGHT_UNIT = 'shipments.measurements_weight_unit';

    /**
     * the column name for the out_now field
     */
    const COL_OUT_NOW = 'shipments.out_now';

    /**
     * the column name for the max_arrival_date field
     */
    const COL_MAX_ARRIVAL_DATE = 'shipments.max_arrival_date';

    /**
     * the column name for the receive_offers field
     */
    const COL_RECEIVE_OFFERS = 'shipments.receive_offers';

    /**
     * the column name for the amount_payable field
     */
    const COL_AMOUNT_PAYABLE = 'shipments.amount_payable';

    /**
     * the column name for the registered_at field
     */
    const COL_REGISTERED_AT = 'shipments.registered_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'shipments.updated_at';

    /**
     * the column name for the address_dist_1_dis_value field
     */
    const COL_ADDRESS_DIST_1_DIS_VALUE = 'shipments.address_dist_1_dis_value';

    /**
     * the column name for the address_dist_1_dis_desc field
     */
    const COL_ADDRESS_DIST_1_DIS_DESC = 'shipments.address_dist_1_dis_desc';

    /**
     * the column name for the address_dist_1_dur_value field
     */
    const COL_ADDRESS_DIST_1_DUR_VALUE = 'shipments.address_dist_1_dur_value';

    /**
     * the column name for the address_dist_1_dur_desc field
     */
    const COL_ADDRESS_DIST_1_DUR_DESC = 'shipments.address_dist_1_dur_desc';

    /**
     * the column name for the address_dist_2_dis_value field
     */
    const COL_ADDRESS_DIST_2_DIS_VALUE = 'shipments.address_dist_2_dis_value';

    /**
     * the column name for the address_dist_2_dis_desc field
     */
    const COL_ADDRESS_DIST_2_DIS_DESC = 'shipments.address_dist_2_dis_desc';

    /**
     * the column name for the address_dist_2_dur_value field
     */
    const COL_ADDRESS_DIST_2_DUR_VALUE = 'shipments.address_dist_2_dur_value';

    /**
     * the column name for the address_dist_2_dur_desc field
     */
    const COL_ADDRESS_DIST_2_DUR_DESC = 'shipments.address_dist_2_dur_desc';

    /**
     * the column name for the delivered_at field
     */
    const COL_DELIVERED_AT = 'shipments.delivered_at';

    /**
     * the column name for the declared_value field
     */
    const COL_DECLARED_VALUE = 'shipments.declared_value';

    /**
     * the column name for the additional_address_information field
     */
    const COL_ADDITIONAL_ADDRESS_INFORMATION = 'shipments.additional_address_information';

    /**
     * the column name for the must_arrive field
     */
    const COL_MUST_ARRIVE = 'shipments.must_arrive';

    /**
     * the column name for the max_offers field
     */
    const COL_MAX_OFFERS = 'shipments.max_offers';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'IdUser', 'IdProductType', 'IdShipmentType', 'IdStatus', 'Pin', 'StartAddress', 'StartAddressPlaceId', 'StartAddressLat', 'StartAddressLon', 'StartAddressLocality', 'StartAddressRegion', 'StartAddressCountry', 'WaypointAddress', 'WaypointAddressPlaceId', 'WaypointAddressLat', 'WaypointAddressLon', 'WaypointAddressLocality', 'WaypointAddressRegion', 'WaypointAddressCountry', 'EndAddress', 'EndAddressPlaceId', 'EndAddressLat', 'EndAddressLon', 'EndAddressLocality', 'EndAddressRegion', 'EndAddressCountry', 'ReceiverName', 'ReceiverPhone', 'Description', 'MeasurementsWidth', 'MeasurementsWidthUnit', 'MeasurementsHeight', 'MeasurementsHeightUnit', 'MeasurementsDepth', 'MeasurementsDepthUnit', 'MeasurementsWeight', 'MeasurementsWeightUnit', 'OutNow', 'MaxArrivalDate', 'ReceiveOffers', 'AmountPayable', 'RegisteredAt', 'UpdatedAt', 'AddressDist1DisValue', 'AddressDist1DisDesc', 'AddressDist1DurValue', 'AddressDist1DurDesc', 'AddressDist2DisValue', 'AddressDist2DisDesc', 'AddressDist2DurValue', 'AddressDist2DurDesc', 'DeliveredAt', 'DeclaredValue', 'AdditionalAddressInformation', 'MustArrive', 'MaxOffers', ),
        self::TYPE_CAMELNAME     => array('id', 'idUser', 'idProductType', 'idShipmentType', 'idStatus', 'pin', 'startAddress', 'startAddressPlaceId', 'startAddressLat', 'startAddressLon', 'startAddressLocality', 'startAddressRegion', 'startAddressCountry', 'waypointAddress', 'waypointAddressPlaceId', 'waypointAddressLat', 'waypointAddressLon', 'waypointAddressLocality', 'waypointAddressRegion', 'waypointAddressCountry', 'endAddress', 'endAddressPlaceId', 'endAddressLat', 'endAddressLon', 'endAddressLocality', 'endAddressRegion', 'endAddressCountry', 'receiverName', 'receiverPhone', 'description', 'measurementsWidth', 'measurementsWidthUnit', 'measurementsHeight', 'measurementsHeightUnit', 'measurementsDepth', 'measurementsDepthUnit', 'measurementsWeight', 'measurementsWeightUnit', 'outNow', 'maxArrivalDate', 'receiveOffers', 'amountPayable', 'registeredAt', 'updatedAt', 'addressDist1DisValue', 'addressDist1DisDesc', 'addressDist1DurValue', 'addressDist1DurDesc', 'addressDist2DisValue', 'addressDist2DisDesc', 'addressDist2DurValue', 'addressDist2DurDesc', 'deliveredAt', 'declaredValue', 'additionalAddressInformation', 'mustArrive', 'maxOffers', ),
        self::TYPE_COLNAME       => array(ShipmentsTableMap::COL_ID, ShipmentsTableMap::COL_ID_USER, ShipmentsTableMap::COL_ID_PRODUCT_TYPE, ShipmentsTableMap::COL_ID_SHIPMENT_TYPE, ShipmentsTableMap::COL_ID_STATUS, ShipmentsTableMap::COL_PIN, ShipmentsTableMap::COL_START_ADDRESS, ShipmentsTableMap::COL_START_ADDRESS_PLACE_ID, ShipmentsTableMap::COL_START_ADDRESS_LAT, ShipmentsTableMap::COL_START_ADDRESS_LON, ShipmentsTableMap::COL_START_ADDRESS_LOCALITY, ShipmentsTableMap::COL_START_ADDRESS_REGION, ShipmentsTableMap::COL_START_ADDRESS_COUNTRY, ShipmentsTableMap::COL_WAYPOINT_ADDRESS, ShipmentsTableMap::COL_WAYPOINT_ADDRESS_PLACE_ID, ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LAT, ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LON, ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LOCALITY, ShipmentsTableMap::COL_WAYPOINT_ADDRESS_REGION, ShipmentsTableMap::COL_WAYPOINT_ADDRESS_COUNTRY, ShipmentsTableMap::COL_END_ADDRESS, ShipmentsTableMap::COL_END_ADDRESS_PLACE_ID, ShipmentsTableMap::COL_END_ADDRESS_LAT, ShipmentsTableMap::COL_END_ADDRESS_LON, ShipmentsTableMap::COL_END_ADDRESS_LOCALITY, ShipmentsTableMap::COL_END_ADDRESS_REGION, ShipmentsTableMap::COL_END_ADDRESS_COUNTRY, ShipmentsTableMap::COL_RECEIVER_NAME, ShipmentsTableMap::COL_RECEIVER_PHONE, ShipmentsTableMap::COL_DESCRIPTION, ShipmentsTableMap::COL_MEASUREMENTS_WIDTH, ShipmentsTableMap::COL_MEASUREMENTS_WIDTH_UNIT, ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT, ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT_UNIT, ShipmentsTableMap::COL_MEASUREMENTS_DEPTH, ShipmentsTableMap::COL_MEASUREMENTS_DEPTH_UNIT, ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT, ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT_UNIT, ShipmentsTableMap::COL_OUT_NOW, ShipmentsTableMap::COL_MAX_ARRIVAL_DATE, ShipmentsTableMap::COL_RECEIVE_OFFERS, ShipmentsTableMap::COL_AMOUNT_PAYABLE, ShipmentsTableMap::COL_REGISTERED_AT, ShipmentsTableMap::COL_UPDATED_AT, ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_VALUE, ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_DESC, ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_VALUE, ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_DESC, ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_VALUE, ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_DESC, ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_VALUE, ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_DESC, ShipmentsTableMap::COL_DELIVERED_AT, ShipmentsTableMap::COL_DECLARED_VALUE, ShipmentsTableMap::COL_ADDITIONAL_ADDRESS_INFORMATION, ShipmentsTableMap::COL_MUST_ARRIVE, ShipmentsTableMap::COL_MAX_OFFERS, ),
        self::TYPE_FIELDNAME     => array('id', 'id_user', 'id_product_type', 'id_shipment_type', 'id_status', 'pin', 'start_address', 'start_address_place_id', 'start_address_lat', 'start_address_lon', 'start_address_locality', 'start_address_region', 'start_address_country', 'waypoint_address', 'waypoint_address_place_id', 'waypoint_address_lat', 'waypoint_address_lon', 'waypoint_address_locality', 'waypoint_address_region', 'waypoint_address_country', 'end_address', 'end_address_place_id', 'end_address_lat', 'end_address_lon', 'end_address_locality', 'end_address_region', 'end_address_country', 'receiver_name', 'receiver_phone', 'description', 'measurements_width', 'measurements_width_unit', 'measurements_height', 'measurements_height_unit', 'measurements_depth', 'measurements_depth_unit', 'measurements_weight', 'measurements_weight_unit', 'out_now', 'max_arrival_date', 'receive_offers', 'amount_payable', 'registered_at', 'updated_at', 'address_dist_1_dis_value', 'address_dist_1_dis_desc', 'address_dist_1_dur_value', 'address_dist_1_dur_desc', 'address_dist_2_dis_value', 'address_dist_2_dis_desc', 'address_dist_2_dur_value', 'address_dist_2_dur_desc', 'delivered_at', 'declared_value', 'additional_address_information', 'must_arrive', 'max_offers', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdUser' => 1, 'IdProductType' => 2, 'IdShipmentType' => 3, 'IdStatus' => 4, 'Pin' => 5, 'StartAddress' => 6, 'StartAddressPlaceId' => 7, 'StartAddressLat' => 8, 'StartAddressLon' => 9, 'StartAddressLocality' => 10, 'StartAddressRegion' => 11, 'StartAddressCountry' => 12, 'WaypointAddress' => 13, 'WaypointAddressPlaceId' => 14, 'WaypointAddressLat' => 15, 'WaypointAddressLon' => 16, 'WaypointAddressLocality' => 17, 'WaypointAddressRegion' => 18, 'WaypointAddressCountry' => 19, 'EndAddress' => 20, 'EndAddressPlaceId' => 21, 'EndAddressLat' => 22, 'EndAddressLon' => 23, 'EndAddressLocality' => 24, 'EndAddressRegion' => 25, 'EndAddressCountry' => 26, 'ReceiverName' => 27, 'ReceiverPhone' => 28, 'Description' => 29, 'MeasurementsWidth' => 30, 'MeasurementsWidthUnit' => 31, 'MeasurementsHeight' => 32, 'MeasurementsHeightUnit' => 33, 'MeasurementsDepth' => 34, 'MeasurementsDepthUnit' => 35, 'MeasurementsWeight' => 36, 'MeasurementsWeightUnit' => 37, 'OutNow' => 38, 'MaxArrivalDate' => 39, 'ReceiveOffers' => 40, 'AmountPayable' => 41, 'RegisteredAt' => 42, 'UpdatedAt' => 43, 'AddressDist1DisValue' => 44, 'AddressDist1DisDesc' => 45, 'AddressDist1DurValue' => 46, 'AddressDist1DurDesc' => 47, 'AddressDist2DisValue' => 48, 'AddressDist2DisDesc' => 49, 'AddressDist2DurValue' => 50, 'AddressDist2DurDesc' => 51, 'DeliveredAt' => 52, 'DeclaredValue' => 53, 'AdditionalAddressInformation' => 54, 'MustArrive' => 55, 'MaxOffers' => 56, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idUser' => 1, 'idProductType' => 2, 'idShipmentType' => 3, 'idStatus' => 4, 'pin' => 5, 'startAddress' => 6, 'startAddressPlaceId' => 7, 'startAddressLat' => 8, 'startAddressLon' => 9, 'startAddressLocality' => 10, 'startAddressRegion' => 11, 'startAddressCountry' => 12, 'waypointAddress' => 13, 'waypointAddressPlaceId' => 14, 'waypointAddressLat' => 15, 'waypointAddressLon' => 16, 'waypointAddressLocality' => 17, 'waypointAddressRegion' => 18, 'waypointAddressCountry' => 19, 'endAddress' => 20, 'endAddressPlaceId' => 21, 'endAddressLat' => 22, 'endAddressLon' => 23, 'endAddressLocality' => 24, 'endAddressRegion' => 25, 'endAddressCountry' => 26, 'receiverName' => 27, 'receiverPhone' => 28, 'description' => 29, 'measurementsWidth' => 30, 'measurementsWidthUnit' => 31, 'measurementsHeight' => 32, 'measurementsHeightUnit' => 33, 'measurementsDepth' => 34, 'measurementsDepthUnit' => 35, 'measurementsWeight' => 36, 'measurementsWeightUnit' => 37, 'outNow' => 38, 'maxArrivalDate' => 39, 'receiveOffers' => 40, 'amountPayable' => 41, 'registeredAt' => 42, 'updatedAt' => 43, 'addressDist1DisValue' => 44, 'addressDist1DisDesc' => 45, 'addressDist1DurValue' => 46, 'addressDist1DurDesc' => 47, 'addressDist2DisValue' => 48, 'addressDist2DisDesc' => 49, 'addressDist2DurValue' => 50, 'addressDist2DurDesc' => 51, 'deliveredAt' => 52, 'declaredValue' => 53, 'additionalAddressInformation' => 54, 'mustArrive' => 55, 'maxOffers' => 56, ),
        self::TYPE_COLNAME       => array(ShipmentsTableMap::COL_ID => 0, ShipmentsTableMap::COL_ID_USER => 1, ShipmentsTableMap::COL_ID_PRODUCT_TYPE => 2, ShipmentsTableMap::COL_ID_SHIPMENT_TYPE => 3, ShipmentsTableMap::COL_ID_STATUS => 4, ShipmentsTableMap::COL_PIN => 5, ShipmentsTableMap::COL_START_ADDRESS => 6, ShipmentsTableMap::COL_START_ADDRESS_PLACE_ID => 7, ShipmentsTableMap::COL_START_ADDRESS_LAT => 8, ShipmentsTableMap::COL_START_ADDRESS_LON => 9, ShipmentsTableMap::COL_START_ADDRESS_LOCALITY => 10, ShipmentsTableMap::COL_START_ADDRESS_REGION => 11, ShipmentsTableMap::COL_START_ADDRESS_COUNTRY => 12, ShipmentsTableMap::COL_WAYPOINT_ADDRESS => 13, ShipmentsTableMap::COL_WAYPOINT_ADDRESS_PLACE_ID => 14, ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LAT => 15, ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LON => 16, ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LOCALITY => 17, ShipmentsTableMap::COL_WAYPOINT_ADDRESS_REGION => 18, ShipmentsTableMap::COL_WAYPOINT_ADDRESS_COUNTRY => 19, ShipmentsTableMap::COL_END_ADDRESS => 20, ShipmentsTableMap::COL_END_ADDRESS_PLACE_ID => 21, ShipmentsTableMap::COL_END_ADDRESS_LAT => 22, ShipmentsTableMap::COL_END_ADDRESS_LON => 23, ShipmentsTableMap::COL_END_ADDRESS_LOCALITY => 24, ShipmentsTableMap::COL_END_ADDRESS_REGION => 25, ShipmentsTableMap::COL_END_ADDRESS_COUNTRY => 26, ShipmentsTableMap::COL_RECEIVER_NAME => 27, ShipmentsTableMap::COL_RECEIVER_PHONE => 28, ShipmentsTableMap::COL_DESCRIPTION => 29, ShipmentsTableMap::COL_MEASUREMENTS_WIDTH => 30, ShipmentsTableMap::COL_MEASUREMENTS_WIDTH_UNIT => 31, ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT => 32, ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT_UNIT => 33, ShipmentsTableMap::COL_MEASUREMENTS_DEPTH => 34, ShipmentsTableMap::COL_MEASUREMENTS_DEPTH_UNIT => 35, ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT => 36, ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT_UNIT => 37, ShipmentsTableMap::COL_OUT_NOW => 38, ShipmentsTableMap::COL_MAX_ARRIVAL_DATE => 39, ShipmentsTableMap::COL_RECEIVE_OFFERS => 40, ShipmentsTableMap::COL_AMOUNT_PAYABLE => 41, ShipmentsTableMap::COL_REGISTERED_AT => 42, ShipmentsTableMap::COL_UPDATED_AT => 43, ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_VALUE => 44, ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_DESC => 45, ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_VALUE => 46, ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_DESC => 47, ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_VALUE => 48, ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_DESC => 49, ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_VALUE => 50, ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_DESC => 51, ShipmentsTableMap::COL_DELIVERED_AT => 52, ShipmentsTableMap::COL_DECLARED_VALUE => 53, ShipmentsTableMap::COL_ADDITIONAL_ADDRESS_INFORMATION => 54, ShipmentsTableMap::COL_MUST_ARRIVE => 55, ShipmentsTableMap::COL_MAX_OFFERS => 56, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_user' => 1, 'id_product_type' => 2, 'id_shipment_type' => 3, 'id_status' => 4, 'pin' => 5, 'start_address' => 6, 'start_address_place_id' => 7, 'start_address_lat' => 8, 'start_address_lon' => 9, 'start_address_locality' => 10, 'start_address_region' => 11, 'start_address_country' => 12, 'waypoint_address' => 13, 'waypoint_address_place_id' => 14, 'waypoint_address_lat' => 15, 'waypoint_address_lon' => 16, 'waypoint_address_locality' => 17, 'waypoint_address_region' => 18, 'waypoint_address_country' => 19, 'end_address' => 20, 'end_address_place_id' => 21, 'end_address_lat' => 22, 'end_address_lon' => 23, 'end_address_locality' => 24, 'end_address_region' => 25, 'end_address_country' => 26, 'receiver_name' => 27, 'receiver_phone' => 28, 'description' => 29, 'measurements_width' => 30, 'measurements_width_unit' => 31, 'measurements_height' => 32, 'measurements_height_unit' => 33, 'measurements_depth' => 34, 'measurements_depth_unit' => 35, 'measurements_weight' => 36, 'measurements_weight_unit' => 37, 'out_now' => 38, 'max_arrival_date' => 39, 'receive_offers' => 40, 'amount_payable' => 41, 'registered_at' => 42, 'updated_at' => 43, 'address_dist_1_dis_value' => 44, 'address_dist_1_dis_desc' => 45, 'address_dist_1_dur_value' => 46, 'address_dist_1_dur_desc' => 47, 'address_dist_2_dis_value' => 48, 'address_dist_2_dis_desc' => 49, 'address_dist_2_dur_value' => 50, 'address_dist_2_dur_desc' => 51, 'delivered_at' => 52, 'declared_value' => 53, 'additional_address_information' => 54, 'must_arrive' => 55, 'max_offers' => 56, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('shipments');
        $this->setPhpName('Shipments');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Shipments');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('id_user', 'IdUser', 'INTEGER', true, null, null);
        $this->addColumn('id_product_type', 'IdProductType', 'INTEGER', false, null, null);
        $this->addColumn('id_shipment_type', 'IdShipmentType', 'INTEGER', false, null, 0);
        $this->addColumn('id_status', 'IdStatus', 'INTEGER', false, null, null);
        $this->addColumn('pin', 'Pin', 'VARCHAR', true, 8, null);
        $this->addColumn('start_address', 'StartAddress', 'VARCHAR', false, 255, null);
        $this->addColumn('start_address_place_id', 'StartAddressPlaceId', 'LONGVARCHAR', false, null, null);
        $this->addColumn('start_address_lat', 'StartAddressLat', 'DECIMAL', false, 8, null);
        $this->addColumn('start_address_lon', 'StartAddressLon', 'DECIMAL', false, 9, null);
        $this->addColumn('start_address_locality', 'StartAddressLocality', 'VARCHAR', false, 64, null);
        $this->addColumn('start_address_region', 'StartAddressRegion', 'VARCHAR', false, 64, null);
        $this->addColumn('start_address_country', 'StartAddressCountry', 'VARCHAR', false, 24, null);
        $this->addColumn('waypoint_address', 'WaypointAddress', 'VARCHAR', false, 255, null);
        $this->addColumn('waypoint_address_place_id', 'WaypointAddressPlaceId', 'LONGVARCHAR', false, null, null);
        $this->addColumn('waypoint_address_lat', 'WaypointAddressLat', 'DECIMAL', false, 8, null);
        $this->addColumn('waypoint_address_lon', 'WaypointAddressLon', 'DECIMAL', false, 9, null);
        $this->addColumn('waypoint_address_locality', 'WaypointAddressLocality', 'VARCHAR', false, 64, null);
        $this->addColumn('waypoint_address_region', 'WaypointAddressRegion', 'VARCHAR', false, 64, null);
        $this->addColumn('waypoint_address_country', 'WaypointAddressCountry', 'VARCHAR', false, 24, null);
        $this->addColumn('end_address', 'EndAddress', 'VARCHAR', false, 255, null);
        $this->addColumn('end_address_place_id', 'EndAddressPlaceId', 'LONGVARCHAR', false, null, null);
        $this->addColumn('end_address_lat', 'EndAddressLat', 'DECIMAL', false, 8, null);
        $this->addColumn('end_address_lon', 'EndAddressLon', 'DECIMAL', false, 9, null);
        $this->addColumn('end_address_locality', 'EndAddressLocality', 'VARCHAR', false, 64, null);
        $this->addColumn('end_address_region', 'EndAddressRegion', 'VARCHAR', false, 64, null);
        $this->addColumn('end_address_country', 'EndAddressCountry', 'VARCHAR', false, 24, null);
        $this->addColumn('receiver_name', 'ReceiverName', 'VARCHAR', false, 48, null);
        $this->addColumn('receiver_phone', 'ReceiverPhone', 'VARCHAR', false, 96, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('measurements_width', 'MeasurementsWidth', 'DOUBLE', false, null, null);
        $this->addColumn('measurements_width_unit', 'MeasurementsWidthUnit', 'VARCHAR', false, 4, null);
        $this->addColumn('measurements_height', 'MeasurementsHeight', 'DOUBLE', false, null, null);
        $this->addColumn('measurements_height_unit', 'MeasurementsHeightUnit', 'VARCHAR', false, 4, null);
        $this->addColumn('measurements_depth', 'MeasurementsDepth', 'DOUBLE', false, null, null);
        $this->addColumn('measurements_depth_unit', 'MeasurementsDepthUnit', 'VARCHAR', false, 4, null);
        $this->addColumn('measurements_weight', 'MeasurementsWeight', 'DOUBLE', false, null, null);
        $this->addColumn('measurements_weight_unit', 'MeasurementsWeightUnit', 'VARCHAR', false, 4, null);
        $this->addColumn('out_now', 'OutNow', 'BOOLEAN', false, 1, null);
        $this->addColumn('max_arrival_date', 'MaxArrivalDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('receive_offers', 'ReceiveOffers', 'BOOLEAN', false, 1, null);
        $this->addColumn('amount_payable', 'AmountPayable', 'DOUBLE', false, null, null);
        $this->addColumn('registered_at', 'RegisteredAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('address_dist_1_dis_value', 'AddressDist1DisValue', 'INTEGER', false, null, 0);
        $this->addColumn('address_dist_1_dis_desc', 'AddressDist1DisDesc', 'VARCHAR', false, 16, '');
        $this->addColumn('address_dist_1_dur_value', 'AddressDist1DurValue', 'INTEGER', false, null, 0);
        $this->addColumn('address_dist_1_dur_desc', 'AddressDist1DurDesc', 'VARCHAR', false, 16, '');
        $this->addColumn('address_dist_2_dis_value', 'AddressDist2DisValue', 'INTEGER', false, null, 0);
        $this->addColumn('address_dist_2_dis_desc', 'AddressDist2DisDesc', 'VARCHAR', false, 16, '');
        $this->addColumn('address_dist_2_dur_value', 'AddressDist2DurValue', 'INTEGER', false, null, null);
        $this->addColumn('address_dist_2_dur_desc', 'AddressDist2DurDesc', 'VARCHAR', false, 16, '');
        $this->addColumn('delivered_at', 'DeliveredAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('declared_value', 'DeclaredValue', 'DOUBLE', false, null, null);
        $this->addColumn('additional_address_information', 'AdditionalAddressInformation', 'LONGVARCHAR', false, null, null);
        $this->addColumn('must_arrive', 'MustArrive', 'TIMESTAMP', false, null, null);
        $this->addColumn('max_offers', 'MaxOffers', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ShipmentsTableMap::CLASS_DEFAULT : ShipmentsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Shipments object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ShipmentsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ShipmentsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ShipmentsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ShipmentsTableMap::OM_CLASS;
            /** @var Shipments $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ShipmentsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ShipmentsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ShipmentsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Shipments $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ShipmentsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ID);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ID_USER);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ID_PRODUCT_TYPE);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ID_SHIPMENT_TYPE);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ID_STATUS);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_PIN);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_START_ADDRESS);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_START_ADDRESS_PLACE_ID);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_START_ADDRESS_LAT);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_START_ADDRESS_LON);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_START_ADDRESS_LOCALITY);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_START_ADDRESS_REGION);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_START_ADDRESS_COUNTRY);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_WAYPOINT_ADDRESS);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_PLACE_ID);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LAT);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LON);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LOCALITY);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_REGION);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_COUNTRY);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_END_ADDRESS);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_END_ADDRESS_PLACE_ID);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_END_ADDRESS_LAT);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_END_ADDRESS_LON);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_END_ADDRESS_LOCALITY);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_END_ADDRESS_REGION);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_END_ADDRESS_COUNTRY);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_RECEIVER_NAME);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_RECEIVER_PHONE);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_MEASUREMENTS_WIDTH);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_MEASUREMENTS_WIDTH_UNIT);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT_UNIT);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_MEASUREMENTS_DEPTH);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_MEASUREMENTS_DEPTH_UNIT);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT_UNIT);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_OUT_NOW);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_MAX_ARRIVAL_DATE);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_RECEIVE_OFFERS);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_AMOUNT_PAYABLE);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_REGISTERED_AT);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_VALUE);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_DESC);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_VALUE);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_DESC);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_VALUE);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_DESC);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_VALUE);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_DESC);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_DELIVERED_AT);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_DECLARED_VALUE);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_ADDITIONAL_ADDRESS_INFORMATION);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_MUST_ARRIVE);
            $criteria->addSelectColumn(ShipmentsTableMap::COL_MAX_OFFERS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_user');
            $criteria->addSelectColumn($alias . '.id_product_type');
            $criteria->addSelectColumn($alias . '.id_shipment_type');
            $criteria->addSelectColumn($alias . '.id_status');
            $criteria->addSelectColumn($alias . '.pin');
            $criteria->addSelectColumn($alias . '.start_address');
            $criteria->addSelectColumn($alias . '.start_address_place_id');
            $criteria->addSelectColumn($alias . '.start_address_lat');
            $criteria->addSelectColumn($alias . '.start_address_lon');
            $criteria->addSelectColumn($alias . '.start_address_locality');
            $criteria->addSelectColumn($alias . '.start_address_region');
            $criteria->addSelectColumn($alias . '.start_address_country');
            $criteria->addSelectColumn($alias . '.waypoint_address');
            $criteria->addSelectColumn($alias . '.waypoint_address_place_id');
            $criteria->addSelectColumn($alias . '.waypoint_address_lat');
            $criteria->addSelectColumn($alias . '.waypoint_address_lon');
            $criteria->addSelectColumn($alias . '.waypoint_address_locality');
            $criteria->addSelectColumn($alias . '.waypoint_address_region');
            $criteria->addSelectColumn($alias . '.waypoint_address_country');
            $criteria->addSelectColumn($alias . '.end_address');
            $criteria->addSelectColumn($alias . '.end_address_place_id');
            $criteria->addSelectColumn($alias . '.end_address_lat');
            $criteria->addSelectColumn($alias . '.end_address_lon');
            $criteria->addSelectColumn($alias . '.end_address_locality');
            $criteria->addSelectColumn($alias . '.end_address_region');
            $criteria->addSelectColumn($alias . '.end_address_country');
            $criteria->addSelectColumn($alias . '.receiver_name');
            $criteria->addSelectColumn($alias . '.receiver_phone');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.measurements_width');
            $criteria->addSelectColumn($alias . '.measurements_width_unit');
            $criteria->addSelectColumn($alias . '.measurements_height');
            $criteria->addSelectColumn($alias . '.measurements_height_unit');
            $criteria->addSelectColumn($alias . '.measurements_depth');
            $criteria->addSelectColumn($alias . '.measurements_depth_unit');
            $criteria->addSelectColumn($alias . '.measurements_weight');
            $criteria->addSelectColumn($alias . '.measurements_weight_unit');
            $criteria->addSelectColumn($alias . '.out_now');
            $criteria->addSelectColumn($alias . '.max_arrival_date');
            $criteria->addSelectColumn($alias . '.receive_offers');
            $criteria->addSelectColumn($alias . '.amount_payable');
            $criteria->addSelectColumn($alias . '.registered_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.address_dist_1_dis_value');
            $criteria->addSelectColumn($alias . '.address_dist_1_dis_desc');
            $criteria->addSelectColumn($alias . '.address_dist_1_dur_value');
            $criteria->addSelectColumn($alias . '.address_dist_1_dur_desc');
            $criteria->addSelectColumn($alias . '.address_dist_2_dis_value');
            $criteria->addSelectColumn($alias . '.address_dist_2_dis_desc');
            $criteria->addSelectColumn($alias . '.address_dist_2_dur_value');
            $criteria->addSelectColumn($alias . '.address_dist_2_dur_desc');
            $criteria->addSelectColumn($alias . '.delivered_at');
            $criteria->addSelectColumn($alias . '.declared_value');
            $criteria->addSelectColumn($alias . '.additional_address_information');
            $criteria->addSelectColumn($alias . '.must_arrive');
            $criteria->addSelectColumn($alias . '.max_offers');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ShipmentsTableMap::DATABASE_NAME)->getTable(ShipmentsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ShipmentsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ShipmentsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ShipmentsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Shipments or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Shipments object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Shipments) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ShipmentsTableMap::DATABASE_NAME);
            $criteria->add(ShipmentsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ShipmentsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ShipmentsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ShipmentsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the shipments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ShipmentsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Shipments or Criteria object.
     *
     * @param mixed               $criteria Criteria or Shipments object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Shipments object
        }

        if ($criteria->containsKey(ShipmentsTableMap::COL_ID) && $criteria->keyContainsValue(ShipmentsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ShipmentsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ShipmentsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ShipmentsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ShipmentsTableMap::buildTableMap();
