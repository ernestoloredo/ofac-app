<?php
    return [
      'paths' => [
        'sdn_advanced' => 'https://sanctionslistservice.ofac.treas.gov/api/PublicationPreview/exports/SDN_ADVANCED.XML',
        'cons_advanced' => 'https://sanctionslistservice.ofac.treas.gov/api/PublicationPreview/exports/CONS_ADVANCED.XML',        
      ],
      'storage_dir' => storage_path('ofac'),
    ];
?>