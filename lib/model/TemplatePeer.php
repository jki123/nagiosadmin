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
 * Subclass for performing query and update operations on the 'template' table.
 */ 
class TemplatePeer extends BaseTemplatePeer
{
  const T_DYNAMIC = 0;
  const T_STATIC = 1;

  public static function getConfig()
  {
    $c = new Criteria();
    $c->add(TemplatePeer::TYPE,TemplatePeer::T_STATIC,Criteria::EQUAL);
    $tpls = TemplatePeer::doSelect($c);
    
    $cfg = '';

    foreach($tpls as $tpl)
    {
      $cfg .= kill_doubles(beautyContent($tpl->getContent()))."\n\n";
    }
    
    return $cfg;
  }
}
