<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Fixtures for legacy logging testing.
 *
 * @package    logstore_legacy
 * @copyright  2014 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace logstore_legacy\event;

defined('MOODLE_INTERNAL') || die();


class unittest_executed extends \core\event\base {
    public static function get_name() {
        return 'xxx';
    }

    public function get_description() {
        return 'yyy';
    }

    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    public function get_url() {
        return new \moodle_url('/somepath/somefile.php', array('id' => $this->data['other']['sample']));
    }

    public static function get_legacy_eventname() {
        return 'test_legacy';
    }

    protected function get_legacy_eventdata() {
        return array($this->data['courseid'], $this->data['other']['sample']);
    }

    protected function get_legacy_logdata() {
        $cmid = 0;
        if ($this->contextlevel == CONTEXT_MODULE) {
            $cmid = $this->contextinstanceid;
        }
        return array($this->data['courseid'], 'core_unittest', 'view',
            'unittest.php?id=' . $this->data['other']['sample'], 'bbb', $cmid);
    }
}
