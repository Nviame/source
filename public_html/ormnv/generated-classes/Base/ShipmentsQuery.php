<?php

namespace Base;

use \Shipments as ChildShipments;
use \ShipmentsQuery as ChildShipmentsQuery;
use \Exception;
use \PDO;
use Map\ShipmentsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'shipments' table.
 *
 *
 *
 * @method     ChildShipmentsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildShipmentsQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildShipmentsQuery orderByIdProductType($order = Criteria::ASC) Order by the id_product_type column
 * @method     ChildShipmentsQuery orderByIdShipmentType($order = Criteria::ASC) Order by the id_shipment_type column
 * @method     ChildShipmentsQuery orderByIdStatus($order = Criteria::ASC) Order by the id_status column
 * @method     ChildShipmentsQuery orderByPin($order = Criteria::ASC) Order by the pin column
 * @method     ChildShipmentsQuery orderByStartAddress($order = Criteria::ASC) Order by the start_address column
 * @method     ChildShipmentsQuery orderByStartAddressPlaceId($order = Criteria::ASC) Order by the start_address_place_id column
 * @method     ChildShipmentsQuery orderByStartAddressLat($order = Criteria::ASC) Order by the start_address_lat column
 * @method     ChildShipmentsQuery orderByStartAddressLon($order = Criteria::ASC) Order by the start_address_lon column
 * @method     ChildShipmentsQuery orderByStartAddressLocality($order = Criteria::ASC) Order by the start_address_locality column
 * @method     ChildShipmentsQuery orderByStartAddressRegion($order = Criteria::ASC) Order by the start_address_region column
 * @method     ChildShipmentsQuery orderByStartAddressCountry($order = Criteria::ASC) Order by the start_address_country column
 * @method     ChildShipmentsQuery orderByWaypointAddress($order = Criteria::ASC) Order by the waypoint_address column
 * @method     ChildShipmentsQuery orderByWaypointAddressPlaceId($order = Criteria::ASC) Order by the waypoint_address_place_id column
 * @method     ChildShipmentsQuery orderByWaypointAddressLat($order = Criteria::ASC) Order by the waypoint_address_lat column
 * @method     ChildShipmentsQuery orderByWaypointAddressLon($order = Criteria::ASC) Order by the waypoint_address_lon column
 * @method     ChildShipmentsQuery orderByWaypointAddressLocality($order = Criteria::ASC) Order by the waypoint_address_locality column
 * @method     ChildShipmentsQuery orderByWaypointAddressRegion($order = Criteria::ASC) Order by the waypoint_address_region column
 * @method     ChildShipmentsQuery orderByWaypointAddressCountry($order = Criteria::ASC) Order by the waypoint_address_country column
 * @method     ChildShipmentsQuery orderByEndAddress($order = Criteria::ASC) Order by the end_address column
 * @method     ChildShipmentsQuery orderByEndAddressPlaceId($order = Criteria::ASC) Order by the end_address_place_id column
 * @method     ChildShipmentsQuery orderByEndAddressLat($order = Criteria::ASC) Order by the end_address_lat column
 * @method     ChildShipmentsQuery orderByEndAddressLon($order = Criteria::ASC) Order by the end_address_lon column
 * @method     ChildShipmentsQuery orderByEndAddressLocality($order = Criteria::ASC) Order by the end_address_locality column
 * @method     ChildShipmentsQuery orderByEndAddressRegion($order = Criteria::ASC) Order by the end_address_region column
 * @method     ChildShipmentsQuery orderByEndAddressCountry($order = Criteria::ASC) Order by the end_address_country column
 * @method     ChildShipmentsQuery orderByReceiverName($order = Criteria::ASC) Order by the receiver_name column
 * @method     ChildShipmentsQuery orderByReceiverPhone($order = Criteria::ASC) Order by the receiver_phone column
 * @method     ChildShipmentsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildShipmentsQuery orderByMeasurementsWidth($order = Criteria::ASC) Order by the measurements_width column
 * @method     ChildShipmentsQuery orderByMeasurementsWidthUnit($order = Criteria::ASC) Order by the measurements_width_unit column
 * @method     ChildShipmentsQuery orderByMeasurementsHeight($order = Criteria::ASC) Order by the measurements_height column
 * @method     ChildShipmentsQuery orderByMeasurementsHeightUnit($order = Criteria::ASC) Order by the measurements_height_unit column
 * @method     ChildShipmentsQuery orderByMeasurementsDepth($order = Criteria::ASC) Order by the measurements_depth column
 * @method     ChildShipmentsQuery orderByMeasurementsDepthUnit($order = Criteria::ASC) Order by the measurements_depth_unit column
 * @method     ChildShipmentsQuery orderByMeasurementsWeight($order = Criteria::ASC) Order by the measurements_weight column
 * @method     ChildShipmentsQuery orderByMeasurementsWeightUnit($order = Criteria::ASC) Order by the measurements_weight_unit column
 * @method     ChildShipmentsQuery orderByOutNow($order = Criteria::ASC) Order by the out_now column
 * @method     ChildShipmentsQuery orderByMaxArrivalDate($order = Criteria::ASC) Order by the max_arrival_date column
 * @method     ChildShipmentsQuery orderByReceiveOffers($order = Criteria::ASC) Order by the receive_offers column
 * @method     ChildShipmentsQuery orderByAmountPayable($order = Criteria::ASC) Order by the amount_payable column
 * @method     ChildShipmentsQuery orderByRegisteredAt($order = Criteria::ASC) Order by the registered_at column
 * @method     ChildShipmentsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildShipmentsQuery orderByAddressDist1DisValue($order = Criteria::ASC) Order by the address_dist_1_dis_value column
 * @method     ChildShipmentsQuery orderByAddressDist1DisDesc($order = Criteria::ASC) Order by the address_dist_1_dis_desc column
 * @method     ChildShipmentsQuery orderByAddressDist1DurValue($order = Criteria::ASC) Order by the address_dist_1_dur_value column
 * @method     ChildShipmentsQuery orderByAddressDist1DurDesc($order = Criteria::ASC) Order by the address_dist_1_dur_desc column
 * @method     ChildShipmentsQuery orderByAddressDist2DisValue($order = Criteria::ASC) Order by the address_dist_2_dis_value column
 * @method     ChildShipmentsQuery orderByAddressDist2DisDesc($order = Criteria::ASC) Order by the address_dist_2_dis_desc column
 * @method     ChildShipmentsQuery orderByAddressDist2DurValue($order = Criteria::ASC) Order by the address_dist_2_dur_value column
 * @method     ChildShipmentsQuery orderByAddressDist2DurDesc($order = Criteria::ASC) Order by the address_dist_2_dur_desc column
 * @method     ChildShipmentsQuery orderByDeliveredAt($order = Criteria::ASC) Order by the delivered_at column
 * @method     ChildShipmentsQuery orderByDeclaredValue($order = Criteria::ASC) Order by the declared_value column
 * @method     ChildShipmentsQuery orderByAdditionalAddressInformation($order = Criteria::ASC) Order by the additional_address_information column
 * @method     ChildShipmentsQuery orderByMustArrive($order = Criteria::ASC) Order by the must_arrive column
 * @method     ChildShipmentsQuery orderByMaxOffers($order = Criteria::ASC) Order by the max_offers column
 *
 * @method     ChildShipmentsQuery groupById() Group by the id column
 * @method     ChildShipmentsQuery groupByIdUser() Group by the id_user column
 * @method     ChildShipmentsQuery groupByIdProductType() Group by the id_product_type column
 * @method     ChildShipmentsQuery groupByIdShipmentType() Group by the id_shipment_type column
 * @method     ChildShipmentsQuery groupByIdStatus() Group by the id_status column
 * @method     ChildShipmentsQuery groupByPin() Group by the pin column
 * @method     ChildShipmentsQuery groupByStartAddress() Group by the start_address column
 * @method     ChildShipmentsQuery groupByStartAddressPlaceId() Group by the start_address_place_id column
 * @method     ChildShipmentsQuery groupByStartAddressLat() Group by the start_address_lat column
 * @method     ChildShipmentsQuery groupByStartAddressLon() Group by the start_address_lon column
 * @method     ChildShipmentsQuery groupByStartAddressLocality() Group by the start_address_locality column
 * @method     ChildShipmentsQuery groupByStartAddressRegion() Group by the start_address_region column
 * @method     ChildShipmentsQuery groupByStartAddressCountry() Group by the start_address_country column
 * @method     ChildShipmentsQuery groupByWaypointAddress() Group by the waypoint_address column
 * @method     ChildShipmentsQuery groupByWaypointAddressPlaceId() Group by the waypoint_address_place_id column
 * @method     ChildShipmentsQuery groupByWaypointAddressLat() Group by the waypoint_address_lat column
 * @method     ChildShipmentsQuery groupByWaypointAddressLon() Group by the waypoint_address_lon column
 * @method     ChildShipmentsQuery groupByWaypointAddressLocality() Group by the waypoint_address_locality column
 * @method     ChildShipmentsQuery groupByWaypointAddressRegion() Group by the waypoint_address_region column
 * @method     ChildShipmentsQuery groupByWaypointAddressCountry() Group by the waypoint_address_country column
 * @method     ChildShipmentsQuery groupByEndAddress() Group by the end_address column
 * @method     ChildShipmentsQuery groupByEndAddressPlaceId() Group by the end_address_place_id column
 * @method     ChildShipmentsQuery groupByEndAddressLat() Group by the end_address_lat column
 * @method     ChildShipmentsQuery groupByEndAddressLon() Group by the end_address_lon column
 * @method     ChildShipmentsQuery groupByEndAddressLocality() Group by the end_address_locality column
 * @method     ChildShipmentsQuery groupByEndAddressRegion() Group by the end_address_region column
 * @method     ChildShipmentsQuery groupByEndAddressCountry() Group by the end_address_country column
 * @method     ChildShipmentsQuery groupByReceiverName() Group by the receiver_name column
 * @method     ChildShipmentsQuery groupByReceiverPhone() Group by the receiver_phone column
 * @method     ChildShipmentsQuery groupByDescription() Group by the description column
 * @method     ChildShipmentsQuery groupByMeasurementsWidth() Group by the measurements_width column
 * @method     ChildShipmentsQuery groupByMeasurementsWidthUnit() Group by the measurements_width_unit column
 * @method     ChildShipmentsQuery groupByMeasurementsHeight() Group by the measurements_height column
 * @method     ChildShipmentsQuery groupByMeasurementsHeightUnit() Group by the measurements_height_unit column
 * @method     ChildShipmentsQuery groupByMeasurementsDepth() Group by the measurements_depth column
 * @method     ChildShipmentsQuery groupByMeasurementsDepthUnit() Group by the measurements_depth_unit column
 * @method     ChildShipmentsQuery groupByMeasurementsWeight() Group by the measurements_weight column
 * @method     ChildShipmentsQuery groupByMeasurementsWeightUnit() Group by the measurements_weight_unit column
 * @method     ChildShipmentsQuery groupByOutNow() Group by the out_now column
 * @method     ChildShipmentsQuery groupByMaxArrivalDate() Group by the max_arrival_date column
 * @method     ChildShipmentsQuery groupByReceiveOffers() Group by the receive_offers column
 * @method     ChildShipmentsQuery groupByAmountPayable() Group by the amount_payable column
 * @method     ChildShipmentsQuery groupByRegisteredAt() Group by the registered_at column
 * @method     ChildShipmentsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildShipmentsQuery groupByAddressDist1DisValue() Group by the address_dist_1_dis_value column
 * @method     ChildShipmentsQuery groupByAddressDist1DisDesc() Group by the address_dist_1_dis_desc column
 * @method     ChildShipmentsQuery groupByAddressDist1DurValue() Group by the address_dist_1_dur_value column
 * @method     ChildShipmentsQuery groupByAddressDist1DurDesc() Group by the address_dist_1_dur_desc column
 * @method     ChildShipmentsQuery groupByAddressDist2DisValue() Group by the address_dist_2_dis_value column
 * @method     ChildShipmentsQuery groupByAddressDist2DisDesc() Group by the address_dist_2_dis_desc column
 * @method     ChildShipmentsQuery groupByAddressDist2DurValue() Group by the address_dist_2_dur_value column
 * @method     ChildShipmentsQuery groupByAddressDist2DurDesc() Group by the address_dist_2_dur_desc column
 * @method     ChildShipmentsQuery groupByDeliveredAt() Group by the delivered_at column
 * @method     ChildShipmentsQuery groupByDeclaredValue() Group by the declared_value column
 * @method     ChildShipmentsQuery groupByAdditionalAddressInformation() Group by the additional_address_information column
 * @method     ChildShipmentsQuery groupByMustArrive() Group by the must_arrive column
 * @method     ChildShipmentsQuery groupByMaxOffers() Group by the max_offers column
 *
 * @method     ChildShipmentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildShipmentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildShipmentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildShipments findOne(ConnectionInterface $con = null) Return the first ChildShipments matching the query
 * @method     ChildShipments findOneOrCreate(ConnectionInterface $con = null) Return the first ChildShipments matching the query, or a new ChildShipments object populated from the query conditions when no match is found
 *
 * @method     ChildShipments findOneById(int $id) Return the first ChildShipments filtered by the id column
 * @method     ChildShipments findOneByIdUser(int $id_user) Return the first ChildShipments filtered by the id_user column
 * @method     ChildShipments findOneByIdProductType(int $id_product_type) Return the first ChildShipments filtered by the id_product_type column
 * @method     ChildShipments findOneByIdShipmentType(int $id_shipment_type) Return the first ChildShipments filtered by the id_shipment_type column
 * @method     ChildShipments findOneByIdStatus(int $id_status) Return the first ChildShipments filtered by the id_status column
 * @method     ChildShipments findOneByPin(string $pin) Return the first ChildShipments filtered by the pin column
 * @method     ChildShipments findOneByStartAddress(string $start_address) Return the first ChildShipments filtered by the start_address column
 * @method     ChildShipments findOneByStartAddressPlaceId(string $start_address_place_id) Return the first ChildShipments filtered by the start_address_place_id column
 * @method     ChildShipments findOneByStartAddressLat(string $start_address_lat) Return the first ChildShipments filtered by the start_address_lat column
 * @method     ChildShipments findOneByStartAddressLon(string $start_address_lon) Return the first ChildShipments filtered by the start_address_lon column
 * @method     ChildShipments findOneByStartAddressLocality(string $start_address_locality) Return the first ChildShipments filtered by the start_address_locality column
 * @method     ChildShipments findOneByStartAddressRegion(string $start_address_region) Return the first ChildShipments filtered by the start_address_region column
 * @method     ChildShipments findOneByStartAddressCountry(string $start_address_country) Return the first ChildShipments filtered by the start_address_country column
 * @method     ChildShipments findOneByWaypointAddress(string $waypoint_address) Return the first ChildShipments filtered by the waypoint_address column
 * @method     ChildShipments findOneByWaypointAddressPlaceId(string $waypoint_address_place_id) Return the first ChildShipments filtered by the waypoint_address_place_id column
 * @method     ChildShipments findOneByWaypointAddressLat(string $waypoint_address_lat) Return the first ChildShipments filtered by the waypoint_address_lat column
 * @method     ChildShipments findOneByWaypointAddressLon(string $waypoint_address_lon) Return the first ChildShipments filtered by the waypoint_address_lon column
 * @method     ChildShipments findOneByWaypointAddressLocality(string $waypoint_address_locality) Return the first ChildShipments filtered by the waypoint_address_locality column
 * @method     ChildShipments findOneByWaypointAddressRegion(string $waypoint_address_region) Return the first ChildShipments filtered by the waypoint_address_region column
 * @method     ChildShipments findOneByWaypointAddressCountry(string $waypoint_address_country) Return the first ChildShipments filtered by the waypoint_address_country column
 * @method     ChildShipments findOneByEndAddress(string $end_address) Return the first ChildShipments filtered by the end_address column
 * @method     ChildShipments findOneByEndAddressPlaceId(string $end_address_place_id) Return the first ChildShipments filtered by the end_address_place_id column
 * @method     ChildShipments findOneByEndAddressLat(string $end_address_lat) Return the first ChildShipments filtered by the end_address_lat column
 * @method     ChildShipments findOneByEndAddressLon(string $end_address_lon) Return the first ChildShipments filtered by the end_address_lon column
 * @method     ChildShipments findOneByEndAddressLocality(string $end_address_locality) Return the first ChildShipments filtered by the end_address_locality column
 * @method     ChildShipments findOneByEndAddressRegion(string $end_address_region) Return the first ChildShipments filtered by the end_address_region column
 * @method     ChildShipments findOneByEndAddressCountry(string $end_address_country) Return the first ChildShipments filtered by the end_address_country column
 * @method     ChildShipments findOneByReceiverName(string $receiver_name) Return the first ChildShipments filtered by the receiver_name column
 * @method     ChildShipments findOneByReceiverPhone(string $receiver_phone) Return the first ChildShipments filtered by the receiver_phone column
 * @method     ChildShipments findOneByDescription(string $description) Return the first ChildShipments filtered by the description column
 * @method     ChildShipments findOneByMeasurementsWidth(double $measurements_width) Return the first ChildShipments filtered by the measurements_width column
 * @method     ChildShipments findOneByMeasurementsWidthUnit(string $measurements_width_unit) Return the first ChildShipments filtered by the measurements_width_unit column
 * @method     ChildShipments findOneByMeasurementsHeight(double $measurements_height) Return the first ChildShipments filtered by the measurements_height column
 * @method     ChildShipments findOneByMeasurementsHeightUnit(string $measurements_height_unit) Return the first ChildShipments filtered by the measurements_height_unit column
 * @method     ChildShipments findOneByMeasurementsDepth(double $measurements_depth) Return the first ChildShipments filtered by the measurements_depth column
 * @method     ChildShipments findOneByMeasurementsDepthUnit(string $measurements_depth_unit) Return the first ChildShipments filtered by the measurements_depth_unit column
 * @method     ChildShipments findOneByMeasurementsWeight(double $measurements_weight) Return the first ChildShipments filtered by the measurements_weight column
 * @method     ChildShipments findOneByMeasurementsWeightUnit(string $measurements_weight_unit) Return the first ChildShipments filtered by the measurements_weight_unit column
 * @method     ChildShipments findOneByOutNow(boolean $out_now) Return the first ChildShipments filtered by the out_now column
 * @method     ChildShipments findOneByMaxArrivalDate(string $max_arrival_date) Return the first ChildShipments filtered by the max_arrival_date column
 * @method     ChildShipments findOneByReceiveOffers(boolean $receive_offers) Return the first ChildShipments filtered by the receive_offers column
 * @method     ChildShipments findOneByAmountPayable(double $amount_payable) Return the first ChildShipments filtered by the amount_payable column
 * @method     ChildShipments findOneByRegisteredAt(string $registered_at) Return the first ChildShipments filtered by the registered_at column
 * @method     ChildShipments findOneByUpdatedAt(string $updated_at) Return the first ChildShipments filtered by the updated_at column
 * @method     ChildShipments findOneByAddressDist1DisValue(int $address_dist_1_dis_value) Return the first ChildShipments filtered by the address_dist_1_dis_value column
 * @method     ChildShipments findOneByAddressDist1DisDesc(string $address_dist_1_dis_desc) Return the first ChildShipments filtered by the address_dist_1_dis_desc column
 * @method     ChildShipments findOneByAddressDist1DurValue(int $address_dist_1_dur_value) Return the first ChildShipments filtered by the address_dist_1_dur_value column
 * @method     ChildShipments findOneByAddressDist1DurDesc(string $address_dist_1_dur_desc) Return the first ChildShipments filtered by the address_dist_1_dur_desc column
 * @method     ChildShipments findOneByAddressDist2DisValue(int $address_dist_2_dis_value) Return the first ChildShipments filtered by the address_dist_2_dis_value column
 * @method     ChildShipments findOneByAddressDist2DisDesc(string $address_dist_2_dis_desc) Return the first ChildShipments filtered by the address_dist_2_dis_desc column
 * @method     ChildShipments findOneByAddressDist2DurValue(int $address_dist_2_dur_value) Return the first ChildShipments filtered by the address_dist_2_dur_value column
 * @method     ChildShipments findOneByAddressDist2DurDesc(string $address_dist_2_dur_desc) Return the first ChildShipments filtered by the address_dist_2_dur_desc column
 * @method     ChildShipments findOneByDeliveredAt(string $delivered_at) Return the first ChildShipments filtered by the delivered_at column
 * @method     ChildShipments findOneByDeclaredValue(double $declared_value) Return the first ChildShipments filtered by the declared_value column
 * @method     ChildShipments findOneByAdditionalAddressInformation(string $additional_address_information) Return the first ChildShipments filtered by the additional_address_information column
 * @method     ChildShipments findOneByMustArrive(string $must_arrive) Return the first ChildShipments filtered by the must_arrive column
 * @method     ChildShipments findOneByMaxOffers(int $max_offers) Return the first ChildShipments filtered by the max_offers column *

 * @method     ChildShipments requirePk($key, ConnectionInterface $con = null) Return the ChildShipments by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOne(ConnectionInterface $con = null) Return the first ChildShipments matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipments requireOneById(int $id) Return the first ChildShipments filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByIdUser(int $id_user) Return the first ChildShipments filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByIdProductType(int $id_product_type) Return the first ChildShipments filtered by the id_product_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByIdShipmentType(int $id_shipment_type) Return the first ChildShipments filtered by the id_shipment_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByIdStatus(int $id_status) Return the first ChildShipments filtered by the id_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByPin(string $pin) Return the first ChildShipments filtered by the pin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByStartAddress(string $start_address) Return the first ChildShipments filtered by the start_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByStartAddressPlaceId(string $start_address_place_id) Return the first ChildShipments filtered by the start_address_place_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByStartAddressLat(string $start_address_lat) Return the first ChildShipments filtered by the start_address_lat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByStartAddressLon(string $start_address_lon) Return the first ChildShipments filtered by the start_address_lon column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByStartAddressLocality(string $start_address_locality) Return the first ChildShipments filtered by the start_address_locality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByStartAddressRegion(string $start_address_region) Return the first ChildShipments filtered by the start_address_region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByStartAddressCountry(string $start_address_country) Return the first ChildShipments filtered by the start_address_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByWaypointAddress(string $waypoint_address) Return the first ChildShipments filtered by the waypoint_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByWaypointAddressPlaceId(string $waypoint_address_place_id) Return the first ChildShipments filtered by the waypoint_address_place_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByWaypointAddressLat(string $waypoint_address_lat) Return the first ChildShipments filtered by the waypoint_address_lat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByWaypointAddressLon(string $waypoint_address_lon) Return the first ChildShipments filtered by the waypoint_address_lon column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByWaypointAddressLocality(string $waypoint_address_locality) Return the first ChildShipments filtered by the waypoint_address_locality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByWaypointAddressRegion(string $waypoint_address_region) Return the first ChildShipments filtered by the waypoint_address_region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByWaypointAddressCountry(string $waypoint_address_country) Return the first ChildShipments filtered by the waypoint_address_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByEndAddress(string $end_address) Return the first ChildShipments filtered by the end_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByEndAddressPlaceId(string $end_address_place_id) Return the first ChildShipments filtered by the end_address_place_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByEndAddressLat(string $end_address_lat) Return the first ChildShipments filtered by the end_address_lat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByEndAddressLon(string $end_address_lon) Return the first ChildShipments filtered by the end_address_lon column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByEndAddressLocality(string $end_address_locality) Return the first ChildShipments filtered by the end_address_locality column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByEndAddressRegion(string $end_address_region) Return the first ChildShipments filtered by the end_address_region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByEndAddressCountry(string $end_address_country) Return the first ChildShipments filtered by the end_address_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByReceiverName(string $receiver_name) Return the first ChildShipments filtered by the receiver_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByReceiverPhone(string $receiver_phone) Return the first ChildShipments filtered by the receiver_phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByDescription(string $description) Return the first ChildShipments filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByMeasurementsWidth(double $measurements_width) Return the first ChildShipments filtered by the measurements_width column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByMeasurementsWidthUnit(string $measurements_width_unit) Return the first ChildShipments filtered by the measurements_width_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByMeasurementsHeight(double $measurements_height) Return the first ChildShipments filtered by the measurements_height column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByMeasurementsHeightUnit(string $measurements_height_unit) Return the first ChildShipments filtered by the measurements_height_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByMeasurementsDepth(double $measurements_depth) Return the first ChildShipments filtered by the measurements_depth column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByMeasurementsDepthUnit(string $measurements_depth_unit) Return the first ChildShipments filtered by the measurements_depth_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByMeasurementsWeight(double $measurements_weight) Return the first ChildShipments filtered by the measurements_weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByMeasurementsWeightUnit(string $measurements_weight_unit) Return the first ChildShipments filtered by the measurements_weight_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByOutNow(boolean $out_now) Return the first ChildShipments filtered by the out_now column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByMaxArrivalDate(string $max_arrival_date) Return the first ChildShipments filtered by the max_arrival_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByReceiveOffers(boolean $receive_offers) Return the first ChildShipments filtered by the receive_offers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByAmountPayable(double $amount_payable) Return the first ChildShipments filtered by the amount_payable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByRegisteredAt(string $registered_at) Return the first ChildShipments filtered by the registered_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByUpdatedAt(string $updated_at) Return the first ChildShipments filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByAddressDist1DisValue(int $address_dist_1_dis_value) Return the first ChildShipments filtered by the address_dist_1_dis_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByAddressDist1DisDesc(string $address_dist_1_dis_desc) Return the first ChildShipments filtered by the address_dist_1_dis_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByAddressDist1DurValue(int $address_dist_1_dur_value) Return the first ChildShipments filtered by the address_dist_1_dur_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByAddressDist1DurDesc(string $address_dist_1_dur_desc) Return the first ChildShipments filtered by the address_dist_1_dur_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByAddressDist2DisValue(int $address_dist_2_dis_value) Return the first ChildShipments filtered by the address_dist_2_dis_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByAddressDist2DisDesc(string $address_dist_2_dis_desc) Return the first ChildShipments filtered by the address_dist_2_dis_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByAddressDist2DurValue(int $address_dist_2_dur_value) Return the first ChildShipments filtered by the address_dist_2_dur_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByAddressDist2DurDesc(string $address_dist_2_dur_desc) Return the first ChildShipments filtered by the address_dist_2_dur_desc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByDeliveredAt(string $delivered_at) Return the first ChildShipments filtered by the delivered_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByDeclaredValue(double $declared_value) Return the first ChildShipments filtered by the declared_value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByAdditionalAddressInformation(string $additional_address_information) Return the first ChildShipments filtered by the additional_address_information column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByMustArrive(string $must_arrive) Return the first ChildShipments filtered by the must_arrive column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildShipments requireOneByMaxOffers(int $max_offers) Return the first ChildShipments filtered by the max_offers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildShipments[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildShipments objects based on current ModelCriteria
 * @method     ChildShipments[]|ObjectCollection findById(int $id) Return ChildShipments objects filtered by the id column
 * @method     ChildShipments[]|ObjectCollection findByIdUser(int $id_user) Return ChildShipments objects filtered by the id_user column
 * @method     ChildShipments[]|ObjectCollection findByIdProductType(int $id_product_type) Return ChildShipments objects filtered by the id_product_type column
 * @method     ChildShipments[]|ObjectCollection findByIdShipmentType(int $id_shipment_type) Return ChildShipments objects filtered by the id_shipment_type column
 * @method     ChildShipments[]|ObjectCollection findByIdStatus(int $id_status) Return ChildShipments objects filtered by the id_status column
 * @method     ChildShipments[]|ObjectCollection findByPin(string $pin) Return ChildShipments objects filtered by the pin column
 * @method     ChildShipments[]|ObjectCollection findByStartAddress(string $start_address) Return ChildShipments objects filtered by the start_address column
 * @method     ChildShipments[]|ObjectCollection findByStartAddressPlaceId(string $start_address_place_id) Return ChildShipments objects filtered by the start_address_place_id column
 * @method     ChildShipments[]|ObjectCollection findByStartAddressLat(string $start_address_lat) Return ChildShipments objects filtered by the start_address_lat column
 * @method     ChildShipments[]|ObjectCollection findByStartAddressLon(string $start_address_lon) Return ChildShipments objects filtered by the start_address_lon column
 * @method     ChildShipments[]|ObjectCollection findByStartAddressLocality(string $start_address_locality) Return ChildShipments objects filtered by the start_address_locality column
 * @method     ChildShipments[]|ObjectCollection findByStartAddressRegion(string $start_address_region) Return ChildShipments objects filtered by the start_address_region column
 * @method     ChildShipments[]|ObjectCollection findByStartAddressCountry(string $start_address_country) Return ChildShipments objects filtered by the start_address_country column
 * @method     ChildShipments[]|ObjectCollection findByWaypointAddress(string $waypoint_address) Return ChildShipments objects filtered by the waypoint_address column
 * @method     ChildShipments[]|ObjectCollection findByWaypointAddressPlaceId(string $waypoint_address_place_id) Return ChildShipments objects filtered by the waypoint_address_place_id column
 * @method     ChildShipments[]|ObjectCollection findByWaypointAddressLat(string $waypoint_address_lat) Return ChildShipments objects filtered by the waypoint_address_lat column
 * @method     ChildShipments[]|ObjectCollection findByWaypointAddressLon(string $waypoint_address_lon) Return ChildShipments objects filtered by the waypoint_address_lon column
 * @method     ChildShipments[]|ObjectCollection findByWaypointAddressLocality(string $waypoint_address_locality) Return ChildShipments objects filtered by the waypoint_address_locality column
 * @method     ChildShipments[]|ObjectCollection findByWaypointAddressRegion(string $waypoint_address_region) Return ChildShipments objects filtered by the waypoint_address_region column
 * @method     ChildShipments[]|ObjectCollection findByWaypointAddressCountry(string $waypoint_address_country) Return ChildShipments objects filtered by the waypoint_address_country column
 * @method     ChildShipments[]|ObjectCollection findByEndAddress(string $end_address) Return ChildShipments objects filtered by the end_address column
 * @method     ChildShipments[]|ObjectCollection findByEndAddressPlaceId(string $end_address_place_id) Return ChildShipments objects filtered by the end_address_place_id column
 * @method     ChildShipments[]|ObjectCollection findByEndAddressLat(string $end_address_lat) Return ChildShipments objects filtered by the end_address_lat column
 * @method     ChildShipments[]|ObjectCollection findByEndAddressLon(string $end_address_lon) Return ChildShipments objects filtered by the end_address_lon column
 * @method     ChildShipments[]|ObjectCollection findByEndAddressLocality(string $end_address_locality) Return ChildShipments objects filtered by the end_address_locality column
 * @method     ChildShipments[]|ObjectCollection findByEndAddressRegion(string $end_address_region) Return ChildShipments objects filtered by the end_address_region column
 * @method     ChildShipments[]|ObjectCollection findByEndAddressCountry(string $end_address_country) Return ChildShipments objects filtered by the end_address_country column
 * @method     ChildShipments[]|ObjectCollection findByReceiverName(string $receiver_name) Return ChildShipments objects filtered by the receiver_name column
 * @method     ChildShipments[]|ObjectCollection findByReceiverPhone(string $receiver_phone) Return ChildShipments objects filtered by the receiver_phone column
 * @method     ChildShipments[]|ObjectCollection findByDescription(string $description) Return ChildShipments objects filtered by the description column
 * @method     ChildShipments[]|ObjectCollection findByMeasurementsWidth(double $measurements_width) Return ChildShipments objects filtered by the measurements_width column
 * @method     ChildShipments[]|ObjectCollection findByMeasurementsWidthUnit(string $measurements_width_unit) Return ChildShipments objects filtered by the measurements_width_unit column
 * @method     ChildShipments[]|ObjectCollection findByMeasurementsHeight(double $measurements_height) Return ChildShipments objects filtered by the measurements_height column
 * @method     ChildShipments[]|ObjectCollection findByMeasurementsHeightUnit(string $measurements_height_unit) Return ChildShipments objects filtered by the measurements_height_unit column
 * @method     ChildShipments[]|ObjectCollection findByMeasurementsDepth(double $measurements_depth) Return ChildShipments objects filtered by the measurements_depth column
 * @method     ChildShipments[]|ObjectCollection findByMeasurementsDepthUnit(string $measurements_depth_unit) Return ChildShipments objects filtered by the measurements_depth_unit column
 * @method     ChildShipments[]|ObjectCollection findByMeasurementsWeight(double $measurements_weight) Return ChildShipments objects filtered by the measurements_weight column
 * @method     ChildShipments[]|ObjectCollection findByMeasurementsWeightUnit(string $measurements_weight_unit) Return ChildShipments objects filtered by the measurements_weight_unit column
 * @method     ChildShipments[]|ObjectCollection findByOutNow(boolean $out_now) Return ChildShipments objects filtered by the out_now column
 * @method     ChildShipments[]|ObjectCollection findByMaxArrivalDate(string $max_arrival_date) Return ChildShipments objects filtered by the max_arrival_date column
 * @method     ChildShipments[]|ObjectCollection findByReceiveOffers(boolean $receive_offers) Return ChildShipments objects filtered by the receive_offers column
 * @method     ChildShipments[]|ObjectCollection findByAmountPayable(double $amount_payable) Return ChildShipments objects filtered by the amount_payable column
 * @method     ChildShipments[]|ObjectCollection findByRegisteredAt(string $registered_at) Return ChildShipments objects filtered by the registered_at column
 * @method     ChildShipments[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildShipments objects filtered by the updated_at column
 * @method     ChildShipments[]|ObjectCollection findByAddressDist1DisValue(int $address_dist_1_dis_value) Return ChildShipments objects filtered by the address_dist_1_dis_value column
 * @method     ChildShipments[]|ObjectCollection findByAddressDist1DisDesc(string $address_dist_1_dis_desc) Return ChildShipments objects filtered by the address_dist_1_dis_desc column
 * @method     ChildShipments[]|ObjectCollection findByAddressDist1DurValue(int $address_dist_1_dur_value) Return ChildShipments objects filtered by the address_dist_1_dur_value column
 * @method     ChildShipments[]|ObjectCollection findByAddressDist1DurDesc(string $address_dist_1_dur_desc) Return ChildShipments objects filtered by the address_dist_1_dur_desc column
 * @method     ChildShipments[]|ObjectCollection findByAddressDist2DisValue(int $address_dist_2_dis_value) Return ChildShipments objects filtered by the address_dist_2_dis_value column
 * @method     ChildShipments[]|ObjectCollection findByAddressDist2DisDesc(string $address_dist_2_dis_desc) Return ChildShipments objects filtered by the address_dist_2_dis_desc column
 * @method     ChildShipments[]|ObjectCollection findByAddressDist2DurValue(int $address_dist_2_dur_value) Return ChildShipments objects filtered by the address_dist_2_dur_value column
 * @method     ChildShipments[]|ObjectCollection findByAddressDist2DurDesc(string $address_dist_2_dur_desc) Return ChildShipments objects filtered by the address_dist_2_dur_desc column
 * @method     ChildShipments[]|ObjectCollection findByDeliveredAt(string $delivered_at) Return ChildShipments objects filtered by the delivered_at column
 * @method     ChildShipments[]|ObjectCollection findByDeclaredValue(double $declared_value) Return ChildShipments objects filtered by the declared_value column
 * @method     ChildShipments[]|ObjectCollection findByAdditionalAddressInformation(string $additional_address_information) Return ChildShipments objects filtered by the additional_address_information column
 * @method     ChildShipments[]|ObjectCollection findByMustArrive(string $must_arrive) Return ChildShipments objects filtered by the must_arrive column
 * @method     ChildShipments[]|ObjectCollection findByMaxOffers(int $max_offers) Return ChildShipments objects filtered by the max_offers column
 * @method     ChildShipments[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ShipmentsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ShipmentsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Shipments', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildShipmentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildShipmentsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildShipmentsQuery) {
            return $criteria;
        }
        $query = new ChildShipmentsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildShipments|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ShipmentsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ShipmentsTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildShipments A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_user`, `id_product_type`, `id_shipment_type`, `id_status`, `pin`, `start_address`, `start_address_place_id`, `start_address_lat`, `start_address_lon`, `start_address_locality`, `start_address_region`, `start_address_country`, `waypoint_address`, `waypoint_address_place_id`, `waypoint_address_lat`, `waypoint_address_lon`, `waypoint_address_locality`, `waypoint_address_region`, `waypoint_address_country`, `end_address`, `end_address_place_id`, `end_address_lat`, `end_address_lon`, `end_address_locality`, `end_address_region`, `end_address_country`, `receiver_name`, `receiver_phone`, `description`, `measurements_width`, `measurements_width_unit`, `measurements_height`, `measurements_height_unit`, `measurements_depth`, `measurements_depth_unit`, `measurements_weight`, `measurements_weight_unit`, `out_now`, `max_arrival_date`, `receive_offers`, `amount_payable`, `registered_at`, `updated_at`, `address_dist_1_dis_value`, `address_dist_1_dis_desc`, `address_dist_1_dur_value`, `address_dist_1_dur_desc`, `address_dist_2_dis_value`, `address_dist_2_dis_desc`, `address_dist_2_dur_value`, `address_dist_2_dur_desc`, `delivered_at`, `declared_value`, `additional_address_information`, `must_arrive`, `max_offers` FROM `shipments` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildShipments $obj */
            $obj = new ChildShipments();
            $obj->hydrate($row);
            ShipmentsTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildShipments|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ShipmentsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ShipmentsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUser(1234); // WHERE id_user = 1234
     * $query->filterByIdUser(array(12, 34)); // WHERE id_user IN (12, 34)
     * $query->filterByIdUser(array('min' => 12)); // WHERE id_user > 12
     * </code>
     *
     * @param     mixed $idUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the id_product_type column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProductType(1234); // WHERE id_product_type = 1234
     * $query->filterByIdProductType(array(12, 34)); // WHERE id_product_type IN (12, 34)
     * $query->filterByIdProductType(array('min' => 12)); // WHERE id_product_type > 12
     * </code>
     *
     * @param     mixed $idProductType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByIdProductType($idProductType = null, $comparison = null)
    {
        if (is_array($idProductType)) {
            $useMinMax = false;
            if (isset($idProductType['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ID_PRODUCT_TYPE, $idProductType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProductType['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ID_PRODUCT_TYPE, $idProductType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ID_PRODUCT_TYPE, $idProductType, $comparison);
    }

    /**
     * Filter the query on the id_shipment_type column
     *
     * Example usage:
     * <code>
     * $query->filterByIdShipmentType(1234); // WHERE id_shipment_type = 1234
     * $query->filterByIdShipmentType(array(12, 34)); // WHERE id_shipment_type IN (12, 34)
     * $query->filterByIdShipmentType(array('min' => 12)); // WHERE id_shipment_type > 12
     * </code>
     *
     * @param     mixed $idShipmentType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByIdShipmentType($idShipmentType = null, $comparison = null)
    {
        if (is_array($idShipmentType)) {
            $useMinMax = false;
            if (isset($idShipmentType['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ID_SHIPMENT_TYPE, $idShipmentType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShipmentType['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ID_SHIPMENT_TYPE, $idShipmentType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ID_SHIPMENT_TYPE, $idShipmentType, $comparison);
    }

    /**
     * Filter the query on the id_status column
     *
     * Example usage:
     * <code>
     * $query->filterByIdStatus(1234); // WHERE id_status = 1234
     * $query->filterByIdStatus(array(12, 34)); // WHERE id_status IN (12, 34)
     * $query->filterByIdStatus(array('min' => 12)); // WHERE id_status > 12
     * </code>
     *
     * @param     mixed $idStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByIdStatus($idStatus = null, $comparison = null)
    {
        if (is_array($idStatus)) {
            $useMinMax = false;
            if (isset($idStatus['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ID_STATUS, $idStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idStatus['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ID_STATUS, $idStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ID_STATUS, $idStatus, $comparison);
    }

    /**
     * Filter the query on the pin column
     *
     * Example usage:
     * <code>
     * $query->filterByPin('fooValue');   // WHERE pin = 'fooValue'
     * $query->filterByPin('%fooValue%'); // WHERE pin LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByPin($pin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pin)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pin)) {
                $pin = str_replace('*', '%', $pin);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_PIN, $pin, $comparison);
    }

    /**
     * Filter the query on the start_address column
     *
     * Example usage:
     * <code>
     * $query->filterByStartAddress('fooValue');   // WHERE start_address = 'fooValue'
     * $query->filterByStartAddress('%fooValue%'); // WHERE start_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $startAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByStartAddress($startAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($startAddress)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $startAddress)) {
                $startAddress = str_replace('*', '%', $startAddress);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_START_ADDRESS, $startAddress, $comparison);
    }

    /**
     * Filter the query on the start_address_place_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStartAddressPlaceId('fooValue');   // WHERE start_address_place_id = 'fooValue'
     * $query->filterByStartAddressPlaceId('%fooValue%'); // WHERE start_address_place_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $startAddressPlaceId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByStartAddressPlaceId($startAddressPlaceId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($startAddressPlaceId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $startAddressPlaceId)) {
                $startAddressPlaceId = str_replace('*', '%', $startAddressPlaceId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_START_ADDRESS_PLACE_ID, $startAddressPlaceId, $comparison);
    }

    /**
     * Filter the query on the start_address_lat column
     *
     * Example usage:
     * <code>
     * $query->filterByStartAddressLat(1234); // WHERE start_address_lat = 1234
     * $query->filterByStartAddressLat(array(12, 34)); // WHERE start_address_lat IN (12, 34)
     * $query->filterByStartAddressLat(array('min' => 12)); // WHERE start_address_lat > 12
     * </code>
     *
     * @param     mixed $startAddressLat The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByStartAddressLat($startAddressLat = null, $comparison = null)
    {
        if (is_array($startAddressLat)) {
            $useMinMax = false;
            if (isset($startAddressLat['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_START_ADDRESS_LAT, $startAddressLat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startAddressLat['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_START_ADDRESS_LAT, $startAddressLat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_START_ADDRESS_LAT, $startAddressLat, $comparison);
    }

    /**
     * Filter the query on the start_address_lon column
     *
     * Example usage:
     * <code>
     * $query->filterByStartAddressLon(1234); // WHERE start_address_lon = 1234
     * $query->filterByStartAddressLon(array(12, 34)); // WHERE start_address_lon IN (12, 34)
     * $query->filterByStartAddressLon(array('min' => 12)); // WHERE start_address_lon > 12
     * </code>
     *
     * @param     mixed $startAddressLon The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByStartAddressLon($startAddressLon = null, $comparison = null)
    {
        if (is_array($startAddressLon)) {
            $useMinMax = false;
            if (isset($startAddressLon['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_START_ADDRESS_LON, $startAddressLon['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startAddressLon['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_START_ADDRESS_LON, $startAddressLon['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_START_ADDRESS_LON, $startAddressLon, $comparison);
    }

    /**
     * Filter the query on the start_address_locality column
     *
     * Example usage:
     * <code>
     * $query->filterByStartAddressLocality('fooValue');   // WHERE start_address_locality = 'fooValue'
     * $query->filterByStartAddressLocality('%fooValue%'); // WHERE start_address_locality LIKE '%fooValue%'
     * </code>
     *
     * @param     string $startAddressLocality The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByStartAddressLocality($startAddressLocality = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($startAddressLocality)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $startAddressLocality)) {
                $startAddressLocality = str_replace('*', '%', $startAddressLocality);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_START_ADDRESS_LOCALITY, $startAddressLocality, $comparison);
    }

    /**
     * Filter the query on the start_address_region column
     *
     * Example usage:
     * <code>
     * $query->filterByStartAddressRegion('fooValue');   // WHERE start_address_region = 'fooValue'
     * $query->filterByStartAddressRegion('%fooValue%'); // WHERE start_address_region LIKE '%fooValue%'
     * </code>
     *
     * @param     string $startAddressRegion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByStartAddressRegion($startAddressRegion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($startAddressRegion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $startAddressRegion)) {
                $startAddressRegion = str_replace('*', '%', $startAddressRegion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_START_ADDRESS_REGION, $startAddressRegion, $comparison);
    }

    /**
     * Filter the query on the start_address_country column
     *
     * Example usage:
     * <code>
     * $query->filterByStartAddressCountry('fooValue');   // WHERE start_address_country = 'fooValue'
     * $query->filterByStartAddressCountry('%fooValue%'); // WHERE start_address_country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $startAddressCountry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByStartAddressCountry($startAddressCountry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($startAddressCountry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $startAddressCountry)) {
                $startAddressCountry = str_replace('*', '%', $startAddressCountry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_START_ADDRESS_COUNTRY, $startAddressCountry, $comparison);
    }

    /**
     * Filter the query on the waypoint_address column
     *
     * Example usage:
     * <code>
     * $query->filterByWaypointAddress('fooValue');   // WHERE waypoint_address = 'fooValue'
     * $query->filterByWaypointAddress('%fooValue%'); // WHERE waypoint_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $waypointAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByWaypointAddress($waypointAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($waypointAddress)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $waypointAddress)) {
                $waypointAddress = str_replace('*', '%', $waypointAddress);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_WAYPOINT_ADDRESS, $waypointAddress, $comparison);
    }

    /**
     * Filter the query on the waypoint_address_place_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWaypointAddressPlaceId('fooValue');   // WHERE waypoint_address_place_id = 'fooValue'
     * $query->filterByWaypointAddressPlaceId('%fooValue%'); // WHERE waypoint_address_place_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $waypointAddressPlaceId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByWaypointAddressPlaceId($waypointAddressPlaceId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($waypointAddressPlaceId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $waypointAddressPlaceId)) {
                $waypointAddressPlaceId = str_replace('*', '%', $waypointAddressPlaceId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_PLACE_ID, $waypointAddressPlaceId, $comparison);
    }

    /**
     * Filter the query on the waypoint_address_lat column
     *
     * Example usage:
     * <code>
     * $query->filterByWaypointAddressLat(1234); // WHERE waypoint_address_lat = 1234
     * $query->filterByWaypointAddressLat(array(12, 34)); // WHERE waypoint_address_lat IN (12, 34)
     * $query->filterByWaypointAddressLat(array('min' => 12)); // WHERE waypoint_address_lat > 12
     * </code>
     *
     * @param     mixed $waypointAddressLat The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByWaypointAddressLat($waypointAddressLat = null, $comparison = null)
    {
        if (is_array($waypointAddressLat)) {
            $useMinMax = false;
            if (isset($waypointAddressLat['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LAT, $waypointAddressLat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($waypointAddressLat['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LAT, $waypointAddressLat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LAT, $waypointAddressLat, $comparison);
    }

    /**
     * Filter the query on the waypoint_address_lon column
     *
     * Example usage:
     * <code>
     * $query->filterByWaypointAddressLon(1234); // WHERE waypoint_address_lon = 1234
     * $query->filterByWaypointAddressLon(array(12, 34)); // WHERE waypoint_address_lon IN (12, 34)
     * $query->filterByWaypointAddressLon(array('min' => 12)); // WHERE waypoint_address_lon > 12
     * </code>
     *
     * @param     mixed $waypointAddressLon The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByWaypointAddressLon($waypointAddressLon = null, $comparison = null)
    {
        if (is_array($waypointAddressLon)) {
            $useMinMax = false;
            if (isset($waypointAddressLon['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LON, $waypointAddressLon['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($waypointAddressLon['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LON, $waypointAddressLon['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LON, $waypointAddressLon, $comparison);
    }

    /**
     * Filter the query on the waypoint_address_locality column
     *
     * Example usage:
     * <code>
     * $query->filterByWaypointAddressLocality('fooValue');   // WHERE waypoint_address_locality = 'fooValue'
     * $query->filterByWaypointAddressLocality('%fooValue%'); // WHERE waypoint_address_locality LIKE '%fooValue%'
     * </code>
     *
     * @param     string $waypointAddressLocality The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByWaypointAddressLocality($waypointAddressLocality = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($waypointAddressLocality)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $waypointAddressLocality)) {
                $waypointAddressLocality = str_replace('*', '%', $waypointAddressLocality);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_LOCALITY, $waypointAddressLocality, $comparison);
    }

    /**
     * Filter the query on the waypoint_address_region column
     *
     * Example usage:
     * <code>
     * $query->filterByWaypointAddressRegion('fooValue');   // WHERE waypoint_address_region = 'fooValue'
     * $query->filterByWaypointAddressRegion('%fooValue%'); // WHERE waypoint_address_region LIKE '%fooValue%'
     * </code>
     *
     * @param     string $waypointAddressRegion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByWaypointAddressRegion($waypointAddressRegion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($waypointAddressRegion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $waypointAddressRegion)) {
                $waypointAddressRegion = str_replace('*', '%', $waypointAddressRegion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_REGION, $waypointAddressRegion, $comparison);
    }

    /**
     * Filter the query on the waypoint_address_country column
     *
     * Example usage:
     * <code>
     * $query->filterByWaypointAddressCountry('fooValue');   // WHERE waypoint_address_country = 'fooValue'
     * $query->filterByWaypointAddressCountry('%fooValue%'); // WHERE waypoint_address_country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $waypointAddressCountry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByWaypointAddressCountry($waypointAddressCountry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($waypointAddressCountry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $waypointAddressCountry)) {
                $waypointAddressCountry = str_replace('*', '%', $waypointAddressCountry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_WAYPOINT_ADDRESS_COUNTRY, $waypointAddressCountry, $comparison);
    }

    /**
     * Filter the query on the end_address column
     *
     * Example usage:
     * <code>
     * $query->filterByEndAddress('fooValue');   // WHERE end_address = 'fooValue'
     * $query->filterByEndAddress('%fooValue%'); // WHERE end_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $endAddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByEndAddress($endAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($endAddress)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $endAddress)) {
                $endAddress = str_replace('*', '%', $endAddress);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_END_ADDRESS, $endAddress, $comparison);
    }

    /**
     * Filter the query on the end_address_place_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEndAddressPlaceId('fooValue');   // WHERE end_address_place_id = 'fooValue'
     * $query->filterByEndAddressPlaceId('%fooValue%'); // WHERE end_address_place_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $endAddressPlaceId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByEndAddressPlaceId($endAddressPlaceId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($endAddressPlaceId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $endAddressPlaceId)) {
                $endAddressPlaceId = str_replace('*', '%', $endAddressPlaceId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_END_ADDRESS_PLACE_ID, $endAddressPlaceId, $comparison);
    }

    /**
     * Filter the query on the end_address_lat column
     *
     * Example usage:
     * <code>
     * $query->filterByEndAddressLat(1234); // WHERE end_address_lat = 1234
     * $query->filterByEndAddressLat(array(12, 34)); // WHERE end_address_lat IN (12, 34)
     * $query->filterByEndAddressLat(array('min' => 12)); // WHERE end_address_lat > 12
     * </code>
     *
     * @param     mixed $endAddressLat The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByEndAddressLat($endAddressLat = null, $comparison = null)
    {
        if (is_array($endAddressLat)) {
            $useMinMax = false;
            if (isset($endAddressLat['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_END_ADDRESS_LAT, $endAddressLat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endAddressLat['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_END_ADDRESS_LAT, $endAddressLat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_END_ADDRESS_LAT, $endAddressLat, $comparison);
    }

    /**
     * Filter the query on the end_address_lon column
     *
     * Example usage:
     * <code>
     * $query->filterByEndAddressLon(1234); // WHERE end_address_lon = 1234
     * $query->filterByEndAddressLon(array(12, 34)); // WHERE end_address_lon IN (12, 34)
     * $query->filterByEndAddressLon(array('min' => 12)); // WHERE end_address_lon > 12
     * </code>
     *
     * @param     mixed $endAddressLon The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByEndAddressLon($endAddressLon = null, $comparison = null)
    {
        if (is_array($endAddressLon)) {
            $useMinMax = false;
            if (isset($endAddressLon['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_END_ADDRESS_LON, $endAddressLon['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($endAddressLon['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_END_ADDRESS_LON, $endAddressLon['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_END_ADDRESS_LON, $endAddressLon, $comparison);
    }

    /**
     * Filter the query on the end_address_locality column
     *
     * Example usage:
     * <code>
     * $query->filterByEndAddressLocality('fooValue');   // WHERE end_address_locality = 'fooValue'
     * $query->filterByEndAddressLocality('%fooValue%'); // WHERE end_address_locality LIKE '%fooValue%'
     * </code>
     *
     * @param     string $endAddressLocality The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByEndAddressLocality($endAddressLocality = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($endAddressLocality)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $endAddressLocality)) {
                $endAddressLocality = str_replace('*', '%', $endAddressLocality);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_END_ADDRESS_LOCALITY, $endAddressLocality, $comparison);
    }

    /**
     * Filter the query on the end_address_region column
     *
     * Example usage:
     * <code>
     * $query->filterByEndAddressRegion('fooValue');   // WHERE end_address_region = 'fooValue'
     * $query->filterByEndAddressRegion('%fooValue%'); // WHERE end_address_region LIKE '%fooValue%'
     * </code>
     *
     * @param     string $endAddressRegion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByEndAddressRegion($endAddressRegion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($endAddressRegion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $endAddressRegion)) {
                $endAddressRegion = str_replace('*', '%', $endAddressRegion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_END_ADDRESS_REGION, $endAddressRegion, $comparison);
    }

    /**
     * Filter the query on the end_address_country column
     *
     * Example usage:
     * <code>
     * $query->filterByEndAddressCountry('fooValue');   // WHERE end_address_country = 'fooValue'
     * $query->filterByEndAddressCountry('%fooValue%'); // WHERE end_address_country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $endAddressCountry The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByEndAddressCountry($endAddressCountry = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($endAddressCountry)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $endAddressCountry)) {
                $endAddressCountry = str_replace('*', '%', $endAddressCountry);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_END_ADDRESS_COUNTRY, $endAddressCountry, $comparison);
    }

    /**
     * Filter the query on the receiver_name column
     *
     * Example usage:
     * <code>
     * $query->filterByReceiverName('fooValue');   // WHERE receiver_name = 'fooValue'
     * $query->filterByReceiverName('%fooValue%'); // WHERE receiver_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $receiverName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByReceiverName($receiverName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($receiverName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $receiverName)) {
                $receiverName = str_replace('*', '%', $receiverName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_RECEIVER_NAME, $receiverName, $comparison);
    }

    /**
     * Filter the query on the receiver_phone column
     *
     * Example usage:
     * <code>
     * $query->filterByReceiverPhone('fooValue');   // WHERE receiver_phone = 'fooValue'
     * $query->filterByReceiverPhone('%fooValue%'); // WHERE receiver_phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $receiverPhone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByReceiverPhone($receiverPhone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($receiverPhone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $receiverPhone)) {
                $receiverPhone = str_replace('*', '%', $receiverPhone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_RECEIVER_PHONE, $receiverPhone, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the measurements_width column
     *
     * Example usage:
     * <code>
     * $query->filterByMeasurementsWidth(1234); // WHERE measurements_width = 1234
     * $query->filterByMeasurementsWidth(array(12, 34)); // WHERE measurements_width IN (12, 34)
     * $query->filterByMeasurementsWidth(array('min' => 12)); // WHERE measurements_width > 12
     * </code>
     *
     * @param     mixed $measurementsWidth The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByMeasurementsWidth($measurementsWidth = null, $comparison = null)
    {
        if (is_array($measurementsWidth)) {
            $useMinMax = false;
            if (isset($measurementsWidth['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_WIDTH, $measurementsWidth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($measurementsWidth['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_WIDTH, $measurementsWidth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_WIDTH, $measurementsWidth, $comparison);
    }

    /**
     * Filter the query on the measurements_width_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByMeasurementsWidthUnit('fooValue');   // WHERE measurements_width_unit = 'fooValue'
     * $query->filterByMeasurementsWidthUnit('%fooValue%'); // WHERE measurements_width_unit LIKE '%fooValue%'
     * </code>
     *
     * @param     string $measurementsWidthUnit The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByMeasurementsWidthUnit($measurementsWidthUnit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($measurementsWidthUnit)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $measurementsWidthUnit)) {
                $measurementsWidthUnit = str_replace('*', '%', $measurementsWidthUnit);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_WIDTH_UNIT, $measurementsWidthUnit, $comparison);
    }

    /**
     * Filter the query on the measurements_height column
     *
     * Example usage:
     * <code>
     * $query->filterByMeasurementsHeight(1234); // WHERE measurements_height = 1234
     * $query->filterByMeasurementsHeight(array(12, 34)); // WHERE measurements_height IN (12, 34)
     * $query->filterByMeasurementsHeight(array('min' => 12)); // WHERE measurements_height > 12
     * </code>
     *
     * @param     mixed $measurementsHeight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByMeasurementsHeight($measurementsHeight = null, $comparison = null)
    {
        if (is_array($measurementsHeight)) {
            $useMinMax = false;
            if (isset($measurementsHeight['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT, $measurementsHeight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($measurementsHeight['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT, $measurementsHeight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT, $measurementsHeight, $comparison);
    }

    /**
     * Filter the query on the measurements_height_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByMeasurementsHeightUnit('fooValue');   // WHERE measurements_height_unit = 'fooValue'
     * $query->filterByMeasurementsHeightUnit('%fooValue%'); // WHERE measurements_height_unit LIKE '%fooValue%'
     * </code>
     *
     * @param     string $measurementsHeightUnit The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByMeasurementsHeightUnit($measurementsHeightUnit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($measurementsHeightUnit)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $measurementsHeightUnit)) {
                $measurementsHeightUnit = str_replace('*', '%', $measurementsHeightUnit);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_HEIGHT_UNIT, $measurementsHeightUnit, $comparison);
    }

    /**
     * Filter the query on the measurements_depth column
     *
     * Example usage:
     * <code>
     * $query->filterByMeasurementsDepth(1234); // WHERE measurements_depth = 1234
     * $query->filterByMeasurementsDepth(array(12, 34)); // WHERE measurements_depth IN (12, 34)
     * $query->filterByMeasurementsDepth(array('min' => 12)); // WHERE measurements_depth > 12
     * </code>
     *
     * @param     mixed $measurementsDepth The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByMeasurementsDepth($measurementsDepth = null, $comparison = null)
    {
        if (is_array($measurementsDepth)) {
            $useMinMax = false;
            if (isset($measurementsDepth['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_DEPTH, $measurementsDepth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($measurementsDepth['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_DEPTH, $measurementsDepth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_DEPTH, $measurementsDepth, $comparison);
    }

    /**
     * Filter the query on the measurements_depth_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByMeasurementsDepthUnit('fooValue');   // WHERE measurements_depth_unit = 'fooValue'
     * $query->filterByMeasurementsDepthUnit('%fooValue%'); // WHERE measurements_depth_unit LIKE '%fooValue%'
     * </code>
     *
     * @param     string $measurementsDepthUnit The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByMeasurementsDepthUnit($measurementsDepthUnit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($measurementsDepthUnit)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $measurementsDepthUnit)) {
                $measurementsDepthUnit = str_replace('*', '%', $measurementsDepthUnit);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_DEPTH_UNIT, $measurementsDepthUnit, $comparison);
    }

    /**
     * Filter the query on the measurements_weight column
     *
     * Example usage:
     * <code>
     * $query->filterByMeasurementsWeight(1234); // WHERE measurements_weight = 1234
     * $query->filterByMeasurementsWeight(array(12, 34)); // WHERE measurements_weight IN (12, 34)
     * $query->filterByMeasurementsWeight(array('min' => 12)); // WHERE measurements_weight > 12
     * </code>
     *
     * @param     mixed $measurementsWeight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByMeasurementsWeight($measurementsWeight = null, $comparison = null)
    {
        if (is_array($measurementsWeight)) {
            $useMinMax = false;
            if (isset($measurementsWeight['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT, $measurementsWeight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($measurementsWeight['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT, $measurementsWeight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT, $measurementsWeight, $comparison);
    }

    /**
     * Filter the query on the measurements_weight_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByMeasurementsWeightUnit('fooValue');   // WHERE measurements_weight_unit = 'fooValue'
     * $query->filterByMeasurementsWeightUnit('%fooValue%'); // WHERE measurements_weight_unit LIKE '%fooValue%'
     * </code>
     *
     * @param     string $measurementsWeightUnit The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByMeasurementsWeightUnit($measurementsWeightUnit = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($measurementsWeightUnit)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $measurementsWeightUnit)) {
                $measurementsWeightUnit = str_replace('*', '%', $measurementsWeightUnit);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_MEASUREMENTS_WEIGHT_UNIT, $measurementsWeightUnit, $comparison);
    }

    /**
     * Filter the query on the out_now column
     *
     * Example usage:
     * <code>
     * $query->filterByOutNow(true); // WHERE out_now = true
     * $query->filterByOutNow('yes'); // WHERE out_now = true
     * </code>
     *
     * @param     boolean|string $outNow The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByOutNow($outNow = null, $comparison = null)
    {
        if (is_string($outNow)) {
            $outNow = in_array(strtolower($outNow), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_OUT_NOW, $outNow, $comparison);
    }

    /**
     * Filter the query on the max_arrival_date column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxArrivalDate('2011-03-14'); // WHERE max_arrival_date = '2011-03-14'
     * $query->filterByMaxArrivalDate('now'); // WHERE max_arrival_date = '2011-03-14'
     * $query->filterByMaxArrivalDate(array('max' => 'yesterday')); // WHERE max_arrival_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $maxArrivalDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByMaxArrivalDate($maxArrivalDate = null, $comparison = null)
    {
        if (is_array($maxArrivalDate)) {
            $useMinMax = false;
            if (isset($maxArrivalDate['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MAX_ARRIVAL_DATE, $maxArrivalDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxArrivalDate['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MAX_ARRIVAL_DATE, $maxArrivalDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_MAX_ARRIVAL_DATE, $maxArrivalDate, $comparison);
    }

    /**
     * Filter the query on the receive_offers column
     *
     * Example usage:
     * <code>
     * $query->filterByReceiveOffers(true); // WHERE receive_offers = true
     * $query->filterByReceiveOffers('yes'); // WHERE receive_offers = true
     * </code>
     *
     * @param     boolean|string $receiveOffers The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByReceiveOffers($receiveOffers = null, $comparison = null)
    {
        if (is_string($receiveOffers)) {
            $receiveOffers = in_array(strtolower($receiveOffers), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_RECEIVE_OFFERS, $receiveOffers, $comparison);
    }

    /**
     * Filter the query on the amount_payable column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountPayable(1234); // WHERE amount_payable = 1234
     * $query->filterByAmountPayable(array(12, 34)); // WHERE amount_payable IN (12, 34)
     * $query->filterByAmountPayable(array('min' => 12)); // WHERE amount_payable > 12
     * </code>
     *
     * @param     mixed $amountPayable The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByAmountPayable($amountPayable = null, $comparison = null)
    {
        if (is_array($amountPayable)) {
            $useMinMax = false;
            if (isset($amountPayable['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_AMOUNT_PAYABLE, $amountPayable['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amountPayable['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_AMOUNT_PAYABLE, $amountPayable['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_AMOUNT_PAYABLE, $amountPayable, $comparison);
    }

    /**
     * Filter the query on the registered_at column
     *
     * Example usage:
     * <code>
     * $query->filterByRegisteredAt('2011-03-14'); // WHERE registered_at = '2011-03-14'
     * $query->filterByRegisteredAt('now'); // WHERE registered_at = '2011-03-14'
     * $query->filterByRegisteredAt(array('max' => 'yesterday')); // WHERE registered_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $registeredAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByRegisteredAt($registeredAt = null, $comparison = null)
    {
        if (is_array($registeredAt)) {
            $useMinMax = false;
            if (isset($registeredAt['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_REGISTERED_AT, $registeredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registeredAt['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_REGISTERED_AT, $registeredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_REGISTERED_AT, $registeredAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the address_dist_1_dis_value column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressDist1DisValue(1234); // WHERE address_dist_1_dis_value = 1234
     * $query->filterByAddressDist1DisValue(array(12, 34)); // WHERE address_dist_1_dis_value IN (12, 34)
     * $query->filterByAddressDist1DisValue(array('min' => 12)); // WHERE address_dist_1_dis_value > 12
     * </code>
     *
     * @param     mixed $addressDist1DisValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByAddressDist1DisValue($addressDist1DisValue = null, $comparison = null)
    {
        if (is_array($addressDist1DisValue)) {
            $useMinMax = false;
            if (isset($addressDist1DisValue['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_VALUE, $addressDist1DisValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addressDist1DisValue['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_VALUE, $addressDist1DisValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_VALUE, $addressDist1DisValue, $comparison);
    }

    /**
     * Filter the query on the address_dist_1_dis_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressDist1DisDesc('fooValue');   // WHERE address_dist_1_dis_desc = 'fooValue'
     * $query->filterByAddressDist1DisDesc('%fooValue%'); // WHERE address_dist_1_dis_desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressDist1DisDesc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByAddressDist1DisDesc($addressDist1DisDesc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressDist1DisDesc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addressDist1DisDesc)) {
                $addressDist1DisDesc = str_replace('*', '%', $addressDist1DisDesc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_1_DIS_DESC, $addressDist1DisDesc, $comparison);
    }

    /**
     * Filter the query on the address_dist_1_dur_value column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressDist1DurValue(1234); // WHERE address_dist_1_dur_value = 1234
     * $query->filterByAddressDist1DurValue(array(12, 34)); // WHERE address_dist_1_dur_value IN (12, 34)
     * $query->filterByAddressDist1DurValue(array('min' => 12)); // WHERE address_dist_1_dur_value > 12
     * </code>
     *
     * @param     mixed $addressDist1DurValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByAddressDist1DurValue($addressDist1DurValue = null, $comparison = null)
    {
        if (is_array($addressDist1DurValue)) {
            $useMinMax = false;
            if (isset($addressDist1DurValue['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_VALUE, $addressDist1DurValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addressDist1DurValue['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_VALUE, $addressDist1DurValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_VALUE, $addressDist1DurValue, $comparison);
    }

    /**
     * Filter the query on the address_dist_1_dur_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressDist1DurDesc('fooValue');   // WHERE address_dist_1_dur_desc = 'fooValue'
     * $query->filterByAddressDist1DurDesc('%fooValue%'); // WHERE address_dist_1_dur_desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressDist1DurDesc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByAddressDist1DurDesc($addressDist1DurDesc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressDist1DurDesc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addressDist1DurDesc)) {
                $addressDist1DurDesc = str_replace('*', '%', $addressDist1DurDesc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_1_DUR_DESC, $addressDist1DurDesc, $comparison);
    }

    /**
     * Filter the query on the address_dist_2_dis_value column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressDist2DisValue(1234); // WHERE address_dist_2_dis_value = 1234
     * $query->filterByAddressDist2DisValue(array(12, 34)); // WHERE address_dist_2_dis_value IN (12, 34)
     * $query->filterByAddressDist2DisValue(array('min' => 12)); // WHERE address_dist_2_dis_value > 12
     * </code>
     *
     * @param     mixed $addressDist2DisValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByAddressDist2DisValue($addressDist2DisValue = null, $comparison = null)
    {
        if (is_array($addressDist2DisValue)) {
            $useMinMax = false;
            if (isset($addressDist2DisValue['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_VALUE, $addressDist2DisValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addressDist2DisValue['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_VALUE, $addressDist2DisValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_VALUE, $addressDist2DisValue, $comparison);
    }

    /**
     * Filter the query on the address_dist_2_dis_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressDist2DisDesc('fooValue');   // WHERE address_dist_2_dis_desc = 'fooValue'
     * $query->filterByAddressDist2DisDesc('%fooValue%'); // WHERE address_dist_2_dis_desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressDist2DisDesc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByAddressDist2DisDesc($addressDist2DisDesc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressDist2DisDesc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addressDist2DisDesc)) {
                $addressDist2DisDesc = str_replace('*', '%', $addressDist2DisDesc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_2_DIS_DESC, $addressDist2DisDesc, $comparison);
    }

    /**
     * Filter the query on the address_dist_2_dur_value column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressDist2DurValue(1234); // WHERE address_dist_2_dur_value = 1234
     * $query->filterByAddressDist2DurValue(array(12, 34)); // WHERE address_dist_2_dur_value IN (12, 34)
     * $query->filterByAddressDist2DurValue(array('min' => 12)); // WHERE address_dist_2_dur_value > 12
     * </code>
     *
     * @param     mixed $addressDist2DurValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByAddressDist2DurValue($addressDist2DurValue = null, $comparison = null)
    {
        if (is_array($addressDist2DurValue)) {
            $useMinMax = false;
            if (isset($addressDist2DurValue['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_VALUE, $addressDist2DurValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($addressDist2DurValue['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_VALUE, $addressDist2DurValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_VALUE, $addressDist2DurValue, $comparison);
    }

    /**
     * Filter the query on the address_dist_2_dur_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByAddressDist2DurDesc('fooValue');   // WHERE address_dist_2_dur_desc = 'fooValue'
     * $query->filterByAddressDist2DurDesc('%fooValue%'); // WHERE address_dist_2_dur_desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $addressDist2DurDesc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByAddressDist2DurDesc($addressDist2DurDesc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($addressDist2DurDesc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $addressDist2DurDesc)) {
                $addressDist2DurDesc = str_replace('*', '%', $addressDist2DurDesc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ADDRESS_DIST_2_DUR_DESC, $addressDist2DurDesc, $comparison);
    }

    /**
     * Filter the query on the delivered_at column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveredAt('2011-03-14'); // WHERE delivered_at = '2011-03-14'
     * $query->filterByDeliveredAt('now'); // WHERE delivered_at = '2011-03-14'
     * $query->filterByDeliveredAt(array('max' => 'yesterday')); // WHERE delivered_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $deliveredAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByDeliveredAt($deliveredAt = null, $comparison = null)
    {
        if (is_array($deliveredAt)) {
            $useMinMax = false;
            if (isset($deliveredAt['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_DELIVERED_AT, $deliveredAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveredAt['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_DELIVERED_AT, $deliveredAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_DELIVERED_AT, $deliveredAt, $comparison);
    }

    /**
     * Filter the query on the declared_value column
     *
     * Example usage:
     * <code>
     * $query->filterByDeclaredValue(1234); // WHERE declared_value = 1234
     * $query->filterByDeclaredValue(array(12, 34)); // WHERE declared_value IN (12, 34)
     * $query->filterByDeclaredValue(array('min' => 12)); // WHERE declared_value > 12
     * </code>
     *
     * @param     mixed $declaredValue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByDeclaredValue($declaredValue = null, $comparison = null)
    {
        if (is_array($declaredValue)) {
            $useMinMax = false;
            if (isset($declaredValue['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_DECLARED_VALUE, $declaredValue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($declaredValue['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_DECLARED_VALUE, $declaredValue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_DECLARED_VALUE, $declaredValue, $comparison);
    }

    /**
     * Filter the query on the additional_address_information column
     *
     * Example usage:
     * <code>
     * $query->filterByAdditionalAddressInformation('fooValue');   // WHERE additional_address_information = 'fooValue'
     * $query->filterByAdditionalAddressInformation('%fooValue%'); // WHERE additional_address_information LIKE '%fooValue%'
     * </code>
     *
     * @param     string $additionalAddressInformation The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByAdditionalAddressInformation($additionalAddressInformation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($additionalAddressInformation)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $additionalAddressInformation)) {
                $additionalAddressInformation = str_replace('*', '%', $additionalAddressInformation);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_ADDITIONAL_ADDRESS_INFORMATION, $additionalAddressInformation, $comparison);
    }

    /**
     * Filter the query on the must_arrive column
     *
     * Example usage:
     * <code>
     * $query->filterByMustArrive('2011-03-14'); // WHERE must_arrive = '2011-03-14'
     * $query->filterByMustArrive('now'); // WHERE must_arrive = '2011-03-14'
     * $query->filterByMustArrive(array('max' => 'yesterday')); // WHERE must_arrive > '2011-03-13'
     * </code>
     *
     * @param     mixed $mustArrive The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByMustArrive($mustArrive = null, $comparison = null)
    {
        if (is_array($mustArrive)) {
            $useMinMax = false;
            if (isset($mustArrive['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MUST_ARRIVE, $mustArrive['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mustArrive['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MUST_ARRIVE, $mustArrive['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_MUST_ARRIVE, $mustArrive, $comparison);
    }

    /**
     * Filter the query on the max_offers column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxOffers(1234); // WHERE max_offers = 1234
     * $query->filterByMaxOffers(array(12, 34)); // WHERE max_offers IN (12, 34)
     * $query->filterByMaxOffers(array('min' => 12)); // WHERE max_offers > 12
     * </code>
     *
     * @param     mixed $maxOffers The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function filterByMaxOffers($maxOffers = null, $comparison = null)
    {
        if (is_array($maxOffers)) {
            $useMinMax = false;
            if (isset($maxOffers['min'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MAX_OFFERS, $maxOffers['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxOffers['max'])) {
                $this->addUsingAlias(ShipmentsTableMap::COL_MAX_OFFERS, $maxOffers['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ShipmentsTableMap::COL_MAX_OFFERS, $maxOffers, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildShipments $shipments Object to remove from the list of results
     *
     * @return $this|ChildShipmentsQuery The current query, for fluid interface
     */
    public function prune($shipments = null)
    {
        if ($shipments) {
            $this->addUsingAlias(ShipmentsTableMap::COL_ID, $shipments->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the shipments table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ShipmentsTableMap::clearInstancePool();
            ShipmentsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ShipmentsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ShipmentsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ShipmentsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ShipmentsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ShipmentsQuery
