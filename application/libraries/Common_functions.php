<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common_functions {

    private $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    public function getAppoinmentFrequency($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    /**
     *
     * Common function to get times as option-list.
     *
     * @return array List of times
     */
    public function get_time_selectoptions($default = '05:00', $interval = '+30 minutes') {
        $output = array();
        $current = strtotime($default);
        $end = strtotime('23:59');
        while ($current <= $end) {
            array_push($output, date("h.i A", $current));
            $current = strtotime($interval, $current);
        }

        return $output;
    }

    /**
     *
     * Get end times as option-list for start time change.
     *
     * @return array List of times
     */
    public function get_endtime_selectoptions($default = '10:00', $interval = '+30 minutes') {
        $output = array();
        $current = strtotime($default);
        $end = strtotime('23:59');
        while ($current <= $end) {
            array_push($output, date("h.i A", $current));
            $current = strtotime($interval, $current);
        }

        return $output;
    }

    /**
     *
     * Get times as option-list.
     *
     * @return array List of times
     */
    public function show_timerpicker_options() {
        return $this->get_time_selectoptions('05:00', '+30 minutes');
    }

    public function showUserTime($time) {
        echo date("h:i A", strtotime($time));
    }

    public function showUserDate($date) {
        echo date("j M Y", strtotime($date));
    }

}
