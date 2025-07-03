<?php

namespace App\Models;

use CodeIgniter\Model;

class HubModel extends Model
{
    protected $table = 'hub';
    protected $primaryKey = 'hub_id';

    protected $allowedFields = ['hub_name'];

    public function getHubslist($perPage, $currentPage)
    {
        return $this->select('hub.*')
            ->paginate($perPage, 'default', $currentPage);
    }

    public function getHubs()
    {
        return $this->select('hub.*')
            ->findAll();
    }
    public function getInventoryPending($date, $hubId = null)
    {
        $builder = $this->db->table('hub h');
        $builder->select('h.hub_name');

        $escapedDate = $this->db->escape($date);

        $builder->select("(
        SELECT COALESCE(SUM(i.no_of_pieces), 0)
        FROM inventory i
        WHERE i.inventory_type = 'inbound'
        AND i.hub = h.hub_id
        AND i.date = $escapedDate
    ) AS total_inventory");

        $builder->select("(
        SELECT COALESCE(SUM(d.successful_deliveries), 0)
        FROM deliveries d
        WHERE d.hub = h.hub_id
        AND d.service_date = $escapedDate
    ) AS total_successful_deliveries");

        $builder->select("(
        SELECT COALESCE(SUM(r.no_of_pieces), 0)
        FROM rto_pickup r
        WHERE r.hub = h.hub_id
        AND r.date_of_return = $escapedDate
        AND r.rto_pickup_type = 'rto'
    ) AS total_rto");

        $builder->select("(
        (
            SELECT COALESCE(SUM(i.no_of_pieces), 0)
            FROM inventory i
            WHERE i.inventory_type = 'inbound'
            AND i.hub = h.hub_id
            AND i.date = $escapedDate
        )
        -
        (
            SELECT COALESCE(SUM(d.successful_deliveries), 0)
            FROM deliveries d
            WHERE d.hub = h.hub_id
            AND d.service_date = $escapedDate
        )
        -
        (
            SELECT COALESCE(SUM(r.no_of_pieces), 0)
            FROM rto_pickup r
            WHERE r.hub = h.hub_id
            AND r.date_of_return = $escapedDate
            AND r.rto_pickup_type = 'rto'
        )
    ) AS inventory_pending");

        $builder->select("$escapedDate AS date");

        // Filter for specific hub if not admin
        if ($hubId !== null) {
            $builder->where('h.hub_id', $hubId);
        }

        return $builder->get()->getResult();
    }

    public function getInventoryPendingBetween($fromDate, $toDate, $hubId = null)
    {
        $builder = $this->db->table('hub h');
        $builder->select('h.hub_name');

        $escapedFromDate = $this->db->escape($fromDate);
        $escapedToDate = $this->db->escape($toDate);

        $builder->select("(
        SELECT COALESCE(SUM(i.no_of_pieces), 0)
        FROM inventory i
        WHERE i.inventory_type = 'inbound'
        AND i.hub = h.hub_id
        AND i.date BETWEEN $escapedFromDate AND $escapedToDate
    ) AS total_inventory");

        $builder->select("(
        SELECT COALESCE(SUM(d.successful_deliveries), 0)
        FROM deliveries d
        WHERE d.hub = h.hub_id
        AND d.service_date BETWEEN $escapedFromDate AND $escapedToDate
    ) AS total_successful_deliveries");

        $builder->select("(
        SELECT COALESCE(SUM(r.no_of_pieces), 0)
        FROM rto_pickup r
        WHERE r.hub = h.hub_id
        AND r.date_of_return BETWEEN $escapedFromDate AND $escapedToDate
        AND r.rto_pickup_type = 'rto'
    ) AS total_rto");

        $builder->select("(
        (
            SELECT COALESCE(SUM(i.no_of_pieces), 0)
            FROM inventory i
            WHERE i.inventory_type = 'inbound'
            AND i.hub = h.hub_id
            AND i.date BETWEEN $escapedFromDate AND $escapedToDate
        )
        -
        (
            SELECT COALESCE(SUM(d.successful_deliveries), 0)
            FROM deliveries d
            WHERE d.hub = h.hub_id
            AND d.service_date BETWEEN $escapedFromDate AND $escapedToDate
        )
        -
        (
            SELECT COALESCE(SUM(r.no_of_pieces), 0)
            FROM rto_pickup r
            WHERE r.hub = h.hub_id
            AND r.date_of_return BETWEEN $escapedFromDate AND $escapedToDate
            AND r.rto_pickup_type = 'rto'
        )
    ) AS inventory_pending");

        $builder->select("CONCAT($escapedFromDate, ' to ', $escapedToDate) AS date_range");

        if ($hubId !== null) {
            $builder->where('h.hub_id', $hubId);
        }

        return $builder->get()->getResult();
    }
}
