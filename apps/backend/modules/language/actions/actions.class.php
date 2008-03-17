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
 * @subpackage language
 * @license    http://www.gnu.org/licenses/gpl.html
 * @link       www.nagiosadmin.de
 * @version    $Revision$
 * @author     Henrik Westphal <westphal@secure-net-concepts.de>
 */

/**
 * language actions.
 */
class languageActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    if($this->getUser()->getCulture() == 'de')
    {
      $this->forward('language', 'en');
    }
    else
    {
      $this->forward('language', 'de');
    }
  }
  
  public function executeEn()
  {
    $this->getUser()->setCulture('en');
    //$this->getRequest()->getReferer() TODO go to last active module
    $this->redirect('contact', 'index');
  }

  public function executeDe()
  {
    $this->getUser()->setCulture('de');
    $this->redirect('contact', 'index');
  }
}
