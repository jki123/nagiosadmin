<?php
/**
 * $Id$
 *
 * Copyright 2008 secure-net-concepts <info@secure-net-concepts.de>
 *
 * This file is part of Nagios Administrator http://www.nagiosadmin.de.
 *
 * Nagios Administrator is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Nagios Administrator is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Nagios Administrator. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    nagiosadmin
 * @subpackage lib.model
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */

/**
 * Subclass for representing a row from the 'host' table.
 */
class Host extends BaseHost
{
  private static $VALID_DIRECTIVES = array(
    'host_name',
    'alias',
    'display_name',
    'address',
    'parents',
    'hostgroups',
    'check_command',
    'initial_state',
    'max_check_attempts',
    'check_interval',
    'retry_interval',
    'active_checks_enabled',
    'passive_checks_enabled',
    'check_period',
    'obsess_over_host',
    'check_freshness',
    'freshness_threshold',
    'event_handler',
    'event_handler_enabled',
    'low_flap_threshold',
    'high_flap_threshold',
    'flap_detection_enabled',
    'flap_detection_options',
    'process_perf_data',
    'retain_status_information',
    'retain_nonstatus_information',
    'contacts',
    'contact_groups',
    'notification_interval',
    'first_notification_delay',
    'notification_period',
    'notification_options',
    'notifications_enabled',
    'stalking_options',
    'notes',
    'notes_url',
    'action_url',
    'icon_image',
    'icon_image_alt',
    'vrml_image',
    'statusmap_image',
    '2d_coords',
    '3d_coords',
    'use'
  );

  public function __toString()
  {
    return $this->getAlias().' ('.$this->getName().')';
  }

  public function getGroupName()
  {
    return $this->getHostGroup()->getAlias();
  }

  public function getServices()
  {
    return $this->getServiceToHostsJoinService();
  }

  public function getContactGroups()
  {
    return $this->getHostToContactGroupsJoinContactGroup();
  }

  public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
  {
    $result = parent::toArray($keyType);

    $result['image'] = $this->getOs() ? $this->getOs()->getImage() : 'default.jpg';

    $contactgroups = $this->getContactGroups();
    $ca = array();
    foreach($contactgroups as $g2c)
    {
      $ca[] = $g2c->getContactGroup()->getName();
    }
    $result['contactgroups'] = implode(', ',$ca);

    return $result;
  }
  
  public function getValidDirectives()
  {
    return self::$VALID_DIRECTIVES;
  }
}
