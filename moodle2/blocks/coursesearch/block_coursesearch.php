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
 * Main coursesearch class.
 *
 * @package   block_coursesearch
 * @author    Mark Sharp <m.sharp@chi.ac.uk>
 * @copyright 2017 University of Chichester {@link www.chi.ac.uk}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Main coursesearch class.
 *
 * @copyright 2017 University of Chichester {@link www.chi.ac.uk}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_coursesearch extends block_base {

    /**
     * {@inheritdoc}
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_coursesearch');
    }

    /**
     * {@inheritdoc}
     */
    public function instance_allow_multiple() {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function instance_allow_config() {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function specialization() {

        // Load userdefined title and make sure it's never empty.
        if (empty($this->config->title)) {
            $this->title = get_string('pluginname', 'block_coursesearch');
        } else {
            $this->title = $this->config->title;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get_content() {
        global $PAGE;

        if ($this->content !== null) {
            return $this->content;
        }

        // Create empty content.
        $this->content = new stdClass();
        $this->content->text = '';

        $courserenderer = $PAGE->get_renderer('core', 'course');
        $this->content->text = $courserenderer->course_search_form('', 'short');
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function applicable_formats() {
        return array('my' => true, 'site' => true);
    }
}
