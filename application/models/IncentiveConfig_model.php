<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IncentiveConfig_model extends CI_Model {

    public $table = 'incentive_config';

    public function __construct() {
        parent::__construct();
    }

    public function get_all_slabs() {
        $this->db->where('status', 1);
        $this->db->order_by('min_profit', 'ASC');
        return $this->db->get($this->table)->result();
    }

    public function get_slab_by_id($id) {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    public function update_slab($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function add_slab($data) {
        return $this->db->insert($this->table, $data);
    }

    public function delete_slab($id) {
        return $this->db->update($this->table, array('status' => 0), array('id' => $id));
    }

    public function calculate_incentive($profit, $slabs = null) {
        if ($slabs === null) {
            $slabs = $this->get_all_slabs();
        }
        $profit = floatval($profit);
        foreach ($slabs as $slab) {
            $min        = floatval($slab->min_profit);
            $no_max     = ($slab->max_profit === null || $slab->max_profit === '');
            $within_max = $no_max || ($profit <= floatval($slab->max_profit));
            if ($profit >= $min && $within_max) {
                if ($slab->calculation_type === 'fixed') {
                    return floatval($slab->incentive_value);
                } else {
                    $additional = ($profit * floatval($slab->incentive_value) / 100) - floatval($slab->deduction);
                    return 500.0 + max(0.0, $additional);
                }
            }
        }
        return 500.0;
    }
}
?>
