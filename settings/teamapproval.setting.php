<?php

use CRM_Teamapproval_ExtensionUtil as E;

return [
  'teamapproval_event_id' => [
    'name' => 'teamapproval_event_id',
    'type' => 'Integer',
    'html_type'  => 'select',
    'pseudoconstant' => [
      'callback'  => 'CRM_Event_PseudoConstant::event',
    ],
    'html_attributes' => [
      'class' => 'crm-select2',
    ],
    'default'     => 0,
    'add'         => '5.22',
    'is_domain'   => 1,
    'is_contact'  => 0,
    'title'       => E::ts('Event to consider for team approval notifications'),
    'description' => E::ts('Those already registered for event are not notified, when team status gets approved.'),
    'settings_pages' => [
      'team-approval' => [
        'weight' => 10,
      ]
    ],
  ],
];
