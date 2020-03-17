<?php

require_once 'teamapproval.civix.php';
use CRM_Teamapproval_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/ 
 */
function teamapproval_civicrm_config(&$config) {
  _teamapproval_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function teamapproval_civicrm_xmlMenu(&$files) {
  _teamapproval_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function teamapproval_civicrm_install() {
  _teamapproval_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function teamapproval_civicrm_postInstall() {
  _teamapproval_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function teamapproval_civicrm_uninstall() {
  _teamapproval_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function teamapproval_civicrm_enable() {
  _teamapproval_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function teamapproval_civicrm_disable() {
  _teamapproval_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function teamapproval_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _teamapproval_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function teamapproval_civicrm_managed(&$entities) {
  _teamapproval_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function teamapproval_civicrm_caseTypes(&$caseTypes) {
  _teamapproval_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function teamapproval_civicrm_angularModules(&$angularModules) {
  _teamapproval_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function teamapproval_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _teamapproval_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function teamapproval_civicrm_entityTypes(&$entityTypes) {
  _teamapproval_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function teamapproval_civicrm_themes(&$themes) {
  _teamapproval_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 *
function teamapproval_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 *
 */
function teamapproval_civicrm_navigationMenu(&$menu) {
  _teamapproval_civix_insert_navigation_menu($menu, 'Administer/System Settings', array(
    'label' => E::ts('Team Approval'),
    'name' => 'team_approval',
    'url' => CRM_Utils_System::url('civicrm/admin/setting/team-approval', 'reset=1'),
    'permission' => 'administer CiviCRM',
    //'operator' => 'OR',
    'separator' => 0,
  ));
  _teamapproval_civix_navigationMenu($menu);
}

/**
 * Implements hook_civicrm_civicrm_custom
 *
 * If team status gets Approved, create an activity if doesn't already exist.
 *
 */
function teamapproval_civicrm_custom( $op, $groupID, $entityID, &$params ) {
  if ( $op != 'create' && $op != 'edit' ) {
    return;
  }
  if ($groupID == 1) { // Team Details
    $teamStatusCFId = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_CustomField', 'Team_Status', 'id', 'name');
    $customOption = CRM_Core_BAO_CustomOption::getCustomOption($teamStatusCFId, TRUE);
    $optionValues = CRM_Core_PseudoConstant::get('CRM_Core_BAO_CustomField', 'custom_' . $teamStatusCFId, [], 'create');
    $optionValues = array_flip($optionValues);
    foreach ($params as $param) {
      if ($param['custom_field_id'] == $teamStatusCFId && $param['value'] == $optionValues['Approved']) {
        $result = civicrm_api3('Activity', 'get', [
          'sequential' => 1,
          'activity_type_id' => "Team Status Approved",
          'assignee_contact_id' => $entityID
        ]);
        if (empty($result['count']) && empty($result['values'])) {
          $sourceContactId  = CRM_Core_Session::getLoggedInContactID();
          $targetContactIds = [];
          $result = civicrm_api3('Relationship', 'get', [
            'sequential'   => 1,
            'return'       => ["contact_id_a"],
            'relationship_type_id' => CRM_Core_DAO::getFieldValue('CRM_Contact_DAO_RelationshipType', 'Employee of', 'id', 'name_a_b'),
            'contact_id_b' => $entityID,
            'is_active'    => 1,
            'options'      => ['limit' => 0],
          ]);
          if (!empty($result['count']) && !empty($result['values'])) {
            foreach ($result['values'] as $rel) {
              $targetContactIds[$rel['contact_id_a']] = $rel['contact_id_a'];
            }
          }
          // ignore contacts with a registration if configured
          if (!empty($targetContactIds) && Civi::settings()->get('teamapproval_event_id')) {
            $query = "SELECT contact_id FROM civicrm_participant WHERE event_id = %1 AND status_id IN (1,2) AND contact_id IN ( " . implode(',', $targetContactIds) . ' ) ';
            $participants = CRM_Core_DAO::executeQuery($query, [1 => [Civi::settings()->get('teamapproval_event_id'), 'Positive']]);
            while ($participants->fetch()) {
              unset($targetContactIds[$participants->contact_id]);
            }
          }
          if (!empty($targetContactIds)) {
            $activityParams = [
              'source_contact_id'   => $sourceContactId,
              'target_contact_id'   => $targetContactIds,
              'assignee_contact_id' => $entityID,
              'activity_date_time'  => date('YmdHis'),
              'subject'             => ts('Team Status Approved'),
              'details'             => ts('Team Status Approved'),
              'status_id'           => CRM_Core_PseudoConstant::getKey('CRM_Activity_BAO_Activity', 'activity_status_id', 'Completed'),
              'activity_type_id'    => CRM_Core_PseudoConstant::getKey('CRM_Activity_BAO_Activity', 'activity_type_id', 'Team Status Approved'),
            ];
            $result = civicrm_api3('Activity', 'create', $activityParams);
          }
        }
      }
    }
  }
}
